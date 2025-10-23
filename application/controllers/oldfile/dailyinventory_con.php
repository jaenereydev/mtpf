<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dailyinventory_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Dailyinventory_model');
        $this->load->model('Heading_model'); 
        $this->load->model('Category_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function index()
    {               
        $cat = $this->Category_model->get_catactive();
        $prod = $this->Dailyinventory_model->get_product();
        $dsc = $this->Dailyinventory_model->get_description();
        $prodh = $this->Dailyinventory_model->get_history();
        $users = $this->Heading_model->user_det();
        $this->Heading_model->inchide();
        $this->load->view('sidebar/reports/dailyinventory', array('cat' => $cat, 'prodh' => $prodh, 'dsc' => $dsc,'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function search()
    {   
        $cno = $this->input->post('c_no');
        $value = $this->input->post('date1'); $date = date_format(date_create($value), 'Y-m-d');
        $cat = $this->Category_model->get_catactive();
        if($cno == "all") {
            $prod = $this->Dailyinventory_model->get_product();
        }else {
            $prod = $this->Dailyinventory_model->get_productsearch($cno);
        }        
        $dsc = $this->Dailyinventory_model->get_description();
        $prodh = $this->Dailyinventory_model->get_historysearch($date);
        $users = $this->Heading_model->user_det();
        $this->Heading_model->inchide();
        $this->load->view('sidebar/reports/dailyinventory', array('cat' => $cat, 'prodh' => $prodh, 'dsc' => $dsc,'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function printreport()
    {       
        $cno = $this->input->post('c_no');
        $value = $this->input->post('date1'); $date = date_format(date_create($value), 'Y-m-d');
        $cat = $this->Category_model->get_catactive();
        if($cno == "all") {
            $prod = $this->Dailyinventory_model->get_product();
        }else {
            $prod = $this->Dailyinventory_model->get_productsearch($cno);
        }        
        $dsc = $this->Dailyinventory_model->get_description();
        $prodh = $this->Dailyinventory_model->get_historysearch($date);
        $users = $this->Heading_model->user_det();   
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/print/dailyinventory_print', array('cat' => $cat, 'cno' => $cno, 'com' => $com, 'd' => $value, 'prodh' => $prodh, 'dsc' => $dsc,'users' => $users, 'prod' => $prod));
      
    }
    
    //--------------------------------------------------------------------------
    
    public function excelprintreport()
    {       
        $cno = $this->input->post('c_no');
        $value = $this->input->post('date1'); $date = date_format(date_create($value), 'Y-m-d');
        $cat = $this->Category_model->get_catactive();
        if($cno == "all") {
            $prod = $this->Dailyinventory_model->get_product();
        }else {
            $prod = $this->Dailyinventory_model->get_productsearch($cno);
        }        
        $dsc = $this->Dailyinventory_model->get_description();
        $prodh = $this->Dailyinventory_model->get_historysearch($date);
        $users = $this->Heading_model->user_det();   
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/export_excel/dailyinventory_print', array('cat' => $cat, 'cno' => $cno, 'com' => $com, 'd' => $value, 'prodh' => $prodh, 'dsc' => $dsc,'users' => $users, 'prod' => $prod));
      
    }
    
    //--------------------------------------------------------------------------
    
     
    
}
