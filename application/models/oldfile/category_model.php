<?php

class Category_model extends CI_Model
{   
    //--------------------------------------------------------------------------

    public function get_category()
    {
        $query = $this->db->get('category');
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_categoryinfo($id)
    {
        $sql = "Select * from category where c_no =?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_catactive()
    {
        $sql = "Select * from category where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_cat($c_no = NULL) 
    {
        $this->db->insert('category',$c_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_cat() 
    {        
        $this->description = $this->input->post('description');
        $this->u_no = $this->input->post('u_no');
        
        $this->db->update('category', $this, array('c_no' => $this->input->post('c_no') ));
    }

    //----------------------------------------------------------------------
    
    public function updatedel_cat($c_no, $u_no) 
    {                       
        $this->u_no = $u_no;        
        $this->status = 'DEACTIVATE';         
        $this->db->update('category', $this, array('c_no' => $c_no));
    }

    //----------------------------------------------------------------------
        
}