<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-shopping-cart"></span> View Purchase Order
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <input class="form-control input-sm hide" type="text" name="po_no1"  value="<?php echo $po[0]->po_no; ?>" required autocomplete="off">
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <p class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" ><?php if($po[0]->date == null){echo date('m/d/Y');}else{ echo $po[0]->date;}?></p>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    
                </div> 
                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <p id="ref_no1" class="form-control input-sm" type="text" name="ref_no1" ><?php echo $po[0]->ref_no; ?></p>
                </div>
                <label class="col-sm-1 control-label">Delivery Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <p  class="form-control input-sm" type="text" name="deliverydate1" id="fbirthday" ><?php if($po[0]->deliverydate == null){echo date('m/d/Y');}else{ echo $po[0]->deliverydate;}?></p>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                    </div>
                    
                </div> 
            </div>
            
            <div class="form-group row row-offcanvas">                
                <label class="col-sm-2 control-label">Supplier Name</label>
                <div class="col-sm-5">                                        
                    <p class="form-control input-sm" style="text-transform: capitalize;"><?php for($s=0;$s<count($supactive);$s++) { if($po[0]->s_no == $supactive[$s]->s_no){echo $supactive[$s]->name; }}?></p>                                      
                </div>                                                   
            </div>
 
            <div style="height: 250px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                                                                
                <tr class="info">                                                          
                    <td class="text-center"><strong>Product Name</strong></td> 
                    <td class="text-center"><strong>UOM</strong></td> 
                    <td class="text-center"><strong>QTY</strong></td>     
                    <td class="text-center"><strong>PCS</strong></td>     
                    <td class="text-center"><strong>Unit Price</strong></td> 
                    <td class="text-center"><strong>Total Amount</strong></td> 
                    
                </tr> 
                <?php for($i=0; $i<count($pol); $i++) { ?>                               
                <tr>                                        
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pol[$i]->longdesc;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pol[$i]->uom;echo " "; echo $pol[$i]->packing;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$pol[$i]->qty,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$pol[$i]->pcs,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$pol[$i]->unitprice,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$pol[$i]->totalamount,2,'.',',');?></td>                                
                </tr>
                <?php } ?>                                                                          
            </table>
            </div>           
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-1 control-label">Remarks</label>
                    <div class="col-sm-3">
                        <p style="text-transform: capitalize;" class="form-control input-sm"><?php echo $po[0]->remarks;?></p>
                    </div>
                    <label class="col-sm-1 control-label">Total Qty</label>
                    <div class="col-sm-3">
                        <p style="text-transform: capitalize;" class="form-control input-sm" type="text" name="number1" step="any" ><?php echo number_format((float)$polsum[0]->totalqty,2,'.',',');?></p>                      
                    </div>
                    <label class="col-sm-1 control-label">Total Amount</label>
                    <div class="col-sm-3">
                        <p style="text-transform: capitalize;" class="form-control input-sm" type="text" name="number2" step="any"><?php echo number_format((float)$polsum[0]->totalamount,2,'.',',');?></p>                        
                    </div>
                </div>                        

                <div class="modal-footer">
                    <a title="Close" href="/mtpf/purchaseorder_con/orderingview" type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>                                                                  
                </div>
            </form>        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->