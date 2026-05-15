<?php

class Production_model extends CI_Model
{

 //----------------------------------------------------------------------

    public function get_productionlist() 
    {

        $sql = "SELECT p.*, u.name as name 
                from production p 
                join user u ON u.id = p.user_id  
                where p.post = 'NO'";
        $query = $this->db->query($sql);
        return $query->result();
    }

  //----------------------------------------------------------------------

    public function get_building()
    {
        $this->db->select('name');
        $this->db->from('building');
        return $this->db->get()->result();
    }

}
