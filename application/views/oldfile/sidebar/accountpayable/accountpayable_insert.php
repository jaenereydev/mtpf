<script type="text/javascript">

window.onload = function()
{
	var date1= document.getElementById('birthday'); // Date 1        
        var date2 = document.getElementById('date2');   //Date          
                       
        date2.value = date1.value;                                         
	
        document.getElementById('birthday').onchange = function()
	{		
                date2.value = this.value;
	};
                
        document.getElementById('additionalamount').onchange = function()
	{
            if(this.value === null || this.value === "" || this.value === "0")
            {
                this.value = "0.0";
                var aa3 = parseFloat(this.value);
                var da3 = parseFloat($('#discountamount').val());
                var gt3 = parseFloat($('#grandtotal1').val());
                $('#grandtotal2').val((gt3+aa3)-da3).toFixed(2);
            }else 
            {
                var aa4 = parseFloat($('#additionalamount').val());
                var da4 = parseFloat($('#discountamount').val());
                var gt4 = parseFloat($('#grandtotal1').val());
                $('#grandtotal2').val((gt4+aa4)-da4).toFixed(2);
            }
            
	};
        
        document.getElementById('discountamount').onchange = function()
	{
           if(this.value === null || this.value === "" || this.value === "0")
            {
                var aa = parseFloat($('#additionalamount').val());
                this.value = "0.0";
                var da = parseFloat(this.value);
                var gt = parseFloat($('#grandtotal1').val());
                $('#grandtotal2').val((gt+aa)-da).toFixed(2);
            }else 
            {
                var aa2 = parseFloat($('#additionalamount').val());
                var da2 = parseFloat($('#discountamount').val());
                var gt2 = parseFloat($('#grandtotal1').val());
                $('#grandtotal2').val((gt2+aa2)-da2).toFixed(2);
            }
	};
        
};

