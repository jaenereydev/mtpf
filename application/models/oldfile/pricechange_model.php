<?php

class Pricechange_model extends CI_Model
{   
    
    public function get_user($pc_no)
    {
        $sql = "Select fname from user where u_no = (select user from pricechange where pc_no = '$pc_no')";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_pricechange()
    {
        $sql = "Select * from pricechange order by pc_no DESC";
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_searchpricechange($s)
    {
        $sql = "Select * from pricechange where ref_no like '$s%' or date like '$s%' or effectivedate like '$s%'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }      
            
    //--------------------------------------------------------------------------
    
    public function insert_pc_no($ref_no, $filestat, $u_no) 
    {
        $sql = "Insert into pricechange(ref_no, filestat, user) value('$ref_no','$filestat', '$u_no')";
            return $this->db->query($sql);  
    }
    
    //--------------------------------------------------------------------------
    
    public function get_maxpc_no()
    {
        $sql = "Select max(pc_no) as pc_no from pricechange";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function get_maxref_no()
    {
        $sql = "Select max(ref_no) as ref_no from pricechange";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_pricechangeinfo($p)
    {
        $sql = "Select * from pricechange where pc_no = '$p'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
     public function get_product($pcno)
    {
        $sql = "Select * from product where status = 'ACTIVE' and p_no NOT IN (select p_no from pricechangeline where pc_no = '$pcno')";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function get_pricechangelineinfo($p)
    {
        $sql = "Select l.*, p.longdesc as longdesc from pricechangeline l, product p where p.p_no = l.p_no and l.pc_no = '$p'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function update_pc() 
    {                       
        $value1 = $this->input->post('date'); $this->date = date_format(date_create($value1), 'Y-m-d'); 
        $value2 = $this->input->post('edate'); $this->effectivedate = date_format(date_create($value2), 'Y-m-d'); 
        $this->requestedby = $this->input->post('req');
                                  
        $this->db->update('pricechange', $this, array('pc_no' => $this->input->post('pc_no') ));
    }

    //----------------------------------------------------------------------
    
    public function updatesavepc() 
    {                       
        $value1 = $this->input->post('date'); $this->date = date_format(date_create($value1), 'Y-m-d'); 
        $value2 = $this->input->post('edate'); $this->effectivedate = date_format(date_create($value2), 'Y-m-d');
        $this->requestedby = $this->input->post('req');
        $this->filestat = "CLOSE";
        $this->db->update('pricechange', $this, array('pc_no' => $this->input->post('pc_no') ));
    }

    //----------------------------------------------------------------------
    
    public function insert_pricechangeline($pc = null)            
    {                       
        $this->db->insert('pricechangeline',$pc);
        return $this->db->insert_id();
    }

    //----------------------------------------------------------------------
    
    public function close_pc($pc_no) 
    {                       
        $this->filestat = "CLOSE";     
        $this->db->update('pricechange', $this, array('pc_no' => $pc_no ));
    }

    //----------------------------------------------------------------------
    
    public function open_pc($pc_no) 
    {                       
        $this->filestat = "OPEN";     
        $this->db->update('pricechange', $this, array('pc_no' => $pc_no ));
    }

    //----------------------------------------------------------------------
    
    public function post_pc($pc_no) 
    {                       
        $this->update_pcproduct($pc_no);
        $this->stat = "POSTED";     
        $this->db->update('pricechange', $this, array('pc_no' => $pc_no ));
    }

    //----------------------------------------------------------------------
    
    public function update_pcproduct($pc_no) 
    {                       
        $sql = "update product "
                . "set product.unitprice = (select newunitprice from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.uom = (select newuom from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.packing = (select newpacking from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.unitcost = (select newunitcost from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price1 = (select newprice1 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price2 = (select newprice2 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price3 = (select newprice3 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price4 = (select newprice4 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price5 = (select newprice5 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price6 = (select newprice6 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price7 = (select newprice7 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price8 = (select newprice8 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price9 = (select newprice9 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price10 = (select newprice10 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no'), "
                . "product.price11 = (select newprice11 from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no') "
                . "where product.p_no IN (select pricechangeline.p_no from pricechangeline where pricechangeline.p_no = product.p_no and pricechangeline.pc_no = '$pc_no')";
       return $this->db->query($sql); 
    }

    //----------------------------------------------------------------------
    
    public function del_pcl($pcl_no) 
    {                       
        $this->db->delete('pricechangeline', array('pcl_no' => $pcl_no));
    }

    //----------------------------------------------------------------------
    
    public function del_pc($pc_no) 
    {                       
        $this->db->delete('pricechangeline', array('pc_no' => $pc_no));
        $this->db->delete('pricechange', array('pc_no' => $pc_no));        
    }

    //----------------------------------------------------------------------
    
    public function update_pricechangeline($u_no) 
    {                    
        $pack = $this->input->post('packingnew');
        $up = $this->input->post('unitpricenew');
        $this->user = $u_no;
        $this->newuom = $this->input->post('uomnew');
        $this->newpacking = $this->input->post('packingnew');
        $this->newunitprice = $this->input->post('unitpricenew');
        $this->newunitcost = ($up/$pack);
        $this->newprice1 = $this->input->post('p1new');
        $this->newprice2 = $this->input->post('p2new');
        $this->newprice3 = $this->input->post('p3new');
        $this->newprice4 = $this->input->post('p4new');
        $this->newprice5 = $this->input->post('p5new');
        $this->newprice6 = $this->input->post('p6new');
        $this->newprice7 = $this->input->post('p7new');
        $this->newprice8 = $this->input->post('p8new');
        $this->newprice9 = $this->input->post('p9new');
        $this->newprice10 = $this->input->post('p10new');
        $this->newprice11 = $this->input->post('p11new');
        
        $this->db->update('pricechangeline', $this, array('pcl_no' => $this->input->post('pcl_no') ));
    }

    //----------------------------------------------------------------------
    
}