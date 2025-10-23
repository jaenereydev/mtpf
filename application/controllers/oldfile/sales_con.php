<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Sales_con extends MY_Controller
	{
		var $com = '', $user = '';

		public function __construct() 
    {
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('company_model');

      $this->com = $this->company_model->get_companyinfo();
      $this->user = $this->user_model->get_users($this->session->userdata('u_no'));

      $this->data = [
      		'users' => $this->user,
      		'hidebtn' => 0,
      		'com' => $this->com
      	];

      if(!$this->session->userdata('u_no')) {
        $this->logout();
      }
    }

    // Home, show sales page.
    public function index()
    {
        $this->load->model('product_model');
        $this->load->model('customer_model');
        $this->data['products'] = $this->product_model->get_productactive();
        $this->data['customer'] = $this->customer_model->get_customeractive();

        if(isset($this->session->userdata['sum_details']))
          $this->data['sumDetails'] = $this->session->userdata['sum_details'];

        $this->render_html('sidebar/sales/sales_view', false);
    }

    // Select product from the product list
    public function selected_item(){
      if($this->input->is_ajax_request()){
        $this->load->model('product_model');
        $product = $this->product_model->get_productactive_del([$this->input->post('id'), 1]);

        $product[0]->quantity = str_replace('*', '', $this->input->post('qty'));
        $product[0]->counter = 1;
        $product[0]->label[0] = 'Retail Price';
        $product[0]->label[1] = 'R';
        $product[0]->total = $product[0]->quantity * $product[0]->price1;

        if($this->session->userdata('saleProduct')){
          $session = $this->session->userdata('saleProduct'); 

          $index = array_column(json_decode(json_encode($session), true), 'indexed');

          $product[0]->indexed = max($index) + 1;
          array_push($session, $product[0]);
          $this->session->set_userdata(['saleProduct' => $session]);  
        } else {
          $product[0]->indexed = 0;
          $this->session->set_userdata(['saleProduct' => $product]);
        }
        $this->sum();
        $this->output->set_output(json_encode([$this->DOMGenerate($product), $this->session->userdata('sum_details')]));
      }
    }
    
    // Deleting products from the cart list.
    public function remove_selected(){
      if($this->input->is_ajax_request()){
        $this->load->model('product_model');

        $id = $this->input->post('id');
        $products = $this->session->userdata('saleProduct');

        unset($products[$id]);

        $this->session->set_userdata(['saleProduct' => $products]);
        $this->sum();

        if($this->session->userdata('sum_details'))
          $this->output->set_output(json_encode($this->session->userdata('sum_details')));
        else
          $this->output->set_output(json_encode([0, 0, 0, 0]));
      }
    }

    // Update the Total amount of payment.
    public function price_changer()
    {
      if($this->input->is_ajax_request()){

        $products = $this->session->userdata('saleProduct');

        if(ctype_digit($this->input->post('id'))){
          $id = $this->input->post('id');

          if($products[$id]->counter >= 10)
            $products[$id]->counter = 0;

          $products[$id]->counter += 1;
        } else {
          $id = $this->input->post('discount');
          $products[$id]->counter = 11;
        }

        $price = 'price' . $products[$id]->counter;

        if($products[$id]->$price == '' || $products[$id]->$price == NULL){
          $products[$id]->counter = 1;
          $price = 'price1';
        }

        // if(isset($products[$id]->override))
        //   unset($products[$id]->override);
        // Call priceLabel function
        $products[$id]->label = $this->priceLabel($price);

        $total = $products[$id]->total = $products[$id]->quantity * $products[$id]->$price;

      $this->session->set_userdata(['saleProduct' => $products]);

      // Call sum function
      $this->sum();

      $this->output->set_output(json_encode([$products[$id]->label, $products[$id]->$price, $total, $this->session->userdata['sum_details']]));
      }
    }

    public function payment(){
      if($this->input->is_ajax_request()){
        parse_str($this->input->post('data'), $parsed);
        $sum = $this->session->userdata('sum_details');

        if($parsed['paymentType'] == 'cash'){
          array_push($sum['paid'], [ucfirst($parsed['paymentType']), (double)$parsed['amountPaid']]);
          $sum[3] = round($sum[3], 2) - $parsed['amountPaid'];
        } else {
          $amount = ($parsed['paymentType'] == 'credit' ? round($sum[3], 2) : $parsed['check_amount']);
          array_push($sum['paid'], [ucfirst($parsed['paymentType']), $amount]);
          $sum[3] = round($sum[3], 2) - $amount;
        }

        $this->session->set_userdata(['paymentDetails' => $parsed]);
        $this->session->set_userdata(['sum_details' => $sum]);

        $this->output->set_output(json_encode($sum));
      }
    }

    public function disc_additional()
    {
      if($this->input->is_ajax_request()){
        $sum = $this->session->userdata('sum_details');
        $inputs = $this->input->post();

        if($this->input->post('name') == 'discount'){
          if($inputs['val'] != ''){
            $sum['discount'] = ['percent' => $inputs['val'], 'amount' => 0];
          } else 
            unset($sum['discount']);

        } else if($this->input->post('name') == 'additional_amount') {
          if($inputs['val'] != ''){
            $sum['additional_amount'] = (double)$inputs['val'];
          } else
            unset($sum['additional_amount']);
        } else {
          if($this->input->post('exit') == 'discount'){
            unset($sum['discount']);
          } else {
            unset($sum['additional_amount']);
          }
        }
        
        $this->session->set_userdata(['sum_details' => $sum]);
        $this->sum();
        
        $this->output->set_output(json_encode($this->session->userdata('sum_details')));
      }
    }

    public function add_customer()
    {
      if($this->input->is_ajax_request()){
        parse_str($this->input->post('data'), $inputs);
        $sql = [
                'name' => $inputs['name'],
                'address' => $inputs['address'],
                'telno' => (isset($inputs['telno']) ? $inputs['telno'] : null),
                'creditlimit' => (isset($inputs['creditlimit']) ? $inputs['creditlimit'] : null),
                'gender' => (isset($inputs['gender']) ? $inputs['gender'] : null),
                'terms' => (isset($inputs['terms']) ? $inputs['terms'] : null),
                'discount' => (isset($inputs['discount']) ? $inputs['discount'] : null),
                'schedule' => (isset($inputs['sched']) ? $inputs['sched'] : null),
                'u_no' => $this->session->userdata('u_no'),
                'status' => 'ACTIVE'
               ];

        $this->db->insert('customer', $sql);
        $id = $this->db->insert_id();

        $this->output->set_output(json_encode(['value' => $id, 'text' => ucwords($inputs['name'])]));
      }
    }

    // public function override()
    // {
    //   if($this->input->is_ajax_request()){

    //     $input = $this->input->post();
    //     $session = $this->session->userdata('saleProduct');

    //     if($input['val'] > 0) {
    //       $session[$input['id']]->override = $input['val'];
    //       $total = $input['val'] * $session[$input['id']]->quantity;

    //     } else {
    //       $price = 'price' . $session[$input['id']]->counter;
    //       $total =  $session[$input['id']]->$price * $session[$input['id']]->quantity;

    //       if(isset($session[$input['id']]->override))
    //         unset($session[$input['id']]->override);
    //     }

    //     $session[$input['id']]->total = $total;

    //     $this->session->set_userdata('saleProduct', $session);
    //     $this->sum();

    //     $this->output->set_output(json_encode([$total, $this->session->userdata('sum_details')]));
    //   }
    // } 

    public function override()
    {
      if($this->input->is_ajax_request()){

        $input = $this->input->post();
        $session = $this->session->userdata('saleProduct');

        if($input['val'] > 0) {
          $session[$input['id']]->override = true;
          $total = $input['val'];

        } else {
          $price = 'price' . $session[$input['id']]->counter;
          $total = $session[$input['id']]->$price * $session[$input['id']]->quantity;

          if(isset($session[$input['id']]->override))
            unset($session[$input['id']]->override);
        }

        $session[$input['id']]->total = $total;

        $this->session->set_userdata('saleProduct', $session);
        $this->sum();

        $this->output->set_output(json_encode([$total, $this->session->userdata('sum_details')]));
      }
    }

    public function adjustment()
    {
      if($this->input->is_ajax_request()){

        $inputs = $this->input->post();
        $session = $this->session->userdata('saleProduct');

        $session[$inputs['id']]->adjustment = $inputs['val'];

        $this->session->set_userdata('saleProduct', $session);
      }
    }

    public function sales_return()
    {
      $this->load->model('product_model');

      $this->data['products']  = $this->product_model->get_productactive();
      $this->render_html('sidebar/sales/sales_return_view');
    }

    // Cancel the sales, remove the item in the cart..
    public function reset()
    {
      $this->unset_session();

      redirect('sales_con');
    }

    public function complete_sale()
    {
      $this->load->model('product_model');
      $form = $this->session->userdata('paymentDetails');
      $session = $this->session->userdata('saleProduct');

      $data = [];
      foreach ($this->input->post() as $key => $value) {
        if($value != '')
          array_push($data, $value);
      }

      switch ($form['paymentType']) {
        case 'cash':
            $this->load->model('order_model');
            $result = $this->order_model->post_order($form, $data);
          break;
        case 'check':
          $this->load->model('order_model');
          $result = $this->order_model->post_check($form, $data);
          break;

        case 'credit':
          $this->load->model('creditorder_model');
          $this->creditorder_model->post_credit($form, $data);
          break;
      }

      $this->unset_session();
      redirect('sales_con');
    }


    public function z_reading()
    {       
      if($this->session->userdata('ZReading'))
        redirect('sales_con');
      else 
        $this->render_html('sidebar/sales/z_reading_view');
    }


    public function zreading_post()
    {
      if($this->input->is_ajax_request()){

        $this->load->model('company_model');
        $this->load->model('order_model');
        $this->load->model('creditorder_model');

        $tags = [ 
          '25' => 'twenty_five_cents',
          '1' => 'one',
          '5' => 'five',
          '10' => 'ten',
          '20' => 'twenty',
          '50' => 'fifty',
          '100' => 'one_hundred',
          '200' => 'two_hundred',
          '500' => 'five_hundred',
          '1000' => 'one_thousand'
        ];

        $inputs = $this->input->post();
        $data = [];

        foreach ($inputs as $key => $value) {
          if(isset($tags[$key]))
            $data[$tags[$key]] = $value;
        }

        $data['cash_on_hand'] = $inputs['total'];
        $data['date'] = date('Y-m-d');

        $cash = $this->order_model->getSales();
        $paid = $this->creditorder_model->creditPaid();
        
        $total = $cash + $paid;
        // if((double)$total <= (double)$inputs['total'])
        //   $this->output->set_output($total);
        // else {
          $this->company_model->z_reading($data);
          $this->output->set_output(0);
          $this->session->set_userdata(['ZReading' => true]);
        // }

      }
    }

    public function get_productList()
    {
      $this->load->model('product_model');
      $products = $this->product_model->get_productactive();

      $list['aaData'] = []; 
      foreach ($products as $key => $item) {
        array_push($list['aaData'], [
          ucwords($item->longdesc),
          $item->qty,
          'P '. number_format($item->price1, 2, '.',','),
          '<button class="btn btn-primary btn-sm btn-block product-list" data-id="' . $item->p_no . '" data-dismiss="modal">Select</button>'
        ]);
      }

      $this->output->set_output(json_encode($list));
    }


    // Generate NEW ROW.
    private function DOMGenerate($data)
    {
      $crack = false;
      $html = '<tr data-id="' . $data[0]->indexed . '">';
      $html .='<td> <span data-toggle="modal" data-target="#SDelete"> <button class="btn btn-danger btn-sm toggler " data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove item"> <span class="glyphicon glyphicon-remove"></span> </button> </span> </td><td>';
      $html .= $data[0]->longdesc . '</td><td>';
      $html .= $data[0]->qty . '</td>';
      $html .= '<td> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Retail Price"> P ' . (strpos($data[0]->price1, "." ) !== false ? $data[0]->price1: $data[0]->price1 . '.00') . '</span>  <strong class="pull-right pr15">R</strong> </td><td>';
      $html .= $data[0]->quantity . '</td><td>';
      // if(strtolower($data[0]->longdesc) == 'frozen' || strtolower($data[0]->longdesc) == 'crack f')
        $html .= '<input type="number" name="override" class="form-control input-sm text-center override" value="' . sprintf('%0.2f', $data[0]->total) . '" placeholder="Override Price"></td>';
      // else
      //   $html .= ' P ' . sprintf('%0.2f', $data[0]->total) . '</td>';
      if(strpos(strtolower($data[0]->longdesc), 'crack') !== false){
        $html .= '<td> <input type="number" class="form-control input-sm toggler" name="adjust" min="0"></td>'; 
      } else
        $html .= '<td></td>';

      $html .= '</tr>';
      return [$html, $crack];
    }

    //Total payment computer..
    private function sum(){
      $session = $this->session->userdata('saleProduct');
      if(sizeof($session) != 0){

        $sum = $this->session->userdata('sum_details');
        // $data = ['items', 'subtotal', 'total', 'amountDue'];
        $data = [0, 0, 0, 0, 'paid' => []];

        foreach ($session as $key => $value) {
          $data[0] += $value->quantity;
          $price = 'price' . $value->counter;

          // $total = $value->quantity * (isset($value->override) ? $value->override : $value->$price );
          $total = (isset($value->override) ? $value->total : $value->quantity * $value->$price);
       
          $data[1] += $total;
        }

        $data[3] = $data[2] = $data[1];

        if(isset($sum['discount'])){
          $data['discount']['amount'] = $data[1] * ($sum['discount']['percent'] / 100);
          $data['discount']['percent'] = $sum['discount']['percent'];
          $data[2] = $data[1] - $data['discount']['amount'];
        }

        if(isset($sum['additional_amount'])){
          $data[2] += (double)$sum['additional_amount'];
          $data['additional_amount'] = $sum['additional_amount'];
        }

        if(isset($sum['paid']))
          $data['paid'] = $sum['paid'];

        $data[3] = $data[2];

        if(isset($sum['paid']))
         $data[3] -= array_sum(array_column($sum['paid'], 1));
        
        $this->session->set_userdata(['sum_details' => $data]);
      } else 
        $this->unset_session();
    }
  }

?>