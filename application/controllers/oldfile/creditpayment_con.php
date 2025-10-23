<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Creditpayment_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Creditpayment_model');
        $this->load->model('Heading_model'); 
        $this->load->model('Customer_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function index()
    {    
        $sumcash = $this->Creditpayment_model->get_sumcashcreditpayment();
        $sumcheck = $this->Creditpayment_model->get_sumcheckcreditpayment();
        $cus = $this->Customer_model->get_customeractive();
        $pay = $this->Creditpayment_model->get_creditpayment();
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/reports/Creditpayment', array('sumcheck' => $sumcheck, 'sumcash' => $sumcash, 'cus' => $cus, 'pay' => $pay,'users' => $users));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    
     public function search()
    {       
        $cno = $this->input->post('c_no');
        $value1 = $this->input->post('from'); $from = date_format(date_create($value1), 'Y-m-d');
        $value2 = $this->input->post('to'); $to = date_format(date_create($value2), 'Y-m-d');
        if($cno == 'all'){
            $pay = $this->Creditpayment_model->get_creditpayment();
            $sumcash = $this->Creditpayment_model->get_sumcashcreditpayment();
            $sumcheck = $this->Creditpayment_model->get_sumcheckcreditpayment();
        }else {
            $pay = $this->Creditpayment_model->get_searchcreditpayment($cno, $from, $to);
            $sumcash = $this->Creditpayment_model->get_sumcashsearchcreditpayment($cno, $from, $to);
            $sumcheck = $this->Creditpayment_model->get_sumchecksearchcreditpayment($cno, $from, $to);
        }
        $cus = $this->Customer_model->get_customeractive();        
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/reports/Creditpayment', array('sumcheck' => $sumcheck, 'sumcash' => $sumcash, 'cus' => $cus, 'pay' => $pay,'users' => $users));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function printreport()
    {       
        $cno = $this->input->post('c_no');
        $value1 = $this->input->post('from'); $from = date_format(date_create($value1), 'Y-m-d');
        $value2 = $this->input->post('to'); $to = date_format(date_create($value2), 'Y-m-d');
        if($cno == 'all'){
            $pay = $this->Creditpayment_model->get_creditpayment();
            $sumcash = $this->Creditpayment_model->get_sumcashcreditpayment();
            $sumcheck = $this->Creditpayment_model->get_sumcheckcreditpayment();
        }else {
            $pay = $this->Creditpayment_model->get_searchcreditpayment($cno, $from, $to);
            $sumcash = $this->Creditpayment_model->get_sumcashsearchcreditpayment($cno, $from, $to);
            $sumcheck = $this->Creditpayment_model->get_sumchecksearchcreditpayment($cno, $from, $to);
        }
        $cus = $this->Customer_model->get_customeractive();        
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/print/creditpayment_print', array('cno' => $cno, 'to' => $value2, 'from' => $value1, 'com' => $com, 'sumcheck' => $sumcheck, 'sumcash' => $sumcash, 'cus' => $cus, 'pay' => $pay,'users' => $users));
        
    }
    
    //--------------------------------------------------------------------------
    
    public function excelprintreport()
    {       
        $cno = $this->input->post('c_no');
        $value1 = $this->input->post('from'); $from = date_format(date_create($value1), 'Y-m-d');
        $value2 = $this->input->post('to'); $to = date_format(date_create($value2), 'Y-m-d');
        if($cno == 'all'){
            $pay = $this->Creditpayment_model->get_creditpayment();
            $sumcash = $this->Creditpayment_model->get_sumcashcreditpayment();
            $sumcheck = $this->Creditpayment_model->get_sumcheckcreditpayment();
        }else {
            $pay = $this->Creditpayment_model->get_searchcreditpayment($cno, $from, $to);
            $sumcash = $this->Creditpayment_model->get_sumcashsearchcreditpayment($cno, $from, $to);
            $sumcheck = $this->Creditpayment_model->get_sumchecksearchcreditpayment($cno, $from, $to);
        }
        $cus = $this->Customer_model->get_customeractive();        
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/reports/export_excel/creditpayment_print', array('cno' => $cno, 'to' => $value2, 'from' => $value1, 'com' => $com, 'sumcheck' => $sumcheck, 'sumcash' => $sumcash, 'cus' => $cus, 'pay' => $pay,'users' => $users));
        
    }
    
    //--------------------------------------------------------------------------
                 
    
}
