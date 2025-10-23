<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-signal"></span> Customer
    	</div>
    	<div class="panel-toolbar text-right">
    		<a href="<?php echo site_url('print_con/customer_print') ?>" class="btn btn-primary btn-sm">
    			<span class="glyphicon glyphicon-print"></span> Print
    		</a>
    		<a href="<?php echo site_url('excel_con/customer_excel') ?>" class="btn btn-success btn-sm">
    			<span class="glyphicon glyphicon-floppy-save"></span> Export to Excel
    		</a>
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/customer/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-8 col-xs-offset-2 form-inline pr0 mb15">
		    	<div class="row">
		    		<div class="col-xs-12">
			    		<label for="from" class="pr10">From: </label>
			    		<div class="input-group">
			    			<input type="text" name="from" id="from" class="form-control input-sm" value="<?php echo $input['from'] ?>">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    		</div>
			    		<label for="to" class="pl10 pr10">To: </label>
			    		<div class="input-group pr10">
			    			<input type="text" name="to" id="to" class="form-control input-sm" value="<?php echo $input['to'] ?>">
								<span class="input-group-addon "><span class="glyphicon glyphicon-calendar"></span></span>
			    		</div>
			    		<button class="btn btn-default btn-sm">Filter</button>
		    		</div>
		    	</div>
	    	</form>
	    	<style>
	    		.odd td {
	    			vertical-align: middle !important;
	    			padding: 5px !important;
	    		}
	    		
		    	.odd td:nth-child(odd){
		    		width: 100px !important;
		    	}

		    	.odd td:nth-child(even){
		    		width: 200px !important;
		    	}
	    	</style>
	    	<div class="col-xs-12 pt15">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Unpaid</td>
	    				<td><strong class="fsize24">P <?php echo number_format($sum['unpaid'], 2, ".", ",") ?></strong></td>
	    				<td>Unpaid Customer</td>
	    				<td><strong class="fsize22"><?php echo $sum['customer'] ?></strong></td>
	    				<td>Paid</td>
	    				<td><strong class="fsize24">P <?php echo number_format($sum['paid'], 2, ".", ",") ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    	<div class="col-xs-4 col-xs-offset-4 pr5 pl5">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Total Purchased</td>
	    				<td><strong class="fsize24">P <?php echo number_format($sum['total'], 2, ".", ",") ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-xs-12 table-responsive">
	    		<table class="table table-bordered table-condensed" id="datatable">
	    			<thead>
	    				<tr>
	    					<td>Customer</td>
	    					<td>Transactions</td>
	    					<td>Item Purchased</td>
	    					<td>Credit</td>
	    					<td>Cash</td>
	    					<td>Total Purchased</td>
	    				</tr>
	    			</thead>
		    		<tbody>
		    			<?php foreach ($result as $key => $value): ?>
			    			<tr>
				    			<td><?php if($value->name == '') echo 'Anonymous'; else echo ucwords($value->name); ?></td>
				    			<td><?php echo $value->trans ?></td>
				    			<td><?php echo $value->qty ?></td>
				    			<td><?php echo $value->credit ?></td>
				    			<td><?php echo $value->cash ?></td>
				    			<td><?php echo $value->total ?></td>
			    			</tr>	
		    			<?php endforeach; ?>
		    		</tbody>
	    		</table>
	    	</div>
	    </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#datatable').DataTable({
			"sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>'
		});
	});
</script>
