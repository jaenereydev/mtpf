
<?php
	class Order_model extends CI_Model
	{
            public function deltrans($no)
            {
                $this->db->delete('orderline', array('o_no' => $no));
                $this->db->delete('orders', array('o_no' => $no));
            }

		public function salesToday($id, $date = false)
		{
			$sql = "SELECT SUM(totalqty) as qty, 
                                CASE 
                                        WHEN SUM(totalamount) IS NULL THEN '-'
                                        ELSE CONCAT('P ', FORMAT(SUM(totalamount), 2))
                                END as total 
                                FROM orders 
                                WHERE date = ";
                        if($date)
                                $sql .= $date;
                        else
                                $sql .= "CURDATE() ";

                        $sql .= " AND user = ?";
			return $this->db->query($sql,[$id])->result();
		}

                
                
		public function getSalesPerProductGraph($date, $category)
		{
			// $sql = "SELECT col.p_no, SUM(col.qty) as qty, date, longdesc
			// 				FROM creditorder co
			// 				JOIN creditorderline col
			// 				ON co.co_no = col.co_no
			// 				JOIN product p
			// 				ON p.p_no = col.p_no
			// 				WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'";

			// 				if($category)
			// 					$sql .= " AND p.c_no = " . $category;
			// 				$sql .= " GROUP BY p.p_no";

			// return $this->db->query($sql, [$date['from'], $date['to'], $category])->result_array();


			$sql = "SELECT p_no, SUM(totalamount) as totalamount, date, longdesc, c_no
                                FROM 
                                (
                                        SELECT 
                                                CASE WHEN o.totalamount < 0 THEN -ol.totalamount
                                                        ELSE ol.totalamount
                                                END as totalamount, ol.p_no,  date, longdesc, p.c_no
                                        FROM orders o
                                        JOIN orderline ol
                                        ON o.o_no = ol.o_no
                                        JOIN product p
                                        ON p.p_no = ol.p_no
                                        UNION ALL
                                        SELECT col.p_no, col.totalamount, date, longdesc, p.c_no
                                        FROM creditorder co
                                        JOIN creditorderline col
                                        ON co.co_no = col.co_no
                                        JOIN product p
                                        ON p.p_no = col.p_no
                                ) as products
                                WHERE date BETWEEN '" . $date['from'] . "' AND '" . $date['to'] . "'";
                                if($category)
                                        $sql .= " AND c_no = " . $category;
                                $sql .= " GROUP BY p_no";

			return $this->db->query($sql)->result_array();
		}

		public function getSalesGraph($date, $format, $index)
		{
			$sql = "SELECT SUM(totalamount) as totalamount,
										 SUM(totalqty) as totalqty,
										 $format[$index],
										 date, 'Cash' as type
							FROM orders
							WHERE date BETWEEN ? AND ?
							GROUP BY $index(date)
							ORDER BY date";
		
			return $this->db->query($sql, $date)->result_array();
		}

                
		// Get all transaction includes creditorder
		public function getAllTransactionByDate($date)
		{
			$sql = "SELECT 
                                        totalqty,
                                        DATE_FORMAT(date, '%b. %d, %Y') as date,
                                        CONCAT('P ', FORMAT(totalamount, 2)) as totalamount,
                                        CASE 
                                                WHEN name IS NULL THEN '-'
                                                ELSE name
                                        END as name,
                                        CASE
                                                WHEN doc_no IS NULL THEN '-'
                                                ELSE doc_no
                                        END as doc_no,
                                        CASE
                                                WHEN discountamount IS NULL THEN 'P 0.00'
                                                ELSE CONCAT('P ', FORMAT(discountamount, 2))
                                        END as discountamount,
                                        CASE 
                                                WHEN receiptname IS NULL THEN 'RETURN'
                                                ELSE receiptname
                                        END as type,
                                        o_no,
                                        table_name
                                FROM 
                                (
                                        SELECT date, totalamount, totalqty, doc_no, name, discountamount, receiptname, o_no, 'order' as table_name
                                        FROM orders o
                                        LEFT JOIN customer c
                                        ON o.c_no = c.c_no

                                        UNION ALL
                                        SELECT date, totalamount, totalqty, ci_no, name, discountamount, 'CREDIT', co_no, 'creditorder'
                                        FROM creditorder co
                                        JOIN customer c
                                        ON c.c_no = co.c_no
                                ) lists
                                WHERE date BETWEEN ? AND ?
                                ORDER BY date";

			return $this->db->query($sql, [$date['from'], $date['to']])->result();
		}

		public function getSales($dates = false, $type = 'CASH')
		{
			$sql = "SELECT SUM(totalamount) as total FROM orders WHERE totalamount > 0 AND date";
			if($dates)
				$sql .= " BETWEEN '" . $dates['from'] . "' AND '" . $dates['to'] . "'";
			else
				$sql .= " = CURDATE()";

			if ($type) {
				$sql .= "AND payment = '" . $type  . "'";
			}

			$result = $this->db->query($sql)->result();
			return (isset($result[0]->total) ? $result[0]->total : 0);
		}

		public function getCostOfGoods($date)
		{
			$sql = "SELECT SUM(p.unitcost * quantity) as cost
							FROM product p,
							(
								SELECT 
									CASE WHEN o.totalamount < 0 THEN -qty
										  ELSE qty
									END as quantity, p_no as pno, date
								FROM orders o
								JOIN orderline ol
								ON o.o_no = ol.o_no
								UNION ALL 
								SELECT col.qty, p_no, date
								FROM creditorder co
								JOIN creditorderline	col
								ON co.co_no = col.co_no
							) as orders
							WHERE pno = p.p_no
							AND date BETWEEN ? AND ?";


			$query = $this->db->query($sql, $date)->result();

			return ($query[0]->cost ? $query[0]->cost : 0);
		}

		public function getDiscountByDate($date)
		{
			$sql = "SELECT SUM(discountamount) as discount, date
							FROM (
								SELECT discountamount, date
								FROM orders
								UNION ALL 
								SELECT discountamount, date
								FROM creditorder
							) as discounts
							WHERE date BETWEEN ? AND ?";
			$result = $this->db->query($sql, [$date['from'], $date['to']])->result();

			return ($result[0]->discount ? $result[0]->discount : 0);
		}

		public function getAdditionalPaymentByDate($date)
		{
			$sql = "SELECT SUM(additionalamount) as additional, date
							FROM (
								SELECT additionalamount, date
								FROM orders
								UNION ALL 
								SELECT additionalamount, date
								FROM creditorder
							) as discounts
							WHERE date BETWEEN ? AND ?";
			$result = $this->db->query($sql, $date)->result();

			return ($result[0]->additional ? $result[0]->additional : 0);
		}

		public function salesReceipt($date = false, $u_no = false)
		{
			$sql = "SELECT doc_no 
                                FROM orders 
                                WHERE date = ";
                                if($date)
                                        $sql .= "'". $date . "' AND user = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND user = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}

                public function sumsalesorders($date = false, $u_no = false)
		{
			$sql = "SELECT sum(totalamount) as ta 
                                FROM orders 
                                WHERE date = ";
                                if($date)
                                        $sql .= "'". $date . "' AND user = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND user = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
                
                public function checkonhand($date = false, $u_no = false)
		{
			$sql = "SELECT sum(checkamount) as ca 
                                FROM orders 
                                WHERE date = ";
                                if($date)
                                        $sql .= "'". $date . "' AND user = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND user = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
                
                 public function creditpayment($date = false, $u_no = false)
		{
			$sql = "SELECT sum(totalamount) as ta 
                                FROM creditpayment 
                                WHERE posted = 'POSTED'
                                and date = ";
                                if($date)
                                        $sql .= "'". $date . "' AND u_no = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND u_no = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}

                public function sumcash($date = false, $u_no = false)
		{
			$sql = "SELECT sum(r.amount) as amount 
                                FROM paymentref r, creditpayment c
                                WHERE c.cp_no = r.cp_no
                                and c.posted = 'POSTED'
                                and r.description = 'Cash'
                                and c.date = ";
                                if($date)
                                        $sql .="'". $date . "' AND u_no = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND u_no = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
                
                public function sumcheck($date = false, $u_no = false)
		{
			$sql = "SELECT sum(r.amount) as amount 
                                FROM paymentref r, creditpayment c
                                WHERE c.cp_no = r.cp_no
                                and c.posted = 'POSTED'
                                and r.description = 'Check'
                                and c.date = ";
                                if($date)
                                        $sql .="'". $date . "' AND u_no = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND u_no = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
    
    public function creditsales($date = false, $u_no = false)
		{
			$sql = "select o.*, c.name 
                                from creditorder o, customer c 
                                where c.c_no = o.c_no
                                and o.date = ";
                                if($date)
                                        $sql .= "'" . $date . "' AND o.user = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND o.user = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
                
    public function sumcreditsales($date = false, $u_no = false)
		{
			$sql = "select sum(totalamount) as amount
                                from creditorder 
                                where date = ";
                                if($date)
                                        $sql .= "'" .   $date . "' AND user = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND user = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
		           
        public function post_order($data, $input)
        {
            $sum = $this->session->userdata('sum_details');

            $ref_no = $this->getRefNo();

            $inserted = [ 'date' => date('Y-m-d'), 
                            'time' => date('H:i:s'),
                            'user' => $this->session->userdata('u_no'), 
                            'totalamount' => $sum[2], 
                            'totalqty' => $sum[0], 
                            'remarks' => ($data['remarks'] != '' ? $data['remarks'] : null), 
                            'c_no' => ($data['searchCustomer'] != '' ? $data['searchCustomer']: null), 
                            'ref_no' => $ref_no,
                            'discountamount' => (isset($sum['discount']) ? $sum['discount']['amount'] : null),
                            'additionalamount' => (isset($sum['additional_amount']) ? $sum['additional_amount'] : null),
                            'status' => 'PROCESSED',
                            'payment' => 'CASH',
                            'doc_no' => $input[1],
                            'paymentchange' => $sum[3],
                            'receiptname' => strtoupper($input[0]) 
                        ];

            $this->db->insert('orders', $inserted);
            $id = $this->db->insert_id();

            // $this->post_oderline($id, 'SALES', $ref_no, $this->session->userdata('saleProduct'));
            $this->post_oderline($input, $id, 'SALES', $ref_no, $this->session->userdata('saleProduct') );

            if($data['searchCustomer']){
                    $this->load->model('customer_model');
                    $this->customer_model->post_customerHistory('SALES', $data['searchCustomer'], ['sum' => $sum[2], 'ref' => $ref_no], $input);

            }

            return $data['amountPaid'] - $sum[3];
        }

		public function post_oderline($input, $id, $type, $ref_no, $products, $return = false)
                {
			$orderLine = [];
			$productHistory = [];

			foreach ($products as $key => $value) {
				$price = 'price' . $value->counter;
				// $qty = $value->quantity;

				if(isset($value->adjustment) && (int)$value->adjustment > 0){

					// return [$value->adjustment, $value->qty, $value->p_no, $value->longdesc];
					$this->adjustments([(int)$value->adjustment, (int)$value->qty, $value->p_no], $value->longdesc, $ref_no);
					// $qty = $value->quantity - $value->adjustment;
				}

				array_push($orderLine, [ 'user' => $this->session->userdata('u_no'),
						'qty' => $value->quantity, 
						'unitprice' => $value->unitprice, 
						// 'price' => (isset($value->override) ? $value->override : $value->$price), 
						'price' => $value->$price, 
						'totalamount' => round($value->total, 2),
						'o_no' => $id, 
						'p_no' => $value->p_no,
						'unitpriceb' => $value->unitcost,
						'price1' => $value->price1,
						'pricestatus' => $price ]);

				array_push($productHistory, 
					[ 'date' => date('Y-m-d'), 
						'description' => $type, 
						'u_no' => $this->session->userdata('u_no'),
						'ref_no' => $input[1],
						'instock' => ($return ? $value->quantity : null),
						'outstock' => ($return ? null : $value->quantity),
						'rqty' => ($return ? $value->qty + $value->quantity : ($value->qty + (isset($value->adjustment) ? (int)$value->adjustment : 0)) - $value->quantity),
						'p_no' => $value->p_no ]);
					
				$this->UpdateProductQuantity($value->p_no, ($return ? - $value->quantity : $value->quantity));
			
			}

			$this->db->insert_batch('orderline', $orderLine);
			$this->db->insert_batch('producthistory', $productHistory);
		}

		public function post_check($data, $input)
		{
			$sum = $this->session->userdata('sum_details');

			$ref_no = $this->getRefNo();
			$date = date_format(date_create($data['check_date']), 'Y-m-d');

			$inserted = [ 'date' => date('Y-m-d'), 
                    'time' => date('H:i:s'),
                    'user' => $this->session->userdata('u_no'), 
                    'totalamount' => $sum[2], 
                    'doc_no' => $input[1],
                    'totalqty' => $sum[0], 
                    'remarks' => ($data['remarks'] != '' ? $data['remarks'] : null), 
                    'c_no' => ($data['searchCustomer'] ? $data['searchCustomer']: null), 
                    'discountamount' => ($sum['discount'] ? $sum['discount']['amount'] : null),
                    'additionalamount' => ($sum['additional_amount'] ? $sum['additional_amount'] : null),
                    'ref_no' => (int)$ref_no,
                    'status' => 'PROCESSED',
                    'payment' => 'CHECK',
                    'checkno' => $data['check_no'],
                    'checkdate' => $date,
                    'bankname' => $data['bank_name'],
                    'checkamount' => $data['check_amount'],
                    'receiptname' => strtoupper($input[0])
                   ];

			$this->db->insert('orders', $inserted);
			$id = $this->db->insert_id();

			$this->post_oderline($input, $id, 'SALES', $ref_no, $this->session->userdata('saleProduct'));

			$this->load->model('customer_model');
			$this->customer_model->post_customerHistory('SALES', $data['searchCustomer'], ['sum' => $sum[2], 'ref' => $ref_no], $input);
		}


		public function sales_report_summary($data)
		{
			$sales = "SELECT * FROM 
                                (
                                        SELECT DATE_FORMAT(date, '%b. %d, %Y') as date, totalamount, totalqty, o_no as id, doc_no as receipt, 'Cash' as type FROM orders
                                        UNION ALL
                                        SELECT DATE_FORMAT(date, '%b. %d, %Y') as date, totalamount, totalqty, co_no as id, ci_no, 'Credit' FROM creditorder 
                                ) as SALES
                                WHERE totalamount > 0
                                AND date BETWEEN DATE_FORMAT('" . $data['from'] . "', '%b. %d, %Y') AND DATE_FORMAT('" . $data['to'] . "', '%b. %d, %Y')
                                ORDER BY date, id, type";
			$sales = $this->db->query($sales)->result_array();

			return $sales;
		}

		public function post_return($data)
		{
			$sum = $this->session->userdata('SalesSum');
			$ref_no = $this->getRefNo();

			$inserted = [ 'date' => date('Y-m-d'), 
                    'time' => date('H:i:s'),
                    'user' => $this->session->userdata('u_no'), 
                    'totalamount' => -$sum[1],
                    'totalqty' => $sum[0], 
                    'c_no' => ($data['searchCustomer'] != '' ? $data['searchCustomer']: null), 
                    'ref_no' => $ref_no,
                    'status' => 'PROCESSED',
                    'payment' => 'CASH',
                    'paymentchange' => 0 ,
                    'receiptname' => 'RETURN'];

                    $this->db->insert('orders', $inserted);

			$this->post_oderline($ref_no, $this->db->insert_id(), 'RETURN', $ref_no, $this->session->userdata('SalesReturn'), true);
		}

		public function getReturnItem($date)
		{
			$sql = "SELECT SUM(totalamount) as returnItem
		 					FROM orders
		 					WHERE totalamount < 0
		 					AND date BETWEEN ? AND ?";
      $result = $this->db->query($sql, [$date['from'], $date['to']])->result()[0]->returnItem;

      return ($result ? $result : 0);
		}

		public function getProductTransaction($id)
		{
			$sql = "SELECT ol.qty, ol.totalamount, pricestatus, longdesc, ol.price1, price2, price3, price4, price5, price6, price7, price8, price9, price10, price11, discountamount, additionalamount, o.totalamount as total
                                FROM orders o
                                JOIN orderline ol
                                ON o.o_no = ol.o_no
                                JOIN product p
                                ON p.p_no = ol.p_no
                                WHERE ol.o_no = ?";

			return $this->db->query($sql, [$id])->result();
		}

		public function getCheckList($date = false, $u_no = false)
		{
			$sql = "SELECT DATE_FORMAT(checkdate, '%b. %d, %Y') as checkdate, 
                                    CONCAT('P ', FORMAT(checkamount, 2)) as checkamount,
                                    checkno, bankname,  receiptname, doc_no
                            FROM orders
                            WHERE checkno IS NOT NULL
                            AND date = ";

                            if($date)
                                    $sql .= $date . " AND user = " . $u_no;
                            else
                                    $sql .= "CURDATE() AND user = " . $this->session->userdata('u_no');
							
			return $this->db->query($sql)->result();
		}



		private function getRefNo()
		{
			$ref_no = $this->db->query('SELECT ref_no FROM orders ORDER BY o_no DESC LIMIT 1')->result();

			return (isset($ref_no[0]->ref_no) ? (int)$ref_no[0]->ref_no + 1 : 1);
		}

		public function adjustments($info, $name, $ref_no = false)
		{
			$name = str_replace('crack ', '', strtolower($name));
			$sql = "SELECT p_no, qty FROM product WHERE TRIM(LCASE(longdesc)) = '" . trim($name) . "'";
			$result = $this->db->query($sql)->result();

			$this->db->query('UPDATE product SET qty = qty + ? WHERE p_no = ?', [$info[0], $info[2]]);
			$this->db->query('UPDATE product SET qty = qty - ? WHERE p_no = ?', [$info[0], $result[0]->p_no ]);

			// Add to current selected product
			$this->db->insert('producthistory', [
					'date' => date('Y-m-d'),
					'description' => 'ADJUSTMENT',
					'u_no' => $this->session->userdata('u_no'),
					'ref_no' => ($ref_no ? $ref_no : null),
					'instock' => $info[0],
					'rqty' => $info[1] + $info[0],
					'p_no' => $info[2]
				]); 

			// Minus to adjusted product.
			$this->db->insert('producthistory', [
					'date' => date('Y-m-d'),
					'description' => 'ADJUSTMENT',
					'u_no' => $this->session->userdata('u_no'),
					'ref_no' => ($ref_no ? $ref_no : null),
					'outstock' => $info[0],
					'rqty' => ($result ? $result[0]->qty - $info[0] : null),
					'p_no' => ($result ? $result[0]->p_no : null)
				]); 

		}

		private function UpdateProductQuantity($p_no, $qty)
		{
			$this->db->query('UPDATE product SET qty = qty - ? WHERE p_no = ?', [$qty, $p_no]);
		}
	}
?>