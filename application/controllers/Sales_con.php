<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_con extends MY_Controller
{
    //---------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Sales_model');
        $this->load->model('Customer_model');
        $this->load->model('Product_model');
        $this->load->model('Creditpayment_model');
        $this->load->model('Producthistory_model');
    
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
        $this->session->unset_userdata('tno');  // reset tno session
        if($this->session->userdata('customer') == null)
        {
            $this->data['customer'] = null;
        }else {
            $this->data['customer'] = $this->Customer_model->customerinfo($this->session->userdata('customer'));
        }               

        if($this->session->userdata('refno') == null)
        {
            $this->data['refno'] = null;
        }else {
            $this->data['refno'] = $this->session->userdata('refno');
        } 

        if($this->session->userdata('discount') == null)
        {
            $this->data['discount'] = null;
        }else {
            $this->data['discount'] = $this->session->userdata('discount');
        } 

        if( $this->session->userdata('cashonhand') == null)
        {
            $this->data['cashonhand'] = null;
        }else {
            $this->data['cashonhand'] =  $this->session->userdata('cashonhand');
        } 
        if( $this->session->userdata('type') == null)
        {
            $this->data['type'] = null;
        }else {
            $this->data['type'] =  $this->session->userdata('type');
        } 


        $this->data['prod'] = $this->Product_model->get_productfortransaction($this->session->userdata('id')); //product list
        $this->data['cus'] = $this->Customer_model->get_customer(); // customer list
        $this->data['tl'] = $this->Sales_model->get_transactionline($this->session->userdata('id')); // customer list

        $this->render_html('sales/sales_view', false); 
    }
    

     //--------------------------------------------------------------------------

    public function insertcoh()
    {
        $c = array(
            'date' => date('Y/m/d'),
            'cashonhand' => $this->input->post('coh'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Sales_model->insertcoh($c);
        redirect('Sales_con/transactionlist');
    }

     //--------------------------------------------------------------------------

    public function updatecoh()
    {
        $c = array(
            'cashonhand' => $this->input->post('coh'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Sales_model->updatecoh($this->input->post('srno'),$c);
        redirect('Sales_con/transactionlist');
    }

     //--------------------------------------------------------------------------

    public function transactionlist()
    {        
        $this->data['t'] = $this->Sales_model->get_daytransaction($this->session->userdata('id')); // transaction list        
        $this->data['downpayment'] = $this->Sales_model->get_totaldownpaymentperuser($this->session->userdata('id')); // get downpayment  

        $this->data['creditpayment'] = $this->Creditpayment_model->get_creditpaymentposted($this->session->userdata('id')); // get credit sales payment

        $this->data['creditloan'] = $this->Sales_model->get_creditloanperuser($this->session->userdata('id')); 
        $this->data['creditloanpayment'] = $this->Sales_model->get_repaymentperuser($this->session->userdata('id'));    
        $this->data['creditloanpaymentlist'] = $this->Sales_model->get_creditloanpaidtoday($this->session->userdata('id'));    

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

        $this->render_html('sales/transactionlist_view', true); 
    }

    //--------------------------------------------------------------------------

    public function inserttransactionline()
    {        
        $ta = $this->input->post('qty')*$this->input->post('price');
        if($this->input->post('discount') == '0'){
            $discount = '0';
            $discountamount = '0';
            $totalamount = $this->input->post('qty')*$this->input->post('price');
        }else {
            $discount = $this->input->post('discount');
            $discountamount =  (($this->input->post('qty')*$this->input->post('price'))*$this->input->post('discount'))/100;
            $totalamount = ($this->input->post('qty')*$this->input->post('price'))-$discountamount;
        }

        $tl = array(            
            'user_id' => $this->session->userdata('id'),
            'product_p_no' => $this->input->post('pno'),
            'unitcost' => $this->input->post('unitcost'),
            'totalunitcost' => $this->input->post('unitcost')*$this->input->post('qty'),
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('qty'),
            'description' => $this->input->post('desc'),
            'discount' => $discount,
            'discountamount' => $discountamount,
            'totalamount' => $totalamount,
        );
        $this->Sales_model->inserttransactionline($tl);

        redirect('Sales_con');
    }
    
    // //--------------------------------------------------------------------------

    public function updatetransactionlineprice()
    {              
        $ta = $this->input->post('qty')*$this->input->post('price');
        if($this->input->post('discount') == '0'){
            $discount = '0';
            $discountamount = '0';
            $totalamount = $this->input->post('qty')*$this->input->post('price');
        }else {
            $discount = $this->input->post('discount');
            $discountamount =  (($this->input->post('qty')*$this->input->post('price'))*$this->input->post('discount'))/100;
            $totalamount = ($this->input->post('qty')*$this->input->post('price'))-$discountamount;
        }

        $tl = array(                        
            'price' => $this->input->post('price'),
            'discount' => $discount,
            'discountamount' => $discountamount,
            'totalamount' => $totalamount,

        );      
        $this->Sales_model->edittransactionline($this->input->post('tlno'),$tl);

        redirect('Sales_con');
    }
    
    // //--------------------------------------------------------------------------

    public function updatetransactionline()
    {              
        $ta = $this->input->post('qty')*$this->input->post('price');
        if($this->input->post('discount') == '0'){
            $discount = '0';
            $discountamount = '0';
            $totalamount = $this->input->post('qty')*$this->input->post('price');
        }else {
            $discount = $this->input->post('discount');
            $discountamount =  (($this->input->post('qty')*$this->input->post('price'))*$this->input->post('discount'))/100;
            $totalamount = ($this->input->post('qty')*$this->input->post('price'))-$discountamount;
        }

        $tl = array(                        
            'qty' => $this->input->post('qty'),
            'discount' => $discount,
            'discountamount' => $discountamount,
            'totalamount' => $totalamount,
            "description" => $this->input->post('desc'),
        );      
        $this->Sales_model->edittransactionline($this->input->post('tlno'),$tl);

        redirect('Sales_con');
    }
    
    // //--------------------------------------------------------------------------


    public function deletetransactionline($tl)
    {                            
        $this->Sales_model->deletetransactionline($tl);

        redirect('Sales_con');
    }
    
    // //--------------------------------------------------------------------------

    public function selectcustomer($c)
    {                            

        $this->session->set_userdata(['customer' => $c]);  
        redirect('Sales_con');
    }
    
    //--------------------------------------------------------------------------  


    public function deletecustomer($c)
    {                            
        $this->session->unset_userdata('customer');           
        redirect('Sales_con');
    }
    
    //--------------------------------------------------------------------------  

    public function resetsessiontransaction()
    {                            
        $this->session->unset_userdata('customer');  
        $this->session->unset_userdata('refno');  
        $this->session->unset_userdata('discount');  
        $this->session->unset_userdata('totalqty');
        $this->session->unset_userdata('totaldiscount');
        $this->session->unset_userdata('totalamount');
        $this->session->unset_userdata('cashonhand');
        $this->session->unset_userdata('change');
        $this->session->unset_userdata('type');
    
    }
    
    //--------------------------------------------------------------------------  


    public function resettransaction()
    {                            
        $this->resetsessiontransaction();

        $this->Sales_model->deletealltransactionline($this->session->userdata('id'));

        redirect('Sales_con');
    }
    
    //--------------------------------------------------------------------------  

    public function processsales()
    {                            
        if($this->input->post('discount') == null) {
        $discount = 0; }else {
            $discount = $this->input->post('discount');
        }

        $tldiscount = $discount+$this->input->post('tldiscount');
        $totalamount = $this->input->post('totalamount')-$this->input->post('discount');

        $change = $this->input->post('cashonhand')-$totalamount;    

        $this->session->set_userdata(['date' => $this->input->post('date')]);
        $this->session->set_userdata(['refno' => $this->input->post('refno')]);
        $this->session->set_userdata(['discount' => $discount]);
        $this->session->set_userdata(['totalqty' => $this->input->post('totalqty')]);
        $this->session->set_userdata(['totaldiscount' => $tldiscount]);
        $this->session->set_userdata(['totalamount' => $totalamount]);
        $this->session->set_userdata(['cashonhand' => $this->input->post('cashonhand')]);
        $this->session->set_userdata(['change' => $change]);
        $this->session->set_userdata(['type' => $this->input->post('type')]);

        if($this->session->userdata('customer') == null)
        {
            $this->data['customer'] = null;
        }else {
            $this->data['customer'] = $this->Customer_model->customerinfo($this->session->userdata('customer'));
        }  
        $this->data['tl'] = $this->Sales_model->get_transactionline($this->session->userdata('id')); // customer list

        $this->render_html('sales/salesprocess_view', false); 
    }
    
    //--------------------------------------------------------------------------  

    public function submitsales()
    {    
        
        $t = array(
            'date' => $this->session->userdata('date'), 
            'ref_no' => $this->session->userdata('refno'),
            'discount' => $this->session->userdata('discount'),
            'totalqty' => $this->session->userdata('totalqty'),
            'totaldiscount' => $this->session->userdata('totaldiscount'),
            'totalamount' => $this->session->userdata('totalamount'),
            'cashonhand' => $this->session->userdata('cashonhand'),
            'change' => $this->session->userdata('change'),
            'type' => $this->session->userdata('type'),
            'user_id' => $this->session->userdata('id'),
            'customer_c_no' => $this->session->userdata('customer'),               
        );
        $tno = $this->Sales_model->inserttransaction($t); //insert data to transaction        
        $this->Sales_model->updatetransactionline($tno, $this->session->userdata('id')); //update t_no to transactionline 
        $desc = "SALES";
        $this->Producthistory_model->insert_salesproducthistory($tno, $desc);//insert data to product history
        $this->Product_model->updatesalesproductqty($tno); // update product qty

        if($this->session->userdata('customer') == null) {}else {    
            $ch = array(
                'date' => $this->session->userdata('date'),
                'description' => $desc,
                'amount' => $this->session->userdata('totalamount'),
                'customer_c_no' => $this->session->userdata('customer'),
                'user_id' => $this->session->userdata('id'),
                'transaction_t_no' => $tno,
            );
            $this->Customer_model->insert_customersaleshistory($ch);
        } 

        $this->session->set_userdata(['tno' => $tno]);
        $this->session->set_userdata(['cno' => $this->session->userdata('customer')]);
        $this->resetsessiontransaction(); // reset session

        redirect('Receipt_con');
    }
    
    // //--------------------------------------------------------------------------

    public function voidtransaction($tno, $c)
    {    
        $v = array(
            'type' => 'VOID',
        );
        $this->Sales_model->updatetransaction($tno, $v);
        
        $desc = "VOID";
        $this->Producthistory_model->insert_salesreturnproducthistory($tno, $desc);//insert data to product history
        $this->Product_model->updatesalesreturnproductqty($tno); // update product qty

        $tinfo = $this->Sales_model->get_transactioninfo($tno); //insert data to transaction     

        if($c == null || $c == '0') {}else {    
            $ch = array(
                'date' => $tinfo[0]->date,
                'description' => $desc,
                'amount' => $tinfo[0]->totalamount,
                'customer_c_no' => $tinfo[0]->customer_c_no,
                'user_id' => $this->session->userdata('id'),
                'transaction_t_no' => $tno,
            );
            $this->Customer_model->insert_customersaleshistory($ch);
        } 

        redirect('Sales_con/transactionlist');
    }
    
    // //--------------------------------------------------------------------------



    public function transactioninfo($tno, $c)
    {                            
        $this->session->set_userdata(['tno' => $tno]);
        $this->session->set_userdata(['cno' => $c]);
        redirect('Receipt_con');
    }
    
    //--------------------------------------------------------------------------  

}
