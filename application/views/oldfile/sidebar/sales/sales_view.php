	<style>
	table td{
		vertical-align: middle !important;
	}

	table thead, table td, table th {
		text-align: center;
	}
	
	#STable tbody tr{
		cursor: pointer;
	}

	.list-group {
		margin-bottom: 10px !important;
	}

	.list-group > li{
		padding: 6px 12px;
	}

	textarea {
		max-width: 100%;
	}

	label {
		font-size: 13px;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="container-fluid">
<div class="row">
<div class="col-md-12 main" style="padding-top: 60px;">
	<div class="row">
		<div class="col-md-9 pr5">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
		        <div class="panel-heading" style="padding: 6px 12px;">
		          <div class="panel-toolbar text-left">
      						<a title="Dashboard" class="btn btn-default btn-sm" href="<?=site_url('dashboard/index')?>"><span class=" glyphicon glyphicon-dashboard"></span> Dashboard</a>
		              <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Add new product">New Item</button> -->
		              <!-- <button type="button" class="btn btn-sm btn-primary " data-toggle="tooltip" data-placement="top" title="View Suspended Sales">Suspended Sales</button> -->
		          </div>
		        	<div class="panel-title pl15">
		            <span class="glyphicon glyphicon-shopping-cart"></span> Point of Sales
		        	</div>
		        	<div class="panel-toolbar text-right">
		        		<button type="button" class="btn btn-danger btn-sm toggler" data-toggle="modal" data-target="#ZReading" data-backdrop="static" data-keyboard="false" <?php if($this->session->userdata('ZReading')) echo 'disabled' ?> >Z-Reading</button>
		        		<a href="<?php echo site_url('sales_return_con') ?>" class="btn btn-primary btn-sm toggler" <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> >Returns</a>
		        	</div>
		        </div> <!-- end of panel heading -->
		        <div class="panel-body" style="height: 390px; overflow: auto; padding-bottom: 0;"> 
		          <table class="table table-bordered table-striped table-condensed table-hover" id="STable">
		          	<thead>
		          		<tr>
		          			<td width="1%"></td>
		          			<td>Item Name</td>
		          			<td>Stock</td>
		          			<td width="18%">Price</td>
		          			<td width="11%">Quantity</td>
		          			<td width="15%">Total</td>
		          			<td width="11%">Adjustment</td>
		          		</tr>
		          	</thead>
		          	<tbody>
		          		<?php 
		          			if($this->session->userdata('saleProduct')):
		          				foreach ($this->session->userdata('saleProduct') as $value):
		          					$price = 'price' . $value->counter;
		          		?>
		          		<tr data-id="<?php echo $value->indexed ?>">
		          			<td>
			          			<span data-toggle="modal" data-target="#SDelete">
			          				<button class="btn btn-danger btn-sm toggler <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?>" data-toggle="tooltip" data-placement="top" title="Remove item" >
				          				<span class="glyphicon glyphicon-remove"></span>
				          			</button>
				          		</span>
			          		</td>
		          			<td><?php echo $value->longdesc; ?></td>
		          			<td><?php echo $value->qty; ?></td>
                    <td>
                    	<span data-toggle="tooltip" data-placement="top" title="<?php echo $value->label[0]; ?>" > P <?php echo (strpos($value->$price, "." ) !== false ? $value->$price: $value->$price . '.00'); ?> </span>
                    	<strong class="pull-right pr15"><?php echo $value->label[1] ?></strong>
                    </td>
		          			<td><?php echo $value->quantity; ?></td>
		          			<?php if (strtolower($value->longdesc)): ?>
		          				
		          			<?php endif ?>
		          			<td><input type="number" name="override" class="form-control input-sm text-center override" value="<?php echo sprintf('%0.2f', $value->total)?>" ></td>
		          			<?php if(strpos(strtolower($value->longdesc), 'crack') !== false): ?>
			          			<td width="10%">
					          		<input type="number" class="form-control input-sm" name="adjust" placeholder="Quantity" min="0" value="<?php if(isset($value->adjustment)) echo $value->adjustment  ?>">
		          			<?php else: ?>
		          				<td></td>
		          			<?php endif; ?>
		          		</tr>
	          			<?php
		          				endforeach;
		          			else:
		          		?>
		          			<tr class="noItem">
		          				<td colspan="7">No item in the cart</td>
		          			</tr>
		          		<?php
		          			endif;
		          		?>
		          	</tbody>
		          </table>
		        </div> <!-- end of panel body -->
		    	</div> <!-- end of panel div -->
	    	</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<form class="panel-body pa5 form-inline nm toggler" action="<?php echo site_url('sales_con/selected_item') ?>" id="PSearch">
							<label for="">Quantity: </label>
                <input type="number" name="qty" id="qty" min="1" class="ml5 form-control input-sm toggler" <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> min="0" placeholder="1" autofocus required>
							<button class="btn btn-primary btn-sm toggler <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?>">Add Product</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Third Column -->
		<form action="<?php echo site_url('sales_con/payment') ?>" method="POST" id="paymentForm" class="col-md-3 pl5">
			<ul class="list-group" >
				<li class="list-group-item hideThis <?php if(!$this->session->userdata('saleProduct')) echo 'hidden' ?>">
					<div class="row">
						<!-- <div class="col-xs-6 pr0"> -->
							<!-- <a href="#SSale" data-toggle="modal" class="btn btn-warning btn-sm btn-block toggler <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?>">Suspend Sale</a> -->
						<!-- </div> -->
						<div class="col-xs-6 col-xs-offset-6">
							<a href="#CSale" data-toggle="modal" class="btn btn-danger btn-sm btn-block">Cancel Sale</a>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-12">
							<label for="customer">Select Customer (Optional)</label>
							<select name="searchCustomer" id="searchCustomer" class="form-control toggler" id="selectisize" placeholder="Select a person..." <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> >
								<option val="">Select a person...</option>
								<?php foreach ($customer as $value) : ?>
									<option value="<?php echo $value->c_no ?>"><?php echo ucwords($value->name); ?></option>
								<?php endforeach?>
								<option></option>
							</select>
						</div>
					</div>
					<div class="row pt5">
						<label class="col-xs-2 text-center pt5 pr0">OR</label>
						<div class="col-xs-10">
							<a href="#myModal" data-toggle="modal" class="btn btn-primary btn-sm btn-block toggler" <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> >New Customer</a>
						</div>
					</div>
				</li>
				<li class="list-group-item">	
					Item in cart:	<span class="pull-right price"><?php echo (isset($sumDetails) ? $sumDetails[0] : ''); ?></span>
				</li>
				<li class="list-group-item">
					Sub Total: <span class="pull-right price"><?php echo (isset($sumDetails) ?  'P ' . (strpos($sumDetails[1], "." ) !== false ? $sumDetails[1]: $sumDetails[1] . '.00') : ''); ?></span>
				</li>
				<li class="list-group-item hideThis <?php if(!$this->session->userdata('saleProduct')) echo 'hidden' ?>">
					<div class="row">
						<div class="col-xs-4 pr0">
							<a class="btn btn-default btn-sm btn-block toggler" <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> role="button" data-toggle="collapse" href="#discount" aria-expanded="false" aria-controls="discount" data-disabler>Discount</a>
						</div>
						<div class="col-xs-8 pl10">
							<a class="btn btn-default btn-sm btn-block toggler" <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> role="button" data-toggle="collapse" href="#additional" aria-expanded="false" aria-controls="additional" data-disabler>Additional Amount</a>
						</div>
					</div>
				</li>
				<div id="discount" class="collapse np">
					<span class="list-group-item bg-warning pt5 pb5">
						<div class="row">
							<label for="" class="control-label col-xs-6 pt5">Discount %:</label>
							<div class="col-xs-6 pl0">
								<input type="number" name="discount" data-change class="form-control input-sm toggler" disabled min="0" step="any">
							</div>
						</div>
					</span>
				</div>
				<div id="additional" class="collapse np">
					<span class="list-group-item bg-warning pt5 pb5">
						<div class="row">
							<label for="" class="control-label col-xs-6 pt5">Additional Expense:</label>
							<div class="col-xs-6 pl0">
								<input type="number" name="additional_amount" data-change class="form-control input-sm toggler" disabled step="any">
							</div>
						</div>
					</span>
				</div>
				<li class="list-group-item bg-success">
					<strong class="text-success">Total:</strong> <strong class="pull-right text-success price"><?php echo (isset($sumDetails) ? 'P ' . (strpos($sumDetails[2], "." ) !== false ? $sumDetails[2]: $sumDetails[2] . '.00') : ''); ?></strong>
				</li>
			</ul>
			<ul class="list-group">
				<li class="list-group-item np <?php if(!$this->session->userdata('sum_details')['paid']) echo 'hidden'; ?>" id="paidRegister">
					<table class="table table-condensed nm" style="font-size:12px">
						<thead>
							<tr>
								<th width="150px">Type</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody class="bg-warning">
							<?php 
							if($this->session->userdata('sum_details')['paid']):
								foreach ($this->session->userdata['sum_details']['paid'] as $value): ?>
								<tr>
									<td><?php echo $value[0] ?></td>
									<td>P <?php echo (strpos($value[1], "." ) !== false ? $value[1]: $value[1] . '.00'); ?></td>
								</tr>
							<?php endforeach; 
							endif; ?>
						</tbody>
					</table>
				</li>
				<li class="list-group-item bg-success">
					<strong>Amount Due:</strong> <strong class="pull-right price amountDue"><?php echo (isset($sumDetails) ?  'P ' . (strpos($sumDetails[3], "." ) !== false ? $sumDetails[3]: $sumDetails[3] . '.00') : ''); ?></strong>
				</li>
				<li class="list-group-item">
					<div class="row">
						<label for="paymentType" class="control-label col-xs-6 pt5">Payment Type: </label>
						<div class="col-xs-6 pl0">
							<select name="paymentType" id="paymentType" class="form-control input-sm toggler" required <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> >
								<option value="cash">CASH</option>
								<option value="check">CHECK</option>
								<option value="credit">CREDIT</option>
								<!-- <option value="partial">PARTIAL</option> -->
							</select>
						</div>
					</div>
				</li>
				<div id="checkDetails" class="np collapse hideThis">
					<li class="list-group-item bg-warning pt5 pb5">
						<div class="row">
		      		<label for="check_no" class="control-label col-xs-4 pt5">Check NO.</label>
		      		<div class="col-xs-8">
		      			<input type="text" name="check_no" id="check_no" class="form-control input-sm toggler" disabled min="0" autocomplete="off">
		      		</div>
						</div>
					</li>
					<li class="list-group-item bg-warning pt5 pb5">
						<div class="row">
							<label for="check_date" class="control-label col-xs-4 pt5">Date: </label>
							<div class="col-xs-8">
								<input type="text" name="check_date" id="check_date" class="form-control input-sm toggler dateTimePicker" disabled  autocomplete="off">
							</div>
						</div>
					</li>
					<li class="list-group-item bg-warning pt5 pb5">
						<div class="row">
							<label for="bank_name" class="control-label col-xs-4 pt5">Bank Name: </label>
							<div class="col-xs-8">
								<input type="text" name="bank_name" id="bank_name" class="form-control input-sm toggler" disabled  autocomplete="off">
							</div>
						</div>
					</li>
					<li class="list-group-item bg-warning pt5 pb5">
						<div class="row">
							<label for="check_amount" class="control-label col-xs-4 pt5">Amount: </label>
							<div class="col-xs-8">
								<input type="number" name="check_amount" id="check_amount" class="form-control input-sm toggler" disabled min="0" autocomplete="off" step="any">
							</div>
						</div>
					</li>
				</div>
				<li class="list-group-item hideThis  <?php if(!$this->session->userdata('saleProduct')) echo 'hidden' ?>">
					<div class="row">
						<div class="col-xs-7 pr0">
							<input type="number" name="amountPaid" class="form-control input-sm toggler" placeholder="P 00.00" required <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> step="any" min="0">
						</div>
						<div class="col-xs-5 pl5">
							<button type="submit" class="btn btn-success btn-sm btn-block toggler" id="paymentBtn" <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> >PAYMENT</button>
						</div>
					</div>
				</li>
				<li class="list-group-item hideThis <?php if(!$this->session->userdata('saleProduct')) echo 'hidden' ?>">
					<div class="form-group">
						<label for="comment">Remarks (Optional):</label>
						<textarea name="remarks" id="comment" rows="2" class="form-control toggler" <?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL') echo 'disabled' ?> ></textarea>
					</div>
					<a href="#SComplete" data-toggle="modal" data-backdrop="static" class="btn btn-success btn-block <?php if($this->session->userdata('sum_details')[3] > 0 || gettype($this->session->userdata('sum_details')[3]) == 'NULL') echo 'hidden' ?>">Complete Sale</a>
				</li>
			</ul>
		</form>
	</div>
</div> <!-- end of main div -->

<!-- Delete Item in Table Modal -->
<div class="modal" id="SDelete" tabindex="-1" role="dialog" aria-labelledby="SaleDeleteLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="SaleDeleteLabel">Are you sure you want to delete this item?</p>
      </div>
      <div class="modal-footer pa10">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger btn-sm yes" id="dbutton">Delete Item</button>
      </div>
    </div>
  </div>
</div>

<!-- Cancel Sale Modal-->
<div class="modal" id="CSale" tabindex="-1" role="dialog" aria-labelledby="CancelSalesModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="CancelSalesModal">Are you sure you want to cancel this sale?</p>
      </div>
      <div class="modal-footer pa10">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
        <!-- <button type="button" class="btn btn-danger btn-sm" id="dbutton">Cancel Sale</button> -->
				<a href="sales_con/reset" class="btn btn-danger btn-sm yes">Cancel Sale</a>
      </div>
    </div>
  </div>
</div>

<!-- ZReading Sale Modal-->
<div class="modal" id="ZReading" tabindex="-1" role="dialog" aria-labelledby="ZReadingModal" style="margin-top: 10%" >
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body pa5 text-center">
      	<h5 class="fsize16">Proceed with Z-Reading?</h5>
      </div>
      <div class="modal-footer pa10">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        <a href="<?php echo site_url('sales_con/z_reading') ?>" class="btn btn-primary btn-sm">Continue</a>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="SSale" tabindex="-1" role="dialog" aria-labelledby="SuspendSalesModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="SuspendSalesModal">Are you sure you want to suspend this sale?</p>
      </div>
      <div class="modal-footer pa10">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
        <a href="<?php echo site_url('sales_con/suspend') ?>" class="btn btn-danger btn-sm yes">Suspend Sale</a>
      </div>
    </div>
  </div>
</div>

<!-- Add Product -->
<div class="modal" id="ProductList" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title text-center" id="creditModalLabel">Product List</h4>
      </div>
      <div class="modal-body table-responsive">
      	<table class="table table-condensed table-bordered nm" id="MTable">
      		<thead>
      			<tr>
      				<th>Name</th>
      				<th>Quantity</th>
      				<th>Price</th>
      				<th width="100" >button</th>
      			</tr>
      		</thead>
	      	<tbody>
	      	</tbody>
      	</table>
      </div>
    </div>
  </div>
</div>

<!-- Change Modal -->
<div class="modal" id="SComplete" tabindex="-1" role="dialog" aria-labelledby="SCompleteModal" style="margin-top: 10%" aria-multiselectable="false">
  <div class="modal-dialog modal-sm" role="document">
    <form action="<?php echo site_url('sales_con/complete_sale') ?>" method="POST" accept-charset="utf-8" class="modal-content">
      <div class="modal-body">
        <!-- <h4 class="modal-title" id="SCompleteModal">Change: <span><?php echo ($this->session->userdata('sum_details') ?  'P ' . (strpos($this->session->userdata('sum_details')[3], "." ) !== false ? $this->session->userdata('sum_details')[3]: $this->session->userdata('sum_details')[3] . '.00') : ''); ?></span></h4> -->
      	<div class="row form-group">
      		<label for="invoice" class="col-xs-4 pr0 pt5 fsize12">Receipt Type: </label>
      		<div class="col-xs-8">
	      		<select name="invoice" id="invoice" class="form-control input-sm">
	      			<option value="sales">Sales Invoice</option>
	      			<option value="delivery">Delivery Invoice</option>
	      			<option value="credit">Credit Invoice</option>
	      		</select>
      		</div>
      	</div>
      	<div class="collapse in" data-toggle="collapse" id="sales" data-parent="#SComplete">
    			<label for="si">Sales Invoice: </label>
    			<input type="text" name="sales_invoice" id="si" class="form-control input-sm" autocomplete="off">
      	</div> 	
      	<div class="collapse" data-toggle="collapse" id="delivery" data-parent="#SComplete">
    			<label for="di">Delivery Invoice: </label>
    			<input type="text" name="delivery_invoice" id="di" class="form-control input-sm" autocomplete="off">
      	</div>
      	<div class="collapse" data-toggle="collapse" id="credit" data-parent="#SComplete">
    			<label for="ci">Credit Invoice: </label>
    			<input type="text" name="credit_invoice" id="ci" class="form-control input-sm" autocomplete="off">
      	</div>
      </div>
      <div class="modal-footer pa10">
      	<div class="row">
      		<div class="col-xs-offset-6 col-xs-3 pr5">
      			<!-- <button type="submit" class="btn btn-default btn-sm btn-block">Print</button> -->
      		</div>
      		<div class="col-xs-3 pl0">
      			<button type="submit" class="btn btn-primary btn-sm btn-block">Ok</button>
      		</div>
      	</div>
        <!-- <a href="<?php echo site_url('sales_con/complete_sale') ?>" type="button" class="btn btn-primary btn-sm btn-block yes">OK</a> -->
      </div>
    </form>
  </div>
</div>

<?php $this->load->view('sidebar/customer/addCustomer_modal'); ?>
<script src="<?php echo base_url('public/js/moment.js')?>"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/selectize.min.js"></script>
<script src="<?php echo base_url('public/js/bootstrap-datetimepicker.min.js')?>"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/sales.js"></script>
<?php if($this->session->userdata('sum_details')[3] <= 0 && gettype($this->session->userdata('sum_details')[3]) != 'NULL'): ?>
	<script>
		$(document).ready(function() {
			$('#STable').unbind('click');
			$('[href~=#SComplete]').focus();
		});
	</script>
<?php endif; ?>

