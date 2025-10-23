<?php
 
class Report_model extends CI_Model
{

  //----------------------------------------------------------------------

  public function get_salesreport($d) 
  {
    $sql = "SELECT s.*, u.*
              from salesreport s
              JOIN user u ON u.id = s.user_id
              WHERE date = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_salesreportinfo($s) 
  {
    $sql = "SELECT *
              from salesreport
              WHERE sr_no = '$s'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_transactionsalesreport($d) 
  {
    $sql = "SELECT t.*, u.*
              from transaction t
              JOIN user u ON u.id = t.user_id
              WHERE date = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_profitreport($d) 
  {
    $sql = "SELECT t.t_no, t.customer_c_no,t.ref_no as ref_no, t.date as date, 
            t.type as type, sum(l.totalunitcost) as total_cost, sum(l.totalamount) as total_amount, 
            (sum(l.totalamount)-sum(l.totalunitcost)) as profit
            FROM transactionline as l 
            JOIN transaction as t on t.t_no = l.transaction_t_no
            WHERE t.date = '$d'
            and t.type = 'CASH'
            OR t.date = '$d' 
            AND t.type = 'CREDIT'
            group by t.t_no;";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------
 
}
