<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customercategory_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Category_model');
       
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
        $this->data['cat'] = $this->Category_model->get_customercategory();

        $this->render_html('customer/category_view', true); 
    }
    
    //--------------------------------------------------------------------------
       
    public function insertcategory()
    {                    
         $cat = array(
            'name' => $this->input->post('name'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Category_model->insertcustomercategory($cat);

        redirect('Customercategory_con');
    }
    
    //--------------------------------------------------------------------------

    public function updatecategory()
    {                                
        $cat = array(
            'name' => $this->input->post('name'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Category_model->updatecustomercategory($this->input->post('cno'), $cat);

       redirect('Customercategory_con');
    }
    
    //--------------------------------------------------------------------------
    
    public function delcategory($c)
    {                                        
        $this->Category_model->updatecustomercategoryno($c);
        $this->Category_model->deletecustomercategory($c);
        redirect('Customercategory_con');
    }
    
    //--------------------------------------------------------------------------

}
