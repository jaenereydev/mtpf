<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Bank_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Bank_model');   
        $this->load->model('Company_model');   
        $this->load->model('Heading_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function viewa()
    {               
        $bank = $this->Bank_model->get_bank();   
        $bankhist = $this->Bank_model->get_bankhistory();   
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        if($bank == null) {
            $this->load->view('maintenance/bank/bank_view', array('users' => $users, 'bank' => $bank, 'bh' => $bankhist));
        }else {
            $this->load->view('maintenance/bank/bank_update', array('users' => $users, 'bank' => $bank, 'bh' => $bankhist));
        }        
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertbank()
    {                       
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $bal = $this->input->post('bal');              
        $bank = array('bankname' => $name, 'address' => $address, 'currentbal' => $bal);
        $this->Bank_model->insert_bank($bank);  
        $this->viewa();
    }
    
    //--------------------------------------------------------------------------  
    
    public function updatebank()
    {       
        $this->Bank_model->update_bank();
        $this->viewa();
    }
    
    //--------------------------------------------------------------------------  
    
    public function printreport()
    {       
        $bank = $this->Bank_model->get_bank();   
        $bankhist = $this->Bank_model->get_bankhistory();   
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('maintenance/bank/report/print', array('com' => $com, 'users' => $users, 'bank' => $bank, 'bh' => $bankhist));
    }
    
    //--------------------------------------------------------------------------  
    
     public function excelprintreport()
    {       
        $bank = $this->Bank_model->get_bank();   
        $bankhist = $this->Bank_model->get_bankhistory();   
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('maintenance/bank/report/excelprint', array('com' => $com, 'users' => $users, 'bank' => $bank, 'bh' => $bankhist));
    }
    
    //--------------------------------------------------------------------------  
    
    
}
