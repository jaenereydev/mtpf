<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Expenses_model');
       
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
        $this->data['exp'] = $this->Expenses_model->get_expenses($this->session->userdata('id'));

        $this->render_html('expenses/expenses_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertexpenses()
    {                    
         $e = array(
            'date' =>  date_format(date_create($this->input->post('date')), 'Y/m/d'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'user_id' => $this->session->userdata('id')
        );
        $this->Expenses_model->insertexpenses($e);

        redirect('Expenses_con');
    }
    
    //--------------------------------------------------------------------------

    public function deleteexpenses($e)
    {                            
        $this->Expenses_model->deleteexpenses($e);

        redirect('Expenses_con');
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
