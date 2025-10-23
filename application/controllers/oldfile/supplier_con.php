<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');        
        $this->load->model('Company_model'); 
        $this->load->model('Supplier_model'); 
        $this->load->model('Heading_model');
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
       
    
    public function supplierview()
    {                       
        $sup = $this->Supplier_model->get_supplieractive();
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        $this->load->view('sidebar/supplier/supplier_view', array('sup' => $sup, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertsuppliervar()
    {
        $name = $this->input->post('name');$address= $this->input->post('address');$telno = $this->input->post('telno');
        $salesman = $this->input->post('salesman');$terms = $this->input->post('terms');$discount1 = $this->input->post('discount1');
        $email = $this->input->post('email');$contactno = $this->input->post('contactno');$discount2 = $this->input->post('discount2');
        $status = 'ACTIVE';$u_no = $this->input->post('u_no');
        
        $supinsert = array(
            'name' => $name, 'address' => $address, 'telno' => $telno,
            'salesman' => $salesman, 'terms' => $terms, 'discount1' => $discount1,
            'email' => $email, 'contactno' => $contactno, 'discount2' => $discount2,
            'status' => $status, 'u_no' => $u_no,
        );
        return $supinsert;
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertsupplier()
    {
        $supplierinsert = $this->insertsuppliervar();
        $this->Supplier_model->insert_supplier($supplierinsert);
        $this->supplierview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function supplierinfo($s_no)
    {
        $sup = $this->Supplier_model->get_supplierinfo($s_no);             
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        $this->load->view('sidebar/supplier/supplier_update', array('sup' => $sup, 'users' => $users));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function updatesupplier()
    {        
        $this->Supplier_model->update_supplier();
        $this->supplierview();
        
    }
    
    //--------------------------------------------------------------------------  
    
     public function delsupplier($s_no, $u_no)
    {        
        $this->Supplier_model->updatedel_supplier($s_no, $u_no);
        $this->supplierview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function allsupplierprint()
    {                       
        $sup = $this->Supplier_model->get_supplieractive();
        $com = $this->Company_model->get_companyinfo();
        $users = $this->Heading_model->user_det();
        $this->load->view('sidebar/supplier/report/print', array('com' => $com, 'sup' => $sup, 'users' => $users));   
    }
    
    //--------------------------------------------------------------------------  
    
    public function allsupplierprintexcel()
    {                       
        $sup = $this->Supplier_model->get_supplieractive();
        $com = $this->Company_model->get_companyinfo();
        $users = $this->Heading_model->user_det();
        $this->load->view('sidebar/supplier/report/excelprint', array('com' => $com, 'sup' => $sup, 'users' => $users));   
    }
    
    //--------------------------------------------------------------------------  
    
}
