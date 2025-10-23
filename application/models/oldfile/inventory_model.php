<?php

class Inventory_model extends CI_Model
{   
    
    //--------------------------------------------------------------------------
    
    public function get_inventory()
    {
        $sql = "Select * from inventory order by ref_no desc";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_searchinventory($search)
    {
        $sql = "Select * from inventory where ref_no like '$search%' or date like '$search%' or s_no like '$search%'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_i_no($ref_no, $filestat, $u_no) 
    {
        $sql = "Insert into inventory(ref_no, filestat, user) value('$ref_no','$filestat', '$u_no')";
        return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
    public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from inventory";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_maxi_no()
    {
        $sql = "Select max(i_no) as i_no from inventory";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function suminv($ino)
    {
        $sql = "Select sum(totalamount) as ta, sum(pcs) as qty from inventoryline where i_no = '$ino'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_inventoryinfo($ino)
    {
        $sql = "Select * from inventory where i_no = '$ino' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_inventoryline($ino)
    {
        $sql = "Select l.*, p.longdesc  as longdesc from inventoryline l, product p where l.p_no = p.p_no and l.i_no = '$ino' ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_allinventoryline($ino)
    { 
        $qty = '0';
        $ta = '0';
        $pcs = '0';
        $sql = "Insert into inventoryline(qty, p_no, i_no, unitprice, uom, packing, unitcost, totalamount, pcs) "
                . "select '$qty', p_no, '$ino', unitprice, uom, packing, unitcost, '$ta', '$pcs' from product where status = 'ACTIVE'";
        return $this->db->query($sql);
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_inventoryline($ino, $sno)
    {
        $qty = '0';
        $ta = '0';
        $pcs = '0';
        $sql = "Insert into inventoryline(qty, p_no, i_no, unitprice, uom, packing, unitcost, totalamount, pcs) "
                . "select '$qty', p_no, '$ino', unitprice, uom, packing, unitcost, '$ta', '$pcs' from product where s_no = '$sno' and status = 'ACTIVE'";
        return $this->db->query($sql);
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_allinventorylinebycat($ino, $cno)
    { 
        $qty = '0';
        $ta = '0';
        $pcs = '0';
        $sql = "Insert into inventoryline(qty, p_no, i_no, unitprice, uom, packing, unitcost, totalamount, pcs) "
                . "select '$qty', p_no, '$ino', unitprice, uom, packing, unitcost, '$ta', '$pcs' from product where status = 'ACTIVE' and c_no = '$cno'";
        return $this->db->query($sql);
        
    }
    
    //--------------------------------------------------------------------------
    
    public function insert_inventorylinebycat($ino, $sno, $cno)
    {
        $qty = '0';
        $ta = '0';
        $pcs = '0';
        $sql = "Insert into inventoryline(qty, p_no, i_no, unitprice, uom, packing, unitcost, totalamount, pcs) "
                . "select '$qty', p_no, '$ino', unitprice, uom, packing, unitcost, '$ta', '$pcs' from product where s_no = '$sno' and status = 'ACTIVE' and c_no = '$cno'";
        return $this->db->query($sql);
        
    }
    
    //--------------------------------------------------------------------------
    
     public function update_snoinventory($ino, $sno)
    {                                    
        $this->s_no = $sno;         
        $this->db->update('inventory', $this, array('i_no' => $ino));
    }

    //--------------------------------------------------------------------------
    
     public function update_invl()
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
        $this->db->update('inventoryline', $this, array('il_no' => $this->input->post('il_no')));
    }
    //----------------------------------------------------------------------
    
    public function open_inv($ino) 
    {                                    
        $this->filestat = 'OPEN';         
        $this->db->update('inventory', $this, array('i_no' => $ino));
    }

    //----------------------------------------------------------------------
    
    public function updatesaveinv($user, $qty, $ta) 
    {                                    
        $this->filestat = 'CLOSE';  
        $this->user = $user;
        $value = $this->input->post('date'); $this->date = date_format(date_create($value), 'Y-m-d');
        $this->remarks = $this->input->post('remarks');
        $this->totalamount = $ta;
        $this->totalqty = $qty;
        $this->db->update('inventory', $this, array('i_no' => $this->input->post('i_no')));
    }

    //----------------------------------------------------------------------
    
    public function close_inv($ino) 
    {                                    
        $this->filestat = 'CLOSE';         
        $this->db->update('inventory', $this, array('i_no' => $ino));
    }

    //----------------------------------------------------------------------
    
    public function post_inv($ino, $u_no) 
    {                                    
        $this->user = $u_no;     
        $this->posted = 'POSTED';
        $this->db->update('inventory', $this, array('i_no' => $ino));
        $this->updateprodhist($ino, $u_no);
        $this->updateproductqty($ino);        
    }

    //----------------------------------------------------------------------
    
    public function updateprodhist($ino, $u_no)
    {
        $desc = 'INVENTORY';
        $sql = "Insert into producthistory(date, description, u_no, ref_no, p_no, rqty, instock) "
                . "select i.date, '$desc', '$u_no', i.ref_no, l.p_no, l.pcs, l.pcs  "
                . "from inventoryline l, inventory i "
                . "where i.i_no = l.i_no "
                . "and i.i_no = '$ino' ";
       return $this->db->query($sql); 
    }
    
     //----------------------------------------------------------------------
    
    public function updateproductqty($ino)
    {         
        $sql = "update product "
                    . "set product.qty = (select inventoryline.pcs "
                                            . "from inventoryline "
                                            . "where inventoryline.p_no = product.p_no "
                                            . "and inventoryline.i_no = '$ino') "
                    . "where product.p_no IN (select inventoryline.p_no "
                                            . "from inventoryline "
                                            . "where inventoryline.p_no = product.p_no "
                                            . "and inventoryline.i_no = '$ino')";
        return $this->db->query($sql);
        
    }
    
    //--------------------------------------------------------------------------
    
    public function del_inv($ino) 
    {                       
        $this->db->delete('inventoryline', array('i_no' => $ino));
         $this->db->delete('inventory', array('i_no' => $ino));
    }

    //----------------------------------------------------------------------
        
}