<?php

class Adjustment_model extends CI_Model
{   
    
    //--------------------------------------------------------------------------
    
    public function get_adjustment()
    {
        $sql = "Select * from stockadjustment order by ref_no desc";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_searchadjustment($search)
    {
        $sql = "Select * from stockadjustment where ref_no like '$search%' or date like '$search%' or posted like '$search%' or sign like '$search%' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_sa_no($ref_no, $filestat, $u_no) 
    {
        $sql = "Insert into stockadjustment(ref_no, filestat, user) value('$ref_no','$filestat', '$u_no')";
        return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
    public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from stockadjustment";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_maxsa_no()
    {
        $sql = "Select max(sa_no) as sa_no from stockadjustment";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function sumadj($sano)
    {
        $sql = "Select sum(totalamount) as ta, sum(pcs) as qty from stockadjustmentline where sa_no = '$sano'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_adjustmentinfo($sano)
    {
        $sql = "Select * from stockadjustment where sa_no = '$sano' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_adjustmentline($sano)
    {
        $sql = "Select l.*, p.longdesc  as longdesc from stockadjustmentline l, product p where l.p_no = p.p_no and l.sa_no = '$sano' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------       
    
    public function update_snoinventory($ino, $sno)
    {                                    
        $this->s_no = $sno;         
        $this->db->update('inventory', $this, array('i_no' => $ino));
    }

    //--------------------------------------------------------------------------
    
    public function update_sign()
    {            
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->remarks = $this->input->post('remarks');
        $this->sign = $this->input->post('sign');
        $this->db->update('stockadjustment', $this, array('sa_no' => $this->input->post('sa_no')));
    }
    //----------------------------------------------------------------------
    
    public function update_sal()
    {            
        $up = $this->input->post('unitprice');
        $pack = $this->input->post('packing');
        $this->uom = $this->input->post('uom');         
        $this->packing = $this->input->post('packing');
        $this->qty = $this->input->post('qty');
        $this->pcs = $this->input->post('pcs');
        $this->unitprice = $this->input->post('unitprice');
        $this->unitcost = $up/$pack;
        $this->totalamount = $this->input->post('ta');
        $this->db->update('stockadjustmentline', $this, array('sal_no' => $this->input->post('sal_no')));
    }
    //----------------------------------------------------------------------
    
    public function insert_sal($sal = null)
    {                    
        $this->db->insert('stockadjustmentline',$sal);
        return $this->db->insert_id();
    }
    //----------------------------------------------------------------------
    
    public function open_adj($sano) 
    {                                    
        $this->filestat = 'OPEN';         
        $this->db->update('stockadjustment', $this, array('sa_no' => $sano));
    }

    //----------------------------------------------------------------------
    
    public function updatesaveadj($user, $qty, $ta) 
    {                                    
        $this->filestat = 'CLOSE';  
        $this->user = $user;
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->remarks = $this->input->post('remarks');
        $this->totalamount = $ta;
        $this->totalqty = $qty;
        $this->db->update('stockadjustment', $this, array('sa_no' => $this->input->post('sa_no')));
    }

    //----------------------------------------------------------------------
    
    public function close_adj($sano) 
    {                                    
        $this->filestat = 'CLOSE';         
        $this->db->update('stockadjustment', $this, array('sa_no' => $sano));
    }

    //----------------------------------------------------------------------
    
    public function post_adj($sano, $u_no, $sign) 
    {                                    
        $this->user = $u_no;     
        $this->posted = 'POSTED';
        $this->db->update('stockadjustment', $this, array('sa_no' => $sano));
        $this->updateprodhist($sano, $u_no, $sign);
        $this->updateproductqty($sano, $sign);        
    }

    //----------------------------------------------------------------------
    
    public function updateprodhist($sano, $u_no, $sign)
    {
        $desc = 'ADJUSTMENT';
        if($sign == "1"){
        $sql = "Insert into producthistory(date, description, u_no, ref_no, p_no, rqty, instock) "
                . "select i.date, '$desc', '$u_no', i.ref_no, l.p_no, (l.pcs+(case when (select rqty from producthistory where p_no = l.p_no and ph_no = (select max(ph_no) from producthistory where p_no = l.p_no)) is null then '0' else (select rqty from producthistory where p_no = l.p_no and ph_no = (select max(ph_no) from producthistory where p_no = l.p_no)) end)), l.pcs  "
                . "from stockadjustmentline l, stockadjustment i "
                . "where i.sa_no = l.sa_no "
                . "and i.sa_no = '$sano' ";
        }else if($sign == "0"){
        $sql = "Insert into producthistory(date, description, u_no, ref_no, p_no, rqty, outstock) "
                . "select i.date, '$desc', '$u_no', i.ref_no, l.p_no, ((case when (select rqty from producthistory where p_no = l.p_no and ph_no = (select max(ph_no) from producthistory where p_no = l.p_no)) is null then '0' else (select rqty from producthistory where p_no = l.p_no and ph_no = (select max(ph_no) from producthistory where p_no = l.p_no)) end)-l.pcs), l.pcs  "
                . "from stockadjustmentline l, stockadjustment i "
                . "where i.sa_no = l.sa_no "
                . "and i.sa_no = '$sano' ";    
        }
       return $this->db->query($sql); 
    }
    
     //----------------------------------------------------------------------
    
    public function updateproductqty($sano, $sign)
    {     
        if($sign == "1"){
        $sql = "update product set product.qty = (select (stockadjustmentline.pcs + product.qty) "
                                            . "from stockadjustmentline "
                                            . "where stockadjustmentline.p_no = product.p_no "
                                            . "and stockadjustmentline.sa_no = '$sano') "
                    . "where product.p_no IN (select stockadjustmentline.p_no "
                                            . "from stockadjustmentline "
                                            . "where stockadjustmentline.p_no = product.p_no "
                                            . "and stockadjustmentline.sa_no = '$sano')";
        }else if($sign == "0"){
            $sql = "update product set product.qty = (select (product.qty-stockadjustmentline.pcs) "
                                            . "from stockadjustmentline "
                                            . "where stockadjustmentline.p_no = product.p_no "
                                            . "and stockadjustmentline.sa_no = '$sano') "
                    . "where product.p_no IN (select stockadjustmentline.p_no "
                                            . "from stockadjustmentline "
                                            . "where stockadjustmentline.p_no = product.p_no "
                                            . "and stockadjustmentline.sa_no = '$sano')";
        }
        return $this->db->query($sql);
        
    }
    
    //--------------------------------------------------------------------------
    
    public function del_adj($sano) 
    {                       
        $this->db->delete('stockadjustmentline', array('sa_no' => $sano));
        $this->db->delete('stockadjustment', array('sa_no' => $sano));
    }

    //----------------------------------------------------------------------
    
    public function del_sal($salno) 
    {                       
        $this->db->delete('stockadjustmentline', array('sal_no' => $salno));
    }

    //----------------------------------------------------------------------
        
}