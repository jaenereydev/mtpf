<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Customer List
            </h3>        
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">New</button>        
        <a  title="Print" type="button" data-toggle="modal" data-target="#report" class="btn btn-default glyphicon glyphicon-print pull-right" style="margin-right: 5px" ></a>        
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>                         
                        <td class="text-center"><strong>Customer Name</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($cus); $i++) { ?>                    
                    <tr> 
                        <td class="text-center info">
                           <a title="Edit" href="<?=site_url('studentinfo_con/addstudentsib/'.$cus[$i]->c_no)?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                        
                           <a type="button" title="Delete" href="<?=site_url('studentinfo_con/addstudentsib/'.$cus[$i]->c_no)?>" onclick="return confirm('Do you want to delete this User?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                           
                          
                           <a title="Print" href="<?=site_url('studentinfo_con/addstudentsib/'.$cus[$i]->c_no)?>" class="glyphicon glyphicon-print btn btn-default"></a>
                           <a title="Export to Excel" href="<?=site_url('studentinfo_con/addstudentsib/'.$cus[$i]->c_no)?>" class="btn btn-default" ><img src="<?=site_url('excel.jpg')?>" style="width: 18px;"/></a>
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cus[$i]->c_no;?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cus[$i]->name;?></td>  
                    </tr>
                    <?php } ?>   
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

        <!-- Modal -->
        <div id="report" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-info">                                        
                    <h4 class="modal-title"><span class="glyphicon glyphicon-print" style="font-size: 20px;padding-right: 10px;"></span>Customer Report</h4>
                </div>                                    
                <div class="modal-body">
                    <div class="form-group row row-offcanvas">
                    <a style="margin-left: 10px" title="Print" href="/mtpf/customer_con/allcustomerprint" type="button" class="pull-left btn-lg btn-info glyphicon glyphicon-print" > Print</a>                                
                    <a style="margin-right: 10px" title="Export to Excel" href="/mtpf/customer_con/allcustomerprintexcel" class="pull-right btn-lg btn-success glyphicon glyphicon-print " > Excel</a>                                        
                    </div>
                </div>               
            </div>
          </div>
        </div> <!-- End of model -->
        
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" href="/mtpf/customer_con/customerview" onclick="return confirm('Do you want to cancel');" type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Customer</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('customer_con/insertcustomer')?>">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                    <div class="modal-body">     
                        <legend>Personal Information</legend>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Customer Name"  required autofocus autocomplete="off">
                            </div>                            
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-9">
                                <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="address" placeholder="Address"  required autocomplete="off">
                            </div>                            
                        </div>                                                                               
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Tel No.</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="telno" placeholder="Telephone Number" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="Male" required>Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="Female" required>Female
                                </label>
                            </div>
                        </div>                                                
                        
                        <legend>Credit Information</legend>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Total Credit</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="totalcredit" placeholder="Total Limit" value="0" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Credit Limit</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="creditlimit" placeholder="Credit Limit" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                         <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Terms</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="terms" placeholder="Terms" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Discount %</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="discount" placeholder="Discount %" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Schedule</label>
                            <div class="col-sm-5">
                                <select name="sched" class="btn btn-default dropdown-toggle col-sm-9" data-toggle="dropdown" aria-expanded="true">                             
                                    <option value="" ></option>
                                    <option value="Monday" >Monday</option> 
                                    <option value="Tuesday" >Tuesday</option> 
                                    <option value="Wednesday" >Wednesday</option>
                                    <option value="Thursday" >Thursday</option>
                                    <option value="Friday" >Friday</option>
                                    <option value="Saturday" >Saturday</option>
                                    <option value="Sunday" >Sunday</option>
                                </select>  
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <a title="Close" href="/mtpf/customer_con/customerview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>