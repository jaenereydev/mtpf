<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=classifying_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Product Name', 'Quantity']);

	foreach ($result as $key => $value) {
		fputcsv($output, [
				$value->longdesc,
				$value->qty
			]);
	}
?>