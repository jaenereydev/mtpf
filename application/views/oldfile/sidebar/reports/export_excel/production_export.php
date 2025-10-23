<?php 
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=production_' . date('m-d-Y') .'.csv');

	$output = fopen('php://output', 'w');

	fputcsv($output, ['Building', 'Date', 'Item', 'Quantity', 'Received by', 'Poultry Product']);

	foreach ($result as $key => $value) {
		fputcsv($output, [
				$value->building_no . ($value->buildingname && $value->building_no ? ' - ' : '') . $value->buildingname,
				$value->date,
				$value->time,
				$value->totalqty,
				$value->receivedby,
				$value->name
			]);
	}
?>