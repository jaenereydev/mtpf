<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Customer Deposit List
            </h3>         
            <div class="panel-toolbar text-right">
              
                <a href="<?php echo site_url('Customercategory_con') ?>" type="button" class="btn btn-warning " >Customer Category</a>  

                 <a href="<?php echo site_url('Customer_con') ?>" type="button" class="btn btn-success " >BACK</a>  
                <!-- <a  title="Print" type="button" data-toggle="modal" data-target="#report" class="btn btn-default glyphicon glyphicon-print pull-right" style="margin-right: 5px" ></a>    -->
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>Date</strong></td>                         
                        <td class="text-center"><strong>Customer Name</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($cus); $i++) { ?>                    
                    <tr> 
                        <td class="text-center">                                                  
                           <a type="button" title="Delete" href="<?=site_url('customer_con/delcustomerdeposit/'.$cus[$i]->cd_no.'/'.$cus[$i]->customer_c_no)?>" onclick="return confirm('Do you want to delete this Customer Deposit?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                           
                                                    
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cus[$i]->date;?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cus[$i]->name;?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$cus[$i]->amount,2,'.',',');?></td>  
                    </tr>
                    <?php } ?>   
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
 
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
