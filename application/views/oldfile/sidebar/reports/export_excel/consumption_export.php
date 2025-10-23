<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=consumption_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Date', 'Quantity', 'Amount']);

	foreach ($result as $key => $value) {
		fputcsv($output, [
				$value->date,
				$value->totalqty,
				$value->totalamount
			]);
	}
?>