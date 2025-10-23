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
		<a href="<?php echo site_url('reports_con/transaction/summary') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Transaction Reports</a>
		<button class="btn btn-default btn-sm print"><span class="glyphicon glyphicon-print"></span> Print</button>
	</div>
	<?php foreach ($result as $key => $transaction): 
		if($key % 36 == 0) :?>
			<div class="<?php if($key != 0) echo 'page' ?>">
				<table class="table table-bordered table-condensed text-center mb5">
					<tr>
						<td class="semibold">TRANSACTIONS</td>
					</tr>
				</table>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th width="150">Receipt</th>
							<th width="130">Date</th>
							<th width="80">Type</th>
							<th width="200">Customer</th>
							<th width="90">Quantity</th>
							<th width="90">Discount</th>
							<th width="100">Total</th>
						</tr>
					</thead>
					<tbody>
		<?php endif?> 
						<tr>
							<td><?php echo $transaction->doc_no ?></td>
							<td><?php echo $transaction->date ?></td>
							<td><?php echo $transaction->type ?></td>
							<td><?php echo ucwords($transaction->name) ?></td>
							<td><?php echo $transaction->totalqty ?></td>
							<td><?php echo $transaction->discountamount ?></td>
							<td><?php echo $transaction->totalamount ?></td>
						</tr>
			<?php if( ($key % 35 == 0 && $key != 0) || $key + 1 == sizeof($result) ) :?>
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