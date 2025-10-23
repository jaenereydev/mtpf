<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');        
        $this->load->model('Company_model');                   
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------   
    
     public function user_det()
    {
        $user_id = $this->session->userdata('u_no');
        $users = $this->User_model->get_users($user_id);
        
        return $users;
    }
    
    //--------------------------------------------------------------------------   
    
    public function incwithsidebar()
    {
        $users = $this->user_det();
        $com = $this->Company_model->get_companyinfo();
        $hidebtn = '0';
        $this->load->view('inc/header_view', array('hidebtn' => $hidebtn, 'users' => $users, 'com' => $com));
        $this->load->view('inc/sidebar_view', array('hidebtn' => $hidebtn, 'users' => $users));
    }
    
    //--------------------------------------------------------------------------  
    
    public function inc()
    {
        $users = $this->user_det();
        $hidebtn = '0';
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inc/header_view', array('hidebtn' => $hidebtn, 'users' => $users, 'com' => $com));
    }
    
    //--------------------------------------------------------------------------    
    
    public function userview()
    {               
        $user = $this->User_model->get_useractive();        
        $users = $this->user_det();
        $this->incwithsidebar();
        $this->load->view('maintenance/user/user_view', array('users' => $users, 'user' => $user));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertuservar()
    {
        $fname = $this->input->post('firstname');$mname = $this->input->post('middlename');$lname = $this->input->post('lastname');
        $username = $this->input->post('username');$password = $this->input->post('password');$accesscode = $this->input->post('accesscode');
        $pos = $this->input->post('pos');$credit = $this->input->post('credit');$expenses = $this->input->post('expenses');
        $inventory = $this->input->post('inventory');$product = $this->input->post('product');$customer = $this->input->post('customer');
        $dashboard = $this->input->post('dashboard');$report = $this->input->post('report');$accounting = $this->input->post('accounting');        
        $maintenance = $this->input->post('maintenance');$user = $this->input->post('user');$supplier = $this->input->post('supplier');
        $accountpayable = $this->input->post('accountpayable');$accountreceivable = $this->input->post('accountreceivable');
        $receiving = $this->input->post('receiving');$ordering = $this->input->post('ordering');
        $status = 'ACTIVE'; $position = $this->input->post('position'); $poultry = $this->input->post('poultry'); $bt = $this->input->post('bt');
        $bank = $this->input->post('bank'); $loan = $this->input->post('loan'); $sp = $this->input->post('sp');
        
        $userinsert = array(
            'fname' => $fname, 'mname' => $mname, 'lname' => $lname,
            'username' => $username, 'password' => $password, 'accesscode' => $accesscode,
            'pos' => $pos, 'credit' => $credit, 'expenses' => $expenses,'supplier' => $supplier,
            'inventory' => $inventory, 'product' => $product, 'customer' => $customer,
            'dashboard' => $dashboard,'report' => $report, 'accounting' => $accounting, 'maintenance' => $maintenance, 'user' => $user,
            'accountpayable' => $accountpayable, 'accountreceivable' => $accountreceivable,'receiving' => $receiving, 'ordering' => $ordering,
            'status' => $status, 'position' => $position,'bank' => $bank, 'loan' => $loan, 'processing' => $sp, 'poultry' => $poultry, 'banktransaction' => $bt,
        );
        return $userinsert;
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertuser()
    {
        $userinsert = $this->insertuservar();
        $this->User_model->insert_user($userinsert);
        $this->userview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function userinfo($u_no)
    {
        $user = $this->User_model->get_users($u_no);             
        $this->incwithsidebar();
        $users = $this->user_det();
        $this->load->view('maintenance/user/updateuser', array('user' => $user, 'users' => $users));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function updateuser()
    {        
        $this->User_model->update_user();
        $this->userview();
        
    }
    
    //--------------------------------------------------------------------------  
    
     public function deluser($u_no)
    {        
        $this->User_model->updatedel_user($u_no);
        $this->userview();
        
    }
    
    //--------------------------------------------------------------------------  
    

}
