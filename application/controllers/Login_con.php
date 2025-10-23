<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_con extends CI_Controller
{
    
    //--------------------------------------------------------------------------

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    //----------------------------s----------------------------------------------
    
    function Dashboard() {
        parent::CI_Controller();
        $this->load->model('User_model');
    }
    
    //--------------------------------------------------------------------------    

    
    public function login()
    {       
        $login = $this->input->post('username');
        $password = $this->input->post('password');
        
        $this->load->model('User_model');
        $result = $this->User_model->get([
            'username' => $login, 
            'password' => $password
        ]);
        
        $this->output->set_content_type('application_json');
        
        if($result) {
            $this->session->set_userdata(['id' => $result[0]['id']]);    

            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        
        $this->output->set_output(json_encode(['result' => 0]));
    }
    
    //--------------------------------------------------------------------------
    
}

