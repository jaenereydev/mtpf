<?php

class Product_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_product() 
  {
  
    $sql = "Select * from product where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function searchbarcode($b) 
  {
      $sql = "Select * from product 
              where active = 'YES' 
              and barcode = '$b'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_productsearch($p) 
  {
  
      $sql = "Select * from product 
              where active = 'YES' 
              and barcode LIKE '%$p%'
              or active = 'YES' 
              and name LIKE '%$p%'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_allproductwithoutunitcost() 
  {
  
      $sql = "Select * from product 
              where active = 'YES' 
              and unitcost = '0'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_allproductwithnegativequantity() 
  {
  
      $sql = "Select * from product 
              where active = 'YES' 
              and qty < '0'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function inventorycost() 
  {
  
    $sql = "Select * from product where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  public function inventorytotalcost() 
  {
  
    $sql = "Select sum(qty*unitcost) as tcost, sum(qty) as tqty from product where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_productfortransaction($u) 
  {
  
    $sql = "Select * 
              from product 
              where active = 'YES' 
              and p_no not in (select product_p_no from transactionline where user_id = '$u' and transaction_t_no is null)";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------


  public function get_productinv($i) 
  {  
    $sql = "SELECT * 
            from product 
            where active = 'YES' 
            and p_no NOT IN (SELECT product_p_no from inventoryline where inventory_i_no ='$i') ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function productinfo($p) 
  {
  
    $sql = "Select p.*, s.name as sname, c.name as cname 
          from product p 
          join supplier s on s.s_no = p.supplier_s_no 
          join category c on c.c_no = p.category_c_no 
          where p.p_no = '$p' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function producthistoryinfo($p) 
  {
  
    $sql = "Select p.*, u.* from product_history p join user u ON u.id = p.user_id where p.product_p_no = '$p' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function insertproduct($p = null) 
  {  
      $this->db->insert('product',$p);
  }

  //--------------------------------------------------------------------------     

  public function updateproduct($p, $prod = null) 
  {  
      $this->db->where('p_no',$p)
              ->update('product', $prod);
  }

  //--------------------------------------------------------------------------    

  public function countproduct() 
  {
  
    $sql = "Select count(p_no) as p from product where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function countproductwounitcost() 
  {
  
    $sql = "Select count(p_no) as p from product where active = 'YES' and unitcost = '0' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function productwithnegativequantity() 
  {
  
    $sql = "Select count(p_no) as p from product where active = 'YES' and qty < '0' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function updatestockadjustmentproductqty($type = 'positive') // update qty from stock adjustment positive
    {
        // Get session sano value
      $sano = $this->session->userdata('sano');
      if (!$sano) return false;

      // Determine operator based on adjustment type
      $operator = ($type === 'negative') ? '-' : '+';

      $sql = "UPDATE product p
              JOIN (
                  SELECT product_p_no, SUM(qty) AS total_qty
                  FROM stockadjustmentline
                  WHERE sa_no = ?
                  GROUP BY product_p_no
              ) sal ON product_p_no = p.p_no
              SET p.qty = p.qty $operator sal.total_qty";

      return $this->db->query($sql, array($sano));
    }
    
  //--------------------------------------------------------------------------

  public function updatedeliveryproductqty($d) // update qty from delivery
    {
        $sql = "update product set product.qty = (select (product.qty + deliveryline.qty) "
                                            . "from deliveryline "
                                            . "where deliveryline.product_p_no = product.p_no "
                                            . "and deliveryline.delivery_d_no = '$d') "
                    . "where product.p_no IN (select deliveryline.product_p_no "
                                            . "from deliveryline "
                                            . "where deliveryline.product_p_no = product.p_no "
                                            . "and deliveryline.delivery_d_no = '$d')";
        return $this->db->query($sql);
    }
    
  //--------------------------------------------------------------------------

  public function updatesalesproductqty($tno) // update qty from POS
  {
      $sql = "update product set product.qty = (select (product.qty - transactionline.qty) "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno') "
                  . "where product.p_no IN (select transactionline.product_p_no "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatecreditloanproductqty($clno) // update qty from CREDIT LOAN
  {
      $sql = "update product set product.qty = (select (product.qty - creditloanline.qty) "
                                          . "from creditloanline "
                                          . "where creditloanline.product_p_no = product.p_no "
                                          . "and creditloanline.credit_loan_cl_no = '$clno') "
                  . "where product.p_no IN (select creditloanline.product_p_no "
                                          . "from creditloanline "
                                          . "where creditloanline.product_p_no = product.p_no "
                                          . "and creditloanline.credit_loan_cl_no = '$clno')"
                  . "and product.inventory = 'Yes'";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatesalesreturnproductqty($tno) // update qty from POS Sales Return
  {
      $sql = "update product set product.qty = (select (product.qty + transactionline.qty) "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno') "
                  . "where product.p_no IN (select transactionline.product_p_no "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatecreditreturnproductqty($rtno) // update qty from Credit Return
  {
      $sql = "update product set product.qty = (select (product.qty + returntransactionline.qty) "
                                          . "from returntransactionline "
                                          . "where returntransactionline.product_p_no = product.p_no "
                                          . "and returntransactionline.returntransaction_rt_no = '$rtno') "
                  . "where product.p_no IN (select returntransactionline.product_p_no "
                                          . "from returntransactionline "
                                          . "where returntransactionline.product_p_no = product.p_no "
                                          . "and returntransactionline.returntransaction_rt_no = '$rtno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updateinventoryproductqty($ino) // update qty from inventory
  {
      $sql = "update product set product.qty = (select inventoryline.qty "
                                          . "from inventoryline "
                                          . "where inventoryline.product_p_no = product.p_no "
                                          . "and inventoryline.inventory_i_no = '$ino') "
                  . "where product.p_no IN (select inventoryline.product_p_no "
                                          . "from inventoryline "
                                          . "where inventoryline.product_p_no = product.p_no "
                                          . "and inventoryline.inventory_i_no = '$ino')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

}
