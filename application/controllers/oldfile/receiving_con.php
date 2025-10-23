<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receiving_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Product_model');
        $this->load->model('Purchaseorder_model');
        $this->load->model('Receiving_model');
        $this->load->model('Supplier_model');
        $this->load->model('Heading_model');
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------           
    
    public function receivingview()
    {               
        $rec = $this->Receiving_model->get_receivingactive();        
        $sup= $this->Supplier_model->get_suppliers();   
        $porefno = $this->Purchaseorder_model->get_porefno(); 
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/receiving/receiving_view', array('porefno' => $porefno, 'sup' => $sup, 'users' => $users, 'rec' => $rec));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function searchdel()
    {               
        $search = $this->input->post('search');
        $rec = $this->Receiving_model->get_searchreceivingactive($search);        
        $sup= $this->Supplier_model->get_suppliers();   
        $porefno = $this->Purchaseorder_model->get_porefno(); 
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('sidebar/receiving/receiving_view', array('porefno' => $porefno, 'sup' => $sup, 'users' => $users, 'rec' => $rec));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
     public function insert_receivinginsertview()
    {               
        $ref_no = $this->Receiving_model->get_maxref_no();
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
        $this->Receiving_model->insert_d_no($refno, $filestat, $status, $u_no);
    }
    
    //--------------------------------------------------------------------------  
    
    public function delinsertview($dno)
    {
        $del = $this->Receiving_model->get_deliveryinfo($dno);
        $dl_sum = $this->Receiving_model->get_deliveryline_sum($dno);
        $rec = $this->Purchaseorder_model->get_porefno(); 
        $dl = $this->Receiving_model->get_deliveryline($dno);
        $sup = $this->Supplier_model->get_suppliers();
        $prod = $this->Product_model->get_productactive();
        $supactive = $this->Supplier_model->get_supplieractive();
        $users = $this->Heading_model->user_det();
        $po = $this->Purchaseorder_model->get_po();
        
        $this->Heading_model->inchide();
        $this->load->view('sidebar/receiving/receiving_insert', array('rec' => $rec, 'po' => $po, 'prod' => $prod, 'dlsum' => $dl_sum, 'dl' => $dl, 'supactive' => $supactive, 'sup' => $sup, 'users' => $users, 'del' => $del));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function viewdoc($dno)
    {
        $del = $this->Receiving_model->get_deliveryinfo($dno);
        $dl_sum = $this->Receiving_model->get_deliveryline_sum($dno);
        $rec = $this->Purchaseorder_model->get_porefno(); 
        $dl = $this->Receiving_model->get_deliveryline($dno);
        $sup = $this->Supplier_model->get_suppliers();
        $prod = $this->Product_model->get_productactive();
        $supactive = $this->Supplier_model->get_supplieractive();
        $users = $this->Heading_model->user_det();
        $po = $this->Purchaseorder_model->get_po();
        
        $this->Heading_model->inchide();
        $this->load->view('sidebar/receiving/receiving_insertview', array('rec' => $rec, 'po' => $po, 'prod' => $prod, 'dlsum' => $dl_sum, 'dl' => $dl, 'supactive' => $supactive, 'sup' => $sup, 'users' => $users, 'del' => $del));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function searchpoview($dno)
    {               
        $del = $this->Receiving_model->get_deliveryinfo($dno);
        $dl_sum = $this->Receiving_model->get_deliveryline_sum($dno);
        $rec = $this->Purchaseorder_model->get_porefno(); 
        $dl = $this->Receiving_model->get_deliveryline($dno);
        $sup = $this->Supplier_model->get_suppliers();
        $prod = $this->Product_model->get_productactive();
        $supactive = $this->Supplier_model->get_supplieractive();
        $users = $this->Heading_model->user_det();
        $po = $this->Purchaseorder_model->get_po();
        
        $this->Heading_model->inchide();
        $this->load->view('sidebar/receiving/receiving_insertpoview', array('rec' => $rec, 'po' => $po, 'prod' => $prod, 'dlsum' => $dl_sum, 'dl' => $dl, 'supactive' => $supactive, 'sup' => $sup, 'users' => $users, 'del' => $del));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function searchpopo()
    {
        $dno = $this->input->post('d_no');
        $search = $this->input->post('search');
        $del = $this->Receiving_model->get_deliveryinfo($dno);
        $dl_sum = $this->Receiving_model->get_deliveryline_sum($dno);
        $rec = $this->Purchaseorder_model->get_porefno(); 
        $dl = $this->Receiving_model->get_deliveryline($dno);
        $sup = $this->Supplier_model->get_suppliers();
        $prod = $this->Product_model->get_productactive();
        $supactive = $this->Supplier_model->get_supplieractive();
        $users = $this->Heading_model->user_det();
        $po = $this->Purchaseorder_model->get_searchpo($search);
        
        $this->Heading_model->inchide();
        $this->load->view('sidebar/receiving/receiving_insertpoview', array('rec' => $rec, 'po' => $po, 'prod' => $prod, 'dlsum' => $dl_sum, 'dl' => $dl, 'supactive' => $supactive, 'sup' => $sup, 'users' => $users, 'del' => $del));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function selectpo($pono, $dno, $sno, $stat)
    {   
        if( $stat == 'PARTIALDELIVERED')
        {
            $users = $this->Heading_model->user_det(); $u_no = $users[0]->u_no;
            $this->Receiving_model->update_deliverypopd($pono, $dno, $sno, $u_no);
            $this->delinsertview($dno);
        }else 
        {
            $users = $this->Heading_model->user_det(); $u_no = $users[0]->u_no;
            $this->Receiving_model->update_deliverypo($pono, $dno, $sno, $u_no);
            $this->delinsertview($dno);
        }
        
        
    }
    
    //--------------------------------------------------------------------------
    public function receivinginsertview()
    {   
        $this->insert_receivinginsertview();
        $d_no = $this->Receiving_model->get_maxd_no();
        $dno = $d_no[0]->d_no;
        $this->delinsertview($dno);
    }
        
    //--------------------------------------------------------------------------
    
    public function deldel($dno)
    {        
        $this->Receiving_model->deldel($dno);
        $this->receivingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function backupdatedel($dno)
    {        
        $this->Receiving_model->close_del($dno);
        $this->receivingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function backreceiving($dno)
    {               
        $this->delinsertview($dno);
    }
    
    //--------------------------------------------------------------------------
    
    public function insertproductview()
    {
        $this->Receiving_model->updatedel_insertproduct();
        $d_no = $this->input->post('d_no');
        $s_no = $this->input->post('s_no1');
        $del = $this->Receiving_model->get_deliveryinfo($d_no);
        $prod = $this->Product_model->get_productactive_del($d_no, $s_no);
        $users = $this->Heading_model->user_det();
        
        $this->Heading_model->inchide();
        $this->load->view('sidebar/receiving/receiving_insertproduct', array('prod' => $prod, 'users' => $users, 'del' => $del));
        $this->load->view('inc/footer_view');
        
    }
    
    //--------------------------------------------------------------------------                  
    
    public function searchprod()
    {
        $search = $this->input->post('search');
        $d_no = $this->input->post('d_no');
        $s_no = $this->input->post('s_no');
        $del = $this->Receiving_model->get_deliveryinfo($d_no);
        $prod = $this->Product_model->get_searchproductactive_del($d_no, $s_no, $search);
        $users = $this->Heading_model->user_det();         
        $this->Heading_model->inchide();
        $this->load->view('sidebar/receiving/receiving_insertproduct', array('prod' => $prod, 'users' => $users, 'del' => $del));
        $this->load->view('inc/footer_view');
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertdeliveryline($pp_no, $d_no)
    {
        $users = $this->Heading_model->user_det();        
        $prod_no = $this->Product_model->get_productinfo($pp_no);
        
        $u_no = $users[0]->u_no;
        $p_no = $prod_no[0]->p_no;
        $up = $prod_no[0]->unitprice;
        $qty = '1';
        $uom = $prod_no[0]->uom;
        $packing = $prod_no[0]->packing;
        $pcs = $qty*$prod_no[0]->packing;
        $this->Receiving_model->updatedl_insertproduct($p_no,$up,$qty,$u_no,$d_no, $uom, $packing, $pcs);     
                      
        $this->delinsertview($d_no);
    }
    
    //--------------------------------------------------------------------------  
    
    public function updateproduct()
    {
        $users = $this->Heading_model->user_det();        
        $u_no = $users[0]->u_no;
        $d_no = $this->input->post('d_no');        
        $this->Receiving_model->update_dl($u_no);        
        $this->delinsertview($d_no);
    }


    //--------------------------------------------------------------------------  
    
    public function deldeliveryline($dlno, $dno)
    {
        $this->Receiving_model->del_dl($dlno);
        $this->delinsertview($dno);
    }
    
    //--------------------------------------------------------------------------  
    
    public function edit_del($dno)
    {        
        $this->Receiving_model->opendel($dno);
        $this->delinsertview($dno);
    }
    
    //--------------------------------------------------------------------------  
    
    public function update_del()
    {
        $users = $this->Heading_model->user_det();        
        $u_no = $users[0]->u_no;
        $this->Receiving_model->update_delsave($u_no);
        $this->receivingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function closedel($dno)
    {
        $this->Receiving_model->update_delclose($dno);
        $this->receivingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function postdel($d_no, $po_no)
    {
        $users = $this->Heading_model->user_det();        
        $u_no = $users[0]->u_no;
        $porefno = $this->Purchaseorder_model->get_purchaseorderinfo($po_no);
        $po_refno = $porefno[0]->totalamount;
        $dnorefno = $this->Receiving_model->get_sumdeliveryinfo($po_no);
        $d_no_refno = $dnorefno[0]->totalamount;
        if($po_refno > $d_no_refno)
        {
            $stat = "PARTIALDELIVERED";
        }else if($po_refno < $d_no_refno)
        {
            $stat = "OVER DELIVERED";            
        }else if($po_refno == $d_no_refno)
        {
            $stat = "FULLY DELIVERED";
        }
        $this->Receiving_model->post_del($u_no, $d_no, $po_no, $stat);
        $this->receivingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function printdoc($d_no)
    {
        $users = $this->User_model->get_user();                
        $del = $this->Receiving_model->get_deliveryinfo($d_no);
        $delsum = $this->Receiving_model->get_deliveryline_sum($d_no);
        $pono = $del[0]->po_no;
        $po = $this->Purchaseorder_model->get_purchaseorderinfo($pono);
        $dl = $this->Receiving_model->get_deliveryline($d_no);
        $com = $this->Company_model->get_companyinfo();
        $sup= $this->Supplier_model->get_supplieractive();        
        $this->load->view('sidebar/receiving/report/print', array( 'delsum' => $delsum,'po' => $po,'sup' => $sup, 'com' => $com, 'users' => $users, 'del' => $del, 'dl' => $dl));
    }
    
    //--------------------------------------------------------------------------  
}
