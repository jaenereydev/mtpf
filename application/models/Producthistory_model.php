<?php

class Producthistory_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function insert_deliveryproducthistory($d, $desc) //insert data from delivery
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no,  user_id) "
          . "select o.date, o.ref_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)+l.qty, "
          . "l.product_p_no, o.user_id "
          . "from deliveryline l "
          . "JOIN delivery o ON o.d_no = l.delivery_d_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.d_no = '$d' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

  public function insert_salesproducthistory($tno, $desc) //insert data from POS module SALES and CREDIT
  {
  
    $sql = "Insert into product_history(date, ref_no, description, outqty, bal, product_p_no,  user_id) "
          . "select o.date, o.ref_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)-l.qty, "
          . "l.product_p_no, o.user_id "
          . "from transactionline l "
          . "JOIN transaction o ON o.t_no = l.transaction_t_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.t_no = '$tno' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

  public function insert_creditloanproducthistory($clno, $desc) //insert data from Credit loan module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, outqty, bal, product_p_no,  user_id) "
          . "select c.date, c.cl_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)-l.qty, "
          . "l.product_p_no, c.user_id "
          . "from creditloanline l "
          . "JOIN credit_loan c ON c.cl_no = l.credit_loan_cl_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where c.cl_no = '$clno' "
          . "and p.inventory = 'Yes'";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

   public function insert_salesreturnproducthistory($tno, $desc) //insert data from POS Sales Return module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no,  user_id) "
          . "select o.date, o.ref_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)+l.qty, "
          . "l.product_p_no, o.user_id "
          . "from transactionline l "
          . "JOIN transaction o ON o.t_no = l.transaction_t_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.t_no = '$tno' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

   public function insert_creditreturnproducthistory($rtno, $desc) //insert data from Credit Return module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no,  user_id) "
          . "select o.date, o.rt_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)+l.qty, "
          . "l.product_p_no, o.user_id "
          . "from returntransactionline l "
          . "JOIN returntransaction o ON o.rt_no = l.returntransaction_rt_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.rt_no = '$rtno' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

  public function insert_inventoryproducthistory($ino, $desc) //insert data from inventory module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no,  user_id) "
          . "select o.date, o.i_no, '$desc', l.qty, l.qty, l.product_p_no, o.user_id "
          . "from inventoryline l "
          . "JOIN inventory o ON o.i_no = l.inventory_i_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.i_no = '$ino' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

}
