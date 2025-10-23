<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Duedate_con extends MY_Controller
{
    //--------------------------------------------------------------------------
     
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Duedate_model');
       
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
        $this->data['dd'] = $this->Duedate_model->get_duedate();
        $this->render_html('sales/duedate_view', true); 
    }
    
    //--------------------------------------------------------------------------  

    public function duedateinfo($t,$c)
    {                    
        $this->data['c'] = $this->Duedate_model->get_creditduedateinfo($c);
        $this->data['t'] = $this->Duedate_model->get_transaction($t);
        $this->data['tl'] = $this->Duedate_model->get_transactionline($t);

        $this->render_html('sales/duedateinfo_view', true); 
    }
    
    //--------------------------------------------------------------------------        

}
