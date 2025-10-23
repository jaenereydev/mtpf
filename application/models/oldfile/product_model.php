<?php

class Product_model extends CI_Model
{

    //--------------------------------------------------------------------------
       
    public function get_products()
    {
        $query = $this->db->get('product');
        return $query->result();
        
    }

    //--------------------------------------------------------------------------

    public function get_selfProduction($c_no = false, $byArray = false)
    {
      // $sql = "SELECT p_no, longdesc, '-' as qty, '-' as date
      $sql = "SELECT p_no, longdesc
              FROM product
              WHERE LOWER(type) = 'self production'";
          if($c_no)
            $sql .= " AND c_no = " . $c_no;
      $query = $this->db->query($sql);

      return ($byArray ? $query->result_array() : $query->result());
    }

    //--------------------------------------------------------------------------
    
    public function get_productinfo($id)
    {
        $sql = "Select p.*, c.c_no as cc_no, c.status as cstatus, c.description as description, s.name as name, s.s_no as ss_no, s.status as sstatus, "
                . "p.unitprice as unitprice, p.unitcost as unitcost "
                . "from product p, category c, supplier s "
                . "where p.c_no = c.c_no "
                . "and p.s_no = s.s_no "
                . "and p.p_no =?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
    }  

    //--------------------------------------------------------------------------

    public function get_byBatch($id)
    {
      $sql = "SELECT unitprice, p_no, uom, packing, unitcost, qty
              FROM product
              WHERE p_no IN ?";
      return $this->db->query($sql, [$id])->result_array();
    }

    //--------------------------------------------------------------------------
    
