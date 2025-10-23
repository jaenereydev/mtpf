<script type="text/javascript">

window.onload = function()
{      
       $(document).ready(function () {
            $(document).on('click', '.prod-add', function(event) {
                $('span.prodname').text($(this).data('ld'));                       
                var pno = $(this).data('pno');
                $(".modal-body #pno").val( pno );                               
            });
        });
        
        $(document).ready(function () {
            $(document).on('click', '.prod-edit', function(event) {
                $('span.eprodname').text($(this).data('ld'));                       
                var pno = $(this).data('pno');
                var dl = $(this).data('dl');
                var qty = $(this).data('qty');
                $(".modal-body #epno").val( pno );       
                $(".modal-body #eqty").val( qty );
                $(".modal-body #edl").val( dl );
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
            Disposal Module
            </h3>                
        </div> <!-- end of panel heading -->                       
        <form role="form" method="post" action="<?=site_url('disposal_con/update_savedisposal')?>">
        <div class="panel-body">  
            <input class="form-control input-sm hide" type="text" name="d_no"  value="<?php echo $d[0]->d_no; ?>" required autocomplete="off">
            <div class="form-group row row-offcanvas">
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3" id="datepicker"> 
                    <div class="input-group">
                        <?php if($d[0]->posted == "POSTED") { ?>
                        <p class="form-control input-sm" ><?php if($d[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($d[0]->date), 'm/d/Y');}?></p>                                   
                        <?php }else {?>
                        <input class="form-control input-sm" type="text" name="date" id="birthday" placeholder="click to show datepicker" value="<?php if($d[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($d[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                    
                        <?php }?>                        
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    
                </div> 
                
                <label class="col-sm-1 control-label">Reason</label>
                <div class="col-sm-5">
                    <?php if($d[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" style="text-transform: capitalize;"><?php echo $d[0]->reason; ?></p>                                
                    <?php }else {?>
                    <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="reason"  value="<?php echo $d[0]->reason; ?>" required autocomplete="off">                                        
                    <?php }?>                    
                </div>
                <input style="text-transform: capitalize;"  class="form-control input-sm hide" type="text" name="tq"  value="<?php echo $sum[0]->qty; ?>"  autocomplete="off">                                        
                <?php if($d[0]->posted == "POSTED") { ?>
                <?php }else {?>
                <div class="col-sm-2">
                <a title="Add Product" type="button" data-toggle="modal" data-target="#AddProductlist" class="btn btn-primary glyphicon glyphicon-plus pull-right"></a>                                  
                </div>
                <?php }?>
            </div>                                                
            
            <div style="height: 350px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                    
                <tr class="info">     
                    
                    <?php if($d[0]->posted == "POSTED") { ?>
                    <?php }else {?>
                    <td class="text-center" ><strong>Action</strong></td> 
                    <?php }?>                    
                    <td class="text-center"><strong>Product Name</strong></td>
                    <td class="text-center"><strong>Qty</strong></td> 
                </tr> 
                <?php for($i=0; $i<count($dl); $i++) { ?>                               
                <tr>           
                    <?php if($d[0]->posted == "POSTED") { ?>
                    <?php }else {?>
                    <td class="text-center">   
                        <button type="button"                                                               
                                data-ld="<?php echo $dl[$i]->longdesc;?>" 
                                data-qty="<?php echo $dl[$i]->qty;?>"
                                data-dl="<?php echo $dl[$i]->dl_no;?>"
                                data-toggle="modal" data-target="#editProduct"data-backdrop="static" data-keyboard="false" title="Edit" class="glyphicon glyphicon-pencil btn btn-info prod-edit"></button>
                        <a href="/mtpf/disposal_con/deldl/<?php echo $dl[$i]->dl_no; ?>/<?php echo $d[0]->d_no; ?>" type="button" title="Delete" class="glyphicon glyphicon-trash btn btn-danger"></a>
                    </td>
                    <?php }?>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo $dl[$i]->longdesc;?></td>
                    <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$dl[$i]->qty,2,'.',',');?></td>              
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>
               
            <div class="modal-footer">
                <?php if($d[0]->posted == "POSTED") { ?>
                <a title="Close" href="/mtpf/disposal_con"  type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>
                <?php }else {?>
                <a title="Close" href="/mtpf/disposal_con/closedisposal/<?php echo $d[0]->d_no; ?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                <button title="Save" id="submit" type="Submit"  onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                
                <?php }?>
            </div>
        </div> <!-- end of panel body -->
        </form>  
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div class="modal fade" id="AddProductlist" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
          <h4 class="modal-title text-center" id="creditModalLabel">Product List</h4>
        </div>
            <div class="modal-body table-responsive">
                <table class="table table-condensed table-bordered" id="MTable">  
                    <thead>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center">Product Name</td>
                            <td class="text-center">Qty</td>
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
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $item->qty ?></td>
                                <td class="text-center">
                                    <a title="button" 
                                       data-pno="<?php echo $item->p_no;?>"
                                       data-ld="<?php echo $item->longdesc;?>"
                                       data-toggle="modal" data-target="#addProduct"  data-backdrop="static" data-keyboard="false" title="Add Product" class="btn btn-primary prod-add" >SELECT</a>                                    
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

<!--Modal-->
<div id="addProduct" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
    <div class="modal-dialog modal-sm">
    <!--             Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Product Quantity</h4>
        </div><!-- End of Modal Header -->

        <form role="form" method="post" action="<?=site_url('disposal_con/insertdl')?>">
            <div class="modal-body">                   
                <input class="form-control input-sm hide" type="text" name="d_no"  value="<?php echo $d[0]->d_no; ?>" >
                <input id="pno" class="form-control input-sm hide" type="text" name="p_no"   >
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-12 control-label">Product Name</label>
                    <div class="col-sm-12">
                        <p style="text-transform: capitalize;" class="form-control input-sm"><span class="prodname"></span></p>
                    </div>
                </div>

                 <div class="form-group row row-offcanvas">
                     <label class="col-sm-12 control-label">Quantity</label>
                     <div class="col-sm-12">
                         <input id="qty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" value="" required autocomplete="off">
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
 
 <!--Modal-->
<div id="editProduct" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
    <div class="modal-dialog modal-sm">
    <!--             Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Quantity</h4>
        </div><!-- End of Modal Header -->

        <form role="form" method="post" action="<?=site_url('disposal_con/editdl')?>">
            <div class="modal-body">                   
                <input id="edl" class="form-control input-sm hide" type="text" name="dl_no"  >
                <input id="epno" class="form-control input-sm hide" type="text" name="p_no"  >
                <input class="form-control input-sm hide" type="text" name="d_no"  value="<?php echo $d[0]->d_no; ?>" >
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-12 control-label">Product Name</label>
                    <div class="col-sm-12">
                        <p style="text-transform: capitalize;" class="form-control input-sm"><span class="eprodname"></span></p>
                    </div>
                </div>

                 <div class="form-group row row-offcanvas">
                     <label class="col-sm-12 control-label">Quantity</label>
                     <div class="col-sm-12">
                         <input id="eqty" style="text-transform: capitalize;" class="form-control input-sm prodqty" step="any" type="number" name="qty" placeholder="Quantity" required autocomplete="off">
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
            
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>