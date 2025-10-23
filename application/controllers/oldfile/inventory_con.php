<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Inventory_model');
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
    
    public function inventoryview()
    {               
        $inv = $this->Inventory_model->get_inventory(); 
        $sup = $this->Supplier_model->get_supplieractive();
        $cat = $this->Category_model->get_catactive();
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('inventory/inventory/inventory_view', array('cat' => $cat, 'users' => $users, 'inv' => $inv, 'sup' => $sup));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
     public function insertrefno()
    {               
        $ref_no = $this->Inventory_model->get_maxref_no();
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
        $this->Inventory_model->insert_i_no($refno, $filestat, $u_no);
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertinv()
    {        
        $s_no = $this->input->post('s_no');$c_no = $this->input->post('c_no');
        if($s_no == "0")
        {
            $this->insertrefno();$i_no = $this->Inventory_model->get_maxi_no();$ino = $i_no[0]->i_no;
            if($c_no == "0") { $this->Inventory_model->insert_allinventoryline($ino); }
            else { $this->Inventory_model->insert_allinventorylinebycat($ino, $c_no); }                        
            $this->invinsertview($ino);
        }else 
        {
            $this->insertrefno();
            $i_no = $this->Inventory_model->get_maxi_no();
            $ino = $i_no[0]->i_no;
            $this->Inventory_model->update_snoinventory($ino, $s_no);
            if($c_no == "0"){ $this->Inventory_model->insert_inventoryline($ino, $s_no);} 
            else { $this->Inventory_model->insert_inventorylinebycat($ino, $s_no, $c_no); }            
            $this->invinsertview($ino);
        }
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function printcountsheet()
    {        
        $users = $this->User_model->get_user();  
        $s_no = $this->input->post('s_no');$c_no = $this->input->post('c_no');
        $sup = $this->Supplier_model->get_supplieractive();
        $com = $this->Company_model->get_companyinfo();
        if($s_no == "0")
        {            
            if($c_no == "0") { $prod = $this->Product_model->get_productactive(); }
            else { $prod = $this->Product_model->get_productactivebycat($c_no); }                        
            $this->load->view('inventory/inventory/report/printcountsheet', array('com' => $com, 'sup' => $sup, 'user' => $users, 'prod' => $prod));
        }else 
        {
            if($c_no == "0") { $prod = $this->Product_model->get_productactivebysup($s_no); }
            else { $prod = $this->Product_model->get_productactivebysupcat($s_no, $c_no); }                        
            $this->load->view('inventory/inventory/report/printcountsheet', array('com' => $com, 'sup' => $sup, 'user' => $users, 'prod' => $prod));
        }
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function invinsertview($ino)
    {        
        $inv = $this->Inventory_model->get_inventoryinfo($ino);
        $invl = $this->Inventory_model->get_inventoryline($ino);
        $sup = $this->Supplier_model->get_supplieractive();
        $users = $this->Heading_model->user_det();        
        $this->Heading_model->inchide();
        $this->load->view('inventory/inventory/inventory_insert', array('sup' => $sup, 'inv' => $inv, 'invl' => $invl, 'users' => $users ));
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function printinv($ino)
    {        
        $inv = $this->Inventory_model->get_inventoryinfo($ino);
        $invl = $this->Inventory_model->get_inventoryline($ino);
        $sup = $this->Supplier_model->get_supplieractive();
        $users = $this->User_model->get_user();        
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inventory/inventory/report/print', array('com' => $com, 'sup' => $sup, 'inv' => $inv, 'invl' => $invl, 'user' => $users ));
      
    }
    
    //-------------------------------------------------------------------------- 
    
    public function updateproduct()
    {        
        $ino = $this->input->post('i_no');
        $this->Inventory_model->update_invl();
        $this->invinsertview($ino);
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function editinv($ino)
    {        
        $this->Inventory_model->open_inv($ino);
        $this->invinsertview($ino);
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function update_saveinv()
    {   
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $ino = $this->input->post('i_no');
        $sum = $this->Inventory_model->suminv($ino);
        $qty = $sum[0]->qty;
        $ta = $sum[0]->ta;
        $this->Inventory_model->updatesaveinv($u_no, $qty, $ta);
        $this->inventoryview();
        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function closeinv($ino)
    {        
        $this->Inventory_model->close_inv($ino);
        $this->inventoryview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function delinv($ino)
    {        
        $this->Inventory_model->del_inv($ino);
        $this->inventoryview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function postinv($ino)
    {        
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Inventory_model->post_inv($ino, $u_no);
        $this->inventoryview();
        
    }
    
    //--------------------------------------------------------------------------  
    
    
}
