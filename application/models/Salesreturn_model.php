<?php
 
class Salesreturn_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_transactionline($u) 
  {
  
    $sql = "SELECT t.*, t.qty as tlqty, p.name as name, p.barcode as barcode, p.*
              from transactionline t 
              join product p on p.p_no = t.product_p_no
              where t.user_id = '$u' 
              and t.transaction_t_no is null";
    $query = $this->db->query($sql);
    return $query->result();
  }

 
  //----------------------------------------------------------------------

  public function updatetransactionline($tno, $u) 
  {
  
    $sql = "UPDATE transactionline set transactionline.transaction_t_no = '$tno' 
            WHERE transactionline.user_id = '$u' 
            AND transactionline.transaction_t_no is NULL";
        return $this->db->query($sql);
  }

 
  //----------------------------------------------------------------------

  public function inserttransactionline($tl = null) 
  {  
      $this->db->insert('transactionline',$tl);
  }

  // //--------------------------------------------------------------------------     

   public function inserttransaction($t = null) 
  {  
      $this->db->insert('transaction',$t);
      return $this->db->insert_id();
  }

  // //--------------------------------------------------------------------------     

  public function edittransactionline($tno, $tl = null) 
  {  
      $this->db->where('tl_no',$tno)
              ->update('transactionline', $tl);
  }
  

  //   //--------------------------------------------------------------------------        

    public function deletetransactionline($tl) 
    {                       
         $this->db->delete('transactionline', array('tl_no' => $tl));
    }

    //--------------------------------------------------------------------------       

    public function deletealltransactionline($u) 
    {                       
        $sql = "DELETE FROM transactionline WHERE user_id ='$u' and transaction_t_no is null";
       return $this->db->query($sql);
    }
}
