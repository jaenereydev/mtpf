<?php

class Supplier_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_supplier() 
  {
  
    $sql = "Select * from supplier where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

	public function insertsupplier($sup = null) 
	  {  
	      $this->db->insert('supplier',$sup);
	  }

 //----------------------------------------------------------------------

    public function updatesupplier($s, $sup = null) 
    {  
        $this->db->where('s_no',$s)
                ->update('supplier', $sup);
    }

    //-------------------------------------------------------------------------- 

}
