<?php

class Bank_model extends CI_Model
{   
    //--------------------------------------------------------------------------
    
    public function get_bank()
    {
        $sql = "Select * from bank where b_no = '1'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_bankhistory()
    {
        $sql = "Select * from bankhistory where b_no = '1'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_bank($bank = NULL) 
    {
        $this->db->insert('bank',$bank);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_bank() 
    {        
        $this->bankname = $this->input->post('name');
        $this->address = $this->input->post('address');                
        $this->db->update('bank', $this, array('b_no' => $this->input->post('bno') ));
    }

    //----------------------------------------------------------------------
       
}