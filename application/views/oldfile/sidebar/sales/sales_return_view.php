<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<style>
  table td{
    vertical-align: middle !important;
    text-align: center;
  }

  .list-group > li{
    padding: 6px 12px;
  }
  
  #STable tbody tr{
    cursor: pointer;
  }

  label {
    font-size: 13px;
  }
</style>
<div class="col-xs-7 main pl0 pr0">
	<div class="panel panel-default">
    <div class="panel-heading fsize16" style="padding: 6px 12px;">
      <div class="panel-toolbar text-left">
        <a title="Dashboard" class="btn btn-default btn-sm" href="<?php echo site_url('sales_con')?>"><span class="glyphicon glyphicon-chevron-left"></span> Back to POS</a>
      </div>
      <div class="panel-title pl15">
        <span class="glyphicon glyphicon-repeat"></span> Sales Return
      </div>
      <div class="panel-toolbar text-right">
      </div>
    </div>
    <div class="panel-body">
      <table class="table table-condensed table-bordered nm" id="STable">
        <thead>
          <tr>
            <td width="50"></td>
            <td>Item Name</td>
            <td width="150">Price</td>
            <td width="150">Quantity</td>
            <td width="150">Total</td>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(sizeof($this->session->userdata('SalesReturn'))):
              foreach ($this->session->userdata('SalesReturn') as $key => $value): 
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
                <td><?php echo ucwords($value->longdesc); ?></td>
                <td>
                  <span data-toggle="tooltip" data-placement="top" title="<?php echo $value->label[0]; ?>" > P <?php echo number_format($value->$price, 2, '.', ','); ?> </span>
                  <strong class="pull-right pr15"><?php echo $value->label[1] ?></strong>
                </td>
                <td><?php echo $value->quantity; ?></td>
                <td>P <?php echo number_format($value->$price, 2, '.', ','); ?></td>
              </tr>
          <?php endforeach;
            else: ?>
              <tr class="noItem">
                <td colspan="7">No item</td>
              </tr>
          <?php endif?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="panel panel-default">
    <form class="panel-body pa5 form-inline nm toggler" action="<?php echo site_url('sales_return_con/select_item') ?>" id="PSearch">
      <label for="">Quantity: </label>
      <input type="number" name="qty" id="qty" class="ml5 form-control input-sm toggler" min="0" placeholder="1" autofocus="" required="">

      <button class="btn btn-primary btn-sm toggler ">Add Product</button>
    </form>
  </div>
</div>
<div class="col-xs-3">
  <form action="<?php echo site_url('sales_return_con/complete_return') ?>" method="POST" accept-charset="utf-8" class="panel panel-default" id="ReturnForm">
    <ul class="list-group mb0">
      <li class="list-group-item hideThis <?php if(!$this->session->userdata('SalesSum')) echo 'hidden' ?>">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-6">
            <span data-toggle="modal" data-target="#CReturn" class="btn btn-danger btn-block btn-sm">Cancel Return</span>
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
        Total Quantity: <span class="pull-right price"><?php echo (isset($sum[0]) ? $sum[0] : '') ?></span>
      </li>
      <li class="list-group-item bg-success">
        <strong class="text-success">Total:</strong> <strong class="pull-right text-success price"><?php echo (isset($sum[1]) ? 'P ' . number_format($sum[1], 2, '.', ',') : '') ?></strong>
      </li>
      <li class="list-group-item">
        <strong >Amount Due:</strong> <strong class="pull-right text-success price"><?php echo (isset($sum[1]) ? 'P ' . number_format($sum[1], 2, '.', ',') : '') ?></strong>
      </li>
      <li class="list-group-item pa5 hideThis <?php if(!$this->session->userdata('SalesSum')) echo 'hidden' ?>">
        <span data-toggle="modal" data-target="#RComplete" class="btn btn-success btn-block btn-sm">COMPLETE RETURN</span>
      </li>
    </ul>
  </form>
</div>

<div class="modal" id="ProductList" tabindex="-1" role="dialog" aria-labelledby="productListModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="productListModal">Product List</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-condensed table-bordered nm" id="MTable">
          <thead>
            <tr>
              <td>Product Name</td>
              <td>Quantity</td>
              <td>Retial Price</td>
              <td width="100"></td>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(sizeof($products)):
                foreach ($products as $key => $item): ?>
                <tr>
                  <td><?php echo $item->longdesc ?></td>
                  <td><?php echo $item->qty ?></td>
                  <td><?php echo $item->price1 ?></td>
                  <td><button class="btn btn-primary btn-sm btn-block product-list" data-id="<?php echo $item->p_no; ?>" data-dismiss="modal">Select</button></td>
                </tr>
            <?php endforeach;
              else: ?>
                <tr>
                  <td colspan="4">There are no products.</td>
                </tr>
            <?php endif?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="CReturn" tabindex="-1" role="dialog" aria-labelledby="CancelReturnModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="CancelReturnModal">Are you sure you want to cancel this Return?</p>
      </div>
      <div class="modal-footer pa10">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
        <a href="<?php echo site_url('sales_return_con/reset') ?>" class="btn btn-danger btn-sm yes">Cancel Sale</a>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="SDelete" tabindex="-1" role="dialog" aria-labelledby="ReturnDeleteLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="ReturnDeleteLabel">Are you sure you want to remove this item?</p>
      </div>
      <div class="modal-footer pa10">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger btn-sm yes" id="dbutton">Delete Item</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="RComplete" tabindex="-1" role="dialog" aria-labelledby="ReturnCompleteLabel" style="margin-top: 10%">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="ReturnCompleteLabel">Proceed with the process?</p>
      </div>
      <div class="modal-footer pa10">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btn-sm yes" id="CompeleteBtn">Yes</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('sidebar/customer/addCustomer_modal'); ?>

