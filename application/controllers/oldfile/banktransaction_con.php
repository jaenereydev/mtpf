<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Banktransaction_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Banktransaction_model');           
        $this->load->model('Company_model');   
        $this->load->model('Heading_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function index()
    {               
        $bt = $this->Banktransaction_model->get_banktransaction();         
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();       
        $this->load->view('sidebar/banktransaction/banktransaction_view', array('users' => $users, 'bt' => $bt));      
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
     public function searchbt()
    {               
        $s = $this->input->post('search');
        $bt = $this->Banktransaction_model->get_searchbanktransaction($s);         
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();       
        $this->load->view('sidebar/banktransaction/banktransaction_view', array('users' => $users, 'bt' => $bt));      
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
        
    
    public function insertbt()
    {               
        $uno = $this->input->post('u_no');
        $value = $this->input->post('date'); $date = date_format(date_create($value), 'Y-m-d');
        $tn = $this->input->post('transno');
        $typ = $this->input->post('typ');
        $amount = $this->input->post('amount');
        $remarks = $this->input->post('remarks');
        $bno = "1";
        $bt = array('b_no' => $bno, 'u_no' => $uno, 'date' => $date, 'trans_no' => $tn, 'amount' => $amount, 'remarks' => $remarks, 'stat' => $typ);
        $this->Banktransaction_model->insert_bt($bt);                
        $this->index();
    }
    
    //--------------------------------------------------------------------------  
    
    public function delbt($bt)
    {                       
        $this->Banktransaction_model->delbt($bt);                
        $this->index();
    }
    
    //--------------------------------------------------------------------------  
    
    public function updatebt()
    {              
        $this->Banktransaction_model->update_bt();                
        $this->index();
    }
    
    //--------------------------------------------------------------------------  
    
    public function postbt($bt, $stat)
    {              
        $this->Banktransaction_model->post_bt($bt, $stat);                
        $this->index();
    }
    
    //--------------------------------------------------------------------------  
    
}
