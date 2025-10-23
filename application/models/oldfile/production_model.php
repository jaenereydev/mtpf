<?php

class Production_model extends CI_Model
{ 
  // public function getList()

  public function checkIfExist($id)
  {
    $sql = "SELECT pr_no
            FROM production
            WHERE b_no = ?
            AND date = CURDATE()
            ORDER BY pr_no ASC";
    $result = $this->db->query($sql, [$id])->result();

    return ($result ? $result : false);
  }

  public function report_graph($date, $type)
  {
    $sql = "SELECT
              SUM(totalqty) as total,
              building_no
            FROM production p
            JOIN building b
            ON b.b_no = p.b_no
            WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "' ";
            if($type)
              $sql .= " AND type = '" . $type . "'";
            $sql .= " GROUP BY b.b_no";
    return $this->db->query($sql)->result();
  }

  public function postProduction($data)
  {
    $this->load->model('building_model');
    $this->load->model('poultryproduct_model');

    $ref_no = $this->getRefNo();

    $inserted = [
      'date' => date('Y-m-d'),
      'ref_no' => (double)$ref_no + 1,
      'b_no' => $data['id'],
      'age' => (isset($data['age']) ? $data['age'] : null ),
      'totalqty' => $data['qty'],
      'time' => date("H:i:s", strtotime($data['time'])),
      'receivedby' => $data['receive'],
      'u_no' => $this->session->userdata('u_no'),
      'pp_no' => $data['poultry']
    ];

    $result = $this->db->insert('production', $inserted);
    $pp_no = $this->poultryproduct_model->get_poultryactive($data['poultry']);

    if(strtolower($pp_no[0]->name) == 'chicken')
      $this->building_model->post_buildingHistory($data);

    $this->poultryproduct_model->update_qty($data);
		return $result;
  }

  public function get_list($date = false)
  {
    $sql = "SELECT 
              DATE_FORMAT(date, '%b. %d, %Y') as date, 
              TIME_FORMAT(time, '%l:%i %p') as time, 
              receivedby, totalqty, pr_no, buildingname, building_no, posted, pp.name
            FROM production p
            JOIN building b
            ON p.b_no = b.b_no
            JOIN poultryproduct pp
            ON pp.pp_no = p.pp_no ";
      if($date)
        $sql .= " WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'";
    return $this->db->query($sql)->result();
  }

  public function update_postStatus($id)
  {
    $this->db->trans_start();
    $this->db->where('pr_no', $id);
    $this->db->update('production', ['posted' => 'POSTED']);
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) 
      return 0;
    return 1;
  }

  public function update_prod($data, $id)
  {
    $update = [
      'totalqty' => $data['qty'],
      'time' => date("H:i:s", strtotime($data['time'])),
      'receivedby' => $data['receive']
    ];

    $this->db->trans_start();
    $this->db->where('pr_no', $id);
    $this->db->update('production', $update);
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) 
      return 0;
    return 1;
  }

  public function delete_product($id)
  {
    $this->db->delete('production', array('pr_no' => $id));
    return $this->db->affected_rows(); 
  }
  
  public function getRefNo()
  {
  	$sql = "SELECT ref_no FROM production ORDER BY pr_no DESC LIMIT 1";

  	$result = $this->db->query($sql)->result();
  	return ($result ? $result[0]->ref_no : 0);
  }

  // public function getEggChickenId()
  // {
  //   $sql = "SELECT c_no, description
  //           FROM category 
  //           WHERE LOWER(description) IN ('egg', 'chicken')
  //           AND status = 'ACTIVE'";
            
  //   return $this->db->query($sql)->result();
  // }
}
?>