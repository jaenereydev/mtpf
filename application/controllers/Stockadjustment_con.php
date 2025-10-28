<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stockadjustment_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Product_model');
        $this->load->model('Stockadjustment_model');

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
        $this->session->unset_userdata('sano');
        $this->data['stockadjustment'] = $this->Stockadjustment_model->get_stockadjustmentlist();

        $this->render_html('stockadjustment/stockadjustment_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertstockadjustment()
    { 
        $sa = array(
            'date' => date('Y/m/d'),
            'user_id' => $this->session->userdata('id'),
        );
        $sano = $this->Stockadjustment_model->insertstockadjustment($sa); // insert inverntory line    
        $this->session->set_userdata(['sano' => $sano]);
        redirect('Stockadjustmentinfo_con');
    }
    
    //--------------------------------------------------------------------------

    public function stockadjustmentinfo($sa)
    { 
        $this->session->set_userdata(['sano' => $sa]);
        redirect('Stockadjustmentinfo_con');
    }
    
    //--------------------------------------------------------------------------

    public function deletestockadjustment($sa)
    {         
        $this->Stockadjustment_model->deletestockadjustment($sa);
        redirect('Stockadjustment_con');
    }
    
    //--------------------------------------------------------------------------

}
