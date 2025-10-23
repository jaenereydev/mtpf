<script type="text/javascript">

window.onload = function()
{
    var date1= document.getElementById('birthday'); // Date 1
    var date2 = document.getElementById('date2');   //Date 2
    var date3 = document.getElementById('date3');   //Date 3
    var remarks1 = document.getElementById('remarks1');   //remarks 1
    var remarks2 = document.getElementById('remarks2');   //remarks 2
    var remarks3 = document.getElementById('remarks3');   //remarks 3
    
    date2.value = date1.value; 
    date3.value = date1.value; 
    remarks2.value = remarks1.value;
    remarks3.value = remarks1.value;
    
    document.getElementById('birthday').onchange = function()
    {
        date2.value = this.value;
        date3.value = this.value;
    };
    
    document.getElementById('remarks1').onchange = function()
    {
        remarks2.value = this.value;
        remarks3.value = this.value;
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
            $('#pcs').val(qty);  
            $('#ta').val(0);
            $('#ta2').val(0);
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
            $('#pcs').val(1);  
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
            var salno = $(this).data('salno');
            var up = $(this).data('up');
            var uc = $(this).data('uc');
            var ilno = $(this).data('ilno');
            var ta = $(this).data('ta');
            var packing = $(this).data('packing');
            var uom = $(this).data('uom');
            var pcs = $(this).data('pcs');
            $(".modal-body #salno").val( salno );
            $(".modal-body #qty").val( qty );
            $(".modal-body #up").val( up );
            $(".modal-body #up2").val( up );
            $(".modal-body #uc").val( uc );
            $(".modal-body #ilno").val( ilno );
            $(".modal-body #ta").val( ta );
            $(".modal-body #ta2").val( ta );
            $(".modal-body #packing").val( packing );
            $(".modal-body #uom").val( uom );
            $(".modal-body #pcs").val( pcs );
        });
    });
    
    
    $('#aqty').change(function() {
        var up = parseFloat($('#aup2').val());                 
        var packing = parseFloat($('#apacking').val());   
        var qty = parseFloat($('#aqty').val());    
        if($('#aqty').val() === null || $('#aqty').val() === "" || $('#aqty').val() === "0")
        {
            $('#aqty').val(0);
            $('#ata').val(0);
            $('#ata2').val(0);
            $('#apcs').val(0);
        }else 
        {
            $('#ata').val((qty*up));
            $('#ata2').val((qty*up));
            $('#apcs').val((qty*packing));   
        }
        });
    
    $('#apacking').change(function() {
        var up = parseFloat($('#aup2').val());                 
        var packing = parseFloat($('#apacking').val());   
        var qty = parseFloat($('#aqty').val());    
        if($('#apacking').val() === null || $('#apacking').val() === "" || $('#apacking').val() === "0")
        {   
            $('#apacking').val(1);     
            $('#apcs').val((qty));  
            $('#ata').val(0);
            $('#ata2').val(0);
        }else 
        {
            $('#ata').val((qty*up));
            $('#ata2').val((qty*up));
            $('#apcs').val((qty*packing));   
        }
        });
    
    $('#apcs').change(function() {
        var up = parseFloat($('#aup2').val());                 
        var packing = parseFloat($('#apacking').val());   
        var pcs = parseFloat($('#apcs').val());    
        if($('#apcs').val() === null || $('#apcs').val() === "" || $('#apcs').val() === "0")
        {                 
            $('#apcs').val(0);  
            $('#ata').val(((up/packing)*1));
            $('#ata2').val(((up/packing)*1));
        }else 
        {
            $('#aqty').val(pcs/packing);  
            $('#ata').val(((up/packing)*pcs));
            $('#ata2').val(((up/packing)*pcs));
        }
    });
    
    $(document).ready(function () {
        $(document).on('click', '.prod-add', function(event) {
            $('span.aprodname').text($(this).data('longdesc'));                   
            var pno = $(this).data('pno');
            var up = $(this).data('up');
            var uc = $(this).data('uc');
            var packing = $(this).data('packing');
            var uom = $(this).data('uom');
            $(".modal-body #aqty").val( 0 );
            $(".modal-body #pno").val( pno );
            $(".modal-body #aup1").val( up );
            $(".modal-body #aup2").val( up );
            $(".modal-body #auc").val( uc );
            $(".modal-body #ata").val( 0 );
            $(".modal-body #ata2").val( 0 );
            $(".modal-body #apacking").val( packing );
            $(".modal-body #auom").val( uom );
            $(".modal-body #apcs").val( 0 );
        });
    });
    
};

