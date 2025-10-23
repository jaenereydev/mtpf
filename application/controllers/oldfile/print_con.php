<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Print_con extends MY_Controller
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
	  }

	  public function transaction_print()
	  {
	  	$this->render_html('sidebar/reports/print/transaction_print', false);
	  }

	  public function customer_print()
	  {
	  	$this->render_html('sidebar/reports/print/customer_print', false);
	  }

	  public function sales_print()
	  {
	  	$this->render_html('sidebar/reports/print/sales_print', false);
	  }

	  public function receiving_print()
	  {
	  	$this->render_html('sidebar/reports/print/receiving_print', false);
	  }

	  public function production_print()
	  {
	  	$this->render_html('sidebar/reports/print/production_print', false);
	  }

	  public function consumption_print()
	  {
	  	$this->render_html('sidebar/reports/print/consumption_print', false);
	  }

	  public function consumption_building_print()
	  {
	  	$this->render_html('sidebar/reports/print/consumption_building_print', false);
	  }

	  public function classifying_print()
	  {
	  	$this->render_html('sidebar/reports/print/classifying_print', false);
	  } 

	  public function expenses_print()
	  {
	  	$this->render_html('sidebar/reports/print/expenses_print', false);
	  }
	}
?>