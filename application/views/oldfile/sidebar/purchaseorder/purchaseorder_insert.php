<script type="text/javascript">

window.onload = function()
{

	var ref_no1 = document.getElementById('ref_no1'); // Ref_no 1
        var ref_no2 = document.getElementById('ref_no2'); // Ref_no 2
        var ref_no3 = document.getElementById('ref_no3'); // Ref_no 3
        
	var date1= document.getElementById('birthday'); // Date 1
        var date2 = document.getElementById('date2');   //Date 2
        var date3 = document.getElementById('date3');   //Date 3
        
        var s_no1 = document.getElementById('s_no1');   //s_no 1
        var s_no2 = document.getElementById('s_no2');   //s_no 2
        var s_no3 = document.getElementById('s_no3');   //s_no 3
        
        var remarks1 = document.getElementById('remarks1');   //remarks 1
        var remarks2 = document.getElementById('remarks2');   //remarks 2
               
        var deliverydate1= document.getElementById('fbirthday'); // delivery date 1
        var deliverydate2 = document.getElementById('deliverydate2'); // delivery date 2  
        var deliverydate3 = document.getElementById('deliverydate3'); // delivery date 3                        
                
        s_no2.value = s_no1.value;
        s_no3.value = s_no1.value;
        
        ref_no2.value = ref_no1.value;
        ref_no3.value = ref_no1.value;
        
        date2.value = date1.value;  
        date3.value = date1.value;  
        
        deliverydate2.value = deliverydate1.value;  
        deliverydate3.value = deliverydate1.value;  
        
        remarks2.value = remarks1.value;                  
        
        
        $('#prodqty').change(function() {
        var up = parseFloat($('#produp').val());                 
        var packing = parseFloat($('#packing').val());   
        var qty = parseFloat($('#prodqty').val());    
        if($('#prodqty').val() === null || $('#prodqty').val() === "" || $('#prodqty').val() === "0")
        {
            $('#prodqty').val(0);
            $('#ta').val(0);
            $('#pcs').val(0);
        }else 
        {
            $('#ta').val((qty*up));
            $('#pcs').val((qty*packing));   
        }
        });
        
        document.getElementById('remarks1').onchange = function()
	{
		remarks2.value = this.value;
	};
	document.getElementById('fbirthday').onchange = function()
	{
		deliverydate2.value = this.value;
                deliverydate3.value = this.value;
	};
        document.getElementById('birthday').onchange = function()
	{
		date2.value = this.value;
                date3.value = this.value;
	};
        document.getElementById('s_no1').onchange = function()
	{
		s_no2.value = this.value;
                s_no3.value = this.value;
	};
        $(document).ready(function () {

            $('.prod-edit').click(function () {
                $('span.prodname').text($(this).data('longdesc'));        
                var qty = $(this).data('qty');
                var up = $(this).data('up');
                var polno = $(this).data('polno');
                var ta = $(this).data('ta');
                var packing = $(this).data('packing');
                var uom = $(this).data('uom');
                var pcs = $(this).data('pcs');
                $(".modal-body #prodqty").val( qty );
                $(".modal-body #produp").val( up );
                $(".modal-body #prodpolno").val( polno );
                $(".modal-body #ta").val( ta );
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
                <span class="glyphicon glyphicon-shopping-cart"></span> Insert Purchase Order
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <input class="form-control input-sm hide" type="text" name="po_no1"  value="<?php echo $po[0]->po_no; ?>" required autocomplete="off">
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php if($po[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($po[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    
                </div> 
                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <input id="ref_no1" class="form-control input-sm" type="text" name="ref_no1"  value="<?php echo $po[0]->ref_no; ?>" required disabled autocomplete="off">                                        
                </div>
                <label class="col-sm-1 control-label">Delivery Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                    <input  class="form-control input-sm" type="text" name="deliverydate1" id="fbirthday" placeholder="click to show datepicker" value="<?php if($po[0]->deliverydate == null){echo date('m/d/Y');}else{ echo date_format(date_create($po[0]->deliverydate), 'm/d/Y');}?>" requred autocomplete="off">                                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                    </div>                    
                </div> 
            </div>
            
            <div class="form-group row row-offcanvas">
                <form role="form" method="post" action="<?=site_url('purchaseorder_con/insertproductview')?>">
                <label class="col-sm-2 control-label">Supplier Name</label>
                <div class="col-sm-5">
                    <select id="s_no1" name="s_no1" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" autofocus required>                             
                        <option value=""> --Please Select--</option>
                        <?php for($s=0;$s<count($supactive);$s++) { ?>
                        <option value="<?php echo $supactive[$s]->s_no;?>" <?php if($po[0]->s_no == $supactive[$s]->s_no){echo 'selected';}?>><?php echo $supactive[$s]->name;?></option>
                        <?php } ?>
                    </select> 
                </div>                                     
                    
                <div class="col-sm-5">                    
                    <input class="form-control input-sm hide" type="text" name="po_no2"  value="<?php echo $po[0]->po_no; ?>" required autocomplete="off">
                    <input id="date2" class="form-control input-sm hide" type="text" name="date2"  value=""  autocomplete="off">
                    <input id="ref_no2" class="form-control input-sm hide" type="text" name="ref_no2"  value="" required autocomplete="off">                    
                    <input id="deliverydate2" class="form-control input-sm hide" type="text" name="deliverydate2"  value=""  autocomplete="off">
                    <input id="s_no2" class="form-control input-sm hide" type="text" name="s_no2"  value=""  autocomplete="off">
                    <input id="remarks2" style="text-transform: capitalize;" class="form-control input-sm hide" type="text" name="remarks2" placeholder="Remarks" value=""  autocomplete="off">
                    <input id="grandtotal2" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="totalamount" step="any" placeholder="Grand Total" value="<?php echo $polsum[0]->totalamount;?>" autocomplete="off">
                    <button type="submit" title="ADD Product" class="btn btn-success glyphicon glyphicon-plus pull-right"></button>                  
                </div>
                    
                </form>
                
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

                   <form role="form" method="post" action="<?=site_url('purchaseorder_con/updateproduct')?>">
                       <div class="modal-body">   
                           <input  id="prodpolno" style="text-transform: capitalize;" class="form-control input-sm prodpolno hide" type="number" name="pol_no" value="" required autocomplete="off">
                           <input class="form-control input-sm hide" type="text" name="po_no"  value="<?php echo $po[0]->po_no; ?>" required autocomplete="off">
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Product Name</label>
                               <div class="col-sm-12">
                                   <p style="text-transform: capitalize;" class="form-control input-sm"><span class="prodname"></span></p>
                               </div>
                           </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-12 control-label">UOM</label>
                                <div class="col-sm-12">
                                    <input id="uom" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="text" name="uom" disabled >
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-12 control-label">Packing</label>
                                <div class="col-sm-12">
                                    <input id="packing" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number" name="packing" disabled>
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-12 control-label">Unit Price</label>
                                <div class="col-sm-12">
                                    <input  id="produp" style="text-transform: capitalize;" class="form-control input-sm produp" type="number" name="unitprice" placeholder="Unitprice" value="" required disabled autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-12 control-label">Quantity</label>
                                <div class="col-sm-12">
                                    <input id="prodqty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" value="" required autofocus autocomplete="off">
                                </div>
                                <input id="ta" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="number" name="ta" >                               
                                <input id="pcs" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="number" name="pcs" >
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

            
            <div style="height: 250px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                                                                
                <tr class="info">                                      
                    <td class="text-center"><strong>ACTION</strong></td>
                    <td class="text-center"><strong>Product Name</strong></td> 
                    <td class="text-center"><strong>UOM</strong></td> 
                    <td class="text-center"><strong>QTY</strong></td>     
                    <td class="text-center"><strong>PCS</strong></td>     
                    <td class="text-center"><strong>Unit Price</strong></td> 
                    <td class="text-center"><strong>Total Amount</strong></td> 
                    
                </tr> 
                <?php for($i=0; $i<count($pol); $i++) { ?>                
               
                <tr>                    
                    <td class="text-center">                        
                        <button type="button" 
                                data-ta="<?php echo $pol[$i]->totalamount;?>" 
                                data-polno="<?php echo $pol[$i]->pol_no;?>" 
                                data-longdesc="<?php echo $pol[$i]->longdesc;?>" 
                                data-qty="<?php echo $pol[$i]->qty;?>" 
                                data-up="<?php echo $pol[$i]->unitprice;?>" 
                                data-packing="<?php echo $pol[$i]->packing;?>"
                                data-uom="<?php echo $pol[$i]->uom;?>"
                                data-pcs="<?php echo $pol[$i]->pcs;?>"
                                data-toggle="modal" data-target="#myModal"data-backdrop="static" data-keyboard="false" title="Edit" class="glyphicon glyphicon-pencil btn btn-info prod-edit"></button>
                        <a type="button" title="Delete" href="/mtpf/purchaseorder_con/delpurchaseorderline/<?php echo $pol[$i]->pol_no;?>/<?php echo $po[0]->po_no;?>" class="glyphicon glyphicon-trash btn btn-danger"></a>
                    </td>
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
            <form role="form" method="post" action="<?=site_url('purchaseorder_con/update_po')?>">
                <input class="form-control input-sm hide" type="text" name="po_no3"  value="<?php echo $po[0]->po_no; ?>" required autocomplete="off">
                <input id="ref_no3" class="form-control input-sm hide" type="text" name="ref_no3"  value="" autocomplete="off">  
                <input id="date3" class="form-control input-sm hide" type="text" name="date3"  value=""autocomplete="off">
                <input id="deliverydate3" class="form-control input-sm hide" type="text" name="deliverydate3"  value=""  autocomplete="off">
                <input id="s_no3" class="form-control input-sm hide" type="text" name="s_no3"  value=""  autocomplete="off">

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-1 control-label">Remarks</label>
                    <div class="col-sm-3">
                        <input id="remarks1" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="remarks1" placeholder="Remarks" value="<?php echo $po[0]->remarks;?>" autocomplete="off">
                    </div>
                    <label class="col-sm-1 control-label">Total Qty</label>
                    <div class="col-sm-3">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="number1" step="any" placeholder="Total Qty" value="<?php echo number_format((float)$polsum[0]->totalqty,2,'.',',');?>" required disabled autocomplete="off">
                        <input style="text-transform: capitalize;" class="form-control input-sm hide" type="text" name="totalqty3" step="any" placeholder="Total Qty" value="<?php echo $polsum[0]->totalqty;?>"  autocomplete="off">
                        <input style="text-transform: capitalize;" class="form-control input-sm hide" type="text" name="totalpcs" step="any" placeholder="Total pcs" value="<?php echo $polsum[0]->totalpcs;?>"  autocomplete="off">
                    </div>
                    <label class="col-sm-1 control-label">Total Amount</label>
                    <div class="col-sm-3">
                        <input id="totalamount" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="number2" step="any" placeholder="Total Amount" value="<?php echo number_format((float)$polsum[0]->totalamount,2,'.',',');?>" required disabled autocomplete="off">
                        <input id="grandtotal" style="text-transform: capitalize;" class="form-control input-sm hide" type="text" name="totalamount3" step="any" placeholder="Total Amount" value="<?php echo $polsum[0]->totalamount;?>" autocomplete="off">
                    </div>
                </div>                        

                <div class="modal-footer">
                    <a title="Close" href="/mtpf/purchaseorder_con/backupdatepo/<?php echo $po[0]->po_no; ?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                    <button title="Save" id="submit" type="Submit"  onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                
                </div>
            </form>        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->