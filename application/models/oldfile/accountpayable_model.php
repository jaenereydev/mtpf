<?php

class Accountpayable_model extends CI_Model
{   
    //--------------------------------------------------------------------------    
    
     public function get_accountpayableactive()
    {
        $sql = "Select * from accountpayable where status = 'ACTIVE' order by ap_no DESC";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function get_searchaccountpayableactive($search)
    {
        $sql = "Select * from accountpayable where status = 'ACTIVE' and date like '$search%' or ref_no like '$search%' or s_no like '$search%' order by ap_no DESC";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------  
    
     public function get_delivery()
    {
        $sql = "Select distinct(s_no) as s_no from delivery where posted = 'POSTED' order by d_no DESC";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------    
    
    public function get_sumdeliveryinfo($po_no)
    {
        $sql = "Select sum(totalamount) as totalamount from delivery where po_no =?";
        $query = $this->db->query($sql, array($po_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //-------------------------------------------------------------------------- 
    
    public function get_accountpayableinfo($apno)
    {
        $sql = "Select * from accountpayable where ap_no =?";
        $query = $this->db->query($sql, array($apno));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------  
    
     public function get_accountpayablelineinfo($apno)
    {
        $sql = "Select * from deliveryline where d_no =?";
        $query = $this->db->query($sql, array($apno));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------  
    
    public function get_accountpayableline_sum($apno)
    {
        $sql = "Select sum(delamount) as delamount from accountpayableline where ap_no =?";
        $query = $this->db->query($sql, array($apno));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_accountpayableline($apno)
    {
        $sql = "Select * "
                . "from accountpayableline "
                . "where ap_no =?";
        $query = $this->db->query($sql, array($apno));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
     public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from accountpayable";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_maxap_no()
    {
        $sql = "Select max(ap_no) as ap_no from accountpayable";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_ap_no($ref_no, $filestat, $status, $u_no) 
    {
        $sql = "Insert into accountpayable(ref_no, filestat, status, u_no) value('$ref_no','$filestat', '$status', '$u_no')";
            return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
    public function update_accountpayableline($sno, $apno, $uno) 
    {                      
        $this->s_no = $sno;        
        $this->db->update('accountpayable', $this, array('ap_no' => $apno ));                
        
        $this->db->delete('accountpayableline', array('ap_no' => $apno));
        
        $sql = "Insert into accountpayableline(u_no, d_no, ref_no, deldate, delamount, ap_no) "
                . "select '$uno', d_no , ref_no, date, totalamount, '$apno' "
                . "from delivery "
                . "where posted = 'POSTED' "
                . "and filestat != 'PAYED' "
                . "and s_no = '$sno' "
                . "and d_no NOT IN (select d_no from accountpayableline)";
        return $this->db->query($sql);
    }

    //--------------------------------------------------------------------------
    
    public function update_accountpayablelinedel($dno, $apno, $uno) 
    {                            
        $sql = "Insert into accountpayableline(u_no, d_no, ref_no, deldate, delamount, ap_no) "
                . "select '$uno', '$dno' , ref_no, date, totalamount, '$apno' "
                . "from delivery "
                . "where d_no = '$dno'";
        return $this->db->query($sql);
    }

    //--------------------------------------------------------------------------
    
     public function get_apl($sno) 
    {                             
        $sql = "select * from delivery where posted = 'POSTED' and filestat != 'PAYED' and s_no = '$sno' and d_no NOT IN (select d_no from accountpayableline)";
        return $this->db->query($sql);
    }

    //--------------------------------------------------------------------------
    
    public function update_apsave($u_no) 
    {        
        $this->u_no = $u_no;$this->grandtotal = $this->input->post('grandtotal');
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->additionalamount = $this->input->post('additionalamount');
        $this->discountamount = $this->input->post('discountamount');$this->remarks = $this->input->post('remarks1');$this->filestat = "CLOSE";                        
        $this->db->update('accountpayable', $this, array('ap_no' => $this->input->post('ap_no') ));
    }

    //----------------------------------------------------------------------
    
    public function closeap($apno) 
    {                
        $this->filestat = "CLOSE";$this->db->update('accountpayable', $this, array('ap_no' => $apno ));
    }

    //----------------------------------------------------------------------
    
    public function post_ap($u_no, $ap_no) 
    {        
        $this->u_no = $u_no;$this->posted = "POSTED";   
        $this->db->update('accountpayable', $this, array('ap_no' => $ap_no ));  
        $stat = 'PAYED';
        $sql = "update delivery "
                    . "set delivery.filestat = '$stat' "
                    . "where delivery.d_no IN (select accountpayableline.d_no "
                                            . "from accountpayableline "
                                            . "where accountpayableline.d_no = delivery.d_no "
                                            . "and accountpayableline.ap_no = '$ap_no')";
       return $this->db->query($sql); 
    }

    //----------------------------------------------------------------------
    
    public function close_ap($apno) 
    {                
        $this->filestat = "CLOSE";                
        $this->db->update('accountpayable', $this, array('ap_no' => $apno ));
    }

    //----------------------------------------------------------------------
    
    public function openap($apno) 
    {                
        $this->filestat = "OPEN";                
        $this->db->update('accountpayable', $this, array('ap_no' => $apno ));
    }

    //----------------------------------------------------------------------
    
    
    public function del_apl($aplno) 
    {                       
         $this->db->delete('accountpayableline', array('apl_no' => $aplno));
    }

    //----------------------------------------------------------------------
    
    public function delap($apno) 
    {                       
         $this->db->delete('accountpayableline', array('ap_no' => $apno));
         $this->db->delete('accountpayable', array('ap_no' => $apno));
    }

    //----------------------------------------------------------------------
        
}