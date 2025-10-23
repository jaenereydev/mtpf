<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-signal"></span> Expenses
    	</div>
    	<div class="panel-toolbar text-right">
    		<a href="<?php echo site_url('print_con/expenses_print') ?>" class="btn btn-primary btn-sm">
    			<span class="glyphicon glyphicon-print"></span> Print
    		</a>
    		<a href="<?php echo site_url('excel_con/expenses_excel') ?>" class="btn btn-success btn-sm">
    			<span class="glyphicon glyphicon-floppy-save"></span> Export to Excel
    		</a>
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/expenses/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-8 col-xs-offset-2 form-inline pr0 mb15">
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
	    </div>
	    <div class="row">
	   		<div class="col-xs-12 pt15">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Internal</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo ( $total[0][0] ? number_format($total[0][0]->total, 2): '' ) ?> </strong></td>
	    				<td width="100px" style="vertical-align: middle" class="pa5">External</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo ( $total[1][0] ? number_format($total[1][0]->total, 2): '' ) ?> </strong></td>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Total</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo ( $total[2] ? number_format($total[2], 2): '0.00' ) ?> </strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    	<div class="col-xs-12 table-responsive">
	    		<table class="table table-bordered table-condensed" id="datatable">
	    			<thead>
	    				<tr>
	    					<td>Doc. No.</td>
	    					<td>Type</td>
	    					<td>Description</td>
                <td>Date</td>
                <td>Amount</td>
	    				</tr>
	    			</thead>
		    		<tbody>
	    				<?php foreach ($result as $value): ?>
                <tr>
                  <td><?php echo $value['doc_no']?></td>
                  <td><?php echo $value['type']?></td>
                  <td><?php echo $value['description']?></td>
                  <td><?php echo $value['date']?></td>
                  <td>P <?php echo number_format($value['amount'], 2, ".", ","); ?></td>
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
