<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditpaymentinfo_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Creditpayment_model');
        $this->load->model('Creditreturn_model');
        $this->load->model('Duedate_model');
       
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
       
        $this->data['cddlist'] = $this->Creditpayment_model->get_creditduedatelist($this->session->userdata('cpno'));// credit due date line 
        $this->data['cp'] = $this->Creditpayment_model->get_customerpaymentinfo($this->session->userdata('cpno')); // get customer payment information

        $this->data['cpl'] = $this->Creditpayment_model->get_customerpaymentline($this->session->userdata('cpno')); // get customer payment information
        $this->data['cus'] = $this->Creditpayment_model->get_customerwithbalance(); // get customer with balance

        $this->data['cdd'] = $this->Creditpayment_model->get_creditduedate($this->session->userdata('cpnocustomer'), $this->session->userdata('cpno')); // get customer due date
        $this->data['countcddl'] = $this->Creditpayment_model->get_countcreditduedatelist($this->session->userdata('cpno'));//count credit due date line


        $this->render_html('creditpayment/creditpaymentinfo_view', false); 
    }
    
    //--------------------------------------------------------------------------

    public function changecustomer($c)
    {
        $cus = array(
            'customer_c_no' => $c,
            'user_id' => $this->session->userdata('id'),
        );
        $this->Creditpayment_model->updatecreditpayment($this->session->userdata('cpno'),$cus);
        $this->Creditpayment_model->deleteallline($this->session->userdata('cpno'));
        $this->session->set_userdata(['cpnocustomer' => $c]);
        redirect('Creditpaymentinfo_con');
    }
      
    //-------------------------------------------------------------------------- 

    public function insertpayment()
    {
         $c = array(
            'totalpayment' => $this->input->post('totalpayment')+$this->input->post('amount'),
        );
        $this->Creditpayment_model->updatecreditpayment($this->session->userdata('cpno'), $c); // update customer payment

        $p = array(
            'type' => $this->input->post('type'),
            'amount' => $this->input->post('amount'),
            'customerpayment_cp_no' => $this->session->userdata('cpno'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Creditpayment_model->insertcustomerpaymentline($p); // insert data in customer payment line
        redirect('Creditpaymentinfo_con');
    }
      
    //-------------------------------------------------------------------------- 

    public function deletecustomerpaymentline($c,$a)
    {
        $cpl = $this->Creditpayment_model->get_customerpaymentinfo($this->session->userdata('cpno'));
        $p = array(
            'totalpayment' => $cpl[0]->totalpayment-$a,
        );
        $this->Creditpayment_model->updatecreditpayment($this->session->userdata('cpno'), $p);

        $this->Creditpayment_model->deletecustomerpaymentline($c);
        redirect('Creditpaymentinfo_con');
    }
      
    //-------------------------------------------------------------------------- 

     public function deletecreditduedateline($c, $a)
    {
        $cpl = $this->Creditpayment_model->get_customerpaymentinfo($this->session->userdata('cpno'));
        $p = array(
            'totalcredit' => $cpl[0]->totalcredit-$a,
        );
        $this->Creditpayment_model->updatecreditpayment($this->session->userdata('cpno'), $p);

        $this->Creditpayment_model->deletecreditduedateline($c);
        redirect('Creditpaymentinfo_con');
    }
      
    //-------------------------------------------------------------------------- 
    
     public function insertcreditduedateline($cddno, $d, $tc)
    {
        $cdd = $this->Duedate_model->get_creditduedateinfo($cddno);
        $cddl = array(
            'customerpayment_cp_no' => $this->session->userdata('cpno'),
            'creditduedate_cdd_no' => $cdd[0]->cdd_no,
        );
        $this->Creditpayment_model->insertcreditduedateline($cddl); // insert creditduedateline

        $p = array(
            'totalcredit' => $tc+$d,
        );
        $this->Creditpayment_model->updatecreditpayment($this->session->userdata('cpno'), $p);


        redirect('Creditpaymentinfo_con');
    }
      
    //-------------------------------------------------------------------------- 

    public function submitcreditpayment()
    {
        $c = array(
            'date' => date_format(date_create($this->input->post('date')), 'Y/m/d'),
            'remarks' => $this->input->post('remarks'),
        );
        $this->Creditpayment_model->updatecreditpayment($this->session->userdata('cpno'), $c);
        redirect('Creditpayment_con');
    }


    //-------------------------------------------------------------------------- 

}
