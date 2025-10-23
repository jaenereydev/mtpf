<?php

class Classifying_model extends CI_Model
{ 
	public function getListReport($date)
	{
		$sql = "SELECT DATE_FORMAT(date, '%b. %d, %Y') as date,
							cl.qty, cl.unitprice, cl.totalamount, longdesc
					FROM classifyline cl
					JOIN product p
	 				ON cl.p_no = p.p_no
					JOIN classify c
					ON c.cfy_no = cl.cfy_no
					WHERE date BETWEEN ? AND ?";
		return $this->db->query($sql, $date)->result();

	}

	public function reportClassifyGraph($date, $c_no, $byArray = false)
	{
		$sql = "SELECT SUM(cl.qty) as qty, p.p_no, longdesc, date
						FROM classify c
						JOIN classifyline cl
						ON c.cfy_no = cl.cfy_no
						JOIN product p 
						ON p.p_no = cl.p_no
						WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "' ";
						if($c_no)
							$sql .= "AND p.c_no = '" . $c_no . "'";
						$sql .= " GROUP BY p.p_no, totalqty
						ORDER BY longdesc";

		$query = $this->db->query($sql);
		return ($byArray ? $query->result_array() : $query->result());
	}

  public function report_classifyline($date)
  {
    $sql = "SELECT SUM(cl.qty) as qty, p.p_no, DATE_FORMAT(date, '%b. %d, %Y') as date, longdesc
						FROM product p
						JOIN classifyline cl
						ON cl.p_no = p.p_no
						JOIN classify c
						ON cl.cfy_no = c.cfy_no
						WHERE date BETWEEN ? AND ?
						GROUP BY p.p_no
						ORDER BY qty desc";

    return $this->db->query($sql, $date)->result();
  }

	public function get_list()
	{
		$sql = "SELECT 
						DATE_FORMAT(date, '%b. %d, %Y') as date, 
						CONCAT('P ', FORMAT(totalamount, 2)) as totalamount,
						posted, totalqty, cfy_no
					FROM classify ";
		return $this->db->query($sql)->result();
	}

	public function update_post($id)
	{
    $this->db->trans_start();
		$this->db->where('cfy_no', $id);
		$this->db->update('classify', [
				'posted' => 'POSTED'
			]);
		$this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
      return 0;
    return 1;
	}

	// Update the classifyingline table
	public function updateClassifying($data, $id)
	{
		$this->load->model('product_model');
		$this->load->model('producthistory_model');

		$session = $this->session->userdata('update_edit');
		$ref_no = $this->getClassifyRefNo($id);
		$total = 0;

		if($session){
			$p_no = array_column($session, 'p_no');
			$result = $this->product_model->get_byBatch($p_no);
			$product = $ph = $pushed = [];

			foreach ($session as $key => $value) {
				$index = array_search($value['p_no'], $p_no);
				$cl = $this->getClassifyLine($key);
				$productHistory = $this->producthistory_model->getProductHistory(['CLASSIFY', $ref_no, $cl[0]->p_no]);

				array_push($pushed, [
					'p_no' => $value['p_no'],
					'unitprice' => $result[$index]['unitprice'],
					'totalamount' => $result[$index]['unitprice'] * $value['qty'],
					'qty' => $value['qty'],	
					'cl_no' => $key
				]);

				array_push($ph, [
						'ph_no' => $productHistory[0]->ph_no,
						'date' => date('Y-m-d'),
						'u_no'=> $this->session->userdata('u_no'),
						'instock' => $value['qty'],
						'rqty' => ($result[$index]['qty'] - $cl[0]->qty) + $value['qty']
					]);

				if($value['p_no'] != $cl[0]->p_no) {
					$product[] = [ 
							'qty' => $result[$index]->qty - $cl[0]->qty,
							'p_no' => $cl[0]->p_no
						];
				}

				array_push($product, [
						'qty' => ($result[$index]['qty'] - $cl[0]->qty) + $value['qty'],
						'p_no' => $value['p_no']
					]);
				$total += ($value['qty'] - $cl[0]->qty);
			}

			$this->db->update_batch('classifyline', $pushed, 'cl_no');
			$this->db->update_batch('producthistory', $ph, 'ph_no');
			$this->db->update_batch('product', $product, 'p_no');
		}

		if($this->session->userdata('update_delete'))
			$this->deleteClassLine($id, $ref_no, $data['poultry']);

		if($this->session->userdata('update_add')){
			$total += $this->addClassLine($id, $ref_no);
		}

		$this->updatePoultryProduct([$total, $data['poultry']]);
		$this->updateClassify($data, $id);
	}

