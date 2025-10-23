<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-calendar"></span> Transactions
    	</div>
    	<div class="panel-toolbar text-right">
    		<a href="<?php echo site_url('print_con/transaction_print') ?>" class="btn btn-primary btn-sm">
    			<span class="glyphicon glyphicon-print"></span> Print
    		</a>
    		<a href="<?php echo site_url('excel_con/transaction_excel') ?>" class="btn btn-success btn-sm">
    			<span class="glyphicon glyphicon-floppy-save"></span> Export to Excel
    		</a>
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/transaction/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-8 col-xs-offset-2 form-inline pr0 mb15">
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
	    </div>
	    <div class="row">
	    	<div class="col-xs-12 table-responsive">
                    <table class="table table-bordered table-condensed" id="datatable">
                        <thead>
                            <tr>
                                <?php if($users[0]->position == 'Administrator') { ?> 
                                    <td>Action</td>
                                <?php }?>
                                <td>Receipt</td>
                                <td>Date</td>
                                <td>Type</td>
                                <td>Customer</td>
                                <td>Quantity</td>
                                <td>Discount</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $key => $transaction) : ?>
                                <tr>
                                    <?php if($users[0]->position == 'Administrator') { ?> 
                                    <td>
                                        <?php if($transaction->type == 'CREDIT') {}else { ?> 
                                       <a type="button" title="Delete" href="/mtpf/reports_con/deltransaction/<?php echo $transaction->o_no ?>/<?php echo $transaction->type ?>" onclick="return confirm('Do you want to delete this Transaction?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                                      
                                        <?php }?>
                                    </td>
                                    <?php }?>
                                    <td><?php echo $transaction->doc_no ?></td>
                                    <td><?php echo $transaction->date ?></td>
                                    <td><a href="#SalesList" data-toggle="modal" data-id="<?php echo $transaction->o_no . '_' . $transaction->table_name; ?>"><?php echo $transaction->type ?></a></td>
                                    <td><?php echo ucwords($transaction->name) ?></td>
                                    <td><?php echo $transaction->totalqty ?></td>
                                    <td><?php echo $transaction->discountamount ?></td>
                                    <td><?php echo $transaction->totalamount ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
	    	</div>
	    </div>
    </div>
  </div>
</div>
<style>
	.odd td {
		padding: 5px !important;
		vertical-align: middle !important;
	}

	.odd td:nth-child(odd){
		width: 100px !important;
	}

	.odd td:nth-child(even){
		width: 150px !important;
	}
</style>

<div class="modal" id="SalesList" tabindex="-1" role="dialog" aria-labelledby="SalesListLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title" id="SalesListLabel">Transaction Details</h4>
      </div>
      <div class="modal-body pa10">
      	<div class="row">
      		<div class="col-xs-10 col-xs-offset-1">
      			<table class="table table-bordered text-center odd nm">
      				<tr>
	    					<td >Discount</td>
	    					<td><strong class=" discount"></strong></td>
	    					<td >Add Expense</td>
	    					<td><strong class=" expense"></strong></td>
	    				</tr>
      			</table>
      		</div>
      	</div>
      </div>
      <div class="modal-footer pa5">
      	<table class="table table-bordered table-condensed nm text-left">
      		<thead>
      			<tr>
      				<th>Product</th>
      				<th width="100">Quantity</th>
      				<th width="140">Price</th>
      				<th width="140">Total</th>
      			</tr>
      		</thead>
      		<tbody id="SLTbody">
      		</tbody>
      	</table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script>
	var id = 0;
	$(document).ready(function() {
		$('#datatable').DataTable({
			 'bAutoWidth': false , 
			  'aoColumns' : [
                            { 'sWidth': '10%' },
			    { 'sWidth': '12%' },
			    { 'sWidth': '10%' },
			    { 'sWidth': '10%' },
			    { 'sWidth': '25%' },
			    { 'sWidth': '10%' },
			    { 'sWidth': '10%' },
			    { 'sWidth': '10%' }
			  ]
		});
	});

	// $('[href~=#SalesList]').click(function(event) {
	// 	var button = $(this).data('id');

	// });


	$('.modal').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget).data('id');

		if(id != button){
			id = button;

			$.post('../../reports_con/getTransactionDetails', {info: button}, function(data) {
				data = JSON.parse(data);
				$('#SLTbody tr').remove()
				$('.discount').text(data[1])
				$('.expense').text(data[2])
				$('#SLTbody').append(data[0]);
			});
		}
	})
</script>
