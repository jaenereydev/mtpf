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
        $this->data['com'] = $this->Company_model->get_companyinfo(); //company details
        $this->data['customer'] = $this->Customer_model->countcustomer(); //number of customer
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['productwounitcost'] = $this->Product_model->countproductwounitcost(); //number of product with unit cost
        $this->data['productnegativequantity'] = $this->Product_model->productwithnegativequantity(); //number of product with negative quantity

        $this->data['totalap'] = $this->Delivery_model->get_totalaccountpayeble(); //number of product
        $this->data['totalar'] = $this->Customer_model->get_totalaccountrecievables(); //number of product
        $this->data['dd'] = $this->Duedate_model->get_duedate();
        $this->data['sumcost'] = $this->Product_model->inventorytotalcost(); //total cost of inventory

        $this->data['totalcashsalesperuser'] = $this->Sales_model->get_totalcashsalesperdayperuser(); //total credit sales per user
        $this->data['totalcreditsalesperuser'] = $this->Sales_model->get_totalcreditsalesperdayperuser(); //total credit sales per user
        $this->data['totalcreditpaymentperuser'] = $this->Creditpayment_model->get_totalcreditpaymentperuser(); //total credit payment per user
        
        $this->data['openloan'] = $this->Creditloan_model->get_openloan();
        $this->data['dueamount'] = $this->Repayment_model->get_repaymentthismonth();
        $this->data['payedamount'] = $this->Repayment_model->get_payedthismonth();

        $this->render_html('dashboard_view', true); 
    }
    
    //--------------------------------------------------------------------------
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    
    //--------------------------------------------------------------------------
    
}
