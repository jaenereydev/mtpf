<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');        
        $this->load->model('Company_model'); 
        $this->load->model('Supplier_model'); 
        $this->load->model('Product_model'); 
        $this->load->model('Category_model'); 
        $this->load->model('Producthistory_model');
        $this->load->model('Heading_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }        
    
    public function productview()
    {                       
        $prod = $this->Product_model->get_productactive();
        $sup = $this->Supplier_model->get_supplieractive();
        $cat = $this->Category_model->get_catactive();
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        $this->load->view('sidebar/product/product_view', array('cat' => $cat, 'sup' => $sup, 'prod' => $prod, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertproductvar()
    {
        $longdesc = $this->input->post('longdesc');$shortdesc = $this->input->post('shortdesc');
        $qty = '0';$unitprice = $this->input->post('unitprice');
        $price1 = $this->input->post('price1');$price2 = $this->input->post('price2');$price3 = $this->input->post('price3');
        $price4 = $this->input->post('price4');$price5 = $this->input->post('price5');
        $price6 = $this->input->post('price6');$price7 = $this->input->post('price7');$price8 = $this->input->post('price8');
        $price9 = $this->input->post('price9');$price10 = $this->input->post('price10');$discountprice = $this->input->post('discountprice');        
        $c_no = $this->input->post('c_no');$s_no = $this->input->post('s_no');
        $type = $this->input->post('type');$uom = $this->input->post('uom');$packing = $this->input->post('packing');
        $status = 'ACTIVE';$u_no = $this->input->post('u_no');$unitcost = $this->input->post('unitcost');
        
        $prodinsert = array(
            'longdesc' => $longdesc,'shortdesc' => $shortdesc, 'qty' => $qty,
            'unitprice' => $unitprice, 'price1' => $price1,'price2' => $price2,
            'price3' => $price3,'price4' => $price4,'price5' => $price5,
            'price6' => $price6,'price7' => $price7,'price8' => $price8,
            'price9' => $price9,'price10' => $price10,'price11' => $discountprice,
            'c_no' => $c_no, 's_no' => $s_no, 'type' => $type, 'uom' => $uom, 'packing' => $packing,
            'status' => $status, 'u_no' => $u_no, 'unitcost' => $unitcost,
        );
        return $prodinsert;
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertproduct()
    {
        $productinsert = $this->insertproductvar();        
        $this->Product_model->insert_product($productinsert);
        $this->productview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function productinfo($p_no)
    {
        $prod = $this->Product_model->get_productinfo($p_no);
        $sup = $this->Supplier_model->get_supplieractive();
        $cat = $this->Category_model->get_catactive();
        $prodhist = $this->Producthistory_model->get_producthistory($p_no);
        $pc = $this->Product_model->get_pricechange($p_no);
        $activeTab = '1';
        
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        $this->load->view('sidebar/product/product_update', array('pc' => $pc, 'prodhist' => $prodhist, 'activeTab' => $activeTab, 'cat' => $cat, 'sup' => $sup, 'prod' => $prod, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function updateproduct()
    {        
        $this->Product_model->update_product();
        $this->productview();        
    }
    
    //--------------------------------------------------------------------------  
    
    public function delproduct($p_no, $u_no)
    {        
        $this->Product_model->updatedel_product($p_no, $u_no);
        $this->productview();        
    }
    
    //--------------------------------------------------------------------------  
    
    public function allproductprint()
    {                       
        $prod = $this->Product_model->get_allproductactive();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/product/report/print', array('com' => $com, 'prod' => $prod));          
    }
    
    //--------------------------------------------------------------------------  
    
    public function allproductprintexcel()
    {                       
        $prod = $this->Product_model->get_allproductactive();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/product/report/excelprint', array('com' => $com, 'prod' => $prod));          
    }
    
    //-------------------------------------------------------------------------- 
        
    public function printproductinfo($p_no)
    {
        $prod = $this->Product_model->get_productinfo($p_no);
        $prodhist = $this->Producthistory_model->get_producthistory($p_no);
        $pc = $this->Product_model->get_pricechange($p_no);        
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/product/report/productinfoprint', array('com' => $com, 'pc' => $pc, 'prodhist' => $prodhist, 'prod' => $prod));           
    }
    
    //--------------------------------------------------------------------------
    
     public function productinfoexcelprint($p_no)
    {
        $prod = $this->Product_model->get_productinfo($p_no);
        $prodhist = $this->Producthistory_model->get_producthistory($p_no);
        $pc = $this->Product_model->get_pricechange($p_no);        
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/product/report/productinfoexcelprint', array('com' => $com, 'pc' => $pc, 'prodhist' => $prodhist, 'prod' => $prod));           
    }
    
    //--------------------------------------------------------------------------
    
}