	// Update the classify table 
	public function updateClassify($data, $id)
	{
		$sql = "SELECT CASE
							WHEN SUM(totalamount) IS NULL THEN 0
							ELSE SUM(totalamount)
						END as totalamount,
						CASE
							WHEN SUM(qty) IS NULL THEN 0
							ELSE SUM(qty) 
					 	END as qty 
					FROM classifyline
					WHERE cfy_no = ?";
		$result = $this->db->query($sql, [$id])->result();

		$update = [
			'totalamount' => $result[0]->totalamount,
			'totalqty' => $result[0]->qty,
			'c_no' => $data['category'],
			'pp_no' => $data['poultry']
		];

		$this->db->where('cfy_no', $id);
		$this->db->update('classify', $update);

		return $result;
	}

	public function delete_post($id)
	{
		$result = $this->db->query("SELECT * FROM classify c JOIN classifyline cl ON c.cfy_no = cl.cfy_no WHERE cl.cfy_no = ?", [$id])->result();
		$total = 0;

		foreach ($result as $key => $value) {
			$total += $value->qty;
			$this->db->query("UPDATE product SET qty = qty - ? WHERE p_no = ?", [$value->qty, $value->p_no]);
		}

		$this->updatePoultryProduct(['qty' => $total, 'poultry' => $result[0]->pp_no], true);

    $this->db->trans_start();
    $this->db->delete('classifyline', array('cfy_no' => $id));
    $this->db->delete('classify', array('cfy_no' => $id));
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
      return 0;
    return 1;
	}

	public function postClassifying($input)
	{
		$html = $this->session->userdata('html');
		$ref_no = $this->getRefNo() + 1;

		$inserted = [
			'date' => date('Y-m-d'),
			'ref_no' => $ref_no,
			'totalqty' => array_sum(array_column($html, 'qty')),
			'totalamount' => array_sum(array_column($html, 'unitprice')),
			'remarks' => ($input['remarks'] ? $input['remarks'] : null),
			'u_no' => $this->session->userdata('u_no'),
			'pp_no' => $input['poultry'],
			'c_no' => $input['category']
		];

		$result = $this->db->insert('classify', $inserted);
		$id = $this->db->insert_id();

		$amount = $this->postClassLine($id, $ref_no);

		$this->db->where('cfy_no', $id);
		$this->db->update('classify', ['totalamount' => $amount[0]]);

		$this->updatePoultryProduct([$amount[1], $input['poultry']]);
		
		return ($result ? $result : 0);
	}

	private function addClassLine($id, $ref_no)
	{
		$pp = $p = $ph = $cl = [];
		$this->load->model('product_model');
		// $ref_no = $this->getClassifyRefNo($id);
		$total = 0;

		foreach ($this->session->userdata('update_add') as $key => $value) {
			if(!$value['deleted']) {
				$info = $this->product_model->get_byBatch([$value['id']]);

				array_push($cl, [
						'qty' => $value['qty'],
						'unitprice' => $info[0]['unitprice'],
						'totalamount' => $info[0]['unitprice'] * $value['qty'],
						'cfy_no' => $id,
						'p_no' => $value['id']
					]);

				array_push($ph, [
						'date' => date('Y-m-d'),
						'description' => 'CLASSIFY',
						'u_no' => $this->session->userdata('u_no'),
						'ref_no' => $ref_no,
						'instock' => $value['qty'],
						'p_no' => $value['id'],
						'rqty' => $info[0]['qty'] + $value['qty']
					]);

				$p[] = [
					'qty' => $info[0]->qty + $value['qty'],
					'p_no' => $value['id']
				];

				$total += $value['qty'];
			}
		}
		
		if (sizeof($cl)) {
			$this->db->update_batch('product', $p, 'p_no');
			$this->db->insert_batch('classifyline', $cl);
			$this->db->insert_batch('producthistory', $ph);
		}
		return $total;
	}