</script>

<style>
	table td{
		vertical-align: middle !important;
	}

	/*table thead, table td:not(:nth-child(2)) {*/
	table thead, table td, table th {
		text-align: center;
	}
	
	#STable tbody tr{
		cursor: pointer;
	}

	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    appearance: none;
	    margin: 0; 
	}

	.list-group {
		margin-bottom: 10px !important;
	}

	.list-group > li{
		padding: 6px 12px;
	}

	textarea {
		max-width: 100%;
	}

	label {
		font-size: 13px;
	}

	.panel-heading > .panel-title,
	.panel-heading > .panel-toolbar {
	  display: table-cell;
	  vertical-align: middle;
	  width: 1%;
	  float: none !important;
	}

	.bold {font-weight: 700; } .semibold {font-weight: 600; } .thin {font-weight: 300; } .ellipsis {overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

	.fsize14 {font-size: 14px !important; } .fsize16 {font-size: 16px !important; } .fsize24 {font-size: 24px !important; } .fsize32 {font-size: 32px !important; } .fsize48 {font-size: 48px !important; } .fsize64 {font-size: 64px !important; } .fsize80 {font-size: 80px !important; } .fsize96 {font-size: 96px !important; } .fsize112 {font-size: 112px !important; } .fsize128 {font-size: 128px !important; }

	.ma15 {margin: 15px !important; } .ma10 {margin: 10px !important; } .ma5 {margin: 5px !important; } .nm {margin: 0px !important; } .ma-15 {margin: -15px !important; } .ma-10 {margin: -10px !important; } .ma-5 {margin: -5px !important; } .mt15 {margin-top: 15px !important; } .mt10 {margin-top: 10px !important; } .mt5 {margin-top: 5px !important; } .mt0 {margin-top: 0px !important; } .mt-15 {margin-top: -15px !important; } .mt-10 {margin-top: -10px !important; } .mt-5 {margin-top: -5px !important; } .mr15 {margin-right: 15px !important; } .mr10 {margin-right: 10px !important; } .mr5 {margin-right: 5px !important; } .mr0 {margin-right: 0px !important; } .mr-15 {margin-right: -15px !important; } .mr-10 {margin-right: -10px !important; } .mr-5 {margin-right: -5px !important; } .mb15 {margin-bottom: 15px !important; } .mb10 {margin-bottom: 10px !important; } .mb5 {margin-bottom: 5px !important; } .mb0 {margin-bottom: 0px !important; } .mb-15 {margin-bottom: -15px !important; } .mb-10 {margin-bottom: -10px !important; } .mb-5 {margin-bottom: -5px !important; } .ml15 {margin-left: 15px !important; } .ml10 {margin-left: 10px !important; } .ml5 {margin-left: 5px !important; } .ml0 {margin-left: 0px !important; } .ml-15 {margin-left: -15px !important; } .ml-10 {margin-left: -10px !important; } .ml-5 {margin-left: -5px !important; } /* Padding */ .pa15 {padding: 15px !important; } .pa10 {padding: 10px !important; } .pa5 {padding: 5px !important; } .np {padding: 0px !important; } .pt15 {padding-top: 15px !important; } .pt10 {padding-top: 10px !important; } .pt5 {padding-top: 5px !important; } .pt0 {padding-top: 0px !important; } .pr15 {padding-right: 15px !important; } .pr10 {padding-right: 10px !important; } .pr5 {padding-right: 5px !important; } .pr0 {padding-right: 0px !important; } .pb15 {padding-bottom: 15px !important; } .pb10 {padding-bottom: 10px !important; } .pb5 {padding-bottom: 5px !important; } .pb0 {padding-bottom: 0px !important; } .pl15 {padding-left: 15px !important; } .pl10 {padding-left: 10px !important; } .pl5 {padding-left: 5px !important; } .pl0 {padding-left: 0px !important; } 
	body {overflow-y:scroll;}
</style>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div style="margin-top:60px;" class="col-md-12 main" style="width: 100%;">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
            Stock Adjustment Module
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <input class="form-control input-sm hide" type="text" name="sa_no"  value="<?php echo $adj[0]->sa_no; ?>" required autocomplete="off">
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <?php if($adj[0]->posted == "POSTED") { ?>
                        <p class="form-control input-sm" ><?php if($adj[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($adj[0]->date), 'm/d/Y');}?></p>                                   
                        <?php }else {?>
                        <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php if($adj[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($adj[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                    
                        <?php }?>                        
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    
                </div> 
                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <?php if($adj[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm"><?php echo $adj[0]->ref_no; ?></p>                                      
                    <?php }else {?>
                    <input class="form-control input-sm" type="text" name="ref_no"  value="<?php echo $adj[0]->ref_no; ?>" required disabled autocomplete="off">                                        
                    <?php }?>                    
                </div>
                                
            </div>
            
            <div class="form-group row row-offcanvas">                               
                <label class="col-sm-1 control-label">Remarks</label>
                <div class="col-sm-4">
                    <?php if($adj[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" style="text-transform: capitalize;"><?php echo $adj[0]->remarks; ?></p>                                
                    <?php }else {?>
                    <input id="remarks1" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="remarks"  value="<?php echo $adj[0]->remarks; ?>" required autocomplete="off">                                        
                    <?php }?>                    
                </div>
                
                <label class="col-sm-1 control-label">Sign</label>  
                <div class="col-sm-4">
                <?php if($adj[0]->posted == "POSTED") { ?>
                <p class="form-control input-sm " ><?php if($adj[0]->sign == "+"){echo "Addition(+)";}else{echo "Subtraction(-)";} ?></p>               
                <?php }else {?>                
                    <div class="input-group">                     
                        <input class="form-control input-sm" style="text-transform: capitalize;" value="<?php if($adj[0]->sign == null || $adj[0]->sign == ""){}else if($adj[0]->sign == "+"){echo "Addition(+)";}else if($adj[0]->sign == "-"){echo "Subtraction(-)";}?>" disabled autocomplete="off">
                        <a type="button"  data-toggle="modal" data-target="#sign" data-backdrop="static" data-keyboard="false" title="Edit Sign" class="btn btn-default input-group-addon"><span >...</span></a>                                                   
                    </div>                 
                <?php }?>
                </div>
                <?php if($adj[0]->posted == "POSTED") {}else{ ?>
                <div class="col-sm-2">
                    <button data-toggle="modal" data-target="#ProductList" data-backdrop="static" data-keyboard="false" title="Add Product" class="btn btn-success glyphicon glyphicon-plus pull-right"></button>                
                </div> 
                <?php }?>
            </div>           
            
            <!--Modal-->
            <div id="sign" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-sm">
               <!--             Modal content-->
               <div class="modal-content">
                   <div class="modal-header">                    
                       <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Sign</h4>
                   </div><!-- End of Modal Header -->

                   <form role="form" method="post" action="<?=site_url('adjustment_con/updatesign')?>">
                       <div class="modal-body">  
                            <input id="remarks2" style="text-transform: capitalize;"  class="form-control input-sm hide" type="text" name="remarks" autocomplete="off">                                        
                            <input class="form-control input-sm hide" type="text" name="date" id="date2"  autocomplete="off">                                
                            <input class="form-control input-sm hide" type="text" name="sa_no"  value="<?php echo $adj[0]->sa_no; ?>" >                            
                            <div class="form-group row row-offcanvas">                              
                                <div class="col-sm-12 text-center">
                                    <label class="radio-inline">
                                    <input type="radio" name="sign" value="+" <?php if($adj[0]->sign == '+'){echo 'checked';}?> required>Addition(+)
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="sign" value="-" <?php if($adj[0]->sign == '-'){echo 'checked';}?> required>Subtraction(-)
                                    </label>
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
        
            <div class="modal fade" id="ProductList" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
                    <h4 class="modal-title text-center" id="creditModalLabel">Product List</h4>
                  </div>
                  <div class="modal-body table-responsive">
                    <table class="table table-condensed table-bordered nm" id="MTable">
                        <thead>
                            <tr>
                                <td>Product Name</td>
                                <td>Quantity</td>
                                <td>#</td>
                                <td width="100"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(sizeof($products)):
                                foreach ($products as $key => $item): ?>
                                <tr>
                                    <td style="text-transform: capitalize;"><?php echo $item->longdesc ?></td>
                                    <td><?php echo $item->qty ?></td>
                                    <td><?php echo $item->p_no ?></td>
                                    <td>
                                        <button                                            
                                            data-pno="<?php echo $item->p_no ?>" 
                                            data-longdesc="<?php echo $item->longdesc ?>" 
                                            data-up="<?php echo $item->unitprice;?>"
                                            data-packing="<?php echo $item->packing;?>"
                                            data-uom="<?php echo $item->uom;?>"
                                            data-uc="<?php echo $item->unitcost;?>"
                                            data-toggle="modal" data-target="#addproduct" data-backdrop="static" data-keyboard="false" title="Add Product" class="btn btn-primary prod-add" >SELECT</button>
                                    </td>
                                </tr>
                            <?php endforeach;
                                else: ?>
                                <tr>
                                    <td colspan="4">There are no products.</td>
                                </tr>
                            <?php endif?>
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
                       <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Quantity</h4>
                   </div><!-- End of Modal Header -->

                   <form role="form" method="post" action="<?=site_url('adjustment_con/insertproduct')?>">
                       <div class="modal-body">                             
                           <input class="form-control input-sm hide" type="text" name="sa_no"  value="<?php echo $adj[0]->sa_no; ?>" required autocomplete="off">
                           <input id="pno" class="form-control input-sm hide" type="text" name="p_no"  value="" required autocomplete="off">
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Product Name</label>
                               <div class="col-sm-12">
                                   <p style="text-transform: capitalize;" class="form-control input-sm"><span class="aprodname"></span></p>
                               </div>
                           </div>
                           
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Unit Price</label>
                               <div class="col-sm-12">
                                   <input  id="aup1" class="form-control input-sm" type="number"  required disabled autocomplete="off">
                                   <input  id="aup2" class="form-control input-sm hide" type="number" step="any" name="unitprice" placeholder="Unitprice" value="" required autocomplete="off">
                               </div>
                           </div>

                           <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">UOM</label>
                                <label class="col-sm-6 control-label">Packing</label>
                                
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <div class="col-sm-6">
                                    <input id="auom" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="text" name="uom" required>
                                </div>
                                <div class="col-sm-6">
                                    <input id="apacking" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number" name="packing" required>
                                </div>
                            </div>
                           
                           

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Quantity</label>
                                <label class="col-sm-6 control-label">Pcs / K.g.</label>                                                                
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <div class="col-sm-6">
                                    <input id="aqty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" value="" required autofocus autocomplete="off">
                                </div>
                                <div class="col-sm-6">
                                    <input id="apcs" style="text-transform: capitalize;" class="form-control input-sm"  step="any" type="number" name="pcs" required autocomplete>
                                </div>                                                                
                            </div>
                           
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Total Amount</label>                                
                                <div class="col-sm-12">
                                    <input id="ata2" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number"  disabled>                              
                                    <input id="ata" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="number" name="ta" >                              
                                </div>                                                            
                            </div>                          
                           
                           <div class="modal-footer">
                                 <a title="Close" data-target="#ProductList" data-dismiss="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                                 <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                       
                           </div>
                       </div><!--End of Modal Body -->
                   </form>  
               </div>
               </div>
            </div><!--   End of model -->
            
            <!--Modal-->
            <div id="editproduct" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
               <div class="modal-dialog modal-sm">
               <!--             Modal content-->
               <div class="modal-content">
                   <div class="modal-header">                    
                       <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Quantity</h4>
                   </div><!-- End of Modal Header -->

                   <form role="form" method="post" action="<?=site_url('adjustment_con/updateproduct')?>">
                       <div class="modal-body">   
                           <input  id="salno" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="sal_no" value="" required autocomplete="off">
                           <input class="form-control input-sm hide" type="text" name="sa_no"  value="<?php echo $adj[0]->sa_no; ?>" required autocomplete="off">
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Product Name</label>
                               <div class="col-sm-12">
                                   <p style="text-transform: capitalize;" class="form-control input-sm"><span class="prodname"></span></p>
                               </div>
                           </div>
                           
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Unit Price</label>
                               <div class="col-sm-12">
                                   <input  id="up"  class="form-control input-sm" disabled autocomplete="off">
                                   <input  id="up2" class="form-control input-sm hide" type="number" name="unitprice" placeholder="Unitprice" value="" step="any" required autocomplete="off">
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
                                    <input id="qty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" value="" required autofocus autocomplete="off">
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
            
            <div style="height: 350px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                    
                <tr class="info">     
                    
                    <?php if($adj[0]->posted == "POSTED") { ?>
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
                <?php for($i=0; $i<count($adjl); $i++) { ?>                               
                <tr>           
                    <?php if($adj[0]->posted == "POSTED") { ?>
                    <?php }else {?>
                    <td class="text-center">   
                        <button type="button"                                 
                                data-salno="<?php echo $adjl[$i]->sal_no;?>" 
                                data-longdesc="<?php echo $adjl[$i]->longdesc;?>" 
                                data-qty="<?php echo $adjl[$i]->qty;?>" 
                                data-up="<?php echo $adjl[$i]->unitprice;?>"
                                data-packing="<?php echo $adjl[$i]->packing;?>"
                                data-uom="<?php echo $adjl[$i]->uom;?>"
                                data-pcs="<?php echo $adjl[$i]->pcs;?>"
                                data-uc="<?php echo $adjl[$i]->unitcost;?>"
                                data-ta="<?php echo $adjl[$i]->totalamount;?>"
                                data-toggle="modal" data-target="#editproduct"data-backdrop="static" data-keyboard="false" title="Edit" class="glyphicon glyphicon-pencil btn btn-info prod-edit"></button>
                        <a title="Delete" href="/mtpf/adjustment_con/delsal/<?php echo $adjl[$i]->sal_no;?>/<?php echo $adj[0]->sa_no;?>" class="btn btn-danger glyphicon glyphicon-trash"></a>
                    </td>
                    <?php }?>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo $adjl[$i]->longdesc;?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo $adjl[$i]->uom;?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$adjl[$i]->packing,2,'.',',');?></td>                              
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$adjl[$i]->unitprice,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$adjl[$i]->unitcost,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$adjl[$i]->qty,2,'.',',');?></td>
                    <td class="text-center info" style="text-transform: capitalize;"><?php echo number_format((float)$adjl[$i]->pcs,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$adjl[$i]->totalamount,2,'.',',');?></td>                
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>
            <form role="form" method="post" action="<?=site_url('adjustment_con/update_saveadj')?>">
                <input class="form-control input-sm hide" type="text" name="sa_no"  value="<?php echo $adj[0]->sa_no; ?>" required autocomplete="off">
                <input class="form-control input-sm hide" type="text" name="date" id="date3" >                
                <input class="form-control input-sm hide" type="text" name="remarks" id="remarks3"  >
                <div class="modal-footer">
                    <?php if($adj[0]->posted == "POSTED") { ?>
                    <a title="Close" href="/mtpf/adjustment_con/adjustmentview"  type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>
                    <?php }else {?>
                    <a title="Close" href="/mtpf/adjustment_con/closeadj/<?php echo $adj[0]->sa_no; ?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                    <button title="Save" type="Submit"  onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                
                    <?php }?>
                </div>
            </form>  

        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>