<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Consumption_con extends MY_Controller
	{
		var $com = '', $user = '';

		public function __construct() 
	  {
	    parent::__construct();
	    $this->load->model('user_model');
	    $this->load->model('company_model');
			$this->load->model('consumption_model');

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
	  	$this->data['result'] = $this->consumption_model->getList();
			$this->data['product'] = $this->product_model->get_productactive();
			$this->reset();

			$this->render_html('poultry/consumption/consumption_list_view');
	  }

	  public function add_consumption()
	  {
			$this->load->model('building_model');
			$this->load->model('product_model');

			$this->data['product'] = $this->product_model->get_productactive();
			$this->data['input'] = ($this->input->get('type') ? $this->input->get('type') : 'Laying');
			$this->data['type'] = $this->building_model->getType();
			$this->data['result'] = $this->building_model->get_buildingByType($this->data['input']);

     	$this->session->unset_userdata('add_con');
			$this->render_html('poultry/consumption/consumption_view');
	  }

	  public function delete_consump($id)
	  {
	  	$status = $this->consumption_model->delete_consump($id);

			$this->session->set_flashdata('notif', ($status ? ["success", "<strong>Success!</strong> deleting document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('consumption_con');
	  }


	  public function ajax_addCon()
	  {
      if($this->input->is_ajax_request()){
      	$input = $this->input->post();
      	$add_con = [];

      	if($this->session->userdata('add_con'))
      		$add_con = $this->session->userdata('add_con');

      	$add_con[$input['data'][0]] = $input['data'][1];

      	$this->session->set_userdata('add_con', $add_con);
      }
	  }

	  public function post_addCon($id)
	  {	
	  	$result = $this->consumption_model->post_consumption($this->session->userdata('add_con'), $id);

	  	$this->session->set_flashdata('notif', ($result ? ["success", "<strong>Success!</strong> Inserting document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('consumption_con');
	  }	

	  public function ajax_removeCon()
	  {
      if($this->input->is_ajax_request()){

      	$add_con = $this->session->userdata('add_con');

      	unset($add_con[$this->input->post('id')]);

      	if(sizeof($add_con) <= 0)
      		$this->session->unset_userdata('add_con');
      	else
      		$this->session->set_userdata('add_con', $add_con);
	  	}
	  }

	  public function ajax_viewCon()
	  {
      if($this->input->is_ajax_request()){
      	$input = $this->input->post();
      	$result = $this->consumption_model->get_consumpById($input['id']);

      	$sum = [0, 0];
      	$html = '';
      	if (sizeof($result) > 0) {
	      	foreach ($result as $key => $value) {
	      		$html .= '<tr><td>' . ucwords($value->longdesc) . '</td><td>' . $value->qty . '</td><td> P' . number_format($value->totalamount, 2, '.', ',') . '</td></tr>';
	      		$sum[0] += $value->totalamount;
	      		$sum[1] += $value->qty;
	      	}
	      	$sum[0] = 'P ' . number_format($sum[0], 2, '.', ',');
      	} else 
      		$html = '<tr><td colspan="3" class="text-center">NO CONSUMPTION</td></tr>';

      	$this->output->set_output(json_encode([$sum[0], $sum[1], $html]));
      	// $this->output->set_output(json_encode(sizeof($result)));
	  	}
	  }

	  public function ajax_updateGet()
	  {
      if($this->input->is_ajax_request()){
		  	$result = $this->consumption_model->get_consumpById($this->input->post('id'));
		  	$html = '';

		  	foreach ($result as $key => $value) {
		  		$html .= '<tr><td data-pk="' . $value->p_no . '_' . $value->cl_no . '">' . ucwords($value->longdesc) . '</td><td>' . $value->qty . '</td><td class="text-center"><span data-toggle="modal" data-target="#editM"><button class="btn btn-info btn-sm eEdit" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button></span> <button class="btn btn-danger btn-sm eDelete" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		  	}
	      $this->output->set_output(json_encode($html));
	    }
	  }

	  public function ajax_updateAdd()
	  {
	  	if ($this->input->is_ajax_request()) {
	  		$input = $this->input->post();
	  		$input['id'] = explode('_', $input['id']);
	  		$update_add = [];

	  		if ($this->session->userdata('update_add'))
	  			$update_add = $this->session->userdata('update_add');

	  		$update_add[$input['id'][1]] = [
  				'p_no' => $input['id'][0],
  				'qty' => $input['val'],
  				'deleted' => false
  				];

	  		$this->session->set_userdata('update_add', $update_add);

	  	}
	  }

	  public function ajax_updateEdit()
	  {
      if($this->input->is_ajax_request()){
      	$input = $this->input->post();
      	$input['data'][0] = explode('_', $input['data'][0]);
      	$update_edit = [];
      	$index = false;

      	if($this->session->userdata('update_add')){
      		$update_add = $this->session->userdata('update_add');
      		$index = $this->checkIfExist($update_add, $input['data'][0]);
      	}

      	if(is_int($index)){
      		$update_add[$index] = [
      				'p_no' => $input['data'][0][0],
      				'qty' => $input['data'][1],
      				'deleted' => false
      			];
      		$this->session->set_userdata('update_add', $update_add);

      	} else {
	      	if($this->session->userdata('update_edit'))
	      		$update_edit = $this->session->userdata('update_edit');

	      	// Index == cl_no
	      	$update_edit[$input['data'][0][1]] = ['p_no' => $inpt['data'][0][0], 'qty' => $input['data'][1]];

	      	$this->session->set_userdata('update_edit', $update_edit);
      	}
	    }
	  }

	  public function ajax_updateDelete()
	  {
	  	if ($this->input->is_ajax_request()) {
	  		$input = $this->input->post();
	  		$input['id'] = explode('_', $input['id']);
	  		$update_delete = [];
	  		$index = false;

	  		if($this->session->userdata('update_add')){
      		$update_add = $this->session->userdata('update_add');
      		$index = $this->checkIfExist($update_add, $input['id']);
	  		}

	  		if(is_int($index)){
	  			$update_add[$index]['deleted'] = ($input['del'] === 'true' ? true : false);
      		$this->session->set_userdata('update_add', $update_add);
	  		} else {
		  		if($this->session->userdata('update_delete'))
		  			$update_delete = $this->session->userdata('update_delete');

		  		if($input['del'])
		  			$update_delete[$input['id'][1]] = 'Delete This';
		  		else {
		  			unset($update_delete[$input['id'][1]]);
		  		}

					if(sizeof($update_delete) == 0)
						$this->session->unset_userdata('update_delete');
		  		else
		  			$this->session->set_userdata('update_delete', $update_delete);
	  		}
	  	}
	  }

	  public function update_post($id){
	  	$status = $this->consumption_model->update_post($id);

	  	$this->session->set_flashdata('notif', ($status ? ["success", "<strong>Success!</strong> Updating document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('consumption_con');
	  }

	  public function update_editConsump($id)
	  {
	  	$status = $this->consumption_model->update_editConsump($id);

	  	$this->session->set_flashdata('notif', ($status ? ["success", "<strong>Success!</strong> Updating document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

	  	redirect('consumption_con');
	  }

	  public function reset(){
			$this->session->unset_userdata('update_add');
			$this->session->unset_userdata('update_edit');
			$this->session->unset_userdata('update_delete');
	  }

	  private function checkIfExist($data, $needle){
	  	foreach ($data as $key => $value) {
	  		if($key == $needle[1])
	  			return $key;
	  	}
	  	return false;
	  }
	}
?>