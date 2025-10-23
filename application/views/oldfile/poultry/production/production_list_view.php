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
      <div class="panel-title pl10">
        <span class="glyphicon glyphicon-adjust"></span> Production List
      </div>
      <div class="panel-toolbar text-right">
        <a href="<?php echo site_url('production_con/add_production') ?>" class="btn btn-primary btn-sm">Add Production </a>
      </div>
    </div>
    <div class="panel-body">
      <div class="row pl5">
      </div>
      <style>
        table td {
          vertical-align: middle !important;
        }
      </style>
      <div class="row pl5 pr5">
        <div class="col-xs-12">
          <table class="table table-bordered table-hover table-condensed" id="MTable">
            <thead>
              <tr>
                <td width="110"></td>
                <td width="120">Building Name</td>
                <td width="100">Date</td>
                <td>Time</td>
                <td width="100">Quantity</td>
                <td>Received by</td>
                <td width="100">Poultry Product</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result as $key => $value): ?>
                <tr>
                  <td class="text-center" data-id="<?php echo $value->pr_no ?>">
                    <?php if (!$value->posted): ?>
                      <a href="#editM" data-toggle="modal"  class="btn btn-info btn-sm" title="Edit">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                      <a href="#deleteM" data-toggle="modal" class="btn btn-danger btn-sm delete" title="Delete">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                      <a href="#postM" data-toggle="modal" class="btn btn-success btn-sm post">POST</a>
                    <?php endif ?>
                  </td>
                  <td><?php echo ($value->buildingname ? $value->buildingname : '-') ?></td>
                  <td><?php echo $value->date ?></td>
                  <td><?php echo $value->time ?></td>
                  <td><?php echo $value->totalqty ?></td>
                  <td><?php echo $value->receivedby ?></td>
                  <td><?php echo $value->name ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="postM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Do you want to <abbr title="You cannot edit this document after you post">POST</abbr> this document?</h5>
      </div>
      <form action="<?php echo site_url('production_con') ?>" method="POST" accept-charset="utf-8" class="modal-footer pa5" id="postMF">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Save</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Do you want to <abbr title="You cannot retrieve this document after deleting">DELETE</abbr> this document?</h5>
      </div>
      <form action="<?php echo site_url('production_con') ?>" method="POST" accept-charset="utf-8" class="modal-footer pa5" id="deleteMF">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <form  action="<?php echo site_url('production_con') ?>" method="POST" accept-charset="utf-8" id="editMF" class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title">Edit Form</h4>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="" class="col-xs-3 pt5">Time</label>
          <div class="col-xs-9">
            <input type="text" name="time" class="form-control input-sm dateTimePicker" aria-describedby="iconTime">
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-xs-3 pt5">Quantity</label>
          <div class="col-xs-9">
            <input type="number" name="qty" class="form-control input-sm">
          </div>
        </div>
        <div class="form-group row">
          <label for="receive" class="col-xs-5 pt5">Received By: </label>
          <div class="col-xs-7 pl0">
            <input type="text" style="text-transform: capitalize;" name="receive" name="receive" id="receive" class="form-control input-sm" aria-describedby="iconUser" required="">
          </div>
        </div>
      </div>
      <div action="<?php echo site_url('production_con') ?>" method="POST" accept-charset="utf-8" class="modal-footer pa5" id="editMF">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Save</button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url('public/js/moment.js')?>"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/bootstrap-datetimepicker.min.js')?>"></script> 
<script>
  var url = $('#postMF').attr('action');
  $('#datatable').DataTable({
    "sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>'
  });
  $('.dateTimePicker').datetimepicker({format: 'LT'});

  $('.post').click(function(event) {
    var button = $(this).closest('td').data('id');
    $('#postMF').attr('action', url + '/update_postStatus/' + button);
  });

  $('.delete').click(function(event) {
    var button = $(this).closest('td').data('id');
    $('#deleteMF').attr('action', url + '/delete_prod/' + button);
  });

  $('#editM').on('show.bs.modal', function (e) {
    var tr = $(e.relatedTarget).closest('tr'),
        button = $(e.relatedTarget).closest('td').data('id'),
        td = $(tr).find('td');
    $('#editMF').attr('action', url + '/update_prod/' + button);
    $('[name~=time]').val(td[3].innerHTML)
    $('[name~=qty]').val(td[4].innerHTML)
    $('[name~=receive]').val(td[5].innerHTML)
  });

  $('#editM').on('hidden.bs.modal', function (e) {
    $('#editMF')[0].reset();
  });
</script>


