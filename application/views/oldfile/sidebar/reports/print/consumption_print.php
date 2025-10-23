<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<style>
	.main {
		padding: 100px;
	}

	@media print {
		.main {
			margin-top: 0px !important;
			padding: 0px !important;
		}

		.hiddenPrint {
			display: none !important;
		}

		table td,
		table th{
			font-size: 11px !important;
			padding: 3px 5px !important;
	  }

	  div.page
    {
      page-break-after: always;
      page-break-inside: avoid;
    }
	}
</style>
<div class="container-fluid main pt15" style="background: #fff; margin-top: 50px">
	<div class="form-group hiddenPrint">
		<a href="<?php echo site_url('reports_con/consumption/summary') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Consumption Reports</a>
		<button class="btn btn-default btn-sm print"><span class="glyphicon glyphicon-print"></span> Print</button>
	</div>
	<?php foreach ($result as $key => $value): 
		if($key % 36 == 0) :?>
			<div class="<?php if($key != 0) echo 'page' ?>">
				<table class="table table-bordered table-condensed text-center mb5">
					<tr>
						<td class="semibold">CUSTOMERS</td>
					</tr>
				</table>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<td>Date</td>
    					<td>Quantity</td>
    					<td>Amount</td>
						</tr>
					</thead>
					<tbody>
	<?php endif?> 
						<tr>
							<td><?php echo $value->date ?></td>
  						<td><?php echo $value->totalqty ?></td>
  						<td><?php echo $value->totalamount ?></td>
						</tr>
	<?php if($key % 35 == 0 && $key != 0 || $key + 1 == sizeof($result)) :?>
				</tbody>
			</table>
		</div>
	<?php endif; 
	endforeach ?>
</div>
<script>
	$('.print').click(function(event) {
			window.print();
		});
</script>