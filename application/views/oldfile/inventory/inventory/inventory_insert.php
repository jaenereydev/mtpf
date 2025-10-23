<script type="text/javascript">

window.onload = function()
{
    var date1= document.getElementById('birthday'); // Date 1
    var date2 = document.getElementById('date2');   //Date 2
    var remarks1 = document.getElementById('remarks1');   //remarks 1
    var remarks2 = document.getElementById('remarks2');   //remarks 2
    
    date2.value = date1.value; 
    remarks2.value = remarks1.value;
    
    document.getElementById('birthday').onchange = function()
    {
        date2.value = this.value;
        date3.value = this.value;
    };
    
    document.getElementById('remarks1').onchange = function()
    {
        remarks2.value = this.value;
    };
    
    $('#qty').change(function() {
        var up = parseFloat($('#up').val());                 
        var packing = parseFloat($('#packing').val());   
        var qty = parseFloat($('#qty').val());    
        if($('#qty').val() === null || $('#qty').val() === "" || $('#qty').val() === "0")
        {
            $('#qty').val(0);
            $('#ta').val(0);
            $('#ta2').val(0);
            $('#pcs').val(0);
        }else 
        {
            $('#ta').val((qty*up));
            $('#ta2').val((qty*up));
            $('#pcs').val((qty*packing));   
        }
        });
    
    $('#packing').change(function() {
        var up = parseFloat($('#up').val());                 
        var packing = parseFloat($('#packing').val());   
        var qty = parseFloat($('#qty').val());    
        if($('#packing').val() === null || $('#packing').val() === "" || $('#packing').val() === "0")
        {
            $('#packing').val(1);     
            $('#pcs').val((qty));  
            $('#ta').val((qty*up));
            $('#ta2').val((qty*up));
        }else 
        {
            $('#ta').val((qty*up));
            $('#ta2').val((qty*up));
            $('#pcs').val((qty*packing));   
        }
        });
    
    $('#pcs').change(function() {
        var up = parseFloat($('#up').val());                 
        var packing = parseFloat($('#packing').val());   
        var pcs = parseFloat($('#pcs').val());    
        if($('#pcs').val() === null || $('#pcs').val() === "" || $('#pcs').val() === "0")
        {                 
            $('#pcs').val((1));  
            $('#ta').val(((up/packing)*1));
            $('#ta2').val(((up/packing)*1));
        }else 
        {
            $('#qty').val(pcs/packing);  
            $('#ta').val(((up/packing)*pcs));
            $('#ta2').val(((up/packing)*pcs));
        }
    });
    
    $(document).ready(function () {
        $(document).on('click', '.prod-edit', function(event) {
            $('span.prodname').text($(this).data('longdesc'));        
            var qty = $(this).data('qty');
            var up = $(this).data('up');
            var ilno = $(this).data('ilno');
            var ta = $(this).data('ta');
            var packing = $(this).data('packing');
            var uom = $(this).data('uom');
            var pcs = $(this).data('pcs');
            $(".modal-body #qty").val( qty );
            $(".modal-body #up").val( up );
            $(".modal-body #up2").val( up );
            $(".modal-body #ilno").val( ilno );
            $(".modal-body #ta").val( ta );
            $(".modal-body #ta2").val( ta );
            $(".modal-body #packing").val( packing );
            $(".modal-body #uom").val( uom );
            $(".modal-body #pcs").val( pcs );
        });
    });
    
};

</script>

