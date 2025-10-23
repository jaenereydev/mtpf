<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Price Change Module</h3>        
        <a href="<?=site_url('pricechange_con/pricechangeinsert')?>" class="btn btn-info pull-right">Insert</a>        
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->               
        
        <div class="panel-body">              
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                <tr class="info">                                    
                    <td class="text-center"><strong>Action</strong></td>
                    <td class="text-center"><strong>#</strong></td> 
                    <td class="text-center"><strong>Date</strong></td>                        
                    <td class="text-center"><strong>Effective Date</strong></td> 
                    <td class="text-center"><strong>Posted</strong></td> 
                </tr> 
            </thead>
            <tbody>
                <?php for($i=0; $i<count($pc); $i++) { ?>    
                <?php if($pc[$i]->stat == "POSTED") { ?>
                <tr class="success">   
                <?php }else { ?>
                <tr >
                <?php }?>
                    <td class="text-center">
                        <?php if($pc[$i]->filestat == "OPEN") { ?>
                        File is OPEN
                        <?php if($users[0]->position == "Administrator") { ?>
                        <a title="Close" href="/mtpf/pricechange_con/closepc/<?php echo $pc[$i]->pc_no;?>" class="btn btn-info">CLOSE</a>
                        <?php }}else {?>
                        <?php if($pc[$i]->stat == "POSTED") { ?>
                        <a type="button" title="Vew" href="/mtpf/pricechange_con/insertpricechangeview/<?php echo $pc[$i]->pc_no;?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>
                        <a type="button" title="Print" href="/mtpf/pricechange_con/printpc/<?php echo $pc[$i]->pc_no;?>" onclick="return confirm('Do you want to Post this Document?');" class="glyphicon glyphicon-print btn btn-default"></a>
                        <?php }else { ?>
                            <a title="Edit" href="/mtpf/pricechange_con/updatepc/<?php echo $pc[$i]->pc_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <a type="button" title="Delete" href="/mtpf/pricechange_con/delpc/<?php echo $pc[$i]->pc_no;?>" onclick="return confirm('Do you want to delete this Document?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                            <?php if($pc[$i]->requestedby == null || $pc[$i]->requestedby == "") {}else if($pc[$i]->stat == "POSTED"){}else { ?>
                            <a type="button" title="POST" href="/mtpf/pricechange_con/postpc/<?php echo $pc[$i]->pc_no;?>" onclick="return confirm('Do you want to Post this Document?');" class="btn btn-success">POST</a>
                            <?php } ?>
                            <?php if($pc[$i]->stat == "POSTED") { ?>
                            <a type="button" title="Print" href="/mtpf/pricechange_con/printpc/<?php echo $pc[$i]->pc_no;?>" onclick="return confirm('Do you want to Post this Document?');" class="glyphicon glyphicon-print btn btn-default"></a>
                        <?php }}}?>
                    </td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pc[$i]->ref_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pc[$i]->date;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $pc[$i]->effectivedate;?></td>
                    <td class="text-center" style="text-transform: capitalize"><strong><?php echo $pc[$i]->stat;?></strong></td>
                </tr>
                <?php } ?>               
            </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>