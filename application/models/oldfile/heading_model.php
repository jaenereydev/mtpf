<?php

class Heading_model extends CI_Model
{   
    
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
    
    public function inchide()
    {
        $users = $this->user_det();
        $hidebtn = '1';
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inc/header_view', array('hidebtn' => $hidebtn, 'users' => $users, 'com' => $com));
    }
    
    //--------------------------------------------------------------------------   
        
}