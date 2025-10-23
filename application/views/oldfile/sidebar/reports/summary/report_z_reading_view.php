<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-floppy-disk"></span> Z-Reading
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/ZReading/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-4 col-xs-offset-4 form-inline pr0 mb15">
	    		<label for="to" class="pl10 pr10">Date: </label>
	    		<div class="input-group pr10">
	    			<input type="text" name="from" id="to" class="form-control input-sm" value="<?php echo $input[0]['from'] ?>">
						<span class="input-group-addon "><span class="glyphicon glyphicon-calendar"></span></span>
	    		</div>
	    		<button class="btn btn-default btn-sm">Filter</button>
	    	</form>
	    	<style>
		    	td {
		    		vertical-align: middle !important;
		    	}
	    	</style>
	    </div>
	    <div class="row">
	    	<div class="col-xs-12 table-responsive">
	    		<table class="table table-bordered table-condensed" id="datatable">
	    			<thead>
	    				<tr>
	    					<td width="39"></td>
	    					<td>User</td>
	    					<td>Cash-On-Hand</td>
	    					<td>Internal Expense</td>
	    					<td>External Expense</td>
	    					<td>Cash Credit Payment</td>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				<?php foreach ($result as $key => $value): ?>
	    					<tr>
	    						<td>
	    						<!-- 	<span data-toggle="modal" data-target>
	    								<span class="btn btn-info btn-sm" data-toggle="tooltip" title="view">
	    									<span class="glyphicon glyphicon-eye-open"></span>
	    								</span>
	    							</span> -->
	    							<span>
	    								<a href="<?php echo site_url('reports_con/sales_and_expense_report') . '/' .$value->u_no. '/' . $input[1]['from'] ?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="print">
	    									<span class="glyphicon glyphicon-print"></span> Print
	    								</a>
	    							</span>
	    						</td>
	    						<td><?php echo ucwords($value->fname . ' ' . $value->mname . ' ' . $value->lname) ?></td>
	    						<td><?php echo number_format($value->cash_on_hand, 2, '.', ',') ?></td>
	    						<td><?php echo (isset($value->internal) ? 'P ' . number_format($value->internal, 2, '.', ',') : '-') ?></td>
	    						<td><?php echo (isset($value->external) ? 'P ' . number_format($value->external, 2, '.', ',') : '-') ?></td>
	    						<td><?php echo (isset($value->credit) ? 'P ' . number_format($value->credit, 2, '.', ',') : '-') ?></td>
	    					</tr>
	    				<?php endforeach ?>
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
			"sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>'
		});
	});
</script>
