<script type="text/javascript">

window.onload = function()
{	      
        var uc = document.getElementById('uc');           
        var packing = document.getElementById('packing');            
    
        document.getElementById('up').onchange = function()
	{
            if(packing.value === null || packing.value === "" || packing.value === "0")
            {
                uc.value = this.value;
            }else 
            {
                var p = parseFloat($('#packing').val());
                var up1 = parseFloat($('#up').val());
                $('#uc').val(up1/p).toFixed(2);
            }
            
	};               
        
        document.getElementById('packing').onchange = function()
	{
            if(packing.value === null || packing.value === "" || packing.value === "0")
            {
                uc.value = this.value;
                uc22.value = this.value;
            }else 
            {
                var p4 = parseFloat($('#packing').val());
                var up4 = parseFloat($('#up').val());
                $('#uc').val(up4/p4).toFixed(2);
            }
            
	};      
        
};

</script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-barcode" ></span> Product List
            </h3>        
        <a  title="Print" type="button" data-toggle="modal" data-target="#report" class="btn btn-default glyphicon glyphicon-print pull-right" style="margin-left: 5px" ></a>        
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">New</button>        
        <a href="<?=site_url('pricechange_con/pricechangeview')?>"  style="margin-right: 5px;" class="btn btn-info pull-right">Price Change</a>                
        </div> <!-- end of panel heading -->        

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" href="/mtpf/product_con/productview" onclick="return confirm('Do you want to cancel');" type="button" class="close" >&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert product</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('product_con/insertproduct')?>">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                    <div class="modal-body">
                        <legend>Product Details</legend>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Long description</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="longdesc" placeholder="Long Description"  required autofocus autocomplete="off">
                            </div>                            
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Short description</label>
                            <div class="col-sm-3">
                                <input style="text-transform: capitalize;" MAXLENGTH="15" class="form-control input-sm" type="text" name="shortdesc" placeholder="Short Description"  required autocomplete="off">
                            </div>                            
                        </div>
                        
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-5">
                                <select name="c_no" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>
                                    <?php for($c=0;$c<count($cat);$c++) { ?>
                                    <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->description;?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-5">
                                <select name="type" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>  
                                    <option value="Self Production">Self Production</option>                                   
                                    <option value="Purchased">Purchased</option>
                                </select>  
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Supplier</label>
                            <div class="col-sm-5">
                                <select name="s_no" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true">                             
                                    <option value=""> --Please Select--</option>
                                    <?php for($s=0;$s<count($sup);$s++) { ?>
                                    <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Unit of Measure</label>
                            <div class="col-sm-3">
                                <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="uom" placeholder="Unit of Measure(Kg., L., M., Km., etc.)" required autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Packing</label>
                            <div class="col-sm-3">
                                <input id="packing" class="form-control input-sm" type="number" name="packing" placeholder="Piece/s Per Packaging" required autocomplete="off">
                            </div>
                        </div>     
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Unit Price</label>
                            <div class="col-sm-5">
                                <input id="up" class="form-control input-sm" type="number" name="unitprice" placeholder="Unit Price" step="any" required autocomplete="off">
                            </div>
                        </div>
                        
                        <legend>Price and Inventory</legend>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Quantity</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="qty" placeholder="Please Use the Inventory module" disabled autocomplete="off">
                            </div>
                        </div>  
                        
<!--                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Unit Cost</label>
                            <div class="col-sm-5">-->
                                <input id="uc" class="form-control input-sm hide" type="number"  name="unitcost" placeholder="Unit Cost" step="any" value="0"  autocomplete="off">                              
<!--                            </div>
                        </div>-->
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Retail Price</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price1" placeholder="Retail Price" step="any" required autocomplete="off">
                            </div>
                        </div>                                                    
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Wholesale Price</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price2" placeholder="Wholesale Price" step="any"  autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 3</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price3" placeholder="Price 3" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 4</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price4" placeholder="Price 4" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 5</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price5" placeholder="Price 5" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 6</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price6" placeholder="Price 6" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 7</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price7" placeholder="Price 7" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 8</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price8" placeholder="Price 8" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 9</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price9" placeholder="Price 9" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Price 10</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="price10" placeholder="Price 10" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Discounted Price</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="discountprice" placeholder="Discounted Price" step="any" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" href="/mtpf/product_con/productview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
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
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>                         
                        <td class="text-center"><strong>Product Name</strong></td>                        
                        <td class="text-center"><strong>Quantity</strong></td>
                        <td class="text-center"><strong>Retail Price</strong></td>
                        <td class="text-center"><strong>Wholesale Price</strong></td>  
                        <td class="text-center"><strong>Discounted Price</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($prod); $i++) { ?>    
                    <?php if($prod[$i]->qty < 0) { ?>
                    <tr class="warning"> 
                    <?php }else { ?>
                    <tr> 
                    <?php } ?>
                        <td class="text-center info">
                           <a title="Edit" href="/mtpf/product_con/productinfo/<?php echo $prod[$i]->p_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                           <?php if($users[0]->position === 'Administrator') { ?>
                           <a type="button" title="Delete" href="/mtpf/product_con/delproduct/<?php echo $prod[$i]->p_no;?>/<?php echo $users[0]->u_no;?>" onclick="return confirm('Do you want to delete the User?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                           <?php }?>
                           <a title="Print" href="/mtpf/product_con/printproductinfo/<?php echo $prod[$i]->p_no;?>" class="glyphicon glyphicon-print btn btn-default"></a>
                           <a title="Export to Excel" href="/mtpf/product_con/productinfoexcelprint/<?php echo $prod[$i]->p_no;?>" class="btn btn-default" ><img src="<?=site_url('excel.jpg')?>" style="width: 18px;"/></a>
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $prod[$i]->p_no;?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $prod[$i]->longdesc;?></td>
                        <td title="<?php echo number_format($prod[$i]->qty,2,'.',',');?>" class="text-center" style="text-transform: capitalize"><?php if(($prod[$i]->qty%$prod[$i]->packing) == '0'){echo number_format($prod[$i]->qty/$prod[$i]->packing,0,'.',','); echo ' / 0';}else{ echo number_format(floor($prod[$i]->qty/$prod[$i]->packing),0,'.',','); echo ' / '; echo number_format($prod[$i]->qty%$prod[$i]->packing,0,'.',',');}?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$prod[$i]->price1,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$prod[$i]->price2,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$prod[$i]->price11,2,'.',',');?></td>
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
                    <a style="margin-left: 10px" title="Print" href="/mtpf/product_con/allproductprint" type="button" class="pull-left btn-lg btn-info glyphicon glyphicon-print" > Print</a>                                
                    <a style="margin-right: 10px" title="Export to Excel" href="/mtpf/product_con/allproductprintexcel" class="pull-right btn-lg btn-success glyphicon glyphicon-print " > Excel</a>                                        
                    </div>
                </div>               
            </div>
          </div>
        </div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>