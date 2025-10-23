<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Company_model');
    }

    //--------------------------------------------------------------------------
     public function index()
    {
      
      $auth = $this->session->userdata('u_no');

      if(!$auth){
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('loginmain/login_header');
        $this->load->view('loginmain/login_view', array('com'=>$com));
        $this->load->view('loginmain/login_footer');
      } else {
        redirect('dashboard');
      }
    }
}
