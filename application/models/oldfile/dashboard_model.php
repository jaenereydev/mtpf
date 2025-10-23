<?php

class Dashboard_model extends CI_Model
{   
    //--------------------------------------------------------------------------
    
    public function dbbackup($date)
    {
        $this->load->dbutil();   
        $backup =& $this->dbutil->backup();  
        $this->load->helper('file');
        write_file('<?php echo base_url();?>/downloads', $backup);
        $this->load->helper('download');
        $name = '('.$date.')backup.gz';
        force_download($name, $backup);
    }
    //--------------------------------------------------------------------------
    
    public function get_orders()
    {
        $sql = "Select sum(totalamount) as ota from orders where date = curdate() ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_checkorders()
    {
        $sql = "Select sum(checkamount) as cta from orders where date = curdate() ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function get_paymentrefcash()
    {
        $sql = "Select sum(c.totalamount) as pta from creditpayment c, paymentref r where c.cp_no = r.cp_no and r.description = 'Cash' and c.posted = 'POSTED' and c.date = curdate()   ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_paymentrefcheck()
    {
        $sql = "Select sum(c.totalamount) as pta from creditpayment c, paymentref r where c.cp_no = r.cp_no and r.description = 'Check' and c.posted = 'POSTED' and c.date = curdate()   ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function get_expenses()
    {
        $sql = "SELECT sum(amount) as ta from expenses where date = curdate() ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
}