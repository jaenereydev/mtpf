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
    <div class="panel-heading fsize16 pa10">
    	<div class="panel-toolbar">
        <a href="<?php echo site_url('classifying_con') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Classifying List</a>
    	</div>
      <div class="panel-title text-left">
         Classifying
      </div>
      <div class="panel-toolbar"> </div>
    </div>
		<style>
			table td {
				vertical-align: middle !important;
			}
		</style>
    <div class="panel-body">
      <style>
        table td {
          vertical-align: middle !important;
        }
      </style>
      <div class="row">
        <form action="<?php echo site_url('classifying_con/add_classifying') ?>" method="GET" accept-charset="utf-8" class="col-xs-12 form-inline">
          <label for="bType">TYPE: </label>
          <select name="type" id="bType" class="form-control input-sm">
            <?php foreach ($type as $key => $value): ?>
              <option value="<?php echo $value->type;?>" <?php if($input == $value->type) echo 'selected' ?>><?php echo $value->type ?></option>
            <?php endforeach ?>
          </select>
          <button class="btn btn-default btn-sm">Filter</button>
        </form>
        <div class="col-xs-7">
          <table class="table table-bordered table-hover table-condensed" id="datatable">
            <thead>
              <tr>
                <th width="120">BLDG Number</th>
                <th>BLDG Name</th>
                <th>Capacity</th>
                <th>Age</th>
                <th>Type</th>
                <th width="20"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result as $key => $value): ?>
                <tr>
                  <td><?php echo $value->building_no ?></td>
                  <td><?php echo ($value->buildingname ? ucwords($value->buildingname) : '-') ?></td>
                  <td><?php echo $value->capacity ?></td>
                  <td><?php echo $value->chickenage ?></td>
                  <td><?php echo $value->type ?></td>
                  <td> <span href="#AddProd" role="tab" data-toggle="tab" data-id="<?php echo $value->b_no ?>" class="btn btn-primary btn-sm x">Add <span class="glyphicon glyphicon-chevron-right"></span></span> </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <div class="col-xs-5 pl0">
          <div class="tab-content pt5">
            <div role="tabpanel" class="tab-pane" id="AddProd">
              <div class="panel panel-default">
                <div class="panel-heading pa5">
                  <form action="<?php echo site_url('classifying_con/ajax_Addproduct') ?>" method="GET" accept-charset="utf-8" class="panel-toolbar" id="addRow">
                  <div class="row">
                    <div class="col-xs-6 pr5">
                      <!-- <label for="">To Product</label> -->
                      <select name="productList" class="form-control input-sm" placeholder="Product List" required>
                        <option value="">Product List</option>
                        <?php foreach ($product as $key => $value): ?>
                          <option value="<?php echo $value->p_no . '_' . $value->unitprice ?>"><?php echo ucwords($value->longdesc) ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-4 pl0 pr0">
                      <!-- <label for="">Quantity</label> -->
                      <input type="number" name="qty" class="form-control input-sm" min="0" placeholder="Quantity" required>
                    </div>
                    <div class="col-xs-2 pl5">
                      <!-- <label for="" class="invisible">Button</label> -->
                      <button type="submit" class="btn btn-primary btn-sm btn-block">Insert</button>
                    </div>
                  </div>
                  </form>
                </div>
                <form action="<?php echo site_url('classifying_con/save') ?>" method="POST" accept-charset="utf-8" id="ProdForm">
                  <table class="table table-condensed nm">
                    <thead>
                      <tr>
                        <th width="150">Name</th>
                        <th>Quantity</th>
                        <th width="45" class="text-center"><span class="glyphicon glyphicon-option-horizontal"></span></th>
                      </tr>
                    </thead>
                    <tbody id="addProdTB">
                    </tbody>
                    <tfoot>
                      <tr>
                        <td><strong>Category</strong></td>
                        <td colspan="2">
                          <select name="category" class="form-control input-sm" required>
                            <option value="">Category List</option>
                            <?php foreach ($category as $key => $value): ?>
                              <option value="<?php echo $value->c_no ?>"><?php echo ucwords($value->description) ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Poultry</strong></td>
                        <td colspan="2">
                          <select name="poultry" class="form-control input-sm" required>
                            <option value="">Poultry List</option>
                            <?php foreach ($poultry as $key => $value): ?>
                              <option value="<?php echo $value->pp_no ?>"><?php echo ucwords($value->name) ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Remarks</strong></td>
                        <td colspan="2">
                          <textarea name="remarks" id="remarks" class="form-control"></textarea>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                  <div class="panel-footer text-right pa5">
                    <input type="hidden" name="id">
                    <span class="btn btn-default btn-sm" id="cancel">Cancel</span>
                    <button class="btn btn-primary btn-sm">Save</button>
                  </div>
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
  var hideTab = function(){
    setTimeout(function() {
        $('.tab-pane').removeClass('active')
    }, 1);
    $('[href~=#AddProd]').removeClass('active'); 
    $('#addRow')[0].reset();
    $.post('reset');
  }

  $('[href~=#AddProd]').click(function(event) {
    var button = $(this).data('id')
    $('[name~=id]').val(button)
    $('#addProdTB tr').remove();
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

  $('#addRow').submit(function(event) {
    var select = $('[name~=productList] option:selected'),
        text = select.text(),
        id = select.val(),
        qty = $('[name~=qty]').val(),
        url = $(this).attr('action'),
        html = '<tr><td>' + text + '</td><td>' + qty + '</td><td></span> <span class="btn btn-danger btn-sm" title="Delete" data-id="' + id +'"><span class="glyphicon glyphicon-trash"></span></span></td></tr>'; 

    $('#addProdTB').append(html);
    $.post(url, {id: id, qty: qty});
    $(this)[0].reset();
    event.preventDefault();
  });

  $('html').on('click', '[title~=Delete]', function(event) {
    var button = $(this).data('id');
    $.post('ajax_Remove', {id: button});
    $(this).closest('tr').remove();
    event.preventDefault();
  });

  $('#cancel').click(function(event) {
   hideTab()
   
  });

  $('#ProdForm').submit(function(event) {
    var tbody = $('#addProdTB').find('tr');

    if(tbody.length){
      $(this).submit();
    }
    event.preventDefault();
  });

</script>