<?php

class Receiving_model extends CI_Model
{   
    //--------------------------------------------------------------------------    
    
     public function get_receivingactive()
    {
        $sql = "Select * from delivery where status = 'ACTIVE' order by d_no DESC";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------   
    
    public function count_del()
    {
        $sql = "Select sum(totalamount) as totalamount from delivery where status = 'ACTIVE' and filestat != 'PAYED' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------   
    
    public function get_searchreceivingactive($search)
    {
        $sql = "Select * from delivery where status = 'ACTIVE' and s_no like '$search%' or date like '$search%' or ref_no like '$search%' order by d_no DESC";
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
    
    public function get_deliveryinfo($d_no)
    {
        $sql = "Select * from delivery where d_no =?";
        $query = $this->db->query($sql, array($d_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------  
    
     public function get_deliverylineinfo($d_no)
    {
        $sql = "Select * from deliveryline where d_no =?";
        $query = $this->db->query($sql, array($d_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------  
    
    public function get_deliveryline_sum($d_no)
    {
        $sql = "Select sum(totalamount) as totalamount, sum(qty) as totalqty, sum(pcs) as totalpcs from deliveryline where d_no =?";
        $query = $this->db->query($sql, array($d_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_deliveryline($d_no)
    {
        $sql = "Select d.dl_no as dl_no, p.longdesc as longdesc, d.uom as uom, d.packing as packing, d.unitprice as unitprice, d.pcs as pcs, "
                . "d.qty as qty, d.totalamount as totalamount "
                . "from deliveryline d, product p "
                . "where d.p_no = p.p_no "
                . "and d.d_no =?";
        $query = $this->db->query($sql, array($d_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
     public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from delivery";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_maxd_no()
    {
        $sql = "Select max(d_no) as d_no from delivery";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_d_no($ref_no, $filestat, $status, $u_no) 
    {
        $sql = "Insert into delivery(ref_no, filestat, status, u_no) value('$ref_no','$filestat', '$status', '$u_no')";
            return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
     public function updatedl_insertproduct($p_no,$up,$qty,$u_no,$d_no,$uom, $packing, $pcs) 
    {
        $sql = "Insert into deliveryline(p_no, d_no, u_no, qty, unitprice, totalamount, uom, packing, pcs) value('$p_no','$d_no', '$u_no', '$qty', '$up', '$up', '$uom', '$packing', '$pcs')";
            return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
    public function updatedel_insertproduct() 
    {
        $value = $this->input->post('date2'); $this->date = date_format(date_create($value), 'Y-m-d');        
        $this->remarks = $this->input->post('remarks2');
        $this->doc_no = $this->input->post('docno');
        
        $this->db->update('delivery', $this, array('d_no' => $this->input->post('d_no') ));
    }

    //--------------------------------------------------------------------------
    
    public function update_deliverypo($pono, $dno, $sno, $uno) 
    {       
        $this->po_no = $pono;        
        $this->s_no = $sno;        
        $this->db->update('delivery', $this, array('d_no' => $dno ));
        
        $this->db->delete('deliveryline', array('d_no' => $dno));
        
        $sql = "Insert into deliveryline(u_no, qty, unitprice, totalamount, p_no, d_no, uom, packing, pcs) "
                . "select '$uno', qty, unitprice, totalamount, p_no, '$dno', uom, packing, pcs from purchaseorderline "
                . "where po_no = '$pono'";
        return $this->db->query($sql);
    }

    //--------------------------------------------------------------------------
    
    public function update_deliverypopd($pono, $dno, $sno, $uno) 
    {       
        $this->po_no = $pono;        
        $this->s_no = $sno;        
        $this->db->update('delivery', $this, array('d_no' => $dno ));
        
        $this->db->delete('deliveryline', array('d_no' => $dno));
        
        $sql = "Insert into deliveryline(u_no, qty, unitprice, totalamount, p_no, d_no, uom, packing, pcs) "
                . "select '$uno' , case when ((l.qty)-(select q.qty from deliveryline q, delivery d "
                . "where q.d_no = d.d_no and d.po_no = '$pono' and q.p_no = l.p_no and q.qty != l.qty)) is null "
                . "then l.qty else ((l.qty)-(select q.qty from deliveryline q, delivery d "
                . "where q.d_no = d.d_no and d.po_no = '$pono' and q.p_no = l.p_no and q.qty != l.qty)) end as qty, "
                . "l.unitprice, "
                . "(case when ((l.qty)-(select q.qty from deliveryline q, delivery d "
                . "where q.d_no = d.d_no and d.po_no = '$pono' and q.p_no = l.p_no and q.qty != l.qty)) is null "
                . "then l.qty else ((l.qty)-(select q.qty from deliveryline q, delivery d where q.d_no = d.d_no and d.po_no = '$pono' and q.p_no = l.p_no and q.qty != l.qty)) end)*(l.unitprice) as totalamount, "
                . "l.p_no, '$dno', l.uom, l.packing, l.pcs "
                . "from purchaseorderline l, purchaseorder p "
                . "where l.po_no = p.po_no "
                . "and l.po_no = '$pono' "
                . "and l.p_no not in (select q.p_no from deliveryline q, delivery d where q.d_no = d.d_no and d.po_no = '$pono' and q.p_no = l.p_no and q.qty = l.qty)";
               
        return $this->db->query($sql);
    }

    //--------------------------------------------------------------------------
    
    public function update_dl($u_no) 
    {        
        $this->u_no = $u_no;
        $this->totalamount = $this->input->post('ta');
        $this->d_no = $this->input->post('d_no');
        $this->qty = $this->input->post('qty');
        $this->pcs = $this->input->post('pcs');
        $this->uom = $this->input->post('uom');
        $this->packing = $this->input->post('packing');
        
        $this->db->update('deliveryline', $this, array('dl_no' => $this->input->post('dl_no') ));
    }

    //----------------------------------------------------------------------
    
    public function update_delsave($u_no) 
    {        
        $this->u_no = $u_no;
        $this->totalamount = $this->input->post('totalamount3');
        $this->totalqty = $this->input->post('totalqty3');        
        $value = $this->input->post('date3'); $this->date = date_format(date_create($value), 'Y-m-d');                
        $this->remarks = $this->input->post('remarks1');
        $this->doc_no = $this->input->post('docno');
        $this->filestat = "CLOSE";                        
        $this->db->update('delivery', $this, array('d_no' => $this->input->post('d_no') ));
    }

    //----------------------------------------------------------------------
    
    public function update_delclose($dno) 
    {   
        $this->filestat = "CLOSE";                        
        $this->db->update('delivery', $this, array('d_no' => $dno ));
    }

    //----------------------------------------------------------------------
    
    public function post_del($u_no, $d_no, $po_no, $stat) 
    {        
        $this->u_no = $u_no;
        $this->posted = "POSTED";        
        $this->stat = $stat;
        $this->db->update('delivery', $this, array('d_no' => $d_no ));
        $this->update_prodhist($d_no, $u_no);
        $this->stat = $stat;
        $this->db->update('delivery', $this, array('po_no' => $po_no ));
        
        $this->update_inv($d_no);
        
        
        $sql = "Update purchaseorder SET stat = '$stat' where po_no = '$po_no' ";
        return $this->db->query($sql);
        
    }

    //----------------------------------------------------------------------
    
    public function update_prodhist($d_no, $u_no)
    {
        $desc = 'RECEIVED';
        $sql = "Insert into producthistory(date, description, u_no, ref_no, p_no, rqty, instock) "
                . "select d.date, '$desc', '$u_no', d.ref_no, l.p_no, (l.pcs+p.qty), l.pcs  "
                . "from deliveryline l, delivery d, product p "
                . "where p.p_no = l.p_no "
                . "and d.d_no = l.d_no "
                . "and l.d_no = '$d_no' ";
       return $this->db->query($sql); 
    }
    
     //----------------------------------------------------------------------
    
    public function update_inv($d_no)
    {
       $sql = "update product "
                    . "set product.qty = (select (deliveryline.pcs + product.qty) "
                                            . "from deliveryline "
                                            . "where deliveryline.p_no = product.p_no "
                                            . "and deliveryline.d_no = '$d_no') "
                    . "where product.p_no IN (select deliveryline.p_no "
                                            . "from deliveryline "
                                            . "where deliveryline.p_no = product.p_no "
                                            . "and deliveryline.d_no = '$d_no')";
       return $this->db->query($sql); 
    }
    
    //----------------------------------------------------------------------
    
    public function close_del($dno) 
    {                
        $this->filestat = "CLOSE";                
        $this->db->update('delivery', $this, array('d_no' => $dno ));
    }

    //----------------------------------------------------------------------
    
     public function opendel($dno) 
    {                
        $this->filestat = "OPEN";                
        $this->db->update('delivery', $this, array('d_no' => $dno ));
    }

    //----------------------------------------------------------------------
    
    
    public function del_dl($dlno) 
    {                       
         $this->db->delete('deliveryline', array('dl_no' => $dlno));
    }

    //----------------------------------------------------------------------
    
    public function deldel($dno) 
    {                       
         $this->db->delete('deliveryline', array('d_no' => $dno));
         $this->db->delete('delivery', array('d_no' => $dno));
    }

    //----------------------------------------------------------------------

    public function get_receivingByDate($date)
    {
      $sql = "SELECT SUM(totalamount) as receive
              FROM creditorder
              WHERE co_no NOT IN (SELECT co_no FROM creditpaymentline)
              AND date BETWEEN ? AND ?";
      $result = $this->db->query($sql, [$date['from'], $date['to']])->result()[0]->receive;

      return ($result ? $result : 0);
    }
        
}