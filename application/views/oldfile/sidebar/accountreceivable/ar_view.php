<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-plus-sign" ></span> Account Receivable
            </h3>        
        <div class="pull-right">
            <a type="button" href="<?=site_url('accountreceivable_con/insertarview')?>" class="btn btn-info" >New</a> 
        </div>
        </div> <!-- end of panel heading -->               
        
        <div class="panel-body">              
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">      
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>  
                        <td class="text-center"><strong>Date</strong></td>
                        <td class="text-center"><strong>Ref No.</strong></td>
                        <td class="text-center"><strong>O.R. No.</strong></td>
                        <td class="text-center"><strong>Customer</strong></td>                                                
                        <td class="text-center"><strong>Amount</strong></td>
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($ar); $i++) { ?>                           
                    <tr> 
                        <td class="text-center info">     
                            <?php if($ar[$i]->posted != "POSTED") { ?>
                            <a title="Edit" href="/mtpf/accountreceivable_con/editcp/<?php echo $ar[$i]->cp_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <a type="button" title="Delete" href="/mtpf/accountreceivable_con/delcp/<?php echo $ar[$i]->cp_no;?>" onclick="return confirm('Do you want to delete this file?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                          
                                <?php if(($ar[$i]->c_no == null)||($ar[$i]->totalamount == null)) {}else { ?>
                                <a type="button" title="Post" href="/mtpf/accountreceivable_con/postcp/<?php echo $ar[$i]->cp_no;?>/<?php echo $ar[$i]->c_no;?>/<?php echo $ar[$i]->totalamount;?>" onclick="return confirm('Do you want to Post this file?');" class=" btn btn-success">POST</a>                          
                                <?php }?>
                            <?php }else { ?>
                                <a type="button" href="/mtpf/accountreceivable_con/arinsertview/<?php echo $ar[$i]->cp_no;?>" title="View" class=" btn btn-info glyphicon glyphicon-eye-open"></a>                                    
                                <a type="button" href="/mtpf/accountreceivable_con/printar/<?php echo $ar[$i]->cp_no;?>" title="Print" onclick="return confirm('Do you want to Print this file?');"  class=" btn btn-default glyphicon glyphicon-print"></a>                                    
                            <?php }?>
                        </td>       
                        <td class="text-center" style="text-transform: capitalize"><?php echo $ar[$i]->date;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $ar[$i]->ref_no;?></td> 
                        <td class="text-center" style="text-transform: capitalize"><?php echo $ar[$i]->or_no;?></td>   
                        <td class="text-center" style="text-transform: capitalize"><?php for($r=0;$r<count($cus);$r++)
                                                                                    {
                                                                                    if($ar[$i]->c_no == ""||$ar[$i]->c_no == null){}
                                                                                    else { if($cus[$r]->c_no == $ar[$i]->c_no)
                                                                                            { echo $cus[$r]->name;}
                                                                                            }} ?></td>                                                   
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$ar[$i]->totalamount,2,'.',',');?></td>
                    </tr>
                    <?php } ?>   
                </tbody>
            </table>           
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>