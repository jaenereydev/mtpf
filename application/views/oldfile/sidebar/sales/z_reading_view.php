<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.min.css') ?>">
<style>
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    appearance: none;
	    margin: 0; 
	}

	.input-group-addon {
		width: 110px;
	}
	
	.alert {
		margin-bottom: 10px !important;
		padding: 10px !important;
	}

	.close {
		margin-right: 25px;
	}
</style>
<div class="col-md-10 main pl0">
	<div class="alert alert-dismissable alert-danger hidden"> 
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
		<strong>Error: </strong> Denomination is not equal to sales, please double check your inputs. 
	</div>
  <div class="panel panel-default">
    <div class="panel-heading fsize16">
      <span class="glyphicon glyphicon-shopping-cart"></span> End of Sale
    </div>
    <div class="panel-body">
    	<div class="row">
    		<div class="col-xs-4 pr5">
		    	<ul class="list-group">
					  <li class="list-group-item"><h4>Coins</h4></li>
					  <li class="list-group-item pa10">
					  	<div class="row">
						  	<label for="" class="col-xs-4 pt5">P 25 Cents</label>
						  	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val=".25" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
					  	</div>
					  </li>
					  <li class="list-group-item pa10">
					  	<div class="row">
						  	<label for="" class="col-xs-4 pt5">P 1 Peso</label>
						  	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="1" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
					  <li class="list-group-item pa10">
					  	<div class="row">
					  		<label for=""  class="col-xs-4 pt5">P 5</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="5" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
					  <li class="list-group-item pa10">
					  	<div class="row">
					  		<label for="" class="col-xs-4 pt5">P 10</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="10" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
					</ul>
				</div>
				<div class="col-xs-4 pl0">
					<ul class="list-group">
					  <li class="list-group-item"><h4>Bills</h4></li>
					  <li class="list-group-item pa10">
					  	<div class="row">
					  		<label for="" class="col-xs-4 pt5">P 20</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="20" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
					  <li class="list-group-item pa10">
					  	<div class="row">
					  		<label for="" class="col-xs-4 pt5">P 50</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="50" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
						<li class="list-group-item pa10">
					  	<div class="row">
					  		<label for="" class="col-xs-4 pt5">P 100</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="100" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
						<li class="list-group-item pa10">
					  	<div class="row">
					  		<label for="" class="col-xs-4 pt5">P 200</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="200" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
						<li class="list-group-item pa10">
					  	<div class="row">
					  		<label for="" class="col-xs-4 pt5">P 500</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="500" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
						<li class="list-group-item pa10">
					  	<div class="row">
					  		<label for="" class="col-xs-4 pt5">P 1000</label>
							 	<div class="col-xs-8 pl0">
									<div class="input-group">
										<input type="number" class="form-control input-sm" min="0" data-val="1000" value="0">
										<span class="input-group-addon semibold" id="basic-addon2">P <span class="sum">0.00</span></span>
									</div>
								</div>
							</div>
					  </li>
					</ul>
				</div>
				<div class="col-xs-4 pl0">
					<ul class="list-group">
					  <li class="list-group-item"><h4>Total</h4></li>
					  <li class="list-group-item">
					  	<input type="text" class="form-control input-sm" id="total" readonly>
					  </li>
					</ul>
				</div>
    	</div>
    </div>
    <div class="panel-footer text-right">
    	<button class="btn btn-default btn-sm">Cancel</button>
    	<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ZReading">Continue</button>
    </div>
  </div>
</div>

<div class="modal" id="ZReading" tabindex="-1" role="dialog" aria-labelledby="ZReadingModal" style="margin-top: 10%">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <p class="modal-title" id="ZReadingModal">Proceed with the Z-Reading process?</p>
      </div>
      <!-- <form action="<?php echo site_url('expenses_con/expensesview') ?>" method="get" accept-charset="utf-8" id="ZReadingForm" class="modal-footer pa10"> -->
      <div class="modal-footer pa10">
      	<div class="btn-group">
	        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="width: 70px">No</button>
  	      <!-- <button type="button" class="btn btn-primary btn-sm" id="ZReadingButton" style="width: 70px">Ok</button> -->
  	      <a href="<?php echo site_url('expenses_con/expensesview') ?>" class="btn btn-primary btn-sm" id="ZReadingButton" style="width: 70px">Ok</a>
      	</div>
      </div>
      <!-- </form> -->
    </div>
  </div>
</div>
<script>
	$(document).ready(function() {
		var denomination = {};
		$('[type~=number]').change(function(event) {
			var $val = parseFloat($(this).data('val'));
				if(isNumeric($(this).val()) && $(this).val() != 0){
					var val = parseInt($(this).val())
					denomination[($val < 1 ? 25 : $val)] = val;
				} else {
					delete denomination[($val < 1 ? 25 : $val)];
					var val = 0;
				}
			var total = $val * val;
			$(this).val(val).next().children().text(isFloat(total));
			Total();
		});

		$('#ZReadingButton').click(function(event) {
			if($('#total').val() != 0){
				var $that = $(this);
				$.post('zreading_post', denomination, function(data) {
					// if(data != 0){
					// 	$('.alert').removeClass('hidden')
					// 	$('#ZReading').modal('hide');
					// } else
				});
			}
		});

		function isNumeric(n) {
		  return !isNaN(parseFloat(n)) && isFinite(n);
		}

		var isFloat = function(n){
			if(n % 1 === 0)
				return n + ".00";
			else
				return n; 
		}

		var Total = function(){
			var total = 0,
					amount;
			$('.sum').each(function(index, el) {
				amount = $(el).text();
				if(amount != 0){
					total += parseFloat(amount);
				}
			});
			$('#total').val('P ' + isFloat(total));
			denomination['total'] = total;
		}
	});
</script>