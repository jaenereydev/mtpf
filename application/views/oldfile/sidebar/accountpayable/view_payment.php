<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main">
    <div class="row row-centered">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-eye-open"></span> View Payment
            </h3>    
            <a type="button" href="/mtpf/accountpayable_con/accountpayableview" class="btn btn-warning pull-right" accesskey="Backspace">Back</a>
            <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            <table class="table table-responsive table-bordered table-striped" id="MTable">                                                                
                <thead>
                    <tr>                                                 
                        <td class="text-center"><strong>Mode of Payment</strong></td> 
                        <td class="text-center"><strong>Check Number</strong></td> 
                        <td class="text-center"><strong>Check Date</strong></td>     
                        <td class="text-center"><strong>Bank Name</strong></td>  
                        <td class="text-center"><strong>Amount</strong></td>                    
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($cr); $i++) { ?>                    
                    <tr>                    
                        <td class="text-center" style="text-transform: capitalize"><?php if($cr[$i]->checkno == null || $cr[$i]->checkno == ""){ echo "Cash"; }else{ echo "Check";}?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cr[$i]->checkno;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cr[$i]->checkdate;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $cr[$i]->bankname;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$cr[$i]->checkamount,2,'.',',');?></td>
                    </tr>
                    <?php } ?>   
                </tbody>
            </table>                  
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
</div> <!-- end of main div -->
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>