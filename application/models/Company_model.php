<?php

class Company_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_companyinfo() 
  {
  
    $sql = "Select * from company where c_no = '1'";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------
  
  public function insert_company($companyprof) 
  {
    $this->db->insert('company',$companyprof);
    return $this->db->insert_id();
  }

  //----------------------------------------------------------------------
  
  public function update_company() 
  {
    $this->name = $_POST['companyname'];
    $this->address = $_POST['address'];
    $this->telno = $_POST['telno'];
    
    $this->db->update('company', $this, array('c_no' => $_POST['c_no']));
  }

  //----------------------------------------------------------------------  

}
