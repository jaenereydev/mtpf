<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Formulation_con extends CI_Controller
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
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function formulationview()
    {                           
        $f = $this->Formulation_model->get_formulation();
        $users = $this->Heading_model->user_det();
        $prod = $this->Product_model->get_productactive();
        $this->Heading_model->incwithsidebar();
        $this->load->view('poultry/formulation/formulation_view', array('prod' => $prod, 'users' => $users, 'f' => $f));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertfview($fno)
    {
        $f = $this->Formulation_model->get_formulationinfo($fno);
        $fl = $this->Formulation_model->get_formulationlineinfo($fno);
        $prod = $this->Product_model->get_productactive();
        $fprod = $this->Formulation_model->get_productinfo($fno);
        $users = $this->Heading_model->user_det();
        $this->Heading_model->inchide();
        $this->load->view('poultry/formulation/formulation_insert', array('fprod' => $fprod , 'fl' => $fl, 'f' => $f, 'users' => $users, 'prod' => $prod));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertfvar()
    {
        $max = $this->Formulation_model->get_maxfno();
        if($max[0]->f_no == null)
        {
            $f_no = '1';
        }else{
            $f_no = $max[0]->f_no+1;
        }        
        $finsert = array(            
            'f_no' => $f_no, 
        );
        return $finsert;
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertview()
    {
        $finsert = $this->insertfvar();
        $this->Formulation_model->insert_formulation($finsert);
        $max = $this->Formulation_model->get_maxfno();
        $f_no = $max[0]->f_no;
        $this->insertfview($f_no);        
    }
    
    //--------------------------------------------------------------------------  
    
    public function selectoutputprod($pno, $fno)
    {
        $this->Formulation_model->insertoutputprod($pno, $fno);    
        $this->insertfview($fno);        
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertfl()
    {
        $fno = $this->input->post('f_no');
        $pno = $this->input->post('p_no');
        $up = $this->input->post('unitprice');
        $uom = $this->input->post('uom');
        $packing = $this->input->post('packing');
        $qty = $this->input->post('qty');
        $pcs = $this->input->post('pcs');
        $ta = $this->input->post('ta');
        $uc = $this->input->post('uc');
        $fl = array( 'f_no' => $fno, 'p_no' => $pno, 'unitprice' => $up, 'uom' => $uom, 'packing' => $packing,
            'qty' => $qty, 'pcs' => $pcs, 'totalamount' => $ta, 'unitcost' => $uc);
        
        $this->Formulation_model->insertfl($fl);    
        $this->insertfview($fno);        
    }
    
    //--------------------------------------------------------------------------  
    
    public function editf($fno)
    {        
        $this->insertfview($fno);        
    }
    
    //--------------------------------------------------------------------------   
    
     public function delformulation($fno)
    {        
        $this->Formulation_model->delfor($fno);
        $this->formulationview();        
    }
    
    //--------------------------------------------------------------------------   
    
    public function delfl($flno, $fno)
    {        
        $this->Formulation_model->delfl($flno);
        $this->insertfview($fno);        
    }
    
    //--------------------------------------------------------------------------   
    
    public function savef()
    {        
        $this->Formulation_model->savef();
        $this->formulationview();              
    }
    
    //--------------------------------------------------------------------------   
}
