<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list" ></span> Credit Loan List
            </h3>        
            <div class="panel-toolbar text-right">  
            <a title="Dashboard" class="btn btn-default btn-sm" href="<?=site_url('dashboard')?>"><span class=" glyphicon glyphicon-dashboard"></span> Dashboard</a>
            <a title="Dashboard" class="btn btn-warning btn-sm" href="<?=site_url('Creditloan_con')?>"><span class=" glyphicon glyphicon-book"></span> Credit Loan</a>
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <!-- product table -->
             <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">             
                        <td class="text-center"><strong>Serial No.</strong></td>
                        <td class="text-center"><strong>Date</strong></td>                      
                        <td class="text-center"><strong>Principal Balance</strong></td>   
                        <td class="text-center"><strong>Down payment</strong></td>   
                        <td class="text-center"><strong>Terms</strong></td> 
                        <td class="text-center"><strong>Due Amount</strong></td>  
                        <td class="text-center"><strong>Outstanding Balance</strong></td>  
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($cllist as $key => $item): ?>                     
                        <tr class="<?php if($item->status == 'OPEN'){ echo 'warning'; }if($item->status == 'PAYED'){ echo 'success';} ?>">  
                        <td class="text-center" ><?php echo $item->cl_no;?></td> 
                        <td class="text-center" ><?php echo date_format(date_create($item->date), 'm/d/Y'); ?></td> 
                        <td class="text-center" ><?php echo number_format((float)$item->principal_balance,2,'.',',');?></td>  
                        <td class="text-center" ><?php echo number_format((float)$item->downpayment,2,'.',',');?></td> 
                        <td class="text-center" ><?php echo $item->termsbymonth;?></td>   
                        <td class="text-center" ><?php echo number_format((float)$item->due_amount,2,'.',',');?></td> 
                        <td class="text-center" ><?php echo number_format((float)$item->outstanding_balance,2,'.',',');?></td> 
                        <td class="text-center" >
                            <a title="" href="<?=site_url('Creditloan_con/creditloaninfo/'.$item->cl_no)?>" class="glyphicon glyphicon-pencil btn btn-primary btn-sm" ></a>
                            <a title="Print" href="<?=site_url('Creditloan_con/reprint/'.$item->cl_no)?>" class="glyphicon glyphicon-print btn btn-default btn-sm" target="_blank"></a>
                        </td> 
                    </tr>
                    <?php endforeach;  ?>   
                </tbody>
            </table> 
                       
        </div> <!-- end of panel body -->

    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

       
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>