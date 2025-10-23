<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-xs-10 main pl0 pr5">
 <?php if ($this->session->flashdata('notif')): ?>
  	<div class="alert alert-<?php echo $this->session->flashdata('notif')[0] ?> mb10" role="alert"> 
  		<?php echo $this->session->flashdata('notif')[1] ?>
  	</div>
  	<script>
  		setTimeout(function(){ $('.alert').addClass('hidden')}, 2000);
  	</script>
  <?php endif ?>
  <div class="panel panel-default">
    <div class="panel-heading fsize16 pa5">
    	<div class="panel-title">
	       <span class="glyphicon glyphicon-scale"></span> Add Consumption
    	</div>
    	<div class="panel-toolbar text-right">
    	</div>
    </div>
		<style>
			table td {
				vertical-align: middle !important;
			}
		</style>
    <div class="panel-body">
      <div class="row mb15">
        <form action="<?php echo site_url('consumption_con/add_consumption') ?>" method="get" accept-charset="utf-8" class="col-xs-8 form-inline">
          <label for="typeSelect" class="">Type: </label>
          <select name="type" id="typeSelect" class="form-control input-sm ml15" style="width: 150px;">
            <?php foreach ($type as $key => $value): ?>
              <option value="<?php echo $value->type ?>"<?php if($input == ucwords($value->type)) echo 'Selected';?>><?php echo $value->type ?></option>
            <?php endforeach ?>
          </select>
          <input type="submit" class="btn btn-default btn-sm" value="Filter">
        </form>
      </div>
    	<div class="row pl5 pr5">
    		<div class="col-xs-7">
    			<table class="table table-bordered table-hover table-condensed" id="CTable">
						<thead>
							<tr>
								<th width="140">Building Number</th>
								<th>Building Name</th>
								<th>Capacity</th>
								<th>Age</th>
								<th width="45"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result as $key => $value): ?>
								<tr>
									<td><?php echo $value->building_no ?></td>
									<td><?php echo ($value->buildingname ? ucwords($value->buildingname) : '-') ?></td>
									<td><?php echo $value->capacity ?></td>
									<td><?php echo $value->chickenage ?></td>
									<td> <span href="#AddCon" data-toggle="tab" data-id="<?php echo $value->b_no ?>" class="btn btn-primary btn-sm">Add <span class="glyphicon glyphicon-chevron-right"></span></span> </td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
    		</div>
        <div class="col-xs-5 pl0">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane pt5" id="AddCon">
              <div class="panel panel-default">
                <div class="panel-heading pa5">
                  <form action="<?php echo site_url('consumption_con/post_addCon') ?>" method="POST" accept-charset="utf-8" class="row" id="AddInfo">
                    <div class="col-xs-6 pr5">
                      <select name="prod" class="form-control input-sm" required>
                        <option value="">Product List</option>
                        <?php foreach ($product as $key => $value): ?>
                          <option value="<?php echo $value->p_no ?>"><?php echo ucwords($value->longdesc) ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-4 pl0 pr5">
                      <input type="number" name="qty" class="form-control input-sm" min="0" placeholder="Quantity" required>
                    </div>
                    <div class="col-xs-2 pl0">
                      <input type="submit" class="btn btn-primary btn-sm btn-block" value="Insert">
                    </div>
                  </form>
                </div>
                <table class="table table-condensed">
                  <thead>
                    <th>Product Name</th>
                    <th width="150">Quantity</th>
                    <th width="45"></th>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
                </table>
                <form action="<?php echo site_url('consumption_con/post_addCon') ?>" method="POST" accept-charset="utf-8" class="panel-footer text-right pa5" id="AddForm">
                  <span class="btn btn-default btn-sm" id="cancel">Cancel</span>
                  <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>
			</div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script>
  var url = $('#AddInfo').attr('action');

  var hideTab = function(){
    setTimeout(function() {
        $('.tab-pane').removeClass('active')
    }, 1);
    $('[href~=#AddCon]').removeClass('active'); 
    $('#AddInfo')[0].reset();
  }

  $('[href~=#AddCon]').click(function(event) {
    var button = $(this).data('id'),
        action = url + '/' + button;
        console.log(action)
    $('#AddForm').attr('action', action);
    $('[href~=#AddCon]').not($(this).toggleClass('active')).removeClass('active');
    if(!$('[href~=#AddCon]').hasClass('active'))
     hideTab()
  });

  $('#CTable').DataTable({
    "sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>',
    fnDrawCallback : function() {
      hideTab()
    }
  });
  
  $('#cancel').click(function(event) {
   hideTab()
  });

  $('#AddInfo').submit(function(event) {
    var select = $('[name~=prod] option:selected'),
        id = select.val(),
        text = select.text(),
        val = $('[name~=qty]').val();
        html = '<tr><td>' + text + '</td><td>' + val + '</td><td><button type="submit" class="btn btn-danger btn-sm trash" data-id="' + id + '"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
    $('#tbody').append(html);
    $.post('ajax_addCon', {data: [id, val]});

    $(this)[0].reset();
    event.preventDefault();
  });

  $(document).on('click', '.trash', function(event) {
    $.post('ajax_removeCon', {id: $(this).data('id')});
    $(this).closest('tr').remove();
    event.preventDefault();
  });
</script>