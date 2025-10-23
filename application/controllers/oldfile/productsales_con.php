<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Productsales_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Productsales_model');        
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
        $prod = $this->Productsales_model->get_product();
        $creditprod = $this->Productsales_model->get_creditproduct();        
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/reports/Productsales', array('cat' => $cat, 'creditprod' => $creditprod, 'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function search()
    {           
        $c = $this->input->post('c_no');
        $value1 = $this->input->post('from'); $from = date_format(date_create($value1), 'Y-m-d');
        $value2 = $this->input->post('to'); $to = date_format(date_create($value2), 'Y-m-d');  
        if($c == 'all') {
            $prod = $this->Productsales_model->get_searchproductall($from, $to);    
            $creditprod = $this->Productsales_model->get_searchcreditproductall($from, $to);     
        }else {
            $prod = $this->Productsales_model->get_searchproduct($from, $to, $c);    
            $creditprod = $this->Productsales_model->get_searchcreditproduct($from, $to, $c);     
        }
        $cat = $this->Category_model->get_catactive(); 
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/reports/Productsales', array('cat' => $cat, 'creditprod' => $creditprod, 'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function printreport()
    {       
        $c = $this->input->post('c_no');
        $value1 = $this->input->post('from'); $from = date_format(date_create($value1), 'Y-m-d');
        $value2 = $this->input->post('to'); $to = date_format(date_create($value2), 'Y-m-d');  
        if($c == 'all') {
            $prod = $this->Productsales_model->get_searchproductall($from, $to);    
            $creditprod = $this->Productsales_model->get_searchcreditproductall($from, $to); 
            $sumprod = $this->Productsales_model->get_sumsalesall($from, $to);
            $sumcreditprod = $this->Productsales_model->get_sumcreditall($from, $to);
        }else {
            $prod = $this->Productsales_model->get_searchproduct($from, $to, $c);    
            $creditprod = $this->Productsales_model->get_searchcreditproduct($from, $to, $c);     
            $sumprod = $this->Productsales_model->get_searchsumsalesall($from, $to, $c);
            $sumcreditprod = $this->Productsales_model->get_searchsumcreditall($from, $to, $c);
        }
        $cat = $this->Category_model->get_catactive(); 
        $users = $this->Heading_model->user_det();   
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/print/productsales_print', array('sumprod' => $sumprod, 'sumcreditprod' => $sumcreditprod, 'to' => $value2, 'from' => $value1, 'cat' => $cat, 'cno' => $c, 'com' => $com, 'users' => $users, 'prod' => $prod, 'creditprod' => $creditprod));
      
    }
    
    //--------------------------------------------------------------------------
    
    public function excelprintreport()
    {       
         $c = $this->input->post('c_no');
        $value1 = $this->input->post('from'); $from = date_format(date_create($value1), 'Y-m-d');
        $value2 = $this->input->post('to'); $to = date_format(date_create($value2), 'Y-m-d');  
        if($c == 'all') {
            $prod = $this->Productsales_model->get_searchproductall($from, $to);    
            $creditprod = $this->Productsales_model->get_searchcreditproductall($from, $to); 
            $sumprod = $this->Productsales_model->get_sumsalesall($from, $to);
            $sumcreditprod = $this->Productsales_model->get_sumcreditall($from, $to);
        }else {
            $prod = $this->Productsales_model->get_searchproduct($from, $to, $c);    
            $creditprod = $this->Productsales_model->get_searchcreditproduct($from, $to, $c);     
            $sumprod = $this->Productsales_model->get_searchsumsalesall($from, $to, $c);
            $sumcreditprod = $this->Productsales_model->get_searchsumcreditall($from, $to, $c);
        }
        $cat = $this->Category_model->get_catactive(); 
        $users = $this->Heading_model->user_det();   
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/export_excel/productsales_print', array('sumprod' => $sumprod, 'sumcreditprod' => $sumcreditprod, 'to' => $value2, 'from' => $value1, 'cat' => $cat, 'cno' => $c, 'com' => $com, 'users' => $users, 'prod' => $prod, 'creditprod' => $creditprod));
      
    }
    
    //--------------------------------------------------------------------------
    
     
    
}
