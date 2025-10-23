<?php
 
class Repayment_model extends CI_Model
{

  //----------------------------------------------------------------------

  public function get_repaymentthismonth() 
  {
    $sql = "SELECT sum(due_amount) as sumda, sum(amount_payed) as sumap
          from repayment 
          where MONTH(due_date) = MONTH(CURDATE())
          and YEAR(due_date) = YEAR(CURDATE())";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_payedthismonth() 
  {
    $sql = "SELECT sum(amount_payed) as sumap
          from repayment 
          where MONTH(date_payed) = MONTH(CURDATE())
          and YEAR(date_payed) = YEAR(CURDATE())
          and post = 'POSTED'";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function updaterepayment($r, $rno) 
  {  
      $this->db->where('r_no',$rno)
              ->update('repayment', $r);
  }
  

  //--------------------------------------------------------------------------  

}
