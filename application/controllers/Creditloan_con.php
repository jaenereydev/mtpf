<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditloan_con extends MY_Controller
{
    //--------------------------------------------------------------------------
      
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Creditloan_model');
        $this->load->model('Customer_model');
        $this->load->model('Product_model');
        $this->load->model('Producthistory_model');
        $this->load->model('Repayment_model');
       
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
        $this->session->unset_userdata('clno');  // reset tno session
        $this->sessioning();

        $this->data['prod'] = $this->Product_model->get_productfortransaction($this->session->userdata('id')); //product list
        $this->data['cus'] = $this->Customer_model->get_customer(); // customer list
        $this->data['cll'] = $this->Creditloan_model->get_creditloanline($this->session->userdata('id')); // customer list
        $this->data['agents'] = $this->User_model->get_useractive(); // users list

        $this->render_html('creditloan/creditloan_view', false); 
    }
    

    //--------------------------------------------------------------------------

    public function creditlist()
    {   
        $this->resetsessiontransaction();
        $this->data['cllist'] = $this->Creditloan_model->get_allcreditloan(); 
        $this->render_html('creditloan/creditloanlist_view', true); 
    }
    

    //--------------------------------------------------------------------------


    public function creditloaninfo($cno)
    {   
        $clno = $this->Creditloan_model->get_creditloaninfo($cno);

        if($clno[0]->agent_id == null){
            $this->data['cl'] = $this->Creditloan_model->get_creditloannoagent($cno);
        }else{
            $this->data['cl'] = $this->Creditloan_model->get_creditloan($cno);
        }
        $this->data['clline'] = $this->Creditloan_model->get_creditloanlineinfo($cno);
        $this->data['repayment'] = $this->Creditloan_model->get_repayment($cno); 
        $this->render_html('creditloan/creditloaninfo_view', false);     
    }
    

    //--------------------------------------------------------------------------

    public function postpayment($rno, $cno, $outstandingbalance, $amountpayed, $penalty, $customercno)
    {   
        // update creditloanline
        $newbalance = $outstandingbalance-$amountpayed;
        $c = array(
            'outstanding_balance' => $newbalance,
        );
        $this->Creditloan_model->updatecreditloan($cno, $c);


        $r = array(
            'post' => 'POSTED'
        );
        $this->Repayment_model->updaterepayment($r, $rno);
        

        //update customer total credit
        $customerbalance = $this->Customer_model->customerinfo($customercno);
        $ntb = ($customerbalance[0]->balance-$amountpayed);
        $newtotalcredit = array(
            'balance' => $ntb,
        );
        $this->Customer_model->updatecustomer($customercno, $newtotalcredit);

        $this->creditloaninfo($cno);

    }
    

    //--------------------------------------------------------------------------

    public function updatepayment()
    {   
        if($this->input->post('amountpayed') == $this->input->post('soa')){
            $status = "PAID";
        }else if($this->input->post('amountpayed') > $this->input->post('soa')){
            $status = "OVERPAID";
        }else if ($this->input->post('amountpayed') < $this->input->post('soa')){
            $status = "UNDERPAID";
        }else {
            $status = "OPEN";
        }
        $r = array(
            'user_id' => $this->session->userdata('id'),
            'penalty' => $this->input->post('penalty'),
            'amount_payed' => $this->input->post('amountpayed'),
            'status' => $status,   
            'date_payed' => date('Y/m/d', strtotime($this->input->post('date'))),   
        );
        $this->Repayment_model->updaterepayment($r, $this->input->post('rno'));
        $this->creditloaninfo($this->input->post('clno'));     
    }
    

    //--------------------------------------------------------------------------

    public function sessioning()
    {                            
        if($this->session->userdata('customer') == null)
        {
            $this->data['customer'] = null;
        }else {
            $this->data['customer'] = $this->Customer_model->customerinfo($this->session->userdata('customer'));
        } 

        if($this->session->userdata('agent') == null)
        {
            $this->data['agent'] = null;
        }else {
            $this->data['agent'] = $this->User_model->get_users($this->session->userdata('agent'));
        }   

        if($this->session->userdata('date') == null)
        {
            $this->data['date'] = null;
        }else {
            $this->data['date'] = $this->session->userdata('date');
        } 

        if($this->session->userdata('downpayment') == null)
        {
            $this->data['downpayment'] = null;
        }else {
            $this->data['downpayment'] = $this->session->userdata('downpayment');
        }

        if($this->session->userdata('terms') == null)
        {
            $this->data['terms'] = null;
        }else {
            $this->data['terms'] = $this->session->userdata('terms');
        }
    }
    
    //-------------------------------------------------------------------------- 

    public function selectcustomer($c)
    {                            

        $this->session->set_userdata(['customer' => $c]);  
        redirect('Creditloan_con');
    }
    
    //--------------------------------------------------------------------------  

    public function selectagent($a)
    {                            

        $this->session->set_userdata(['agent' => $a]);  
        redirect('Creditloan_con');
    }
    
    //--------------------------------------------------------------------------
     
    public function deleteagent($a)
    {                            
        $this->session->unset_userdata('agent');           
        redirect('Creditloan_con');
    }
    
    //--------------------------------------------------------------------------

    public function deletecustomer($c)
    {                            
        $this->session->unset_userdata('customer');           
        redirect('Creditloan_con');
    }
    
    //-------------------------------------------------------------------------- 

    public function insertcreditloanline()
    {        
        if($this->input->post('discount') == '0'){
            $discount = '0';
            $discountamount = '0';
            $totalamount = $this->input->post('qty')*$this->input->post('price');
        }else {
            $discount = $this->input->post('discount');
            $discountamount =  (($this->input->post('qty')*$this->input->post('price'))*$this->input->post('discount'))/100;
            $totalamount = ($this->input->post('qty')*$this->input->post('price'))-$discountamount;
        }

        $cll = array(            
            'user_id' => $this->session->userdata('id'),
            'product_p_no' => $this->input->post('pno'),
            'unitcost' => $this->input->post('unitcost'),
            'totalunitcost' => $this->input->post('unitcost')*$this->input->post('qty'),
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('qty'),
            'discount' => $discount,
            'discountamount' => $discountamount,
            'totalamount' => $totalamount,
            'description' => $this->input->post('desc'),
        );
        $this->Creditloan_model->insertcreditloanline($cll);

        redirect('Creditloan_con');
    }
    
    //--------------------------------------------------------------------------

    public function resettransaction()
    {                            
        $this->resetsessiontransaction();

        $this->Creditloan_model->deletealltransactionline($this->session->userdata('id'));

        redirect('Creditloan_con');
    }
    
    //--------------------------------------------------------------------------

    public function updatetransactionline()
    {              
        if($this->input->post('discount') == '0'){
            $discount = '0';
            $discountamount = '0';
            $totalamount = $this->input->post('qty')*$this->input->post('price');
        }else {
            $discount = $this->input->post('discount');
            $discountamount =  (($this->input->post('qty')*$this->input->post('price'))*$this->input->post('discount'))/100;
            $totalamount = ($this->input->post('qty')*$this->input->post('price'))-$discountamount;
        }

        $cl = array(                        
            'qty' => $this->input->post('qty'),
            'discount' => $discount,
            'discountamount' => $discountamount,
            'totalamount' => $totalamount,
            'description' => $this->input->post('desc'),
        );      
        $this->Creditloan_model->editcreditloanline($this->input->post('cllno'),$cl);

        redirect('Creditloan_con');
    }
    
    //--------------------------------------------------------------------------

    public function deletecreditloanline($cll)
    {                            
        $this->Creditloan_model->deletecreditloanline($cll);

        redirect('Creditloan_con');
    }
    
    //--------------------------------------------------------------------------

    public function processloan()
    {        
        //formula for due amount
        $amountbalance = ($this->input->post('principalbalance')-$this->input->post('downpayment'));
        $dueamount = (((($amountbalance*$this->input->post('percentage'))*$this->input->post('terms'))+$amountbalance)/$this->input->post('terms'));
        $grandtotalbalance = $this->input->post('downpayment')+($dueamount*$this->input->post('terms'));
        $outstandingbalance = $dueamount*$this->input->post('terms');                  
        $maturity = date('Y/m/d', strtotime($this->input->post('date'). ' + '.$this->input->post('terms').' months'));

        //session
        $this->session->set_userdata(['date' => $this->input->post('date')]);
        $this->session->set_userdata(['principalbalance' => number_format((float)$this->input->post('principalbalance'),2,'.','')]);
        $this->session->set_userdata(['downpayment' => number_format((float)$this->input->post('downpayment'),2,'.','')]);
        $this->session->set_userdata(['terms' => $this->input->post('terms')]);
        $this->session->set_userdata(['status' => 'OPEN']);  
        $this->session->set_userdata(['amountbalance' => number_format((float)$amountbalance,2,'.','')]);
        $this->session->set_userdata(['maturity' => $maturity]);
        $this->session->set_userdata(['percentage' => $this->input->post('percentage')]);
        $this->session->set_userdata(['dueamount' => number_format((float)$dueamount,2,'.','')]);
        $this->session->set_userdata(['grandtotalbalance' => number_format((float)$grandtotalbalance,2,'.','')]);
        $this->session->set_userdata(['outstandingbalance' => number_format((float)$outstandingbalance,2,'.','')]);

        $this->data['customer'] = $this->Customer_model->customerinfo($this->session->userdata('customer'));// get customer info
        $this->data['agent'] = $this->User_model->get_users($this->session->userdata('agent')); // get user info
        $this->data['cll'] = $this->Creditloan_model->get_creditloanline($this->session->userdata('id')); // get credit loan line 

        $this->render_html('creditloan/creditprocess_view', false); 
    }
    
    //--------------------------------------------------------------------------  

    public function resetsessiontransaction()
    {      
        // unsetting of session                      
        $this->session->unset_userdata('customer');   
        $this->session->unset_userdata('agent');
        $this->session->unset_userdata('downpayment'); 
        $this->session->unset_userdata('terms'); 
        $this->session->unset_userdata('date');
        $this->session->unset_userdata('principalbalance');
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('amountbalance');
        $this->session->unset_userdata('percentage');
        $this->session->unset_userdata('dueamount');
        $this->session->unset_userdata('maturity');
        $this->session->unset_userdata('clno');
        $this->session->unset_userdata('grandtotalbalance');
        $this->session->unset_userdata('outstandingbalance');
    }
    
    //-------------------------------------------------------------------------- 

    public function successtransaction()
    {      
       $this->resetsessiontransaction();
       redirect('Creditloan_con');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function submitcreditloan()
    {        
        $c = $this->Customer_model->customerinfo($this->session->userdata('customer')); // find customer info
        //array for creditloan
        $cl = array(
            'date' => date('Y/m/d', strtotime($this->session->userdata('date'))),
            'maturity' => $this->session->userdata('maturity'),
            'principal_balance' => $this->session->userdata('principalbalance'),
            'downpayment' => $this->session->userdata('downpayment'),
            'amount_balance' => $this->session->userdata('amountbalance'),
            'termsbymonth' => $this->session->userdata('terms'),
            'percentage' => $this->session->userdata('percentage'),
            'due_amount' => $this->session->userdata('dueamount'),
            'grandtotalbalance' => $this->session->userdata('grandtotalbalance'),
            'status' => $this->session->userdata('status'),
            'outstanding_balance' => $this->session->userdata('outstandingbalance'),
            'user_id' => $this->session->userdata('id'),
            'agent_id' => $this->session->userdata('agent'),
            'customer_c_no' => $this->session->userdata('customer'),
        );

        //insert data in credit loan
        $clno = $this->Creditloan_model->insertcreditloan($cl); 
        $this->session->set_userdata(['clno' => $clno]);

        //update credit loan line for cl_no
        $this->Creditloan_model->updatecreditloanline($clno, $this->session->userdata('id'));

        //insert data to product history
        $desc = "CREDIT LOAN";
        $this->Producthistory_model->insert_creditloanproducthistory($clno, $desc);

        //update product quantity
        $this->Product_model->updatecreditloanproductqty($clno);

        //insert data in repayment table
        $this->insertrepayment($clno);

        //update of commission of agent
        if($this->session->userdata('agent') == '0' || $this->session->userdata('agent') == null){}else{   
            $this->updateagentcommission();
        }

        //insert customer history
        $this->insertcustomerbalancehistory($c[0]->balance, $clno, $desc);
    
        //update customer balance
        $this->updatecustomerbalance($c[0]->balance);
        $d = "creditloan";
        redirect('Receipt_con/printcustomerform/'.$d);
    }
    
    //--------------------------------------------------------------------------  

    public function insertcustomerbalancehistory($c,$clno, $desc)
    { 
        $ch = array(
            'date' =>  date('Y/m/d', strtotime($this->session->userdata('date'))),
            'description' => $desc,
            'ci_amount' => number_format((float)$this->session->userdata('outstandingbalance'),2,'.',''),
            'balance' => $c+$this->session->userdata('outstandingbalance'),
            'customer_c_no' => $this->session->userdata('customer'),
            'user_id' => $this->session->userdata('id'),
            'ref_no' => $clno,
        );
        $this->Customer_model->insert_customerbalancehistory($ch);
    }

    //-------------------------------------------------------------------------- 
    
    public function updatecustomerbalance($c)
    { 
        $cbal = array(
            'balance' => $c+$this->session->userdata('outstandingbalance'),           
        );
        $this->Customer_model->updatecustomer($this->session->userdata('customer'), $cbal);
    }

    //--------------------------------------------------------------------------  

    public function updateagentcommission()
    { 
        $uc = $this->User_model->get_users($this->session->userdata('agent'));  
        $commission = $this->session->userdata('outstandingbalance')*($uc[0]->percentage/100);         
        $usercom = array(
            'uncollectable_commission' => $uc[0]->uncollectable_commission+$commission,
        );
        $this->User_model->updateuser($this->session->userdata['agent'], $usercom);

    }

    //--------------------------------------------------------------------------  

    public function insertrepayment($clno)
    { 
        $m = 1;
        for($i=0; $i<$this->session->userdata('terms'); $i++)
        {
            $rn = array(
                'status' => 'OPEN',
                'customer_c_no' => $this->session->userdata('customer'),
                'credit_loan_cl_no' => $clno,
                'due_date' => date('Y/m/d', strtotime($this->session->userdata('date'). ' + '.$m.' months')),
                'due_amount' => number_format((float)$this->session->userdata('dueamount'),2,'.',''),
                'penalty' => '0',
                'amount_payed' => '0',
            );
            $this->Creditloan_model->insertrepayment($rn);
            $m+=1;
        }
    }

    //--------------------------------------------------------------------------  

    public function reprint($clno)
    { 
        $this->session->set_userdata(['clno' => $clno]);
        $d = "reprint";
        redirect('Receipt_con/printcustomerform/'.$d);
    }

    //--------------------------------------------------------------------------  
    

}
