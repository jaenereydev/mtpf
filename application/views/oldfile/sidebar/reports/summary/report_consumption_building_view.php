<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-grain"></span> Poultry Consumption
    	</div>
    	<div class="panel-toolbar text-right">
    		<a href="<?php echo site_url('print_con/consumption_building_print') ?>" class="btn btn-primary btn-sm">
    			<span class="glyphicon glyphicon-print"></span> Print
    		</a>
    		<a href="<?php echo site_url('excel_con/consumption_building_excel') ?>" class="btn btn-success btn-sm">
    			<span class="glyphicon glyphicon-floppy-save"></span> Export to Excel
    		</a >
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/consumption/summary/building'); ?>" method="get" accept-charset="utf-8" class="col-xs-9 col-xs-offset-1 form-inline pr0 mb15">
		    	<div class="row">
		    		<div class="col-xs-12">
		    			<label for="type" class="pr10">Type: </label>
		    			<select name="type" id="type" class="form-control input-sm">
		    				<option value=""></option>
		    				<?php foreach ($type as $key => $value): ?>
		    					<option value="<?php echo $value->type ?>" <?php if(isset($input['type']) && $input['type'] == $value->type) echo 'selected' ?>><?php echo $value->type ?></option>
		    				<?php endforeach ?>
		    			</select>
			    		<label for="from" class="pr10 pl10">From: </label>
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
	    			
	    		</table>
	    	</div>
	    	<div class="col-xs-4 col-xs-offset-4 pl5 pr5">
	    		<table class="table table-bordered text-center odd">
	    			
	    		</table>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-xs-12 table-responsive">
	    		<table class="table table-bordered table-condensed" id="datatable">
	    			<thead>
	    				<tr>
	    					<th width="150">Building No.</th>
	    					<th width="150">Capacity</th>
	    					<th width="150">Chicken Age</th>
	    					<th width="150">Amount</th>
	    					<th width="150">Quantity</th>
	    				</tr>
	    			</thead>
		    		<tbody>
		    			<?php foreach ($result as $value): ?>
		    				<tr>
		    					<td><?php echo $value['building_no'] ?></td>
		    					<td><?php echo $value['chickenage'] ?></td>
		    					<td><?php echo $value['capacity'] ?></td>
		    					<td>P <?php echo number_format((isset($value['totalamount']) ? $value['totalamount'] : 0), 2)  ?></td>
		    					<td><?php echo (isset($value['totalqty']) ? $value['totalqty'] : 0)  ?></td>
		    				</tr>
		    			<?php endforeach ?>
		    		</tbody>
	    		</table>
	    	</div>
	    </div>
    </div>
  </div>
</div>
