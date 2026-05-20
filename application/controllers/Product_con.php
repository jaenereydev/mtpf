<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_con extends MY_Controller
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
        $this->data['prod'] = null;
        $this->productheader();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function productheader()
    {
        $this->session->unset_userdata('product');
        $this->data['product'] = $this->Product_model->countproduct(); 
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();
        $this->data['productcount'] = $this->Product_model->productcount();
        $this->data['categorycount'] = $this->Product_model->categorycount();
        $this->data['suppliercount'] = $this->Product_model->suppliercount();
        $this->data['totalproductqty'] = $this->Product_model->totalproductqty();

    }


     //--------------------------------------------------------------------------

    public function productsave()
    {                    
        $this->data['prod'] = null;
        $this->productheader();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------


    public function insertsuccess()
    {                    
        $this->data['prod'] = null;
        $this->productheader();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function productsearch()
    {                    
        $this->data['prod'] = $this->Product_model->get_productsearch($this->input->post('psearch'));
        $this->productheader();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------


    public function productunitcost()
    {                    
        $this->data['prod'] = $this->Product_model->get_allproductwithoutunitcost();
        $this->productheader();
        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function productwithnegativequantity()
    {                    
        $this->data['prod'] = $this->Product_model->get_allproductwithnegativequantity();
        $this->productheader();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------


    public function get_allproduct()
    {                    
        $this->data['prod'] = $this->Product_model->get_product();
        $this->productheader();

        $product = $this->Product_model->get_product();
        if ($product) {
            $this->session->set_flashdata('success', 'Showing all product.');
        } else {
            $this->session->set_flashdata('error', 'Failed to display all product.');
        }

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertproduct()
    {                    
        
        $p = array(
            'name' => $this->input->post('name'),
            'unitcost' => $this->input->post('unitcost'),
            'qty' => '0',
            'srpprice' => $this->input->post('price1'),
            'price2' => $this->input->post('price2'),
            'price3' => $this->input->post('price3'),        
            'active' => 'YES',
            'user_id' => $this->session->userdata('id'),
            'supplier_s_no' => $this->input->post('sno'),    
            'category_c_no' => $this->input->post('cno'),  
            'inventory' => $this->input->post('ti'),  
        );
        $product = $this->Product_model->insertproduct($p);

        if ($product) {
            $this->session->set_flashdata('success', 'New product added.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add new product.');
        }
        

        redirect('product_con/insertsuccess');
        
    }
    
    //--------------------------------------------------------------------------

    public function delproduct($p)
    {                    
        $prod = array(            
            'active' => 'NO',
            'user_id' => $this->session->userdata('id')            
        );
        $product = $this->Product_model->updateproduct($p, $prod);

        if ($product) {
            $this->session->set_flashdata('success', 'Product is deleted.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete the product.');
        }

        redirect('product_con');
    }
    
    //--------------------------------------------------------------------------

    public function productinfo($p)
    {                            
        $this->session->set_userdata(['product' => $p]);  
        redirect('productinfo_con');
    }
    
    //--------------------------------------------------------------------------        

}