</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-minus-sign"></span> Insert Account Payable
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php if($ap[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($ap[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>                    
                </div>                                 
                                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <input id="ref_no1" class="form-control input-sm" type="text" name="ref_no1"  value="<?php echo $ap[0]->ref_no; ?>" required disabled autocomplete="off">
                </div>                 
            </div>
            
            <div class="form-group row row-offcanvas">                                
                <label class="col-sm-2 control-label">Supplier Name</label>
                <div class="col-sm-5">         
                    <div class="input-group">
                    <input class="form-control input-sm" type="text" value="<?php for($s=0;$s<count($sup);$s++) { if($sup[$s]->s_no == $ap[0]->s_no) { echo $sup[$s]->name;}} ?>" required disabled autocomplete="off">                    
                    <a id="poselect" 
                       data-toggle="modal" 
                       data-target="#myModal2"
                       data-backdrop="static" 
                       data-keyboard="false" 
                       type="button" 
                       title="Select Supplier" 
                       class="btn btn-default input-group-addon"><span >...</span></a>
                    </div>
                </div> 
                <?php if($ap[0]->s_no == null || $ap[0]->s_no == ""){}else{ ?>                
                <div class="col-sm-5">                                          
                    <button  data-toggle="modal" 
                       data-target="#myModal1"
                       data-backdrop="static" 
                       data-keyboard="false" 
                       type="button"  title="ADD Delivery" class="btn btn-success glyphicon glyphicon-plus pull-right"></button>                                                    
                </div>                  
                <?php }?>
            </div>
            
            <!--Modal-->
            <div id="myModal2" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
               <div class="modal-dialog modal-lg">
               <!--             Modal content-->
               <div class="modal-content">
                   <div class="modal-header">                    
                       <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-list-alt" style="font-size: 20px;padding-right: 10px;"></span>Select Supplier</h4>
                   </div><!-- End of Modal Header -->
                  
                    <div class="modal-body">                           
                        <table class="table table-responsive table-bordered table-hover" id="MTable">                                                                
                            <thead>
                            <tr class="info">                 
                                <td class="text-center"><strong>#</strong></td>
                                <td class="text-center"><strong>Supplier Name</strong></td> 
                                <td class="text-center"><strong>ACTION</strong></td>
                            </tr> 
                            </thead>
                            <tbody>
                            <?php for($i=0; $i<count($del); $i++) { ?>                
                            <tr>
                                <td class="text-center" style="text-transform: capitalize"><?php for($o=0;$o<count($sup);$o++) { if($sup[$o]->s_no == $del[$i]->s_no) { echo $sup[$o]->s_no;}}?></td>                                                           
                                <td class="text-center" style="text-transform: capitalize"><?php for($o=0;$o<count($sup);$o++) { if($sup[$o]->s_no == $del[$i]->s_no) { echo $sup[$o]->name;}}?></td>                                                           
                                <td class="text-center">                                                            
                                    <a type="button" title="Select" href="/mtpf/accountpayable_con/selectsup/<?php echo $del[$i]->s_no;?>/<?php echo $ap[0]->ap_no;?>" class="btn btn-info">SELECT</a>
                                </td>
                            </tr>
                            <?php } ?>  
                            </tbody>
                        </table>                       
                    </div><!--End of Modal Body -->                   
               </div>
               </div>
            </div><!--   End of model -->
            
            <!--Modal-->
            <div id="myModal1" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
               <div class="modal-dialog modal-lg">
               <!--             Modal content-->
               <div class="modal-content">
                   <div class="modal-header">                    
                       <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-list-alt" style="font-size: 20px;padding-right: 10px;"></span>Select Delivery</h4>
                   </div><!-- End of Modal Header -->
                  
                    <div class="modal-body">                           
                        <table class="table table-responsive table-bordered table-hover" id="CoTable">                                                                
                            <thead>
                            <tr class="info">                                                                                                                                      
                                <td class="text-center"><strong>Ref. No.</strong></td> 
                                <td class="text-center"><strong>Date</strong></td> 
                                <td class="text-center"><strong>Total Amount</strong></td> 
                                <td class="text-center"><strong>ACTION</strong></td>
                            </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($apladd->result() as $row) { ?>                                
                            <tr>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $row->ref_no; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $row->date; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $row->totalamount; ?></td>
                                <td class="text-center">                                                            
                                    <a type="button" title="Select" href="/mtpf/accountpayable_con/selectdel/<?php echo $row->d_no;?>/<?php echo $ap[0]->ap_no;?>" class="btn btn-info">SELECT</a>
                                </td>
                            </tr>
                            <?php } ?> 
                            </tbody>
                        </table>                       
                    </div><!--End of Modal Body -->                   
               </div>
               </div>
            </div><!--   End of model -->
   
            <div style="height: 250px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                                                                
                <tr class="info">                                      
                    <td class="text-center"><strong>ACTION</strong></td>
                    <td class="text-center"><strong>Ref No.</strong></td> 
                    <td class="text-center"><strong>Delivery Date</strong></td> 
                    <td class="text-center"><strong>Total Amount</strong></td> 
                    
                </tr> 
                <?php for($i=0; $i<count($apl); $i++) { ?>                               
                <tr>                    
                    <td class="text-center">                                                
                        <a type="button" title="Delete" href="/mtpf/accountpayable_con/delaccountpayableline/<?php echo $apl[$i]->apl_no;?>/<?php echo $ap[0]->ap_no;?>" class="glyphicon glyphicon-trash btn btn-danger"></a>
                    </td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $apl[$i]->ref_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $apl[$i]->deldate;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$apl[$i]->delamount,2,'.',',');?></td>                                
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>
            <form role="form" method="post" action="<?=site_url('accountpayable_con/update_ap')?>">                
                <div class="form-group row row-offcanvas">                                   
                    <input class="form-control input-sm hide" type="text" name="date" id="date2">
                    <input class="form-control input-sm hide" type="text" name="ap_no" value="<?php echo $ap[0]->ap_no;?>">
                    <label class="col-sm-1 control-label">Remarks</label>
                    <div class="col-sm-3">
                        <input id="remarks1" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="remarks" placeholder="Remarks" value="<?php echo $ap[0]->remarks;?>" autocomplete="off">
                    </div>
                    <label class="col-sm-1 control-label">Additional amount</label>
                    <div class="col-sm-2">
                        <input id="additionalamount" style="text-transform: capitalize;" class="form-control input-sm" type="number" name="additionalamount" step="any" placeholder="Additional Amount" value="<?php if($ap[0]->additionalamount == null || $ap[0]->additionalamount == ""){echo "0";}else {echo $ap[0]->additionalamount;}?>" autocomplete="off">                        
                    </div>
                    <div class="col-sm-5">
                         <div class="form-group row row-offcanvas">
                            <label class="col-sm-4 control-label">Discount Amount</label>   
                            <div class="col-sm-8">
                                <input id="discountamount" style="text-transform: capitalize;" class="form-control input-sm" type="number" name="discountamount" step="any" placeholder="Discount Amount" value="<?php if($ap[0]->discountamount == null || $ap[0]->discountamount == ""){ echo "0";}else {echo $ap[0]->discountamount;}?>" autocomplete="off">                        
                            </div>                            
                            <label class="col-sm-4 control-label" style="padding-top: 20px;">Grand Total</label>
                            <div class="col-sm-8" style="padding-top: 20px;">
                                <input id="grandtotal2"  name="grandtotal" style="text-transform: capitalize;" class="form-control input-sm" type="text" step="any" placeholder="Grand total" value="<?php if($aplsum[0]->delamount == null || $aplsum[0]->delamount == ""){echo "0.00";}else {echo number_format((float)$aplsum[0]->delamount,2,'.','');}?>" required disabled autocomplete="off">
                                <input id="grandtotal1" name="grandtotal" style="text-transform: capitalize;" class="form-control input-sm hide" type="text" step="any"  value="<?php echo $aplsum[0]->delamount;?>" required autocomplete="off">                        
                            </div>

                         </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <a title="Close" href="/mtpf/accountpayable_con/backupdateap/<?php echo $ap[0]->ap_no;?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                    <button title="Save" type="Submit" onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                    <button title="Reset" type="reset" onclick="return confirm('Do you want to Reset');" class="btn btn-warning glyphicon glyphicon-refresh" ></button>                    
                </div>
            </form>        
        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>