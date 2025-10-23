<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Excel_con extends MY_Controller
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

	  	$session = $this->session->userdata('print_result');
	  	$this->data['result'] = $session[0];
	  	// $this->data['date'] = $session[1];
	  }

		public function transaction_excel()
	  {
			$this->load->view('sidebar/reports/export_excel/transaction_export', $this->data);
	  }

	  public function customer_excel()
	  {
			$this->load->view('sidebar/reports/export_excel/customer_export', $this->data);
	  }

	  public function sales_excel()
	  {
			$this->load->view('sidebar/reports/export_excel/sales_export', $this->data);
	  }

	  public function receiving_excel()
	  {
			$this->load->view('sidebar/reports/export_excel/receiving_export', $this->data);
	  }

	  public function production_excel()
	  {
	  	$this->load->view('sidebar/reports/export_excel/production_export', $this->data);
	  }

	  public function consumption_excel()
	  {
	  	$this->load->view('sidebar/reports/export_excel/consumption_export', $this->data);
	  }

 		public function consumption_building_excel()
	  {
	  	$this->load->view('sidebar/reports/export_excel/consumption_building_export', $this->data);
	  }

	  public function classifying_excel()
	  {
	  	$this->load->view('sidebar/reports/export_excel/classifying_export', $this->data);
	  }

	  public function expenses_excel()
	  {
	  	$this->load->view('sidebar/reports/export_excel/expenses_export', $this->data);
	  }

	}

?>