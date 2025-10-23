<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accountreceivable_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');  
        $this->load->model('Customer_model');  
        $this->load->model('Accountreceivable_model');
        $this->load->model('Heading_model');
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }        
    
    public function arview()
    {               
        $ar = $this->Accountreceivable_model->get_aractive();  
        $cus = $this->Customer_model->get_customeractive();
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/accountreceivable/ar_view', array('cus' => $cus,'users' => $users, 'ar' => $ar));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertarvar()
    {
        $ref_no = $this->Accountreceivable_model->get_maxref_no();
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
        $ar = array('ref_no' => $refno, 'file_stat' => $filestat, 'status' => $status, 'u_no' => $u_no);
        $this->Accountreceivable_model->insert_ar_no($ar);   
    }
       
    //--------------------------------------------------------------------------  
    
    public function arinsertview($arno)
    {
        $ar = $this->Accountreceivable_model->get_arinfo($arno);
        $cno = $ar[0]->c_no;
        if($cno == null){ $cpl = null; $arlstat = null; }
        else { 
            $cpl = $this->Accountreceivable_model->get_cusco($cno);
            $arlstat = $this->Accountreceivable_model->get_arlstat($cno);
        }
        $arl = $this->Accountreceivable_model->get_arlinfo($arno);        
        $pr = $this->Accountreceivable_model->get_prinfo($arno);
        $sumarl = $this->Accountreceivable_model->get_sumarl($arno);
        $sumpr = $this->Accountreceivable_model->get_sumpr($arno);
        $cus = $this->Customer_model->get_customeractive();
        $users = $this->Heading_model->user_det();
        $this->Heading_model->inchide();
        $this->load->view('sidebar/accountreceivable/ar_insert', array('arlstat' => $arlstat , 'cpl' => $cpl,'cus' => $cus, 'sumarl' => $sumarl, 'sumpr' => $sumpr ,'users' => $users, 'ar' => $ar, 'arl' => $arl, 'pr' => $pr));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function insertarview()
    {
        $this->insertarvar();
        $ar_no = $this->Accountreceivable_model->get_maxar_no();
        $arno = $ar_no[0]->cp_no;
        $this->arinsertview($arno);       
    }
    
    //--------------------------------------------------------------------------            
    
    public function backupdatear($arno)
    {
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Accountreceivable_model->closear($arno, $u_no);
        $this->arview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function selectcus($cno, $arno)
    {            
        $this->Accountreceivable_model->selectcustomer($cno, $arno);
        $this->arinsertview($arno);
    }
    
    //--------------------------------------------------------------------------
    
    public function editcp($arno)
    {          
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Accountreceivable_model->opencp($arno, $u_no);
        $this->arinsertview($arno);
    }
    
    //--------------------------------------------------------------------------
    
    public function insertco($cono, $arno)
    {                  
        $this->Accountreceivable_model->insert_co($cono, $arno);
        $this->arinsertview($arno);
    }
    
    //--------------------------------------------------------------------------
    
    public function insertcplp($cplno, $arno, $pamount)
    {                  
        $this->Accountreceivable_model->insert_cplp($cplno, $arno, $pamount);
        $this->arinsertview($arno);
    }
    
    //--------------------------------------------------------------------------
    
    public function delarl($cpl, $arno)
    {                  
        $this->Accountreceivable_model->del_arl($cpl);
        $this->arinsertview($arno);
    }
    
    //--------------------------------------------------------------------------
    
    public function delpr($pr, $arno)
    {                  
        $this->Accountreceivable_model->del_pr($pr);
        $this->arinsertview($arno);
    }
    
    //--------------------------------------------------------------------------
    
    public function addpayment()
    {                  
        $cp = $this->input->post('arno');
        $checkno = $this->input->post('checkno');
        $bn = $this->input->post('bankname');
        $date = $this->input->post('cdate');
        $d = $this->input->post('description');
        $amount = $this->input->post('amount');
        $pr = array('cp_no' => $cp, 'checkno' => $checkno, 'bankname' => $bn, 'checkdate' => $date, 'description' => $d, 'amount' => $amount);        
        $this->Accountreceivable_model->insertpayment($pr);
        $this->arinsertview($cp);
    }
    
    //--------------------------------------------------------------------------
    
    public function savecp()
    {              
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Accountreceivable_model->savecp($u_no);
        $this->arview();
    }
    
    //--------------------------------------------------------------------------
    
    public function delcp($arno)
    {                      
        $this->Accountreceivable_model->delcp($arno);
        $this->arview();
    }
    
    //--------------------------------------------------------------------------
    
    public function postcp($arno, $c_no, $ta)
    {                      
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $sumarl = $this->Accountreceivable_model->get_sumarl($arno);
        $c = $this->Accountreceivable_model->get_countcpl($arno);
        if($c[0]->cpl_no == 1){
            if($sumarl[0]->amount > $ta) { $stat = "Partial";}else if($sumarl[0]->amount < $ta) { $stat = "Overpayment";}else {$stat = "Fullpayment"; } 
        }else { 
            if($sumarl[0]->amount < $ta) { $stat = "Overpayment";}else {$stat = "Fullpayment"; } 
        }
        $this->Accountreceivable_model->postcp($u_no, $arno, $c_no, $stat);
        $this->arview();
    }
    
    //--------------------------------------------------------------------------
    
    public function printar($arno)
    {                      
        $com = $this->Company_model->get_companyinfo();
        $users = $this->Heading_model->user_det();
        $ar = $this->Accountreceivable_model->get_printarinfo($arno);
        $cpl = $this->Accountreceivable_model->get_arlinfo($arno);
        $pr = $this->Accountreceivable_model->get_prinfo($arno);
        $sumcpl = $this->Accountreceivable_model->get_sumarl($arno);
        $sumpr = $this->Accountreceivable_model->get_sumpr($arno);
        
        $this->load->view('sidebar/accountreceivable/report/print', array('user' => $users,'com' => $com,'sumpr' => $sumpr,'sumcpl' => $sumcpl,'pr' => $pr,'cpl' => $cpl,'ar' => $ar));
    }
    
    //--------------------------------------------------------------------------
    
    
    
}
