<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-folder-open" ></span> Credit Payment List
            </h3>     
            
        <div class="panel-toolbar text-right">
          <button type="button" data-toggle="modal" data-target="#selectcustomer" class="btn btn-info " >New</button> 
           <a title="Dashboard" class="btn btn-default btn-sm" href="<?=site_url('Sales_con/transactionlist')?>"><span class="    glyphicon glyphicon-tags"></span> Transaction List</a>   
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>   
                        <td class="text-center"><strong>Date</strong></td>   
                        <td class="text-center"><strong>Name</strong></td>                         
                        <td class="text-center"><strong>Credit Amount</strong></td>
                        <td class="text-center"><strong>Payed Amount</strong></td>   
                        <td class="text-center"><strong>Posted</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($cplist as $key => $item): ?>                      
                    <tr> 
                        <td class="text-center">     

                        <a title="View" href="<?=site_url('Creditpayment_con/creditpaymentinfo/'.$item->cp_no)?>" class="glyphicon glyphicon-pencil btn btn-info"></a>

                        <?php if($item->post == 'YES') {}else{ ?>
                        <a type="button" title="Delete" href="<?=site_url('Creditpayment_con/deletecreditpayment/'. $item->cp_no)?>" onclick="return confirm('Do you want to delete this Credit Payment File?');" class="glyphicon glyphicon-trash btn btn-danger"></a> 
                        <?php } ?>  
                        <?php if($item->totalpayment < 1 || $item->totalpayment == null || $item->post == 'YES') {}else{ ?>
                            <a title="Post" href="<?=site_url('Creditpayment_con/postcreditpayment/'.$item->cp_no)?>" 
                                onclick="return confirm('Do you want to Post this file? This will update the Customer Credit Balance');"
                                class="btn btn-success">POST</a>
                        <?php } ?>
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->cp_no ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalcredit,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalpayment,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->post ?></td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->    

<!-- Modal -->
<div id="selectcustomer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Customer</h4>
        </div>
                           
            <div class="modal-body">                    

                <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable"> 
                <thead>
                    <tr class="info">                                                                
                        <td class="text-center"><strong>Customer Name</strong></td> 
                        <td class="text-center"><strong>Credit Limit</strong></td> 
                        <td class="text-center"><strong>Balance</strong></td>  
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($cus as $key => $item): ?>                      
                    <tr>                         
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->credit_limit,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->balance,2,'.',','); ?></td>
                        <td class="text-center info">     
                            <a title="Select" href="<?=site_url('Creditpayment_con/insertcreditpayment/'.$item->c_no)?>" class=" btn btn-info">SELECT</a>
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
