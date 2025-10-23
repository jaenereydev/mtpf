<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-calendar" ></span> Due Date List
            </h3>               
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
                       
            <?php if(sizeof($dd)):  ?>         
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>C.I. No.</strong></td> 
                        <td class="text-center"><strong>Date</strong></td> 
                        <td class="text-center"><strong>Due Date</strong></td> 
                        <td class="text-center"><strong>Transaction No.</strong></td>
                        <td class="text-center"><strong>Name</strong></td>   
                        <td class="text-center"><strong>Amount</strong></td>   
                        <td class="text-center"><strong>User</strong></td> 
                    </tr> 
                </thead>
                <tbody>
                      <?php  foreach ($dd as $key => $item): ?>                      
                        <tr  class=""> 
                        <td class="text-center">                                                  
                           <a type="button" title="view" href="<?=site_url('Duedate_con/duedateinfo/'. $item->transaction_t_no.'/'.$item->cdd_no)?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>                                                  
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->duedate), 'm/d/Y');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->transaction_t_no ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->username ?></td>
                    </tr>
                     <?php endforeach;  else: ?>
                        <tr class="text-center">
                          <td class="text-center" colspan="7">There are no Data</td>
                        </tr>
                    
                </tbody>
            </table>
            <?php endif  ?>     
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

