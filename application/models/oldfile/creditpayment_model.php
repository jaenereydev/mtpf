<?php

class Creditpayment_model extends CI_Model
{   
    //--------------------------------------------------------------------------
    
    public function get_creditpayment()
    {
        $sql = "select p.ref_no, c.name, p.date, r.* 
                from paymentref r, customer c, creditpayment p 
                where c.c_no = p.c_no 
                and p.cp_no = r.cp_no
                and c.status = 'ACTIVE'
                and p.posted = 'POSTED'";
        $query = $this->db->query($sql);
        return $query->result();        
    }

    //--------------------------------------------------------------------------
    
    public function get_sumcashcreditpayment()
    {
        $sql = "select sum(r.amount) as amount
                from paymentref r, creditpayment p 
                where p.cp_no = r.cp_no
                and p.posted = 'POSTED'
                and r.description = 'Cash'";
        $query = $this->db->query($sql);
        return $query->result();        
    }

    //--------------------------------------------------------------------------
    
    public function get_sumcheckcreditpayment()
    {
        $sql = "select sum(r.amount) as amount
                from paymentref r, creditpayment p 
                where p.cp_no = r.cp_no
                and p.posted = 'POSTED'
                and r.description = 'Check'";
        $query = $this->db->query($sql);
        return $query->result();        
    }

    //--------------------------------------------------------------------------
    
    public function get_searchcreditpayment($cno, $from, $to)
    {
        $sql = "select p.ref_no, c.name, p.date, r.* 
                from paymentref r, customer c, creditpayment p 
                where c.c_no = p.c_no 
                and p.cp_no = r.cp_no
                and c.c_no = '$cno'
                and p.date between '$from' and '$to'
                and c.status = 'ACTIVE'
                and p.posted = 'POSTED'";
        $query = $this->db->query($sql);
        return $query->result();        
    }

    //--------------------------------------------------------------------------
    
    public function get_sumcashsearchcreditpayment($cno, $from, $to)
    {
        $sql = "select sum(r.amount) as amount
                from paymentref r, customer c, creditpayment p 
                where c.c_no = p.c_no 
                and p.cp_no = r.cp_no
                and c.c_no = '$cno'
                and p.date between '$from' and '$to'
                and c.status = 'ACTIVE'
                and p.posted = 'POSTED'
                and r.description = 'Cash'";
        $query = $this->db->query($sql);
        return $query->result();        
    }

    //--------------------------------------------------------------------------
    
    public function get_sumchecksearchcreditpayment($cno, $from, $to)
    {
        $sql = "select sum(r.amount) as amount
                from paymentref r, customer c, creditpayment p 
                where c.c_no = p.c_no 
                and p.cp_no = r.cp_no
                and c.c_no = '$cno'
                and p.date between '$from' and '$to'
                and c.status = 'ACTIVE'
                and p.posted = 'POSTED'
                and r.description = 'Check'";
        $query = $this->db->query($sql);
        return $query->result();        
    }

    //--------------------------------------------------------------------------
    
        
}