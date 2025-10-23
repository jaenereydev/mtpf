<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-minus-sign"></span> View Account Payable
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <p class="form-control input-sm" type="text" ><?php if($ap[0]->date == null){echo date('m/d/Y');}else{ echo $ap[0]->date;}?></p>                                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>                    
                </div>                                 
                                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <p class="form-control input-sm" ><?php echo $ap[0]->ref_no; ?></p>
                </div>                 
            </div>
            
            <div class="form-group row row-offcanvas">                                
                <label class="col-sm-2 control-label">Supplier Name</label>
                <div class="col-sm-5">                            
                    <p style="text-transform: capitalize;" class="form-control input-sm"><?php for($s=0;$s<count($sup);$s++) { if($sup[$s]->s_no == $ap[0]->s_no) { echo $sup[$s]->name;}} ?></p>                                                                          
                </div> 
            </div>
   
            <div style="height: 250px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                                                                
                <tr class="info">                                                          
                    <td class="text-center"><strong>Ref No.</strong></td> 
                    <td class="text-center"><strong>Delivery Date</strong></td> 
                    <td class="text-center"><strong>Total Amount</strong></td> 
                    
                </tr> 
                <?php for($i=0; $i<count($apl); $i++) { ?>                               
                <tr>       
                    <td class="text-center" style="text-transform: capitalize"><?php echo $apl[$i]->ref_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $apl[$i]->deldate;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$apl[$i]->delamount,2,'.',',');?></td>                                
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>                           
                <div class="form-group row row-offcanvas">                                                       
                    <label class="col-sm-1 control-label">Remarks</label>
                    <div class="col-sm-3">
                        <p style="text-transform: capitalize;" class="form-control input-sm"><?php echo $ap[0]->remarks;?></p>
                    </div>
                    <label class="col-sm-1 control-label">Additional amount</label>
                    <div class="col-sm-2">
                        <p style="text-transform: capitalize;" class="form-control input-sm"><?php if($ap[0]->additionalamount == null || $ap[0]->additionalamount == ""){echo "0.00";}else {echo number_format((float)$ap[0]->additionalamount,2,'.',',');}?></p>                       
                    </div>
                    <div class="col-sm-5">
                         <div class="form-group row row-offcanvas">
                            <label class="col-sm-4 control-label">Discount Amount</label>   
                            <div class="col-sm-8">
                                <p style="text-transform: capitalize;" class="form-control input-sm"><?php if($ap[0]->discountamount == null || $ap[0]->discountamount == ""){ echo "0.00";}else {echo number_format((float)$ap[0]->discountamount,2,'.',',');}?></p>                     
                            </div>                            
                            <label class="col-sm-4 control-label" style="padding-top: 20px;">Grand Total</label>
                            <div class="col-sm-8" style="padding-top: 20px;">
                                <p style="text-transform: capitalize;" class="form-control input-sm"><?php if($ap[0]->grandtotal == null || $ap[0]->grandtotal == ""){ echo "0.00";}else {echo number_format((float)$ap[0]->grandtotal,2,'.',',');}?></p>                 
                            </div>

                         </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <a title="Close" href="/mtpf/accountpayable_con/accountpayableview" type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>                    
                </div>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>