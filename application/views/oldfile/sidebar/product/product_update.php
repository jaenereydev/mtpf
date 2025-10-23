<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">            
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-barcode" ></span> Product Update
            </h3>                            
        </div> <!-- end of panel heading -->              
        
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?php if($activeTab == "1") { echo "active";} ?>"><a href="#productdetails" data-toggle="tab">Product Details</a></li>
            <li role="presentation" class="<?php if($activeTab == "2") { echo "active";} ?>"><a href="#priceinfo" data-toggle="tab">Price Info</a></li>
            <li role="presentation" class="<?php if($activeTab == "3") { echo "active";} ?>"><a href="#itemhistory" data-toggle="tab">Item history</a></li>
            <li role="presentation" class="<?php if($activeTab == "4") { echo "active";} ?>"><a href="#pricehistory" data-toggle="tab">Price History</a></li>
        </ul>
        
        <div class="panel-body">  
            <form role="form" method="post" action="<?=site_url('product_con/updateproduct')?>">
                <div class=" tab-content">
                    <div class="tab-pane <?php if($activeTab == "1") { echo "active";} ?>" id="productdetails">
                        <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                        <input class="form-control input-sm hide" type="text" name="p_no" value="<?php echo $prod[0]->p_no;?>" required>
                        <div class="modal-body">                            
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-2 control-label">Long description</label>
                                <div class="col-sm-5">
                                    <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="longdesc" placeholder="Long Description" value="<?php echo $prod[0]->longdesc;?>" required autofocus autocomplete="off">
                                </div>                            
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-2 control-label">Short description</label>
                                <div class="col-sm-3">
                                    <input style="text-transform: capitalize;" MAXLENGTH="35" class="form-control input-sm" type="text" name="shortdesc" placeholder="Short Description" value="<?php echo $prod[0]->shortdesc;?>"  required autocomplete="off">
                                </div>                            
                            </div>


                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-5">
                                    <select name="c_no" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                                                             
                                        <?php if(($prod[0]->cstatus) == 'DEACTIVATE'){ ?>
                                            <option value=""> --Please Select--</option>
                                            <?php for($c=0;$c<count($cat);$c++) {?>
                                                <option value="<?php echo $cat[$c]->c_no;?>"><?php echo $cat[$c]->description;?></option>
                                            <?php }?>
                                        <?php }else { for($c=0;$c<count($cat);$c++) {?>
                                        <option value="<?php echo $cat[$c]->c_no;?>" <?php if($cat[$c]->c_no == $prod[0]->c_no){echo 'selected';}?>><?php echo $cat[$c]->description;?></option>
                                        <?php }} ?>
                                    </select>  
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-5">
                                    <select name="type" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                                                             
                                        <option value="Self Production" <?php if($prod[0]->type == 'Self Production'){echo 'selected';}?>>Self Production</option>                                   
                                        <option value="Purchased" <?php if($prod[0]->type == 'Purchased'){echo 'selected';}?>>Purchased</option>
                                    </select>  
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-2 control-label">Supplier</label>
                                <div class="col-sm-5">
                                    <select name="s_no" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" >                                                             
                                        <?php if(($prod[0]->sstatus) == 'DEACTIVATE'){ ?>
                                            <option value=""> --Please Select--</option>
                                            <?php for($s=0;$s<count($sup);$s++) {?>
                                                <option value="<?php echo $sup[$s]->s_no;?>"><?php echo $sup[$s]->name;?></option>
                                            <?php }?>
                                        <?php }else { for($s=0;$s<count($sup);$s++) {?>
                                        <option value="<?php echo $sup[$s]->s_no;?>" <?php if($sup[$s]->s_no == $prod[0]->s_no){echo 'selected';}?>><?php echo $sup[$s]->name;?></option>
                                        <?php }} ?>
                                    </select>  
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-2 control-label">Unit of Measure</label>
                                <div class="col-sm-3">
                                    <input class="form-control input-sm" name="uom" type="text" value="<?php echo $prod[0]->uom;?>" >
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-2 control-label">Packing</label>
                                <div class="col-sm-3">
                                    <input class="form-control input-sm" step="any" name="packing" type="number" value="<?php echo number_format((float)$prod[0]->packing,0,'',',');?>" >
                                </div>
                            </div>    
                            
                            <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Unit Price</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" step="any" name="up" type="number" value="<?php echo number_format((float)$prod[0]->unitprice,2,'.',',');?>" > 
                            </div>
                        </div>

                        </div>

                        <div class="modal-footer">
                          <a title="Close" href="/mtpf/product_con/productview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                          <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                          <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                        </div>
                        
                    </div><!-- end of product details -->
                    
                    <div class="tab-pane <?php if($activeTab == "2") { echo "active";} ?>" id="priceinfo">
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Unit Cost</label>
                            <div class="col-sm-3">
                                <p class="form-control input-sm"><?php echo number_format($prod[0]->unitcost,2,'.',',');?></p>
                            </div>
                        </div>

                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Retail Price</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price1" placeholder="Retail Price" step="any" value="<?php if($prod[0]->price1 == null || $prod[0]->price1 == ""){ echo " ";}else {echo number_format($prod[0]->price1,2,'.',',');}?>" required autocomplete="off">
                            </div>
                        </div>    
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Wholesale Price</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price2" placeholder="Wholesale Price" step="any" value="<?php if($prod[0]->price2 == null || $prod[0]->price2 == ""){ echo " ";}else {echo number_format($prod[0]->price2,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 3</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price3" placeholder="Price 3" step="any" value="<?php if($prod[0]->price3 == null || $prod[0]->price3 == ""){ echo " ";}else {echo number_format($prod[0]->price3,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 4</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price4" placeholder="Price 4" step="any" value="<?php if($prod[0]->price4 == null || $prod[0]->price4 == ""){ echo " ";}else {echo number_format($prod[0]->price4,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 5</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price5" placeholder="Price 5" step="any" value="<?php if($prod[0]->price5 == null || $prod[0]->price5 == ""){ echo " ";}else {echo number_format($prod[0]->price5,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 6</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price6" placeholder="Price 6" step="any" value="<?php if($prod[0]->price6 == null || $prod[0]->price6 == ""){ echo " ";}else {echo number_format($prod[0]->price6,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 7</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price7" placeholder="Price 7" step="any" value="<?php if($prod[0]->price7 == null || $prod[0]->price7 == ""){ echo " ";}else {echo number_format($prod[0]->price7,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 8</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price8" placeholder="Price 8" step="any" value="<?php if($prod[0]->price8 == null || $prod[0]->price8 == ""){ echo " ";}else {echo number_format($prod[0]->price8,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 9</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price9" placeholder="Price 9" step="any" value="<?php if($prod[0]->price9 == null || $prod[0]->price9 == ""){ echo " ";}else {echo number_format($prod[0]->price9,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Price 10</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="price10" placeholder="Price 10" step="any" value="<?php if($prod[0]->price10 == null || $prod[0]->price10 == ""){ echo " ";}else {echo number_format($prod[0]->price10,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Discounted Price</label>
                            <div class="col-sm-3">
                                <input class="form-control input-sm" type="number" name="discountprice" placeholder="Discounted Price" step="any" value="<?php if($prod[0]->price11 == null || $prod[0]->price11 == ""){ echo " ";}else {echo number_format($prod[0]->price11,2,'.',',');}?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                          <a title="Close" href="/mtpf/product_con/productview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                          <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                          <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                        </div>
                        
                    </div><!-- end of price info -->
                    
                    <div class="tab-pane <?php if($activeTab == "3") { echo "active";} ?>" id="itemhistory">
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-3">
                                <p class="form-control input-sm" type="number" name="qty" ><?php echo number_format($prod[0]->qty,2,'.',',');?></p>
                            </div>
                        </div>  
                        <hr>
                        
                            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">  
                                <thead>
                                <tr class="info">                                             
                                    <td class="text-center"><strong>#</strong></td>  
                                    <td class="text-center"><strong>Date</strong></td>                         
                                    <td class="text-center"><strong>Ref. No.</strong></td>                        
                                    <td class="text-center"><strong>Description</strong></td>
                                    <td class="text-center"><strong>In</strong></td>
                                    <td class="text-center"><strong>Out</strong></td>
                                    <td class="text-center"><strong>Balance</strong></td>
                                    <td class="text-center"><strong>User</strong></td>
                                  </tr> 
                                </thead>
                                <tbody>
                                <?php for($i=0; $i<count($prodhist); $i++) { ?>                    
                                <tr>                          
                                    <td class="text-center" style="text-transform: capitalize"><?php echo $prodhist[$i]->ph_no;?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo $prodhist[$i]->date;?></td>                        
                                    <td class="text-center" style="text-transform: capitalize"><?php echo $prodhist[$i]->ref_no;?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php if($prodhist[$i]->description == 'INVENTORY'){echo "Physical Count";}else { echo $prodhist[$i]->description;}?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php if($prodhist[$i]->instock == null || $prodhist[$i]->instock == ""){}else {echo number_format((float)$prodhist[$i]->instock,2,'.',',');} ?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php if($prodhist[$i]->outstock == null || $prodhist[$i]->outstock == ""){}else {echo number_format((float)$prodhist[$i]->outstock,2,'.',',');}?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$prodhist[$i]->rqty,2,'.',',');?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php if($users[0]->u_no == $prodhist[$i]->u_no){ echo $users[0]->fname;}?></td>
                                </tr>
                                <?php } ?>    
                                </tbody>
                            </table>
                      
                        
                        <div class="modal-footer">
                          <a title="Close" href="/mtpf/product_con/productview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                          <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                          <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                        </div>
                        
                    </div><!-- end of item history -->
                    
                    <div class="tab-pane <?php if($activeTab == "4") { echo "active";} ?>" id="pricehistory">
                                                
                        
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable"> 
                            <thead>
                            <tr class="info">                                    
                                <td class="text-center"><strong>#</strong></td>
                                <td class="text-center"><strong>Requested By</strong></td>
                                <td class="text-center"><strong>Date</strong></td>                        
                                <td class="text-center"><strong>Effective Date</strong></td> 
                                <td class="text-center"><strong>Posted</strong></td> 
                            </tr> 
                            </thead>
                            <tbody>
                            <?php for($i=0; $i<count($pc); $i++) { ?>                                
                            <tr>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $pc[$i]->ref_no;?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $pc[$i]->requestedby;?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $pc[$i]->date;?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $pc[$i]->effectivedate;?></td>
                                <td class="text-center" style="text-transform: capitalize"><strong><?php echo $pc[$i]->stat;?></strong></td>
                            </tr>
                            <?php } ?> 
                            </tbody>
                        </table>
                        
                        <div class="modal-footer">
                          <a title="Close" href="/mtpf/product_con/productview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                          <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                          <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                        </div>
                    
                    </div><!-- end of price history -->
                    
                </div>
            </form>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>