<?php

class Category_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_category() 
  {
  
    $sql = "Select * from category where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

   public function get_customercategory() 
  {
  
    $sql = "Select * from customer_category  ";
    $query = $this->db->query($sql);
    return $query->result();
  }

 //----------------------------------------------------------------------

  public function insertcategory($cat = null) 
  {  
      $this->db->insert('category',$cat);
  }

 //----------------------------------------------------------------------

  public function insertcustomercategory($cat = null) 
  {  
      $this->db->insert('customer_category',$cat);
  }

 //----------------------------------------------------------------------

 public function updatecategory($c, $cat = null) 
    {  
        $this->db->where('c_no',$c)
                ->update('category', $cat);
    }

    //--------------------------------------------------------------------------  

     public function updatecustomercategory($c, $cat = null) 
    {  
        $this->db->where('cc_no',$c)
                ->update('customer_category', $cat);
    }

    //--------------------------------------------------------------------------    

     public function deletecustomercategory($c) 
    {                       
         $this->db->delete('customer_category', array('cc_no' => $c));
    }

    //--------------------------------------------------------------------------    

     public function updatecustomercategoryno($c) 
    {                       
        $sql = "UPDATE customer SET customer_category_cc_no = null WHERE customer_category_cc_no = '$c'";
       return $this->db->query($sql);
    }

}
