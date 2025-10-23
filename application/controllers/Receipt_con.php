<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipt_con extends MY_Controller
{
    //--------------------------------------------------------------------------
      
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Sales_model');
        $this->load->model('Customer_model');
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
        if($this->session->userdata('cno') == null)
        {
            $this->data['customer'] = null;
        }else {
            $this->data['customer'] = $this->Customer_model->customerinfo($this->session->userdata('cno'));
        }  
        $this->data['t'] = $this->Sales_model->get_transactioninfo($this->session->userdata('tno')); // customer list    
        $this->data['tl'] = $this->Sales_model->get_transactionlineinfo($this->session->userdata('tno')); // customer list
    
        $this->load->view('sales/report/receipt_view', $this->data); 
    }
    
    //--------------------------------------------------------------------------

    public function reprint($tno, $c = null)
    {                            
        if($c == '0' || $c == null)
        {
            $this->data['customer'] = null;
        }else {
            $this->data['customer'] = $this->Customer_model->customerinfo($c);
        }  
        $this->data['t'] = $this->Sales_model->get_transactioninfo($tno); // customer list    
        $this->data['tl'] = $this->Sales_model->get_transactionlineinfo($tno); // customer list
    
        $this->load->view('sales/report/reprintreceipt_view', $this->data); 
    }
    
    //--------------------------------------------------------------------------

    public function printcustomerform($desc)
    {    
        $clno = $this->Creditloan_model->get_creditloaninfo($this->session->userdata('clno'));

        if($clno[0]->agent_id == null){
            $this->data['cl'] = $this->Creditloan_model->get_creditloannoagent($this->session->userdata('clno'));
        }else{
            $this->data['cl'] = $this->Creditloan_model->get_creditloan($this->session->userdata('clno'));
        }
        $this->data['clline'] = $this->Creditloan_model->get_creditloanlineinfo($this->session->userdata('clno'));
        $this->data['repayment'] = $this->Creditloan_model->get_repayment($this->session->userdata('clno')); 
        $this->data['desc'] = $desc;    
        $this->load->view('creditloan/report/creditloan_customerform', $this->data);          
    }

    //--------------------------------------------------------------------------

    public function customerprint($clno)
    {    
        $this->session->set_userdata(['clno' => $clno]);
        $desc = "transactionlist";
        $this->printcustomerform($desc);
    }
}
