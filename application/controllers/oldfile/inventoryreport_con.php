<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Inventoryreport_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Inventoryreport_model');        
        $this->load->model('Heading_model'); 
        $this->load->model('Category_model'); 
        $this->load->model('Supplier_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function index()
    {                       
        $sup = $this->Supplier_model->get_supplieractive();
        $cat = $this->Category_model->get_catactive();
        $prod = $this->Inventoryreport_model->get_productall(); 
        $sumprod = $this->Inventoryreport_model->get_sumproductall(); 
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/reports/Inventoryreport', array('sumprod' => $sumprod, 'sup' => $sup, 'cat' => $cat, 'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function search()
    {   
        $sno = $this->input->post('s_no');
        $cno = $this->input->post('c_no');
        $sup = $this->Supplier_model->get_supplieractive();
        $cat = $this->Category_model->get_catactive();
        if(($sno == "all")&&($cno == "all")) {
            $prod = $this->Inventoryreport_model->get_productall(); 
            $sumprod = $this->Inventoryreport_model->get_sumproductall(); 
        }else if (($sno == "all")&&($cno != "all")) {
            $prod = $this->Inventoryreport_model->get_productcat($cno); 
            $sumprod = $this->Inventoryreport_model->get_sumproductcat($cno);
        }else if (($sno != "all")&&($cno == "all")) {
            $prod = $this->Inventoryreport_model->get_productsup($sno); 
            $sumprod = $this->Inventoryreport_model->get_sumproductsup($sno);
        }else if (($sno != "all")&&($cno != "all")) {
            $prod = $this->Inventoryreport_model->get_product($sno, $cno); 
            $sumprod = $this->Inventoryreport_model->get_sumproduct($sno, $cno);
        }
        
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/reports/Inventoryreport', array('sumprod' => $sumprod, 'sup' => $sup, 'cat' => $cat, 'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function printreport()
    {   
        $sno = $this->input->post('s_no');
        $cno = $this->input->post('c_no');
        $sup = $this->Supplier_model->get_supplieractive();
        $cat = $this->Category_model->get_catactive();
        if(($sno == "all")&&($cno == "all")) {
            $prod = $this->Inventoryreport_model->get_productall(); 
            $sumprod = $this->Inventoryreport_model->get_sumproductall(); 
        }else if (($sno == "all")&&($cno != "all")) {
            $prod = $this->Inventoryreport_model->get_productcat($cno); 
            $sumprod = $this->Inventoryreport_model->get_sumproductcat($cno);
        }else if (($sno != "all")&&($cno == "all")) {
            $prod = $this->Inventoryreport_model->get_productsup($sno); 
            $sumprod = $this->Inventoryreport_model->get_sumproductsup($sno);
        }else if (($sno != "all")&&($cno != "all")) {
            $prod = $this->Inventoryreport_model->get_product($sno, $cno); 
            $sumprod = $this->Inventoryreport_model->get_sumproduct($sno, $cno);
        }
        
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/print/inventoryreport_print', array('sno' => $sno, 'cno' => $cno, 'com' => $com, 'sumprod' => $sumprod, 'sup' => $sup, 'cat' => $cat, 'users' => $users, 'prod' => $prod));
   
    }
    
    //--------------------------------------------------------------------------
    
    public function excelprintreport()
    {   
        $sno = $this->input->post('s_no');
        $cno = $this->input->post('c_no');
        $sup = $this->Supplier_model->get_supplieractive();
        $cat = $this->Category_model->get_catactive();
        if(($sno == "all")&&($cno == "all")) {
            $prod = $this->Inventoryreport_model->get_productall(); 
            $sumprod = $this->Inventoryreport_model->get_sumproductall(); 
        }else if (($sno == "all")&&($cno != "all")) {
            $prod = $this->Inventoryreport_model->get_productcat($cno); 
            $sumprod = $this->Inventoryreport_model->get_sumproductcat($cno);
        }else if (($sno != "all")&&($cno == "all")) {
            $prod = $this->Inventoryreport_model->get_productsup($sno); 
            $sumprod = $this->Inventoryreport_model->get_sumproductsup($sno);
        }else if (($sno != "all")&&($cno != "all")) {
            $prod = $this->Inventoryreport_model->get_product($sno, $cno); 
            $sumprod = $this->Inventoryreport_model->get_sumproduct($sno, $cno);
        }
        
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/export_excel/inventoryreport_print', array('sno' => $sno, 'cno' => $cno, 'com' => $com, 'sumprod' => $sumprod, 'sup' => $sup, 'cat' => $cat, 'users' => $users, 'prod' => $prod));
   
    }
    
    //--------------------------------------------------------------------------
    
    
    
     
    
}
