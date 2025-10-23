<script type="text/javascript">

window.onload = function()
{       
	var date1= document.getElementById('birthday');
        var date2 = document.getElementById('date1');  
        var date3 = document.getElementById('date3');  
        
        var req1 = document.getElementById('req1'); 
        var req2 = document.getElementById('req2'); 
        var req3 = document.getElementById('req3');  
               
        var edate1= document.getElementById('fbirthday'); 
        var edate2 = document.getElementById('edate'); 
        var edate3 = document.getElementById('edate3');
                       
        req2.value = req1.value;
        req3.value = req1.value;
        
        edate2.value = edate1.value;  
        edate3.value = edate1.value;
        
        date2.value = date1.value;                             
        date3.value = date1.value;    
        
        document.getElementById('req1').onchange = function()
	{
		req2.value = this.value;
                req3.value = this.value;
	};
	document.getElementById('fbirthday').onchange = function()
	{
		edate2.value = this.value;
                edate3.value = this.value;
	};
        document.getElementById('birthday').onchange = function()
	{
		date2.value = this.value;
                date3.value = this.value;
	}; 
        
        $(document).ready(function () {
            $(document).on('click', '.prod-edit', function(event) {
                var pno = $(this).data('pno');
                var pclno = $(this).data('pclno');
                $('span.prodname').text($(this).data('longdesc'));
                $('span.uom').text($(this).data('ouom'));
                $('span.up').text($(this).data('oup'));                
                $('span.packing').text($(this).data('opacking'));
                $('span.p1').text($(this).data('op1'));
                $('span.p2').text($(this).data('op2'));
                $('span.p3').text($(this).data('op3'));
                $('span.p4').text($(this).data('op4'));
                $('span.p5').text($(this).data('op5'));
                $('span.p6').text($(this).data('op6'));
                $('span.p7').text($(this).data('op7'));
                $('span.p8').text($(this).data('op8'));
                $('span.p9').text($(this).data('op9'));
                $('span.p10').text($(this).data('op10'));
                $('span.p11').text($(this).data('odp'));
                var up = $(this).data('oup');
                var packing = $(this).data('opacking');
                var uom = $(this).data('ouom');                
                var p1 = $(this).data('op1');
                var p2 = $(this).data('op2');
                var p3 = $(this).data('op3');
                var p4 = $(this).data('op4');
                var p5 = $(this).data('op5');
                var p6 = $(this).data('op6');
                var p7 = $(this).data('op7');
                var p8 = $(this).data('op8');
                var p9 = $(this).data('op9');
                var p10 = $(this).data('op10');
                var dp = $(this).data('odp');                
                
                $(".modal-body #pno").val( pno );
                $(".modal-body #pclno").val( pclno );
                $(".modal-body #oup").val( up );
                $(".modal-body #opacking").val( packing );
                $(".modal-body #ouom").val( uom );                
                $(".modal-body #op1").val( p1 );
                $(".modal-body #op2").val( p2 );
                $(".modal-body #op3").val( p3 );
                $(".modal-body #op4").val( p4 );
                $(".modal-body #op5").val( p5 );
                $(".modal-body #op6").val( p6 );
                $(".modal-body #op7").val( p7 );
                $(".modal-body #op8").val( p8 );
                $(".modal-body #op9").val( p9 );
                $(".modal-body #op10").val( p10 );
                $(".modal-body #odp").val( dp );
                
                var nup = $(this).data('nup');
                var npacking = $(this).data('npacking');
                var nuom = $(this).data('nuom');                
                var np1 = $(this).data('np1');
                var np2 = $(this).data('np2');
                var np3 = $(this).data('np3');
                var np4 = $(this).data('np4');
                var np5 = $(this).data('np5');
                var np6 = $(this).data('np6');
                var np7 = $(this).data('np7');
                var np8 = $(this).data('np8');
                var np9 = $(this).data('np9');
                var np10 = $(this).data('np10');
                var ndp = $(this).data('ndp');
                $(".modal-body #nup").val( nup );
                $(".modal-body #npacking").val( npacking );
                $(".modal-body #nuom").val( nuom );                
                $(".modal-body #np1").val( np1 );
                $(".modal-body #np2").val( np2 );
                $(".modal-body #np3").val( np3 );
                $(".modal-body #np4").val( np4 );
                $(".modal-body #np5").val( np5 );
                $(".modal-body #np6").val( np6 );
                $(".modal-body #np7").val( np7 );
                $(".modal-body #np8").val( np8 );
                $(".modal-body #np9").val( np9 );
                $(".modal-body #np10").val( np10 );
                $(".modal-body #ndp").val( ndp );
            });
        });
}
</script>