	private function deleteClassLine($id, $ref_no, $pp_no)
	{
		$this->load->model('producthistory_model');
		$pushed = [];
		$ph = [];
		$total = 0;

		foreach ($this->session->userdata('update_delete') as $key => $value) {
			$productHistory = $this->producthistory_model->getProductHistory(['CLASSIFY', $ref_no, $value]);
			array_push($ph, $productHistory[0]->ph_no);
			array_push($pushed, $key);
			$total += $productHistory[0]->instock;
			$this->db->query("UPDATE product SET qty = qty - ? WHERE p_no = ?", [$productHistory[0]->instock, $productHistory[0]->p_no]);
		}

		$this->updatePoultryProduct(['qty' => $total, 'poultry' => $pp_no], true);

		$this->db->where_in('cl_no', $pushed);
		$this->db->delete('classifyline');

		$this->db->where_in('ph_no', $ph);
		$this->db->delete('producthistory');
	}

	private function postClassLine($id, $ref_no)
	{
		$this->load->model('product_model');

		$list = $this->session->userdata('html');

		$UpdateProduct = $productHistory = $product = [];
		$pp = $totalamount = 0;

		foreach ($list as $key => $value) {
			$total = $value['qty'] * $value['unitprice'];
			$pp += $value['qty'];

			array_push($product, [
					'qty' => $value['qty'],
					'totalamount' => $total,
					'unitprice' => $value['unitprice'],
					'cfy_no' => $id,
					'p_no' => $key
				]);
			$totalamount += $total;

			$rqty = $this->getProductInfo($key);

			array_push($UpdateProduct, [
					'p_no' => $key,
					'qty' => $value['qty'] + $rqty[0]->qty
				]);

			array_push($productHistory, [
				'date' => date('Y-m-d'),
				'description' => 'CLASSIFY',
				'u_no' => $this->session->userdata('u_no'),
				'instock' => $value['qty'],
				'rqty' => $rqty[0]->qty + $value['qty'],
				'p_no' => $key,
				'ref_no' => $ref_no
				]);
		}

		$this->db->insert_batch('classifyline', $product);
		$this->db->insert_batch('producthistory', $productHistory);
		$this->db->update_batch('product', $UpdateProduct, 'p_no');

		return [$totalamount, $pp];
	}


	public function getRefNo()
  {
  	$sql = "SELECT ref_no FROM classify ORDER BY cfy_no DESC LIMIT 1";

  	$result = $this->db->query($sql)->result();
  	return ($result ? $result[0]->ref_no : 0);
  }

  public function getClassifyById($id)
  {
  	$sql = "SELECT CONCAT('P ', FORMAT(cl.totalamount, 2)) as totalamount, 
  						totalqty, cl.qty, c.cfy_no, p.p_no, c.pp_no, c.c_no, cl.cl_no, p.unitprice, longdesc, cp.name, ca.description
						FROM classify c
						LEFT JOIN classifyline cl
						ON c.cfy_no = cl.cfy_no
						LEFT JOIN product p
						ON p.p_no = cl.p_no
						JOIN category ca
						ON ca.c_no = c.c_no
						JOIN poultryproduct cp
						ON cp.pp_no = c.pp_no
						WHERE c.cfy_no = ?";

		return $this->db->query($sql, [$id])->result();
  }

	private function getProductInfo($p_no)
	{
		$sql = "SELECT * FROM product WHERE p_no = ?";
		return $this->db->query($sql, [$p_no])->result();
	}

	private function getClassifyRefNo($id, $bool = false)
	{
		if($bool){
			$sql = "SELECT ref_no
						FROM classifyline cl
						JOIN classify c
						ON cl.cfy_no = c.cfy_no
						WHERE cl_no = " . $id;
		} else {
			$sql = "SELECT ref_no FROM classify WHERE cfy_no = " . $id;
		}

		return $this->db->query($sql)->result()[0]->ref_no;
	}

	private function getClassifyLine($cl_no){
		return $this->db->query("SELECT * FROM classifyline WHERE cl_no = ?", [$cl_no])->result();
	}

	private function updatePoultryProduct($data, $plus = false)
	{
		$this->load->model('poultryproduct_model');
		if($plus)
			$this->poultryproduct_model->update_qty($data);
		else
			$this->poultryproduct_model->minusQty($data);
	}
}
?>