<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Customer_model');
        $this->load->model('Product_model');
        $this->load->model('Delivery_model');
        $this->load->model('Duedate_model');
        $this->load->model('Sales_model');
        $this->load->model('Creditloan_model');
        $this->load->model('Repayment_model');
        $this->load->model('Creditpayment_model');
        $this->load->model('Dashboard_model');

        $this->user = $this->User_model->get_users( $this->session->userdata('id'));
        $this->active = "1";
        $this->open = "1";
        $this->data = [
            'users' => $this->user,
            'hidebtn' => 0,
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

        $this->data['productcount']       = $this->Dashboard_model->productcount();
        $this->data['totalproductqty']    = $this->Dashboard_model->totalproductqty();
        $this->data['lowstockcount']      = $this->Dashboard_model->lowstockcount();
        $this->data['negativestockcount'] = $this->Dashboard_model->negativestockcount();

        $this->data['production_today'] = $this->Dashboard_model->production_today();
        $this->data['production_week']  = $this->Dashboard_model->production_week();
        $this->data['production_month'] = $this->Dashboard_model->production_month();

        $this->data['donation_month']   = $this->Dashboard_model->donation_month();
        $this->data['reclassify_month'] = $this->Dashboard_model->reclassify_month();

        $this->data['production_chart'] = $this->Dashboard_model->production_last_7_days();

        $this->data['lowstockproducts'] = $this->Dashboard_model->lowstockproducts();
        $this->data['product_movement'] = $this->Dashboard_model->product_movement_this_month();

        $this->data['cash_sales_today']     = $this->Dashboard_model->cash_sales_today();
        $this->data['cash_sales_month']     = $this->Dashboard_model->cash_sales_month();
        $this->data['credit_sales_month']   = $this->Dashboard_model->credit_sales_month();
        $this->data['credit_payment_month'] = $this->Dashboard_model->credit_payment_month();
        $this->data['expenses_month']       = $this->Dashboard_model->expenses_month();
        $this->data['total_sales_month']    = $this->Dashboard_model->total_sales_month();
        $this->data['credit_balance']       = $this->Dashboard_model->credit_balance();
        $this->data['net_cash_month']       = $this->Dashboard_model->net_cash_month();

        $this->render_html('dashboard/dashboard_view', true);
    }
    
    //--------------------------------------------------------------------------
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    
    //--------------------------------------------------------------------------
    
}
