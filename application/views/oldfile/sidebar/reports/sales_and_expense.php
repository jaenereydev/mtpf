<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<style>
	.center th, .center td{
		text-align: center !important;
	}

	tfoot td {
		font-weight: 600;
	}

	.bold td:first-child {
		font-weight: 600 !important;
	}

	.no-border td{
		padding-top: 5px !important;
		padding-bottom: 0px !important;
		border: 0px !important;
	}

	.second_row  td:nth-child(2){
		text-align: center;
		font-weight: 400 !important;
	}
	
	.receipt {
		font-size: auto;
	}
	
	.main {
		padding: 100px;
	}


	@media print {
		.main {
			margin-top: 0px !important;
			padding: 0px !important;
		}

		body {
			font-size: 11px !important;
		}

		.receipt {
			font-size: 8px !important;
		}

		.hiddenPrint {
			display: none !important;
		}

		div.page
    {
      page-break-after: always;
      page-break-inside: avoid;
    }

   	table td{
			font-size: 11px !important;
			padding: 1px 5px !important;
	  }
	}
</style>
<div class="container-fluid main pt15" style="background: #fff; margin-top: 50px">
	<div class="form-group hiddenPrint">
		<?php if ($input): ?>
			<a href="<?php echo site_url('reports_con/ZReading/summary') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Reports</a>
		<?php else: ?>
			<a href="<?php echo site_url('expenses_con/expensesview') ?>" class="btn btn-primary btn-sm"><span class=" glyphicon glyphicon-dashboard"></span> Dashboard</a>
		<?php endif ?>
		<button class="btn btn-default btn-sm print"><span class="glyphicon glyphicon-print"></span> Print</button>
	</div>
	<div class="clearfix" id="page1">
		<table class="table table-bordered table-condensed text-center mb0">
			<tr>
                            <td class="semibold"><span class="pull-left"><?php echo '# '. $zno[0]->z_no; ?></span>DAILY SALES AND EXPENSES REPORT</td>
			</tr>
		</table>
		<!-- <div class="row"> -->
		<div class="col-xs-7 np">
			<?php 
				function hasValue($num, $val = 1, $bool = false, $decimal = true){
					return (isset($num) && $num != 0 ? ($bool ? 'P ' : '') . ($decimal ? number_format($num * $val, 2, '.', ',') : $num) : '-');
				}
			?>
			<table class="table table-bordered table-condensed mt5 mb5 bold second_row">
				<colgroup>
					<col width="48%">
				</colgroup>
				<tbody>
					<tr>
						<td>DATE:</td>
						<td><?php echo ($input ? date_format(date_create($input), 'F d, Y') : date('F d, Y')) ?></td>
					</tr>
