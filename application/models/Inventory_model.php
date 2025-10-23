<?php

class Inventory_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_inventory() 
  {
    $sql = "Select * from inventory where post is null order by i_no DESC";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

  public function get_inventoryinfo($i) 
  {
    $sql = "Select * from inventory where i_no = '$i'";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

  public function get_inventoryline($i) 
  {
  
    $sql = "SELECT l.*, p.name as name, p.barcode as barcode, p.qty as oqty 
            from inventoryline l 
            join product p on p.p_no = l.product_p_no 
            where l.inventory_i_no = '$i' 
            order by l.il_no DESC";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

  public function get_countinventoryline($i) 
  {
  
    $sql = "SELECT count(l.il_no) as ilno
            from inventoryline l 
            join product p on p.p_no = l.product_p_no 
            where l.inventory_i_no = '$i' 
            order by l.il_no DESC";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

 public function deleteallinventoryline($u) 
  {                       
      $sql = "DELETE FROM inventoryline WHERE inventory_i_no is null and user_id ='$u' ";
     return $this->db->query($sql);
  }

//   //----------------------------------------------------------------------


  public function insertinventory($i = null) 
  {  
    $this->db->insert('inventory',$i);
    return $this->db->insert_id();
  }

 //----------------------------------------------------------------------

  public function editinventoryline($i, $u) 
  {
  
    $sql = "UPDATE inventoryline set inventoryline.inventory_i_no = '$i' 
            WHERE inventoryline.user_id = '$u' 
            AND inventoryline.inventory_i_no is NULL";
        return $this->db->query($sql);
  }

 
  //----------------------------------------------------------------------

  public function updateinventory($ino, $i = null) 
  {  
      $this->db->where('i_no',$ino)
              ->update('inventory', $i);
  }

 //-------------------------------------------------------------------------- 

  public function updateinventoryline($ilno, $il = null) 
  {  
      $this->db->where('il_no',$ilno)
              ->update('inventoryline', $il);
  }

 //-------------------------------------------------------------------------- 

 public function insertinventoryline($il = null) 
  {  
      return $this->db->insert('inventoryline',$il);
  }

 //----------------------------------------------------------------------


  public function deleteinventoryline($il) 
  {                       
       $this->db->delete('inventoryline', array('il_no' => $il));
  }

  //----------------------------------------------------------------------

  public function deleteinventory($i) 
  {                       
       $this->db->delete('inventoryline', array('inventory_i_no' => $i));
       $this->db->delete('inventory', array('i_no' => $i));
  }

  //----------------------------------------------------------------------


}
