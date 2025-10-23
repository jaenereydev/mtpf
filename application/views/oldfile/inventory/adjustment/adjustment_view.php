<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Stock Adjustment Module</h3>                
            <a type="button" href="<?=site_url('adjustment_con/insertadj')?>" class="btn btn-info pull-right">Insert</a>
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                               
        
        <div class="panel-body">  
            <table class="table table-hover atable-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                <tr class="info">                                    
                    <td class="text-center"><strong>Action</strong></td>
                    <td class="text-center"><strong>#</strong></td> 
                    <td class="text-center"><strong>Date</strong></td>                        
                    <td class="text-center"><strong>Sign</strong></td> 
                    <td class="text-center"><strong>Posted</strong></td> 
                </tr> 
                </thead>
                <tbody>
                <?php for($i=0; $i<count($adj); $i++) { ?>    
                <?php if($adj[$i]->posted == "POSTED") { ?>
                <tr class="success">   
                <?php }else { ?>
                <tr >
                <?php }?>
                    <td class="text-center">
                        <?php if($adj[$i]->filestat == "OPEN") { ?>
                        File is OPEN
                        <?php if($users[0]->position == "Administrator") { ?>
                        <a title="Close" href="/mtpf/adjustment_con/closeadj/<?php echo $adj[$i]->sa_no;?>" class="btn btn-info">CLOSE</a>
                        <?php }}else {?>
                            <?php if($adj[$i]->posted == "POSTED") { ?>
                            <a type="button" title="View" href="/mtpf/adjustment_con/adjustmentinsertview/<?php echo $adj[$i]->sa_no;?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>                        
                            <a type="button" title="Print" href="/mtpf/adjustment_con/printadj/<?php echo $adj[$i]->sa_no;?>" onclick="return confirm('Do you want to Print this Document?');" class="glyphicon glyphicon-print btn btn-default"></a>
                            <?php }else { ?>
                                <a title="Edit" href="/mtpf/adjustment_con/editadj/<?php echo $adj[$i]->sa_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                                <a type="button" title="Delete" href="/mtpf/adjustment_con/deladj/<?php echo $adj[$i]->sa_no;?>" onclick="return confirm('Do you want to Delete this Document?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                        
                                <?php if($adj[$i]->posted == "POSTED") { ?>
                                <a type="button" title="Print" href="/mtpf/adjustment_con/printadj/<?php echo $adj[$i]->sa_no;?>" onclick="return confirm('Do you want to Print this Document?');" class="glyphicon glyphicon-print btn btn-default"></a>
                                <?php }else { ?> 
                                    <?php if($adj[$i]->date == null || $adj[$i]->date == "" || $adj[$i]->posted == "POSTED" || $adj[$i]->sign == null || $adj[$i]->sign == "") {}else { ?>
                                    <a type="button" title="POST" href="/mtpf/adjustment_con/postadj/<?php echo $adj[$i]->sa_no;?>/<?php if($adj[$i]->sign == '+'){echo '1';}else{ echo '0';} ?>" onclick="return confirm('Do you want to Post this Document?');" class="btn btn-success">POST</a>
                            <?php } }}} ?>
                    </td>
                    <?php if($adj[$i]->ref_no == null) { ?><td class="text-center warning"><?php }else { ?>
                    <td class="text-center" style="text-transform: capitalize"><?php } echo $adj[$i]->ref_no;?></td>
                    <?php if($adj[$i]->date == null) { ?><td class="text-center warning"><?php }else { ?>
                    <td class="text-center" style="text-transform: capitalize"><?php } echo $adj[$i]->date;?></td>
                    <?php if($adj[$i]->sign == null) { ?><td class="text-center warning"><?php }else { ?>
                    <td class="text-center" style="text-transform: capitalize"><?php } if($adj[$i]->sign == "+"){echo "Addition(+)";}else  if($adj[$i]->sign == "-"){echo "Subtraction(-)";}?></td>
                    <?php if($adj[$i]->posted == null) { ?><td class="text-center warning"><?php }else { ?>
                    <td class="text-center" style="text-transform: capitalize"><strong><?php } echo $adj[$i]->posted;?></strong></td>
                </tr>
                <?php } ?>                                                                          
            </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>