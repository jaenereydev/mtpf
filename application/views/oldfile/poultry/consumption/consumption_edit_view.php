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
    	<div class="panel-toolbar">
        <a href="<?php echo site_url('consumption_con') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Consumption List</a>
    	</div>
      <div class="panel-title">
         Classifying
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
        <div class="col-xs-7">
          <table class="table table-bordered table-hover table-condensed" id="datatable">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
              </tr>
            </tbody>
          </table>
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
</style>
<div class="modal fade" id="viewM" tabindex="-1" role="dialog" style="margin-top: 5%">
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
