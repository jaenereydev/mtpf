<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-signal"></span> Sales
    	</div>
    	<div class="panel-toolbar text-right">
    		<a href="<?php echo site_url('print_con/sales_print') ?>" class="btn btn-primary btn-sm">
    			<span class="glyphicon glyphicon-print"></span> Print
    		</a>
    		<a href="<?php echo site_url('excel_con/sales_excel') ?>" class="btn btn-success btn-sm">
    			<span class="glyphicon glyphicon-floppy-save"></span> Export to Excel
    		</a>
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/sales/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-8 col-xs-offset-2 form-inline pr0 mb15">
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
		    <!-- 	<div class="row pt15">
		    		<div class="col-xs-2 col-xs-offset-10">
	    				<button class="btn btn-default btn-sm">Filter</button>
		    		</div>
		    	</div> -->
	    	</form>
	    	<style>
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
	    				<td width="100px" style="vertical-align: middle" class="pa5">Credit</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo number_format($sum['credit'], 2, '.', ',') ?></strong></td>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Check</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo number_format($sum['check'], 2, '.', ',') ?></strong></td>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Cash</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo number_format($sum['cash'], 2, '.', ',') ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    	<div class="col-xs-4 col-xs-offset-4">
	    		<table class="table table-bordered text-center">
	    			<tr>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Total Sales</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo number_format($total, 2, ".", ",") ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-xs-12 table-responsive">
	    		<table class="table table-bordered table-condensed" id="datatable">
	    			<thead>
	    				<tr>
	    					<td>Date</td>
	    					<td>Quantity</td>
	    					<td>Total</td>
	    				</tr>
	    			</thead>
		    		<tbody>
	    				<?php 
	    					if(sizeof($result)):
		    					foreach ($result as $value): 
		    			?>
					    			<tr>
					    				<td><?php echo $value['date']?></td>
					    				<td><?php echo $value['totalqty']?></td>
					    				<td>P <?php echo number_format($value['totalamount'], 2, ".", ","); ?></td>
					    			</tr>
		    			<?php 
		    					endforeach; 
		    				endif;
		    			?>
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
