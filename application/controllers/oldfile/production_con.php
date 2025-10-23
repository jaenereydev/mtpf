<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Production_con extends MY_Controller
{
		var $com = '', $user = '';

		public function __construct() 
	  {
	    parent::__construct();
	    $this->load->model('user_model');
	    $this->load->model('company_model');
            $this->load->model('building_model');
            $this->load->model('production_model');

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
			$this->data['result'] = $this->production_model->get_list();

			$this->render_html('poultry/production/production_list_view');
		}

		public function add_production()
		{
			$this->load->model('poultryproduct_model');
			$this->load->model('product_model');

			$this->data['input'] = ($this->input->get('type') ? $this->input->get('type') : 'Laying');

			$this->data['type'] = $this->building_model->getType();
			$this->data['poultry'] = $this->poultryproduct_model->get_poultryactive();
			$this->data['result'] = $this->building_model->get_buildingByType($this->data['input']);
			$this->data['product'] = $this->product_model->get_productactive();

			$this->render_html('poultry/production/building_view');
		}

		public function update_postStatus($id)
		{
			$result = $this->production_model->update_postStatus($id);

			$this->session->set_flashdata('notif', ($result ? ["success", "<strong>Success!</strong> Updating document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('production_con');
		}

		public function delete_prod($id)
		{
			$result = $this->production_model->delete_product($id);

			$this->session->set_flashdata('notif', ($result ? ["success", "<strong>Success!</strong> Deleting document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('production_con');
		}

		public function update_prod($id)
		{
			$result = $this->production_model->update_prod($this->input->post(), $id);

			$this->session->set_flashdata('notif', ($result ? ["success", "<strong>Success!</strong> Updating document is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('production_con');
		}

		public function save()
		{
			$result = $this->production_model->postProduction($this->input->post());
			$this->session->set_flashdata('notif', ($result ? ["success", "<strong>Success!</strong> Inserting Consumption is successful."] : ["danger", "<strong>Failed!</strong> There is something wrong with your data."]));

			redirect('production_con/add_production');
		}

		public function reset()
		{
                $this->session->unset_userdata('html');
		}
	
}
?>