<?php

class Expenses_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_expenses($u) 
  {
  
    $sql = "Select * from expenses where date = CURDATE() and user_id = '$u'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------


  public function insertexpenses($e = null) 
  {  
      $this->db->insert('expenses',$e);
  }

  //--------------------------------------------------------------------------     

  public function updateexpenses($e, $exp = null) 
    {  
        $this->db->where('e_no',$e)
                ->update('expenses', $exp);
    }

    //--------------------------------------------------------------------------       

    public function deleteexpenses($eno) 
    {                       
         $this->db->delete('expenses', array('e_no' => $eno));
    }

}
