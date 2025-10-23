<?php
 
class Sales_model extends CI_Model
{

  //----------------------------------------------------------------------

  public function get_transactioninfo($t) 
  {
    $sql = "SELECT *
              from transaction  
              where  t_no = '$t' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_totalcashsalesperdayperuser() 
  {
    $sql = "SELECT sum(t.totalqty) as tqty, sum(t.totalamount) as tamount, u.name as name
            FROM transaction t 
            JOIN user u on u.id = t.user_id 
            where t.date = CURDATE()
            and t.type = 'CASH'
            Group BY t.user_id ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_totaldownpaymentperuser($u) 
  {
    $sql = "SELECT sum(downpayment) as dp 
            FROM credit_loan 
            where date = CURDATE()
            and user_id = '$u'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_datetotaldownpaymentperuser($u, $d) 
  {
    $sql = "SELECT sum(downpayment) as dp 
            FROM credit_loan 
            where date = '$d'
            and user_id = '$u'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_creditloanperuser($u) 
  {
    $sql = "SELECT c.*, t.name
            FROM credit_loan c
            JOIN customer t ON t.c_no = c.customer_c_no
            where c.date = CURDATE()
            and c.user_id = '$u'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_datecreditloanperuser($u, $d) 
  {
    $sql = "SELECT c.*, t.name
            FROM credit_loan c
            JOIN customer t ON t.c_no = c.customer_c_no
            where c.date = '$d'
            and c.user_id = '$u'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_repaymentperuser($u) 
  {
    $sql = "SELECT sum(amount_payed+penalty) as ap
            FROM repayment
            where date_payed = CURDATE()
            and user_id = '$u'
            and post = 'POSTED'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_daterepaymentperuser($u, $d) 
  {
    $sql = "SELECT sum(amount_payed+penalty) as ap
            FROM repayment
            where date_payed = '$d'
            and user_id = '$u'
            and post = 'POSTED'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_creditloanpaidtoday($u) 
  {
    $sql = "SELECT r.*, c.name
            FROM repayment r
            join customer c on c.c_no = r.customer_c_no
            where r.date_payed = CURDATE()
            and r.user_id = '$u'
            and r.post = 'POSTED'
            and r.amount_payed > '0' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_datecreditloanpaidtoday($u, $d) 
  {
    $sql = "SELECT r.*, c.name
            FROM repayment r
            join customer c on c.c_no = r.customer_c_no
            where r.date_payed = '$d'
            and r.user_id = '$u'
            and r.post = 'POSTED'
            and r.amount_payed > '0' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_totalcreditsalesperdayperuser() 
  {
    $sql = "SELECT sum(t.totalqty) as tqty, sum(t.totalamount) as tamount, u.name as name
            FROM transaction t 
            JOIN user u on u.id = t.user_id 
            where t.date = CURDATE()
            and t.type = 'CREDIT'
            Group BY t.user_id ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_daytransaction($u) // sql for transactoin for the day
   {
    $sql = "SELECT *
              from transaction  
              where  user_id = '$u' 
              and date = CURDATE()";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_datetransaction($u, $d) // sql for transactoin for the day
   {
    $sql = "SELECT *
              from transaction  
              where  user_id = '$u' 
              and date = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------
  
  public function get_sumtransaction($u, $desc) // sql for transactoin for the day
  {
    $sql = "SELECT sum(totalamount) as ta
              from transaction  
              where  user_id = '$u' 
              and date = CURDATE() 
              and type = '$desc' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  
  public function get_datesumtransaction($u, $d, $desc) // sql for transactoin for the day
  {
    $sql = "SELECT sum(totalamount) as ta
              from transaction  
              where user_id = '$u' 
              and date = '$d' 
              and type = '$desc' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_sumexpenses($u) // sql for transactoin for the day
   {
    $sql = "SELECT sum(amount) as ta
              from expenses 
              where  user_id = '$u' 
              and date = CURDATE() ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_datesumexpenses($u, $d) // sql for transactoin for the day
   {
    $sql = "SELECT sum(amount) as ta
              from expenses 
              where  user_id = '$u' 
              and date = '$d' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------


  public function get_customerdeposit($u) // sql for transaction for the day
  {
    $sql = "SELECT sum(amount) as ta
              from customerdeposit 
              where  user_id = '$u' 
              and date = CURDATE() ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_sumdeposit($u) // sql for transactoin for the day
  {
    $sql = "SELECT sum(amount) as ta
              from deposit 
              where  user_id = '$u' 
              and date = CURDATE() ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_datesumdeposit($u, $d) // sql for transactoin for the day
  {
    $sql = "SELECT sum(amount) as ta
              from deposit 
              where  user_id = '$u' 
              and date = '$d' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function get_sumcreditpayment($u) // sql for transactoin for the day
  {
    $sql = "SELECT sum(totalpayment) as ta
              from customerpayment 
              where  user_id = '$u' 
              and date = CURDATE() 
              and post = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_datesumcreditpayment($u, $d) // sql for transactoin for the day
  {
    $sql = "SELECT sum(totalpayment) as ta
              from customerpayment 
              where  user_id = '$u' 
              and date = '$d'
              and post = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_sumcashonhand($u) // sql for sum cash on hand for the day
  {
    $sql = "SELECT sum(cashonhand) as ta
              from salesreport 
              where  user_id = '$u' 
              and date = CURDATE()";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_datesumcashonhand($u, $d) // sql for sum cash on hand for the day
  {
    $sql = "SELECT sum(cashonhand) as ta
              from salesreport 
              where  user_id = '$u' 
              and date = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_cashonhandinfo($u) // sql for coh of the day
  {
    $sql = "SELECT *
              from salesreport 
              where  user_id = '$u' 
              and date = CURDATE()";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_datecashonhandinfo($u, $d) // sql for coh of the day
  {
    $sql = "SELECT *
              from salesreport 
              where  user_id = '$u' 
              and date = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
  //----------------------------------------------------------------------

  public function get_transactionlineinfo($t) 
  {
  
    $sql = "SELECT t.*, t.qty as tlqty, p.name as name, p.barcode as barcode, p.*, t.description as description
              from transactionline t 
              join product p on p.p_no = t.product_p_no
              where t.transaction_t_no = '$t' ";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------
  public function get_transactionline($u) 
  {
  
    $sql = "SELECT t.*, t.qty as tlqty, p.name as name, p.barcode as barcode, p.*, t.description as description
              from transactionline t 
              join product p on p.p_no = t.product_p_no
              where t.user_id = '$u' 
              and t.transaction_t_no is null";
    $query = $this->db->query($sql);
    return $query->result();
  }
 
 
  //----------------------------------------------------------------------

  public function updatetransactionline($tno, $u) 
  {
  
    $sql = "UPDATE transactionline set transactionline.transaction_t_no = '$tno' 
            WHERE transactionline.user_id = '$u' 
            AND transactionline.transaction_t_no is NULL";
        return $this->db->query($sql);
  }

 
  //----------------------------------------------------------------------

  public function inserttransactionline($tl = null) 
  {  
      $this->db->insert('transactionline',$tl);
  }

  // //--------------------------------------------------------------------------    

  public function insertcoh($c = null) 
  {  
      $this->db->insert('salesreport',$c);
  }

  //--------------------------------------------------------------------------     

  public function inserttransaction($t = null) 
  {  
      $this->db->insert('transaction',$t);
      return $this->db->insert_id();
  }

  //--------------------------------------------------------------------------     

  public function updatetransaction($tno, $t = null) 
  {  
      $this->db->where('t_no',$tno)
              ->update('transaction', $t);
  }
  
  //-------------------------------------------------------------------------- 

  public function edittransactionline($tno, $tl = null) 
  {  
      $this->db->where('tl_no',$tno)
              ->update('transactionline', $tl);
  }
  

  //   //--------------------------------------------------------------------------  

  public function updatecoh($srno, $s = null) 
  {  
      $this->db->where('sr_no',$srno)
              ->update('salesreport', $s);
  }
  

  //   //--------------------------------------------------------------------------      

    public function deletetransactionline($tl) 
    {                       
         $this->db->delete('transactionline', array('tl_no' => $tl));
    }

    //--------------------------------------------------------------------------   

    public function deletealltransactionline($u) 
    {                       
        $sql = "DELETE FROM transactionline WHERE user_id ='$u' and transaction_t_no is null";
       return $this->db->query($sql);
    }
}
