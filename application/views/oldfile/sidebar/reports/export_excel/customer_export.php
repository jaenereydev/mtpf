<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=customer_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Customer', 'Transaction', 'Item Purchased', 'Credit', 'Cash', 'Total Purchased']);

	foreach ($result as $key => $value) {
		fputcsv($output, [
				($value->name == '' ? 'Anonymous' : ucwords($value->name)),
				$value->trans,
				$value->qty,
				$value->credit,
				$value->cash,
				$value->total
			]);
	}
?>