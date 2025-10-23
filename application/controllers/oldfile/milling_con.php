<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milling_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Formulation_model');
        $this->load->model('Heading_model');
        $this->load->model('Product_model');
        $this->load->model('Milling_model');
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function index()
    {                           
        $m = $this->Milling_model->get_milling();
        $users = $this->Heading_model->user_det();
        $prod = $this->Product_model->get_productactive();
        $u = $this->User_model->get_user();
        $this->Heading_model->incwithsidebar();
        $this->load->view('poultry/milling/milling_view', array('u' => $u, 'prod' => $prod, 'users' => $users, 'm' => $m));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertmview($mno)
    {
        $m = $this->Milling_model->get_millinginfo($mno);
        $f = $this->Formulation_model->get_formulation();
        $ml = $this->Milling_model->get_millinglineinfo($mno);
        $prod = $this->Product_model->get_productactive();
        $mprod = $this->Milling_model->get_productinfo($mno);
        $summl = $this->Milling_model->get_summillingline($mno);
        $users = $this->Heading_model->user_det();
        $this->Heading_model->inchide();
        $this->load->view('poultry/milling/milling_insert', array( 'summl' => $summl, 'f' => $f , 'mprod' => $mprod , 'ml' => $ml, 'm' => $m, 'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertmvar()
    {
        $ref_no = $this->Milling_model->get_maxref_no();
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
        $this->Milling_model->insert_m_no($refno, $filestat, $u_no);
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertview()
    {
        $this->insertmvar();
        $max = $this->Milling_model->get_maxmno();
        $m_no = $max[0]->m_no;
        $this->insertmview($m_no);        
    }
    
    //--------------------------------------------------------------------------  
    
    public function selectoutputprod($pno, $mno)
    {
        $this->Milling_model->insertoutputprod($pno, $mno);    
        $this->insertmview($mno);        
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertml()
    {
        $mno = $this->input->post('m_no');
        $pno = $this->input->post('p_no');
        $up = $this->input->post('unitprice');
        $uom = $this->input->post('uom');
        $packing = $this->input->post('packing');
        $qty = $this->input->post('qty');
        $pcs = $this->input->post('pcs');
        $ta = $this->input->post('ta');
        $uc = $this->input->post('uc');
        $ml = array( 'm_no' => $mno, 'p_no' => $pno, 'unitprice' => $up, 'uom' => $uom, 'packing' => $packing,
            'qty' => $qty, 'pc' => $pcs, 'totalamount' => $ta, 'unitcost' => $uc);
        
        $this->Milling_model->insertml($ml);    
        $this->insertmview($mno);        
    }
    
    //--------------------------------------------------------------------------  
    
    public function editm($mno)
    {        
        $this->insertmview($mno);        
    }
    
    //--------------------------------------------------------------------------  
    
     public function updatemqty()
    {        
        $mno = $this->input->post('m_no');             
        $this->Milling_model->updatemqty();
        $this->insertmview($mno);        
    }
    
    //-------------------------------------------------------------------------- 
    
    public function closedm($mno)
    {                            
        $this->Milling_model->closedm($mno);
        $this->index();        
    }
    
    
    //-------------------------------------------------------------------------- 
    
     public function selectformulation($fno, $mno)
    {        
        $this->Milling_model->selectformulation($fno, $mno);
        $this->insertmview($mno);        
    }
    
    //--------------------------------------------------------------------------   
    
    public function delml($mlno, $mno)
    {        
        $this->Milling_model->delml($mlno);
        $this->insertmview($mno);        
    }
    
    //--------------------------------------------------------------------------   
    
    public function savem()
    {          
        $this->Milling_model->savem();
        $this->index();              
    }
    
    //--------------------------------------------------------------------------   
    
    public function postmilling($mno)
    {          
        $u = $this->Heading_model->user_det();
        $uno = $u[0]->u_no;
        $this->Milling_model->postm($mno, $uno);
        $this->index();              
    }
    
    //--------------------------------------------------------------------------   
    
     public function delmilling($mno)
    {          
        $this->Milling_model->delm($mno);
        $this->index();              
    }
    
    //-------------------------------------------------------------------------- 
    
    public function printm($mno)
    {        
        $m = $this->Milling_model->get_millinginfoprint($mno);
        $ml = $this->Milling_model->get_millinglineinfo($mno);
        $users = $this->User_model->get_user();        
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('poultry/milling/report/print', array('com' => $com, 'm' => $m, 'ml' => $ml, 'user' => $users ));      
    }
    
    //-------------------------------------------------------------------------- 
}
