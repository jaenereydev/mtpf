<div style="margin-top: 60px;" class="container">
    <div class="row row-centered">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-shopping-cart"></span> Select Purchase Order
            </h3>    
            <a type="button" href="/mtpf/receiving_con/backreceiving/<?php echo $del[0]->d_no;?>" class="btn btn-warning pull-right">Back</a>
            <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">              
                        
            <div style="height: 400px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-hover">                                                                
                <tr class="info">                                                                      
                    <td class="text-center"><strong>POSTED</strong></td> 
                    <td class="text-center"><strong>P.O. No</strong></td> 
                    <td class="text-center"><strong># Supplier Name</strong></td> 
                    <td class="text-center"><strong>Status</strong></td> 
                    <td class="text-center"><strong>ACTION</strong></td>
                </tr> 
                <?php for($i=0; $i<count($po); $i++) { ?>                
                <tr>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $po[$i]->posted;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $po[$i]->ref_no;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php for($o=0;$o<count($supactive);$o++) { if($supactive[$o]->s_no == $po[$i]->s_no) { echo $po[$i]->s_no; echo " ";  echo $supactive[$o]->name;}}?></td>
                <td class="text-center" style="text-transform: capitalize"><?php if($po[$i]->stat == 'NOTYETDELIVERED'){ echo "";}else if($po[$i]->stat == 'PARTIALDELIVERED'){echo "PARTIAL DELIVERED";}else{ echo $po[$i]->stat;} ?></td>                                
                    <td class="text-center">                                                            
                        <a type="button" title="Select" href="/mtpf/receiving_con/selectpo/<?php echo $po[$i]->po_no;?>/<?php echo $del[0]->d_no;?>/<?php echo $po[$i]->s_no;?>/<?php echo $po[$i]->stat;?>" class="btn btn-info">SELECT</a>
                    </td>
                </tr>
                <?php } ?>                                                    
            </table>
            </div> 
            
            <form role="form" method="post" action="<?=site_url('receiving_con/searchpopo')?>">
                <input class="form-control input-sm hide" type="text" name="d_no" value="<?php echo $del[0]->d_no; ?>">                   
                <div class="form-group row row-offcanvas" style="margin-top: 10px;">
                    <label class="col-sm-1 control-label">Search</label>                    
                    <div class="col-sm-5">
                        <input style="margin-top: 3px;" class="form-control input-sm" placeholder="PO #, SUPPLIER #" type="text" name="search" required autofocus>                                                
                    </div>
                    <button type="submit" class="glyphicon glyphicon-search btn btn-default"></button>
                </div>
            </form>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
</div> <!-- end of main div -->