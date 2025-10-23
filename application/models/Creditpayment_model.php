<?php

class Creditpayment_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_creditpaymentlist($user) 
  {
  
    $sql = "Select p.*, c.name as name 
            from customerpayment p 
            join customer c on c.c_no = p.customer_c_no
            where p.date = CURDATE() 
            and p.user_id = '$user'
            or p.post is null 
            order by p.cp_no desc";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

 public function get_creditpaymentposted($user) 
  {
  
    $sql = "Select p.*, c.name as name 
            from customerpayment p 
            join customer c on c.c_no = p.customer_c_no
            where p.date = CURDATE() 
            and p.user_id = '$user'
            and p.post = 'YES'";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

 public function get_datecreditpaymentposted($user, $d) 
  {
  
    $sql = "Select p.*, c.name as name 
            from customerpayment p 
            join customer c on c.c_no = p.customer_c_no
            where p.date = '$d' 
            and p.user_id = '$user'
            and p.post = 'YES'";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------
 public function get_totalcreditpaymentperuser() 
  {
  
    $sql = "SELECT sum(c.totalpayment) as tpayment, u.name as name, count(c.cp_no) as cno
            FROM customerpayment c
            JOIN user u ON u.id = c.user_id
            where c.date = CURDATE()
            and c.post = 'YES'
            GROUP BY c.user_id";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

   public function get_customerwithbalance() 
  {
  
    $sql = "Select * from customer where balance != '0' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

  public function insertcreditpayment($c = null) 
  {  
      $this->db->insert('customerpayment',$c);
     return $this->db->insert_id();
  }

 //----------------------------------------------------------------------

   public function insertcustomerpaymentline($c = null) 
  {  
      $this->db->insert('customerpaymentline',$c);
     return $this->db->insert_id();
  }

 //----------------------------------------------------------------------

   public function insertcreditduedateline($c = null) 
  {  
      $this->db->insert('creditduedateline',$c);
     return $this->db->insert_id();
  }

 //----------------------------------------------------------------------

  public function get_creditduedatelist($c) 
  {
  
    $sql = "Select d.*, c.*
            from creditduedateline c 
            join creditduedate d on d.cdd_no = c.creditduedate_cdd_no 
            where c.customerpayment_cp_no = '$c' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

  public function get_countcreditduedatelist($c) 
  {
  
    $sql = "Select count(c.cddl_no) as c
            from creditduedateline c 
            join creditduedate d on d.cdd_no = c.creditduedate_cdd_no 
            where c.customerpayment_cp_no = '$c' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

   public function get_creditduedate($c, $cp) 
  {
  
    $sql = "SELECT * 
            FROM creditduedate            
            where customer_c_no = '$c' 
            and status is null
            and cdd_no not in (select creditduedate_cdd_no from creditduedateline where customerpayment_cp_no = '$cp')";
    $query = $this->db->query($sql);
    return $query->result();
  }

 
  //----------------------------------------------------------------------


  public function get_customerpaymentinfo($c)
  {
  
    $sql = "Select d.*, c.name as name, c.balance as balance 
            from customerpayment d 
            join customer c on c.c_no = d.customer_c_no 
            where d.cp_no = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

   public function get_customerpaymentline($c)
  {
  
    $sql = "Select d.*
            from customerpaymentline d 
            join customerpayment c on c.cp_no = d.customerpayment_cp_no 
            where d.customerpayment_cp_no = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }

//----------------------------------------------------------------------


public function updatecreditpayment($cpno, $c =null)
{
  $this->db->where('cp_no', $cpno)
          ->update('customerpayment', $c);
}

//---------------------------------------------------------------------- 

public function deletecustomerpaymentline($c) 
  {                       
       $this->db->delete('customerpaymentline', array('cpl_no' => $c));
  }

  //----------------------------------------------------------------------

  public function deleteallline($c) 
  {                       
      $this->db->delete('creditduedateline', array('customerpayment_cp_no' => $c));
      $this->db->delete('customerpaymentline', array('customerpayment_cp_no' => $c));
  }

  //----------------------------------------------------------------------

  public function deletecreditduedateline($c) 
  {                       
      $this->db->delete('creditduedateline', array('cddl_no' => $c));
  }

  //----------------------------------------------------------------------

  public function deletecustomerpayment($c) 
  {                       
      $this->db->delete('customerpayment', array('cp_no' => $c));
  }

  //----------------------------------------------------------------------

  public function updatecreditpaymentpayed($c, $desc)
  {                       
      
    $sql = "UPDATE creditduedate set creditduedate.amountpayed = (SELECT creditduedate.amountpayed+customerpayment.totalpayment 
                                              from customerpayment 
                                              where customerpayment.cp_no = '$c'),
            creditduedate.status = '$desc' 
            WHERE creditduedate.cdd_no in (select creditduedateline.creditduedate_cdd_no 
                                from creditduedateline 
                                where creditduedateline.customerpayment_cp_no = '$c') ";
    return $this->db->query($sql);
  }

  //----------------------------------------------------------------------

  public function updatecreditpaymentpayednull($c)
  {                       
      
    $sql = "UPDATE creditduedate set creditduedate.amountpayed = (SELECT creditduedate.amountpayed+customerpayment.totalpayment 
                                              from customerpayment 
                                              where customerpayment.cp_no = '$c')
            WHERE creditduedate.cdd_no in (select creditduedateline.creditduedate_cdd_no 
                                from creditduedateline 
                                where creditduedateline.customerpayment_cp_no = '$c') ";
    return $this->db->query($sql);
  }

  //----------------------------------------------------------------------

  public function updatecustomerbalancehistory($c)
  {                       
      
    $sql = "INSERT into customerbalance_history(date, description, ci_payment, ref_no, balance, customer_c_no, user_id) "
          . "SELECT d.date, 'CREDIT PAYMENT', d.totalpayment, d.cp_no, c.balance-d.totalpayment, d.customer_c_no, d.user_id 
              from customerpayment d 
              join customer c on c.c_no = d.customer_c_no 
              where d.cp_no = '$c' ";
        return $this->db->query($sql);
  }

  //----------------------------------------------------------------------


}
