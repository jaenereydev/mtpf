<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list-alt" ></span> User List
            </h3>        
        <button type="button" data-toggle="modal" data-target="#adduser" class="btn btn-info pull-right">New</button>               
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>Name</strong></td>                         
                        <td class="text-center"><strong>Position</strong></td>    
                        <td class="text-center"><strong>Percentage</strong></td> 
                        <td class="text-center"><strong>Uncollectable</strong></td> 
                        <td class="text-center"><strong>Collectable</strong></td> 
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($u as $key => $item): ?>                      
                    <tr> 
                        <td class="text-center">
                            <button title="Edit" 
                                data-uno="<?php echo $item->id;?>"
                                data-name="<?php echo $item->name;?>"
                                data-username="<?php echo $item->username;?>"
                                data-password="<?php echo $item->password;?>"
                                data-position="<?php echo $item->position;?>"
                                data-percentage="<?php echo $item->percentage;?>"
                                data-collectablecommission="<?php echo $item->collectable_commission;?>"
                                data-uncollectablecommission="<?php echo $item->uncollectable_commission;?>"
                                data-toggle="modal" data-target="#user-edit" 
                                class="glyphicon glyphicon-pencil btn btn-info user-edit" ></button>
                                <?php if($item->position == "Admin") {}else { ?>
                           <a type="button" title="Delete" href="<?=site_url('User_con/deleteuser/'. $item->id)?>" onclick="return confirm('Do you want to delete this User?');" class="glyphicon glyphicon-trash btn btn-danger"></a>  <?php } ?>                                       
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->position ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->percentage ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->uncollectable_commission ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->collectable_commission ?></td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        
<!-- add user Modal -->
<div id="adduser" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
           <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert User</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('User_con/insertuser')?>">                    
            <div class="modal-body">                   
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="name" placeholder="Name"  required autocomplete="off">
                    </div>                            
                </div>  
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <input  style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="username" placeholder="username"  required autocomplete="off">
                    </div>                            
                </div>  
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input  style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="password" placeholder="password"  required autocomplete="off">
                    </div>                            
                </div>    

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Position</label>
                    <div class="col-sm-9">
                         <select name="position" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value="Admin">Admin</option>   
                            <option value="Supervisor">Supervisor</option>                                 
                            <option value="Cashier">Cashier</option>
                            <option value="Agent">Agent</option>                            
                        </select>  
                    </div>                            
                </div>  
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Percentage</label>
                    <div class="col-sm-9">
                        <input  style="text-transform: capitalize;"  class="form-control input-sm" type="number" min="0" name="percentage" placeholder="Percentage"  required autocomplete="off">
                    </div>                            
                </div>
                
            </div>
            
            <div class="modal-footer">                
              <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
  </div>
</div> <!-- End of model -->

<!-- edit user Modal -->
<div id="user-edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
           <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update User</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('User_con/updateuser')?>">                    
            <div class="modal-body">    
                <input class="form-control input-sm hide"  name="uno" id="uno" >                              
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input id="name" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="name" placeholder="Name"  required autocomplete="off">
                    </div>                            
                </div>  
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <input id="username" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="username" placeholder="username"  required autocomplete="off">
                    </div>                            
                </div>  
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input id="password" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="password" placeholder="passworde"  required autocomplete="off">
                    </div>                            
                </div>    

                 <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Position</label>
                    <div class="col-sm-9">
                         <select id="position" name="position" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value="Admin"> Admin</option>   
                            <option value="Supervisor"> Supervisor</option>                                 
                            <option value="Cashier"> Cashier</option>  
                            <option value="Agent">Agent</option>                          
                        </select>  
                    </div>                            
                </div>                                                                               
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Percentage</label>
                    <div class="col-sm-9">
                        <input id="percentage" style="text-transform: capitalize;"  class="form-control input-sm" type="number" min="0" name="percentage" placeholder="Percentage"  required autocomplete="off">
                    </div>                            
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Collectable Commission</label>
                    <div class="col-sm-9">
                        <input id="collectablecommission" style="text-transform: capitalize;"  class="form-control input-sm" type="number" min="0" step="any" name="collectablecommission" placeholder="Collectable Commission"  disabled>
                    </div>                            
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Uncollectable Commission</label>
                    <div class="col-sm-9">
                        <input id="uncollectablecommission" style="text-transform: capitalize;"  class="form-control input-sm" type="number" min="0" step="any" name="uncollectablecommission" placeholder="Uncollectable Commission" disabled>
                    </div>                            
                </div>
                                    
            </div>
            
            <div class="modal-footer">             
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
            $(document).on('click', '.user-edit', function(event) {
                var uno = $(this).data('uno');
                var name = $(this).data('name');
                var username = $(this).data('username');
                var password = $(this).data('password');
                var position = $(this).data('position');
                var percentage = $(this).data('percentage');
                var collectablecommission = $(this).data('collectablecommission');
                var uncollectablecommission = $(this).data('uncollectablecommission');
                $(".modal-body #uno").val( uno );
                $(".modal-body #name").val( name );
                $(".modal-body #username").val( username );
                $(".modal-body #password").val( password );
                $(".modal-body #position").val( position );
                $(".modal-body #percentage").val( percentage );
                $(".modal-body #collectablecommission").val( collectablecommission );
                $(".modal-body #uncollectablecommission").val( uncollectablecommission );
            });
        });
}
</script>