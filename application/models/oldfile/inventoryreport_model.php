<?php

class Inventoryreport_model extends CI_Model
{   
    //--------------------------------------------------------------------------
    
    public function get_productall()
    {
        $sql = "select p.* from product p, category c where c.c_no = p.c_no and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //--------------------------------------------------------------------------  
    
    public function get_sumproductall()
    {
        $sql = "select sum(p.qty) as qty, sum(p.qty*p.unitcost) as total from product p, category c where c.c_no = p.c_no and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //--------------------------------------------------------------------------  
    
    public function get_productcat($cno)
    {
        $sql = "select p.* from product p, category c where c.c_no = p.c_no and p.c_no = '$cno' and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //--------------------------------------------------------------------------  
    
    public function get_sumproductcat($cno)
    {
        $sql = "select sum(p.qty) as qty, sum(p.qty*p.unitcost) as total from product p, category c where c.c_no = p.c_no and p.c_no = '$cno' and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //-------------------------------------------------------------------------- 
    
    public function get_productsup($sno)
    {
        $sql = "select p.* from product p, supplier s where s.s_no = p.s_no and p.s_no = '$sno' and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //--------------------------------------------------------------------------  
    
    public function get_sumproductsup($sno)
    {
        $sql = "select sum(p.qty) as qty, sum(p.qty*p.unitcost) as total from product p, supplier s where s.s_no = p.s_no and p.s_no = '$sno' and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //-------------------------------------------------------------------------- 
    
    public function get_product($sno, $cno)
    {
        $sql = "select p.* from product p, category c, supplier s where c.c_no = p.c_no and p.s_no = s.s_no and p.s_no = '$sno' and p.c_no = '$cno' and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //--------------------------------------------------------------------------  
    
    public function get_sumproduct($sno, $cno)
    {
        $sql = "select sum(p.qty) as qty, sum(p.qty*p.unitcost) as total from product p, category c, supplier s where c.c_no = p.c_no  and p.s_no = s.s_no and p.s_no = '$sno' and p.c_no = '$cno'and p.status = 'ACTIVE' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }   
    
    //--------------------------------------------------------------------------
}