<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Building_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Building_model');
        $this->load->model('Heading_model');
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------       
    
    public function buildingview()
    {               
        $b = $this->Building_model->get_buildingactive();        
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('poultry/building/building_view', array('users' => $users, 'b' => $b));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertbuildvar()
    {
        $bno = $this->input->post('buildingno');
        $bname = $this->input->post('buildingname');
        $status = 'ACTIVE';
        $qty = '0';
        $type = $this->input->post('type');
        $capacity = $this->input->post('capacity');
        $age = '0';
        $binsert = array(            
            'building_no' => $bno, 
            'buildingname' => $bname, 
            'status' => $status,
            'qty' => $qty,
            'type' => $type,
            'capacity' => $capacity,
            'chickenage' => $age,
        );
        return $binsert;
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertbuilding()
    {
        $buildinsert = $this->insertbuildvar();
        $this->Building_model->insert_building($buildinsert);
        $this->buildingview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function buildinginfo($b_no)
    {
        $b = $this->Building_model->get_buildinginfo($b_no);             
        $this->Heading_model->incwithsidebar();
        $users = $this->user_det();
        $this->load->view('poultry/building/building_update', array('b' => $b, 'users' => $users));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------   
    
}
