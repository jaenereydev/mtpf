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
		<a href="<?php echo site_url('reports_con/customer/summary') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Customer Reports</a>
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
							<th width="150">Customer</th>
    					<th width="100">Transactions</th>
    					<th width="120">Item Purchased</th>
    					<th width="130">Credit</th>
    					<th width="130">Cash</th>
    					<th width="130">Total Purchased</th>
						</tr>
					</thead>
					<tbody>
	<?php endif?> 
						<tr>
							<td><?php if($value->name == '') echo 'Anonymous'; else echo ucwords($value->name); ?></td>
		    			<td><?php echo $value->trans ?></td>
		    			<td><?php echo $value->qty ?></td>
		    			<td><?php echo $value->credit ?></td>
		    			<td><?php echo $value->cash ?></td>
		    			<td><?php echo $value->total ?></td>
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