<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
            Insert Price Change 
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <input class="form-control input-sm hide" type="text" name="pc_no"  value="<?php echo $pc[0]->pc_no; ?>" required autocomplete="off">
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <?php if($pc[0]->stat == "POSTED") { ?> 
                        <p class="form-control input-sm"><?php if($pc[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($pc[0]->date), 'm/d/Y');}?></p>                                                            
                        <?php } else { ?>
                        <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php if($pc[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($pc[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                                            
                        <?php }?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                        
                    </div>
                    
                </div> 
                
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-3">
                    <?php if($pc[0]->stat == "POSTED") { ?> 
                    <p class="form-control input-sm" ><?php echo $pc[0]->ref_no; ?></p>
                    <?php } else { ?>
                    <input id="ref_no1" class="form-control input-sm" type="text" name="ref_no1"  value="<?php echo $pc[0]->ref_no; ?>" required disabled autocomplete="off">
                    <?php }?>                    
                </div>
                
                <label class="col-sm-1 control-label">Effective Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                    <?php if($pc[0]->stat == "POSTED") { ?>
                        <p  class="form-control input-sm"><?php if($pc[0]->effectivedate == null){echo date('m/d/Y');}else{ echo date_format(date_create($pc[0]->effectivedate), 'm/d/Y');}?></p>                                    
                    <?php } else { ?>
                        <input  class="form-control input-sm" type="text" name="effectivedate" id="fbirthday" placeholder="click to show datepicker" value="<?php if($pc[0]->effectivedate == null){echo date('m/d/Y');}else{ echo date_format(date_create($pc[0]->effectivedate), 'm/d/Y');}?>" requred autocomplete="off">                                    
                    <?php }?>                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                    </div>                    
                </div> 
            </div>
            
            <div class="form-group row row-offcanvas">
                <label class="col-sm-2 control-label">Requested by:</label>
                <div class="col-sm-3">
                    <?php if($pc[0]->stat == "POSTED") { ?> 
                    <p class="form-control input-sm"><?php echo $pc[0]->requestedby; ?></p>
                    <?php } else { ?>
                    <input id="req1" class="form-control input-sm" type="text" name="req"  value="<?php echo $pc[0]->requestedby; ?>" required autocomplete="off">                                        
                    <?php }?>                    
                </div>
                <form role="form" method="post" action="<?=site_url('pricechange_con/insertproductview')?>">
                <div class="col-sm-7"> 
                    <input class="form-control input-sm hide" type="text" name="pc_no"  value="<?php echo $pc[0]->pc_no; ?>" required autocomplete="off">
                    <input class="form-control input-sm hide" type="text" name="date" id="date1" placeholder="click to show datepicker" >
                    <input id="req2" class="form-control input-sm hide" type="text" name="req"  autocomplete="off">
                    <input  class="form-control input-sm hide" type="text" name="edate" id="edate" >
                    <?php if($pc[0]->stat == "POSTED") { ?>                                   
                    <?php } else { ?>
                    <button type="submit" title="ADD Product" class="btn btn-success glyphicon glyphicon-plus pull-right"></button>                  
                    <?php }?>                    
                </div>  
                </form>
            </div>            
<!--        Modal -->
            <div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
               <div class="modal-dialog modal-sm">
                        <!-- Modal content -->
               <div class="modal-content">
                   <div class="modal-header">                    
                       <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Add Product - Edit Price</h4>
                   </div> <!-- End of Modal Header -->

                   <form role="form" method="post" action="<?=site_url('pricechange_con/updatepricechangeline')?>">
                       <div class="modal-body">   
                           <input  id="pno" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="p_no" value="" required autocomplete="off">
                           <input  id="pclno" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="pcl_no" value="" required autocomplete="off">
                           <input class="form-control input-sm hide" type="text" name="pc_no"  value="<?php echo $pc[0]->pc_no; ?>" required autocomplete="off">
                           <div class="form-group row row-offcanvas">
                               <label class="col-sm-12 control-label">Product Name</label>
                               <div class="col-sm-12">
                                   <p style="text-transform: capitalize;" class="form-control input-sm"><span class="prodname"></span></p>
                               </div>
                           </div>
                                                      
                            <div class="form-group row row-offcanvas">
                                 <label class="col-sm-6 control-label">UOM Old</label>
                                 <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="uom"></span></p>
                                    <input id="ouom" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="text" name="uomold" >
                                </div>
                                <div class="col-sm-6">
                                    <input id="nuom" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="text" placeholder="New UOM"  name="uomnew" required autocomplete="off" >
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Packing Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                           <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="packing"></span></p>
                                    <input id="opacking" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="number" name="packingold">
                                </div>
                               <div class="col-sm-6">
                                   <input id="npacking" style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number" placeholder="New Packing" required name="packingnew" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Unit Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                           <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="up"></span></p>
                                    <input  id="oup" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="unitpriceold"  step="any"placeholder="Unit Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input id="nup" style="text-transform: capitalize;" class="form-control input-sm" type="number" name="unitpricenew" step="any" placeholder="New Unit Price" value="" required autocomplete="off">
                                </div>
                            </div>                                                       
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Retail Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p1"></span></p>
                                    <input  id="op1" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="p1old" step="any" placeholder="Retail Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input id="np1" style="text-transform: capitalize;" class="form-control input-sm" type="number" name="p1new"  step="any" placeholder="New Retail Price" value="" required autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Wholesale Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p2"></span></p>
                                    <input  id="op2" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="p2old" step="any" placeholder="Wholesale Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input id="np2" style="text-transform: capitalize;" class="form-control input-sm" type="number" name="p2new" step="any" placeholder="New Wholesale Price" value="" required autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 3 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p3"></span></p>
                                    <input  id="op3" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p3old" placeholder="Price 3" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input id="np3" style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p3new" placeholder="New Price 3" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 4 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p4"></span></p>
                                    <input  id="op4" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p4old" placeholder="Price 4" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input id="np4" style="text-transform: capitalize;" class="form-control input-sm " type="number" step="any" name="p4new" placeholder="New Price 4" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 5 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p5"></span></p>
                                    <input  id="op5" style="text-transform: capitalize;" class="form-control input-sm hide"  type="number"step="any"  name="p5old" placeholder="Price 5" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input id="np5" style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p5new" placeholder="New Price 5" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 6 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p6"></span></p>
                                    <input  id="op6" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p6old" placeholder="Price 6" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input id="np6" style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p6new" placeholder="New Price 6" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 7 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p7"></span></p>
                                    <input  id="op7" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p7old" placeholder="Price 7" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input id="np7" style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p7new" placeholder="New Price 7" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 8 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p8"></span></p>
                                    <input  id="op8" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p8old" placeholder="Price 8" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input id="np8" style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p8new" placeholder="New Price 8" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 9 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p9"></span></p>
                                    <input  id="op9" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p9old" placeholder="Price 9" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input id="np9" style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p9new" placeholder="New Price 9" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 10 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p10"></span></p>
                                    <input  id="op10" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p10old" placeholder="Price 10" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input id="np10" style="text-transform: capitalize;" class="form-control input-sm" type="number"  step="any" name="p10new" placeholder="New Price 10" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Discounted Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm "><span class="p11"></span></p>
                                    <input  id="odp" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any"  name="p11old" placeholder="Discounted Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input id="ndp" style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p11new" placeholder="New Discounted Price" value=""  autocomplete="off">
                                </div>
                            </div>

                           <div class="modal-footer">
                                 <a title="Close" data-dismiss="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                                 <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                      
                           </div>
                       </div> <!-- End of Modal Body -->
                   </form>  
               </div> <!-- end pf modal content -->
               </div>
            </div>  <!-- End of model -->            
            
            
            <div style="height: 400px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">    
                <tr class="info">   
                    <?php if($pc[0]->stat == "POSTED") { ?>                     
                    <?php } else { ?>
                    <td class="text-center" style="vertical-align: middle;" colspan="2" rowspan="2"><strong>ACTION</strong></td>
                    <?php }?>                   
                    <td class="text-center" style="vertical-align: middle;" rowspan="2"><strong>Product Name</strong></td>                     
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>UOM</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Packing</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Unit Price</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Unit Cost</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Retail Price</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Wholesale Price</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 3</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 4</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 5</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 6</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 7</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 8</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 9</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Price 10</strong></td>
                    <td class="text-center" style="vertical-align: middle;" colspan="2"><strong>Discount Price</strong></td>                                                      
                </tr> 
                <tr class="info"> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td>
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td>
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td>
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td>
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td> 
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td>
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td>
                    <td class="text-center"><strong>Old</strong></td> 
                    <td class="text-center"><strong>New</strong></td>
                </tr> 
                <?php for($i=0; $i<count($pcl); $i++) { ?>                
               
                <tr>  
                    <?php if($pc[0]->stat == "POSTED") { ?>                     
                    <?php } else { ?>   
                    <td class="text-center" colspan="2">                                               
                        <button type="button" 
                                data-pclno="<?php echo $pcl[$i]->pcl_no;?>"
                                data-pno="<?php echo $pcl[$i]->p_no;?>"
                                data-longdesc="<?php echo $pcl[$i]->longdesc;?>"                                 
                                data-oup="<?php echo $pcl[$i]->oldunitprice;?>" 
                                data-opacking="<?php echo $pcl[$i]->oldpacking;?>"
                                data-ouom="<?php echo $pcl[$i]->olduom;?>"                                
                                data-op1="<?php echo $pcl[$i]->oldprice1;?>"
                                data-op2="<?php echo $pcl[$i]->oldprice2;?>"
                                data-op3="<?php echo $pcl[$i]->oldprice3;?>"
                                data-op4="<?php echo $pcl[$i]->oldprice4;?>"
                                data-op5="<?php echo $pcl[$i]->oldprice5;?>"
                                data-op6="<?php echo $pcl[$i]->oldprice6;?>"
                                data-op7="<?php echo $pcl[$i]->oldprice7;?>"
                                data-op8="<?php echo $pcl[$i]->oldprice8;?>"
                                data-op9="<?php echo $pcl[$i]->oldprice9;?>"
                                data-op10="<?php echo $pcl[$i]->oldprice10;?>"
                                data-odp="<?php echo $pcl[$i]->oldprice11;?>"
                                
                                data-nup="<?php echo $pcl[$i]->newunitprice;?>" 
                                data-npacking="<?php echo $pcl[$i]->newpacking;?>"
                                data-nuom="<?php echo $pcl[$i]->newuom;?>"                                
                                data-np1="<?php echo $pcl[$i]->newprice1;?>"
                                data-np2="<?php echo $pcl[$i]->newprice2;?>"
                                data-np3="<?php echo $pcl[$i]->newprice3;?>"
                                data-np4="<?php echo $pcl[$i]->newprice4;?>"
                                data-np5="<?php echo $pcl[$i]->newprice5;?>"
                                data-np6="<?php echo $pcl[$i]->newprice6;?>"
                                data-np7="<?php echo $pcl[$i]->newprice7;?>"
                                data-np8="<?php echo $pcl[$i]->newprice8;?>"
                                data-np9="<?php echo $pcl[$i]->newprice9;?>"
                                data-np10="<?php echo $pcl[$i]->newprice10;?>"
                                data-ndp="<?php echo $pcl[$i]->newprice11;?>"
                                data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" title="Edit" class="glyphicon glyphicon-pencil btn btn-info prod-edit"></button>                        
                        <a type="button" title="Delete" href="/mtpf/pricechange_con/delpricechangeline/<?php echo $pcl[$i]->pcl_no;?>/<?php echo $pc[0]->pc_no;?>" onclick="return confirm('Do you want to Delete?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                        
                    </td>
                    <?php }?>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pcl[$i]->longdesc;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pcl[$i]->olduom;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pcl[$i]->newuom;?></td>                              
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pcl[$i]->oldpacking;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pcl[$i]->newpacking;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldunitprice == null || $pcl[$i]->oldunitprice == ""){}else {echo number_format((float)$pcl[$i]->oldunitprice,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newunitprice == null || $pcl[$i]->newunitprice == ""){}else {echo number_format((float)$pcl[$i]->newunitprice,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldunitcost == null || $pcl[$i]->oldunitcost == ""){}else { echo number_format((float)$pcl[$i]->oldunitcost,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newunitcost == null || $pcl[$i]->newunitcost == ""){}else {echo number_format((float)$pcl[$i]->newunitcost,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice1 == null || $pcl[$i]->oldprice1 == ""){}else {echo number_format((float)$pcl[$i]->oldprice1,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice1 == null || $pcl[$i]->newprice1 == ""){}else {echo number_format((float)$pcl[$i]->newprice1,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice2 == null || $pcl[$i]->oldprice2 == ""){}else {echo number_format((float)$pcl[$i]->oldprice2,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice2 == null || $pcl[$i]->newprice2 == ""){}else {echo number_format((float)$pcl[$i]->newprice2,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice3 == null || $pcl[$i]->oldprice3 == ""){}else {echo number_format((float)$pcl[$i]->oldprice3,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice3 == null || $pcl[$i]->newprice3 == ""){}else {echo number_format((float)$pcl[$i]->newprice3,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice4 == null || $pcl[$i]->oldprice4 == ""){}else {echo number_format((float)$pcl[$i]->oldprice4,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice4 == null || $pcl[$i]->newprice4 == ""){}else {echo number_format((float)$pcl[$i]->newprice4,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice5 == null || $pcl[$i]->oldprice5 == ""){}else {echo number_format((float)$pcl[$i]->oldprice5,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice5 == null || $pcl[$i]->newprice5 == ""){}else {echo number_format((float)$pcl[$i]->newprice5,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice6 == null || $pcl[$i]->oldprice6 == ""){}else {echo number_format((float)$pcl[$i]->oldprice6,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice6 == null || $pcl[$i]->newprice6 == ""){}else {echo number_format((float)$pcl[$i]->newprice6,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice7 == null || $pcl[$i]->oldprice7 == ""){}else {echo number_format((float)$pcl[$i]->oldprice7,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice7 == null || $pcl[$i]->newprice7 == ""){}else {echo number_format((float)$pcl[$i]->newprice7,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice8 == null || $pcl[$i]->oldprice8 == ""){}else {echo number_format((float)$pcl[$i]->oldprice8,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice8 == null || $pcl[$i]->newprice8 == ""){}else {echo number_format((float)$pcl[$i]->newprice8,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice9 == null || $pcl[$i]->oldprice9 == ""){}else {echo number_format((float)$pcl[$i]->oldprice9,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice9 == null || $pcl[$i]->newprice9 == ""){}else {echo number_format((float)$pcl[$i]->newprice9,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice10 == null || $pcl[$i]->oldprice10 == ""){}else {echo number_format((float)$pcl[$i]->oldprice10,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice10 == null || $pcl[$i]->newprice10 == ""){}else {echo number_format((float)$pcl[$i]->newprice10,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->oldprice11 == null || $pcl[$i]->oldprice11 == ""){}else {echo number_format((float)$pcl[$i]->oldprice11,2,'.',',');}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($pcl[$i]->newprice11 == null || $pcl[$i]->newprice11 == ""){}else {echo number_format((float)$pcl[$i]->newprice11,2,'.',',');}?></td>
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>
            <form role="form" method="post" action="<?=site_url('pricechange_con/update_savepc')?>">
                <input class="form-control input-sm hide" type="text" name="pc_no"  value="<?php echo $pc[0]->pc_no; ?>" required autocomplete="off">
                <input class="form-control input-sm hide" type="text" name="date" id="date3" placeholder="click to show datepicker" >
                <input id="req3" class="form-control input-sm hide" type="text" name="req"   required autocomplete="off">                
                <input  class="form-control input-sm hide" type="text" name="edate" id="edate3" >                                  
                <div class="modal-footer">
                    <?php if($pc[0]->stat == "POSTED") { ?> 
                    <a title="Back" href="/mtpf/pricechange_con/pricechangeview" type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>
                    <?php } else { ?>                    
                    <a title="Close" href="/mtpf/pricechange_con/closepc/<?php echo $pc[0]->pc_no; ?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                    <button title="Save" id="submit" type="Submit"  onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                
                    <?php }?>
                </div>
            </form>  

        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->