<?php

class Expenses_model extends CI_Model
{   
    //--------------------------------------------------------------------------

    public function get_expenses()
    {
        $sql = "Select * from expenses where date = CURDATE()";
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_searchexp($search)
    {
        $sql = "Select * from expenses where date like '$search%' or doc_no like '$search%' or amount like '$search%'";
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_exp($e_no = NULL) 
    {
        $this->db->insert('expenses',$e_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_exp($uno) 
    {        
        $this->description = $this->input->post('description');
        $this->user = $uno;
        $this->doc_no = $this->input->post('docno');
        $this->amount = $this->input->post('amount');
        $this->remarks = $this->input->post('remarks');
        $this->type = $this->input->post('typ');
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');        
        $this->db->update('expenses', $this, array('e_no' => $this->input->post('e_no') ));
    }

    //----------------------------------------------------------------------
    
   public function del_exp($eno) 
    {                       
         $this->db->delete('expenses', array('e_no' => $eno));
    }

    public function expenseReportGraph($date, $data, $index)
    {
      $sql = "SELECT 
                SUM(amount) as amount, date, $data[$index], type
              FROM expenses
              WHERE date BETWEEN ? AND ?
              GROUP BY $index(date), type";
      return $this->db->query($sql, $date)->result_array();
    }

    public function getExpensesByUserId($date = false, $u_no = false)
    {
      $sql = "SELECT doc_no, type, description, amount
              FROM expenses
              WHERE date = ";
              if($date)
                $sql .= "'" . $date . "' AND user = " . $u_no;
              else
                $sql .= " CURDATE() AND user = " . $this->session->userdata('u_no');
      return $this->db->query($sql)->result_array();
    }

    public function getExpenseByType($type, $date = false, $u_no = false)
    {
      $sql = "SELECT 
                CASE
                    WHEN SUM(amount) IS NULL THEN 0
                    ELSE SUM(amount)
                END as total, DATE_FORMAT(date, '%b. %d, %Y') as date, user
              FROM expenses
              WHERE date ";
              if ($u_no)
                $sql .= " = '" . $date . "' AND user = " . $u_no;
              else if($date)
                $sql .= "BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'";
              else 
                $sql .= "=  CURDATE()  AND user = " . $this->session->userdata('u_no');

              $sql .= " AND type = ?";
      return $this->db->query($sql, [$type])->result();
    }

    public function getExpenseByDate($date)
    {
        $sql = "SELECT SUM(amount) as expense
                FROM expenses
                WHERE date BETWEEN ? AND ?";
        $result = $this->db->query($sql, [$date['from'], $date['to']])->result()[0]->expense;
        return ($result ? $result : 0);
    }
    
    public function expenses_report_summary($data)
    {
        $sql = "SELECT * 
                FROM EXPENSES
                WHERE date BETWEEN ? AND ?";

        return $this->db->query($sql, $data)->result_array();
    }

    //----------------------------------------------------------------------
        
}