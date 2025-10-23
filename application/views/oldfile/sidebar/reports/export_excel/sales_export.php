<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=sales_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Date', 'Quantity', 'Total']);

	foreach ($result as $value) {
		fputcsv($output, [
				$value['date'],
				$value['totalqty'],
				'P ' . number_format($value['totalamount'], 2, '.', ',')
			]);
	}
?>