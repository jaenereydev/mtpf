<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-shopping-cart"></span> Purchase Order
            </h3>                
        <a type="button" href="<?=site_url('purchaseorder_con/orderinginsertview')?>" class="btn btn-info pull-right">Insert</a>
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                <tr class="info">                                      
                    <td class="text-center"><strong>Action</strong></td>
                    <td class="text-center"><strong>POSTED</strong></td> 
                    <td class="text-center"><strong>#</strong></td> 
                    <td class="text-center"><strong>Date</strong></td>     
                    <td class="text-center"><strong>Supplier Name</strong></td> 
                    <td class="text-center"><strong>Status</strong></td> 
                    <td class="text-center"><strong>Delivery Date</strong></td>                     
                </tr> 
                </thead>
                <tbody>
                <?php if($ord == null || $ord == ""){}else {?>
                <?php for($i=0; $i<count($ord); $i++) { ?>   
                <?php if($ord[$i]->posted == 'POSTED'){?> 
                <tr class="warning">
                <?php }else { ?>
                <tr>
                <?php }?>
                    <?php if($ord[$i]->filestat == 'OPEN'){?>
                    <td class="text-center">OPEN
                    <?php if($users[0]->position == "Administrator") { ?>
                    <a title="close" href="/mtpf/purchaseorder_con/closepo/<?php echo $ord[$i]->po_no;?>" class="btn btn-info">Close</a>
                    </td>
                    <?php }?>
                    <?php }else if($ord[$i]->posted == 'POSTED'){?>     
                    <td class="text-center ">
                        <a title="view" href="/mtpf/purchaseorder_con/viewdoc/<?php echo $ord[$i]->po_no;?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>
                        <a type="button" title="Print" href="/mtpf/purchaseorder_con/printdoc/<?php echo $ord[$i]->po_no;?>" onclick="return confirm('Do you want to Print this Document');" class="glyphicon glyphicon-print btn btn-default"></a>
                    </td>
                    <?php } else{?>
                    <td class="text-center ">
                        <a title="Edit" href="/mtpf/purchaseorder_con/edit_po/<?php echo $ord[$i]->po_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                        <a type="button" title="Delete" href="/mtpf/purchaseorder_con/delpo/<?php echo $ord[$i]->po_no;?>/<?php echo $users[0]->u_no;?>" onclick="return confirm('Do you want to Delete this Document?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                        <?php if($ord[$i]->posted == 'POSTED' || $ord[$i]->s_no == null){ ?>
                        <?php }else {?>                       
                        <a type="button" title="Post Document" href="/mtpf/purchaseorder_con/postpo/<?php echo $ord[$i]->po_no;?>" onclick="return confirm('Do you want to POST this Document?');" class="btn btn-success">POST</a>
                        <?php }?>
                    </td>
                    <?php }?>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $ord[$i]->posted;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $ord[$i]->ref_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $ord[$i]->date;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($ord[$i]->s_no == null){}else{for($s=0;$s<count($sup);$s++){if($ord[$i]->s_no == $sup[$s]->s_no){echo $ord[$i]->s_no; echo " "; echo $sup[$s]->name;}}}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($ord[$i]->stat == 'NOTYETDELIVERED'){ echo "";}else if($ord[$i]->stat == 'PARTIALDELIVERED'){echo "PARTIAL DELIVERED";}else {echo $ord[$i]->stat;}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $ord[$i]->deliverydate;?></td>                    
                </tr>
                <?php } }?>                         
                </tbody>                                 
            </table>
            </div>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>