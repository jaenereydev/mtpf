<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-barcode" ></span> Inventory List
            </h3>     
            
        <a type="button" href="<?=site_url('Inventory_con/insertinventory')?>" onclick="return confirm('Do youo want to create file?');" class="btn btn-info pull-right" >New</a>               
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">              
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>   
                        <td class="text-center"><strong>Date</strong></td>   
                        <td class="text-center"><strong>Ref. No.</strong></td>   
                        <td class="text-center"><strong>Posted</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($inventory as $key => $item): ?>                      
                    <tr> 
                        <td class="text-center">     

                        <a title="Edit" href="<?=site_url('inventory_con/inventoryinfo/'.$item->i_no)?>" class="glyphicon glyphicon-pencil btn btn-info"></a>

                        <?php if($item->post == 'YES') {}else{ ?>
                        <a type="button" title="Delete" href="<?=site_url('inventory_con/deleteinventory/'. $item->i_no)?>" onclick="return confirm('Do you want to delete this Inventory File?');" class="glyphicon glyphicon-trash btn btn-danger"></a> 
                        <?php } ?>  

                        <?php if($item->post == 'YES') {}else{ ?>
                            <a title="Edit" href="<?=site_url('inventory_con/postinventory/'.$item->i_no)?>" 
                                onclick="return confirm('Do you want to Post this file? This will update the Product Qty');"
                                class="btn btn-success">POST</a>
                        <?php } ?>

                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->i_no ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->post ?></td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
