<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accountpayable_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');$this->load->model('Company_model');   
        $this->load->model('Product_model');$this->load->model('Purchaseorder_model');
        $this->load->model('Receiving_model');$this->load->model('Supplier_model');
        $this->load->model('Checkref_model');$this->load->model('Accountpayable_model');
        $this->load->model('Heading_model');
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------         
    
    public function accountpayableview()
    {               
        $ap = $this->Accountpayable_model->get_accountpayableactive();        
        $sup= $this->Supplier_model->get_suppliers();           
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/accountpayable/accountpayable_view', array('sup' => $sup, 'users' => $users, 'ap' => $ap));
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function viewpayment($apno)
    {               
        $cr = $this->Checkref_model->get_checkrefinfo($apno);   
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/accountpayable/view_payment', array('cr' => $cr));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------     
    
    public function addpayment()
    {     
        $user_id = $this->session->userdata('u_no');$users = $this->User_model->get_users($user_id);$user = $users[0]->u_no;
        $orno = $this->input->post('orno');$bankname = $this->input->post('bankname');$cno = $this->input->post('checkno');
        $cdate = $this->input->post('date');$amount = $this->input->post('amount');$apno = $this->input->post('apno');
        $checkref = array('ap_no' => $apno,'checkno' => $cno,'checkdate' => $cdate,'checkamount' => $amount,'bankname' => $bankname,'u_no' => $user,'or_no' => $orno,);
        $this->Checkref_model->insertcheckref($checkref);
        $this->accountpayableview();        
    }
    
    public function searchap()
    {               
        $search = $this->input->post('search');
        $ap = $this->Accountpayable_model->get_searchaccountpayableactive($search);        
        $sup= $this->Supplier_model->get_suppliers();           
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/accountpayable/accountpayable_view', array('sup' => $sup, 'users' => $users, 'ap' => $ap));
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
     public function insert_apinsertview()
    {               
        $ref_no = $this->Accountpayable_model->get_maxref_no();
        if($ref_no[0]->ref_no == null){
            $refno = '0000001';
        }else {
            if($ref_no[0]->ref_no == '0000010'){$refno = '00000'.''.($ref_no[0]->ref_no+1);
            }else if($ref_no[0]->ref_no >= '0999999'){ $refno = ($ref_no[0]->ref_no+1);
            }else if($ref_no[0]->ref_no >= '0099999'){ $refno = '0'.''.($ref_no[0]->ref_no+1);
            }else if($ref_no[0]->ref_no >= '0009999'){ $refno = '00'.''.($ref_no[0]->ref_no+1);
            }else if($ref_no[0]->ref_no >= '0000999'){ $refno = '000'.''.($ref_no[0]->ref_no+1);
            }else if($ref_no[0]->ref_no >= '0000099'){ $refno = '0000'.''.($ref_no[0]->ref_no+1);
            }else if($ref_no[0]->ref_no >= '0000009'){ $refno = '00000'.''.($ref_no[0]->ref_no+1);
            }else {$refno = '000000'.''.($ref_no[0]->ref_no+1);}
        }
        $filestat = 'OPEN'; $status = 'ACTIVE'; 
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Accountpayable_model->insert_ap_no($refno, $filestat, $status, $u_no);
    }
    
    //--------------------------------------------------------------------------  
    
    public function apinsertview($apno)
    {
        $ap = $this->Accountpayable_model->get_accountpayableinfo($apno);
        $apl_sum = $this->Accountpayable_model->get_accountpayableline_sum($apno);        
        $apl = $this->Accountpayable_model->get_accountpayableline($apno);
        $del = $this->Accountpayable_model->get_delivery();
        $sup = $this->Supplier_model->get_suppliers();
        $sno = $ap[0]->s_no;
        $apladd = $this->Accountpayable_model->get_apl($sno);
        $users = $this->Heading_model->user_det();
        
        $this->Heading_model->inchide();
        $this->load->view('sidebar/accountpayable/accountpayable_insert', array('apladd' => $apladd, 'del' => $del, 'aplsum' => $apl_sum, 'apl' => $apl, 'sup' => $sup, 'users' => $users, 'ap' => $ap));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function viewdoc($apno)
    {
        $ap = $this->Accountpayable_model->get_accountpayableinfo($apno);
        $apl_sum = $this->Accountpayable_model->get_accountpayableline_sum($apno);        
        $apl = $this->Accountpayable_model->get_accountpayableline($apno);
        $del = $this->Accountpayable_model->get_delivery();
        $sup = $this->Supplier_model->get_suppliers();
        $sno = $ap[0]->s_no;
        $apladd = $this->Accountpayable_model->get_apl($sno);
        $users = $this->Heading_model->user_det();
        
        $this->Heading_model->inchide();
        $this->load->view('sidebar/accountpayable/accountpayable_insertview', array('apladd' => $apladd, 'del' => $del, 'aplsum' => $apl_sum, 'apl' => $apl, 'sup' => $sup, 'users' => $users, 'ap' => $ap));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function selectsup($sno, $apno)
    {           
            $users = $this->Heading_model->user_det(); $u_no = $users[0]->u_no;
            $this->Accountpayable_model->update_accountpayableline($sno, $apno, $u_no);
            $this->apinsertview($apno);        
    }
    
    //--------------------------------------------------------------------------
    
    public function selectdel($dno, $apno)
    {           
            $users = $this->Heading_model->user_det(); $u_no = $users[0]->u_no;
            $this->Accountpayable_model->update_accountpayablelinedel($dno, $apno, $u_no);
            $this->apinsertview($apno);        
    }
    
    //--------------------------------------------------------------------------
    
    public function accountpayableinsertview()
    {   
        $this->insert_apinsertview();
        $ap_no = $this->Accountpayable_model->get_maxap_no();
        $apno = $ap_no[0]->ap_no;
        $this->apinsertview($apno);
    }
        
    //--------------------------------------------------------------------------
    
    public function delap($apno)
    {        
        $this->Accountpayable_model->delap($apno);
        $this->accountpayableview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function backupdateap($apno)
    {        
        $this->Accountpayable_model->close_ap($apno);
        $this->accountpayableview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function delaccountpayableline($aplno, $apno)
    {
        $this->Accountpayable_model->del_apl($aplno);
        $this->apinsertview($apno);
    }
    
    //--------------------------------------------------------------------------  
    
    public function edit_ap($apno)
    {        
        $this->Accountpayable_model->openap($apno);
        $this->apinsertview($apno);
    }
    
    //--------------------------------------------------------------------------  
    
    public function update_ap()
    {
        $users = $this->Heading_model->user_det();        
        $u_no = $users[0]->u_no;
        $this->Accountpayable_model->update_apsave($u_no);
        $this->accountpayableview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function closeap($apno)
    {        
        $this->Accountpayable_model->closeap($apno);
        $this->accountpayableview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function postap($ap_no)
    {
        $users = $this->Heading_model->user_det();        
        $u_no = $users[0]->u_no;
        
        $this->Accountpayable_model->post_ap($u_no, $ap_no);
        $this->accountpayableview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function printdoc($apno)
    {             
        $ap = $this->Accountpayable_model->get_accountpayableinfo($apno);
        $apl_sum = $this->Accountpayable_model->get_accountpayableline_sum($apno);        
        $apl = $this->Accountpayable_model->get_accountpayableline($apno);
        $del = $this->Accountpayable_model->get_delivery();
        $sup = $this->Supplier_model->get_suppliers();
        $com = $this->Company_model->get_companyinfo();
        $sno = $ap[0]->s_no;
        $apladd = $this->Accountpayable_model->get_apl($sno);
        $cr = $this->Checkref_model->get_checkrefinfo($apno); 
        $crsum = $this->Checkref_model->get_sum($apno); 
        $users = $this->Heading_model->user_det();                
        $this->load->view('sidebar/accountpayable/report/print', array('crsum' => $crsum,'cr' => $cr,'com' => $com,'apladd' => $apladd, 'del' => $del, 'aplsum' => $apl_sum, 'apl' => $apl, 'sup' => $sup, 'users' => $users, 'ap' => $ap));
    }
    
    //--------------------------------------------------------------------------  
}
