<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deliveryinfo_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Delivery_model');
        $this->load->model('Supplier_model');
        $this->load->model('Product_model');
    
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
        if($this->session->userdata('dno') == null){
            redirect('delivery_con');
        }else {                 
            $this->data['del'] = $this->Delivery_model->get_deliveryinfo($this->session->userdata('dno'));
            $this->data['delline'] = $this->Delivery_model->get_deliveryline($this->session->userdata('dno'));
            $this->data['sup'] = $this->Supplier_model->get_supplier();     
            $this->data['prod'] = $this->Product_model->get_product();     

            $this->render_html('delivery/deliveryinfo_view', true); 
        }
    }
    
    //--------------------------------------------------------------------------
    
    public function changesupplier($s)
    {                    
        $del = array(
            'supplier_s_no' => $s,
            'user_id' => $this->session->userdata('id')         
        );
        $this->Delivery_model->updatedelivery($this->session->userdata('dno'), $del);       
        redirect('Deliveryinfo_con');
    }
    
    // //--------------------------------------------------------------------------

    public function insertdeliveryline()
    {                    
        $dl = array(
            'unitcost' => $this->input->post('unitcost'),
            'qty' => $this->input->post('qty'),
            'discount' => '0',
            'price' => $this->input->post('unitcost')*$this->input->post('qty'),
            'delivery_d_no' => $this->session->userdata('dno'),  
            'product_p_no' => $this->input->post('pno')
        );
        $this->Delivery_model->insertdeliveryline($dl);               
        $this->getsumdeliveryline($this->session->userdata('dno'));
        redirect('Deliveryinfo_con');
    }
    
    // //--------------------------------------------------------------------------

    public function updatedeliveryline()
    {                    
        $dl = array(
            'unitcost' => $this->input->post('unitcost'),
            'qty' => $this->input->post('qty'),
            'discount' => '0',
            'price' => $this->input->post('unitcost')*$this->input->post('qty')
        );
        $this->Delivery_model->updatedeliveryline( $this->input->post('dlno'),$dl);    

        $this->getsumdeliveryline($this->session->userdata('dno'));
        redirect('Deliveryinfo_con');
    }
    
    // //--------------------------------------------------------------------------

    public function updatediscount()
    {      
        $ta = $this->Delivery_model->get_sumdeliveryline($this->session->userdata('dno'));
        $a = $ta[0]->ta;
        $t = $a-$this->input->post('discount');
        $d = array(
                'discount' => $this->input->post('discount'),
                'totalamount' => $t
            );
        $this->Delivery_model->updatedelivery($this->session->userdata('dno'),$d);    
        
        redirect('Deliveryinfo_con');
    }
    
    // //--------------------------------------------------------------------------

    public function getsumdeliveryline($d)
    {                    
        $sumdl = $this->Delivery_model->get_sumdeliveryline($d);
        $dis = $this->Delivery_model->get_deliveryinfo($this->session->userdata('dno')); 
        $ta = $sumdl[0]->ta-$dis[0]->discount;
        $del = array(
            'totalamount' => $ta,
            'user_id' => $this->session->userdata('id')         
        );
        $this->Delivery_model->updatedelivery($d, $del);       
    }
    
    // //--------------------------------------------------------------------------

    public function updatedelivery()
    {            
        $del = array(
            'date' => date_format(date_create($this->input->post('date')), 'Y/m/d'),
            'ref_no' => $this->input->post('refno'),
            'remarks' => $this->input->post('remarks')         
        );
        $this->Delivery_model->updatedelivery($this->session->userdata('dno'), $del);
        redirect('Deliveryinfo_con');      
    }
    
    // //--------------------------------------------------------------------------
    
    public function deletedeliveryline($dl)
    {                                      
        $this->Delivery_model->deletedeliveryline($dl);
        redirect('Deliveryinfo_con');
    }
    
    //--------------------------------------------------------------------------

}
