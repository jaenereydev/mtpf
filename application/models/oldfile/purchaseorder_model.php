<?php

class Purchaseorder_model extends CI_Model
{   
    //--------------------------------------------------------------------------    
    
     public function get_orderingactive()
    {
        $sql = "Select * "
               . "from purchaseorder "
               . "where status = 'ACTIVE' "
               . "order by po_no DESC";
        
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    //--------------------------------------------------------------------------   
    
    public function get_searchpo($search)
    {
        $sql = "Select * "
               . "from purchaseorder  "
                . "where ref_no like '$search%' "
                . "or s_no like '$search%' "
                . "or date like '$search%' "
               . "order by po_no DESC";
        
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    //--------------------------------------------------------------------------   
    
     public function get_porefno()
    {
        $sql = "Select * from purchaseorder ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------    
    
     public function get_po()
    {
        $sql = "Select * "
                . "from purchaseorder "
                . "where po_no NOT IN (select po_no from purchaseorder where stat = 'FULLY DELIVERED') "
                . "and po_no NOT IN (select po_no from purchaseorder where stat = 'OVER DELIVERED') "
                . "and posted = 'POSTED' "
                . "order by po_no DESC";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    //--------------------------------------------------------------------------    
    
    
    public function get_purchaseorderinfo($po_no)
    {
        $sql = "Select * from purchaseorder where po_no =?";
        $query = $this->db->query($sql, array($po_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------  
    
     public function get_purchaseorderlineinfo($po_no)
    {
        $sql = "Select * from purchaseorderline where po_no =?";
        $query = $this->db->query($sql, array($po_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------  
    
    public function get_purchaseorderline_sum($po_no)
    {
        $sql = "Select sum(totalamount) as totalamount, sum(qty) as totalqty, sum(pcs) as totalpcs from purchaseorderline where po_no =?";
        $query = $this->db->query($sql, array($po_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
    public function get_purchaseorderline($po_no)
    {
        $sql = "Select l.pol_no as pol_no, p.longdesc as longdesc, l.uom as uom, l.packing as packing, l.unitprice as unitprice, l.pcs as pcs, "
                . "l.qty as qty, l.totalamount as totalamount "
                . "from purchaseorderline l, product p "
                . "where l.p_no = p.p_no "
                . "and po_no =?";
        $query = $this->db->query($sql, array($po_no));
        $this->db->last_query();
        return $query->result();
        
    }

    //--------------------------------------------------------------------------
    
     public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from purchaseorder";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_maxpo_no()
    {
        $sql = "Select max(po_no) as po_no from purchaseorder";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_po_no($ref_no, $filestat, $status, $u_no) 
    {
        $sql = "Insert into purchaseorder(ref_no, filestat, status, u_no) value('$ref_no','$filestat', '$status', '$u_no')";
            return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
     public function updatepo_insertproduct($p_no,$up,$qty,$u_no,$po_no, $uom, $packing, $pcs) 
    {
        $sql = "Insert into purchaseorderline(p_no, po_no, u_no, qty, unitprice, totalamount, uom, packing, pcs) "
                . "value('$p_no','$po_no', '$u_no', '$qty', '$up', '$up', '$uom', '$packing', '$pcs')";
            return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
     public function updatepo_insertprodut() 
    {
        $value1 = $this->input->post('date2');$this->date = date_format(date_create($value1), 'Y-m-d'); 
        $value2 = $this->input->post('deliverydate2'); $this->deliverydate = date_format(date_create($value2), 'Y-m-d');
        $this->s_no = $this->input->post('s_no2');
        $this->remarks = $this->input->post('remarks2');
        $this->totalamount = $this->input->post('totalamount');
        
        $this->db->update('purchaseorder', $this, array('po_no' => $this->input->post('po_no2') ));
    }

    //--------------------------------------------------------------------------
    
    public function update_pol($u_no) 
    {        
        $this->u_no = $u_no;
        $this->totalamount = $this->input->post('ta');
        $this->po_no = $this->input->post('po_no');
        $this->qty= $this->input->post('qty');        
        $this->pcs= $this->input->post('pcs');
        
        $this->db->update('purchaseorderline', $this, array('pol_no' => $this->input->post('pol_no') ));
    }

    //----------------------------------------------------------------------
    
    public function update_posave($u_no) 
    {        
        $sno = $this->input->post('s_no3');
        if($sno == null||$sno == "")
        {
            $this->u_no = $u_no;$this->totalamount = $this->input->post('totalamount3');
            $this->totalqty = $this->input->post('totalqty3');$this->totalpcs = $this->input->post('totalpcs');            
            $value1 = $this->input->post('date3');$this->date = date_format(date_create($value1), 'Y-m-d'); 
            $value2 = $this->input->post('deliverydate3');$this->deliverydate = date_format(date_create($value2), 'Y-m-d');                   
            $this->remarks = $this->input->post('remarks1');$this->filestat = "CLOSE";     
            
        }else 
        {
            $this->u_no = $u_no;
            $this->totalamount = $this->input->post('totalamount3');$this->totalpcs = $this->input->post('totalpcs');
            $this->totalqty = $this->input->post('totalqty3');            
            $value1 = $this->input->post('date3');$this->date = date_format(date_create($value1), 'Y-m-d'); 
            $value2 = $this->input->post('deliverydate3');$this->deliverydate = date_format(date_create($value2), 'Y-m-d');            
            $this->s_no = $this->input->post('s_no3');$this->remarks = $this->input->post('remarks1');$this->filestat = "CLOSE";     
        }                           
        $this->db->update('purchaseorder', $this, array('po_no' => $this->input->post('po_no3') ));
    }

    //----------------------------------------------------------------------
    
     public function closepo($po_no) 
    {                       
        $this->filestat = "CLOSE";     
                                  
        $this->db->update('purchaseorder', $this, array('po_no' => $po_no ));
    }

    //----------------------------------------------------------------------
    
     public function close_po($po_no) 
    {                
        $this->filestat = "CLOSE";                        
        $this->db->update('purchaseorder', $this, array('po_no' => $po_no ));
    }

    //----------------------------------------------------------------------
    
     public function openpo($po_no) 
    {                
        $this->filestat = "OPEN";                        
        $this->db->update('purchaseorder', $this, array('po_no' => $po_no ));
    }

    //----------------------------------------------------------------------
    
    public function post_po($u_no, $po_no) 
    {        
        $this->u_no = $u_no;
        $this->posted = "POSTED";        
        $this->stat = "NOTYETDELIVERED";
        
        $this->db->update('purchaseorder', $this, array('po_no' => $po_no ));
    }

    //----------------------------------------------------------------------
    
    
    public function del_pol($polno) 
    {                       
         $this->db->delete('purchaseorderline', array('pol_no' => $polno));
    }

    //----------------------------------------------------------------------
    
    public function del_po($pono) 
    {                       
        $this->db->delete('purchaseorderline', array('po_no' => $pono));
         $this->db->delete('purchaseorder', array('po_no' => $pono));
    }

    //----------------------------------------------------------------------
        
}