<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
class Customer_con extends MY_Controller
{
		var $com = '', $user = '';

    public function __construct() 
    {
      parent::__construct();
      $this->load->model('User_model');
      $this->load->model('Company_model');
      $this->load->model('Customer_model');
      $this->load->model('Heading_model');

      $this->com = $this->Company_model->get_companyinfo();
      $this->user = $this->User_model->get_users($this->session->userdata('u_no'));

      $this->data = [
      		'users' => $this->user,
      		'hidebtn' => 0,
      		'com' => $this->com
      	];

      if(!$this->session->userdata('u_no')) {
        $this->logout();
      }
    }

    public function index()
    {
      $this->render_html('sidebar/customer/new_customer');
    }
    
    //--------------------------------------------------------------------------           
    
    public function customerview()
    {                       
        $cus = $this->Customer_model->get_customeractive();
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        $this->load->view('sidebar/customer/customer_view', array('cus' => $cus, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }       
    
    //--------------------------------------------------------------------------  
    
    public function insertvar()
    {
        $uno = $this->input->post('u_no');$name = $this->input->post('name');$address = $this->input->post('address');$telno = $this->input->post('telno');$gender = $this->input->post('gender');$cl = $this->input->post('creditlimit');$terms = $this->input->post('terms');$discount = $this->input->post('discount');$sched = $this->input->post('sched');$stat = 'ACTIVE';$tc = $this->input->post('totalcredit');
        $cus = array(
            'name' => $name,'address' => $address,'telno' => $telno,'totalcredit' => $tc,'creditlimit' => $cl,'gender' => $gender,'terms' => $terms,'discount' => $discount,'schedule' => $sched,'status' => $stat,'u_no' => $uno,
        );
        return $cus;
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertcustomer()
    {
        $cus = $this->insertvar();        
        $this->Customer_model->insert_customer($cus);
        $this->customerview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function updatecustomer()
    {
        $this->Customer_model->update_customer();
        $this->customerview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function updatech()
    {
        $this->Customer_model->update_ch();
       
        $cno = $this->input->post('c_no');
        
        $cus = $this->Customer_model->get_customerinfo($cno);
        $cushist = $this->Customer_model->get_customerhistoryinfo($cno);
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        
        $activeTab = '2';
        $this->load->view('sidebar/customer/customer_update', array('activeTab' => $activeTab , 'cushist' => $cushist,'cus' => $cus, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function customerinfo($cno)
    {                     
        $cus = $this->Customer_model->get_customerinfo($cno);
        $cushist = $this->Customer_model->get_customerhistoryinfo($cno);
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        
        $activeTab = '1';
        $this->load->view('sidebar/customer/customer_update', array('activeTab' => $activeTab , 'cushist' => $cushist,'cus' => $cus, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function delcustomer($cno, $uno)
    {             
        $this->Customer_model->del_customer($cno, $uno);
        $this->customerview();
    }
    
    //--------------------------------------------------------------------------  

    public function ajax_insertCustomer()
    {
      if($this->input->is_ajax_request()){
        parse_str($this->input->post('data'), $inputs);
        
        $this->load->model('customer_model');
        $id = $this->customer_model->post_customer($inputs);

        $this->output->set_output(json_encode(['value' => $id, 'text' => ucwords($inputs['name'])]));
      }
    }
    
    public function allcustomerprint()
    {             
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $cus = $this->Customer_model->get_customeractive();
        $sum = $this->Customer_model->totalcredit();
        $this->load->view('sidebar/customer/report/print', array('sum' => $sum,'com' => $com,'users' => $users, 'cus' => $cus));
    }
    
    //-------------------------------------------------------------------------- 
    
    public function allcustomerprintexcel()
    {             
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $cus = $this->Customer_model->get_customeractive();
        $sum = $this->Customer_model->totalcredit();
        $this->load->view('sidebar/customer/report/excelprint', array('sum' => $sum,'com' => $com,'users' => $users, 'cus' => $cus));
    }
    
    //-------------------------------------------------------------------------- 
    
    public function customerinfoprint($cno)
    {                     
        $cus = $this->Customer_model->get_customerinfo($cno);
        $cushist = $this->Customer_model->get_customerhistoryinfo($cno);        
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/customer/report/customerinfoprint', array('com' => $com, 'cushist' => $cushist,'cus' => $cus, 'users' => $users));           
    }
    
    //--------------------------------------------------------------------------
    
     public function customerinfoexcelprint($cno)
    {                     
        $cus = $this->Customer_model->get_customerinfo($cno);
        $cushist = $this->Customer_model->get_customerhistoryinfo($cno);        
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('sidebar/customer/report/customerinfoexcelprint', array('com' => $com, 'cushist' => $cushist,'cus' => $cus, 'users' => $users));           
    }
    
    //--------------------------------------------------------------------------
}
