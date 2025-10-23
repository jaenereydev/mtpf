<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales_return_con extends MY_Controller
{
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

  public function index()
  {
    $this->load->model('product_model');
    $this->load->model('customer_model');

    $this->data['customer'] = $this->customer_model->get_customeractive();
    $this->data['sum'] = $this->session->userdata('SalesSum');
    $this->data['products']  = $this->product_model->get_productactive();

    $this->render_html('sidebar/sales/sales_return_view');
  }

  public function select_item()
  {
    if($this->input->is_ajax_request()){
      $this->load->model('product_model');
    	$product = $this->product_model->get_productactive_del([$this->input->post('id'), 1]);
    	// $product = $this->product_model->get_productactive_del([1, 1]);

			$product[0]->counter = 1;
			$product[0]->label[0] = 'Retail Price';
			$product[0]->label[1] = 'R';
    	$product[0]->quantity = $this->input->post('qty');
    	// $product[0]->total = $this->input->post('qty') * $product[0]->price1;

    	if($this->session->userdata('SalesReturn')){
    		$returnSession = $this->session->userdata('SalesReturn');
        
        $index = array_column(json_decode(json_encode($returnSession), true), 'indexed');
        $product[0]->indexed = max($index) + 1;

    		array_push($returnSession, $product[0]);
      	$this->session->set_userdata(['SalesReturn' => $returnSession]);
    	} else {
    		$product[0]->indexed = 0;
      	$this->session->set_userdata(['SalesReturn' => $product]);
    	}

    	$sum = $this->sum();

			$this->output->set_output(json_encode([$this->DOMGenerate($product[0]), $sum]));
    }
  }

  public function remove_selected(){
    if($this->input->is_ajax_request()){
      $this->load->model('product_model');

      $id = $this->input->post('id');
      $products = $this->session->userdata('SalesReturn');

      unset($products[$id]);

      $this->session->set_userdata(['SalesReturn' => $products]);
      $this->sum();

      if($this->session->userdata('SalesSum'))
        $this->output->set_output(json_encode($this->session->userdata('SalesSum')));
      else
        $this->output->set_output(json_encode([0, 0, 0]));
    }
  }

 	public function price_changer()
  {
    if($this->input->is_ajax_request()){

      $products = $this->session->userdata('SalesReturn');

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

      // Call priceLabel function
      $products[$id]->label = $this->priceLabel($price);

      $total = $products[$id]->total = $products[$id]->quantity * $products[$id]->$price;

    $this->session->set_userdata(['SalesReturn' => $products]);

    $this->sum();

    $this->output->set_output(json_encode([$products[$id]->label, $products[$id]->$price, $total, $this->session->userdata['SalesSum']]));
    }
  }

 	public function reset()
  {
    $this->unset_session();

    redirect('sales_return_con');
  }

  public function complete_return()
  {
  	$this->load->model('producthistory_model');
    $this->load->model('order_model');

    $returnProduct = $this->session->userdata('SalesReturn');
  	$sum = $this->session->userdata('SalesSum');
    $this->order_model->post_return($this->input->post());


    var_dump($this->input->post('searchCustomer'));
    if($this->input->post('searchCustomer')){
      $this->load->model('customer_model');
      $this->customer_model->post_customerHistory('RETURN', $this->input->post('searchCustomer'), ['sum' => -$sum[1]]);
    }

  	$this->reset();
  }



 	private function DOMGenerate($data)
  {
    $html = '<tr data-id="' . $data->indexed . '">';
    $html .='<td> <span data-toggle="modal" data-target="#SDelete"> <button class="btn btn-danger btn-sm toggler " data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove item"> <span class="glyphicon glyphicon-remove"></span> </button> </span> </td><td>';
    $html .= $data->longdesc . '</td>';
    $html .= '<td> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Retail Price"> P ' . number_format($data->price1, 2, '.', ',') . '</span>  <strong class="pull-right pr15">R</strong> </td><td>';
    $html .= $data->quantity . '</td><td> P ';
    $html .= number_format($data->total, 2, '.', ',') . '</td>';
    $html .= '</tr>';
    return $html;
  }

  private function sum()
  {
  	$return = $this->session->userdata('SalesReturn');
  	// Item, Total
  	$sum = [0, 0, 0];

  	if(!sizeof($return)){
  		$this->unset_session();
  		return false;
  	}

  	foreach ($return as $key => $item) {
  		$sum[0] += $item->quantity;

  		$price = 'price' . $item->counter;
  		$return[$key]->total = $item->quantity * $item->$price;
  		$sum[1] += $return[$key]->total;
  	}
  		$sum[2] = $sum[1];

    $this->session->set_userdata(['SalesReturn' => $return]);
    $this->session->set_userdata(['SalesSum' => $sum]);

    return $sum;
  }


}
?>