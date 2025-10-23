<script type="text/javascript">

window.onload = function()
{
        $(document).ready(function () {
            $('.prod-add').click(function () {
                var pno = $(this).data('pno');
                $('span.prodname').text($(this).data('longdesc'));
                $('span.uom').text($(this).data('uom'));
                $('span.up').text($(this).data('up'));                
                $('span.packing').text($(this).data('packing'));
                $('span.p1').text($(this).data('p1'));
                $('span.p2').text($(this).data('p2'));
                $('span.p3').text($(this).data('p3'));
                $('span.p4').text($(this).data('p4'));
                $('span.p5').text($(this).data('p5'));
                $('span.p6').text($(this).data('p6'));
                $('span.p7').text($(this).data('p7'));
                $('span.p8').text($(this).data('p8'));
                $('span.p9').text($(this).data('p9'));
                $('span.p10').text($(this).data('p10'));
                $('span.p11').text($(this).data('dp'));
                var up = $(this).data('up');
                var packing = $(this).data('packing');
                var uom = $(this).data('uom');
                var uc = $(this).data('uc');
                var p1 = $(this).data('p1');
                var p2 = $(this).data('p2');
                var p3 = $(this).data('p3');
                var p4 = $(this).data('p4');
                var p5 = $(this).data('p5');
                var p6 = $(this).data('p6');
                var p7 = $(this).data('p7');
                var p8 = $(this).data('p8');
                var p9 = $(this).data('p9');
                var p10 = $(this).data('p10');
                var dp = $(this).data('dp');
                $(".modal-body #pno").val( pno );
                $(".modal-body #up").val( up );
                $(".modal-body #packing").val( packing );
                $(".modal-body #uom").val( uom );
                $(".modal-body #uc").val( uc );
                $(".modal-body #p1").val( p1 );
                $(".modal-body #p2").val( p2 );
                $(".modal-body #p3").val( p3 );
                $(".modal-body #p4").val( p4 );
                $(".modal-body #p5").val( p5 );
                $(".modal-body #p6").val( p6 );
                $(".modal-body #p7").val( p7 );
                $(".modal-body #p8").val( p8 );
                $(".modal-body #p9").val( p9 );
                $(".modal-body #p10").val( p10 );
                $(".modal-body #dp").val( dp );
            });
        });
               
};
</script>

