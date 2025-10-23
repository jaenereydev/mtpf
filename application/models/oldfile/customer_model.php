<?php

class Customer_model extends CI_Model
{
     public function count_customeractive()
    {
        $sql = "Select count(c_no) as c_no from customer where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------    
    
     public function get_customerhistoryinfo($cno)
    {
        $sql = "Select * from customerhistory where c_no = '$cno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------   
    
    public function get_searchcustomerhistoryinfo($cno, $search)
    {
        $sql = "Select * from customerhistory where c_no = '$cno' and date like '$search%' or doc_no like '$search%' or amountcredit like '$search%' or amountsales like '$search%' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------   
    
    public function get_customerinfo($cno)
    {
        $sql = "Select * from customer where c_no = '$cno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------   
    
    public function get_customerhistory($cno)
    {
        $sql = "Select * from customerhistory where c_no = '$cno'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------    


    public function get_customeractive()
    {
        $sql = "Select * from customer where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------  
    
    public function totalcredit()
    {
        $sql = "Select sum(totalcredit) as totalcredit from customer where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------      
    
    
    public function get_searchcustomeractive($search)
    {
        $sql = "Select * from customer where status = 'ACTIVE' and c_no like '$search%' or name like '$search%'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------      
    
    public function insert_customer($cus = NULL) 
    {
        $this->db->insert('customer',$cus);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_customer()
    {
        $this->u_no = $this->input->post('u_no');
        $this->name = $this->input->post('name');
        $this->address = $this->input->post('address');
        $this->telno = $this->input->post('telno');
        $this->gender = $this->input->post('gender');
        $this->creditlimit = $this->input->post('creditlimit');
        $this->terms = $this->input->post('terms');
        $this->discount = $this->input->post('discount');
        $this->schedule = $this->input->post('sched');                              
        $this->db->update('customer', $this, array('c_no' => $this->input->post('c_no') ));
    }
    
    //--------------------------------------------------------------------------
    
    public function update_ch()
    {
        $this->description = $this->input->post('description');    
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->amountsales = $this->input->post('as');    
        $this->amountcredit = $this->input->post('ac');   
        $this->remainingcredit = $this->input->post('rc');    
        $this->doc_no = $this->input->post('docno');    
        $tc = $this->input->post('totalcredit');
        $cno = $this->input->post('c_no');
        $this->db->update('customerhistory', $this, array('ch_no' => $this->input->post('ch_no') ));
       
        
        $sql = "update customer "
                    . "set totalcredit = '$tc' "
                    . "where c_no = '$cno'";
       return $this->db->query($sql); 
    }
    
    
    
    //--------------------------------------------------------------------------
    
     public function del_customer($cno, $uno) 
    {
        $this->u_no = $uno;        
        $this->status = 'DEACTIVATE';         
        $this->db->update('customer', $this, array('c_no' => $cno));
    }

    //--------------------------------------------------------------------------
    
    public function report_customer($data)
    {
      $sql = "SELECT c_no, name, COUNT(trans) as trans, SUM(qty) as qty, 
              CASE
               WHEN SUM(credit) = 0 THEN '-'
               ELSE CONCAT('P ', FORMAT(SUM(credit), 2))
              END as credit,
              CASE 
               WHEN SUM(total) = 0 THEN '-'
               ELSE CONCAT('P ', FORMAT(SUM(total), 2))
              END as cash,
              CASE 
               WHEN SUM(total) + SUM(credit) = 0 THEN '-'
               ELSE CONCAT('P ', FORMAT(SUM(total) + SUM(credit), 2))
              END as total
              FROM
              (
               SELECT  0 as total, totalamount as credit, totalqty as qty, co.c_no, co.co_no as trans, name, co.date
               FROM customer c
               RIGHT JOIN creditorder co
               ON c.c_no = co.c_no
               WHERE co.co_no NOT IN (SELECT co_no FROM creditpaymentline)
              UNION ALL
               SELECT totalamount as total, 0 , totalqty as qty, o.c_no, o.o_no as trans, name, date
               FROM orders o
               LEFT JOIN customer c
                 ON c.c_no = o.c_no
               WHERE totalamount > 0
              UNION ALL 
               SELECT co.totalamount as total, 0, totalqty, co.c_no, 1, name, cp.date
               FROM customer c
               JOIN creditorder co
                 ON c.c_no = co.c_no
               JOIN creditpaymentline cpl
                 ON co.co_no = cpl.co_no
               JOIN creditpayment cp
                 ON cp.cp_no = cpl.cp_no
              ) result
              WHERE date BETWEEN '" . $data['from'] . "' AND '" . $data['to'] . "'
              GROUP BY c_no";

      return $this->db->query($sql)->result();
    }

    public function getUnpaidCUstomer($date)
    {
      $sql = "SELECT 1 as count
              FROM creditorder co, customer c
              WHERE co.c_no = c.c_no
              AND co_no NOT IN (SELECT co_no FROM creditpaymentline)
              AND date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "' 
              GROUP BY name";

      return $this->db->query($sql)->result_array();
    }

    public function post_customer($infos)
    {
      $sql = [
              'name' => $infos['name'],
              'address' => $infos['address'],
              'telno' => (isset($infos['telno']) ? $infos['telno'] : null),
              'creditlimit' => (isset($infos['creditlimit']) ? $infos['creditlimit'] : null),
              'gender' => (isset($infos['gender']) ? $infos['gender'] : null),
              'terms' => (isset($infos['terms']) ? $infos['terms'] : null),
              'discount' => (isset($infos['discount']) ? $infos['discount'] : null),
              'schedule' => (isset($infos['sched']) ? $infos['sched'] : null),
              'u_no' => $this->session->userdata('u_no'),
              'status' => 'ACTIVE'
             ];

      $this->db->insert('customer', $sql);

      return $this->db->insert_id();
    }

    public function post_customerHistory($type, $id, $data = false, $input)
    {
      $data = [
        'date' => date('Y-m-d'),
        'user' => $this->session->userdata('u_no'),
        'description' => $type,
        'amountcredit' => ($data['credit'] ? $data['credit'] : NULL),
        'amountsales' => ($data['sum'] ? $data['sum'] : NULL),
        'doc_no' => $input[1],
        'c_no' => $id
      ];

      $this->db->insert('customerhistory', $data);
    }
}