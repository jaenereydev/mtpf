<?php

class Productsales_model extends CI_Model
{   
    //--------------------------------------------------------------------------
    
    public function get_product()
    {
        $sql = "select p.longdesc, l.*, o.date from orders o, orderline l, product p where o.o_no = l.o_no and p.p_no = l.p_no and o.date = CURDATE()";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_creditproduct()
    {
        $sql = "select p.longdesc, l.*, o.date from creditorder o, creditorderline l, product p where o.co_no = l.co_no and p.p_no = l.p_no and o.date = CURDATE()";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_searchproduct($from, $to, $c)
    {
        $sql = "select p.longdesc, l.*, o.date from orders o, orderline l, product p, category c where p.c_no = c.c_no and o.o_no = l.o_no and p.p_no = l.p_no and p.c_no = '$c' and o.date Between '$from' and '$to'";
        $query = $this->db->query($sql);
        return $query->result(); 
        
    }

    //--------------------------------------------------------------------------
    
    public function get_searchcreditproduct($from, $to, $c)
    {
        $sql = "select p.longdesc, l.*, o.date from creditorder o, creditorderline l, product p, category c where p.c_no = c.c_no and o.co_no = l.co_no and p.p_no = l.p_no and p.c_no = '$c' and o.date Between '$from' and '$to'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
     public function get_searchproductall($from, $to)
    {
        $sql = "select p.longdesc, l.*, o.date from orders o, orderline l, product p where o.o_no = l.o_no and p.p_no = l.p_no and o.date Between '$from' and '$to'";
        $query = $this->db->query($sql);
        return $query->result(); 
        
    }

    //--------------------------------------------------------------------------
    
    public function get_searchcreditproductall($from, $to)
    {
        $sql = "select p.longdesc, l.*, o.date from creditorder o, creditorderline l, product p where o.co_no = l.co_no and p.p_no = l.p_no and o.date Between '$from' and '$to'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_sumsalesall($from, $to)
    {
        $sql = "select sum(l.qty) as qty, sum(l.price) as price, sum(l.totalamount) as totalamount from orderline l, orders o where l.o_no = o.o_no and o.date between '$from' and '$to' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_sumcreditall($from, $to)
    {
        $sql = "select sum(l.qty) as qty, sum(l.price) as price, sum(l.totalamount) as totalamount from creditorderline l, creditorder o where l.co_no = o.co_no and o.date between '$from' and '$to' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_searchsumsalesall($from, $to, $c)
    {
        $sql = "select sum(l.qty) as qty, sum(l.price) as price, sum(l.totalamount) as totalamount from orderline l, orders o, product p where p.p_no = l.p_no and l.o_no = o.o_no and p.c_no = '$c' and o.date between '$from' and '$to' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_searchsumcreditall($from, $to, $c)
    {
        $sql = "select sum(l.qty) as qty, sum(l.price) as price, sum(l.totalamount) as totalamount from creditorderline l, creditorder o, product p where p.p_no = l.p_no and l.co_no = o.co_no and p.c_no = '$c' and o.date between '$from' and '$to' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
        
}