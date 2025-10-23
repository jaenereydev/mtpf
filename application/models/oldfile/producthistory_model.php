<?php

class Producthistory_model extends CI_Model
{

    //--------------------------------------------------------------------------
    
    public function get_producthistory($id)
    {
        $sql = "Select * from producthistory "
                . "where p_no =? "
                . "order by ph_no DESC";
        $query = $this->db->query($sql, array($id));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function post_returnProduct($items)
    {
      $ph = [];
      $p = [];
      foreach ($items as $key => $product) {
        array_push($ph, [
          'date' => date('Y-m-d'),
          'description' => 'RETURN',
          'u_no' => $this->session->userdata('u_no'),
          'instock' => $product->quantity,
          'rqty' => $product->qty - $product->quantity,
          'p_no' => $product->p_no
        ]);

        array_push($p, [
          'p_no' => $product->p_no,
          'qty' => $product->qty + $product->quantity
        ]);
      }

      $this->db->insert_batch('producthistory', $ph);
      $this->db->update_batch('product', $p, 'p_no');
    }

    public function getProductHistory($data)
    {
      $sql = "SELECT * 
              FROM producthistory
              WHERE description = ?
              AND ref_no = ?
              AND p_no = ?";
      return $this->db->query($sql, $data)->result();
    }
        
}