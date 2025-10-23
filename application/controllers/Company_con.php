<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_con extends CI_Controller
{
   
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Company_model');
        $this->load->helper('form', 'url');
    }
    
    //--------------------------------------------------------------------------
    
    public function index()
    {
        $com = $this->Company_model->get_companyinfo();       
        $error = null;
        $this->load->view('setup/companysetup', array('com'=>$com, 'error' => $error));
    }
    
    //--------------------------------------------------------------------------    
    
    public function updatecompany()
    {
        $c_no = $this->input->post('c_no');
        $companyname = $this->input->post('companyname');
        $address = $this->input->post('address');
        $telno = $this->input->post('telno');
        
        if(empty($c_no))
        {
            $companyprof = array (
                'name' => $companyname,
                'address' => $address,
                'telno' => $telno,
            );
            $this->Company_model->insert_company($companyprof);
            $com = $this->Company_model->get_companyinfo();    
            $this->load->view('setup/companysetup', array('com'=>$com));
        }else 
        {
            $this->Company_model->update_company();
            $com = $this->Company_model->get_companyinfo();    
            $this->load->view('setup/companysetup', array('com'=>$com));
        }                
    }
    
    
}
