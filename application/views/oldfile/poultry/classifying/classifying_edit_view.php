<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/datatables.min.css')?>"/>
<div class="col-md-10 main pl0 pr5">
  <form action="<?php echo site_url('classifying_con/post_update/' . $id) ?>" method="POST" accept-charset="utf-8" class="panel panel-default">
    <div class="panel-heading fsize16 pa5 pl10">
    	<div class="panel-title">
	       Edit Classifying
    	</div>
    	<div class="panel-toolbar">
    	</div>
    </div>
    <div class="panel-body">
      <div class="col-xs-8 col-xs-offset-2"> 
        <div class="row mb15">
          <div class="col-xs-6">
            <div class="row">
              <div class="col-xs-3">
                <label class="pt5">Category: </label>
              </div>
              <div class="col-xs-9">
                <select name="category" class="form-control input-sm">
                  <?php foreach ($category as $key => $value): ?>
                    <option value="<?php echo $value->c_no ?>" <?php if($value->c_no == $result[0]->c_no) echo "selected" ?> >
                      <?php echo ucwords($value->description) ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row">
              <div class="col-xs-3">
                <label class="pt5">Poultry: </label>
              </div>
              <div class="col-xs-9">
                <select name="poultry" class="form-control input-sm">
                  <?php foreach ($poultry as $key => $value): ?>
                    <option value="<?php echo $value->pp_no; ?>" <?php if($value->pp_no == $result[0]->pp_no) echo "selected" ?> >
                      <?php echo ucwords($value->name) ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <style>
          td {
            vertical-align: middle !important;
          }

          #table td:last-child{
            text-align: center;
          }

          td {
            position: relative;
            padding: 5px 10px;
          }

          tr.strikeout td:not(:last-child):before {
            content: " ";
            position: absolute;
            top: 50%;
            left: 0;
            border-bottom: 1px solid #111;
            width: 100%;
          }

        </style>
        <table class="table table-bordered table-hover table-condensed nm" id="table">
          <thead>
            <tr>
              <th>Product Name</th>
              <th width="100">Quantity</th>
              <th class="text-center" width="83">
                <span class="glyphicon glyphicon-option-horizontal"></span>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if($result[0]->p_no):
                foreach ($result as $key => $value): ?>
                <tr>
                  <td data-pk="<?php echo $value->p_no . '_' . $value->cl_no ?>"><?php echo ucwords($value->longdesc); ?></td>
                  <td><?php echo $value->qty ?></td>
                  <td>
                    <span data-toggle="modal" data-target="#editM">
                      <span class="btn btn-info btn-sm edit" data-toggle="tooltip" title="Edit">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </span>
                    </span>
                    <span class="btn btn-danger btn-sm deleted" data-toggle="tooltip" title="Delete">
                      <span class="glyphicon glyphicon-trash"></span>
                    </span> 
                    <!-- <span class="btn btn-default btn-sm" data-toggle="tooltip" title="Undo"><span class="glyphicon glyphicon-share-alt"></span></span> -->
                  </td>
                </tr>
              <?php endforeach;
              endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td> 
                <span data-toggle="modal" data-target="#addM">
                  <span class="btn btn-primary btn-sm btn-block" data-toggle="tooltip" title="Add">
                    <span class="glyphicon glyphicon-plus"></span>
                  </span>
                </span>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="panel-footer text-right">
      <a href="<?php echo site_url('classifying_con') ?>" class="btn btn-default btn-sm">Cancel</a>
      <input type="submit" class="btn btn-primary btn-sm" value="Update">
    </div>
  </form>
</div>

