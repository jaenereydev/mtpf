<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditreturn_con extends MY_Controller
{
    //--------------------------------------------------------------------------
      
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Creditreturn_model');
        $this->load->model('Customer_model');
        $this->load->model('Product_model');
        $this->load->model('Sales_model');
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
        if($this->session->userdata('returncustomer') == null)
        {
            $this->data['returncustomer'] = null;
        }else {
            $this->data['returncustomer'] = $this->Customer_model->customerinfo($this->session->userdata('returncustomer'));
        }  
        if($this->session->userdata('cddno') == null)
        {
            $this->data['returnrefno'] = null;
        }else {
            $this->data['returnrefno'] =  $this->Creditreturn_model->get_creditduedateinfo($this->session->userdata('cddno'));
        }               
                
        $this->data['cus'] = $this->Creditreturn_model->get_customer(); // customer list
        $this->data['rtl'] = $this->Creditreturn_model->get_returntransactionline($this->session->userdata('id')); // credit return product list
        $this->data['creditlist'] = $this->Creditreturn_model->get_creditduedate($this->session->userdata('returncustomer')); // credit list

        $this->data['prod'] = $this->Creditreturn_model->get_transactionline($this->session->userdata('cddno'),$this->session->userdata('id')); // credit list

        $this->render_html('sales/creditreturn_view', false); 
    }
    
    //--------------------------------------------------------------------------

    public function insertreturntransactionline()
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

        $rtl = array(            
            'user_id' => $this->session->userdata('id'),
            'product_p_no' => $this->input->post('pno'),
            'unitcost' => $this->input->post('unitcost'),
            'totalunitcost' => $this->input->post('unitcost')*$this->input->post('qty'),
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('qty'),
            'discount' => $discount,
            'discountamount' => $discountamount,
            'totalamount' => $totalamount,

        );
        $this->Creditreturn_model->insertreturntransactionline($rtl);

        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------       


    public function deletereturntransactionline($tl)
    {                            
        $this->Creditreturn_model->deletereturntransactionline($tl);

        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------

    public function selectcustomer($c)
    {                            

        $this->session->set_userdata(['returncustomer' => $c]);  
        $this->session->unset_userdata('cddno');        
        $this->Creditreturn_model->deleteallreturntransactionline($this->session->userdata('id'));
        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------  

     public function selectrefno($c)
    {                            

        $this->session->set_userdata(['cddno' => $c]);  
        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------  


    public function deletecustomer()
    {                            
        $this->session->unset_userdata('returncustomer');
        $this->session->unset_userdata('cddno');        
        $this->Creditreturn_model->deleteallreturntransactionline($this->session->userdata('id'));    
        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------  

    public function deleterefno()
    {                            
        $this->session->unset_userdata('cddno');           
        $this->Creditreturn_model->deleteallreturntransactionline($this->session->userdata('id'));
        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------  

    public function resetsessiontransaction()
    {                            
        $this->session->unset_userdata('returncustomer');
        $this->session->unset_userdata('cddno');      
       
    }
    
    //--------------------------------------------------------------------------  


    public function resettransaction()
    {                            
        $this->deletecustomer();

        $this->Creditreturn_model->deleteallreturntransactionline($this->session->userdata('id'));

        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------  

    public function processreturn()
    {           

         $rt = array(
            'date' => $this->input->post('date'),            
            'totalqty' => $this->input->post('totalqty'),
            'totalamount' => $this->input->post('totalamount'),            
            'user_id' => $this->session->userdata('id'),  
            'creditduedate_cdd_no' => $this->session->userdata('cddno'),
        );
        $rtno = $this->Creditreturn_model->insertreturntransaction($rt); //insert data to return transaction  

        $this->Creditreturn_model->updatereturntransactionline($rtno, $this->session->userdata('id')); //update rt_no to return transactionline 
        $this->Creditreturn_model->updatereturnqtytransactionline($rtno); //update return qty in transactionline from  returntransactionline 
        $desc = "RETURN CREDIT";
        $this->Producthistory_model->insert_creditreturnproducthistory($rtno, $desc);//insert data to product history        
        $this->Product_model->updatecreditreturnproductqty($rtno); // update product qty        

        $bal = $this->Creditreturn_model->get_creditduedateinfo($this->session->userdata('cddno')); 

        $s = $bal[0]->amount-$this->input->post('totalamount');
        if($s <= 0)
        {
            $stat = 'CANCELLED';
        }else {
            $stat = null;
        }   

        $cdd = array(           
            'amount' => $bal[0]->amount-$this->input->post('totalamount'),    
            'status' => $stat,        
        );
        $this->Creditreturn_model->update_creditduedate($this->session->userdata('cddno'), $cdd);//update credit due date
               
        //update transactin type
        $transactiontype = array(
            'type' => 'CREDIT RETURN',
        );
        $this->Sales_model->updatetransaction($bal[0]->transaction_t_no, $transactiontype);

        $c = $this->Customer_model->customerinfo($this->session->userdata('returncustomer')); // find customer info     
        $cb = array(
            'date' => $this->input->post('date'),           
            'description' => "RETURN CREDIT",
            'ci_payment' => $this->input->post('totalamount'),
            'balance' => $c[0]->balance-$this->input->post('totalamount'),
            'customer_c_no' => $this->session->userdata('returncustomer'),
            'user_id' => $this->session->userdata('id'),
            'ref_no' => $bal[0]->transaction_t_no,
        );
        $this->Customer_model->insert_customerbalancehistory($cb); //insert data in customer balance history

        $cbal = array(        
            'balance' => $c[0]->balance-$this->input->post('totalamount'),         
        );
        $this->Customer_model->updatecustomer($this->session->userdata('returncustomer'), $cbal); //update customer balance

        $this->resettransaction(); // reset session

        redirect('Creditreturn_con');
    }
    
    //--------------------------------------------------------------------------  



}
