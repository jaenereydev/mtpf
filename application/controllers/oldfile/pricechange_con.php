<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricechange_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');        
        $this->load->model('Company_model'); 
        $this->load->model('Product_model'); 
        $this->load->model('Pricechange_model'); 
        $this->load->model('Heading_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------        
    
    public function pricechangeview()
    {                       
        $pc = $this->Pricechange_model->get_pricechange();
        $this->Heading_model->incwithsidebar();
        $users = $this->Heading_model->user_det();
        $this->load->view('inventory/pricechange/pricechange_view', array('pc' => $pc, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------           
    
    public function insert_pcinsertview()
    {               
        $ref_no = $this->Pricechange_model->get_maxref_no();
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
        $this->Pricechange_model->insert_pc_no($refno, $filestat, $u_no);
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertpricechangeview($pcno)
    {                       
        $pc = $this->Pricechange_model->get_pricechangeinfo($pcno);
        $pcl = $this->Pricechange_model->get_pricechangelineinfo($pcno);
        $prod = $this->Product_model->get_productactive();        
        $this->Heading_model->inchide();
        $users = $this->Heading_model->user_det();
        $this->load->view('inventory/pricechange/pricechange_insert', array('prod' => $prod, 'pcl' => $pcl, 'pc' => $pc, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function updatepc($pcno)
    {                       
        $this->Pricechange_model->open_pc($pcno);
        $this->insertpricechangeview($pcno);
    }
    
    //--------------------------------------------------------------------------
    
    public function searchprod()
    {                       
        $pcno = $this->input->post('pc_no');
        $search = $this->input->post('search');
        $pc = $this->Pricechange_model->get_pricechangeinfo($pcno);
        $prod = $this->Product_model->get_productsearch_pcl($search, $pcno);        
        $this->Heading_model->inc();
        $users = $this->Heading_model->user_det();
        $this->load->view('inventory/pricechange/pricechange_insertproduct', array('prod' => $prod, 'pc' => $pc, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertproductview()
    {                       
        $pcno = $this->input->post('pc_no');
        $this->Pricechange_model->update_pc();
        $pc = $this->Pricechange_model->get_pricechangeinfo($pcno);
        $prod = $this->Pricechange_model->get_product($pcno);        
        $this->Heading_model->inc();
        $users = $this->Heading_model->user_det();
        $this->load->view('inventory/pricechange/pricechange_insertproduct', array('prod' => $prod, 'pc' => $pc, 'users' => $users));   
        $this->load->view('inc/footer_view');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function insertproduct($pno, $pcno)
    {                       
        $this->Pricechange_model->insert_prod($pno);       
        $this->insertpricechangeview($pcno);
    }
    
    //-------------------------------------------------------------------------- 
    
    public function delpricechangeline($pclno, $pcno)
    {                       
        $this->Pricechange_model->del_pcl($pclno);       
        $this->insertpricechangeview($pcno);
    }
    
    //-------------------------------------------------------------------------- 
    
    
    public function pricechangeinsert()
    {                       
        $this->insert_pcinsertview();
        $pc_no = $this->Pricechange_model->get_maxpc_no();
        $pcno = $pc_no[0]->pc_no;
        $this->insertpricechangeview($pcno);
    }
    
    //-------------------------------------------------------------------------- 
    
    public function pricechangelinevar()
    {
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $pcno = $this->input->post('pc_no');
        $p_no = $this->input->post('p_no');
        $olduom = $this->input->post('uomold');$newuom = $this->input->post('uomnew');
        $oldpacking = $this->input->post('packingold');$newpacking = $this->input->post('packingnew');
        $oldunitprice = $this->input->post('unitpriceold');$newunitprice = $this->input->post('unitpricenew');
        $oldunitcost = $this->input->post('unitcostold');
        $oldp1 = $this->input->post('p1old');$newp1 = $this->input->post('p1new');$oldp2 = $this->input->post('p2old');$newp2 = $this->input->post('p2new');$oldp3 = $this->input->post('p3old');$newp3 = $this->input->post('p3new');$oldp4 = $this->input->post('p4old');$newp4 = $this->input->post('p4new');$oldp5 = $this->input->post('p5old');$newp5 = $this->input->post('p5new');$oldp6 = $this->input->post('p6old');$newp6 = $this->input->post('p6new');$oldp7 = $this->input->post('p7old');$newp7 = $this->input->post('p7new');$oldp8 = $this->input->post('p8old');$newp8 = $this->input->post('p8new');$oldp9 = $this->input->post('p9old');$newp9 = $this->input->post('p9new');$oldp10 = $this->input->post('p10old');$newp10 = $this->input->post('p10new');$oldp11 = $this->input->post('p11old');$newp11 = $this->input->post('p11new');
        $newunitcost = ($newunitprice/$newpacking);
        $insertpc = array(
            'user' => $u_no,'pc_no' => $pcno,'p_no' => $p_no,
            'olduom' => $olduom,'newuom' => $newuom,
            'oldpacking' => $oldpacking,'newpacking' => $newpacking,
            'oldunitprice' => $oldunitprice,'newunitprice' => $newunitprice,
            'oldunitcost' => $oldunitcost,'newunitcost' => $newunitcost,
            'oldprice1' => $oldp1,'newprice1' => $newp1,'oldprice2' => $oldp2,'newprice2' => $newp2,'oldprice3' => $oldp3,'newprice3' => $newp3,'oldprice4' => $oldp4,'newprice4' => $newp4,'oldprice5' => $oldp5,'newprice5' => $newp5,'oldprice6' => $oldp6,'newprice6' => $newp6,'oldprice7' => $oldp7,'newprice7' => $newp7,'oldprice8' => $oldp8,'newprice8' => $newp8,'oldprice9' => $oldp9,'newprice9' => $newp9,'oldprice10' => $oldp10,'newprice10' => $newp10,'oldprice11' => $oldp11,'newprice11' => $newp11,
        );
        return $insertpc;
    }
    
            
    //--------------------------------------------------------------------------     
    
    public function updateproductprice()
    {
        $insertpc = $this->pricechangelinevar();
        $this->Pricechange_model->insert_pricechangeline($insertpc);
        $pcno = $this->input->post('pc_no');               
        $this->insertpricechangeview($pcno);
    }
    
            
    //-------------------------------------------------------------------------- 
    
    public function updatepricechangeline()
    {        
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Pricechange_model->update_pricechangeline($u_no);
        $pcno = $this->input->post('pc_no');               
        $this->insertpricechangeview($pcno);
    }
    
            
    //-------------------------------------------------------------------------- 
            
    public function closepc($pc_no)
    {                       
        $this->Pricechange_model->close_pc($pc_no);
        $this->pricechangeview();
    }
    
    //--------------------------------------------------------------------------
    
    public function delpc($pc_no)
    {                       
        $this->Pricechange_model->del_pc($pc_no);
        $this->pricechangeview();
    }
    
    //--------------------------------------------------------------------------
    
    public function postpc($pc_no)
    {                       
        $this->Pricechange_model->post_pc($pc_no);
        $this->pricechangeview();
    }
    
    //--------------------------------------------------------------------------
    
    public function update_savepc()
    {                       
        $this->Pricechange_model->updatesavepc();
        $this->pricechangeview();
    }
    
    //-------------------------------------------------------------------------- 
    
    public function printpc($pcno)
    {                               
        $pc = $this->Pricechange_model->get_pricechangeinfo($pcno);
        $pcl = $this->Pricechange_model->get_pricechangelineinfo($pcno);
        $prod = $this->Product_model->get_productactive();     
        $user = $this->Pricechange_model->get_user($pcno);
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inventory/pricechange/report/print', array('user' => $user,'prod' => $prod, 'pcl' => $pcl, 'pc' => $pc,'com'=>$com));   
   
    }
    
    //-------------------------------------------------------------------------- 
}
