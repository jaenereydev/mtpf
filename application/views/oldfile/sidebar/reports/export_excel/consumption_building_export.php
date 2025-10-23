<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=consumption_building_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Building No', 'Capacity', 'Chicken Age', 'Type', 'Quantity', 'Amount']);

	foreach ($result as $key => $value) {
		fputcsv($output, [
				$value['building_no'],
				$value['capacity'],
				$value['chickenage'],
				$value['type'],
				(isset($value['totalqty']) ? $value['totalqty'] : 0),
				'P '. number_format((isset($value['totalamount']) ? $value['totalamount'] : 0), 2)
			]);
	}
?>