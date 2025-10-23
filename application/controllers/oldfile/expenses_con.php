<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Expenses_model');
        $this->load->model('Heading_model');
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------         
    
    public function expensesview()
    {               
        $exp = $this->Expenses_model->get_expenses();        
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/expenses/expenses_view', array('users' => $users, 'exp' => $exp));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertexpvar()
    {
        $description = $this->input->post('description');
        $u_no = $this->input->post('u_no');
        $docno = $this->input->post('docno');
        $amount = $this->input->post('amount');
        $typ = $this->input->post('typ');
        $remarks = $this->input->post('remarks');
        $value = $this->input->post('date'); $date = date_format(date_create($value), 'Y-m-d');      
        $expinsert = array(            
            'description' => $description, 
            'user' => $u_no, 
            'doc_no' => $docno,
            'amount' => $amount,
            'remarks' => $remarks,
            'date' => $date,
            'type' => $typ
        );
        return $expinsert;
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertexpenses()
    {
        $expinsert = $this->insertexpvar();
        $this->Expenses_model->insert_exp($expinsert);
        $this->expensesview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function searchexp()
    {        
        $search = $this->input->post('search');                
        $exp = $this->Expenses_model->get_searchexp($search);      
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/expenses/expenses_view', array('users' => $users, 'exp' => $exp));
        $this->load->view('inc/footer_view');       
    }
    
    //-------------------------------------------------------------------------- 
    
    public function updateexp()
    {        
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Expenses_model->update_exp($u_no);
        $this->expensesview();        
    }
    
    //-------------------------------------------------------------------------- 
    
     public function delexp($eno)
    {        
        $this->Expenses_model->del_exp($eno);
        $this->expensesview();
        
    }
    
    //--------------------------------------------------------------------------  
    
}
