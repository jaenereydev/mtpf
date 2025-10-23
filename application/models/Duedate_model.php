<?php

class Duedate_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_duedate() 
  {
  
    $sql = "SELECT d.*, c.name as name, u.name as username  
            from creditduedate d 
            join customer c on c.c_no = d.customer_c_no 
            join transaction t on t.t_no = d.transaction_t_no
            join user u on u.id = t.user_id
            where d.status is null 
            order by d.duedate ASC";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------  

  public function get_creditduedateinfo($c) 
  {
  
    $sql = "SELECT * from creditduedate where cdd_no = '$c' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------  

  public function get_transaction($t) 
  {
  
    $sql = "SELECT t.*, c.name as name, u.name as username
            from transaction t 
            join customer c on c.c_no = t.customer_c_no 
            join user u on u.id = t.user_id
            where t.t_no = '$t' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------  

  public function get_transactionline($t) 
  {
  
    $sql = "SELECT t.*, p.name as name 
            from transactionline t 
            join product p on p.p_no = t.product_p_no 
            where t.transaction_t_no = '$t' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------  

}
