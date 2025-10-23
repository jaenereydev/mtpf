<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list-alt" ></span> Delvery Search
            </h3>     
            
               
           

        <button type="button" data-toggle="modal" data-target="#adddelivery" class="btn btn-info pull-right" >New</button>               
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <div class="row">
                <form role="form" method="post" action="<?=site_url('delivery_con/searchdelivery')?>" >
                    <div class="form-stack has-icon col-sm-4">
                        <input type="text" name="search" class="form-control input-sm" placeholder="Search Document" autofocus required>                                     
                    </div>
                     <button type="submit" class="btn btn-sm btn-info">Search</button>   
                </form>
            </div>
            <hr>
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>   
                        <td class="text-center"><strong>Date</strong></td>   
                        <td class="text-center"><strong>Ref. No.</strong></td>                         
                        <td class="text-center"><strong>Supplier</strong></td>   
                        <td class="text-center"><strong>Posted</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($delivery as $key => $item): ?>                      
                    <tr> 
                        <td class="text-center info">     

                        <a title="Edit" href="<?=site_url('delivery_con/deliveryinfo/'.$item->d_no)?>" class="glyphicon glyphicon-pencil btn btn-info"></a>

                         <?php if($item->post == 'YES') {}else{ ?>
                        <a type="button" title="Delete" href="<?=site_url('delivery_con/deletedelivery/'. $item->d_no)?>" onclick="return confirm('Do you want to delete this Delivery File?');" class="glyphicon glyphicon-trash btn btn-danger"></a> 
                        <?php } ?>  

                        <?php if($item->totalamount < 1 || $item->totalamount == null || $item->post == 'YES') {}else{ ?>
                            <a title="Edit" href="<?=site_url('delivery_con/postdelivery/'.$item->d_no)?>" 
                                onclick="return confirm('Do you want to Post this file? This will update the inventory');"
                                class="btn btn-success">POST</a>
                        <?php } ?>

                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->d_no ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->post ?></td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        
<!-- Modal -->
<div id="adddelivery" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Supplier</h4>
        </div>
                           
            <div class="modal-body">                   
                <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable"> 
                <thead>
                    <tr class="info">                                                                
                        <td class="text-center"><strong>Supplier</strong></td>  
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($sup as $key => $item): ?>                      
                    <tr>                         
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center info">     
                            <a title="Select" href="<?=site_url('delivery_con/selectsupplier/'.$item->s_no)?>" class=" btn btn-info">SELECT</a>
                        </td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
            </div>                           
    </div>
  </div>
</div> <!-- End of model -->



<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
