<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loan_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Loan_model');
        $this->load->model('Heading_model');
        $this->load->model('Customer_model');
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------         
    
    public function index()
    {               
        $l = $this->Loan_model->get_loan();   
        $c = $this->Customer_model->get_customeractive();
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/loan/loan_view', array('users' => $users, 'l' => $l, 'c' => $c));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function searchloan()
    {               
        $search = $this->input->post('search');
        if($search == null){
            $l = $this->Loan_model->get_searchallloan();
        }else {
            $l = $this->Loan_model->get_searchloan($search);
        }           
        $c = $this->Customer_model->get_customeractive();
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/loan/loan_view', array('users' => $users, 'l' => $l, 'c' => $c));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertloan()
    {               
        $cno = $this->input->post('c_no');        
        $uno = $this->input->post('u_no');
        $doc = $this->input->post('doc_no');
        $value = $this->input->post('date');
        $date = date_format(date_create($value), 'Y-m-d');
        $desc = $this->input->post('description');
        $amount = $this->input->post('amount');
        $remarks = $this->input->post('remarks');
        $loan = array ( 'description' => $desc, 'date' => $date, 'doc_no' => $doc,
            'u_no' => $uno, 'amount' => $amount, 'remarks' => $remarks, 'c_no' => $cno);
        $this->Loan_model->insertloan($loan);
        redirect('loan_con');
    }
    
    //--------------------------------------------------------------------------  
    
    public function postloan($l, $c)
    {                 
        $user = $this->session->userdata('u_no');
        $this->Loan_model->postloan($l, $user, $c);
        redirect('loan_con');
    }
    
    //--------------------------------------------------------------------------        
    
    public function updateloan()
    {                      
        $this->Loan_model->updateloan();
        redirect('loan_con');
    }
    
    //--------------------------------------------------------------------------  
    
    public function delloan($l)
    {                      
        $this->Loan_model->delloan($l);
        redirect('loan_con');
    }
    
    //--------------------------------------------------------------------------  
}
