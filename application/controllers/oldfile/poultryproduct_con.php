<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poultryproduct_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Poultryproduct_model');
        
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
    
    public function poultryview()
    {               
        $poul = $this->Poultryproduct_model->get_poultryactive();        
        $users = $this->user_det();
        $this->incwithsidebar();
        $this->load->view('poultry/poultryproduct/poultryproduct_view', array('users' => $users, 'poul' => $poul));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------   
    
    public function insertpoul()
    {
        $name = $this->input->post('name');
        $stat = "ACTIVE";
        $qty = "0";
        $poul = array('name' => $name, 'status' => $stat, 'qty' => $qty );
        $this->Poultryproduct_model->insert_poul($poul);
        $this->poultryview();
        
    }
    
    //--------------------------------------------------------------------------      
    
    public function updatepoul()
    {        
        $this->Poultryproduct_model->update_poul();
        $this->poultryview();        
    }
    
    //--------------------------------------------------------------------------  
    
     public function delpoul($pp_no)
    {        
        $this->Poultryproduct_model->updatedel_poul($pp_no);
        $this->poultryview();
        
    }
    
    //--------------------------------------------------------------------------  
    
}
