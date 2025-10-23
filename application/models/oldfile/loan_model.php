<?php

class Loan_model extends CI_Model
{   
    //--------------------------------------------------------------------------

    public function get_loan()
    {
        $sql = "Select l.*, c.name as name from loan l, customer c "
                . "where l.c_no = c.c_no "
                . "and date = CURDATE()";
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_loanreport($d, $u)
    {
        $sql = "Select l.*, c.name as name from loan l, customer c "
                . "where l.c_no = c.c_no "
                . "and l.date = '$d' "
                . "and l.u_no = '$u' ";                 
        return $this->db->query($sql)->result();      
    }
    
    //--------------------------------------------------------------------------
    
    public function get_searchloan($s)
    {
        $sql = "Select l.*, c.name as name "
                . "from loan l, customer c "
                . "where l.c_no = c.c_no "
                . "and l.doc_no like '$s%' "
                . "or l.c_no like '$s%' "
                . "or l.date like '$s%' "
                . "or l.amount like '$s%' ";
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_searchallloan()
    {
        $sql = "Select l.*, c.name as name from loan l, customer c "
                . "where l.c_no = c.c_no ";
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //--------------------------------------------------------------------------
    
     public function insertloan($l_no = NULL) 
    {
        $this->db->insert('loan',$l_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function postloan($l, $user, $c) 
    {        
        $this->u_no = $user; $this->posted = "POSTED";   
        $this->db->update('loan', $this, array('l_no' => $l )); 
        $rc = $this->db->query('select totalcredit from customer where c_no = ?', array($c));        
        $ta = $rc->result()[0]->totalcredit;
        $this->updatecustomerhist($l, $user, $ta);
        $this->updatecus($c, $l);
    }
    
    //--------------------------------------------------------------------------
    
    public function updatecustomerhist($l, $user, $ta) 
    {        
       $description = "Loan";                            
        $sql = "Insert into customerhistory(date, user, description, amountcredit, doc_no, c_no, remainingcredit) "
                . "select date, '$user', '$description', amount, doc_no, c_no, '$ta'+amount from loan where l_no = '$l' ";
        return $this->db->query($sql);
    }
      
    //--------------------------------------------------------------------------
     
    public function updatecus($c, $l) 
    {                                
       $sql = "Update customer set customer.totalcredit = (select (customer.totalcredit + loan.amount) from loan where l_no = '$l' ) "
               . "where customer.c_no = '$c'";
        return $this->db->query($sql);
    }
    
    //--------------------------------------------------------------------------
    
    public function updateloan() 
    {                                       
        $this->c_no = $this->input->post('c_no');        
        $this->u_no = $this->input->post('u_no');
        $this->doc_no = $this->input->post('doc_no');
        $value = $this->input->post('date');
        $this->date = date_format(date_create($value), 'Y-m-d');
        $this->description = $this->input->post('description');
        $this->amount = $this->input->post('amount');
        $this->remarks = $this->input->post('remarks');   
        $this->db->update('loan', $this, array('l_no' => $this->input->post('l_no') )); 
    }
    
    //--------------------------------------------------------------------------
    
    public function delloan($l) 
    {   
        $this->db->delete('loan', array('l_no' => $l));
    }

    //--------------------------------------------------------------------------
}