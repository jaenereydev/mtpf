<script type="text/javascript">

window.onload = function()
{       	
    $('#qty').change(function() {
        var up = parseFloat($('#up2').val());          
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
            $('#uc').val((up/packing).toFixed(2));
            $('#ta').val((qty*up).toFixed(2));
            $('#ta2').val((qty*up).toFixed(2));
            $('#pcs').val((qty*packing).toFixed(2));   
        }
        });
        
    $('#qqty').change(function() {        
        var packing = parseFloat($('#qpacking').val());   
        var qty = parseFloat($('#qqty').val());    
        if($('#qqty').val() === null || $('#qqty').val() === "" || $('#qqty').val() === "0")
        {
            $('#qqty').val(0);
            $('#qpcs').val(0);
        }else 
        {
            $('#qpcs').val((qty*packing).toFixed(2));   
        }
        });
    
    $('#packing').change(function() {
        var up = parseFloat($('#up2').val());                 
        var packing = parseFloat($('#packing').val());   
        var qty = parseFloat($('#qty').val());    
        if($('#packing').val() === null || $('#packing').val() === "" || $('#packing').val() === "0")
        {
            $('#packing').val(1);     
            $('#pcs').val(qty);  
            $('#ta').val(0);
            $('#ta2').val(0);
        }else 
        {
            $('#uc').val((up/packing).toFixed(2));
            $('#ta').val((qty*up).toFixed(2));
            $('#ta2').val((qty*up).toFixed(2));
            $('#pcs').val((qty*packing).toFixed(2));   
        }
        });
    
    $('#qpacking').change(function() {               
        var packing = parseFloat($('#qpacking').val());   
        var qty = parseFloat($('#qqty').val());    
        if($('#qpacking').val() === null || $('#qpacking').val() === "" || $('#qpacking').val() === "0")
        {
            $('#qpacking').val(1);     
            $('#qpcs').val(qty);  
        }else 
        {
            $('#qpcs').val((qty*packing).toFixed(2));   
        }
        });
    
    $('#pcs').change(function() {
        var up = parseFloat($('#up2').val());                 
        var packing = parseFloat($('#packing').val());   
        var pcs = parseFloat($('#pcs').val());    
        if($('#pcs').val() === null || $('#pcs').val() === "" || $('#pcs').val() === "0")
        {                 
            $('#pcs').val(1);  
            $('#ta').val(((up/packing)*1));
            $('#ta2').val(((up/packing)*1));
        }else 
        {
            $('#uc').val((up/packing).toFixed(2));
            $('#qty').val((pcs/packing).toFixed(2));  
            $('#ta').val(((up/packing)*pcs).toFixed(2));
            $('#ta2').val(((up/packing)*pcs).toFixed(2));
        }
    });
    
    $('#qpcs').change(function() {               
        var packing = parseFloat($('#qpacking').val());   
        var pcs = parseFloat($('#qpcs').val());    
        if($('#qpcs').val() === null || $('#qpcs').val() === "" || $('#qpcs').val() === "0")
        {                 
            $('#qpcs').val(1);  
        }else 
        {
            $('#qqty').val((pcs/packing).toFixed(2));  
        }
    });
    
        $(document).ready(function () {
            $(document).on('click', '.prod-add', function(event) {
                $('span.prodname').text($(this).data('ld'));        
                var up = $(this).data('up');
                var uc = $(this).data('uc');
                var packing = $(this).data('packing');
                var uom = $(this).data('uom');
                var pno = $(this).data('pno');
                $(".modal-body #pno").val( pno );
                $(".modal-body #up1").val( up );
                $(".modal-body #up2").val( up );
                $(".modal-body #uc").val( uc );
                $(".modal-body #packing").val( packing );
                $(".modal-body #uom").val( uom );                                
            });
        });
               
}
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-tint"></span> Insert Milling
            </h3>
            <?php if($m[0]->posted == "POSTED") {} else{ ?>
            <a title="Add Product" type="button" data-toggle="modal" data-target="#AddProductlist" class="btn btn-primary glyphicon glyphicon-plus pull-right"></a>                                  
            <a title="Select Formulation" type="button" data-toggle="modal" data-target="#formulalist" class="btn btn-primary glyphicon glyphicon-baby-formula pull-right" style="margin-right: 5px"></a>                                  
            <?php } ?>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <form role="form" method="post" action="<?=site_url('milling_con/savem')?>"> 
            <input class="form-control input-sm hide" type="text" name="mno" value="<?php echo $m[0]->m_no;?>" required autocomplete="off">
            <div class="form-group row row-offcanvas">      
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-2" id="datepicker"> 
                    <div class="input-group">
                        <?php if($m[0]->posted == "POSTED") { ?>
                        <p class="form-control input-sm" ><?php if($m[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($m[0]->date), 'm/d/Y');}?></p>                                       
                        <?php }else { ?>
                        <input class="form-control input-sm" type="text" name="date" id="birthday" placeholder="click to show datepicker" value="<?php if($m[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($m[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                       
                        <?php }?>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>                    
                </div>   
                <label class="col-sm-1 control-label">Ref No.</label>
                <div class="col-sm-2">
                    <?php if($m[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" ><?php echo $m[0]->ref_no?></p> 
                    <?php }else { ?>
                    <input id="refno" class="form-control input-sm" type="text" name="refno" value="<?php echo $m[0]->ref_no;?>" required autocomplete="off">            
                    <?php }?>
                </div>    
                <label class="col-sm-1 control-label">Output</label>
                <div class="col-sm-5" >
                    <?php if($m[0]->posted == "POSTED") { ?>
                    
                    <p  class="form-control input-sm"><span style="text-transform: capitalize;" ><?php for($r=0;$r<count($prod);$r++)
                                {
                                if($m[0]->p_no == ""||$m[0]->p_no == null){}
                                else { if($prod[$r]->p_no == $m[0]->p_no)
                                        { echo $prod[$r]->longdesc; ?></span><?php echo " - "; echo $m[0]->uom; echo "("; echo $m[0]->packing; echo ") -  "; echo $m[0]->qty; echo "qty -  "; echo number_format((float)$m[0]->pcs,2,'.',',');echo "pc/s";}
                                        }} ?></p>                                               
                    <?php }else { ?>
                    <div class="input-group">
                    <p  class="form-control input-sm"><span style="text-transform: capitalize;" ><?php for($r=0;$r<count($prod);$r++)
                                {
                                if($m[0]->p_no == ""||$m[0]->p_no == null){}
                                else { if($prod[$r]->p_no == $m[0]->p_no)
                                        { echo $prod[$r]->longdesc; ?></span><?php echo " - "; echo $m[0]->uom; echo "("; echo $m[0]->packing; echo ") -  "; echo $m[0]->qty; echo "qty -  "; echo number_format((float)$m[0]->pcs,2,'.',',');echo "pc/s";}
                                        }} ?></p>                            
                    <a type="button" title="Select Output Product" data-toggle="modal" data-target="#Productlist" class="btn btn-default input-group-addon"><span >...</span></a>                               
                    <a type="button" title="Edit Output Prodcut qty" data-toggle="modal" data-target="#editqty" class="btn btn-default input-group-addon edt-qty" <?php if($m[0]->p_no == null){ ?>disabled<?php }?>><span >Qty</span></a>                               
                    </div> 
                    <?php } ?>
                </div>  
            </div>  
            <div class="form-group row row-offcanvas">                                
                <div class="col-sm-12">                   
                    <div  style="height: 390px; overflow: auto; margin: 0 auto;margin-bottom: 5px;background-color: #E8E8E8 ;"> 
                    <table class="table table-responsive table-bordered table-hover">                                                                
                        <tr class="info">        
                            <?php if($m[0]->posted == "POSTED") {}else { ?>
                            <td class="text-center"><strong>ACTION</strong></td> 
                            <?php }?>
                            <td class="text-center"><strong>Product Name</strong></td>                             
                            <td class="text-center"><strong>UOM</strong></td> 
                            <td class="text-center"><strong>Packing</strong></td> 
                            <td class="text-center"><strong>Qty</strong></td> 
                            <td class="text-center"><strong>Pcs</strong></td>
                            <td class="text-center"><strong>Unit Price</strong></td> 
                            <td class="text-center"><strong>Unit Cost</strong></td> 
                            <td class="text-center"><strong>Total Amount</strong></td> 
                        </tr>        
                        <?php for($i=0; $i<count($ml); $i++) { ?>
                        <tr style="background-color: white;">  
                            <?php if($m[0]->posted == "POSTED") {}else { ?>
                            <td class="text-center">
                                <a class="btn-sm btn-danger glyphicon glyphicon-trash" href="/mtpf/milling_con/delml/<?php echo $ml[$i]->ml_no;?>/<?php echo $m[0]->m_no;?>"></a>
                            </td>     
                            <?php }?>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->longdesc; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->uom; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->packing; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->qty; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->pc; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->unitprice; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->unitcost; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $ml[$i]->totalamount; ?></td>
                        </tr>
                        <?php }?>
                    </table>                        
                    </div>                   
                </div>
            </div>           
            <input class="form-control input-sm hide" type="text" name="tqty" value="<?php echo $summl[0]->qty;?>"  required autocomplete="off">                                       
            <input class="form-control input-sm hide" type="text" name="tamount" value="<?php echo $summl[0]->totalamount;?>"  required autocomplete="off">                                       
            <div class="modal-footer">
                 <?php if($m[0]->posted == "POSTED") { ?>
                 <a title="Close" href="<?php echo site_url('milling_con') ?>" type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>
                 <?php }else { ?>
                <a title="Close" href="/mtpf/milling_con/closedm/<?php echo $m[0]->m_no; ?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                <button title="Save"  type="Submit" onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" <?php if($m[0]->p_no == null){?>disabled<?php }else{}?>></button>                                  
                 <?php }?>
            </div>
            </form>                                  
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div class="modal fade" id="Productlist" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
          <h4 class="modal-title text-center" id="creditModalLabel">Output Product List</h4>
        </div>
            <div class="modal-body table-responsive">
                <table class="table table-condensed table-bordered" id="MTable">  
                    <thead>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center">Product Name</td>                             
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(sizeof($prod)):
                            foreach ($prod as $key => $item): ?>
                            <tr>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $item->p_no ?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $item->longdesc ?></td>                                    
                                <td class="text-center">
                                    <a href="/mtpf/milling_con/selectoutputprod/<?php echo $item->p_no ?>/<?php echo $m[0]->m_no;?>" class="btn btn-primary prod-add" >SELECT</a>
                                </td>
                            </tr>
                        <?php endforeach;
                            else: ?>
                            <tr>
                                <td colspan="4">There are no Product.</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddProductlist" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
          <h4 class="modal-title text-center" id="creditModalLabel">Product List</h4>
        </div>
            <div class="modal-body table-responsive">
                <table class="table table-condensed table-bordered" id="CoTable">  
                    <thead>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center">Product Name</td>                             
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(sizeof($mprod)):
                            foreach ($mprod as $key => $item): ?>
                            <tr>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $item->p_no ?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $item->longdesc ?></td>                                    
                                <td class="text-center">
                                    <a type="button" 
                                       data-pno="<?php echo $item->p_no;?>"
                                       data-ld="<?php echo $item->longdesc;?>"
                                       data-uom="<?php echo $item->uom;?>"
                                       data-packing="<?php echo $item->packing;?>"
                                       data-up="<?php echo $item->unitprice;?>"
                                       data-uc="<?php echo $item->unitcost;?>"
                                       data-toggle="modal" data-target="#addproduct"  data-backdrop="static" data-keyboard="false" title="Add Product" class="btn btn-primary prod-add" >SELECT</a>                                    
                                </td>
                            </tr>
                        <?php endforeach;
                            else: ?>
                            <tr>
                                <td colspan="4">There are no Product.</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formulalist" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
          <h4 class="modal-title text-center" id="creditModalLabel">Formulation List</h4>
        </div>
            <div class="modal-body table-responsive">
                <table class="table table-condensed table-bordered" id="ThirdTable">  
                    <thead>
                        <tr>                            
                            <td class="text-center">Name</td>
                            <td class="text-center">Output Product</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($r=0; $r<count($f); $r++) {?>
                            <tr>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $f[$r]->name ?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php for($g=0;$g<count($prod);$g++)
                                {
                                if($f[$r]->output == ""||$f[$r]->output == null){}
                                else { if($prod[$g]->p_no == $f[$r]->output)
                                        { echo $prod[$g]->longdesc;}
                                        }} ?></td>                                    
                                <td class="text-center">
                                    <a href="/mtpf/milling_con/selectformulation/<?php echo $f[$r]->f_no ?>/<?php echo $m[0]->m_no;?>" class="btn btn-primary prod-add" >SELECT</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal-->
<div id="addproduct" class="modal fade " role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1050;">
   <div class="modal-dialog modal-sm">
   <!--             Modal content-->
   <div class="modal-content">
       <div class="modal-header">                        
           <button title="Close" class="close"  data-dismiss="modal" data-toggle="modal" >&times;</button>                    
           <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Quantity</h4>
       </div><!-- End of Modal Header -->

       <form role="form" method="post" action="<?=site_url('milling_con/insertml')?>">
           <div class="modal-body">                             
               <input class="form-control input-sm hide" type="text" name="m_no"  value="<?php echo $m[0]->m_no; ?>" required autocomplete="off">
               <input id="pno" class="form-control input-sm hide" type="text" name="p_no"  value="" required autocomplete="off">
               <input id="uc" class="form-control input-sm hide" type="text" name="uc"  value="" required autocomplete="off">
               <div class="form-group row row-offcanvas">
                   <label class="col-sm-12 control-label">Product Name</label>
                   <div class="col-sm-12">
                       <p style="text-transform: capitalize;" class="form-control input-sm"><span class="prodname"></span></p>
                   </div>
               </div>

               <div class="form-group row row-offcanvas">
                   <label class="col-sm-12 control-label">Unit Price</label>
                   <div class="col-sm-12">
                       <input  id="up1" class="form-control input-sm" type="number"  required disabled autocomplete="off">
                       <input  id="up2" class="form-control input-sm hide" step="any" type="number" name="unitprice" placeholder="Unitprice" value="" required autocomplete="off">
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
                        <input id="qty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" value="0" required  autocomplete="off">
                    </div>
                    <div class="col-sm-6">
                        <input id="pcs" style="text-transform: capitalize;" class="form-control input-sm"  step="any" type="number" name="pcs" value="0" required autocomplete>
                    </div>                                                                
                </div>

               <div class="form-group row row-offcanvas">
                   <label class="col-sm-12 control-label">Total Amount</label>                                
                    <div class="col-sm-12">
                        <input id="ta2" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number" value="0" disabled>                              
                        <input id="ta" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="number" name="ta" value="0">                              
                    </div>                                                            
                </div>                          

               <div class="modal-footer">
                     <a title="Close"  data-dismiss="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                     <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                       
               </div>
           </div><!--End of Modal Body -->
       </form>  
   </div>
   </div>
</div><!--   End of model -->

<!--Modal-->
<div id="editqty" class="modal fade " role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1050;">
   <div class="modal-dialog modal-sm">
   <!--             Modal content-->
   <div class="modal-content">
       <div class="modal-header">                        
           <button title="Close" class="close"  data-dismiss="modal" data-toggle="modal" >&times;</button>                    
           <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Quantity</h4>
       </div><!-- End of Modal Header -->

       <form role="form" method="post" action="<?=site_url('milling_con/updatemqty')?>">
           <div class="modal-body">                             
               <input class="form-control input-sm hide" type="text" name="m_no"  value="<?php echo $m[0]->m_no; ?>" required autocomplete="off">               
               <div class="form-group row row-offcanvas">
                    <label class="col-sm-12 control-label">UOM</label>
                    <div class="col-sm-12">
                        <input id="quom" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="text" name="uom" value="<?php echo $m[0]->uom;?>" placeholder="UOM" required>
                    </div>                    
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-12 control-label">Packing</label>
                    <div class="col-sm-12">
                        <input id="qpacking" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number" name="packing" value="<?php echo $m[0]->packing;?>" placeholder="Packing" required>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-6 control-label">Quantity</label>
                    <div class="col-sm-6">
                        <input id="qqty" style="text-transform: capitalize;" class="form-control input-sm " step="any" type="number" name="qty" placeholder="Quantity" value="<?php echo $m[0]->qty;?>"  required autocomplete="off">
                    </div>                                                                                   
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-6 control-label">Pcs / K.g.</label> 
                    <div class="col-sm-6">
                        <input id="qpcs" style="text-transform: capitalize;" class="form-control input-sm"  step="any" type="number" name="pcs" value="<?php echo $m[0]->pcs;?>" placeholder="Pcs" required autocomplete>
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

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>