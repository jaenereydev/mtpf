<script type="text/javascript">

window.onload = function()
{   
    $(document).ready(function () {
        $('.edit').click(function () {                 
            var ppno = $(this).data('ppno');
            var name = $(this).data('name');
            $(".modal-body #ppno").val( ppno );
            $(".modal-body #name").val( name );
        });
    });
    
};

</script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Poultry Product List</h3>        
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">New</button>        
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->        

        <!-- Modal -->
        <form role="form" method="post" action="<?=site_url('poultryproduct_con/insertpoul')?>">
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" data-dismiss="modal" type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Poultry Product</h4>
                </div>                
                
                    <div class="modal-body">                   
                    <div class="modal-body">
                        <div class="form-group row row-offcanvas">
                            <label class="control-label">Product Name</label>
                            <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Product Name"  required autofocus autocomplete="off">                            
                        </div>                                   
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" type="button" data-dismiss="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                      
                    </div>
                    </div>                
            </div>
          </div>
        </div> <!-- End of model -->
        </form>
        
        
        <!-- Modal -->
        <form role="form" method="post" action="<?=site_url('poultryproduct_con/updatepoul')?>">
        <div id="myModal2" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" data-dismiss="modal" type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Poultry Product</h4>
                </div>                                                                 
                    <div class="modal-body">
                        <div class="modal-body">
                        <input id="ppno" class="hide" name="pp_no" required autocomplete="off">                            
                        <div class="form-group row row-offcanvas">
                            <label class="control-label">Product Name</label>
                            <input id="name" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Product Name"  required autofocus autocomplete="off">                            
                        </div>                                   
                        </div>                       
                    <div class="modal-footer">
                      <a title="Close" type="button" data-dismiss="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                      
                    </div>
                    </div> 
            </div>
          </div>
        </div> <!-- End of model -->
        </form>
        
        <div class="panel-body">             
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable" >                                                
                <thead>
                    <tr class="info">                       
                        <td class="text-center" ><strong>Action</strong></td>                    
                        <td class="text-center"><strong>Name</strong></td>
                        <td class="text-center"><strong>Qty</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($poul); $i++) { ?>                    
                    <tr>   
                        <td class="text-center info">
                            <a title="Edit" type="button" 
                               data-ppno ="<?php echo $poul[$i]->pp_no;?>"
                               data-name ="<?php echo $poul[$i]->name;?>"
                               data-toggle="modal" data-target="#myModal2" data-backdrop="static" data-keyboard="false" class="glyphicon glyphicon-pencil btn btn-info edit"></a>
                            <a type="button" title="Delete" href="/mtpf/poultryproduct_con/delpoul/<?php echo $poul[$i]->pp_no;?>" onclick="return confirm('Do you want to delete this Poultry Product?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                        </td>                    
                        <td class="text-center" style="text-transform: capitalize"><?php echo $poul[$i]->name;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $poul[$i]->qty;?></td>
                    </tr>
                    <?php } ?>                         
                </tbody>                                 
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>