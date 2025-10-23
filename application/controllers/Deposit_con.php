<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deposit_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Deposit_model');
       
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
        $this->data['deposit'] = $this->Deposit_model->get_deposit($this->session->userdata('id'));

        $this->render_html('deposit/deposit_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertdeposit()
    {                    
         $d = array(
            'date' =>  date_format(date_create($this->input->post('date')), 'Y/m/d'),
            'amount' => $this->input->post('amount'),
            'user_id' => $this->session->userdata('id')
        );
        $this->Deposit_model->insertdeposit($d);

        redirect('Deposit_con');
    }
    
    //--------------------------------------------------------------------------

    public function deletedeposit($d)
    {                            
        $this->Deposit_model->deletedeposit($d);

        redirect('Deposit_con');
    }
    
    //--------------------------------------------------------------------------

    public function updateexpenses()
    {                    
         $exp = array(
            'date' =>  date_format(date_create($this->input->post('date')), 'Y/m/d'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'user_id' => $this->session->userdata('id')
        );
        $this->Expenses_model->updateexpenses($this->input->post('eno'),$exp);

        redirect('Expenses_con');
    }
    
    //--------------------------------------------------------------------------

}