    public function get_productactive($bool = false)
    {
        $sql = "Select * from product where status = 'ACTIVE' ORDER BY longdesc";
        $query = $this->db->query($sql);
        return ($bool ? $query->result_array() : $query->result());
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_allproductactive()
    {
        $sql = "Select * from product where status = 'ACTIVE' ORDER BY p_no";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------

    public function get_productactiveadj($sano)
    {
        $sql = "Select * from product where status = 'ACTIVE' and p_no NOT IN (select p_no from stockadjustmentline where sa_no = '$sano')";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    
    public function get_productactivebycat($c_no, $bool = false)
    {
        $sql = "Select * from product where status = 'ACTIVE'";

        if($c_no)
          $sql .= " and c_no = '$c_no' ";
        $sql .= "order by s_no";

        $query = $this->db->query($sql);
        return ($bool ? $query->result_array() : $query->result());
        // return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_productactivebysup($s_no)
    {
        $sql = "Select * from product where status = 'ACTIVE' and s_no = '$s_no' order by s_no";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_productactivebysupcat($s_no, $c_no)
    {
        $sql = "Select * from product where status = 'ACTIVE' and s_no = '$s_no' and c_no = '$c_no' order by s_no";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_productsearch($search)
    {
        if($search == null || $search == "")
        {
            $sql = "Select * from product "
                . "where status = 'ACTIVE' ";
        }else
        {
            $sql = "Select * from product "
                . "where status = 'ACTIVE' "
                . "and longdesc like '$search%' "
                . "or p_no like '$search%' "
                . "and status = 'ACTIVE' ";
        }
        
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_productsearch_pcl($search, $pcno)
    {
        if($search == null || $search == "")
        {
            $sql = "Select * from product "
                . "where status = 'ACTIVE' and p_no NOT IN (select p_no from pricechangeline where pc_no = '$pcno')";
        }else
        {
            $sql = "Select * from product "
                . "where status = 'ACTIVE' "
                . "and longdesc like '$search%' and p_no NOT IN (select p_no from pricechangeline where pc_no = '$pcno') "
                . "or p_no like '$search%' "
                . "and status = 'ACTIVE' and p_no NOT IN (select p_no from pricechangeline where pc_no = '$pcno')";
        }
        
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_productactive_po($po_no, $s_no)
    {
        $sql = "Select * "
                . "from product "
                . "where p_no NOT IN (Select p_no from purchaseorderline where po_no = '$po_no') "
                . "and status = 'ACTIVE' "
                . "and s_no = '$s_no' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function get_searchproductactive_po($po_no, $s_no, $search)
    {
         if($search == null || $search == "")
         {
             $sql = "Select * "
                . "from product "
                . "where p_no NOT IN (Select p_no from purchaseorderline where po_no = '$po_no') "
                . "and status = 'ACTIVE' "
                . "and s_no = '$s_no' ";
         } else {
             $sql = "Select * "
                . "from product "
                . "where p_no NOT IN (Select p_no from purchaseorderline where po_no = '$po_no') "
                . "and status = 'ACTIVE' "
                . "and s_no = '$s_no' "
                . "and p_no like '$search%' "
                . "or longdesc like '$search%' "
                . "and status = 'ACTIVE' ";
         }
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------

    public function get_productactive_del($d_no, $s_no = false)
    {
      if($s_no){
        $sql = "Select * "
                . "from product "
                . "where p_no NOT IN (Select p_no from deliveryline where d_no = '$d_no') "
                . "and status = 'ACTIVE' "
                . "and s_no = '$s_no' ";
      } else if(!is_array($d_no)){
        $sql = "SELECT * FROM product WHERE p_no = '$d_no' AND status = 'ACTIVE'";}
       else {
        $sql = "SELECT p_no, longdesc, shortdesc, qty, unitprice, unitcost, price1, price2, price3, price4, price5, price6, price7, price8, price9, price10, price11 FROM product WHERE p_no = '$d_no[0]' AND status = 'ACTIVE'";
       }
        $query = $this->db->query($sql);
        return $query->result();

    }
    
    //--------------------------------------------------------------------------
    
    public function get_searchproductactive_del($d_no, $s_no, $search)
    {
        if($search == null || $search == "")
        {
            $sql = "Select * from product where p_no NOT IN (Select p_no from deliveryline where d_no = '$d_no') and status = 'ACTIVE' and s_no = '$s_no' ";
        }else
        {
            $sql = "Select * from product where p_no NOT IN (Select p_no from deliveryline where d_no = '$d_no') and status = 'ACTIVE' and s_no = '$s_no' and p_no like '$search%' or longdesc like '$search%' and status = 'ACTIVE' ";
        }              
        $query = $this->db->query($sql);
        return $query->result();

    }
    
    //--------------------------------------------------------------------------
    
    public function get_pricechange($p_no)
    {
        $sql = "Select p.* from pricechange p, pricechangeline l where p.pc_no = l.pc_no and l.p_no IN (select p_no from pricechangeline where p_no = '$p_no') and p.stat = 'POSTED'";
                      
        $query = $this->db->query($sql);
        return $query->result();

    }
    
    //--------------------------------------------------------------------------
    
    public function count_productactive()
    {
        $sql = "Select count(p_no) as p_no from product where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_product($prod = NULL) 
    {
        $this->db->insert('product',$prod);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_product() 
    {        
        $this->longdesc = $this->input->post('longdesc');$this->shortdesc = $this->input->post('shortdesc');             
        $this->c_no = $this->input->post('c_no');$this->s_no = $this->input->post('s_no');
        $this->type = $this->input->post('type');
        $this->s_no = $this->input->post('s_no');
        $this->u_no = $this->input->post('u_no');
        $this->uom = $this->input->post('uom');
        $this->packing = $this->input->post('packing');
        $this->unitprice = $this->input->post('up');
        $this->u_no = $this->input->post('u_no');
        $p = $this->input->post('packing');
        $up = $this->input->post('up');
        $uc = $up/$p;
        $this->unitcost = $uc;
        $this->price1 = $this->input->post('price1');
        $this->price2 = $this->input->post('price2');
        $this->price3 = $this->input->post('price3');
        $this->price4 = $this->input->post('price4');
        $this->price5 = $this->input->post('price5');
        $this->price6 = $this->input->post('price6');
        $this->price7 = $this->input->post('price7');
        $this->price8 = $this->input->post('price8');
        $this->price9 = $this->input->post('price9');
        $this->price10 = $this->input->post('price10');
        $this->price11 = $this->input->post('discountprice');
        
        $this->db->update('product', $this, array('p_no' => $this->input->post('p_no') ));
    }

    //----------------------------------------------------------------------
    
    public function updatedel_product($p_no, $u_no) 
    {                                     
        $this->status = 'DEACTIVATE';    
        $this->u_no = $u_no;       
        $this->db->update('product', $this, array('p_no' => $p_no));
    }

    //----------------------------------------------------------------------


    public function get_profitByDate($date, $format = false, $index = false)
    {
      $sql = "SELECT 
              SUM((CASE WHEN pricestatus = 'price1' THEN price1 
                  WHEN pricestatus = 'price2' THEN price2
                  WHEN pricestatus = 'price3' THEN price3
                  WHEN pricestatus = 'price4' THEN price4
                  WHEN pricestatus = 'price5' THEN price5
                  WHEN pricestatus = 'price6' THEN price6
                  WHEN pricestatus = 'price7' THEN price7
                  WHEN pricestatus = 'price8' THEN price8
                  WHEN pricestatus = 'price9' THEN price9
                  WHEN pricestatus = 'price10' THEN price10
                  WHEN pricestatus = 'price11' THEN price11  
              END / packing - unit) * quantity) as profit FROM
            product, 
            (
             SELECT 
              CASE WHEN o.totalamount < 0 THEN -ol.qty
                  ELSE ol.qty
              END as quantity,
              ol.pricestatus, ol.unitprice as unit, date, p_no as pno
             FROM orders o
             JOIN orderline ol
             ON o.o_no = ol.o_no
             UNION ALL
             -- Profit credit
             SELECT
              col.qty, col.pricestatus, col.unitprice, date, p_no
             FROM creditorder co
             JOIN creditorderline col
             ON co.co_no = col.co_no
            ) profit
            WHERE pno = p_no
            AND date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'";
      $result = $this->db->query($sql)->result()[0]->profit;
      return ($result ? $result : 0);
    }

    public function getProfitGraph($date, $format, $index)
    {
      // $sql = "SELECT
      //           SUM(totalamount) - 
      //           SUM(CASE 
      //             WHEN discountamount IS NULL THEN 0
      //             ELSE discountamount
      //           END +
      //           CASE 
      //             WHEN additionalamount IS NULL THEN 0
      //             ELSE additionalamount
      //           END) as profit, 
      //           totalamount, $format[$index]
      //         FROM 
      //         (
      //           SELECT discountamount, additionalamount, totalamount, date
      //           FROM orders
      //           WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "' 
      //           UNION ALL
      //           SELECT discountamount, additionalamount, totalamount, date
      //           FROM creditorder
      //           WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "' 
      //         ) as sales
      //         GROUP BY $index(date)";
       $sql =  "SELECT 
                  SUM((price / packing - unitcost) * quantity) as profit, 
                  SUM(unitcost * quantity) as cost,
                  DATE_FORMAT(date, '%b. %d, %Y') as DAY, 
                  $format[$index]
                FROM product,
                ( 
                 SELECT 
                    CASE WHEN o.totalamount < 0 THEN -ol.qty
                      ELSE ol.qty
                    END as quantity,
                    p_no as pno, price, date
                 FROM orders o
                 JOIN orderline ol
                 ON o.o_no = ol.o_no
                 WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'
                 UNION ALL
                 SELECT qty, p_no, price, date
                 FROM creditorder co
                 JOIN creditorderline col
                 ON co.co_no = col.co_no
                 WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'
                ) as profit
                WHERE p_no = pno
                GROUP BY $index(date)";

      return $this->db->query($sql)->result_array();
    }
        
}