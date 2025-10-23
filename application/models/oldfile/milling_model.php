<?php

class Milling_model extends CI_Model
{   
    //--------------------------------------------------------------------------

    public function get_milling()
    {
        $query = $this->db->get('milling');
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_millinginfo($mno)
    {
        $sql = "Select * from milling where m_no = '$mno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_millinginfoprint($mno)
    {
        $sql = "Select m.*, p.longdesc as longdesc from milling m, product p where m.p_no = p.p_no and m.m_no = '$mno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_millinglineinfo($mno)
    {
        $sql = "Select m.*, p.longdesc as longdesc from millingline m, product p where m.p_no = p.p_no and m.m_no = '$mno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_summillingline($mno)
    {
        $sql = "Select sum(qty) as qty, sum(totalamount) as totalamount from millingline where m_no = '$mno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------

    public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from milling";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_m_no($ref_no, $filestat, $u_no) 
    {
        $sql = "Insert into milling(ref_no, filestat, user) value('$ref_no','$filestat', '$u_no')";
            return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
    public function get_maxmno()
    {
        $sql = "Select max(m_no) as m_no from milling";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_productinfo($mno)
    {
         $sql = "Select * from product where p_no NOT IN (select p_no from millingline where m_no = '$mno' )";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function insertoutputprod($pno, $mno)
    {        
        $this->p_no = $pno;
        $this->db->update('milling', $this, array('m_no' => $mno ));
    }
    
    //--------------------------------------------------------------------------
    
     public function updatemqty()
    {                
        $this->uom = $this->input->post('uom');
        $this->packing = $this->input->post('packing');
        $this->qty = $this->input->post('qty');
        $this->pcs = $this->input->post('pcs');  
        $this->db->update('milling', $this, array('m_no' => $this->input->post('m_no') ));
    }
    
    //--------------------------------------------------------------------------
    
    public function closedm($mno)
    {        
        $this->filestat = "CLOSED";
        $this->db->update('milling', $this, array('m_no' => $mno ));
    }
    
    //--------------------------------------------------------------------------
    
    public function selectformulation($fno, $mno)
    {        
        $this->db->delete('millingline', array('m_no' => $mno));
        $this->updateoutput($fno, $mno);
        $sql = "Insert into millingline(p_no, m_no, qty, unitprice, unitcost, totalamount, uom, packing, pc) "
                . "select p_no, '$mno', qty, unitprice, unitcost, totalamount, uom, packing, pcs from formulationline where f_no = '$fno'";
        return $this->db->query($sql);                 
    }
    
    //--------------------------------------------------------------------------
    
    public function updateoutput($fno, $mno)
    {        
        $sql = "Update milling set p_no = (select output from formulation where f_no = '$fno' ) "
               . "where m_no = '$mno'";
        return $this->db->query($sql);              
    }
    
    //--------------------------------------------------------------------------
    
    public function savem()
    {                
        $this->filestat = "CLOSED";
        $this->totalqty = $this->input->post('tqty');
        $this->totalamount = $this->input->post('tamount');
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->db->update('milling', $this, array('m_no' => $this->input->post('mno') ));
    }
    
    //--------------------------------------------------------------------------
    
    public function insertml($ml = NULL) 
    {
        $this->db->insert('millingline',$ml);
        return $this->db->insert_id();
    }

    //-------------------------------------------------------------------------- 
    
     public function delml($ml)
    {        
        $this->db->delete('millingline', array('ml_no' => $ml));              
    }
    
    //--------------------------------------------------------------------------
    
    public function postm($mno, $uno)
    {        
        $this->user = $uno;
        $this->posted = "POSTED";
        $this->db->update('milling', $this, array('m_no' => $mno ));        
        $this->update_prodhist($mno, $uno);       
        $this->update_prodhistline($mno, $uno);
        $this->update_inv($mno);
        $this->update_invline($mno);
    }
    
    //--------------------------------------------------------------------------
    
    public function update_inv($mno)
    {
       $sql = "update product "
                    . "set product.qty = (select (milling.pcs + product.qty) "
                                            . "from milling "
                                            . "where milling.p_no = product.p_no "
                                            . "and milling.m_no = '$mno') "
                    . "where product.p_no = (select milling.p_no  "
                                            . "from milling "
                                            . "where milling.m_no = '$mno') ";
       return $this->db->query($sql); 
    }
    
    //----------------------------------------------------------------------
    
    public function update_invline($mno)
    {
       $sql = "update product "
                    . "set product.qty = (select (product.qty - millingline.pc) "
                                            . "from millingline "
                                            . "where millingline.p_no = product.p_no "
                                            . "and millingline.m_no = '$mno') "
                    . "where product.p_no IN (select millingline.p_no "
                                            . "from millingline "
                                            . "where millingline.p_no = product.p_no "
                                            . "and millingline.m_no = '$mno')";
       return $this->db->query($sql); 
    }
    
    //----------------------------------------------------------------------
    
    public function update_prodhistline($mno, $uno)
    {
        $desc = 'MILLED';
        $sql = "Insert into producthistory(date, description, u_no, ref_no, p_no, rqty, outstock) "
                . "select m.date, '$desc', '$uno', m.ref_no, l.p_no, (p.qty-l.pc), l.pc  "
                . "from millingline l, milling m, product p "
                . "where p.p_no = l.p_no "
                . "and m.m_no = l.m_no "
                . "and l.m_no = '$mno' ";
       return $this->db->query($sql); 
    }
    
     //----------------------------------------------------------------------
    
    public function update_prodhist($mno, $uno)
    {
        $desc = 'MILLED';
        $sql = "Insert into producthistory(date, description, u_no, ref_no, p_no, rqty, instock) "
                . "select m.date, '$desc', '$uno', m.ref_no, m.p_no, (p.qty+m.pcs), m.pcs  "
                . "from milling m, product p "
                . "where p.p_no = m.p_no "
                . "and m.m_no = '$mno' ";
       return $this->db->query($sql); 
    }
    
     //----------------------------------------------------------------------
    
    public function delm($mno)
    {        
        $this->db->delete('millingline', array('m_no' => $mno));      
        $this->db->delete('milling', array('m_no' => $mno));              
    }
    
    //--------------------------------------------------------------------------
}