<?php
 
class Creditreturn_model extends CI_Model
{
 
  //----------------------------------------------------------------------
  
  public function get_returntransactionline($u) 
  {
  
    $sql = "SELECT t.*, t.qty as rtlqty, p.name as name, p.*
              from returntransactionline t 
              join product p on p.p_no = t.product_p_no
              where t.user_id = '$u' 
              and t.returntransaction_rt_no is null";
    $query = $this->db->query($sql);
    return $query->result();
  }

 
  //----------------------------------------------------------------------

  public function get_customer() 
  {
  
    $sql = "SELECT DISTINCT(d.customer_c_no), c.name as name, c.*
            from creditduedate d
            join customer c on c.c_no = d.customer_c_no 
            where d.status is null";
    $query = $this->db->query($sql);
    return $query->result();
  }

 
  //----------------------------------------------------------------------

  public function get_creditduedate($c) 
  {
  
    $sql = "SELECT * FROM creditduedate where customer_c_no = '$c' and status is null";
    $query = $this->db->query($sql);
    return $query->result();
  }

 
  //----------------------------------------------------------------------

  public function get_creditduedateinfo($c) 
  {
  
    $sql = "SELECT * FROM creditduedate where cdd_no = '$c'";
    $query = $this->db->query($sql);
    return $query->result();
  }

 
  //----------------------------------------------------------------------

   public function get_transactionline($c, $u) 
  {
  
    $sql = "SELECT t.*, p.name as name, p.p_no as p_no 
            from transactionline t
            join product p on p.p_no = t.product_p_no
            where t.transaction_t_no = (select transaction_t_no 
                            from creditduedate 
                            where cdd_no = '$c' 
                            and amount > amountpayed
                            or cdd_no = '$c' 
                            and amountpayed is null
                            or cdd_no = '$c' 
                            and status != 'PAYED'
                            or cdd_no = '$c' 
                            and status != 'CANCELLED'
                            or cdd_no = '$c' 
                            and amount = '0')
            and t.product_p_no not in (SELECT product_p_no
              from returntransactionline 
              where user_id = '$u' 
              and returntransaction_rt_no is null)";
    $query = $this->db->query($sql);
    return $query->result();
  }

 
  //----------------------------------------------------------------------

  public function updatereturntransactionline($rtno, $u) 
  {
  
    $sql = "UPDATE returntransactionline set returntransactionline.returntransaction_rt_no = '$rtno' 
            WHERE returntransactionline.user_id = '$u' 
            AND returntransactionline.returntransaction_rt_no is NULL";
        return $this->db->query($sql);
  }

 
  //----------------------------------------------------------------------

   public function insertreturntransaction($rt = null) 
  {  
      $this->db->insert('returntransaction',$rt);
      return $this->db->insert_id();
  }

  // //--------------------------------------------------------------------------   

  public function insertreturntransactionline($rtl = null) 
  {  
      $this->db->insert('returntransactionline',$rtl);
  }

  // //--------------------------------------------------------------------------      

    public function deletereturntransactionline($rtl) 
    {                       
         $this->db->delete('returntransactionline', array('rtl_no' => $rtl));
    }

    //--------------------------------------------------------------------------    

    public function update_creditduedate($cddno, $cdd = null) 
    {  
        $this->db->where('cdd_no',$cddno)
                ->update('creditduedate', $cdd);
    }

    //--------------------------------------------------------------------------       

    public function updatereturnqtytransactionline($t) // update returnqty in transactionline from Credit Return
    {
        $sql = "update transactionline set transactionline.returnqty = (select returntransactionline.qty "
                                            . "from returntransactionline "
                                            . "where returntransactionline.product_p_no = transactionline.product_p_no "
                                            . "and returntransactionline.returntransaction_rt_no = '$t') "
                    . "where transactionline.product_p_no IN (select returntransactionline.product_p_no "
                                            . "from returntransactionline "
                                            . "where returntransactionline.product_p_no = transactionline.product_p_no "
                                            . "and returntransactionline.returntransaction_rt_no = '$t')";
        return $this->db->query($sql);
    }
    
  //--------------------------------------------------------------------------    
    public function deleteallreturntransactionline($u) 
    {                       
        $sql = "DELETE FROM returntransactionline WHERE user_id ='$u' and returntransaction_rt_no is null";
       return $this->db->query($sql);
    }
}
