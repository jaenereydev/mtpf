<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
       
        $this->user = $this->User_model->get_users( $this->session->userdata('id'));
        $this->com = $this->Company_model->get_companyinfo();
        $this->active = "1";
        $this->open = "1";
        $this->data = [
            'users' => $this->user,
            'hidebtn' => 0,
            'com' => $this->com,
            'active' => $this->active,
            'open' => $this->open
        ];

        
        $user_id = $this->session->userdata('id');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------                   
    
    public function index()
    {                    
        $this->data['u'] = $this->User_model->get_useractive();

        $this->render_html('setup/user_view', true); 
    }
    
    //--------------------------------------------------------------------------

     public function insertuser()
    {                    
         $u = array(
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'position' => $this->input->post('position'),
            'percentage' => $this->input->post('percentage'),
            'collectable_commission' => "0",
            'uncollectable_commission' => "0",
            'status' => "ACTIVE",
        );
        $this->User_model->insert_user($u);

        redirect('User_con');
    }
    
    //--------------------------------------------------------------------------

    public function updateuser()
    {                    
         $u = array(
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'position' => $this->input->post('position'),
            'percentage' => $this->input->post('percentage'),
        );
        $this->User_model->updateuser($this->input->post('uno'),$u);

        redirect('User_con');
    }
    
    //--------------------------------------------------------------------------

    public function deleteuser($uno)
    {                    
         $u = array(           
            'status' => "DEACTIVATED"
        );
        $this->User_model->updateuser($uno,$u);

        redirect('User_con');
    }
    
    //--------------------------------------------------------------------------

}
