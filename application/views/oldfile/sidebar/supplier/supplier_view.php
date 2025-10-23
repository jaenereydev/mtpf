<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list-alt" ></span> Supplier List
            </h3>        
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">New</button>        
        <a  title="Print" type="button" data-toggle="modal" data-target="#report" class="btn btn-default glyphicon glyphicon-print pull-right" style="margin-right: 5px" ></a>        
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->        

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" href="/mtpf/supplier_con/supplierview" onclick="return confirm('Do you want to cancel');" type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Supplier</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('supplier_con/insertsupplier')?>">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                    <div class="modal-body">
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Supplier Name</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Name"  required autofocus autocomplete="off">
                            </div>                            
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-9">
                                <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="address" placeholder="address" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Tel No.</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="telno" placeholder="Telephone Number" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Sales Man</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="salesman" placeholder="Sales Man"  autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Contact Number</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="contactno" placeholder="Contact Number" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Email Address</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="email" name="email" placeholder="Email Address" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Terms</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="terms" placeholder="terms" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Discount 1</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="discount1" placeholder="Dsicount 1" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Discount 2</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="discount2" placeholder="Discount 2" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" href="/mtpf/supplier_con/supplierview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->
        
        <div class="panel-body">  
           
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable" >                                                
                <thead>
                    <tr class="info">            
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>                         
                        <td class="text-center"><strong>Supplier Name</strong></td>                       
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($sup); $i++) { ?>                    
                    <tr>    
                        <td class="text-center info">
                            <a title="Edit" href="/mtpf/supplier_con/supplierinfo/<?php echo $sup[$i]->s_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <a type="button" title="Delete" href="/mtpf/supplier_con/delsupplier/<?php echo $sup[$i]->s_no;?>/<?php echo $users[0]->u_no;?>" onclick="return confirm('Do you want to delete the User?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $sup[$i]->s_no;?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $sup[$i]->name;?></td>                        
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
                <h4 class="modal-title"><span class="glyphicon glyphicon-print" style="font-size: 20px;padding-right: 10px;"></span>Supplier Report</h4>
            </div>                                    
            <div class="modal-body">
                <div class="form-group row row-offcanvas">
                <a style="margin-left: 10px" title="Print" href="/mtpf/supplier_con/allsupplierprint" type="button" class="pull-left btn-lg btn-info glyphicon glyphicon-print" > Print</a>                                
                <a style="margin-right: 10px" title="Export to Excel" href="/mtpf/supplier_con/allsupplierprintexcel" class="pull-right btn-lg btn-success glyphicon glyphicon-print " > Excel</a>                                        
                </div>
            </div>               
        </div>
      </div>
    </div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>