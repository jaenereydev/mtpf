<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Inventory_model');
        $this->load->model('Product_model');
        $this->load->model('Producthistory_model');
       
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
        $this->session->unset_userdata('ino');
        $this->data['inventory'] = $this->Inventory_model->get_inventory();

        $this->render_html('inventory/inventory_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertinventory()
    {                    
         $i = array(
            'date' => date('Y/m/d'),
            'user_id' => $this->session->userdata('id'),
        );
        $ino = $this->Inventory_model->insertinventory($i); // insert inverntory line    
        $this->session->set_userdata(['ino' => $ino]);

        redirect('Inventoryinfo_con');
    }
    
    //--------------------------------------------------------------------------

    public function inventoryinfo($i)
    { 
        $this->session->set_userdata(['ino' => $i]);
        redirect('Inventoryinfo_con');
    }
    
    // //--------------------------------------------------------------------------

    public function deleteinventory($i)
    {         
        $this->Inventory_model->deleteinventory($i);
        redirect('Inventory_con');
    }
    
    // //--------------------------------------------------------------------------

     public function postinventory($i)
    {         
        $inv = array(
            'post' => "YES"
        );
        $desc = "INVENTORY";
        $this->Inventory_model->updateinventory($i, $inv); //update inventory file to post

        $this->Producthistory_model->insert_inventoryproducthistory($i, $desc); //update product history

        $this->Product_model->updateinventoryproductqty($i); // update product qty

        redirect('Inventory_con');

    }
    
    // //--------------------------------------------------------------------------

}
