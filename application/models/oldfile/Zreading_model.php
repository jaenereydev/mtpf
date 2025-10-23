<?php
	class Zreading_model extends CI_Model
	{
		public function getZReading($date = false, $u_no = false)
		{
			$sql = "SELECT u.u_no, one, five, ten, twenty, fifty, one_hundred, twenty_five_cents, two_hundred, five_hundred, one_thousand, DATE_FORMAT(date, '%b. %d, %Y') as date, total_sales, total_qty, cash_on_hand, fname, mname, lname
							FROM zreading z
							JOIN user u
							ON z.u_no = u.u_no ";
							if($date && $u_no)
								$sql .= " WHERE date = '" . $date . "' AND z.u_no = " . $u_no;
							else if($date)
								$sql .= " WHERE date = '" . $date['from'] . "'";
							else
								$sql .= " WHERE date = CURDATE() AND z.u_no = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
                
                public function getzno($date = false, $u_no = false)
		{
			$sql = "SELECT z_no
                                FROM zreading
                                WHERE date = ";
                                if($date)
                                        $sql .= "'". $date . "' AND u_no = " . $u_no;
                                else
                                        $sql .= "CURDATE() AND u_no = " . $this->session->userdata('u_no');
			return $this->db->query($sql)->result();
		}
	}
?>