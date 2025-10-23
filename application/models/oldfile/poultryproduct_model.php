<?php

class Poultryproduct_model extends CI_Model
{   
    //--------------------------------------------------------------------------    
     public function get_poultryactive($pp_no = false)
    {
        $sql = "Select * from poultryproduct where status = 'ACTIVE'";
        if($pp_no)
          $sql .= " AND pp_no = " . $pp_no;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_poul($pp_no = NULL) 
    {
        $this->db->insert('poultryproduct',$pp_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_poul() 
    {        
        $this->name = $this->input->post('name');        
        $this->db->update('poultryproduct', $this, array('pp_no' => $this->input->post('pp_no') ));
    }

    //----------------------------------------------------------------------
    
    public function updatedel_poul($pp_no) 
    {                              
        $this->status = 'DEACTIVATE';         
        $this->db->update('poultryproduct', $this, array('pp_no' => $pp_no));
    }

    //----------------------------------------------------------------------
    public function update_qty($data)
    {
      $this->db->query('UPDATE poultryproduct SET qty = qty + ? WHERE pp_no = ?', [$data['qty'], $data['poultry']]);
    }

    public function minusQty($data)
    {
      $this->db->query('UPDATE poultryproduct SET qty = qty - ? WHERE pp_no = ?', $data);
    }
        
}