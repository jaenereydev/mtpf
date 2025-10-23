<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=customer_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Doc. No', 'Type', 'Description', 'Date', 'Amount']);

	foreach ($result as $key => $value) {
		fputcsv($output, [
			 $value['doc_no'],
			 $value['type'],
			 $value['description'],
			 $value['date'],
			 number_format($value['amount'])
			]);
	}
?>