<script type="text/javascript" src="<?php echo base_url('public/js/datatables.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/selectize.min.js')?>"></script>
<script>
	$(document).ready(function() {
    $('#datatables').DataTable();
		$('#MTable').DataTable();
    $('#searchCustomer').selectize({
      create: false,
      sortField: 'text',
      maxItems: 1,
      maxOptions: 10
    });
	});

  $('#STable').on('click', 'button', function(event) {
    var id = $(this).closest('tr').data('id');
    $('#dbutton').data('id', id);
  });

  $(document).keyup(function(event) {
    var Selector = $('#STable tbody');
    var hasClass = Selector.find('tr').hasClass('success');
    if(hasClass){
      var tr = Selector.find('.success');
      var $id = tr.data('id');

      if(event.keyCode == 69){
        $.post('sales_return_con/price_changer', {id: $id}, function(data) {
          updater(JSON.parse(data), tr);
        });
      } else if (event.keyCode == 68){
        $.post('sales_return_con/price_changer', {discount: $id}, function(data) {
          updater(JSON.parse(data), tr);
        });
      }
    }
  });

  $('#SDelete').on('click', '.btn-danger', function(event) {
    var id = $(this).data('id')
    $.post('sales_return_con/remove_selected', {id: id}, function(data) {
      totalUpdater(JSON.parse(data));
    });

    $('#STable [data-id~=' + id +']').remove();

    if($('#STable').find('tr').length == 1){
      $('#STable tbody').append('<tr class="noItem"><td colspan="7">No item</td></tr>')
      $('body').find('.hideThis').each(function(index, el) {
          $(this).addClass('hidden')
      });
    }

    $('#SDelete').modal('hide');
  });

  $('#PSearch').submit(function(event) {
    event.preventDefault();
    $('#ProductList').modal('show');
  });

  $('.product-list').click(function(event) {
    var id  = $(this).data('id'),
        qty = $('#qty').val(),
        url = $('#PSearch')[0].action,
        $table = $('#STable tbody');
        console.log(qty)

    $.post(url, {id: id, qty: qty}, function(data) {
      data = JSON.parse(data);

      $table.append(data[0]);

      if($table.find('.noItem').length == 1)
        $table.find('.noItem').remove();

      totalUpdater(data[1]);

      if($('#STable tbody tr td').length != 1){
       $('body').find('.hideThis').each(function(index, el) {
          if($(this).hasClass('hidden'))
            $(this).removeClass('hidden')
        });
      }

      $('[data-toggle~=tooltip]').tooltip();
    });

    $('#qty').val('');
  });

  $('#addCustomer').submit(function(event) {
    event.preventDefault();
    var data = $(this).serialize();
    $.post('customer_con/ajax_insertCustomer', {data: data}, function(data) {
      var selectize = $('#searchCustomer').selectize(),
          data = JSON.parse(data);
          selectize[0].selectize.addOption(data);
          selectize[0].selectize.addItem(data['value']);
    });

    $('#myModal').modal('hide');
    $(this)[0].reset();
    return false;
  });

  $('#STable').on('click', 'tr', function(event) {
    var id = $(this).closest('tbody').find('.success').toggleClass('success').data('id');
    if(id != $(this).data('id'))
      $(this).toggleClass('success');

    $('[data-toggle="tooltip"]').tooltip('hide');
  });

  $('.modal').on('shown.bs.modal', function (e) {
    $(this).find('.yes').focus();
  })

  $('[data-toggle~=tooltip]').on('show.bs.tooltip', function () {
    $('[data-toggle="tooltip"]').not(this).tooltip('hide');
  })

  $('#CompeleteBtn').click(function(event) {
    $('#ReturnForm').submit();
  });

  var totalUpdater = function(sum){
    $('.price').each(function(index, el) {
      if(index == 0)
        $(el).text(sum[index]);
      else
        $(el).text(isFloat(sum[index]));
    });
  }

  var updater = function(data, tr){
    totalUpdater(data[3]);
    tr.find('td:nth-child(5)').text(isFloat(data[2]));
    tr.find('td:nth-child(3) span').text(isFloat(data[1])).attr('title', data[0][0]).tooltip('fixTitle').tooltip('show');
    tr.find('td:nth-child(3) strong').text(data[0][1]);
  }

  var isFloat = function(n){
    if(n % 1 === 0)
      return 'P ' + n + ".00";
    else
      return 'P ' + n; 
  }
</script>