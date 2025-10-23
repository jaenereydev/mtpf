<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Inventory Module</h3>        
        <button type="button" data-toggle="modal" data-target="#myModal1" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">Generate Count</button>              
        <button type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-warning pull-right" style="margin-right: 5px;" data-backdrop="static" data-keyboard="false">Print Count Sheet</button>              
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->               
        
        <!-- Modal -->
        <form role="form" method="post" action="<?=site_url('inventory_con/insertinv')?>">
        <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" href="/mtpf/inventory_con/inventoryview"  type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Supplier</h4>
                </div>                               
                    <div class="modal-body">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group row row-offcanvas">
                            <label class="control-label">Supplier Name</label>                            
                        </div>  
                        <div class="form-group row row-offcanvas">                            
                            <select name="s_no" class="btn btn-default dropdown-toggle col-md-12" data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value="0">--All--</option>
                                    <?php for($s=0;$s<count($sup);$s++) { ?>
                                    <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                                    <?php } ?>
                            </select>
                        </div>                         
                        <div class="form-group row row-offcanvas">
                            <label class="control-label">Category</label>                            
                        </div>  
                        <div class="form-group row row-offcanvas">                            
                            <select name="c_no" class="btn btn-default dropdown-toggle col-md-12" data-toggle="dropdown" aria-expanded="true" required>                                                                 
                                    <option value="0">--All--</option>
                                    <?php for($c=0;$c<count($cat);$c++) { ?>
                                    <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->description;?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" href="/mtpf/inventory_con/inventoryview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success">Generate Count</button>
                    </div>
                    </div> 
            </div>
          </div>
        </div>     
        </form>
        <!-- End of model --> 
        
        <!-- Modal -->
        <form role="form" method="post" action="<?=site_url('inventory_con/printcountsheet')?>">
        <div id="myModal2" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">              
                    <a title="Close" href="/mtpf/inventory_con/inventoryview" type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Supplier</h4>
                </div>                               
                    <div class="modal-body">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group row row-offcanvas">
                            <label class="control-label">Supplier Name</label>                            
                        </div>  
                        <div class="form-group row row-offcanvas">                            
                            <select name="s_no" class="btn btn-default dropdown-toggle col-md-12" data-toggle="dropdown" aria-expanded="true" required>                                                                 
                                    <option value="0">--All--</option>
                                    <?php for($s=0;$s<count($sup);$s++) { ?>
                                    <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                                    <?php } ?>
                            </select>
                        </div>                         
                        <div class="form-group row row-offcanvas">
                            <label class="control-label">Category</label>                            
                        </div>  
                        <div class="form-group row row-offcanvas">                            
                            <select name="c_no" class="btn btn-default dropdown-toggle col-md-12" data-toggle="dropdown" aria-expanded="true" required>                                                                 
                                    <option value="0">--All--</option>
                                    <?php for($c=0;$c<count($cat);$c++) { ?>
                                    <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->description;?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" href="/mtpf/inventory_con/inventoryview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success">Generate Count</button>
                    </div>
                    </div> 
            </div>
          </div>
        </div>  
        </form>
        <!-- End of model -->
        
        <div class="panel-body">              
            <table class="table table-hover atable-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                <tr class="info">                                    
                    <td class="text-center"><strong>Action</strong></td>
                    <td class="text-center"><strong>#</strong></td> 
                    <td class="text-center"><strong>Date</strong></td>                        
                    <td class="text-center"><strong>Supplier Name</strong></td> 
                    <td class="text-center"><strong>Posted</strong></td> 
                </tr> 
                </thead>
                <tbody>
                <?php for($i=0; $i<count($inv); $i++) { ?>    
                <?php if($inv[$i]->posted == "POSTED") { ?>
                <tr class="success">   
                <?php }else { ?>
                <tr >
                <?php }?>
                    <td class="text-center">
                        <?php if($inv[$i]->filestat == "OPEN") { ?>
                        File is OPEN
                        <?php if($users[0]->position == "Administrator") { ?>
                        <a title="Close" href="/mtpf/inventory_con/closeinv/<?php echo $inv[$i]->i_no;?>" class="btn btn-info">CLOSE</a>
                        <?php }}else {?>
                            <?php if($inv[$i]->posted == "POSTED") { ?>
                            <a type="button" title="View" href="/mtpf/inventory_con/invinsertview/<?php echo $inv[$i]->i_no;?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>                        
                            <a type="button" title="Print" href="/mtpf/inventory_con/printinv/<?php echo $inv[$i]->i_no;?>" onclick="return confirm('Do you want to Print this Document?');" class="glyphicon glyphicon-print btn btn-default"></a>
                            <?php }else { ?>
                                <a title="Edit" href="/mtpf/inventory_con/editinv/<?php echo $inv[$i]->i_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                                <a type="button" title="Delete" href="/mtpf/inventory_con/delinv/<?php echo $inv[$i]->i_no;?>" onclick="return confirm('Do you want to Delete this Document?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                        
                                <?php if($inv[$i]->posted == "POSTED") { ?>
                                <a type="button" title="Print" href="/mtpf/inventory_con/printinv/<?php echo $inv[$i]->i_no;?>" onclick="return confirm('Do you want to Print this Document?');" class="glyphicon glyphicon-print btn btn-default"></a>
                                <?php }else { ?> 
                                    <?php if($inv[$i]->date == null || $inv[$i]->date == "" || $inv[$i]->posted == "POSTED") {}else { ?>
                                    <a type="button" title="POST" href="/mtpf/inventory_con/postinv/<?php echo $inv[$i]->i_no;?>" onclick="return confirm('Do you want to Post this Document?');" class="btn btn-success">POST</a>
                            <?php } }}} ?>
                    </td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $inv[$i]->ref_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $inv[$i]->date;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($inv[$i]->s_no == null || $inv[$i]->s_no == ""){ echo "ALL Supplier";}else {for($s=0;$s<count($sup);$s++){if($inv[$i]->s_no == $sup[$s]->s_no){ echo $sup[$s]->s_no; echo " ";  echo $sup[$s]->name;}}}?></td>
                    <td class="text-center" style="text-transform: capitalize"><strong><?php echo $inv[$i]->posted;?></strong></td>
                </tr>
                <?php } ?>                                        
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