<div style="margin-top: 60px;" class="container">
    <div class="row row-centered">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-barcode"></span> Select Product
            </h3>    
            <a type="button" href="/mtpf/pricechange_con/insertpricechangeview/<?php echo $pc[0]->pc_no;?>" class="btn btn-warning pull-right">Back</a>
            <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <div style="height: 400px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-striped">                                                                
                <tr>                                                          
                    <td class="text-center"><strong>#</strong></td> 
                    <td class="text-center"><strong>Product Name</strong></td> 
                    <td class="text-center"><strong>ACTION</strong></td>
                    
                </tr> 
                <?php for($i=0; $i<count($prod); $i++) { ?>                    
                <tr>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $prod[$i]->p_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $prod[$i]->longdesc;?></td>
                    <td class="text-center">
                        <button type="button"                                  
                                data-pno="<?php echo $prod[$i]->p_no;?>"
                                data-longdesc="<?php echo $prod[$i]->longdesc;?>"                                 
                                data-up="<?php echo $prod[$i]->unitprice;?>"
                                data-uc="<?php echo $prod[$i]->unitcost;?>"
                                data-packing="<?php echo $prod[$i]->packing;?>"
                                data-uom="<?php echo $prod[$i]->uom;?>"                                
                                data-p1="<?php echo $prod[$i]->price1;?>"
                                data-p2="<?php echo $prod[$i]->price2;?>"
                                data-p3="<?php echo $prod[$i]->price3;?>"
                                data-p4="<?php echo $prod[$i]->price4;?>"
                                data-p5="<?php echo $prod[$i]->price5;?>"
                                data-p6="<?php echo $prod[$i]->price6;?>"
                                data-p7="<?php echo $prod[$i]->price7;?>"
                                data-p8="<?php echo $prod[$i]->price8;?>"
                                data-p9="<?php echo $prod[$i]->price9;?>"
                                data-p10="<?php echo $prod[$i]->price10;?>"
                                data-dp="<?php echo $prod[$i]->price11;?>"
                                data-toggle="modal" data-target="#myModal"data-backdrop="static" data-keyboard="false"
                                class="btn btn-info prod-add">SELECT</button>                        
                    </td>
                </tr>
                <?php } ?>                         
                                                 
            </table>
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

                   <form role="form" method="post" action="<?=site_url('pricechange_con/updateproductprice')?>">
                       <div class="modal-body">   
                           <input  id="pno" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="p_no" value="" required autocomplete="off">
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
                                    <input id="uom" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="text" name="uomold" >
                                </div>
                                <div class="col-sm-6">
                                    <input style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="text" placeholder="New UOM" required name="uomnew" >
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Packing Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                           <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="packing"></span></p>
                                    <input id="packing" style="text-transform: capitalize;" class="form-control input-sm hide"  step="any" type="number" name="packingold">
                                </div>
                               <div class="col-sm-6">
                                   <input style="text-transform: capitalize;" class="form-control input-sm "  step="any" type="number" placeholder="New Packing" required name="packingnew" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Unit Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                           <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="up"></span></p>
                                    <input  id="up" style="text-transform: capitalize;" class="form-control input-sm hide" step="any" type="number" name="unitpriceold" placeholder="Unit Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="unitpricenew" placeholder="New Unit Price" value="" required autocomplete="off">
                                </div>
                            </div>
                           
                           <input  id="uc" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="unitcostold"  step="any" placeholder="Unit Cost" value="" >                            
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Retail Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p1"></span></p>
                                    <input  id="p1" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any"  name="p1old" placeholder="Retail Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" name="p1new" step="any" placeholder="New Retail Price" value="" required autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Wholesale Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p2"></span></p>
                                    <input  id="p2" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any"  name="p2old" placeholder="Wholesale Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" name="p2new" step="any" placeholder="New Wholesale Price" value="" required autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 3 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p3"></span></p>
                                    <input  id="p3" style="text-transform: capitalize;" class="form-control input-sm hide" step="any" type="number" name="p3old" placeholder="Price 3" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p3new" placeholder="New Price 3" value="" autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 4 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p4"></span></p>
                                    <input  id="p4" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" step="any" name="p4old" placeholder="Price 4" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm " type="number" name="p4new" step="any" placeholder="New Price 4" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 5 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p5"></span></p>
                                    <input  id="p5" style="text-transform: capitalize;" class="form-control input-sm hide" step="any" type="number" name="p5old" placeholder="Price 5" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p5new" placeholder="New Price 5" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 6 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p6"></span></p>
                                    <input  id="p6" style="text-transform: capitalize;" class="form-control input-sm hide" step="any" type="number" name="p6old" placeholder="Price 6" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p6new" placeholder="New Price 6" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 7 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p7"></span></p>
                                    <input  id="p7" style="text-transform: capitalize;" class="form-control input-sm hide" step="any" type="number" name="p7old" placeholder="Price 7" value="" >
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any"  name="p7new" placeholder="New Price 7" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 8 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p8"></span></p>
                                    <input  id="p8" style="text-transform: capitalize;" class="form-control input-sm hide" step="any" type="number" name="p8old" placeholder="Price 8" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any" name="p8new" placeholder="New Price 8" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 9 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p9"></span></p>
                                    <input  id="p9" style="text-transform: capitalize;" class="form-control input-sm hide" step="any" type="number" name="p9old" placeholder="Price 9" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" step="any"  name="p9new" placeholder="New Price 9" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Price 10 Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p10"></span></p>
                                    <input  id="p10" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="p10old" step="any"  placeholder="Price 10" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" name="p10new" step="any" placeholder="New Price 10" value=""  autocomplete="off">
                                </div>
                            </div>
                           
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-6 control-label">Discounted Price Old</label>
                                <label class="col-sm-6 control-label">New</label>
                            </div>
                            <div class="form-group row row-offcanvas">                                
                                <div class="col-sm-6">
                                    <p style="text-transform: capitalize;" class="form-control input-sm"><span class="p11"></span></p>
                                    <input  id="dp" style="text-transform: capitalize;" class="form-control input-sm hide" type="number" name="p11old" step="any" placeholder="Discounted Price" value="">
                                </div>
                               <div class="col-sm-6">
                                    <input  style="text-transform: capitalize;" class="form-control input-sm" type="number" name="p11new" step="any"  placeholder="New Discounted Price" value=""  autocomplete="off">
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
            
            <form role="form" method="post" action="<?=site_url('pricechange_con/searchprod')?>">
                <input class="form-control input-sm hide" type="text" name="pc_no" value="<?php echo $pc[0]->pc_no; ?>">                   
                <div class="form-group row row-offcanvas" style="margin-top: 10px;">
                    <label class="col-sm-1 control-label">Search</label>                    
                    <div class="col-sm-5">
                        <input style="margin-top: 3px;" class="form-control input-sm" placeholder="#, Product Name" type="text" name="search" autofocus autocomplete="off">                                                
                    </div>
                    <button type="submit" class="glyphicon glyphicon-search btn btn-default"></button>
                </div>
            </form>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
</div> <!-- end of main div -->