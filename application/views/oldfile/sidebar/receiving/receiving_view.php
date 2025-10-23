<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-road"></span> Receiving Goods From Supplier
            </h3>                
        <a type="button" href="<?=site_url('receiving_con/receivinginsertview')?>" class="btn btn-info pull-right">Insert</a>
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">             
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                <tr class="info">                                      
                    <td class="text-center"><strong>Action</strong></td>
                    <td class="text-center"><strong>POSTED</strong></td>
                    <td class="text-center"><strong>#</strong></td> 
                    <td class="text-center"><strong>P.O.#</strong></td>                    
                    <td class="text-center"><strong>Date</strong></td>     
                    <td class="text-center"><strong>Supplier Name</strong></td> 
                    <td class="text-center"><strong>Status</strong></td>                                         
                </tr> 
                </thead>
                <tbody>
                <?php for($i=0; $i<count($rec); $i++) { ?>  
                <?php if($rec[$i]->filestat == 'PAYED'){?> 
                <tr class="success" title="<?php echo $rec[$i]->filestat;?>">                
                <?php }else if($rec[$i]->posted == 'POSTED'){?> 
                <tr class="warning" title="<?php echo $rec[$i]->filestat;?>">                
                <?php }else { ?>
                <tr>
                <?php }?>
                    <?php if($rec[$i]->filestat == 'OPEN'){?>
                    <td class="text-center">OPEN
                    <?php if($users[0]->position == "Administrator") { ?>
                    <a title="close" href="/mtpf/receiving_con/closedel/<?php echo $rec[$i]->d_no;?>" class="btn btn-info">Close</a>
                    </td>
                    <?php }?>
                    <?php }else if($rec[$i]->posted == 'POSTED'){?>     
                    <td class="text-center ">
                        <a title="View" href="/mtpf/receiving_con/viewdoc/<?php echo $rec[$i]->d_no;?>/"  class="glyphicon glyphicon-eye-open btn btn-info"></a>
                        <a type="button" title="Print" href="/mtpf/receiving_con/printdoc/<?php echo $rec[$i]->d_no;?>/" onclick="return confirm('Do you want to Print this Document');" class="glyphicon glyphicon-print btn btn-default"></a>
                    </td>
                    <?php } else{?>
                    <td class="text-center ">
                        <a title="Edit" href="/mtpf/receiving_con/edit_del/<?php echo $rec[$i]->d_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                        <a type="button" title="Delete" href="/mtpf/receiving_con/deldel/<?php echo $rec[$i]->d_no;?>" onclick="return confirm('Do you want to delete this Document?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                        <?php if($rec[$i]->posted == 'POSTED' || $rec[$i]->s_no == null || $rec[$i]->totalamount == null || $rec[$i]->totalamount == ""){ ?>
                        <?php }else {?>
                        <a type="button" title="Print" href="/mtpf/receiving_con/printdoc/<?php echo $rec[$i]->d_no;?>/" onclick="return confirm('Do you want to Print this Document');" class="glyphicon glyphicon-print btn btn-default"></a>
                        <a type="button" title="Post Document" href="/mtpf/receiving_con/postdel/<?php echo $rec[$i]->d_no;?>/<?php echo $rec[$i]->po_no;?>" onclick="return confirm('Do you want to POST this Document?');" class="btn btn-success">POST</a>
                        <?php }?>
                    </td>
                    <?php }?>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $rec[$i]->posted;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $rec[$i]->ref_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php for($r=0;$r<count($porefno);$r++)
                                                                                {
                                                                                if($rec[$i]->po_no == ""||$rec[$i]->po_no == null){}
                                                                                else { if($porefno[$r]->po_no == $rec[$i]->po_no)
                                                                                        { echo $porefno[$r]->ref_no;}
                                                                                }} ?></td>                    
                    <td class="text-center" style="text-transform: capitalize"><?php echo $rec[$i]->date;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($rec[$i]->s_no == null){}else{for($s=0;$s<count($sup);$s++){if($rec[$i]->s_no == $sup[$s]->s_no){ echo $rec[$i]->s_no; echo " ";  echo $sup[$s]->name;}}}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($rec[$i]->stat == 'PARTIALDELIVERED'){ echo "PARTIAL DELIVERED";}else{ echo $rec[$i]->stat;}?></td>                    
                </tr>                
                <?php } ?>                         
                </tbody>                 
            </table>     
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>