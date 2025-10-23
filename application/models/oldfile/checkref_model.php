<?php

class Checkref_model extends CI_Model
{   
    public function get_checkrefinfo($apno)
    {
        $sql = "Select * from checkref where ap_no =?";
        $query = $this->db->query($sql, array($apno));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insertcheckref($cref = null)
    {
         $this->db->insert('checkref',$cref);
        return $this->db->insert_id();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_sum($apno)
    {
        $sql = "Select sum(checkamount) as amount from checkref where ap_no =?";
        $query = $this->db->query($sql, array($apno));
        return $query->result();
    }
    
    //--------------------------------------------------------------------------

    public function getPaymentList($date = false, $u_no = false)
    {
        $sql = "SELECT CONCAT('P ', FORMAT(cp.totalamount, 2)) as amount, 
                checkno, checkdate, bankname, cp.date, cpl.ci_no as ci_no, name, pr.description, cp.or_no as or_no
                FROM creditorder co
                JOIN creditpaymentline cpl
                ON co.co_no = cpl.co_no
                JOIN creditpayment cp
                ON cpl.cp_no = cp.cp_no
                LEFT JOIN paymentref pr
                ON cp.cp_no = pr.cp_no
                JOIN customer c
                ON cp.c_no = c.c_no
                WHERE cp.posted = 'POSTED' 
                and pr.description != 'Transfer'
                and pr.description != 'Payroll'
                and pr.description != 'Delivery'
                and cp.date = ";
              if($date)
                $sql .= "'" . $date . "' AND cp.u_no = " . $u_no;
              else
                $sql .= " CURDATE()";
              $sql .= " GROUP BY cp.cp_no";
      return $this->db->query($sql)->result();
    }
     public function getPaymentList2($date = false, $u_no = false)
    {
        
        $sql = "SELECT CONCAT('P ', FORMAT(cp.totalamount, 2)) as amount, 
                checkno, checkdate, bankname, cp.date, name, pr.description, cp.or_no as or_no
                FROM creditpayment cp                
                LEFT JOIN paymentref pr
                ON cp.cp_no = pr.cp_no
                JOIN customer c
                ON cp.c_no = c.c_no                
                WHERE cp.posted = 'POSTED'
                and pr.description != 'Transfer'
                and pr.description != 'Payroll'
                and pr.description != 'Delivery'
                and cp.date = ";
                if($date)
                  $sql .= "'" . $date . "' AND cp.u_no = '" . $u_no ."' ";
                else
                  $sql .= " CURDATE() ";
        $sql .= "and cp.cp_no NOT IN (SELECT cp.cp_no
                        FROM creditorder co
                        JOIN creditpaymentline cpl
                        ON co.co_no = cpl.co_no
                        JOIN creditpayment cp
                        ON cpl.cp_no = cp.cp_no
                        LEFT JOIN paymentref pr
                        ON cp.cp_no = pr.cp_no
                        JOIN customer c
                        ON cp.c_no = c.c_no
                        WHERE cp.posted = 'POSTED' 
                        and pr.description != 'Transfer'
                        and pr.description != 'Payroll'
                        and pr.description != 'Delivery'
                        and cp.date = "; 
                        if($date)
                        { $sql .= "'" . $date . "' AND cp.u_no = '" . $u_no ."' "; }
                        else
                        { $sql .= " CURDATE() ";}
                        $sql .= " GROUP BY cp.cp_no) ";
        $sql .= "GROUP BY cp.cp_no ";
      return $this->db->query($sql)->result();
    }
    

    public function getTodaySum($date = false, $u_no = false)
    {
      $sql = "SELECT 
                CASE
                  WHEN SUM(cpl.amount) IS NULL THEN 0
                  ELSE SUM(cpl.amount)
                END as amount
              FROM creditpayment cp  
              JOIN paymentref pr
              ON cp.cp_no = pr.cp_no
              JOIN creditpaymentline cpl
              ON cp.cp_no = cpl.cp_no
              WHERE date = ";
              if($date)
                $sql .= "'" . $date . "' AND u_no = " . $u_no;
              else
                $sql .= "CURDATE()";
      $result = $this->db->query($sql)->result()[0]->amount;
      return ($result ? $result : 0);
    }


}