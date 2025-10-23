<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10 main">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">            
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-signal" ></span> Inventory Cost
            </h3>  
            <a 
                title="Export to Excel" 
                target="_blank" 
                href="<?=site_url('report_con/exporttoexcel')?>" 
                class="glyphicon glyphicon-download-alt btn btn-success pull-right"></a>
                            
        </div> <!-- end of panel heading -->
        <div class="panel-body">

            <div class="col-sm-12">
                <div class="form-group row">               
                    <label class="col-sm-5 control-label"><a href="<?=site_url('Product_con')?>">Total Cost</a></label>
                    <div class="col-sm-7">
                        <p style="text-transform: capitalize;text-align: right;"  class="form-control input-sm"><strong>Php <?php echo number_format((float)$sumcost[0]->tcost,2,'.',','); ?></strong></p>
                    </div>                                        
                </div>  

                
                <div class="form-group row">               
                    <label class="col-sm-5 control-label">Total Quantity</label>
                    <div class="col-sm-7    ">
                        <p style="text-transform: capitalize;text-align: right;"  class="form-control input-sm"><strong><?php echo number_format((float)$sumcost[0]->tqty,2,'.',','); ?></strong></p>
                    </div>                                        
                </div>  

            </div><!--end of col-sm-6 -->


            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Barcode</strong></td>                       
                        <td class="text-center"><strong>Name</strong></td>   
                        <td class="text-center"><strong>Qty</strong></td>   
                        <td class="text-center"><strong>Unit Cost</strong></td>  
                        <td class="text-center"><strong>Total Amount</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($product as $key => $item): ?>                     
                    <tr> 
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name;?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty; ?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unitcost,2,'.',',');?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->qty*$item->unitcost,2,'.',',');?></td>  
                    </tr>
                    <?php endforeach;  ?>   
                </tbody>
            </table>

        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->    
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>