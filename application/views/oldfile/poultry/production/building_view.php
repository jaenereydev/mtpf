<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-xs-10 main pl0 pr5">
  <?php if ($this->session->flashdata('notif')): ?>
  	<div class="alert alert-<?php echo $this->session->flashdata('notif')[0] ?> mb10 pa10" role="alert"> 
  		<?php echo $this->session->flashdata('notif')[1] ?>
  	</div>
  	<script>
  		setTimeout(function(){ $('.alert').addClass('hidden')}, 2000);
  	</script>
  <?php endif ?>
  <div class="panel panel-default">
    <div class="panel-heading fsize16 pa5">
    	<div class="panel-toolbar">
    		<!-- <a href="<?php echo site_url('consumption_con') ?>" class="btn btn-primary btn-sm">Proceed to Consumption </a> -->
        <!-- <a href="<?php echo site_url('classifying_con') ?>" class="btn btn-primary btn-sm">Proceed to Classifying </a> -->
        <a href="<?php echo site_url('production_con') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Production List</a>
    	</div>
      <div class="panel-title">
        <span class="glyphicon glyphicon-adjust"></span> Add Production
      </div>
      <div class="panel-toolbar">
      </div>
    </div>
    <div class="panel-body">
      <div class="row pl5">
        <form form="<?php echo site_url('production_con/add_production') ?>" method="GET" accept-charset="utf-8" class="col-xs-4 form-inline mb15">
          <label for="type" class="pt5">TYPE : </label>
          <select name="type" id="type" class="form-control input-sm ml15" style="width: 150px;">
            <?php foreach ($type as $value): ?>
              <option value="<?php echo ucwords($value->type) ?>" <?php if($input == ucwords($value->type)) echo 'Selected';?> ><?php echo $value->type ?></option>
            <?php endforeach ?>
          </select>
          <button class="btn btn-default btn-sm">Filter</button>
        </form>
      </div>
  		<style>
  			table td {
  				vertical-align: middle !important;
  			}
  		</style>
      <div class="row pl5 pr5">
        <div class="col-xs-7">             
					<table class="table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th>Building Number</th>
								<th>Building Name</th>
								<th>Capacity</th>
								<th>Chicken Age</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result as $key => $value): ?>
								<tr>
									<td><?php echo $value->building_no ?></td>
									<td><?php echo ($value->buildingname ? ucwords($value->buildingname) : '-') ?></td>
									<td><?php echo $value->capacity ?></td>
									<td><?php echo $value->chickenage ?></td>
									<td> 
                    <!-- <span class="btn btn-info btn-sm" title="Edit"><span class="glyphicon glyphicon-pencil"></span></span> -->
                    <span href="#AddProd" role="tab" data-toggle="tab" data-id="<?php echo $value->b_no?>"data-age="<?php echo $value->chickenage?>"  class="btn btn-primary btn-sm"> Add 
                      <span class="glyphicon glyphicon-chevron-right"></span>
                    </span> 
                  </td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
        <div class="col-xs-5">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane pt5" id="AddProd">
              <form action="<?php echo site_url('production_con/save') ?>" method="POST" accept-charset="utf-8" class="panel panel-default" id="AddForm">
                <div class="panel-heading pt5 pb5">
                  <div class="panel-title">
                    Production Form
                  </div>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <div class="row">
                      <label for="time" class="col-xs-3 pr0 pt5">Time: </label>
                      <div class="col-xs-9">
                        <div class="input-group">
                          <input type="text" name="time" id="time" class="form-control input-sm dateTimePicker" aria-describedby="iconTime" required>
                          <span class="input-group-addon" id="iconTime"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label for="qty" class="col-xs-3 pr0 pt5">Quantity: </label>
                      <div class="col-xs-9">
                        <input type="number" name="qty" id="qty" class="form-control input-sm"  required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group hide" >
                    <div class="row">
                      <label for="" class="col-xs-3 pr0 pt5">Age</label>
                      <div class="col-xs-9">
                          <input type="number" name="age" id="age" class="form-control input-sm" min="0"  >  
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label for="receive" class="col-xs-3 pr0 pt5">Received By: </label>
                      <div class="col-xs-9">
                        <div class="input-group">
                          <input type="text" style="text-transform: capitalize;" name="receive" id="receive" class="form-control input-sm" aria-describedby="iconUser" required>
                          <span class="input-group-addon" id="iconUser"><span class="glyphicon glyphicon-user"></span></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label for="poultry" class="col-xs-3 pr0 pt5">Poultry</label>
                      <div class="col-xs-9">
                        <select name="poultry" id="poultry" class="form-control input-sm" required>
                          <option value=""></option>
                          <?php foreach ($poultry as $key => $value): ?>
                            <option value="<?php echo $value->pp_no ?>"><?php echo $value->name ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer text-right">
                  <input type="hidden" name="id">
                  <span class="btn btn-default btn-sm" id="cancel">Cancel</span>
                  <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
			</div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url('public/js/moment.js')?>"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/bootstrap-datetimepicker.min.js')?>"></script> 
<script>
  var url = '';
  var hideTab = function(){
    setTimeout(function() {
        $('.tab-pane').removeClass('active')
    }, 1);
    $('[href~=#AddProd]').removeClass('active'); 
    $('#AddForm')[0].reset();
  }
  $('.dateTimePicker').datetimepicker({format: 'LT'});
  
  $('[href~=#AddProd]').click(function(event) {
    var button = $(this).data('id')
    var age = $(this).data('age')
    $('[name~=id]').val(button)
    $('[name~=age]').val(age)
    $('[href~=#AddProd]').not($(this).toggleClass('active')).removeClass('active');
    if(!$('[href~=#AddProd]').hasClass('active'))
     hideTab()
  });

  $('#datatable').DataTable({
    "sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>',
    fnDrawCallback : function() {
      hideTab()
    }
  });
  
  $('#cancel').click(function(event) {
   hideTab()
  });
</script>

