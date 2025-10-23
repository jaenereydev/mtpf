<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list-alt" ></span> Task List
            </h3>        
            <div class="panel-toolbar text-right">
                <button type="button" data-toggle="modal" data-target="#addtask" class="btn btn-info">New</button>
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>Assign to</strong></td>  
                        <td class="text-center"><strong>Schedule</strong></td>                         
                        <td class="text-center"><strong>Description</strong></td>   
                        <td class="text-center"><strong>Status</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($task as $key => $item): ?>                      
                    <tr> 
                        <td class="text-center info">
                           <!-- <button title="Edit" 
                                data-eno="<?php echo $item->e_no;?>"
                                data-date="<?php echo date_format(date_create($item->date), 'm/d/Y');?>"
                                data-description="<?php echo $item->description;?>"
                                data-amount="<?php echo $item->amount;?>"
                                data-toggle="modal" data-target="#exp-edit" 
                                class="glyphicon glyphicon-pencil btn btn-info exp-edit" ></button> -->
                        
                           <a type="button" title="Delete" href="<?=site_url('Task_con/deletetask/'. $item->task_no)?>" onclick="return confirm('Do you want to delete this task?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                                                  
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->schedule.' - '.date_format(date_create($item->schedule_date), 'm/d/Y') ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->description ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->status ?></td>                        
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        
<!-- Modal -->
<div id="addtask" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <div class="modal-content">
        <div class="modal-header">                    
           <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Task</h4>
        </div>
        <form role="form" method="post" onsubmit="return inserttaskform(this);" action="<?=site_url('Task_con/inserttask')?>">                    
            <div class="modal-body">         
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Assign to</label>
                    <div class="col-sm-5">
                        <select name="assign" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value="">--Please Select--</option>
                            <?php for($s=0;$s<count($activeuser);$s++) { ?>
                            <option value="<?php echo $activeuser[$s]->id;?>" ><?php echo $activeuser[$s]->name;?></option>
                            <?php } ?>
                        </select>  
                    </div>
                </div>   
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Schedule Status</label>
                    <div class="col-sm-5">
                        <select name="schedule" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value="DAILY">Daily</option>
                            <option value="SCHEDULED">Scheduled</option>
                        </select>  
                    </div>
                </div>   

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Date Schedule</label>
                    <div class="col-sm-9">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="date" id="birthday" placeholder="Date"  autocomplete="off">
                    </div>                            
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="description" placeholder="Description"  required autocomplete="off">
                    </div>                            
                </div>                                                                               
                                             
            </div>
            
            <div class="modal-footer">
              <button title="Save" type="Submit" name="inserttaskbtn" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
  </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">

function inserttaskform(formObj) {            
        formObj.inserttaskbtn.disabled = true;  
        formObj.inserttaskbtn.value = 'Please Wait...';  
        return true;    
    } 

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