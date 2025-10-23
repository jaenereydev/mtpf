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
    $this->companyname = $_POST['companyname'];
    $this->proprietor = $_POST['prop'];
    $this->address = $_POST['address'];
    $this->contact_no = $_POST['contactnumber'];
    $this->bir_no = $_POST['birno'];
    
    $this->db->update('company', $this, array('c_no' => $_POST['c_no']));
  }

  //----------------------------------------------------------------------
  
  public function upload_logo()
  {
    $path = '/mtpf/images/company/'.$_POST['img'];
    $this->logo   = $path;
      
    $this->db->update('company', $this, array('c_no' => $_POST['c_no']));
  }
  
  //----------------------------------------------------------------------

}
