<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchaseorder_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Product_model');
        $this->load->model('Purchaseorder_model');        
        $this->load->model('Supplier_model');
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------   
    
     public function user_det()
    {
        $user_id = $this->session->userdata('u_no');
        $users = $this->User_model->get_users($user_id);
        
        return $users;
    }
    
    //--------------------------------------------------------------------------   
    
    public function incwithsidebar()
    {
        $users = $this->user_det();
        $com = $this->Company_model->get_companyinfo();
        $hidebtn = '0';
        $this->load->view('inc/header_view', array('hidebtn' => $hidebtn, 'users' => $users, 'com' => $com));
        $this->load->view('inc/sidebar_view', array('hidebtn' => $hidebtn, 'users' => $users));
    }
    
    //--------------------------------------------------------------------------  
    
    public function inc()
    {
        $users = $this->user_det();
        $hidebtn = '0';
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inc/header_view', array('hidebtn' => $hidebtn, 'users' => $users, 'com' => $com));
    }
    
    //--------------------------------------------------------------------------     
    
    public function inchide()
    {
        $users = $this->user_det();
        $hidebtn = '1';
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inc/header_view', array('hidebtn' => $hidebtn, 'users' => $users, 'com' => $com));
    }
    
    //--------------------------------------------------------------------------     
    
    public function orderingview()
    {               
        $ord = $this->Purchaseorder_model->get_orderingactive();        
        $sup= $this->Supplier_model->get_suppliers();        
        $users = $this->user_det();
        $this->incwithsidebar();
        $this->load->view('sidebar/purchaseorder/purchaseorder_view', array('sup' => $sup, 'users' => $users, 'ord' => $ord));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function searchpo()
    {               
        $search = $this->input->post('search');
        $ord = $this->Purchaseorder_model->get_searchpo($search);
        $sup= $this->Supplier_model->get_suppliers();        
        $users = $this->user_det();
        $this->incwithsidebar();
        $this->load->view('sidebar/purchaseorder/purchaseorder_view', array('sup' => $sup, 'users' => $users, 'ord' => $ord));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------             
    
     public function insert_orderinginsertview()
    {               
        $ref_no = $this->Purchaseorder_model->get_maxref_no();
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
        $filestat = 'OPEN';    
        $status = 'ACTIVE'; 
        $users = $this->user_det();
        $u_no = $users[0]->u_no;
        $this->Purchaseorder_model->insert_po_no($refno, $filestat, $status, $u_no);
    }
    
    //--------------------------------------------------------------------------  
    
    public function poinsertview($pono)
    {
        $po = $this->Purchaseorder_model->get_purchaseorderinfo($pono);
        $pol_sum = $this->Purchaseorder_model->get_purchaseorderline_sum($pono);
        $pol = $this->Purchaseorder_model->get_purchaseorderline($pono);
        $sup = $this->Supplier_model->get_suppliers();
        $prod = $this->Product_model->get_productactive();
        $supactive = $this->Supplier_model->get_supplieractive();
        $users = $this->user_det();
        
        $this->inchide();
        $this->load->view('sidebar/purchaseorder/purchaseorder_insert', array('prod' => $prod, 'polsum' => $pol_sum, 'pol' => $pol, 'supactive' => $supactive, 'sup' => $sup, 'users' => $users, 'po' => $po));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
    public function viewdoc($pono)
    {
        $po = $this->Purchaseorder_model->get_purchaseorderinfo($pono);
        $pol_sum = $this->Purchaseorder_model->get_purchaseorderline_sum($pono);
        $pol = $this->Purchaseorder_model->get_purchaseorderline($pono);
        $sup = $this->Supplier_model->get_suppliers();
        $prod = $this->Product_model->get_productactive();
        $supactive = $this->Supplier_model->get_suppliers();
        $users = $this->user_det();
        
        $this->inchide();
        $this->load->view('sidebar/purchaseorder/purchaseorder_insertview', array('prod' => $prod, 'polsum' => $pol_sum, 'pol' => $pol, 'supactive' => $supactive, 'sup' => $sup, 'users' => $users, 'po' => $po));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------
    
     public function orderinginsertview()
    {   
        $this->insert_orderinginsertview();
        $po_no = $this->Purchaseorder_model->get_maxpo_no();
        $pono = $po_no[0]->po_no;
        $this->poinsertview($pono);
    }
        
    //--------------------------------------------------------------------------
    
    
    public function backpurchaseorder($pono)
    {               
        $this->poinsertview($pono);
    }
    
    //--------------------------------------------------------------------------
    
    public function insertproductview()
    {
        $this->Purchaseorder_model->updatepo_insertprodut();
        $po_no = $this->input->post('po_no2');
        $s_no = $this->input->post('s_no1');
        $po = $this->Purchaseorder_model->get_purchaseorderinfo($po_no);
        $prod = $this->Product_model->get_productactive_po($po_no, $s_no);
        $users = $this->user_det();
        
        $this->inchide();
        $this->load->view('sidebar/purchaseorder/purchaseorder_insertproduct', array('prod' => $prod, 'users' => $users, 'po' =>$po));
        $this->load->view('inc/footer_view');
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function searchprod()
    {               
        $search = $this->input->post('search');
        $po_no = $this->input->post('po_no');
        $s_no = $this->input->post('s_no');
        $po = $this->Purchaseorder_model->get_purchaseorderinfo($po_no);
        $prod = $this->Product_model->get_searchproductactive_po($po_no, $s_no, $search);
        $users = $this->user_det();        
        $this->inchide();
        $this->load->view('sidebar/purchaseorder/purchaseorder_insertproduct', array('prod' => $prod, 'users' => $users, 'po' =>$po));
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertproductline($pp_no, $po_no)
    {
        $users = $this->user_det();        
        $prod_no = $this->Product_model->get_productinfo($pp_no);
        
        $u_no = $users[0]->u_no;
        $p_no = $prod_no[0]->p_no;
        $up = $prod_no[0]->unitprice;
        $qty = '1';
        $uom = $prod_no[0]->uom;
        $packing = $prod_no[0]->packing;    
        $pcs = $qty*$packing;
        $this->Purchaseorder_model->updatepo_insertproduct($p_no,$up,$qty,$u_no,$po_no,$uom,$packing,$pcs);     
                      
        $this->poinsertview($po_no);
    }
    
    //--------------------------------------------------------------------------  
    
    public function updateproduct()
    {
        $users = $this->user_det();        
        $u_no = $users[0]->u_no;
        $po_no = $this->input->post('po_no');
        
        $this->Purchaseorder_model->update_pol($u_no);
        
        $this->poinsertview($po_no);
    }


    //--------------------------------------------------------------------------  
    
    public function delpurchaseorderline($polno, $pono)
    {
        $this->Purchaseorder_model->del_pol($polno);
        $this->poinsertview($pono);
    }
    
    //--------------------------------------------------------------------------  
    
    public function edit_po($pono)
    {      
        $this->Purchaseorder_model->openpo($pono);
        $this->poinsertview($pono);
    }
    
    //--------------------------------------------------------------------------  
    
    public function update_po()
    {
        $users = $this->user_det();        
        $u_no = $users[0]->u_no;
        $this->Purchaseorder_model->update_posave($u_no);
        $this->orderingview();
    }
    
    //-------------------------------------------------------------------------- 
    
     
    public function closepo($pono)
    {       
        $this->Purchaseorder_model->closepo($pono);
        $this->orderingview();
    }
    
    //-------------------------------------------------------------------------- 
    
    
    public function postpo($po_no)
    {
        $users = $this->user_det();        
        $u_no = $users[0]->u_no;
        $this->Purchaseorder_model->post_po($u_no, $po_no);
        $this->orderingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function delpo($po_no)
    {        
        $this->Purchaseorder_model->del_po($po_no);
        $this->orderingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function backupdatepo($po_no)
    {        
        $this->Purchaseorder_model->close_po($po_no);
        $this->orderingview();
    }
    
    //--------------------------------------------------------------------------  
    
    public function printdoc($po_no)
    {
        $users = $this->User_model->get_user();                
        $po = $this->Purchaseorder_model->get_purchaseorderinfo($po_no);
        $polsum = $this->Purchaseorder_model->get_purchaseorderline_sum($po_no);
        $pol = $this->Purchaseorder_model->get_purchaseorderline($po_no);
        $com = $this->Company_model->get_companyinfo();
        $sup= $this->Supplier_model->get_supplieractive();        
        $this->load->view('sidebar/purchaseorder/report/print', array( 'polsum' => $polsum, 'sup' => $sup, 'com' => $com, 'users' => $users, 'po' => $po, 'pol' => $pol));
    }
    
    //--------------------------------------------------------------------------  
}
