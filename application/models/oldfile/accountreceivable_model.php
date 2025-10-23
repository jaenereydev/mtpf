<?php

class Accountreceivable_model extends CI_Model
{       
    //--------------------------------------------------------------------------
    
     public function get_aractive()
    {
        $sql = "Select * from creditpayment where file_stat = 'CLOSED'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_ar_no($cp_no = NULL) 
    {
        $this->db->insert('creditpayment',$cp_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------        
    
     public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from creditpayment";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_countcpl($arno)
    {
        $sql = "Select count(cpl_no) as cpl_no from creditpaymentline where cp_no = '$arno' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_maxar_no()
    {
        $sql = "Select max(cp_no) as cp_no from creditpayment";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_arinfo($arno)
    {
        $sql = "Select * from creditpayment where cp_no = '$arno' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_printarinfo($arno)
    {
        $sql = "Select c.*, t.name from creditpayment c, customer t where c.c_no= t.c_no and cp_no = '$arno' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_cusco($cno)
    {
        $sql = "Select * from creditorder where c_no = '$cno' and co_no NOT IN (select co_no from creditpaymentline) ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_arlstat($cno)
    {
        $p = "Partial";
        $sql = "Select *, (totalamount-(select sum(p.amount) from creditpaymentline l, creditpayment c, paymentref p where l.cp_no = c.cp_no and c.cp_no = p.cp_no and l.co_no  = creditorder.co_no)) as amount, '$p' as status from creditorder where c_no = '$cno' and co_no IN (select co_no from creditpaymentline where status = 'Partial')";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_arlinfo($arno)
    {
        $sql = "Select * from creditpaymentline where cp_no = '$arno' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_sumarl($arno)
    {
        $sql = "Select sum(amount) as amount from creditpaymentline where cp_no = '$arno' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_prinfo($arno)
    {
        $sql = "Select * from paymentref where cp_no = '$arno' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_sumpr($arno)
    {
        $sql = "Select sum(amount) as amount from paymentref where cp_no = '$arno' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function closear($arno, $u_no) 
    {                       
        $this->u_no = $u_no;        
        $this->file_stat = 'CLOSED';         
        $this->db->update('creditpayment', $this, array('cp_no' => $arno));
    }

    //--------------------------------------------------------------------------
    
    public function selectcustomer($cno, $arno) 
    {                       
        $this->c_no = $cno;             
        $this->db->update('creditpayment', $this, array('cp_no' => $arno));
        
        $this->db->delete('creditpaymentline', array('cp_no' => $arno));
        $this->db->delete('paymentref', array('cp_no' => $arno));
        
        $sql = "Insert into creditpaymentline(ref_no, amount, co_no, cp_no, ci_no) "
                . "select ref_no, totalamount, co_no, '$arno', ci_no from creditorder where c_no = '$cno' and co_no NOT IN (select co_no from creditpaymentline)";
        return $this->db->query($sql);
    }

    //--------------------------------------------------------------------------
    
    public function opencp($arno, $u_no) 
    {                       
        $this->u_no = $u_no;        
        $this->file_stat = 'OPEN';         
        $this->db->update('creditpayment', $this, array('cp_no' => $arno));
    }

    //--------------------------------------------------------------------------
    
    public function insert_co($cono, $arno) 
    {                       
        $sql = "Insert into creditpaymentline(ref_no, amount, co_no, cp_no, ci_no) "
                . "select ref_no, totalamount, '$cono', '$arno', ci_no from creditorder where co_no = '$cono'";
        return $this->db->query($sql);  
    }

    //--------------------------------------------------------------------------
    
    public function insert_cplp($cono, $arno, $pamount) 
    {                       
        $sql = "Insert into creditpaymentline(ref_no, amount, co_no, cp_no, ci_no) "
                . "select ref_no, '$pamount', co_no, '$arno', ci_no from creditorder where co_no = '$cono'";
        return $this->db->query($sql);  
    }

    //--------------------------------------------------------------------------
    
    public function del_arl($cpl) 
    {   
        $this->db->delete('creditpaymentline', array('cpl_no' => $cpl));
    }

    //--------------------------------------------------------------------------
    
    public function del_pr($pr) 
    {   
        $this->db->delete('paymentref', array('pr_no' => $pr));
    }

    //--------------------------------------------------------------------------

    public function insertpayment($pr = NULL) 
    {
        $this->db->insert('paymentref',$pr);
        return $this->db->insert_id();
    }

    //-------------------------------------------------------------------------- 
    
    public function savecp($u_no) 
    {                       
        $this->u_no = $u_no;        
        $this->file_stat = 'CLOSED'; 
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->or_no = $this->input->post('or_no');
        $this->remarks = $this->input->post('remarks');
        $this->totalamount = $this->input->post('ta');
        $this->db->update('creditpayment', $this, array('cp_no' => $this->input->post('arno')));
    }

    //--------------------------------------------------------------------------
    
    public function delcp($arno) 
    {   
        $this->db->delete('paymentref', array('cp_no' => $arno));
        $this->db->delete('creditpaymentline', array('cp_no' => $arno));
        $this->db->delete('creditpayment', array('cp_no' => $arno));
    }

    //--------------------------------------------------------------------------
    
    public function postcp($u_no, $arno, $c_no, $stat) 
    {                       
        $this->u_no = $u_no;        
        $this->posted = 'POSTED'; 
        $this->db->update('creditpayment', $this, array('cp_no' => $arno));
        if($stat == 'Partial') 
        {
            $this->updatecplstat($arno, $stat); 
        }else {            
            $this->updatecplstatp($arno, $stat); 
        }       
        $rc = $this->db->query('select totalcredit from customer where c_no = ?', array($c_no));        
        $ta = $rc->result()[0]->totalcredit;
        $this->insertcushist($u_no, $arno, $ta);
        $this->updatecus($c_no, $arno);
    }

    //-------------------------------------------------------------------------- 
    
    public function insertcushist($u_no, $arno, $ta) 
    {                             
        $description = "CREDIT PAYMENT";                            
        $sql = "Insert into customerhistory(date, user, description, amountsales, doc_no, c_no, remainingcredit) "
                . "select date, '$u_no', '$description', totalamount, or_no, c_no, '$ta'-totalamount from creditpayment where cp_no = '$arno' ";
        return $this->db->query($sql);
        
    }

    //-------------------------------------------------------------------------- 
    
    public function updatecus($c_no, $arno) 
    {                                
       $sql = "Update customer set customer.totalcredit = (select (customer.totalcredit - creditpayment.totalamount) from creditpayment where cp_no = '$arno' ) "
               . "where customer.c_no = '$c_no'";
        return $this->db->query($sql);
    }
    //-------------------------------------------------------------------------- 
    
     public function updatecplstat($arno, $stat) 
    {                                
        $sql = "update creditpaymentline "
                    . "set creditpaymentline.status = '$stat' "
                    . "where creditpaymentline.cp_no = '$arno' ";
        return $this->db->query($sql); 
    }
    //-------------------------------------------------------------------------- 
    
    public function updatecplstatp($arno, $stat) 
    {   
        $q = $this->db->query("select co_no from creditpaymentline where cp_no = '$arno' ");        
        if(empty($q->result()[0]->co_no)) {}else {
        $co = $q->result()[0]->co_no;
        $sql = "update creditpaymentline  "
                    . "set status = '$stat' "
                    . "where co_no  = '$co' ";
        return $this->db->query($sql); 
        }
    }
    //-------------------------------------------------------------------------- 
    
}


       