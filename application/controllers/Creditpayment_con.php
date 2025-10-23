<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditpayment_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Creditpayment_model');
        $this->load->model('Customer_model');
       
        $this->user = $this->User_model->get_users($this->session->userdata('id'));
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
        $this->session->unset_userdata('cpno');  // reset tno session
        $this->session->unset_userdata('cpnocustomer');  // reset tno session
        $this->data['cplist'] = $this->Creditpayment_model->get_creditpaymentlist($this->session->userdata('id'));// credit payment list of the day
        $this->data['cus'] = $this->Creditpayment_model->get_customerwithbalance(); // get customer with balance

        $this->render_html('creditpayment/creditpayment_view', true); 
    }
    
    //--------------------------------------------------------------------------
       
    public function insertcreditpayment($c)
    {
        $cp = array(
            'date' => date('Y/m/d'),
            'user_id' => $this->session->userdata('id'),
            'customer_c_no' => $c,
            'totalcredit' => "0",
            'totalpayment' => "0"
        );
        $cpno = $this->Creditpayment_model->insertcreditpayment($cp);
        $this->session->set_userdata(['cpno' => $cpno]);
        $this->session->set_userdata(['cpnocustomer' => $c]);
        redirect('Creditpaymentinfo_con');
        
    }
    
    //--------------------------------------------------------------------------

     public function creditpaymentinfo($c)
    {
        $cpnocus = $this->Creditpayment_model->get_customerpaymentinfo($c); // get customer payment information
        $this->session->set_userdata(['cpno' => $c]);

        $this->session->set_userdata(['cpnocustomer' => $cpnocus[0]->customer_c_no]);
        redirect('Creditpaymentinfo_con');     
    }
    
    //--------------------------------------------------------------------------

    public function deletecreditpayment($c)
    {
        $this->Creditpayment_model->deleteallline($c);    
        $this->Creditpayment_model->deletecustomerpayment($c);
        redirect('Creditpayment_con');

    }

    //--------------------------------------------------------------------------

    public function postcreditpayment($c)
    {
        $cp = $this->Creditpayment_model->get_customerpaymentinfo($c);
        if($cp[0]->totalcredit == "0"){

            $this->postcp($c); //post customer payment 
            $this->Creditpayment_model->updatecustomerbalancehistory($c); //update credit due date
            $this->updatecustomerbalance($cp[0]->customer_c_no, $cp[0]->totalpayment); // update customer balance


        }else if($cp[0]->totalcredit == $cp[0]->totalpayment) {
            $this->postcp($c); //post customer payment             
            $desc = "PAYED";
            $this->Creditpayment_model->updatecreditpaymentpayed($c , $desc); //update credit due date
            $this->Creditpayment_model->updatecustomerbalancehistory($c); //update credit due date
            $this->updatecustomerbalance($cp[0]->customer_c_no, $cp[0]->totalpayment); // update customer balance

        }else  {
            $this->postcp($c); //post customer payment 
            
            $this->Creditpayment_model->updatecreditpaymentpayednull($c); //update credit due date
            $this->Creditpayment_model->updatecustomerbalancehistory($c); //update credit due date
            $this->updatecustomerbalance($cp[0]->customer_c_no, $cp[0]->totalpayment); // update customer balance

        }   
        redirect('Creditpayment_con');
    }

    //--------------------------------------------------------------------------

    public function postcp($c)
    {
        $cp = array(
            'post' => "YES",
        );
        $this->Creditpayment_model->updatecreditpayment($c, $cp);
    }
    
    //--------------------------------------------------------------------------

    public function updatecustomerbalance($c, $a)
    {
        $cus = $this->Customer_model->customerinfo($c); 
        $bal = array(
            'balance' => $cus[0]->balance-$a,
        );
        $this->Customer_model->updatecustomer($c, $bal);
    }

}
