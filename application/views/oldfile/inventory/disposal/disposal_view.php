<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Disposal List</h3>        
        <a href="<?=site_url('disposal_con/insertdisposal')?>" type="button" class="btn btn-info pull-right" >New</a>               
        </div> <!-- end of panel heading -->              
        
        <div class="panel-body">            
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                    <tr class="info">   
                        <td class="text-center" ><strong>Action</strong></td>
                        <td class="text-center"><strong>Date</strong></td> 
                        <td class="text-center"><strong>Total Qty</strong></td>                                                
                        <td class="text-center"><strong>Reason</strong></td>                                                
                    </tr> 
                </thead> 
                <tbody>
                    <?php for($i=0; $i<count($dis); $i++) { ?>                    
                    <tr>   
                        <td class="text-center info">
                            <?php if($dis[$i]->posted == "POSTED") { ?>
                            <a type="button" title="View" href="/mtpf/disposal_con/disposalinsertview/<?php echo $dis[$i]->d_no;?>"  class="btn btn-info glyphicon glyphicon-eye-open"></a>
                            <a type="button" title="Print" href="/mtpf/disposal_con/printdisposal/<?php echo $dis[$i]->d_no;?>"  class="btn btn-default glyphicon glyphicon-print"></a>
                            <?php }else {?>
                            <a title="Edit" href="/mtpf/disposal_con/disposalinsertview/<?php echo $dis[$i]->d_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <a type="button" title="Delete" href="/mtpf/disposal_con/deldisposal/<?php echo $dis[$i]->d_no;?>" onclick="return confirm('Do you want to delete the Document?');" class="glyphicon glyphicon-trash btn btn-danger"  ></a>
                            <a  onclick="return confirm('Do you want to Post this Document?');" class="btn btn-success" <?php if($dis[$i]->totalqty == null || $dis[$i]->totalqty == '' || $dis[$i]->date == null) { ?>Disabled<?php } ?> type="button" title="Post" href="/mtpf/disposal_con/postdisposal/<?php echo $dis[$i]->d_no;?>">POST</a>
                            <?php } ?>
                        </td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $dis[$i]->date;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$dis[$i]->totalqty,2,'.',',');?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $dis[$i]->reason;?></td>                        
                    </tr>
                    <?php } ?>                         
                </tbody>                               
            </table>            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>