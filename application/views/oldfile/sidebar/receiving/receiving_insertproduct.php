<div style="margin-top: 60px;" class="container">
    <div class="row row-centered">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-shopping-cart"></span> Select Product
            </h3>    
            <a type="button" href="/mtpf/receiving_con/backreceiving/<?php echo $del[0]->d_no;?>" class="btn btn-warning pull-right">Back</a>
            <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <div style="height: 400px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-responsive table-bordered table-striped">                                                                
                <tr>                                                          
                    <td class="text-center"><strong>Product Name</strong></td> 
                    <td class="text-center"><strong>UOM</strong></td>     
                    <td class="text-center"><strong>QTY</strong></td>     
                    <td class="text-center"><strong>PCS</strong></td>     
                    <td class="text-center"><strong>Unit Price</strong></td>  
                    <td class="text-center"><strong>ACTION</strong></td>
                    
                </tr> 
                <?php for($i=0; $i<count($prod); $i++) { ?>                    
                <tr>                    
                    <td class="text-center" style="text-transform: capitalize"><?php echo $prod[$i]->longdesc;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $prod[$i]->uom; echo " "; echo $prod[0]->packing; ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$prod[$i]->qty,2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)($prod[$i]->qty/$prod[$i]->packing),2,'.',',');?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$prod[$i]->unitprice,2,'.',',');?></td>
                    <td class="text-center">
                        <a title="Select" href="/mtpf/receiving_con/insertdeliveryline/<?php echo $prod[$i]->p_no;?>/<?php echo $del[0]->d_no; ?>" class="btn btn-info">SELECT</a>                        
                    </td>
                </tr>
                <?php } ?>                         
                                                 
            </table>
            </div>
            <form role="form" method="post" action="<?=site_url('receiving_con/searchprod')?>">
                <input class="form-control input-sm hide" type="text" name="d_no" value="<?php echo $del[0]->d_no; ?>">   
                <input class="form-control input-sm hide" type="text" name="s_no" value="<?php echo $del[0]->s_no; ?>">   
                <div class="form-group row row-offcanvas" style="margin-top: 10px;">
                    <label class="col-sm-1 control-label">Search</label>                    
                    <div class="col-sm-5">
                        <input style="margin-top: 3px;" class="form-control input-sm" placeholder="Product Name" type="text" name="search" autofocus autocomplete="off">                                                
                    </div>
                    <button type="submit" class="glyphicon glyphicon-search btn btn-default"></button>
                </div>
            </form>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
</div> <!-- end of main div -->