<!--					<tr>
						<td>CASH Sales Receipt #s:</td>
						<td class="receipt">
							<?php foreach ($receipt as $key => $value): 
									echo $value->doc_no;
								if(isset($receipt[$key + 1]) && $value->doc_no)
									echo ', ';
							 endforeach ?>
						</td>
					</tr>-->
					<tr>
						<td>Cash-On-Hand</td>
						<td><?php echo hasValue($result[0]->cash_on_hand, 1, 1) ?></td>
					</tr>
                                        <tr>
						<td>Check-On-Hand</td>
						<td><?php echo number_format((float)$checkonhand[0]->ca,2,'.',','); ?></td>
					</tr>
                                        <?php if($bankdeposit == null || $bankdeposit == "0") {}else { ?>
                                        <tr>
						<td>Add: Bank Deposit</td>
						<td><?php echo hasValue($bankdeposit[0]->amount, 1, 1) ?></td>
					</tr>
                                        <?php }?>
					<tr>
						<td>Add: Internal Expenses</td>
						<td><?php echo ($internal[0]->total ? 'P ' . number_format($internal[0]->total, 2, '.', ',') : '-'); ?></td>
					</tr>
					<tr>
						<td>Add: External Expenses</td>
						<td><?php echo ($external[0]->total ? 'P ' . number_format($external[0]->total, 2, '.', ',') : '-'); ?></td>
					</tr>
					<tr>
						<td>Less: Cash Credit Payments</td>
						<td><?php echo number_format((float)$sumcash[0]->amount,2,'.',','); ?></td>
					</tr>
                                        <tr>
						<td>     *Check Credit Payments</td>
						<td><?php echo number_format((float)$sumcheck[0]->amount,2,'.',','); ?></td>
					</tr>
					<tr>
						<td>ACTUAL CASH SALES</td>
						<td><?php echo hasValue((($result[0]->cash_on_hand + $internal[0]->total + $external[0]->total) - $sumcash[0]->amount)+$bankdeposit[0]->amount, 1, 1) ?></td>
					</tr>
                                        <tr>
						<td>ACTUAL CHECK SALES</td>
						<td><?php echo number_format((float)$checkonhand[0]->ca,2,'.',','); ?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>Z-READING</td>
                                                <td><?php echo number_format((float)$zreading[0]->ta,2,'.',','); ?></td>
					</tr>
					<tr>
						<td>Variance: Cash Sales - Z-reading</td>
						<td><?php echo hasValue(((($result[0]->cash_on_hand + $checkonhand[0]->ca) - $sumcash[0]->amount)+$bankdeposit[0]->amount)-$zreading[0]->ta, 1, 1) ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- z -->             
		<div class="col-xs-5 pr0 pl5">
			<table class="table table-bordered table-condensed mt5 mb5 center">
				<colgroup>
					<col width="28%">
					<col>
					<col>
					<col>
				</colgroup>
				<tbody>
					<tr>
						<td class="semibold">BILLS</td>
						<td class="semibold">x</td>
						<td class="semibold">Q</td>
						<td class="semibold">Amount</td>
					</tr>
					<tr>
						<td>1000</td>
						<td>x</td>
						<td><?php echo hasValue($result[0]->one_thousand, 1, false, false) ?></td>
						<td><?php echo hasValue($result[0]->one_thousand, 1000, 1) ?></td>
					</tr>
					<tr>
						<td>500</td>
						<td>x</td>
						<td><?php echo hasValue($result[0]->five_hundred, 1, false, false) ?></td>
						<td><?php echo hasValue($result[0]->five_hundred, 500, 1) ?></td>
					</tr>
					<tr>
						<td>200</td>
						<td>x</td>
						<td><?php echo hasValue($result[0]->two_hundred, 1, false, false) ?></td>
						<td><?php echo hasValue($result[0]->two_hundred, 500, 1) ?></td>
					</tr>
					<tr>
						<td>100</td>
						<td>x</td>
						<td><?php echo hasValue($result[0]->one_hundred, 1, false, false) ?></td>
						<td><?php echo hasValue($result[0]->one_hundred, 100, 1) ?></td>
					</tr>
					<tr>
						<td>50</td>
						<td>x</td>
						<td><?php echo hasValue($result[0]->fifty, 1, false, false) ?></td>
						<td><?php echo hasValue($result[0]->fifty, 50, 1) ?></td>
					</tr>
					<tr>
						<td>20</td>
						<td>x</td>
						<td><?php echo hasValue($result[0]->twenty, 1, false, false) ?></td>
						<td><?php echo hasValue($result[0]->twenty, 20, 1) ?></td>
					</tr>
					<tr>
						<td class="semibold">COINS</td>
						<td>x</td>
						<td><?php echo hasValue($result[0]->coins[0], 1, false, false) ?></td>
						<td><?php echo hasValue($result[0]->coins[1], 1, 1) ?></td>
					</tr>
					<tr>
						<td colspan="3" class="semibold">CASH-ON-HAND</td>
						<td class="semibold"><?php echo hasValue($result[0]->cash_on_hand, 1, 1) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
                <?php if($expenses == null) {}else { ?>
		<div class="col-xs-12 np">
			<table class="table table-bordered table-condensed center">
				<colgroup>
					<col width="15%">
					<col width="18%">
					<col>
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th colspan="4">DAILY EXPENSES</th>
					</tr>
					<tr>
						<th>Voucher #</th>
						<th>Type</th>
						<th>Description</th>
						<th>Amount</th>
					</tr>
					<tr>
				</thead>
				<tbody class="tbody">
					<?php foreach ($expenses as $row) : ?>
						<tr>
							<td><?php echo $row['doc_no'] ?></td>
							<td><?php echo $row['type'] ?></td>
							<td><?php echo $row['description'] ?></td>
							<td>P <?php echo number_format($row['amount'], 2, '.', ','); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">Total Internal Expenses</td>
						<td><?php echo ($internal[0]->total ? 'P ' . number_format($internal[0]->total, 2, '.', ',') : '-') ?></td>
					</tr>
					<tr>
						<td colspan="3">Total External Expenses</td>
						<td><?php echo ($external[0]->total ? 'P ' . number_format($external[0]->total, 2, '.', ',') : '-') ?></td>
					</tr>
					<tr>
						<td colspan="3">GRAND TOTAL</td>
						<td><?php $total = $external[0]->total + $internal[0]->total; echo ($total ? 'P ' . number_format($total, 2, '.', ',') : '-') ?></td>
					</tr>
				</tfoot>
			</table>
			
		</div>
                <?php } ?>
	</div>
        <?php if($payments == null && $payments2 == null) {}else{ ?>
	<div class="clearfix" id="page">
		<div class="col-xs-12 np">
			<table class="table table-bordered table-condensed text-center mb5">
				<tr>
					<td class="semibold">CREDIT PAYMENT</td>
				</tr>
			</table>
			<table class="table table-bordered table-condensed center">
				<thead>
					<tr>
						<th width="230">Customer Name</th>
						<th width="110">CI #</th>
						<th width="110">OR #</th>
						<th width="110">Amount</th>
						<th>Bank</th>
						<th width="170">Check #</th>
						<th width="130">Check Date</th>
						<th width="80">Status</th>
					</tr>
				</thead>
				<tbody>                                        
                                       <?php foreach ($payments as $key => $entry): ?>
						<tr>
							<td><?php echo ucwords($entry->name) ?></td>
							<td><?php echo $entry->ci_no ?></td>
							<td><?php echo $entry->or_no ?></td>
							<td><?php echo $entry->amount ?></td>
							<td><?php echo ($entry->bankname ? $entry->bankname : '-') ?></td>
							<td><?php echo ($entry->checkno ? $entry->checkno : '-') ?></td>
							<td><?php echo ($entry->checkdate ? $entry->checkdate : '-') ?></td>
							<td><?php echo ($entry->description ? $entry->description : '-') ?></td>
						</tr>
					<?php endforeach ?>
                                      <?php foreach ($payments2 as $key => $entry): ?>
						<tr>
							<td><?php echo ucwords($entry->name) ?></td>
							<td></td>
							<td><?php echo $entry->or_no ?></td>
							<td><?php echo $entry->amount ?></td>
							<td><?php echo ($entry->bankname ? $entry->bankname : '-') ?></td>
							<td><?php echo ($entry->checkno ? $entry->checkno : '-') ?></td>
							<td><?php echo ($entry->checkdate ? $entry->checkdate : '-') ?></td>
							<td><?php echo ($entry->description ? $entry->description : '-') ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">Total Cash Payment</td>
						<td colspan="2"><?php echo number_format((float)$sumcash[0]->amount,2,'.',','); ?></td>
					</tr>	
					<tr>
						<td colspan="6">Total Check Payment</td>
						<td colspan="2"><?php echo number_format((float)$sumcheck[0]->amount,2,'.',','); ?></td>
					</tr>
					<tr>
						<td colspan="6">GRAND TOTAL</td>
						<td colspan="2">P <?php echo number_format((float)($sumcash[0]->amount+$sumcheck[0]->amount),2,'.',','); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
        <?php } ?>
    
    
        <?php if($creditsales == null) {}else { ?>
	<div class="clearfix" id="page">
		<div class="col-xs-12 np">
			<table class="table table-bordered table-condensed text-center mb5">
				<tr>
					<td class="semibold">CREDIT SALES</td>
				</tr>
			</table>
			<table class="table table-bordered table-condensed center">
				<thead>
					<tr>
                                                <th> Customer Name</th>
						<th>CI#</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($creditsales as $key => $value): ?>
						<tr>
							<td><?php echo $value->name ?></td>
							<td><?php echo $value->ci_no ?></td>
                                                        <td><?php echo number_format((float)$value->totalamount,2,'.',',') ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
                                <tfoot>
					<tr>
						<td colspan="2">Total Amount</td>
						<td colspan="1"><?php echo number_format((float)$sumcreditsales[0]->amount,2,'.',','); ?></td>
					</tr>						
				</tfoot>
			</table>
		</div>
	</div>
        <?php }?>
    
        <?php if($loan == null) {}else { ?>
	<div class="clearfix" id="page">
		<div class="col-xs-12 np">
			<table class="table table-bordered table-condensed text-center mb5">
				<tr>
					<td class="semibold">LOAN TRANSACTION</td>
				</tr>
			</table>
			<table class="table table-bordered table-condensed center">
				<thead>
					<tr>
                                                <th>#</th>
                                                <th>Customer</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php $a=0; foreach ($loan as $key => $value): ?>
						<tr>
							<td><?php echo $value->doc_no ?></td>
							<td><?php echo $value->name ?></td>
                                                        <td><?php echo number_format((float)$value->amount,2,'.',','); $a=$a+$value->amount;?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
                                <tfoot>
					<tr>
						<td colspan="2">Total Amount</td>
						<td colspan="1"><?php echo number_format((float)$a,2,'.',','); ?></td>
					</tr>						
				</tfoot>
			</table>
		</div>
	</div>
        <?php }?>
        
        <?php if($check == null) {}else { ?>
	<div class="clearfix" id="page">
		<div class="col-xs-12 np">
			<table class="table table-bordered table-condensed text-center mb5">
				<tr>
					<td class="semibold">CHECK ON HAND</td>
				</tr>
			</table>
			<table class="table table-bordered table-condensed center">
				<thead>
					<tr>
						<th width="160">Receipt</th>
						<th width="200">Check Number</th>
						<th>Bank</th>
						<th width="150">Check Date</th>
						<th>Amount</th>
						<th>Receipt Type</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($check as $key => $value): ?>
						<tr>
							<td><?php echo $value->doc_no ?></td>
							<td><?php echo $value->checkno ?></td>
							<td><?php echo ucwords($value->bankname) ?></td>
							<td><?php echo $value->checkdate ?></td>
							<td><?php echo $value->checkamount ?></td>
							<td><?php echo $value->receiptname ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
        <?php }?>
    <table class="table no-border">
				<thead>
					<tr>
						<td class="semibold" width="90%">Please submit with the following attachments</td>
						<td>Prepared by:</td>
					</tr>
					<tr>
						<td class="fsize12">Official Receipts, Cash Vouchers, Bank Checks and Deposit Slips</td>
						<td>___________________________</td>
					</tr>
					<tr>
						<td></td>
						<td class="text-center semibold" style="padding-top: 0px !important;">Signature over Printed Name</td>
					</tr>
				</thead>
			</table>
</div>
<script>
	$(document).ready(function() {
		var page1 = $('#page1').innerHeight(),
				page2 = $('#page2').innerHeight(),
				page3 = $('#page3').innerHeight()

				console.log(page1)

		if(page1 + 20 > 1381)
			$('#page1').addClass('page');

		if(page2 + page3 + 20 > 1381){
			$('#page2').addClass('page');
		} else {
			$('#page1').css('margin-bottom', '20px');
		}
		
		if(page1 + page2 + page3 + 40 > 1381){
			$('#page3').addClass('page');
		} else {
			$('#page2').css('margin-bottom', '20px');
		}

		

		// window.print();

		$('.print').click(function(event) {
			window.print();
		});
	});
</script>
