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
        $date_from = $this->input->get('date_from');
        $date_to   = $this->input->get('date_to');

        if (empty($date_from)) {
            $date_from = date('Y/m/01');
        } else {
            $date_from = date('Y/m/d', strtotime($date_from));
        }

        if (empty($date_to)) {
            $date_to = date('Y/m/t');
        } else {
            $date_to = date('Y/m/d', strtotime($date_to));
        }
        $this->data['date_from'] = $date_from;
        $this->data['date_to']   = $date_to;


        $this->data['productcount']       = $this->Dashboard_model->productcount();
        $this->data['totalproductqty']    = $this->Dashboard_model->totalproductqty();
        $this->data['lowstockcount']      = $this->Dashboard_model->lowstockcount();
        $this->data['negativestockcount'] = $this->Dashboard_model->negativestockcount();

        $this->data['production_today'] = $this->Dashboard_model->production_today();
        $this->data['production_week']  = $this->Dashboard_model->production_week();

        $this->data['production_period'] = $this->Dashboard_model->production_period($date_from, $date_to);

        $this->data['cash_sales_period']     = $this->Dashboard_model->cash_sales_period($date_from, $date_to);
        $this->data['credit_sales_period']   = $this->Dashboard_model->credit_sales_period($date_from, $date_to);
        $this->data['credit_payment_period'] = $this->Dashboard_model->credit_payment_period($date_from, $date_to);
        $this->data['expenses_period']       = $this->Dashboard_model->expenses_period($date_from, $date_to);
        $this->data['net_cash_period']       = $this->Dashboard_model->net_cash_period($date_from, $date_to);

        $this->data['donation_period']   = $this->Dashboard_model->donation_period($date_from, $date_to);
        $this->data['reclassify_period'] = $this->Dashboard_model->reclassify_period($date_from, $date_to);

        $this->data['production_chart'] = $this->Dashboard_model->production_chart_period($date_from, $date_to);

        $this->data['lowstockproducts'] = $this->Dashboard_model->lowstockproducts();
        $this->data['product_movement'] = $this->Dashboard_model->product_movement_period($date_from, $date_to);

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
