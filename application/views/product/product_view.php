<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-barcode" ></span> Product List
            </h3>        
        <div class="panel-toolbar text-right">  
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info " >New</button> 
            <a href="<?php echo site_url('Inventory_con') ?>" type="button" class="btn btn-default " >Inventory</a> 
            <a href="<?php echo site_url('category_con') ?>" type="button" class="btn btn-warning " >Category</a> 
            <a href="<?php echo site_url('supplier_con') ?>" type="button" class="btn btn-success" style="padding-right: 5px;" >Supplier</a>
        </div>

        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <!--alert barcode-->
            <?php if($alertbarcode == null){}else { ?>
                <div class="form-group row row-offcanvas" id="message">
                    <label style="font-size: 30px" class="col-sm-12 control-label text-danger text-center"><?php echo $message; ?></label>                          
                </div>  
            <?php } ?>

            <!-- product search -->
            <?php if($prod == null){ ?>
                <!-- product search form -->
                <form role="form" method="post" action="<?=site_url('product_con/productsearch')?>">                    
                       
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-2 control-label">Product Search</label>
                        <div class="col-sm-5">
                            <input  class="form-control input-md" type="text" name="psearch" placeholder="Barcode / Product Name "  required autofocus autocomplete="off">
                        </div>   
                        <div class="col-sm-1">
                            <button title="Search" type="Submit" class="btn btn-success" >Search</button>
                        </div>          
                        <label style="font-size:20px" class="col-sm-4 control-label text-center"><strong>Product Count - <?php echo number_format((float)$product[0]->p,0,'.',','); ?></stong></label>                
                    </div>  
                </form>   
            <?php }else { ?>

            <!-- product search form -->
            <form role="form" method="post" action="<?=site_url('product_con/productsearch')?>">         
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">Product Search</label>
                    <div class="col-sm-5">
                        <input  class="form-control input-md" type="text" name="psearch" placeholder="Barcode / Product Name "  required autofocus autocomplete="off">
                    </div>   
                    <div class="col-sm-4">
                        <button title="Search" type="Submit" class="btn btn-success" >Search</button>
                    </div>                         
                </div>  
            </form> 
            <hr>  

            <!-- product table -->
             <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>                         
                        <td class="text-center"><strong>Name</strong></td>   
                        <td class="text-center"><strong>Qty</strong></td>   
                        <td class="text-center"><strong>SRP</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($prod as $key => $item): ?>                     
                    <tr> 
                        <td class="text-center">
                            <a title="Edit" href="<?=site_url('product_con/productinfo/'.$item->p_no)?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <?php if($users[0]->position == "Cashier"){}else { ?>
                                <a type="button" title="Delete" href="<?=site_url('product_con/delproduct/'.$item->p_no)?>" onclick="return confirm('Do you want to delete this Product?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                            <?php } ?>
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name;?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty;?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->srpprice,2,'.',',');?></td>  
                    </tr>
                    <?php endforeach;  ?>   
                </tbody>
            </table> 
            <?php } ?>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

       
        
<!--Product insert Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Product</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('product_con/insertproduct')?>">                    
            <div class="modal-body">   

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Barcode</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="barcode" placeholder="barcode"  required autofocus autocomplete="off">
                    </div>                            
                </div>  
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Product Name"  required autocomplete="off">
                    </div>                            
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Unit Cost</label>
                    <div class="col-sm-5">
                        <input  class="form-control input-sm" type="number" min="0" step="any" name="unitcost" placeholder="Unit Cost"  required autocomplete="off">
                    </div>                            
                </div>                                                                               
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Price 1</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="number" step="any" name="price1" placeholder="Price 1" autocomplete="off" required>
                    </div>
                </div> 

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Price 2</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="number" step="any" name="price2" placeholder="Price 2" autocomplete="off" required>
                    </div>
                </div> 

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Price 3</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="number" step="any" name="price3" placeholder="Price 3" autocomplete="off" required>
                    </div>
                </div>                                                                                
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Supplier</label>
                    <div class="col-sm-5">
                        <select name="sno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value=""> --Please Select--</option>
                            <?php for($s=0;$s<count($sup);$s++) { ?>
                            <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                            <?php } ?>
                        </select>  
                    </div>
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Category</label>
                    <div class="col-sm-5">
                        <select name="cno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value=""> --Please Select--</option>
                            <?php for($c=0;$c<count($cat);$c++) { ?>
                            <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->name;?></option>
                            <?php } ?>
                        </select>  
                    </div>
                </div>   
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Track Inventory</label>
                    <div class="col-sm-5">
                        <select name="ti" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>  
                    </div>
                </div> 

            </div>
            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('product_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
    </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
<script>
window.onload = function()
{  
    setTimeout(function() {
    $('#message').fadeOut();
    }, 3000 );
}
</script>