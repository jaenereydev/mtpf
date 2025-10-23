<?php

class Banktransaction_model extends CI_Model
{   
    //--------------------------------------------------------------------------
    
    public function get_banktransaction()
    {
        $sql = "Select * from banktransaction where date = CURDATE()";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_searchbanktransaction($search)
    {
        $sql = "Select * from banktransaction where date like '$search%' or amount like '$search%' or stat like '$search%'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_bt($bt = NULL) 
    {
        $this->db->insert('banktransaction',$bt);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_bt() 
    {                
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->trans_no = $this->input->post('transno');
        $this->stat = $this->input->post('typ');
        $this->amount = $this->input->post('amount');
        $this->remarks = $this->input->post('remarks');              
        $this->db->update('banktransaction', $this, array('bt_no' => $this->input->post('btno') ));
    }

    //----------------------------------------------------------------------
    
    public function delbt($bt) 
    {   
        $this->db->delete('banktransaction', array('bt_no' => $bt));
    }

    //----------------------------------------------------------------------
    
    public function post_bt($bt, $stat) 
    {                        
        $this->posted = "POSTED";              
        $this->db->update('banktransaction', $this, array('bt_no' => $bt));
        $rc = $this->db->query('select currentbal from bank');        
        $bal = $rc->result()[0]->currentbal;
        if($stat == 'Deposit') {
             $this->insertbankhistory1($bt, $bal);
             $this->updatebank1($bt, $bal);
        }else if($stat == 'Withdrawal') {
            $this->insertbankhistory2($bt, $bal);
            $this->updatebank2($bt, $bal);
        }else if($stat == 'Charges') {
            $this->insertbankhistory2($bt, $bal);
            $this->updatebank2($bt, $bal);
        }else if($stat == 'Interest') {
            $this->insertbankhistory1($bt, $bal);
            $this->updatebank1($bt, $bal);
        }
               
    }

    //----------------------------------------------------------------------
    
    public function insertbankhistory1($bt, $bal) 
    {                        
        $sql = "Insert into bankhistory(b_no, date, description, inamount, balance, trans_no) "
                . "select '1', date, stat, amount, '$bal'+amount, trans_no from banktransaction where bt_no = '$bt' ";
        return $this->db->query($sql);       
    }

    //----------------------------------------------------------------------
    
    public function insertbankhistory2($bt, $bal) 
    {                        
        $sql = "Insert into bankhistory(b_no, date, description, outamount, balance, trans_no) "
                . "select '1', date, stat, amount, '$bal'-amount, trans_no from banktransaction where bt_no = '$bt' ";
        return $this->db->query($sql);       
    }

    //----------------------------------------------------------------------
    
    public function updatebank1($bt, $bal) 
    {                        
        $sql = "update bank set currentbal =  currentbal+(select amount from banktransaction where bt_no = '$bt') "
                . "where b_no = '1'";
        return $this->db->query($sql);       
    }

    //----------------------------------------------------------------------
    
    public function updatebank2($bt, $bal) 
    {                        
        $sql = "update bank set currentbal =  currentbal-(select amount from banktransaction where bt_no = '$bt') "
                . "where b_no = '1'";
        return $this->db->query($sql);       
    }

    //----------------------------------------------------------------------
    
    public function sumdeposit($date = false, $u_no = false)
    {
            $sql = "SELECT sum(amount) as amount 
                    FROM banktransaction
                    WHERE stat = 'Deposit'
                    and date = ";
                    if($date)
                            $sql .= "'" . $date . "' AND u_no = " . $u_no;
                    else
                            $sql .= "CURDATE() AND u_no = " . $this->session->userdata('u_no');
            return $this->db->query($sql)->result();
    }
    
    
       
}