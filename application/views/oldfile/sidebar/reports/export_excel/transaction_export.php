<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=transaction_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Receipt', 'Date', 'Type', 'Customer', 'Quantity', 'Discount', 'Total']);

	foreach ($result as $key => $value) {
		fputcsv($output, [
				$value->doc_no,
				$value->date,
				$value->type,
				ucwords($value->name),
				$value->totalqty,
				$value->discountamount,
				$value->totalamount
			]);
	}
?>