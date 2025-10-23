<script type="text/javascript">

window.onload = function()
{
	var date1= document.getElementById('birthday'); // Date 1        
        var date2 = document.getElementById('date2');   //Date 2
        var date3 = document.getElementById('date3');   //Date 3        
        
        var docno = document.getElementById('docno');   //docno
        var docno2 = document.getElementById('docno2');   //docno2  
        
        var remarks1 = document.getElementById('remarks1');   //remarks 1    
        var remarks2 = document.getElementById('remarks2');   //remarks 1          
                       
        date2.value = date1.value;             
        date3.value = date1.value;   
        docno2.value = docno.value;   
        remarks2.value = remarks1.value;                                       
        
        $('#prodqty').change(function() {
        var up = parseFloat($('#produp').val());                 
        var packing = parseFloat($('#packing').val());   
        var qty = parseFloat($('#prodqty').val());    
        if($('#prodqty').val() === null || $('#prodqty').val() === "" || $('#prodqty').val() === "0")
        {
            $('#prodqty').val(0);
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
        var up = parseFloat($('#produp').val());                 
        var packing = parseFloat($('#packing').val());   
        var qty = parseFloat($('#prodqty').val());    
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
        var up = parseFloat($('#produp').val());                 
        var packing = parseFloat($('#packing').val());   
        var pcs = parseFloat($('#pcs').val());    
        if($('#pcs').val() === null || $('#pcs').val() === "" || $('#pcs').val() === "0")
        {                 
            $('#pcs').val((1));  
            $('#ta').val(((up/packing)*1));
            $('#ta2').val(((up/packing)*1));
        }else 
        {
            $('#ta').val(((up/packing)*pcs));
            $('#ta2').val(((up/packing)*pcs));
        }
        });
        
        document.getElementById('birthday').onchange = function()
	{		
                date2.value = this.value;
                date3.value = this.value;
	};
        
        document.getElementById('remarks1').onchange = function()
	{		
                remarks2.value = this.value;
	};
        
        document.getElementById('docno').onchange = function()
	{		
                docno2.value = this.value;
	};
        
        $(document).ready(function () {

            $('.prod-edit').click(function () {
                $('span.prodname').text($(this).data('longdesc'));        
                var qty = $(this).data('qty');
                var up = $(this).data('up');
                var dlno = $(this).data('dlno');
                var ta = $(this).data('ta');
                var packing = $(this).data('packing');
                var uom = $(this).data('uom');
                var pcs = $(this).data('pcs');
                $(".modal-body #prodqty").val( qty );
                $(".modal-body #produp").val( up );
                $(".modal-body #proddlno").val( dlno );
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
                <span class="glyphicon glyphicon-road"></span> Insert Receiving Goods
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php if($del[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($del[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>                    
                </div> 
                
                <label class="col-sm-1 control-label">P.O. No.</label>
                <div class="col-sm-3">   
                    <div class="input-group">
                    <input class="form-control input-sm" type="text" name="pono"  
                           value="<?php for($r=0;$r<count($rec);$r++)
                                {
                                if($del[0]->po_no == ""||$del[0]->po_no == null){}
                                else { if($rec[$r]->po_no == $del[0]->po_no)
                                        { echo $rec[$r]->ref_no;}
                                }} ?>" required disabled autocomplete="off">                                        
                    <a type="button" href="/mtpf/receiving_con/searchpoview/<?php echo $del[0]->d_no;?>" class="btn btn-default input-group-addon"><span >...</span></a>
                    </div>
                </div>
                
                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <input id="ref_no1" class="form-control input-sm" type="text" name="ref_no1"  value="<?php echo $del[0]->ref_no; ?>" required disabled autocomplete="off">
                </div>                 
            </div>
            
            <div class="form-group row row-offcanvas">
                <form rol="form" method="post" action="<?=site_url('receiving_con/insertproductview')?>">
                <label class="col-sm-1 control-label">Supplier Name</label>
                <div class="col-sm-5">                                                            
                    <input class="form-control input-sm" type="text" value="<?php for($s=0;$s<count($supactive);$s++) { if($supactive[$s]->s_no == $del[0]->s_no) { echo $supactive[$s]->name;}} ?>" required disabled autocomplete="off">
                    <input id="s_no1" name="s_no1" class="form-control input-sm hide" type="text" value="<?php echo $del[0]->s_no; ?>" required autocomplete="off">                                       
                </div>  
                <label class="col-sm-1 control-label">Doc #</label>
                <div class="col-sm-3">                                                            
                    <input id="docno" class="form-control input-sm" type="text" name="docno" value="<?php if($del[0]->doc_no == null || $del[0]->doc_no == ""){}else { echo $del[0]->doc_no;} ?>" autocomplete="off">                    
                </div> 
                <div class="col-sm-2">                     
                    <input class="form-control input-sm hide" type="text" name="d_no"  value="<?php echo $del[0]->d_no; ?>" required autocomplete="off">  
                    <input id="date2" class="form-control input-sm hide" type="text" name="date2"  value=""autocomplete="off">
                    <input id="remarks2" style="text-transform: capitalize;" class="form-control input-sm hide" type="text" name="remarks2" value="<?php echo $del[0]->remarks;?>" autocomplete="off">
                    <button  type="submit" title="ADD Product" class="btn btn-success glyphicon glyphicon-plus pull-right"></button>                                     
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

                   <form role="form" method="post" action="<?=site_url('receiving_con/updateproduct')?>">
                       <div class="modal-body">   
                           <input  id="proddlno" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="dl_no" value="" required autocomplete="off">
                           <input class="form-control input-sm hide" type="text" name="d_no"  value="<?php echo $del[0]->d_no; ?>" required autocomplete="off">
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Product Name</label>
                               <div class="col-sm-12">
                                   <p style="text-transform: capitalize;" class="form-control input-sm"><span class="prodname"></span></p>
                               </div>
                           </div>
                           
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Unit Price</label>
                               <div class="col-sm-12">
                                   <input  id="produp" style="text-transform: capitalize;" class="form-control input-sm produp" type="number" name="unitprice" placeholder="Unitprice" value="" required disabled autocomplete="off">
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
                                    <input id="prodqty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" value="" required autofocus autocomplete="off">
                                </div>
                                <div class="col-sm-6">
                                    <input id="pcs" style="text-transform: capitalize;" class="form-control input-sm"  step="any" type="number" name="pcs" required autocomplete>
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
               </div>
               </div>
            </div><!--   End of model -->

            
            <div style="height: 250px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                                                                
                <tr class="info">                                      
                    <td class="text-center"><strong>ACTION</strong></td>
                    <td class="text-center"><strong>Product Name</strong></td> 
                    <td class="text-center"><strong>UOM / PACKING</strong></td> 
                    <td class="text-center"><strong>QTY</strong></td>     
                    <td class="text-center"><strong>PCS / Kg</strong></td>     
                    <td class="text-center"><strong>Unit Price</strong></td> 
                    <td class="text-center"><strong>Total Amount</strong></td> 
                    
                </tr> 
                <?php for($i=0; $i<count($dl); $i++) { ?>                
               
                <tr>                    
                    <td class="text-center">                        
                        <button type="button" 
                                data-ta="<?php echo $dl[$i]->totalamount;?>" 
                                data-dlno="<?php echo $dl[$i]->dl_no;?>" 
                                data-longdesc="<?php echo $dl[$i]->longdesc;?>" 
                                data-qty="<?php echo $dl[$i]->qty;?>" 
                                data-up="<?php echo $dl[$i]->unitprice;?>" 
                                data-uom="<?php echo $dl[$i]->uom;?>" 
                                data-packing="<?php echo $dl[$i]->packing;?>" 
                                data-pcs="<?php echo $dl[$i]->pcs;?>" 
                                data-toggle="modal" data-target="#myModal"data-backdrop="static" data-keyboard="false" title="Edit" class="glyphicon glyphicon-pencil btn btn-info prod-edit"></button>
                        <a type="button" title="Delete" href="/mtpf/receiving_con/deldeliveryline/<?php echo $dl[$i]->dl_no;?>/<?php echo $del[0]->d_no;?>" class="glyphicon glyphicon-trash btn btn-danger"></a>
                    </td>
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
            <form role="form" method="post" action="<?=site_url('receiving_con/update_del')?>">
                <input class="form-control input-sm hide" type="text" name="d_no"  value="<?php echo $del[0]->d_no; ?>" required autocomplete="off">               
                <input id="date3" class="form-control input-sm hide" type="text" name="date3"  value=""autocomplete="off">
                <input id="docno2" class="form-control input-sm hide" type="text" name="docno" value="" >                    
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-1 control-label">Remarks</label>
                    <div class="col-sm-3">
                        <input id="remarks1" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="remarks1" placeholder="Remarks" value="<?php echo $del[0]->remarks;?>" autocomplete="off">
                    </div>
                    <label class="col-sm-1 control-label">Total Qty</label>
                    <div class="col-sm-3">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="number1" step="any" placeholder="Total Qty" value="<?php echo number_format((float)$dlsum[0]->totalqty,2,'.',',');?>" required disabled autocomplete="off">
                        <input style="text-transform: capitalize;" class="form-control input-sm hide" type="text" name="totalqty3" step="any" placeholder="Total Qty" value="<?php echo $dlsum[0]->totalqty;?>"  autocomplete="off">
                    </div>
                    <label class="col-sm-1 control-label">Total Amount</label>
                    <div class="col-sm-3">
                        <input id="totalamount" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="number2" step="any" placeholder="Total Amount" value="<?php echo number_format((float)$dlsum[0]->totalamount,2,'.',',');?>" required disabled autocomplete="off">
                        <input id="grandtotal" style="text-transform: capitalize;" class="form-control input-sm hide" type="text" name="totalamount3" step="any" placeholder="Total Amount" value="<?php echo $dlsum[0]->totalamount;?>" autocomplete="off">
                    </div>
                </div>                        

                <div class="modal-footer">
                    <a title="Close" href="/mtpf/receiving_con/backupdatedel/<?php echo $del[0]->d_no;?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                    <button title="Save" type="Submit" onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                
                </div>
            </form>        
        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->