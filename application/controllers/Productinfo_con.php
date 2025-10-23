<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productinfo_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Supplier_model');
        $this->load->model('Category_model');
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

        if($this->session->userdata('product') == null){
            redirect('product_con');
        }else {      
            $this->data['prod'] = $this->Product_model->productinfo($this->session->userdata('product'));
            $this->data['prodhistory'] = $this->Product_model->producthistoryinfo($this->session->userdata('product'));

            $this->data['sup'] = $this->Supplier_model->get_supplier();
            $this->data['cat'] = $this->Category_model->get_category();

            $this->render_html('product/productinfo_view', true); 
        }
    }
    
    //--------------------------------------------------------------------------

    public function updateproductcategory()
    {                    
         $prod = array(            
            'category_c_no' => $this->input->post('cno'),
            'user_id' => $this->session->userdata('id'),                    
        );
        $this->Product_model->updateproduct($this->session->userdata('product'), $prod);

        redirect('productinfo_con');
    }
    
    //--------------------------------------------------------------------------

    public function updateproductsupplier()
    {                    
         $prod = array(            
            'supplier_s_no' => $this->input->post('sno'),
            'user_id' => $this->session->userdata('id'),                    
        );
        $this->Product_model->updateproduct($this->session->userdata('product'), $prod);

        redirect('productinfo_con');
    }
    
    //--------------------------------------------- -----------------------------

    public function updateproduct()
    {                    
         $p = array(        
            'name' => $this->input->post('name'),
            'unitcost' => $this->input->post('unitcost'),            
            'srpprice' => $this->input->post('price1'),
            'price2' => $this->input->post('price2'),
            'price3' => $this->input->post('price3'),                    
            'user_id' => $this->session->userdata('id'),
            'inventory' => $this->input->post('ti'),           
        );
        $this->Product_model->updateproduct($this->session->userdata('product'),$p);

        redirect('product_con/productsave');
    }
    
    //--------------------------------------------------------------------------

}
