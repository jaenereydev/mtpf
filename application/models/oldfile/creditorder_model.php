<?php
	class Creditorder_model extends CI_Model
	{
            
            public function deltrans($no)
            {
                $this->db->delete('creditorderline', array('co_no' => $no));
                $this->db->delete('creditorder', array('co_no' => $no));
            }
            
		public function creditToday($id)
		{
			$sql = "SELECT SUM(totalqty) as qty, SUM(totalamount) as total FROM creditorder WHERE date = CURDATE() AND user = ?";
			return $this->db->query($sql, [$id])->result();
		}

		// public function getSalesPerProductGraph($date, $category)
		// {
		// 	$sql = "SELECT col.p_no, col.qty, date, longdesc, p.c_no
		// 					FROM creditorder co
		// 					JOIN creditorderline col
		// 					ON co.co_no = col.co_no
		// 					JOIN product p
		// 					ON p.p_no = col.p_no
		// 					WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'";

		// 					if($category)
		// 						$sql .= " AND p.c_no = " . $category;
		// 					$sql .= " GROUP BY p.p_no";

		// 	return $this->db->query($sql, [$date['from'], $date['to'], $category])->result_array();
		// }

		public function getSalesGraph($date, $format, $index)
		{
			$sql = "SELECT SUM(totalamount) as totalamount,
									 SUM(totalqty) as totalqty,
									 $format[$index],
									 date, 'Credit' as type
							FROM creditorder
							WHERE date BETWEEN ? AND ?
							GROUP BY $index(date)
							ORDER BY date";

			return $this->db->query($sql, $date)->result_array();
		}

		public function getAllCredit($dates = false)
		{
			$sql = "SELECT co.c_no , totalamount, totalqty
							FROM creditorder co
							JOIN customer c
							ON co.c_no = c.c_no
							WHERE date BETWEEN '" . $dates['from'] . "' AND '" . $dates['to'] . "'";

			return $this->db->query($sql)->result_array();
		}

		public function getCheckList()
		{
			$sql = "SELECT checkno, checkdate, bankname, amount, description, date
							FROM creditpayment cp
							JOIN paymentref pr
							ON cp.cp_no = pr.cp_no
							WHERE checkno IS NOT NULL
							AND date = CURDATE()";
			return $this->db->query($sql)->result();
		}

		public function creditPaid($dates = false, $bool = false, $u_no = false)
		{
			if(!$bool){
				// $sql = "SELECT SUM(co.totalamount) as total
			 // 					FROM creditorder co
			 // 					JOIN creditpaymentline cpl
			 // 					ON co.co_no != cpl.co_no
			 // 					JOIN creditpayment cp
			 // 					ON cpl.cp_no = cp.cp_no
			 // 					WHERE co.date";

					$sql = "SELECT SUM(totalamount) as total
									FROM creditorder co
									JOIN creditpaymentline cpl
									ON cpl.co_no = co.co_no
									WHERE cpl.cp_no IN (
										SELECT cp_no
										FROM creditpayment 
										WHERE date ";
				if($u_no)
					$sql .= " = '" . $dates . "' AND u_no = " . $u_no . " )";
				else if($dates) 
					$sql .= " BETWEEN '" . $dates['from'] . "' AND '" . $dates['to'] . "' )";
				else
					$sql .= " = CURDATE() AND u_no = " . $this->session->userdata('u_no') . " )";

				$result = $this->db->query($sql)->result();
				return (isset($result[0]->total) ? $result[0]->total : 0);
			} else {
				$sql = "SELECT 
									CASE
										WHEN SUM(co.totalamount) IS NULL THEN 0
										ELSE SUM(co.totalamount)
									END as total, DATE_FORMAT(cp.date, '%b. %d, %Y') as date, u_no
								FROM creditorder co
								JOIN creditpaymentline cpl
								ON co.co_no != cpl.co_no
								JOIN creditpayment cp
								ON cpl.cp_no = cp.cp_no
								WHERE co.date BETWEEN ? AND ?
								GROUP by u_no";
				return $this->db->query($sql, [$dates['from'], $dates['to']])->result();
			}
		}

		public function getCredit($dates) 
		{
			$sql = "	SELECT SUM(totalamount) as total
			 					FROM creditorder
			 					WHERE co_no NOT IN (SELECT co_no FROM creditpaymentline)
							AND date ";
			if($dates) 
				$sql .= " BETWEEN '" . $dates['from'] . "' AND '" . $dates['to'] . "'";
			else
				$sql .= " = CURDATE()";

			$result = $this->db->query($sql)->result();
			return (isset($result[0]->total) ? $result[0]->total : 0);
		}

		public function post_credit($data, $input)
		{
                    $sum = $this->session->userdata('sum_details');

                    $this->db->select_max('ref_no');
                    $ref_no = $this->db->get('creditorder');
                    $ref_no = $input[1];
//                    $ref_no = ($ref_no->result()[0]->ref_no != null ? $ref_no->result()[0]->ref_no + 1 : 1);

                    $inserted = [ 
                                'date' => date('Y-m-d'), 
                                'totalamount' => $sum[2], 
                                'totalqty' => $sum[0], 
                                'remarks' => ($data['remarks'] != '' ? $data['remarks'] : null), 
                                'user' => $this->session->userdata('u_no'), 
                                'c_no' => $data['searchCustomer'], 
                                'discountamount' => (isset($sum['discount']) ? $sum['discount']['amount'] : null),
                                'additionalamount' => (isset($sum['additional_amount']) ? $sum['additional_amount'] : null),
                                'ref_no' => $ref_no,
                                'ci_no' => $input[1]
                    ];

                    $this->db->insert('creditorder', $inserted);
                    $id = $this->db->insert_id();

                    $this->post_creditOrderLine($id, $data['paymentType'], $ref_no);

                    $this->post_updateCustomer($data, $sum, $input);
		}

		public function credit_report($data = false)
		{
			$sql = "SELECT DATE_FORMAT(date, '%b. %d, %Y') as date, totalamount, totalqty, name, ci_no
							FROM creditorder co
							JOIN customer c
							ON co.c_no = c.c_no
							WHERE co_no NOT IN (
								SELECT co_no 
								FROM creditpaymentline
							)";
						if($data)
								$sql .= " AND co.date BETWEEN '" . $data['from'] . "' AND '" . $data['to'] . "'";

			$sum = "SELECT * 
							FROM
							(
								SELECT COUNT(co_no) as counter
								FROM creditorder 
								WHERE co_no NOT IN (
									SELECT co_no 
									FROM creditpaymentline
								)";
								if($data)
								 $sum .= " AND date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'";
			$sum .=") counter
							INNER JOIN
							(
								SELECT SUM(totalamount) as paid
								FROM creditorder c
								JOIN creditpaymentline cpl
								ON c.co_no = cpl.co_no";
								if($data)
									$sum .=	" WHERE c.date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'";
			$sum .=	") paid
							INNER JOIN
							(
								SELECT SUM(totalamount) as unpaid 
								FROM creditorder 
								WHERE co_no NOT IN (SELECT co_no FROM creditpaymentline)";
								if($data)
									$sum .=	" AND date BETWEEN '". $data['from'] ."' AND '". $data['to'] ."'";
			$sum .=	") unpaid";

			$sum = $this->db->query($sum)->result();
			$sql = $this->db->query($sql)->result_array();
			return [$sql, $sum];
		}

		public function getProductTransaction($id)
		{
			$sql = "SELECT col.qty, col.totalamount, pricestatus, longdesc, price as price1, price2, price3, price4, price5, price6, price7, price8, price9, price10, price11, discountamount,additionalamount, co.totalamount as total
							FROM creditorder co
							JOIN creditorderline col
							ON co.co_no = col.co_no
							JOIN product p
							ON col.p_no = p.p_no
							WHERE co.co_no = ?";

			return $this->db->query($sql, [$id])->result();
		}

		public function getTodayCheckPayment($date = false, $u_no = false)
		{
			$sql ="SELECT 
						 CASE
						   WHEN SUM(cpl.amount) IS NULL THEN 0
						   ELSE SUM(cpl.amount)
						 END as amount
						FROM creditpayment cp  
						JOIN creditpaymentline cpl
						ON cp.cp_no = cpl.cp_no
						WHERE date = ";
				if($date)
					$sql .= "'" . $date . "' AND u_no = " . $u_no;
				else
					$sql .= "CURDATE()";
				$sql .= " AND cp.cp_no NOT IN(SELECT cp_no FROM paymentref)";
			return $this->db->query($sql)->result()[0]->amount;
			// return (isset($result[0]->total) ? $result[0]->total : 0);
		}

		private function post_creditOrderLine($id, $type, $ref_no)
		{
			$this->load->model('order_model');
			
			$products = $this->session->userdata('saleProduct');
			$creditOrderLine = [];
			$productHistory = [];

			foreach ($products as $key => $value) {

				if(isset($value->adjustment) && $value->adjustment > 0){
					$this->order_model->adjustments([$value->adjustment, $value->qty, $value->p_no], $value->longdesc, $ref_no);
				}

				$price = 'price' . $value->counter;

				$col = 	[  
                                            'user' => $this->session->userdata('u_no'),
                                            'unitprice' => $value->unitcost, 
                                            'qty' => $value->quantity, 
                                            'price' => $value->$price, 
                                            'totalamount' => $value->total, 
                                            'co_no' => $id, 
                                            'p_no' => $value->p_no,
                                            'pricestatus' => $price
                                        ];

				$ph = [ 'date' => date('Y-m-d'), 
                                        'description' => strtoupper($type),
                                        'u_no' => $this->session->userdata('u_no'),
                                        'ref_no' => $ref_no,
                                        'outstock' => $value->quantity,
                                        'rqty' => $value->qty + (isset($value->adjustment) ? $value->adjustment : 0) - $value->quantity,
                                        'p_no' => $value->p_no ];

				$this->UpdateProductQuantity($value->p_no, $value->quantity);

				array_push($creditOrderLine, $col);
				array_push($productHistory, $ph);
			}

			$this->db->insert_batch('creditorderline', $creditOrderLine);
			$this->db->insert_batch('producthistory', $productHistory);
		}

		private function UpdateProductQuantity($p_no, $qty)
		{
			$this->db->query('UPDATE product SET qty = qty - ? WHERE p_no = ?', [$qty, $p_no]);
		}

		private function post_updateCustomer($data, $sum, $input)
		{
			$creditlimit = $this->db->query('SELECT 
                                        CASE 
                                                WHEN totalcredit IS NULL THEN 0 
                                                ELSE totalcredit 
                                        END as totalcredit 
                                        FROM customer 
                                        WHERE c_no = ?', 
                                        array($data['searchCustomer']))->result()[0]->creditlimit;

			$totalCredit = $this->db->query("SELECT 
                                            CASE
                                                    WHEN SUM(totalamount) IS NULL THEN 0
                                                    ELSE SUM(totalamount)
                                            END AS totalamount
                                    FROM creditorder co 
                                    WHERE co.co_no NOT IN 
                                    ( 
                                            SELECT cpl.co_no
                                            FROM creditpaymentline cpl 
                                    ) 
                                    AND co.c_no = ?
                                    ORDER BY co.co_no DESC", 
                                    array($data['searchCustomer']))->result()[0]->totalamount;

			$customerHistory =  [
                                    'date' => date('Y-m-d'), 
                                    'user' => $this->session->userdata('u_no'),
                                    'amountcredit' => $sum[2],
                                    'doc_no' => $input[1],
                                    'description' => 'CREDIT',
                                    'remainingcredit' => ($creditlimit + $totalCredit),
                                    'c_no' => $data['searchCustomer']
                            ];

			$this->db->insert('customerhistory', $customerHistory);

			$this->db->where('c_no', $data['searchCustomer']);
			$this->db->update('customer', ['totalcredit' => $totalCredit]);
		}
	}
?>
