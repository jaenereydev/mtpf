<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_con extends MY_Controller
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
        $this->load->model('Report_model');
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
        $this->render_html('report/report_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function inventorycost()
    {
        $this->data['product'] = $this->Product_model->inventorycost();
        $this->data['sumcost'] = $this->Product_model->inventorytotalcost();
        $this->render_html('report/inventorycost_view', true); 

    }

    //--------------------------------------------------------------------------       

    public function exporttoexcel()
    {
        $product = $this->Product_model->inventorycost();
        $this->load->view('report/excel/inventoryreport_excel', array('product' => $product));  
    }

    //--------------------------------------------------------------------------

    public function customersummary()
    {
        $this->data['customer'] = $this->Customer_model->get_customer();
        $this->data['sumbal'] = $this->Customer_model->get_totalaccountrecievables();
        $this->render_html('report/customersummary_view', true); 

    }

    //--------------------------------------------------------------------------

    public function printsalesreport()
    {
        $this->data['user'] = $this->User_model->get_users( $this->session->userdata('id'));
        $this->data['com'] = $this->Company_model->get_companyinfo(); //company details
        $this->data['t'] = $this->Sales_model->get_daytransaction($this->session->userdata('id')); // transaction list        
        $this->data['downpayment'] = $this->Sales_model->get_totaldownpaymentperuser($this->session->userdata('id')); // get downpayment   
        $this->data['creditloan'] = $this->Sales_model->get_creditloanperuser($this->session->userdata('id')); 
        $this->data['creditloanpayment'] = $this->Sales_model->get_repaymentperuser($this->session->userdata('id'));    
        $this->data['creditloanpaymentlist'] = $this->Sales_model->get_creditloanpaidtoday($this->session->userdata('id'));  

        $this->data['creditpayment'] = $this->Creditpayment_model->get_creditpaymentposted($this->session->userdata('id')); // get credit sales payment

        $c = 'CASH';
        $this->data['sumcash'] = $this->Sales_model->get_sumtransaction($this->session->userdata('id'), $c); // sum of transaction list cash
        $ch = 'CHECK';
        $this->data['sumcheck'] = $this->Sales_model->get_sumtransaction($this->session->userdata('id'), $ch); // sum of transaction list check
        $r = 'RETURN';
        $this->data['sumreturn'] = $this->Sales_model->get_sumtransaction($this->session->userdata('id'), $r); // sum of transaction list return
        $cr = 'CREDIT';
        $this->data['sumcredit'] = $this->Sales_model->get_sumtransaction($this->session->userdata('id'), $cr); // sum of transaction list credit

        $this->data['sumexpenses'] = $this->Sales_model->get_sumexpenses($this->session->userdata('id')); // sum of expenses of the day

        $this->data['sumdeposit'] = $this->Sales_model->get_sumdeposit($this->session->userdata('id')); // sum of expenses of the day

        $this->data['sumcreditpayment'] = $this->Sales_model->get_sumcreditpayment($this->session->userdata('id')); // sum of expenses of the day

        $this->data['sumcashonhand'] = $this->Sales_model->get_sumcashonhand($this->session->userdata('id')); // sum of expenses of the day
        
        $this->data['cohinfo'] = $this->Sales_model->get_cashonhandinfo($this->session->userdata('id')); // sum of expenses of the day      
        $this->data['sumdeposit'] = $this->Sales_model->get_sumdeposit($this->session->userdata('id')); // sum of deposit of the day      

        $this->load->view('sales/report/salesreport', $this->data);       
    }

    //--------------------------------------------------------------------------

    public function salesreport()
    {        
        $this->resetsession();
        $this->data['salesreport'] = null;
        $this->render_html('report/salesreport_view', true); 

    }

    //--------------------------------------------------------------------------

    public function searchsalesreport()
    {        
        $this->data['salesreport'] = $this->Report_model->get_salesreport(date('Y/m/d', strtotime($this->input->post('search'))));
        $this->render_html('report/salesreport_view', true); 

    }

    //--------------------------------------------------------------------------

    public function reprintsalesreport($sr)
    {
        $s = $this->Report_model->get_salesreportinfo($sr);

        $this->data['user'] = $this->User_model->get_users($s[0]->user_id);
        $this->data['com'] = $this->Company_model->get_companyinfo(); //company details
        $this->data['t'] = $this->Sales_model->get_datetransaction($s[0]->user_id, $s[0]->date); // transaction list
        $this->data['downpayment'] = $this->Sales_model->get_datetotaldownpaymentperuser($s[0]->user_id, $s[0]->date); // get downpayment   
        $this->data['creditloan'] = $this->Sales_model->get_datecreditloanperuser($s[0]->user_id, $s[0]->date); 
        $this->data['creditloanpayment'] = $this->Sales_model->get_daterepaymentperuser($s[0]->user_id, $s[0]->date);
        $this->data['creditloanpaymentlist'] = $this->Sales_model->get_datecreditloanpaidtoday($s[0]->user_id, $s[0]->date);  
        $this->data['creditpayment'] = $this->Creditpayment_model->get_datecreditpaymentposted($s[0]->user_id, $s[0]->date); // get credit sales payment

        $c = 'CASH';
        $this->data['sumcash'] = $this->Sales_model->get_datesumtransaction($s[0]->user_id, $s[0]->date, $c); // sum of transaction list cash
        $ch = 'CHECK';
        $this->data['sumcheck'] = $this->Sales_model->get_datesumtransaction($s[0]->user_id, $s[0]->date, $ch); // sum of transaction list check
        $r = 'RETURN';
        $this->data['sumreturn'] = $this->Sales_model->get_datesumtransaction($s[0]->user_id, $s[0]->date, $r); // sum of transaction list return
        $cr = 'CREDIT';
        $this->data['sumcredit'] = $this->Sales_model->get_datesumtransaction($s[0]->user_id, $s[0]->date, $cr); // sum of transaction list credit

        $this->data['sumexpenses'] = $this->Sales_model->get_datesumexpenses($s[0]->user_id, $s[0]->date); // sum of expenses of the day

        $this->data['sumdeposit'] = $this->Sales_model->get_datesumdeposit($s[0]->user_id, $s[0]->date); // sum of expenses of the day

        $this->data['sumcreditpayment'] = $this->Sales_model->get_datesumcreditpayment($s[0]->user_id, $s[0]->date); // sum of expenses of the day

        $this->data['sumcashonhand'] = $this->Sales_model->get_datesumcashonhand($s[0]->user_id, $s[0]->date); // sum of expenses of the day
        
        $this->data['cohinfo'] = $this->Sales_model->get_datecashonhandinfo($s[0]->user_id, $s[0]->date); // sum of expenses of the day    

        $this->data['sumdeposit'] = $this->Sales_model->get_datesumdeposit($s[0]->user_id, $s[0]->date); // sum of deposit of the day      

        $this->load->view('sales/report/salesreport', $this->data);       
    }

    //--------------------------------------------------------------------------
   
    public function transactionsalesreport()
    {   
        $this->resetsession();     
        $this->data['transactionsalesreport'] = null;
        $this->render_html('report/transactionsalesreport_view', true); 

    }

    //--------------------------------------------------------------------------

    public function searchtransactionsalesreport()
    {        
        $this->session->set_userdata(['searchdate' => $this->input->post('search')]);
        $this->data['transactionsalesreport'] = $this->Report_model->get_transactionsalesreport(date('Y/m/d', strtotime($this->input->post('search'))));
        $this->render_html('report/transactionsalesreport_view', true); 

    }

    //--------------------------------------------------------------------------

    public function profitreport()
    {   
        $this->resetsession();     
        $this->data['profitreportlist'] = null;
        $this->render_html('report/profitreport_view', true); 

    }

    //--------------------------------------------------------------------------

    public function searchprofitreport()
    {        
        $this->session->set_userdata(['searchdate' => $this->input->post('search')]);
        $this->data['profitreportlist'] = $this->Report_model->get_profitreport(date('Y/m/d', strtotime($this->input->post('search'))));
        $this->render_html('report/profitreport_view', true); 

    }

    //--------------------------------------------------------------------------

    public function resetsession()
    {        
        $this->session->unset_userdata('searchdate');  
    }

    //--------------------------------------------------------------------------
    


}