<div class="modal fade" id="editM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <form action="#" class="modal-content" id="editF">
      <div class="modal-header text-center">
        <h4 class="modal-title">Edit Form</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">Product Name</label>
          <select name="product" class="form-control input-sm" required>
            <?php foreach ($product as $key => $value): ?>
              <option value="<?php echo $value->p_no ?>"><?php echo ucwords($value->longdesc) ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="">Quantity</label>
          <input type="number" name="qty" class="form-control input-sm" min="0" required>
        </div>
      </div>
      <div class="modal-footer pa5">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Save</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="addM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <form action="" method="POST" accept-charset="utf-8" class="modal-content" id="addP">
      <div class="modal-header text-center">
        <h5 class="modal-title">Add Classifying</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Product</label>
          <select id="prod" class="form-control input-sm" required>
            <?php foreach ($product as $key => $value): ?>
              <option value="<?php echo $value->p_no ?>"><?php echo ucwords($value->longdesc) ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label>Quantity</label>
          <input type="number" id="qty" class="form-control input-sm" min="0" required>
        </div>
      </div>
      <div class="modal-footer pa5">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Add</button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url('public/js/datatables.min.js')?>"></script>
<script>
  var data = {},
      index = 0,  
      button = [
        '<span class="btn btn-default btn-sm undo" data-toggle="tooltip" title="Undo"><span class="glyphicon glyphicon-share-alt"></span></span>',
        '<span data-toggle="modal" data-target="#editM"> <span class="btn btn-info btn-sm edit" data-toggle="tooltip" title="Edit"> <span class="glyphicon glyphicon-pencil"></span> </span> </span> <span class="btn btn-danger btn-sm deleted" data-toggle="tooltip" title="Delete"> <span class="glyphicon glyphicon-trash"></span> </span>'
      ];

  //DATA[0] = p_no, DATA[1] = cl_no

  $('#editM').on('show.bs.modal', function (e) {
    data.td = $(e.relatedTarget).closest('tr').find('td');
    tdFunc(data.td);

    $('[name~=product]').val(data.id[0]);
    $('[name~=qty]').val(data.text);
    console.log(data)
  });


  $('#editF').submit(function(event) {
    event.preventDefault();
    var selected = $('[name~=product] option:selected'),
        id = selected.val() + '_' + data.id[1],
        val = $('[name~=qty]').val();
    $(data.td[0]).attr('data-pk', String(id))
    $(data.td[0]).text(selected.text())
    $(data.td[1]).text(val);

    $.post('../update_editAjax', {id: id, val: val});
    $('#editM').modal('hide');
    $(this)[0].reset();
  });

  // $('#editB').click(function(event) {
   
    // $.post('../update_editAjax', {id: [selected.val(), data.id[1]), val: val});
  // });

  $(document).on('click', '.deleted', function(event) {
    data.tr = $(this).closest('tr'),
         td = data.tr.find('td');
    tdFunc(td);
    console.log(data.id);
    $(td[2]).text('').append(button[0]);
    $(data.tr).toggleClass('strikeout');
    $('[data-toggle~=tooltip]').tooltip();

    $.post('../delete_editAjax', {id: data.id, undo: 0});
  });

  $(document).on('click', '.undo', function(event) {
    data.tr = $(this).closest('tr'),
         td = data.tr.find('td');
    tdFunc(td);

    $(td[2]).text('').append(button[1]);
    $(data.tr).toggleClass('strikeout');
    $('[data-toggle~=tooltip]').tooltip();
    $.post('../delete_editAjax', {id: data.id, undo: 1});
  });

  $('#addP').submit(function(event) {
    var select = $('#prod option:selected'),
        td = {},
        tr = document.createElement('tr'),
        val = $('#qty').val();

      for (var i = 0; i < 3; i++) {
        td[i] = document.createElement('td')
      };
    index = index + 1;

    $(td[0]).attr('data-pk', select.val() + '_' + index).text(select.text());
    $(td[1]).text(val);
    td[2].innerHTML = button[1];

    $.each(td, function(index, val) {
      tr.appendChild(val);
    });

    $('#table tbody').append(tr);

    $('#addM').modal('hide');
    $(this)[0].reset();

    $.post('../update_addAjax', {id: [select.val(), index], val: val});
    event.preventDefault();
  });

  var tdFunc = function(td){
    data.id = ($(td[0]).attr('data-pk')).split('_');
    data.text = $(td[1]).text();
  }
</script>

