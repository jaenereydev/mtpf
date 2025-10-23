<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Classifying_con extends MY_Controller
	{
		var $com = '', $user = '';

		public function __construct() 
	  {
	    parent::__construct();
	    $this->load->model('user_model');
	    $this->load->model('company_model');
			$this->load->model('building_model');
			$this->load->model('classifying_model');

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
			$this->load->model('poultryproduct_model');
			$this->load->model('category_model');
			$this->data['poultry'] = $this->poultryproduct_model->get_poultryactive();
			$this->data['category'] = $this->category_model->get_catactive();

			$this->data['result'] = $this->classifying_model->get_list();
			$this->data['product'] = $this->product_model->get_productactive();

			$this->render_html('poultry/classifying/classifying_list_view');
		}
		
		public function edit_classifying($id)
		{
			$this->load->model('poultryproduct_model');
			$this->load->model('category_model');
			$this->load->model('product_model');

			$this->data['product'] = $this->product_model->get_productactive();
			$this->data['category'] = $this->category_model->get_catactive();
			$this->data['poultry'] = $this->poultryproduct_model->get_poultryactive();
			$this->data['result'] = $this->classifying_model->getClassifyById($id);
			$this->data['id'] = $id;

      $this->session->unset_userdata('update_edit');
      $this->session->unset_userdata('update_delete');
      $this->session->unset_userdata('update_add');

			$this->render_html('poultry/classifying/classifying_edit_view');
		}

		public function add_classifying()
		{
			$this->load->model('product_model');
			$this->load->model('production_model');	
			$this->load->model('poultryproduct_model');
			$this->load->model('category_model');

			$this->data['product'] = $this->product_model->get_productactive();
			$this->data['input'] = ($this->input->get('type') ? $this->input->get('type') : 'Laying');
			$this->data['type'] = $this->building_model->getType();
			$this->data['poultry'] = $this->poultryproduct_model->get_poultryactive();
			$this->data['result'] = $this->building_model->get_buildingByType($this->data['input']);
			$this->data['category'] = $this->category_model->get_catactive();

      $this->session->unset_userdata('html');
			$this->render_html('poultry/classifying/classifying_view');
		}

		public function update_postStatus($id)
		{
			$result = $this->classifying_model->update_post($id);

			$this->redirect($result);
		}

		public function delete_classify($id)
		{
			$result = $this->classifying_model->delete_post($id);

			$this->redirect($result);
		}

		public function ajax_Addproduct()
		{
      if($this->input->is_ajax_request())
      {
      	$input = $this->input->post();
      	if($this->session->userdata('html')){
          $html = $this->session->userdata('html');
      }
      	$id = explode('_', $input['id']);
      	$html[$id[0]] = ['qty' => $input['qty'], 'unitprice' => $id[1]];

      	$this->session->set_userdata('html', $html);
      }
		}

		public function ajax_Remove()
		{
      if($this->input->is_ajax_request()){
      	$input = $this->input->post();

      	$html = $this->session->userdata('html');
      	$id = explode('_', $input['id']);
      	unset($html[$id[0]]);

      	$this->session->set_userdata('html', $html);
			}
		}

    public function save()
    {
        $input = $this->input->post();
        $result = $this->classifying_model->postClassifying($input);
        $this->session->unset_userdata('html');

        $this->session->set_flashdata('notif', ($result ? ["success", "<strong>Success!</strong> Inserting Consumption is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));
        redirect('classifying_con');
    }

		public function reset()
		{
      $this->session->unset_userdata('html');
		}

		public function update_addAjax()
		{
      if($this->input->is_ajax_request()){
				$input = $this->input->post();
				$update_add = [];

				if($this->session->userdata('update_add'))
					$update_add = $this->session->userdata('update_add');

				array_push($update_add, [
						'id' => $input['id'][0],
						'qty' => $input['val'],
						'index' => $input['id'][1],
						'deleted' => false
					]);

				$this->session->set_userdata('update_add', $update_add);
			}
		}

		public function update_editAjax()
		{
      if($this->input->is_ajax_request()){
      	$input = $this->input->post();
				$input['id'] = explode('_', $input['id']);

				$update_edit = [];
				$index = false;
				if($this->session->userdata('update_edit'))
					$update_edit = $this->session->userdata('update_edit');

				if($this->session->userdata('update_add')){

					$update_add = $this->session->userdata('update_add');
					$index = $this->checkIfExist($update_add, $input['id']);
				}

				if(is_int($index)){

					$update_add[$index] = [
						'id' => $input['id'][0],
						'qty' => $input['val'],
						'index' => $input['id'][1],
						'deleted' => false
					];

					$this->session->set_userdata('update_add', $update_add);
				} else {
					$update_edit[$input['id'][1]] = ['p_no' => $input['id'][0], 'qty' => $input['val']];
					$this->session->set_userdata('update_edit', $update_edit);
				}
			}
		}

		public function delete_editAjax()
		{
      if($this->input->is_ajax_request()){

      	$input = $this->input->post();

      	$update_delete = [];
      	$index = false;

				if($this->session->userdata('update_add')){
					$update_add = $this->session->userdata('update_add');
					$index = $this->checkIfExist($update_add, $input['id']);

      	}

      	if(is_int($index)){
      		$update_add[$index]['deleted']  = ($input['undo'] ? false : true);
      		$this->session->set_userdata('update_add', $update_add);
      	} else {
					if($this->session->userdata('update_delete'))
						$update_delete = $this->session->userdata('update_delete');

					if($input['undo'])
						unset($update_delete[$input['id'][1]]);
					else
						$update_delete[$input['id'][1]] = $input['id'][0];

					if(sizeof($update_delete) == 0)
	      		$this->session->unset_userdata('update_delete');
	      	else
						$this->session->set_userdata('update_delete', $update_delete);
      	}
			}
		}

		public function viewClassify()
		{
			$result = $this->classifying_model->getClassifyById($this->input->post('id'));
			$html = '';

			if($result[0]->p_no){
				foreach ($result as $key => $value) {
					$html .= "<tr><td>" . ucwords($value->longdesc) . "</td><td>" . $value->qty . "</td><td>" . $value->totalamount . "</td></tr>";
				}
			} else {
				$html = '<tr><td colspan="2" class="text-center">NO CLASSIFYING</td></tr>';
			}

      $this->output->set_output(json_encode([$result[0]->description, $result[0]->name, $html]));
		}

		public function post_update($id)
		{
			$this->classifying_model->updateClassifying($this->input->post(), $id);

			redirect('classifying_con');
		}

		public function getlist()
		{
			$this->load->model('product_model');
			$product = $this->product_model->get_productactive();

			$productList = [];
			foreach ($product as $key => $value) {
				array_push($productList, [
						"value" => $value->p_no,
						"text" => ucwords($value->longdesc)
					]);
			}

      $this->output->set_output(json_encode($productList));
		}

		private function redirect($result)
		{
			$this->session->set_flashdata('notif', ($result ? ["success", "<strong>Success!</strong> Updating document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('classifying_con');
		}

		private function checkIfExist($data, $needle)
		{
			foreach ($data as $key => $value) {
				if($value['index'] == $needle[1]){
					return $key;
				}
			}

			return false;
		}

		public function test()
		{
			$this->load->model('producthistory_model');
			$session = $this->session->userdata('update_delete');
			$ref_no = 7;
			$pushed = [];
			$ph = [];
			$total = 0;

			echo '<pre>';
			foreach ($session as $key => $value) {
				$productHistory = $this->producthistory_model->getProductHistory(['CLASSIFY', $ref_no, $value]);
				array_push($ph, $productHistory[0]->ph_no);
				array_push($pushed, $key);
				$total += $productHistory[0]->instock;
      	$this->db->query('UPDATE poultryproduct SET qty = qty + ? WHERE pp_no = ?', [$productHistory[0]->instock, 1]);
			}

		}
	}
?>