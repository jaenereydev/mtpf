<?php

class Consumption_model extends CI_Model
{ 

	public function getList($date = false)
	{
		$sql = "SELECT DATE_FORMAT(date, '%b. %d, %Y') as date,
								 FORMAT(totalamount, 2) as totalamount, 
								 c_no, posted, totalqty
						FROM consumption";
					if($date)
						$sql .= " WHERE date '" . $date['from'] . "' AND '" . $date['to'] . "'";
		return $this->db->query($sql)->result();
	}

	public function getConsumpByBldg($date, $type = false)
	{
		$sql = "SELECT b.b_no, SUM(totalamount) as totalamount, SUM(totalqty) as totalqty, building_no
						FROM consumption c
						JOIN building b
						ON b.b_no = c.b_no
						WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "' ";
						if($type)
							$sql .= " AND type = '" . $type . "' ";
						$sql .= " GROUP BY b.b_no";

		return $this->db->query($sql)->result();
	}

	public function get_consumpById($id)
	{
		$sql = "SELECT cl.totalamount, cl.qty, longdesc, p.p_no, cl.cl_no, b_no
						FROM consumption c
						JOIN consumptionline cl
						ON c.c_no = cl.c_no
						JOIN product p
						ON p.p_no = cl.p_no
						WHERE cl.c_no = ?";
		return $this->db->query($sql, [$id])->result();
	}

	public function update_post($id)
	{
		$this->db->trans_start();
		$this->db->where('c_no', $id);
		$this->db->update('consumption', ['posted' => 'POSTED']);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
      return 0;
    return 1;
	}

	public function delete_consump($id){
		$this->db->delete('consumptionline', ['c_no' => $id]);
		$this->db->delete('consumption', ['c_no' => $id]);
		return $this->db->affected_rows(); 
	}

	public function update_editConsump($id)
	{
	
		if($this->session->userdata('update_edit')){
			$update_edit = $this->session->userdata('update_edit');

			$this->updateConsumptionLine($update_edit, $id);
		}

		if($this->session->userdata('update_add')){
			$this->addConsumpLine($id);

		}

		if($this->session->userdata('update_delete')){
			$this->deleteConsumpLine($id);
		}

		$sql = "SELECT SUM(totalamount) as totalamount, SUM(qty) as totalqty FROM consumptionline WHERE c_no = ?";
		$sum = $this->db->query($sql, [$id])->result();

		$this->db->where('c_no', $id);
		$this->db->update('consumption', [
				'totalamount' => $sum[0]->totalamount,
				'totalqty' => $sum[0]->totalqty
			]);

		return $this->db->affected_rows(); 
	}
	
	public function deleteConsumpLine()
	{
		$update_delete = $this->session->userdata('update_delete');
		$keys = array_keys($update_delete);

		$this->db->where_in('cl_no', $keys);
		$this->db->delete('consumptionline');
	}

	public function addConsumpLine($id)
	{
		$this->load->model('product_model');

		$update_add = $this->session->userdata('update_add');
		$keys = array_column($update_add, 'p_no');
		$result = $this->product_model->get_byBatch($keys);
		$p_no = array_column($result, 'p_no');
		$pushed = [];

		foreach ($update_add as $key => $value) {
			if($value['deleted'] != true){
				$index = array_search($value['p_no'], $p_no);
				array_push($pushed, [
						'qty' => $value['qty'],
						'unitprice' => $result[$index]['unitprice'],
						'uom' => $result[$index]['uom'],
						'unitcost' => $result[$index]['unitcost'],
						'packing' => $result[$index]['packing'],
						'totalamount' => $value['qty'] * $result[$index]['unitprice'],
						'p_no' => $value['p_no'],
						'c_no' => $id
					]);
			}
		}

		if(sizeof($pushed) != 0)
			$this->db->insert_batch('consumptionline', $pushed);
	}

	public function updateConsumptionLine($data, $id)
	{
		$this->load->model('product_model');

		$keys = array_keys($data);
		$result = $this->product_model->get_byBatch($keys);
		$p_no = array_column($result, 'p_no');
		$pushed = [];

		foreach ($data as $key => $value) {
			$index = array_search($value['p_no'], $p_no);

			array_push($pushed, [
					'qty' => $value['qty'],
					'unitprice' => $result[$index]['unitprice'],
					'uom' => $result[$index]['uom'],
					'unitcost' => $result[$index]['unitcost'],
					'packing' => $result[$index]['packing'],
					'totalamount' => $value['qty'] * $result[$index]['unitprice'],
					'p_no' => $key,
					'c_no' => $id,
					'cl_no' => $key
				]);
		}

		$this->db->update_batch('consumptionline', $pushed, 'cl_no');
	}

	public function post_consumption($data, $id)
	{
		$inserted = [
				'date' => date('Y-m-d'),
				'u_no' => $this->session->userdata('u_no'),
				'b_no' => $id
			];

		$this->db->insert('consumption', $inserted);
		$c_no = $this->db->insert_id();

		$result = $this->post_consumpLine($data, $c_no);

		$this->db->where('c_no', $c_no);
		$this->db->update('consumption', [
				'totalamount' => $result[0],
				'totalqty' => $result[1]
			]);

		return $this->db->affected_rows(); 
	}

	public function post_consumpLine($data, $c_no)
	{
		$this->load->model('product_model');

		$key = array_keys($data);
		$result = $this->product_model->get_byBatch($key);
		$p_no = array_column($result, 'p_no');
		$pushed = [];
		$sum = [0, 0];

		foreach ($data as $key => $value) {
			$index = array_search($key, $p_no);
			$sum[0] += $result[$index]['unitcost'] * $value;
			$sum[1] += $value;

			array_push($pushed, [
					'qty' => $value,
					'unitprice' => $result[$index]['unitprice'],
					'uom' => $result[$index]['uom'],
					'unitcost' => $result[$index]['unitcost'],
					'packing' => $result[$index]['packing'],
					'totalamount' => $result[$index]['unitcost'] * $value,
					// 'b_no' => $b_no,
					'p_no'=> $key,
					'c_no' => $c_no
				]);
		}

		$this->db->insert_batch('consumptionline', $pushed);

		return $sum;
	}

}

?>