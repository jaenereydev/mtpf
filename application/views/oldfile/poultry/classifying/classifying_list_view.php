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
	       Classifying
    	</div>
    	<div class="panel-toolbar text-right">
        <a href="#AddProd" data-toggle="tab" class="btn btn-primary btn-sm">Add Classifying</a>
    	</div>
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
        <div class="col-xs-7 pl0">
          <table class="table table-bordered table-hover table-condensed" id="datatable">
            <thead>
              <tr>
                <th width="130"></th>
                <th width="120">Date</th>
                <th>Amount</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result as $key => $value): ?>
                <tr>
                  <td class="text-center" data-id="<?php echo $value->cfy_no ?>">
                    <?php if (!$value->posted): ?>
                      <a href="<?php echo site_url('classifying_con/edit_classifying/' . $value->cfy_no) ?>"  class="btn btn-info btn-sm" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                    <?php else: ?>
                      <span data-toggle="modal" data-target="#viewM" data-pk="<?php echo $value->cfy_no ?>">
                        <span class="btn btn btn-info btn-sm" data-toggle="tooltip" title="view">
                          <span class="glyphicon glyphicon-eye-open"></span>
                        </span>
                      </span>
                    <?php endif ?>
                    <?php if (!$value->posted): ?>
                      <a href="#postM" data-toggle="modal" class="btn btn-danger btn-sm" title="Delete" data-change="delete_classify"><span class="glyphicon glyphicon-trash"></span></a>
                      <a href="#postM" data-toggle="modal" class="btn btn-success btn-sm" data-change="update_postStatus">POST</a>
                    <?php endif ?>
                  </td>
                  <td><?php echo $value->date ?></td>
                  <td><?php echo $value->totalamount ?></td>
                  <td><?php echo $value->totalqty ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
         <div class="col-xs-5 pl0 pr0">
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

<div class="modal fade" id="postM" tabindex="-1" role="dialog" style="margin-top: 5%">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Do you want to <abbr title="You cannot edit this document after you post">POST</abbr> this document?</h5>
      </div>
      <form action="<?php echo site_url('classifying_con') ?>" method="POST" accept-charset="utf-8" class="modal-footer pa5" id="postMF">
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
      <form action="<?php echo site_url('classifying_con') ?>" method="POST" accept-charset="utf-8" class="modal-footer pa5" id="deleteMF">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
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
</style>
<div class="modal fade" id="viewM" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-6">
            <table class="table table-bordered highlight">
              <tr>
                <td>Category</td>
                <td class="vFill"></td>
              </tr>
            </table>
          </div>
          <div class="col-xs-6">
            <table class="table table-bordered highlight">
              <tr>
                <td>Poultry</td>
                <td class="vFill"></td>
              </tr>
            </table>
          </div>
        </div>
        <table class="table table-bordered table-condensed nm">
          <thead>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total</th>
          </thead>
          <tbody class="vFill">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script>
  var url = $('#postMF').attr('action');
  $('#datatable').DataTable({
    "sDom": '<"top">rt<"pl0 col-xs-6"i><"pr0 col-xs-6"p>',
  });

  (function(){
    var toggler = '[data-change]';
    $('body').on('click', toggler, function(event) {
      var $this = $(this),
          id = $this.closest('td').data('id'),
          page = $this.data('change'),
          form = $this.attr('href') + 'F',
          $url = url + '/' + page + '/' + id;

      $(form).attr('action', $url);
    });
  })();


  $('#viewM').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget).data('pk'),
        that = $(this);
    $.post('classifying_con/viewClassify', {id: button}, function(data) {
      data = JSON.parse(data);
      that.find('.vFill').each(function(index, el) {
        if(index == 2){
          $(el).text('').append(data[index]);
          return true;
        }
        $(el).text(data[index]);
      });
    });
  });

  var hideTab = function(){
    setTimeout(function() {
        $('.tab-pane').removeClass('active')
    }, 1);
    $('[href~=#AddProd]').removeClass('active'); 
    $('#addRow')[0].reset();
    $.post('reset');
  }

  $('[href~=#AddProd]').click(function(event) {
    // var button = $(this).data('id')
    // $('[name~=id]').val(button)
    $('#addProdTB tr').remove();
    $('[href~=#AddProd]').not($(this).toggleClass('active')).removeClass('active');
    if(!$('[href~=#AddProd]').hasClass('active'))
     hideTab()
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