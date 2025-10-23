<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-barcode" ></span> Product List / Category
            </h3>        
        <div class="panel-toolbar text-right">  
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info" >New</button>              
            <a href="<?php echo site_url('supplier_con') ?>" type="button" class="btn btn-success" style="padding-right: 5px;" >Supplier</a>               
        </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>                         
                        <td class="text-center"><strong>Name</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($cat as $key => $item): ?>                     
                    <tr> 
                        <td class="text-center">

                           <button title="Edit" 
                                data-cno="<?php echo $item->c_no;?>"
                                data-name="<?php echo $item->name;?>"
                                data-toggle="modal" data-target="#cat-edit" 
                                class="glyphicon glyphicon-pencil btn btn-info cat-edit"></button>
                        
                           <a type="button" title="Delete" href="<?=site_url('category_con/delcategory/'.$item->c_no)?>" onclick="return confirm('Do you want to delete this Category?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                           
                                                   
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->c_no ?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name;?></td>  
                    </tr>
                    <?php endforeach;  ?>   
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->    
        
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Category</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('Category_con/insertcategory')?>">                    
            <div class="modal-body">  
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Category Name" required autocomplete="off">
                    </div>                            
                </div>
                
            </div>
            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('category_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
  </div>
</div> <!-- End of model -->

 <!-- Modal -->
<div id="cat-edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                    
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Category</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('Category_con/updatecategory')?>">                    
            <div class="modal-body">  
                 <input id="cno" class="form-control input-sm hide" type="text" name="cno">
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-5">
                        <input id="name" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Category Name" required autocomplete="off">
                    </div>                            
                </div>
                
            </div>
            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('category_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
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
            $(document).on('click', '.cat-edit', function(event) {
                var cno = $(this).data('cno');
                var name = $(this).data('name');
                $(".modal-body #cno").val( cno );
                $(".modal-body #name").val( name );
            });
        });
}
</script>