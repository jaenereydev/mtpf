<?php
 
class Creditloan_model extends CI_Model
{

  //----------------------------------------------------------------------

  public function get_openloan() 
  {
  
    $sql = "SELECT count(cl_no) as cl FROM credit_loan WHERE status = 'OPEN'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_allcreditloan() 
  {
  
    $sql = "SELECT * FROM credit_loan WHERE status = 'OPEN'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_customercreditloan($c) 
  {
  
    $sql = "SELECT * FROM credit_loan WHERE customer_c_no = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_repayment($clno) 
  {
  
    $sql = "SELECT * from repayment where credit_loan_cl_no = '$clno'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_creditloaninfo($clno) 
  {
  
    $sql = "SELECT * from credit_loan where cl_no = '$clno'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_creditloan($clno) 
  {
  
    $sql = "SELECT c.*, a.name as aname, t.name as tname, t.*
              from credit_loan c
              join customer t on t.c_no = c.customer_c_no
              join user a on a.id = c.agent_id
              where c.cl_no = '$clno'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_creditloannoagent($clno) 
  {
  
    $sql = "SELECT c.*, t.name as tname, t.*
              from credit_loan c
              join customer t on t.c_no = c.customer_c_no
              where c.cl_no = '$clno'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_creditloanlineinfo($clno) 
  {
  
    $sql = "SELECT t.*, t.qty as tlqty, p.name as name, p.barcode as barcode, t.description as description
              from creditloanline t 
              join product p on p.p_no = t.product_p_no
              where t.credit_loan_cl_no = '$clno'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_creditloanline($u) 
  {
  
    $sql = "SELECT t.*, t.qty as tlqty, p.name as name, p.barcode as barcode, p.*, t.description as description
              from creditloanline t 
              join product p on p.p_no = t.product_p_no
              where t.user_id = '$u' 
              and t.credit_loan_cl_no is null";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function updatecreditloanline($clno, $u) 
  {
  
    $sql = "UPDATE creditloanline set creditloanline.credit_loan_cl_no = '$clno' 
            WHERE creditloanline.user_id = '$u' 
            AND creditloanline.credit_loan_cl_no is NULL";
        return $this->db->query($sql);
  }

 
  //----------------------------------------------------------------------

  public function insertcreditloanline($cl = null) 
  {  
      $this->db->insert('creditloanline',$cl);
  }

  //--------------------------------------------------------------------------    

  public function insertcreditloan($cl = null) 
  {  
      $this->db->insert('credit_loan',$cl);
      return $this->db->insert_id();
  }

  //-------------------------------------------------------------------------- 
  
  public function insertrepayment($rn = null) 
  {  
      $this->db->insert('repayment',$rn);
  }

  //--------------------------------------------------------------------------

  public function editcreditloanline($cllno, $cl = null) 
  {  
      $this->db->where('cll_no',$cllno)
              ->update('creditloanline', $cl);
  }
  

  //--------------------------------------------------------------------------  

  public function updatecreditloan($clno, $cl = null) 
  {  
      $this->db->where('cl_no',$clno)
              ->update('credit_loan', $cl);
  }
  

  //-------------------------------------------------------------------------- 

    public function deletecreditloanline($cll) 
    {                       
         $this->db->delete('creditloanline', array('cll_no' => $cll));
    }

    //--------------------------------------------------------------------------   

    public function deletealltransactionline($u) 
    {                       
        $sql = "DELETE FROM creditloanline WHERE user_id ='$u' and credit_loan_cl_no is null";
       return $this->db->query($sql);
    }
}
