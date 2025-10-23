<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Category List</h3>        
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">New</button>        
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->              
        
        <div class="panel-body">            
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                    <tr class="info">   
                        <td class="text-center" ><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td> 
                        <td class="text-center"><strong>Name</strong></td>                                                
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($cat); $i++) { ?>                    
                    <tr>   
                        <td class="text-center info">
                            <a title="Edit" href="/mtpf/category_con/catinfo/<?php echo $cat[$i]->c_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <a type="button" title="Delete" href="/mtpf/category_con/delcat/<?php echo $cat[$i]->c_no;?>/<?php echo $users[0]->u_no;?>" onclick="return confirm('Do you want to delete the User?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cat[$i]->c_no;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cat[$i]->description;?></td>                        
                    </tr>
                    <?php } ?>                         
                </tbody>                               
            </table>            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<!-- Modal -->
        <form role="form" method="post" action="<?=site_url('category_con/insertcat')?>">
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" href="/mtpf/category_con/categoryview" onclick="return confirm('Do you want to cancel');" type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Category</h4>
                </div>                
                
                    <div class="modal-body">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group row row-offcanvas">
                            <label class="control-label">Category Name</label>
                            <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="description" placeholder="Category Name"  required autofocus autocomplete="off">                            
                        </div>                                   
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" href="/mtpf/category_con/categoryview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div>
                    </div>                
            </div>
          </div>
        </div> <!-- End of model -->
        </form>

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>