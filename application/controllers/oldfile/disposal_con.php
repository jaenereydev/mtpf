<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Disposal_con extends CI_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');   
        $this->load->model('Disposal_model');
        $this->load->model('Product_model');
        $this->load->model('Heading_model'); 
        
        $user_id = $this->session->userdata('u_no');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------              
    
    public function index()
    {               
        $dis = $this->Disposal_model->get_disposal();        
        $users = $this->Heading_model->user_det();
        $this->Heading_model->incwithsidebar();
        $this->load->view('inventory/disposal/disposal_view', array('users' => $users, 'dis' => $dis));
        $this->load->view('inc/footer_view');
    }
    
    //--------------------------------------------------------------------------  
    
    public function disposalinsertview($dno)
    {    
        $d = $this->Disposal_model->get_disposalinfo($dno);
        $dl = $this->Disposal_model->get_disposallineinfo($dno);
        $prod = $this->Disposal_model->get_product($dno);
        $sum = $this->Disposal_model->get_sumqty($dno);
        $users = $this->Heading_model->user_det();
        $this->Heading_model->inchide();
        $this->load->view('inventory/disposal/disposal_insert', array('sum' => $sum, 'users' => $users, 'prod' => $prod, 'd' => $d, 'dl' => $dl));
        $this->load->view('inc/footer_view');   
    }
    
    //--------------------------------------------------------------------------  
    
    public function insertdisposalvar()
    {        
        $filestat = 'OPEN'; 
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $dno = array('filestat' => $filestat, 'u_no' => $u_no,);
        $this->Disposal_model->insert_d_no($dno);
    }
       
    //--------------------------------------------------------------------------  
    
    public function insertdisposal()
    {
        $this->insertdisposalvar();
        $dno = $this->Disposal_model->get_maxdno();
        $d_no = $dno[0]->d_no;
        $this->disposalinsertview($d_no);
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function update_savedisposal()
    {
        $this->Disposal_model->update_savedisposal();
        redirect('disposal_con');
    }
    
    //--------------------------------------------------------------------------  
    
    public function closedisposal($dno)
    {        
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Disposal_model->closedisposal($dno, $u_no);
        redirect('disposal_con');
    }
    
    //--------------------------------------------------------------------------  
    
     public function insertdl()
    {        
        $pno = $this->input->post('p_no');
        $dno = $this->input->post('d_no');
        $qty = $this->input->post('qty');
        $dl = array('qty' => $qty, 'd_no' => $dno, 'p_no' => $pno);
        $this->Disposal_model->insertdl($dl);
        $this->disposalinsertview($dno);
    }
    
    //--------------------------------------------------------------------------  
    
    public function editdl()
    {                
        $dno = $this->input->post('d_no');
        $this->Disposal_model->updatedl();
        $this->disposalinsertview($dno);
    }
    
    //-------------------------------------------------------------------------- 
    
    public function deldl($dlno, $dno)
    {                        
        $this->Disposal_model->deldl($dlno);
        $this->disposalinsertview($dno);
    }
    
    //-------------------------------------------------------------------------- 
    
    public function deldisposal($dno)
    {                        
        $this->Disposal_model->deld($dno);
        redirect('disposal_con');
    }
    
    //-------------------------------------------------------------------------- 

     public function postdisposal($dno)
    {           
        $users = $this->Heading_model->user_det();
        $u_no = $users[0]->u_no;
        $this->Disposal_model->postdisposal($dno, $u_no);
        redirect('disposal_con');
    }
    
    //-------------------------------------------------------------------------- 
    
    public function printdisposal($dno)
    {           
        $d = $this->Disposal_model->get_disposalinfo($dno);
        $dl = $this->Disposal_model->get_disposallineinfo($dno);        
        $sum = $this->Disposal_model->get_sumqty($dno);
        $users = $this->Heading_model->user_det();
        $com = $this->Company_model->get_companyinfo();
        $this->load->view('inventory/disposal/report/print', array('com' => $com, 'sum' => $sum, 'users' => $users, 'd' => $d, 'dl' => $dl));
    }
    
    //-------------------------------------------------------------------------- 
    
}
