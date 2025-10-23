<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Category_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Category_model');
        $this->load->model('Heading_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function categoryview()
    {               
        $cat = $this->Category_model->get_catactive();        
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('maintenance/category/cat_view', array('users' => $users, 'cat' => $cat));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertcatvar()
    {
        $description = $this->input->post('description');
        $u_no = $this->input->post('u_no');
        $status = 'ACTIVE';
        $catinsert = array(            
            'description' => $description, 
            'u_no' => $u_no, 
            'status' => $status,
        );
        return $catinsert;
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertcat()
    {
        $catinsert = $this->insertcatvar();
        $this->Category_model->insert_cat($catinsert);
        $this->categoryview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function catinfo($c_no)
    {
        $cat = $this->Category_model->get_categoryinfo($c_no);             
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        $this->load->view('maintenance/category/cat_update', array('cat' => $cat, 'users' => $users));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function updatecat()
    {        
        $this->Category_model->update_cat();
        $this->categoryview();        
    }
    
    //--------------------------------------------------------------------------  
    
     public function delcat($c_no, $u_no)
    {        
        $this->Category_model->updatedel_cat($c_no,$u_no);
        $this->categoryview();
        
    }
    
    //--------------------------------------------------------------------------  
    
}
