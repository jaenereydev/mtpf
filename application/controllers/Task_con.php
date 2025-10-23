<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Task_model');
       
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
        $this->data['task'] = $this->Task_model->get_task();
        $this->data['activeuser'] = $this->User_model->get_useractive();

        $this->render_html('task/task_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function inserttask()
    {                    
        $task = array(                        
            'description' => $this->input->post('description'),
            'schedule' => $this->input->post('schedule'),
            'schedule_date' => date_format(date_create($this->input->post('date')), 'Y/m/d'),
            'assign_user_id' => $this->input->post('assign'),
            'user_id' => $this->session->userdata('id'),
        );      
        $this->Task_model->inserttask($task);

        redirect('Task_con');
       
    }
    
    //--------------------------------------------------------------------------

    public function deletetask($t)
    {                           
        $this->Task_model->deletetask($t);

        redirect('Task_con');
       
    }
    
    //--------------------------------------------------------------------------

}
