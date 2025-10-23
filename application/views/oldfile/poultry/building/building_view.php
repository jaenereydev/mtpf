<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"><span class="glyphicon glyphicon-home"></span> Building List</h3>        
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">New</button>        
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->        

        <!-- Modal -->
        
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" type="button" class="close"  data-dismiss="modal">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Building</h4>
                </div>                
                <form role="form" method="post" action="<?=site_url('building_con/insertbuilding')?>">
                    <div class="modal-body">                                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Building Number</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="buildingno" placeholder="Building Number" step="any" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Building Name</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="text" name="buildingname" placeholder="Building Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-5">
                                <select name="type" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>  
                                    <option value="Laying">Laying house</option>                                   
                                    <option value="Growing">Growing House</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Capacity</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="capacity" placeholder="Capacity" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" data-dismiss="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div> 
                </form>
            </div>
          </div>
        </div> <!-- End of model -->
        
        
        <div class="panel-body">           
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                <tr class="info">  
                    <td class="text-center" ><strong>Action</strong></td>
                    <td class="text-center"><strong>#</strong></td> 
                    <td class="text-center"><strong>Name</strong></td> 
                    <td class="text-center"><strong>Age</strong></td>   
                    <td class="text-center"><strong>Qty</strong></td>                       
                </tr> 
                </thead>
                <tbody>
                <?php for($i=0; $i<count($b); $i++) { ?>                    
                <tr>   
                    <td class="text-center info">
<!--                        <a title="Edit" href="/mtpf/building_con/buildinginfo/<?php echo $b[$i]->b_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                        <a type="button" title="Delete" href="/mtpf/building_con/delbuilding/<?php echo $b[$i]->b_no;?>" onclick="return confirm('Do you want to delete this Buiding?');" class="glyphicon glyphicon-trash btn btn-danger"></a>-->
                    </td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $b[$i]->building_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $b[$i]->buildingname;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $b[$i]->chickenage;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $b[$i]->qty;?></td>
                </tr>
                <?php } ?>                         
                </tbody>                                 
            </table>
            </div>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>