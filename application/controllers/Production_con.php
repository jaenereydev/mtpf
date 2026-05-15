<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Production_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Product_model');
        $this->load->model('Production_model');

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
        $this->session->unset_userdata('prodno');
        $this->data['production'] = $this->Production_model->get_productionlist();


        $this->render_html('production/production_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function get_buildinglist()
    {
        $data = $this->Production_model->get_building();
        echo json_encode($data);
    }

  //--------------------------------------------------------------------------

}
