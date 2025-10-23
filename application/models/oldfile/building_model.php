<?php

class Building_model extends CI_Model
{   
    //--------------------------------------------------------------------------
    
    public function get_buildinginfo($id)
    {
        $sql = "Select * from building where b_no =? and status = 'ACTIVE' ";
        $query = $this->db->query($sql, array($id));
        return $query->result();
    }
    
    //--------------------------------------------------------------------------
    
    public function count_building()
    {
        $sql = "Select count(b_no) as bno from building where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_buildingactive()
    {
        $sql = "Select * from building where status = 'ACTIVE' order by b_no";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------

    public function get_buildingByType($type, $byArray = false)
    {
      $sql = "SELECT * 
              FROM building 
              WHERE status = 'ACTIVE' ";
              if($type)
                $sql .= " AND type = '" . $type . "' order by b_no";
      $query = $this->db->query($sql);
      return ($byArray ? $query->result_array() : $query->result());
    }

    //--------------------------------------------------------------------------
    
     public function insert_building($b_no = NULL) 
    {
        $this->db->insert('building',$b_no);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function update_cat() 
    {        
        $this->description = $this->input->post('description');
        $this->u_no = $this->input->post('u_no');
        
        $this->db->update('category', $this, array('c_no' => $this->input->post('c_no') ));
    }

    //----------------------------------------------------------------------
    
    public function updatedel_cat($c_no, $u_no) 
    {                       
        $this->u_no = $u_no;        
        $this->status = 'DEACTIVATE';         
        $this->db->update('category', $this, array('c_no' => $c_no));
    }

    //----------------------------------------------------------------------

    public function getType()
    {
      $sql = "SELECT type FROM building GROUP BY type";
      return $this->db->query($sql)->result();
    }

    public function post_buildingHistory($data)
    {
      $building = $this->get_buildinginfo($data['id']);

      $inserted = [
        'date' => date('Y-m-d'),
        'description' => 'Production',
        'instock' => ($data['qty'] > 0 ? $data['qty']: null),
        'outstock' => ($data['qty'] < 0 ? $data['qty']: null),
        'u_no' => $this->session->userdata('u_no'),
        'b_no' => $data['id'],
        'rqty' => $building[0]->qty + $data['qty'],
        'age' => $building[0]->chickenage
      ];

      $this->db->insert('building_history', $inserted);
    }
}