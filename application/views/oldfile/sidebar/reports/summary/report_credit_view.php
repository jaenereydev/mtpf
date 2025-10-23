<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-signal"></span> Receivings
    	</div>
    	<div class="panel-toolbar text-right">
    		<a href="<?php echo site_url('print_con/receiving_print') ?>" class="btn btn-primary btn-sm">
    			<span class="glyphicon glyphicon-print"></span> Print
    		</a>
    		<a href="<?php echo site_url('excel_con/receiving_excel') ?>" class="btn btn-success btn-sm">
    			<span class="glyphicon glyphicon-floppy-save"></span> Export to Excel
    		</a >
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/credit/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-8 col-xs-offset-2 form-inline pr0 mb15">
		    	<div class="row">
		    		<div class="col-xs-12">
			    		<label for="from" class="pr10">From: </label>
			    		<div class="input-group">
			    			<input type="text" name="from" id="from" class="form-control input-sm" value="<?php if(isset($input['from'])) echo $input['from'] ?>">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    		</div>
			    		<label for="to" class="pl10 pr10">To: </label>
			    		<div class="input-group pr10">
			    			<input type="text" name="to" id="to" class="form-control input-sm" value="<?php if(isset($input['to'])) echo $input['to'] ?>">
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
	    				<td><strong class="fsize24">P <?php if(isset($result[1][0]->unpaid)) echo number_format($result[1][0]->unpaid, 2, '.', ','); else echo "00.00"  ?></strong></td>
	    				<td>Unpaid Transaction</td>
	    				<td><strong class="fsize22"><?php if(isset($result[1][0]->counter)) echo $result[1][0]->counter; else echo "0"  ?></strong></td>
	    				<td>Paid</td>
	    				<td><strong class="fsize24">P <?php if(isset($result[1][0]->paid)) echo number_format($result[1][0]->paid, 2, '.', ','); else echo "00.00" ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    	<div class="col-xs-4 col-xs-offset-4 pl5 pr5">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Total</td>
	    				<td><strong class="fsize24">P <?php echo number_format($total, 2, ".", ",") ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-xs-12 table-responsive">
	    		<table class="table table-bordered table-condensed" id="datatable">
	    			<thead>
	    				<tr>
	    					<td>Receipt</td>
	    					<td>Date</td>
	    					<td>Name</td>
	    					<td>Quantity</td>
	    					<td>Total</td>
	    				</tr>
	    			</thead>
		    		<tbody>
	    				<?php 
	    					if(sizeof($result)):
		    					foreach ($result[0] as $value): 
		    			?>
					    			<tr>
					    				<td><?php echo $value['ci_no'] ?></td>
					    				<td><?php echo $value['date']?></td>
					    				<td><?php echo ucwords($value['name']) ?></td>
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
			'bAutoWidth': false, 
		  'aoColumns' : [
		    {'sWidth': '10%'},
		    {'sWidth': '10%'},
		    {'sWidth': '20%'},
		    {'sWidth': '10%'},
		    {'sWidth': '10%'},
		  ],
			"sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>'
		});
	});
</script>
