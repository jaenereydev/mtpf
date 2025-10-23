<?php

class Delivery_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_delivery() 
  {
  
    $sql = "Select d.*, s.name as name
            from delivery d 
            join supplier s on s.s_no = d.supplier_s_no 
            where d.date = CURDATE() 
            or d.date is null 
            or d.post = 'NO'";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

  public function get_deliverysearch($d) 
  {
  
    $sql = "Select d.*, s.name as name
            from delivery d 
            join supplier s on s.s_no = d.supplier_s_no 
            where d.date like '$d%'
            or d.ref_no like '$d%' 
            or s.name like '$d%' 
            or d.totalamount like '$d%' 
            or d.remarks like '$d%' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

   public function get_deliveryinfo($d) 
  {
  
    $sql = "Select d.*, s.name as name
            from delivery d 
            join supplier s on s.s_no = d.supplier_s_no 
            where d.d_no = '$d' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

public function get_totalaccountpayeble() //get sum of account payable
  {
  
    $sql = "select sum(totalamount) as ta from delivery where post = 'YES' and status is null";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------


  public function get_deliveryline($d) 
  {
  
    $sql = "Select d.*, p.name as name, p.barcode as barcode
            from deliveryline d 
            join product p on p.p_no = d.product_p_no 
            where d.delivery_d_no = '$d' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_sumdeliveryline($d) 
  {
  
    $sql = "SELECT sum(price) as ta FROM `deliveryline` WHERE delivery_d_no = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------



  public function insertdelivery($del = null) 
  {  
    $this->db->insert('delivery',$del);
    return $this->db->insert_id();
  }

 // //----------------------------------------------------------------------

  public function updatedelivery($d, $del = null) 
  {  
      $this->db->where('d_no',$d)
              ->update('delivery', $del);
  }

 //    //-------------------------------------------------------------------------- 

  public function updatedeliveryline($dl, $del = null) 
  {  
      $this->db->where('dl_no',$dl)
              ->update('deliveryline', $del);
  }

 //-------------------------------------------------------------------------- 

 public function insertdeliveryline($dl = null) 
  {  
      return $this->db->insert('deliveryline',$dl);
  }

 //----------------------------------------------------------------------


  public function deletedeliveryline($dl) 
  {                       
       $this->db->delete('deliveryline', array('dl_no' => $dl));
  }

  //----------------------------------------------------------------------

  public function deletedelivery($d) 
  {                       
       $this->db->delete('deliveryline', array('delivery_d_no' => $d));
       $this->db->delete('delivery', array('d_no' => $d));
  }

  //----------------------------------------------------------------------


}
