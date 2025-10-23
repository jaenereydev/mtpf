<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=receiving_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Receipt', 'Date', 'Name', 'Quantity', 'Total']);

	foreach ($result as $value) {
		fputcsv($output, [
				$value['ci_no'],
				$value['date'],
				ucwords($value['name']),
				$value['totalqty'],
				'P ' . number_format($value['totalamount'], 2, '.', ',')
			]);
	}
?>