<?php

class Formulation_model extends CI_Model
{   
    //--------------------------------------------------------------------------

    public function get_formulation()
    {
        $query = $this->db->get('formulation');
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------

    public function count_formula()
    {
         $sql = "Select count(f_no) as fno from formulation";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_formulationinfo($fno)
    {
         $sql = "Select * from formulation where f_no = '$fno'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_formulationlineinfo($fno)
    {
         $sql = "Select f.*, p.longdesc as longdesc from formulationline f, product p where f.p_no = p.p_no and  f.f_no = '$fno'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function get_productinfo($fno)
    {
         $sql = "Select * from product where p_no NOT IN (select p_no from formulationline where f_no = '$fno' )";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function get_maxfno()
    {
        $sql = "Select max(f_no) as f_no from formulation ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_formulation($fno = NULL) 
    {
        $this->db->insert('formulation',$fno);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function insertoutputprod($pno, $fno)
    {
        $this->output = $pno; 
        $this->db->update('formulation', $this, array('f_no' => $fno ));
    }

    //--------------------------------------------------------------------------
    
    public function savef()
    {
        $this->date = $this->input->post('date'); 
        $this->name = $this->input->post('name'); 
        $this->db->update('formulation', $this, array('f_no' => $this->input->post('fno') ));
    }

    //--------------------------------------------------------------------------
    
    public function insertfl($fno = NULL) 
    {
        $this->db->insert('formulationline',$fno);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function delfl($flno) 
    {                       
         $this->db->delete('formulationline', array('fl_no' => $flno));
    }
    
    //--------------------------------------------------------------------------
    
    public function delfor($fno) 
    {                       
         $this->db->delete('formulationline', array('f_no' => $fno));
         $this->db->delete('formulation', array('f_no' => $fno));
    }
    
    //--------------------------------------------------------------------------
    
    
}