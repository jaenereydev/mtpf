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
    <div class="panel-heading fsize16 pa5 pl15">
    	<div class="panel-title">
	       <span class="glyphicon glyphicon-scale"></span> Consumption
    	</div>
    	<div class="panel-toolbar text-right">
        <a href="<?php echo site_url('consumption_con/add_consumption') ?>" class="btn btn-primary btn-sm">Add Consumption</a>
    	</div>
    </div>
		<style>
			table td {
				vertical-align: middle !important;
			}
		</style>
    <div class="panel-body" style="height: 400px;">
      <style>
        table td {
          vertical-align: middle !important;
        }
      </style>
      <div class="row">
        <div class="col-xs-7">
          <table class="table table-bordered table-hover table-condensed" id="datatable">
            <thead>
              <tr>
                <th>Date</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th width="160"></th>
              </tr>
            </thead>
            <tbody> 
              <?php foreach ($result as $key => $value): ?>
                <tr>
                  <td><?php echo $value->date; ?></td>
                  <td><?php echo $value->totalqty; ?></td>
                  <td><?php echo ($value->totalamount ? 'P ' . $value->totalamount : '') ?></td>
                  <td class="text-center" data-id="<?php echo $value->c_no; ?>">
                    <?php if (!$value->posted): ?>
                      <span data-toggle="tab" data-target="#EditCon">
                        <span class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-pencil"></span></span>
                      </span>
                      <span data-toggle="modal" data-target="#deleteM" data-change="delete_consump">
                        <span class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></span>
                      </span>
                      <span data-toggle="modal" data-target="#postM" data-change="update_post">
                        <span class="btn btn-success btn-sm">POSTED</span>
                      </span>
                    <?php else: ?>
                        <span data-toggle="modal" data-target="#viewM">
                          <span class="btn btn-info btn-sm" data-toggle="tooltip" title="View"><span class="glyphicon-fire glyphicon glyphicon-eye-open"></span></span>
                        </span>
                    <?php endif ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <div class="col-xs-5 pl0">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="EditCon">
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
                    <th width="85" class="text-center"><span class="glyphicon glyphicon-option-horizontal"></span></th>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
                </table>
                <form action="" method="POST" accept-charset="utf-8" class="panel-footer text-right pa5" id="EditForm">
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

