<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-calendar" ></span> Due Date Information </h3>
             <div class="panel-toolbar text-right">
                <a title="Back to Due Date List" class="btn btn-warning btn-sm" href="<?=site_url('Duedate_con')?>"><span class=" glyphicon glyphicon-arrow-left"></span> Back</a>      
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
    

            <div class="form-group row">
                <label class="col-md-2">C.I.#</label>
                <div class="col-md-4"> 
                    <input type="text" class="form-control input-sm text-center " value="<?php echo $t[0]->ref_no ?>" disabled>
                </div>
                <label class="col-md-2">Date</label>
                <div class="col-md-4"> 
                    <input type="text" class="form-control input-sm text-center " value="<?php echo date_format(date_create($t[0]->date), 'm/d/Y'); ?>" disabled>
                </div>
            </div>

            
            
            <div class="form-group row">
                <label class="col-md-2">Due Date</label>
                <div class="col-md-4"> 
                    <input type="text" class="form-control input-sm text-center " value="<?php echo date_format(date_create($c[0]->duedate), 'm/d/Y'); ?>" disabled>
                </div>
                <label class="col-md-2">Customer name</label>
                <div class="col-md-4"> 
                    <input style="text-transform: capitalize" type="text" class="form-control input-sm text-center " value="<?php echo $t[0]->name ?>" disabled>
                </div>
            </div>
            <hr>                       

            <?php if(sizeof($tl)):  ?>         
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <thead>
                    <tr class="info">                                                                     
                        <td class="text-center"><strong>QTY</strong></td> 
                        <td class="text-center"><strong>Name</strong></td> 
                        <td class="text-center"><strong>Price</strong></td> 
                        <td class="text-center"><strong>Discount</strong></td>
                        <td class="text-center"><strong>Total Amount</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                      <?php $qty=0; $ta=0;  foreach ($tl as $key => $item): 
                        $dis = (($item->price*($item->qty-$item->returnqty))*$item->discount)/100; ?>                      
                        <tr  class="">                        
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty-$item->returnqty; $qty+=$item->qty-$item->returnqty; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',','); ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->discount.'% - '.number_format((float)$dis,2,'.',','); ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)($item->price*($item->qty-$item->returnqty))-$dis,2,'.',','); $ta+=($item->price*($item->qty-$item->returnqty))-$dis; ?></td>                        
                        </tr>
                     <?php endforeach;  else: ?>
                        <tr class="text-center">
                          <td class="text-center" colspan="5">There are no Data</td>
                        </tr>
                    <?php endif  ?>  
                    <tr class="text-center">
                        <td class="text-center"><strong><?php echo $qty ?></strong></td>
                        <td class="text-right" colspan="3"><strong>Discount</strong></td>
                        <td class="text-center"><strong><?php echo number_format((float)$t[0]->discount,2,'.',',') ?></strong></td>
                    </tr>  
                    <tr class="text-center">
                        <td class="text-right" colspan="4"><strong>Total Amount</strong></td>
                        <td class="text-center"><strong><?php echo number_format((float)$ta,2,'.',',') ?></strong></td>
                    </tr>  
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

