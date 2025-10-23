<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-road"></span> View Receiving Goods from Supplier
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <p class="form-control input-sm" type="text" ><?php if($del[0]->date == null){echo date('m/d/Y');}else{ echo $del[0]->date;}?></p>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>                    
                </div> 
                
                <label class="col-sm-1 control-label">P.O. No.</label>
                <div class="col-sm-3">                       
                    <p class="form-control input-sm" type="text" ><?php for($r=0;$r<count($rec);$r++)
                                {
                                if($del[0]->po_no == ""||$del[0]->po_no == null){}
                                else { if($rec[$r]->po_no == $del[0]->po_no)
                                        { echo $rec[$r]->ref_no;}
                                        }} ?></p>                                                                          
                </div>
                
                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <p class="form-control input-sm" type="text" ><?php echo $del[0]->ref_no; ?></p>
                </div>                 
            </div>
            
            <div class="form-group row row-offcanvas">               
                <label class="col-sm-1 control-label">Supplier Name</label>
                <div class="col-sm-5">                                                            
                    <p class="form-control input-sm" ><?php for($s=0;$s<count($supactive);$s++) { if($supactive[$s]->s_no == $del[0]->s_no) { echo $supactive[$s]->name;}} ?></p>                    
                </div>  
                <label class="col-sm-1 control-label">Doc #</label>
                <div class="col-sm-2">                                                            
                    <P class="form-control input-sm" type="text" ><?php if($del[0]->doc_no == null || $del[0]->doc_no == ""){}else { echo $del[0]->doc_no;} ?></p>                  
                </div>                
                <label class="col-sm-3 control-label" style="color: red;text-align: center;font-size: 20px;"><strong><?php if($del[0]->stat == 'PARTIALDELIVERED'){ echo "PARTIAL DELIVERED";}else{ echo $del[0]->stat;}?></strong></label>
            </div>                   
            
            <div style="height: 250px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                                                                
                <tr class="info">                                                          
                    <td class="text-center"><strong>Product Name</strong></td> 
                    <td class="text-center"><strong>UOM / PACKING</strong></td> 
                    <td class="text-center"><strong>QTY</strong></td>     
                    <td class="text-center"><strong>PCS / Kg</strong></td>     
                    <td class="text-center"><strong>Unit Price</strong></td> 
                    <td class="text-center"><strong>Total Amount</strong></td> 
                    
                </tr> 
                <?php for($i=0; $i<count($dl); $i++) { ?>                
               
                <tr>                                        
                    <td class="text-center" style="text-transform: capitalize"><?php echo $dl[$i]->longdesc;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $dl[$i]->uom;echo " "; echo $dl[$i]->packing;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$dl[$i]->qty,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$dl[$i]->pcs,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$dl[$i]->unitprice,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$dl[$i]->totalamount,2,'.',',');?></td>                                
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>                            
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-1 control-label">Remarks</label>
                    <div class="col-sm-3">
                        <p style="text-transform: capitalize;" class="form-control input-sm" ><?php echo $del[0]->remarks;?></p>
                    </div>
                    <label class="col-sm-1 control-label">Total Qty</label>
                    <div class="col-sm-3">
                        <p class="form-control input-sm" type="text" ><?php echo number_format((float)$dlsum[0]->totalqty,2,'.',',');?></p>
                        
                    </div>
                    <label class="col-sm-1 control-label">Total Amount</label>
                    <div class="col-sm-3">
                        <p style="text-transform: capitalize;" class="form-control input-sm" type="text" ><?php echo number_format((float)$dlsum[0]->totalamount,2,'.',',');?></p>                       
                    </div>
                </div>                        

                <div class="modal-footer">
                    <a title="Close" href="/mtpf/receiving_con/receivingview"  class="btn btn-info glyphicon glyphicon-arrow-left" ></a>                    
                </div>
            </form>        
        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->