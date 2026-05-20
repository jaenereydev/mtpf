<?php

class Customer_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_customer() 
  {
  
    $sql = "Select * from customer where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_customersearch($c) 
  {
  
    $sql = "Select * from customer where active = 'YES' and name like '%$c%'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function searchname($c) 
  {
  
    $sql = "Select * from customer where active = 'YES' and name = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_customerdeposit() 
  {
  
    $sql = "Select d.*, c.name as name, c.balance as balance 
            from customerdeposit d
            join customer c on c.c_no = d.customer_c_no ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function countcustomer() 
  {
  
    $sql = "Select count(c_no) as c from customer where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function insertcustomer($cus = null) 
  {  
      return $this->db->insert('customer',$cus);
  }

  //--------------------------------------------------------------------------     

  public function customerinfo($c) 
  {
  
    $sql = "Select * from customer where c_no = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function customerdepositinfo($d) 
  {
  
    $sql = "Select * from customerdeposit where cd_no = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_totalaccountrecievables()
  {
    $sql = "Select sum(balance) as ta from customer where active = 'YES'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function customersaleshistory($c) 
  {
  
    $sql = "Select c.*, u.name as name
            from customersales_history c 
            join user u on u.id = c.user_id
            where c.customer_c_no = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function customercredithistory($c) 
  {
  
    $sql = "Select c.*, u.name as name
            from customerbalance_history c
            join user u on u.id = c.user_id
            where c.customer_c_no = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function updatecustomer($c, $cus = null) 
    {  
        if (empty($c) || empty($cus)) {
            return false;
        }

        $this->db->where('c_no',$c);
        return $this->db->update('customer', $cus);
    }

    //--------------------------------------------------------------------------   

    public function deletecustomerdeposit($d)
    {  
        $this->db->where('cd_no',$d)
                ->delete('customerdeposit');
    }

    //--------------------------------------------------------------------------  

  public function insert_customersaleshistory($c = null) //insert data from POS module
  {
      $this->db->insert('customersales_history',$c);
  }


  //----------------------------------------------------------------------

  public function customerdeposit($c = null) //insert data 
  {
      $this->db->insert('customerdeposit',$c);
  }


  //----------------------------------------------------------------------

  public function insert_customerbalancehistory($c = null) //insert data from credit module
  {
      $this->db->insert('customerbalance_history',$c);
  }


  //----------------------------------------------------------------------

  public function insert_creditduedate($c = null) //insert data from credit module
  {
      $this->db->insert('creditduedate',$c);
  }


  //----------------------------------------------------------------------

  public function customercount()
  {
      return $this->db
          ->where('active', 'YES')
          ->count_all_results('customer');
  }

  //----------------------------------------------------------------------

  public function customerbalance()
  {
      $sql = "SELECT COALESCE(SUM(CAST(balance AS DECIMAL(12,2))), 0) AS total_balance
              FROM customer";

      $query = $this->db->query($sql);
      $row = $query->row();

      return $row->total_balance ? $row->total_balance : 0;
  }


  //----------------------------------------------------------------------

  public function get_customerlist()
  {
      $this->db->select('*');
      $this->db->from('customer');
      $this->db->where('active', 'YES');
      $this->db->order_by('name', 'ASC');

      return $this->db->get()->result();
  }

  //----------------------------------------------------------------------
  //----------------------------------------------------------------------
  //----------------------------------------------------------------------
  //----------------------------------------------------------------------

}
