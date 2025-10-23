<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-signal"></span> Profit and Loss
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/profit_and_loss/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-8 col-xs-offset-2 form-inline pr0 mb15">
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
  		</div>
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

    	<div class="row">
	    	<div class="col-xs-4 col-xs-offset-2 pt15">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Sales</td>
	    				<td class="semibold fsize22"><?php echo $result['sales'] ?></td>
	    			</tr>
	    		</table>
	    	</div>

	    	<div class="col-xs-4 pt15">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Receivings</td>
	    				<td class="semibold fsize22"><?php echo $result['receiving'] ?></td>
	    			</tr>
	    		</table>
	    	</div>
    	</div>
			
			<div class="row">
	    	<div class="col-xs-4">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Additional</td>
	    				<td class="semibold fsize22"><?php echo $result['additional'] ?></td>
	    			</tr>
	    		</table>
	    	</div>	
	    	<div class="col-xs-4">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Discounts</td>
	    				<td class="semibold fsize22"><?php echo $result['discounts'] ?></td>
	    			</tr>
	    		</table>
	    	</div>

	    	<div class="col-xs-4">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Returns</td>
	    				<td class="semibold fsize22"><?php echo $result['returnItem'] ?></td>
	    			</tr>
	    		</table>
	    	</div>
			</div>
			
			<div class="row">
	    	<div class="col-xs-4 ">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Total</td>
	    				<td class="semibold fsize22"><?php echo $result['total'] ?></td>	
	    			</tr>
	    		</table>
	    	</div>

	    	<div class="col-xs-4">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Cost of Goods</td>
	    				<td class="semibold fsize22"><?php echo $result['cost'] ?></td>	
	    			</tr>
	    		</table>
	    	</div>

	    	<div class="col-xs-4">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td>Profit</td>
	    				<td class="semibold fsize22"><?php echo $result['profit'] ?></td>
	    			</tr>
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
