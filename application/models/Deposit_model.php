<?php

class Deposit_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_deposit($u) 
  {
  
    $sql = "Select * from deposit where date = CURDATE() and user_id = '$u'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------


  public function insertdeposit($d = null) 
  {  
      $this->db->insert('deposit',$d);
  }

  //--------------------------------------------------------------------------     

    public function deletedeposit($dno) 
    {                       
         $this->db->delete('deposit', array('d_no' => $dno));
    }

}
