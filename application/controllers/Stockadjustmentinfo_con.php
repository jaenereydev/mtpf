<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stockadjustmentinfo_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Product_model');
        $this->load->model('Producthistory_model');
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
        $this->data['prod'] = $this->Product_model->get_product(); //product list     
        $this->data['stockadjustmentinfo'] = $this->Stockadjustment_model->get_stockadjustmentinfo($this->session->userdata('sano'));
        $this->data['stockadjustmentline'] = $this->Stockadjustment_model->get_stockadjustmentline($this->session->userdata('sano'));
        $this->data['sa'] = $this->Stockadjustment_model->get_countstockadjustmentline($this->session->userdata('sano')); // stock adjustmentline list

        $this->render_html('stockadjustment/stockadjustmentinfo_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertstockadjustmentline()
    { 
        $lotnumber = $this->Product_model->productlothistoryinfo($this->input->post('lot_number'));
        $sal = array(
            'lot_number' => $lotnumber[0]->lot_number,
            'expiration_date' => $lotnumber[0]->expiration_date,
            'plh_number' => $lotnumber[0]->plh_number,
            'unit_cost' => $lotnumber[0]->unit_cost,
            'qty' => $this->input->post('qty'),
            'product_p_no' => $lotnumber[0]->product_p_no,
            'sa_no' => $this->session->userdata('sano'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Stockadjustment_model->insertstockadjustmentline($sal); // insert stock adjustment line    
        redirect('Stockadjustmentinfo_con');
    }
    
    //--------------------------------------------------------------------------

    public function updatestatus()
    {
        $status = $this->input->post('status');
        $sa_no = $this->input->post('sa_no');

        $this->db->where('sa_no', $sa_no);
        $this->db->update('stockadjustment', ['status' => $status]);
        
        echo json_encode(['success' => true]);
    }
    
    //--------------------------------------------------------------------------

    public function deletestockadjustmentline($sa)
    {         
        $this->Stockadjustment_model->deletestockadjustmentline($sa);
        redirect('Stockadjustmentinfo_con');
    }
    
    //--------------------------------------------------------------------------

    public function poststockadjustment()
    {         
        $sa = array(
            'post' => "YES"
        );
        
        $this->Stockadjustment_model->updatestockadjustment($sa); //update adjustment file to post
        $desc = "ADJUSTMENT";
        if($this->input->post('status') == '+'){
            $this->Producthistory_model->insert_stockadjustmentproducthistorypositive($desc); //update product history

            $this->Product_model->updatestockadjustmentproductlothistoryremainingquantity('positive'); //update product lot history

        }else {
            $this->Producthistory_model->insert_stockadjustmentproducthistorynegative($desc); //update product history
            $this->Product_model->updatestockadjustmentproductlothistoryremainingquantity('negative'); //update product lot history
        }
        

        redirect('Stockadjustment_con');

    }
    
    //--------------------------------------------------------------------------

}
