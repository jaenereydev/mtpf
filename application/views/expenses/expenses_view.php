<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list-alt" ></span> Expenses List
            </h3>        
            <div class="panel-toolbar text-right">
                <button type="button" data-toggle="modal" data-target="#addexpenses" class="btn btn-info">New</button>
                <a type="button" title="Dashboard" class="btn btn-default" href="<?=site_url('Sales_con/transactionlist')?>"><span class="glyphicon glyphicon-tags"></span> Transaction List</a>   
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>Date</strong></td>                         
                        <td class="text-center"><strong>Description</strong></td>   
                        <td class="text-center"><strong>Amount</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($exp as $key => $item): ?>                      
                    <tr> 
                        <td class="text-center info">
                           <button title="Edit" 
                                data-eno="<?php echo $item->e_no;?>"
                                data-date="<?php echo date_format(date_create($item->date), 'm/d/Y');?>"
                                data-description="<?php echo $item->description;?>"
                                data-amount="<?php echo $item->amount;?>"
                                data-toggle="modal" data-target="#exp-edit" 
                                class="glyphicon glyphicon-pencil btn btn-info exp-edit" ></button>
                        
                           <a type="button" title="Delete" href="<?=site_url('Expenses_con/deleteexpenses/'. $item->e_no)?>" onclick="return confirm('Do you want to delete this Expenses?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                                                  
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->description ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount,2,'.',','); ?></td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        
<!-- Modal -->
<div id="addexpenses" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
           <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Expenses</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('Expenses_con/insertexpenses')?>">                    
            <div class="modal-body">                   
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="date" id="birthday" placeholder="Date"  required autofocus autocomplete="off">
                    </div>                            
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="description" placeholder="Description"  required autocomplete="off">
                    </div>                            
                </div>                                                                               
                                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-9">
                        <input class="form-control input-sm" type="number" name="amount" placeholder="Amount" step="any" autocomplete="off" required>
                    </div>
                </div>                
            </div>
            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('Expenses_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
  </div>
</div> <!-- End of model -->

<!-- Modal -->
<div id="exp-edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
           <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Expenses</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('Expenses_con/updateexpenses')?>">                    
            <div class="modal-body">    
                <input class="form-control input-sm hide"  name="eno" id="eno" >               
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="date" id="fbirthday" placeholder="Date"  required autofocus autocomplete="off">
                    </div>                            
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <input id="description" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="description" placeholder="Description"  required autocomplete="off">
                    </div>                            
                </div>                                                                               
                                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-9">
                        <input id="amount" class="form-control input-sm" type="number" name="amount" placeholder="Amount" step="any" autocomplete="off" required>
                    </div>
                </div>                
            </div>
            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('Expenses_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
  </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">

window.onload = function()
{                   
     
         $(document).ready(function () {
            $(document).on('click', '.exp-edit', function(event) {
                var eno = $(this).data('eno');
                var date = $(this).data('date');
                var description = $(this).data('description');
                var amount = $(this).data('amount');
                $(".modal-body #eno").val( eno );
                $(".modal-body #fbirthday").val( date );
                $(".modal-body #description").val( description );
                $(".modal-body #amount").val( amount );
            });
        });
}
</script>