<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Customer_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Customer_model');
        $this->load->model('Category_model');
        $this->load->model('Creditloan_model');

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
        $this->data['alert'] = null;
        $this->data['message'] = null;
        $this->data['cus'] = null;
        $this->data['cat'] = $this->Category_model->get_customercategory();
        $this->data['customer'] = $this->Customer_model->countcustomer(); //number of customer        
        $this->render_html('customer/customer_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function customersave()
    {                    
        $this->data['alert'] = '1';
        $this->data['message'] = 'Customer successfully saved!';
        $this->data['cus'] = null;
        $this->data['cat'] = $this->Category_model->get_customercategory();
        $this->data['customer'] = $this->Customer_model->countcustomer(); //number of customer        
        $this->render_html('customer/customer_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertsuccess()
    {                    
        $this->data['alert'] = '1';
        $this->data['message'] = 'Customer added successfully!';
        $this->data['cus'] = null;
        $this->data['cat'] = $this->Category_model->get_customercategory();
        $this->data['customer'] = $this->Customer_model->countcustomer(); //number of customer
        $this->render_html('customer/customer_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function customersearch()
    {                    
        $this->data['alert'] = null;
        $this->data['message'] = null;
        $this->data['cus'] = $this->Customer_model->get_customersearch($this->input->post('csearch'));
        $this->data['cat'] = $this->Category_model->get_customercategory();
        $this->data['customer'] = $this->Customer_model->countcustomer(); //number of customer
        $this->render_html('customer/customer_view', true); 
    }
    
    //--------------------------------------------------------------------------
       
    public function insertcustomer()
    {              
        $sname = $this->Customer_model->searchname($this->input->post('name'));
        if(is_null($sname[0]->name)){
            $customer = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'telno' => $this->input->post('telno'),
                'credit_limit' => $this->input->post('creditlimit'),
                'balance' => $this->input->post('balance'),
                'terms' => $this->input->post('terms'),
                'user_id' => $this->session->userdata('id'),
                'active' => 'YES',
                'customer_category_cc_no' => $this->input->post('cno'),
            );
            $this->Customer_model->insertcustomer($customer);

            redirect('customer_con/insertsuccess');
        }else {
            $this->data['alert'] = '1';
            $this->data['message'] = 'Customer Name is Already Existed.';
            $this->data['cus'] = null;
            $this->data['cat'] = $this->Category_model->get_customercategory();
            $this->data['customer'] = $this->Customer_model->countcustomer(); //number of customer
            $this->render_html('customer/customer_view', true); 
        }
    }
    
    //--------------------------------------------------------------------------

    public function customerdeposit()
    {     
         $b = array(
            'balance' => $this->input->post('bal')-$this->input->post('amount'),                       
        );
        $this->Customer_model->updatecustomer($this->input->post('cno'), $b);

         $c = array(
            'customer_c_no' => $this->input->post('cno'),       
            'description' => "DEPOSIT",     
            'amount' => $this->input->post('amount'),
            'date' =>  date('Y/m/d'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Customer_model->customerdeposit($c);
        redirect('customer_con');
    }
    
    //--------------------------------------------------------------------------

    public function delcustomerdeposit($d, $c)
    {     

        $cde = $this->Customer_model->customerdepositinfo($d);
        $ce = $this->Customer_model->customerinfo($c);
        $b = array(
            'balance' => $ce[0]->balance+$cde[0]->amount,                       
        );
        $this->Customer_model->updatecustomer($c, $b);
      
        $this->Customer_model->deletecustomerdeposit($d);
        redirect('Customer_con/customerdepositlist');
    }
    
    //--------------------------------------------------------------------------

    public function customerdepositlist()
    {     
        $this->data['cus'] = $this->Customer_model->get_customerdeposit();
        $this->render_html('customer/customerdeposit_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function updatecustomer()
    {                                
        $customer = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'telno' => $this->input->post('telno'),
            'credit_limit' => $this->input->post('creditlimit'),
            'terms' => $this->input->post('terms'),
            'user_id' => $this->session->userdata('id'),
            'customer_category_cc_no' => $this->input->post('ccno'),
        );
        $this->Customer_model->updatecustomer($this->input->post('c_no'), $customer);
        redirect('customer_con/customersave');
    }
    
    //--------------------------------------------------------------------------

    public function customerinfo($c)
    {                                
        $this->data['cus'] = $this->Customer_model->customerinfo($c);
        $this->data['cussaleshistory'] = $this->Customer_model->customersaleshistory($c);
        $this->data['cuscredithistory'] = $this->Customer_model->customercredithistory($c);
        $this->data['cat'] = $this->Category_model->get_customercategory();
        $this->data['cllist'] = $this->Creditloan_model->get_customercreditloan($c); 
        $this->render_html('customer/customerinfo_view', true); 
    }
    
    //--------------------------------------------------------------------------
    
    public function delcustomer($c)
    {                                
       $customer = array(            
            'user_id' => $this->session->userdata('id'),
            'active' => 'NO'
        );
        $this->Customer_model->updatecustomer($c, $customer);
        redirect('customer_con');
    }
    
    //--------------------------------------------------------------------------

}
