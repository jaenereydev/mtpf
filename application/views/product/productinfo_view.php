<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">            
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Product Information
            </h3>                            
        </div> <!-- end of panel heading -->              
        
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?php if($active == "1") { echo "active";} ?>"><a href="#productdetails" data-toggle="tab">Product Details</a></li>
            <li role="presentation" class="<?php if($active == "2") { echo "active";} ?>"><a href="#producthistory" data-toggle="tab">Product History</a></li>
        </ul>
        
        <div class="panel-body">  
            
                <div class=" tab-content">
                    
                    <div class="tab-pane <?php if($active == "1") { echo "active";} ?>" id="productdetails">
                    <form role="form" method="post" action="<?=site_url('productinfo_con/updateproduct')?>">
                                               
                        <div class="modal-body">  
                            
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Barcode</label>
                                    <div class="col-sm-5">
                                        <input class="form-control input-sm " type="text" value="<?php echo $prod[0]->barcode;?>" disabled>
                                    </div>                            
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Product Name" value="<?php echo $prod[0]->name;?>" required autofocus autocomplete="off">
                                </div>                            
                            </div>     

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-3">
                                    <input style="text-transform: capitalize;" class="form-control input-sm" type="text" placeholder="Category" value="<?php echo $prod[0]->cname;?>" disabled>
                                </div> 
                                <div class="col-sm-2">                                  
                                    <button type="button" data-toggle="modal" data-target="#category" class="btn btn-warning pull-right" >Change Category</button> 
                                </div>                            
                            </div>   

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Supplier</label>
                                <div class="col-sm-3">
                                    <input style="text-transform: capitalize;" class="form-control input-sm" type="text" value="<?php echo $prod[0]->sname;?>" disabled>                                    
                                </div>                            
                                <div class="col-sm-2">                                  
                                    <button type="button" data-toggle="modal" data-target="#supplier" class="btn btn-warning pull-right" >Change Supplier</button> 
                                </div> 
                            </div>                                                                                                                            
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Unit Cost</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="unitcost" placeholder="Unit Cost" min="0" step="any" value="<?php echo $prod[0]->unitcost; ?>" >
                                </div>
                            </div>
                            
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Price 1</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="price1" placeholder="Price" step="any" min="0" value="<?php echo $prod[0]->srpprice; ?>" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Price 2</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="price2" placeholder="Price" step="any" min="0" value="<?php echo $prod[0]->price2; ?>" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Price 3</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="price3" placeholder="Price" step="any" min="0" value="<?php echo $prod[0]->price3; ?>" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Quantity</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="qty" placeholder="Quantity" value="<?php echo $prod[0]->qty;?>" disabled>
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Track Inventory</label>
                                <div class="col-sm-5">
                                    <select name="ti" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                                        <option value="Yes" <?php if($prod[0]->inventory == 'Yes'){ echo 'selected'; } ?> >Yes</option>
                                        <option value="No" <?php if($prod[0]->inventory == 'No'){ echo 'selected'; } ?> >No</option>
                                    </select>  
                                </div>
                            </div>
                            
                        </div><!-- end of body -->

                        <div class="modal-footer">
                          <a title="Close" href="<?=site_url('product_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                          <button title="Save"  type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                        </div>
                    </form>     
                    </div><!-- end of customer details -->                    
                   
                    <div class="tab-pane <?php if($active == "2") { echo "active";} ?>" id="producthistory">                        
                             
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">      
                            <thead>
                            <tr class="info">                               
                                <td class="text-center"><strong>#</strong></td>       
                                <td class="text-center"><strong>Date</strong></td>       
                                <td class="text-center"><strong>Ref No.</strong></td>
                                <td class="text-center"><strong>Description</strong></td>
                                <td class="text-center"><strong>In</strong></td>
                                <td class="text-center"><strong>Out</strong></td>
                                <td class="text-center"><strong>Balance</strong></td>
                                <td class="text-center"><strong>User</strong></td>
                              </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($prodhistory as $key => $item): ?>                    
                            <tr>                                     
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->ph_no ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->date; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->description; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->inqty; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->outqty; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->bal; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name; ?></td>
                            </tr>
                            <?php endforeach;  ?>
                            </tbody>
                        </table>                                             
                    </div> 
                    
                     <!-- <div class="tab-pane <?php if($active == "3") { echo "active";} ?>" id="customercredithistory">                        
                             
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable">      
                            <thead>
                            <tr class="info">                               
                                <td class="text-center"><strong>#</strong></td>       
                                <td class="text-center"><strong>Date</strong></td>       
                                <td class="text-center"><strong>Ref No.</strong></td>
                                <td class="text-center"><strong>CI Amount</strong></td>
                                <td class="text-center"><strong>CI Payment</strong></td>
                                <td class="text-center"><strong>Balance</strong></td>
                              </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($cuscredithistory as $key => $item): ?>                    
                            <tr>                                     
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->cbh_no ?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->date; ?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->transaction_t_no; ?></td>                               
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->ci_amount,2,'.',',');?></td>       
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->ci_payment,2,'.',',');?></td>       
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->balance,2,'.',',');?></td>                              
                            </tr>
                            <?php endforeach;  ?>
                            </tbody>
                        </table>                                             
                    </div>  -->

                </div>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<!-- Modal -->
        <div id="category" class="modal fade" role="dialog">
          <div class="modal-dialog modal-md"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Category</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('productinfo_con/updateproductcategory')?>">                    
                    <div class="modal-body">   
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-9">
                                <select name="cno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>
                                    <?php for($c=0;$c<count($cat);$c++) { ?>
                                    <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->name;?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>          
                    </div>
                    
                    <div class="modal-footer">
                        <a title="Close" href="<?=site_url('productinfo_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->

        <!-- Modal -->
        <div id="supplier" class="modal fade" role="dialog">
          <div class="modal-dialog modal-md"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                                        
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Supplier</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('productinfo_con/updateproductsupplier')?>">                    
                    <div class="modal-body">   

                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Supplier</label>
                            <div class="col-sm-9">
                                <select name="sno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>
                                    <?php for($s=0;$s<count($sup);$s++) { ?>
                                    <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                                              
                    </div>
                    
                    <div class="modal-footer">
                        <a title="Close" href="<?=site_url('productinfo_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>  