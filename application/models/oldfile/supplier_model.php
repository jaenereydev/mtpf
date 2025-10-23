<?php

class Supplier_model extends CI_Model
{

    //--------------------------------------------------------------------------
       
    public function get_suppliers()
    {
        $query = $this->db->get('supplier');
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function count_supplieractive()
    {
        $sql = "Select count(s_no) as s_no from supplier where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_supplierinfo($id)
    {
        $sql = "Select * from supplier where s_no =?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_supplieractive()
    {
        $sql = "Select * from supplier where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_searchsupplieractive($search)
    {
         if($search == null || $search == "")
         {
            $sql = "Select * from supplier where status = 'ACTIVE' "; 
         }else
         {
             $sql = "Select * from supplier where status = 'ACTIVE' and s_no like '$search%' or name like '$search%' and status = 'ACTIVE'";
         }
        
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    
    //--------------------------------------------------------------------------
    
     public function insert_supplier($sup = NULL) 
    {
        $this->db->insert('supplier',$sup);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_supplier() 
    {        
        $this->name = $this->input->post('name');$this->address = $this->input->post('address');
        $this->telno = $this->input->post('telno');$this->salesman = $this->input->post('salesman');
        $this->contactno = $this->input->post('contactno');$this->email = $this->input->post('email');$this->terms = $this->input->post('terms');
        $this->discount1 = $this->input->post('discount1');$this->discount2 = $this->input->post('discount2');               
        $this->status = 'ACTIVE'; $this->u_no = $this->input->post('u_no');
        
        $this->db->update('supplier', $this, array('s_no' => $this->input->post('s_no') ));
    }

    //----------------------------------------------------------------------
    
    public function updatedel_supplier($s_no, $u_no) 
    {                                     
        $this->status = 'DEACTIVATE';    
        $this->u_no = $u_no;       
        $this->db->update('supplier', $this, array('s_no' => $s_no));
    }

    //----------------------------------------------------------------------
        
}