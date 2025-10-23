<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Supplier_model');
       
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
        $this->data['sup'] = $this->Supplier_model->get_supplier();

        $this->render_html('product/supplier_view', true); 
    }
    
    //--------------------------------------------------------------------------
       
    public function insertsupplier()
    {                    
         $sup = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'salesman' => $this->input->post('salesman'),
            'terms' => $this->input->post('terms'),
            'user_id' => $this->session->userdata('id'),
            'active' => 'YES'
        );
        $this->Supplier_model->insertsupplier($sup);

        redirect('supplier_con');
    }
    
    //--------------------------------------------------------------------------    

    public function updatesupplier()
    {                    
         $sup = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'salesman' => $this->input->post('salesman'),
            'terms' => $this->input->post('terms'),
            'user_id' => $this->session->userdata('id'),
            'active' => 'YES'
        );
        $this->Supplier_model->updatesupplier($this->input->post('sno'), $sup);

        redirect('supplier_con');
    }
    
    //--------------------------------------------------------------------------    
    
    public function delsupplier($s)
    {                                
       $sup = array(            
            'user_id' => $this->session->userdata('id'),
            'active' => 'NO'
        );
        $this->Supplier_model->updatesupplier($s, $sup);
        redirect('supplier_con');
    }
    
    //--------------------------------------------------------------------------

}
