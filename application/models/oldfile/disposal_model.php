<?php

class Disposal_model extends CI_Model
{   
    //--------------------------------------------------------------------------

    public function get_disposal()
    {
        $query = $this->db->get('dispose');
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_disposalinfo($dno)
    {
        $sql = "Select * from dispose where d_no =?";
        $query = $this->db->query($sql, array($dno));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_sumqty($dno)
    {
        $sql = "Select sum(qty) as qty from disposalline where d_no =?";
        $query = $this->db->query($sql, array($dno));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    
     public function get_product($dno)
    {
        $sql = "Select * from product where status = 'ACTIVE' and p_no NOT IN (select p_no from disposalline where d_no = '$dno')";
        $query = $this->db->query($sql, array($dno));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_disposallineinfo($dno)
    {
        $sql = "Select d.*, p.longdesc as longdesc from disposalline d, product p where d.p_no = p.p_no and d.d_no =?";
        $query = $this->db->query($sql, array($dno));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_maxdno()
    {
        $sql = "Select max(d_no) as d_no from dispose";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_d_no($d_no = NULL) 
    {
        $this->db->insert('dispose',$d_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_savedisposal()
    {        
        $this->filestat = "CLOSE";
        $this->totalqty = $this->input->post('tq');
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->reason = $this->input->post('reason');
        $this->db->update('dispose', $this, array('d_no' => $this->input->post('d_no') ));
    }

    //----------------------------------------------------------------------
    
    public function closedisposal($d_no, $u_no) 
    {                       
        $this->u_no = $u_no;        
        $this->filestat = "CLOSE";         
        $this->db->update('dispose', $this, array('d_no' => $d_no));
    }

    //----------------------------------------------------------------------
    
     public function insertdl($dl_no = NULL) 
    {
        $this->db->insert('disposalline',$dl_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function updatedl()
    {        
        $this->qty = $this->input->post('qty');
        $this->db->update('disposalline', $this, array('dl_no' => $this->input->post('dl_no') ));
    }

    //----------------------------------------------------------------------
    
    public function deldl($dlno)
    {                
        $this->db->delete('disposalline', array('dl_no' => $dlno));
    }

    //----------------------------------------------------------------------
    
     public function deld($dno)
    {                
        $this->db->delete('disposalline', array('d_no' => $dno));
        $this->db->delete('dispose', array('d_no' => $dno));
    }

    //----------------------------------------------------------------------
    
    public function postdisposal($dno, $u_no)
    {                
        $this->u_no = $u_no;$this->posted = "POSTED";   
        $this->db->update('dispose', $this, array('d_no' => $dno ));  
        $this->update_prodhist($dno, $u_no);
        $this->update_inv($dno);
    }

    //----------------------------------------------------------------------
    
    public function update_prodhist($d_no, $u_no)
    {
        $desc = 'DISPOSE';
        $sql = "Insert into producthistory(date, description, u_no, ref_no, p_no, rqty, outstock) "
                . "select d.date, '$desc', '$u_no', d.d_no, l.p_no, (p.qty-l.qty), l.qty  "
                . "from disposalline l, dispose d, product p "
                . "where p.p_no = l.p_no "
                . "and d.d_no = l.d_no "
                . "and l.d_no = '$d_no' ";
       return $this->db->query($sql); 
    }
    
     //----------------------------------------------------------------------
    
    public function update_inv($d_no)
    {
       $sql = "update product "
                    . "set product.qty = (select (product.qty - disposalline.qty) "
                                            . "from disposalline "
                                            . "where disposalline.p_no = product.p_no "
                                            . "and disposalline.d_no = '$d_no') "
                    . "where product.p_no IN (select disposalline.p_no "
                                            . "from disposalline "
                                            . "where disposalline.p_no = product.p_no "
                                            . "and disposalline.d_no = '$d_no')";
       return $this->db->query($sql); 
    }
    
    //----------------------------------------------------------------------
        
}