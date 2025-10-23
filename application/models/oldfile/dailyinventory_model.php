<?php

class Dailyinventory_model extends CI_Model
{   
    //--------------------------------------------------------------------------

    public function get_category()
    {
        $query = $this->db->get('category');
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_product()
    {
        $sql = "Select * from product where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_productsearch($cno)
    {
        $sql = "Select * from product where status = 'ACTIVE' and c_no = '$cno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
     public function get_description()
    {
        $sql = "Select distinct(description) from producthistory ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
     public function get_history()
    {
        $sql = "SELECT h.date as date, p.p_no as p_no, p.longdesc as longdesc, 
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'INVENTORY' and date = CURDATE()-INTERVAL 1 day) as INVENTORY,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'RECEIVED' and date = CURDATE()) as RECEIVED,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'CLASSIFY' and date = CURDATE()) as CLASSIFYING,
            (SELECT case 
                        when sum(instock) IS NULL THEN 0  
                        else sum(instock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'MILLED' and date = CURDATE()) as INMILLED,
            (SELECT case 
                        when sum(outstock) IS NULL THEN 0  
                        else sum(outstock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'MILLED' and date = CURDATE()) as OUTMILLED,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'SALES' and date = CURDATE()) as SALES,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'CREDIT' and date = CURDATE()) as CREDIT,
            (SELECT case 
                        when sum(instock) IS NULL THEN 0                                    
                        else sum(instock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'ADJUSTMENT' and date = CURDATE()) as INADJUSTMENT,
            (SELECT case                         
                        when sum(outstock) IS NULL THEN 0                                   
                        else sum(outstock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'ADJUSTMENT' and date = CURDATE()) as OUTADJUSTMENT,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'DISPOSE' and date = CURDATE()) as DISPOSED,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock) 
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0                                     
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'INVENTORY' and date = CURDATE()) as ACTUALINVENTORY
            from product p, producthistory h where p.p_no = h.p_no and p.status = 'ACTIVE' group by h.p_no";
        $query = $this->db->query($sql);
        return $query->result();
        
    }        
    
    //--------------------------------------------------------------------------
    
    public function get_historysearch($date)
    {
        $sql = "SELECT h.date as date, p.p_no as p_no, p.longdesc as longdesc, 
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'INVENTORY' and date = '$date'-INTERVAL 1 day) as INVENTORY,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'RECEIVED' and date = '$date') as RECEIVED,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'CLASSIFY' and date = '$date') as CLASSIFYING,
            (SELECT case 
                        when sum(instock) IS NULL THEN 0  
                        else sum(instock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'MILLED' and date = '$date') as INMILLED,
            (SELECT case 
                        when sum(outstock) IS NULL THEN 0  
                        else sum(outstock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'MILLED' and date = '$date') as OUTMILLED,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'SALES' and date = '$date') as SALES,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'CREDIT' and date = '$date') as CREDIT,
            (SELECT case 
                        when sum(instock) IS NULL THEN 0                                    
                        else sum(instock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'ADJUSTMENT' and date = '$date') as INADJUSTMENT,
            (SELECT case                         
                        when sum(outstock) IS NULL THEN 0                                   
                        else sum(outstock)
                        END as total
            from producthistory where p_no = p.p_no and description = 'ADJUSTMENT' and date = '$date') as OUTADJUSTMENT,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock)  
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'DISPOSE' and date = '$date') as DISPOSED,
            (SELECT case 
                        when sum(instock) IS NULL THEN sum(outstock)
                        when sum(outstock) IS NULL THEN sum(instock) 
                        when ((sum(instock))-(sum(outstock))) IS NULL THEN 0                                     
                        else ((sum(instock))-(sum(outstock)))
                        END as total
            from producthistory where p_no = p.p_no and description = 'INVENTORY' and date = '$date') as ACTUALINVENTORY
            from product p, producthistory h where p.p_no = h.p_no and p.status = 'ACTIVE' group by h.p_no";
        $query = $this->db->query($sql);
        return $query->result();
        
    }        
        
}