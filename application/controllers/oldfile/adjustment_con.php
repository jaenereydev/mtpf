<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adjustment_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Adjustment_model');
        $this->load->model('Product_model');
        $this->load->model('Supplier_model');
        $this->load->model('Category_model');
        $this->load->model('Heading_model');
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------       
    
    public function adjustmentview()
    {               
        $adj = $this->Adjustment_model->get_adjustment(); 
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('inventory/adjustment/adjustment_view', array('users' => $users, 'adj' => $adj));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
     public function insertrefno()
    {               
        $ref_no = $this->Adjustment_model->get_maxref_no();
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
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Adjustment_model->insert_sa_no($refno, $filestat, $u_no);
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertadj()
    {                
            $this->insertrefno();
            $sano = $this->Adjustment_model->get_maxsa_no();
            $sanon = $sano[0]->sa_no;          
            $this->adjustmentinsertview($sanon);
    }
    
    //--------------------------------------------------------------------------    
    
    public function adjustmentinsertview($sano)
    {        
        $adj = $this->Adjustment_model->get_adjustmentinfo($sano);
        $adjl = $this->Adjustment_model->get_adjustmentline($sano);   
        $prod = $this->Product_model->get_productactiveadj($sano);
        $users = $this->Heading_model->user_det();        
        $this->Heading_model->inchide();
        $this->load->view('inventory/adjustment/adjustment_insert', array('products' => $prod, 'adj' => $adj, 'adjl' => $adjl, 'users' => $users ));
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function printadj($sano)
    {        
        $adj = $this->Adjustment_model->get_adjustmentinfo($sano);
        $adjl = $this->Adjustment_model->get_adjustmentline($sano);
        $users = $this->User_model->get_user();        
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inventory/adjustment/report/print', array('com' => $com, 'adj' => $adj, 'adjl' => $adjl, 'user' => $users ));
      
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertadjusmentline($sano, $pno)
    {                
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Adjustment_model->insert_sal($sano, $pno, $u_no);
        $this->adjustmentinsertview($sano);        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function updatesign()
    {        
        $sano = $this->input->post('sa_no');
        $this->Adjustment_model->update_sign();
        $this->adjustmentinsertview($sano);        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function updateproduct()
    {        
        $sano = $this->input->post('sa_no');
        $this->Adjustment_model->update_sal();
        $this->adjustmentinsertview($sano);        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertproduct()
    {        
        $sano = $this->input->post('sa_no');
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $up = $this->input->post('unitprice');
        $pack = $this->input->post('packing');
        $uom = $this->input->post('uom'); 
        $p_no = $this->input->post('p_no');   
        $packing = $this->input->post('packing');
        $qty = $this->input->post('qty');
        $pcs = $this->input->post('pcs');
        $unitprice = $this->input->post('unitprice');
        $unitcost = $up/$pack;
        $totalamount = $this->input->post('ta');
        
        $sal = array('unitprice' => $unitprice,'totalamount' => $totalamount,'qty' => $qty,'p_no' => $p_no,'sa_no' => $sano,'user' => $u_no,'uom' => $uom,'packing' => $packing,'pcs' => $pcs,'unitcost' => $unitcost);
        
        $this->Adjustment_model->insert_sal($sal);
        $this->adjustmentinsertview($sano);        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function editadj($sano)
    {        
        $this->Adjustment_model->open_adj($sano);
        $this->adjustmentinsertview($sano);
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function update_saveadj()
    {   
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $sano = $this->input->post('sa_no');
        $sum = $this->Adjustment_model->sumadj($sano);
        $qty = $sum[0]->qty;
        $ta = $sum[0]->ta;
        $this->Adjustment_model->updatesaveadj($u_no, $qty, $ta);
        $this->adjustmentview();
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function closeadj($sano)
    {        
        $this->Adjustment_model->close_adj($sano);
        $this->adjustmentview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function deladj($sano)
    {        
        $this->Adjustment_model->del_adj($sano);
        $this->adjustmentview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function delsal($salno, $sano)
    {        
        $this->Adjustment_model->del_sal($salno);
        $this->adjustmentinsertview($sano);
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function postadj($sano,$sign)
    {        
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Adjustment_model->post_adj($sano, $u_no, $sign);
        $this->adjustmentview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    
}