<style>
  .highlight td {
    vertical-align: middle !important;
    text-align: center;
    padding: 5px !important;
  }

  .highlight td:nth-child(even){
    width: 150px !important;
    font-weight: 600;
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

<div class="modal fade" id="viewM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-6">
            <table class="table table-bordered highlight">
              <tr>
                <td width="100">Amount</td>
                <td class="vFill"></td>
              </tr>
            </table>
          </div>
          <div class="col-xs-6">
            <table class="table table-bordered highlight">
              <tr>
                <td width="100">Quantity</td>
                <td class="vFill"></td>
              </tr>
            </table>
          </div>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody class="vFill">
          </tbody>
        </table>
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
      <form action="<?php echo site_url('consumption_con') ?>" method="POST" accept-charset="utf-8" class="modal-footer pa5" id="postMF">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Save</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <form action="#" method="POST" accept-charset="utf-8" class="modal-content" id="editMF">
      <div class="modal-header text-center pa10">
        <h4 class="modal-title">Edit Consumption Form</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="eProduct">Product Name: </label>
          <select name="eProduct" id="eProduct" class="form-control input-sm" required>
            <?php foreach ($product as $key => $value): ?>
              <option value="<?php echo $value->p_no ?>"><?php echo ucwords($value->longdesc) ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group nm">
          <label for="eQty">Quantity: </label>
          <input type="number" name="eQty" id="eQty" class="form-control input-sm"  min="0" required>
        </div>
      </div>
      <div class="modal-footer pa5" >
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Save</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="deleteM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Do you want to <abbr title="You cannot retrieve this document after deleting">DELETE</abbr> this document?</h5>
      </div>
      <form action="<?php echo site_url('consumption_con') ?>" method="POST" accept-charset="utf-8" class="modal-footer pa5" id="deleteMF">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script>
  $('#datatable').DataTable({
    "sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>',
    fnDrawCallback : function() {
      hideTab()
    }
  });

  var url = $('#postMF').attr('action'),
      tr = '',
      index = 0,
      button = [
        '<span data-toggle="modal" data-target="#editM"><button class="btn btn-info btn-sm eEdit" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button></span> <button class="btn btn-danger btn-sm eDelete" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></button>',
        '<span class="btn btn-default btn-sm undo" data-toggle="tooltip" title="Undo"><span class="glyphicon glyphicon-share-alt"></span></span>'
      ];
  var hideTab = function(){
    setTimeout(function() {
        $('.tab-pane').removeClass('active')
    }, 1);
    // $('[href~=#AddProd]').removeClass('active'); 
    $('#AddInfo')[0].reset();
    $.post('consumption_con/reset');
  };

  (function(){
    var toggler = '[data-change]';
    $(document).on('click', toggler, function(event) {
      var $this = $(this),
          id = $this.closest('td').data('id'),
          page = $this.data('change'),
          form = $this.data('target') + 'F',
          $url = url + '/' + page + '/' + id;

      $(form).attr('action', $url);
    });
  })();

  (function(){
    var toggler = '.eEdit';
    $(document).on('click', toggler, function(event) {
      var td = $(this).closest('tr').find('td'),
          id = ($(td[0]).attr('data-pk')).split('_'),
          val = $(td[1]).text();
      $('#eQty').val(val)
      $('#eProduct').val(id[0])
      event.preventDefault();
    });
  })();

  (function(){
    var toggler = '.eDelete';
    $(document).on('click', toggler, function(event) {
      var $tr = $(this).closest('tr'),
          td = $tr.find('td');
      $tr.addClass('strikeout');
      $(td[2]).text('').append(button[1]);
      $('[data-toggle~=tooltip]').tooltip();  

      $.post('consumption_con/ajax_updateDelete', {id: $(td[0]).attr('data-pk'), del: true });
      event.preventDefault();
    });
  })();

  (function(){
    var toggler = '.undo';
    $(document).on('click', toggler, function(event) {
      var $tr = $(this).closest('tr');
      
      $tr.removeClass('strikeout');
      $(this).parent('td').text('').append(button[0])
      $.post('consumption_con/ajax_updateDelete', {id: $tr.find(' td:first-child').attr('data-pk'), del: false});
      event.preventDefault();
    });
  })();

  $('#editM').on('show.bs.modal', function (e) {
    tr = $(e.relatedTarget).closest('tr').find('td');
  });

  $('[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var id = $(e.target).parent('td').data('id')        

    $('span.btn').not($(e.target).find('.btn').toggleClass('active')).removeClass('active');
    if(!$('[data-target~=#EditCon] span.btn').hasClass('active'))
     hideTab()
   
    $.post('consumption_con/ajax_updateGet', {id: id}, function(data, textStatus, xhr) {
      $('#tbody').text('').append(JSON.parse(data));
      $('[data-toggle~=tooltip]').tooltip();  
    });

    $('#EditForm').attr('action', url + '/update_editConsump/' + id);
  })

  $('#viewM').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget).closest('td').data('id'),
        that = $(this);

    $.post('consumption_con/ajax_viewCon', {id: button}, function(data) {
      data = JSON.parse(data);
      that.find('.vFill').each(function(index, el) {
        $(el).text('').append(data[index]);
      });
    });
  });

  $('#editMF').submit(function(event) {
    var select = $('#eProduct option:selected'),
        text = select.text(),
        val = $('#eQty').val(),
        id = select.val() + '_' + ($(tr[0]).attr('data-pk')).split('_')[1];

    $(tr[0]).text(text)
    $(tr[0]).attr('data-pk', id);
    $(tr[1]).text(val);

    $.post('consumption_con/ajax_updateEdit', {data: [id, val]});
    $('#editM').modal('hide');
    event.preventDefault();
  });

  $('#AddInfo').submit(function(event) {
    index += 1;
    var select = $('[name~=prod] option:selected'),
        id = select.val() + '_' + index,
        text = select.text(),
        val = $('[name~=qty]').val();
    $.post('consumption_con/ajax_updateAdd', {id: id, val: val});
    $('#tbody').append('<tr><td data-pk="' + id + '">' + text + '</td><td>' + val + '</td><td class="text-center">' + button[0] + '</td></tr>');
    $(this)[0].reset();
    event.preventDefault();
  });

  $('#cancel').click(function(event) {
    hideTab();
  });
</script>