<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
            Physical Count Module
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <input class="form-control input-sm hide" type="text" name="i_no"  value="<?php echo $inv[0]->i_no; ?>" required autocomplete="off">
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <?php if($inv[0]->posted == "POSTED") { ?>
                        <p class="form-control input-sm" ><?php if($inv[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($inv[0]->date), 'm/d/Y');}?></p>                                   
                        <?php }else {?>
                        <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php if($inv[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($inv[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                    
                        <?php }?>                        
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    
                </div> 
                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <?php if($inv[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm"><?php echo $inv[0]->ref_no; ?></p>                                      
                    <?php }else {?>
                    <input class="form-control input-sm" type="text" name="ref_no"  value="<?php echo $inv[0]->ref_no; ?>" required disabled autocomplete="off">                                        
                    <?php }?>                    
                </div>
                                
            </div>
            
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Supplier Name</label>
                <div class="col-sm-5">                    
                    <p class="form-control input-sm" style="text-transform: capitalize;"><?php if($inv[0]->s_no == null || $inv[0]->s_no == ""){ echo "ALL Supplier";}else { for($s=0;$s<count($sup);$s++){if($inv[0]->s_no == $sup[$s]->s_no){ echo $sup[$s]->name;}}}?></p>                                        
                </div> 
                
                
                <label class="col-sm-1 control-label">Remarks</label>
                <div class="col-sm-5">
                    <?php if($inv[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" style="text-transform: capitalize;"><?php echo $inv[0]->remarks; ?></p>                                
                    <?php }else {?>
                    <input id="remarks1" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="remarks"  value="<?php echo $inv[0]->remarks; ?>" required autocomplete="off">                                        
                    <?php }?>                    
                </div>
            </div>           
            
            <!--Modal-->
           <div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
               <div class="modal-dialog modal-sm">
               <!--             Modal content-->
               <div class="modal-content">
                   <div class="modal-header">                    
                       <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Quantity</h4>
                   </div><!-- End of Modal Header -->

                   <form role="form" method="post" action="<?=site_url('inventory_con/updateproduct')?>">
                       <div class="modal-body">   
                           <input  id="ilno" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="il_no" >
                           <input class="form-control input-sm hide" type="text" name="i_no"  value="<?php echo $inv[0]->i_no; ?>" >
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Product Name</label>
                               <div class="col-sm-12">
                                   <p style="text-transform: capitalize;" class="form-control input-sm"><span class="prodname"></span></p>
                               </div>
                           </div>
                           
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Unit Price</label>
                               <div class="col-sm-12">
                                   <input id="up2" style="text-transform: capitalize;" class="form-control input-sm " disabled autocomplete="off">
                                   <input id="up" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="unitprice" placeholder="Unitprice" value="" required autocomplete="off">
                               </div>
                           </div>

                           <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">UOM</label>
                                <label class="col-sm-6 control-label">Packing</label>
                                
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <div class="col-sm-6">
                                    <input id="uom" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="text" name="uom" required>
                                </div>
                                <div class="col-sm-6">
                                    <input id="packing" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number" name="packing" required>
                                </div>
                            </div>
                           
                           

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Quantity</label>
                                <label class="col-sm-6 control-label">Pcs / K.g.</label>                                                                
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <div class="col-sm-6">
                                    <input id="qty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" value="" required autocomplete="off">
                                </div>
                                <div class="col-sm-6">
                                    <input id="pcs" style="text-transform: capitalize;" class="form-control input-sm"  step="any" type="number" name="pcs" required autocomplete="off">
                                </div>                                                                
                            </div>
                           
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Total Amount</label>                                
                                <div class="col-sm-12">
                                    <input id="ta2" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number"  disabled>                              
                                    <input id="ta" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="number" name="ta" >                              
                                </div>                                                            
                            </div>

                           <div class="modal-footer">
                                 <a title="Close" data-dismiss="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                                 <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                      
                           </div>
                       </div><!--End of Modal Body -->
                   </form>  
               </div><!--end pf modal content -->
               </div>
            </div><!--   End of model -->
            
            <div style="height: 350px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                    
                <tr class="info">     
                    
                    <?php if($inv[0]->posted == "POSTED") { ?>
                    <?php }else {?>
                    <td class="text-center" ><strong>Action</strong></td> 
                    <?php }?>                    
                    <td class="text-center"><strong>Product Name</strong></td>
                    <td class="text-center"><strong>UOM</strong></td> 
                    <td class="text-center"><strong>Packing</strong></td> 
                    <td class="text-center"><strong>Unit Price</strong></td> 
                    <td class="text-center"><strong>Unit Cost</strong></td> 
                    <td class="text-center"><strong>Qty per Packing</strong></td>
                    <td class="text-center"><strong>Actual Count (Pcs/Kg)</strong></td>
                    <td class="text-center"><strong>Total Amount</strong></td> 
                </tr> 
                <?php for($i=0; $i<count($invl); $i++) { ?>                               
                <tr>           
                    <?php if($inv[0]->posted == "POSTED") { ?>
                    <?php }else {?>
                    <td class="text-center">   
                        <button type="button"                                 
                                data-ilno="<?php echo $invl[$i]->il_no;?>" 
                                data-longdesc="<?php echo $invl[$i]->longdesc;?>" 
                                data-qty="<?php echo $invl[$i]->qty;?>" 
                                data-up="<?php echo $invl[$i]->unitprice;?>"
                                data-packing="<?php echo $invl[$i]->packing;?>"
                                data-uom="<?php echo $invl[$i]->uom;?>"
                                data-pcs="<?php echo $invl[$i]->pcs;?>"
                                data-ta="<?php echo $invl[$i]->totalamount;?>"
                                data-toggle="modal" data-target="#myModal"data-backdrop="static" data-keyboard="false" title="Edit" class="glyphicon glyphicon-pencil btn btn-info prod-edit"></button>
                    </td>
                    <?php }?>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo $invl[$i]->longdesc;?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo $invl[$i]->uom;?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$invl[$i]->packing,2,'.',',');?></td>                              
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$invl[$i]->unitprice,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$invl[$i]->unitcost,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$invl[$i]->qty,2,'.',',');?></td>
                    <td class="text-center info" style="text-transform: capitalize;"><?php echo number_format((float)$invl[$i]->pcs,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$invl[$i]->totalamount,3,'.',',');?></td>                
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>
            <form role="form" method="post" action="<?=site_url('inventory_con/update_saveinv')?>">
                <input class="form-control input-sm hide" type="text" name="i_no"  value="<?php echo $inv[0]->i_no; ?>" required autocomplete="off">
                <input class="form-control input-sm hide" type="text" name="date" id="date2"  >
                <input class="form-control input-sm hide" type="text" name="remarks" id="remarks2"  >
                <div class="modal-footer">
                    <?php if($inv[0]->posted == "POSTED") { ?>
                    <a title="Close" href="/mtpf/inventory_con/inventoryview"  type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>
                    <?php }else {?>
                    <a title="Close" href="/mtpf/inventory_con/closeinv/<?php echo $inv[0]->i_no; ?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                    <button title="Save" id="submit" type="Submit"  onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                
                    <?php }?>
                </div>
            </form>  

        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->