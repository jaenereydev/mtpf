<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<style>
    .select2-container {
    width: 100% !important; /* Makes sure it occupies full width */
    min-width: 300px; /* Adjust as needed */
}
</style>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Insert Stock Adjustment
            </h3>            
        </div> <!-- end of panel heading -->        
        
        <form onsubmit="return insertstockadjustmentform(this);" role="form" method="post" action="<?=site_url('Stockadjustmentinfo_con/poststockadjustment')?>">             
        <div class="panel-body">  

            <div class="row">

                <div class="col-md-8">
                    <div class="form-group row ">                        
                        <label class="col-sm-2 control-label">Doc. No.</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm " type="text" disabled value="<?php echo $stockadjustmentinfo[0]->sa_no; ?>"   />
                        </div>    
                        <label class="col-sm-2 control-label">Sign</label>
                        <div class="col-sm-4">
                        <?php if($stockadjustmentinfo[0]->post == 'YES') { ?>
                            <input class="form-control input-sm " type="text" disabled value="<?php 
                                                                                        if ($stockadjustmentinfo[0]->status == '+') {
                                                                                            echo "+ Positive Adjustment";
                                                                                        } else {
                                                                                            echo "- Negative Adjustment";
                                                                                        }
                                                                                        ?>"   />
                        <?php }else { ?>
                            <select id="status" name="status" class="form-control" style="width: 100% !important" required>
                                <option value="">Please select Sign</option>
                                <option value="+" <?= ($stockadjustmentinfo[0]->status == '+') ? 'selected' : '' ?>>+ Postive Adjustment</option>
                                <option value="-" <?= ($stockadjustmentinfo[0]->status == '-') ? 'selected' : '' ?>>- Negative Adjustment</option>
                            </select>
                        <?php } ?>
                        </div> 
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group row ">                         
                        <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { ?>
                            <div class="col-sm-12">
                                <button type="button" data-toggle="modal" data-target="#addproduct" class="btn btn-success pull-right" >INSERT PRODUCT</button> 
                            </div>   
                        <?php } ?>
                    </div>
                </div> 

            </div>           
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <thead>
                    <tr class="info">        
                        <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { ?>                                                    
                            <td class="text-center"><strong>Action</strong></td>  
                        <?php } ?>                                           
                        <td class="text-center"><strong>Description</strong></td>                        
                        <td class="text-center"><strong>Unit Cost</strong></td> 
                        <td class="text-center"><strong>QTY</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php $ta=0;$q=0; if(sizeof($stockadjustmentline)):  foreach ($stockadjustmentline as $key => $item):  ?>                      
                    <tr>     
                        <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { ?>    
                        <td class="text-center" style="text-transform: capitalize">
                            <a title="Edit" href="<?=site_url('Stockadjustmentinfo_con/deletestockadjustmentline/'.$item->sal_no)?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Do you want to delete this product');"></a>
                        </td>
                        <?php } ?>
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unit_cost,2,'.',',') ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty; $q+=$item->qty; ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unit_cost*$item->qty,2,'.',','); $ta+=$item->unit_cost*$item->qty ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                        <tr class="text-center">
                            <td colspan="5">There are no Data</td>
                        </tr>
                    <?php endif?> 
                </tbody>
            </table>
            <div class="row">
                <input class="hide" type="text" name="totalamount" value="<?php echo $ta ?>" />
            </div>
        </div> <!-- end of panel body -->
        <div class="modal-footer">            
            <a title="Close" href="<?=site_url('Stockadjustment_con')?>" onclick="return confirm('Do you want to go back');" type="button" class="btn btn-warning" >BACK</a>    
            <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { 
                if($q <= 0){}else{
                ?>        
                <input type="submit" onclick="return confirm('Do you want to save this file?');" class="btn btn-primary" value="SUBMIT AND POST">
            <?php }} ?>
        </div>
    </form>
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<!-- Modal -->
<div id="addproduct" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">                    
                <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Product</h4>
            </div>
                            
            <div class="modal-body">                   
                <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable" > 
                    <thead>
                        <tr class="info">                                        
                            <td class="text-center"><strong>Barcode</strong></td>                        
                            <td class="text-center"><strong>Product</strong></td>  
                            <td class="text-center"><strong>Action</strong></td>  
                        </tr> 
                    </thead>
                    <tbody>
                        <?php foreach ($prod as $key => $item): ?>                      
                        <tr>                         
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                            <td class="text-center info">                                
                                <button title="Add QTY" 
                                    data-pno="<?php echo $item->p_no;?>"                                
                                    data-name="<?php echo $item->name;?>"
                                    data-unitcost="<?php echo $item->unitcost;?>"                                
                                    data-toggle="modal" data-target="#addqty" 
                                    class="glyphicon glyphicon-plus btn btn-info addqty"
                                    data-backdrop="static" data-keyboard="false"></button>
                            </td>
                        </tr>
                        <?php endforeach;  ?>     
                    </tbody>
                </table>
            </div>                           
        </div>
    </div>
</div> <!-- End of model -->

<!-- Modal -->
<div id="addqty" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Add Quantity</h4>
        </div>
            
        <form onsubmit="return qtyform(this);" role="form" method="post" action="<?=site_url('Stockadjustmentinfo_con/insertstockadjustmentline')?>">             
        <div class="modal-body">            

            <input id="pno" class="form-control input-sm hide" type="text" name="pno" />
            <input id="unitcost" class="form-control input-sm hide" type="text" name="unitcost" /> 
        
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-5 control-label">Product Name</label>
                <div class="col-sm-7">
                    <input id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-5 control-label">Qty</label>
                <div class="col-sm-7">
                    <input id="qty" class="form-control input-sm " type="text" name="qty" required autocomplete="off" />
                </div>   

            </div>
        
        </div>
        <div class="modal-footer">
                <a title="Close" href="<?=site_url('Deliveryinfo_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
            <input type="submit" class="btn btn-primary" name="qtyaddbtn" value="submit">
            </div>
        </form>

    </div>
    </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>


<script type="text/javascript">

function qtyform(formObj) {            
        formObj.qtyaddbtn.disabled = true;  
        formObj.qtyaddbtn.value = 'Please Wait...';  
        return true;    
    }  

                        
window.onload = function()
{                         

    $(document).ready(function () {
        $(document).on('click', '.addqty', function(event) {        
            var pno = $(this).data('pno');
            var name = $(this).data('name');
            var unitcost = $(this).data('unitcost');
            $(".modal-body #pno").val( pno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
        });
    });

    $(document).ready(function () {
        $(document).on('click', '.editqty', function(event) {        
            var dlno = $(this).data('dlno');
            var name = $(this).data('name');
            var unitcost = $(this).data('unitcost');
            var qty = $(this).data('qty');
            $(".modal-body #dlno").val( dlno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
            $(".modal-body #qty").val( qty );
        });
    });

    
    $(document).ready(function() {
    $('#status').on('change', function() {
        const status = $(this).val();
        const sa_no = '<?= $stockadjustmentinfo[0]->sa_no ?>'; // or session if needed

        $.ajax({
            url: "<?= site_url('Stockadjustmentinfo_con/updatestatus') ?>",
            type: "POST",
            data: {
                status: status,
                sa_no: sa_no
            },
            success: function(response) {
                alert("Status updated successfully!");
            },
            error: function(xhr) {
                alert("Failed to update status.");
            }
        });
        });
    });

}


</script>