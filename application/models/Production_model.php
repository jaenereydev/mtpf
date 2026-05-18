<?php

class Production_model extends CI_Model
{

 //----------------------------------------------------------------------

    public function get_productionlist() 
    {

        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');

        $sql = "SELECT p.*, u.name AS name, b.name AS buildingname 
                FROM production p
                JOIN building b ON b.b_no = p.b_no 
                JOIN user u ON u.id = p.user_id
                WHERE p.date BETWEEN ? AND ?
                ORDER BY p.date DESC";

        $query = $this->db->query($sql, array($first_day, $last_day));

        return $query->result();
    }

  //----------------------------------------------------------------------

    public function buildingcount()
    {
        return $this->db
            ->where('status', 'ACTIVE')
            ->count_all_results('building');
    }

    //----------------------------------------------------------------------


    public function get_building()
    {
        return $this->db
        ->where('status', 'ACTIVE')
        ->order_by('name', 'ASC')
        ->get('building')
        ->result();
    }

    //----------------------------------------------------------------------

    public function insertbuilding($b = null) 
    {  
        $this->db->insert('building',$b);
    }

  //--------------------------------------------------------------------------  

    public function insertproduction($p = null) 
    {  
        $this->db->insert('production',$p);
    }

  //--------------------------------------------------------------------------  

    public function update_building_name($b_no, $name)
    {
        $this->db->where('b_no', $b_no);
        $this->db->where('status', 'ACTIVE');

        return $this->db->update('building', [
            'name' => $name
        ]);
    }

    //--------------------------------------------------------------------------  

    public function deletebuilding($b, $u)
    {
        $this->db->where('b_no', $b);
        $this->db->where('status', 'ACTIVE');

        return $this->db->update('building', [
            'status'     => 'DEACTIVATE',
            'user_id' => $u,
        ]);
    }

    //-------------------------------------------------------------------------- 

    public function updateproduction_inline($production_number, $data)
    {
        $this->db->where('production_number', $production_number);
        return $this->db->update('production', $data);
    }

    //-------------------------------------------------------------------------- 

    public function production_today()
    {
        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('production');
        $this->db->where('date', date('Y-m-d'));

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //-------------------------------------------------------------------------- 

    public function production_week()
    {
        $monday = date('Y-m-d', strtotime('monday this week'));
        $sunday = date('Y-m-d', strtotime('sunday this week'));

        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('production');
        $this->db->where('date >=', $monday);
        $this->db->where('date <=', $sunday);

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //-------------------------------------------------------------------------- 

    public function production_month()
    {
        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');

        $this->db->select_sum('qty', 'total_qty');
        $this->db->from('production');
        $this->db->where('date >=', $first_day);
        $this->db->where('date <=', $last_day);

        $query = $this->db->get();
        $row = $query->row();

        return $row->total_qty ? $row->total_qty : 0;
    }

    //-------------------------------------------------------------------------- 

    public function deleteproduction($production_number)
    {
        $this->db->where('production_number', $production_number);

        return $this->db->delete('production');
    }

    //-------------------------------------------------------------------------- 

    //-------------------------------------------------------------------------- 
}
