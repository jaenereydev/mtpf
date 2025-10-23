<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>


<div class="col-md-12 main" style="padding-top: 60px;">
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Credit Loan Information
            </h3>            
            <div class="panel-toolbar text-right">
                <a class="btn btn-sm btn-danger" href="<?=site_url('Creditloan_con/creditlist')?>"><span class=" glyphicon glyphicon-arrow-left"></span> Back</a>                   
            </div>
        </div> <!-- end of panel heading -->  
        
        <div class="panel-body">
            <div class="form-group row">
                <label class="col-md-3">Date</label>
                <div class="col-md-9">     
                    <input type="text" class="form-control input-sm text-center" value="<?php echo date_format(date_create($cl[0]->date), 'm/d/Y');?>" disabled>
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3">Customer Information</label>
                <div class="col-md-9"> 
                    <input type="text" style="text-transform: capitalize" class="form-control input-sm text-left" value="<?php echo $cl[0]->name.' - '.$cl[0]->telno.' - '.$cl[0]->address ?>" disabled >                  
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">Agent Name</label>
                <div class="col-md-9">             
                    <input type="text" style="text-transform: capitalize" 
                    class="form-control input-sm text-left" 
                    value="<?php if($cl[0]->agent_id === null){ echo 'NO AGENT'; }else{ echo $cl[0]->aname; } ?>" 
                    disabled >
                </div>
            </div>
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <thead>
                    <tr class="info">                                            
                        <td class="text-center"><strong>Product Information</strong></td>    
                        <td class="text-center"><strong>Price</strong></td>     
                        <td class="text-center"><strong>QTY</strong></td>  
                        <td class="text-center"><strong>Discount %-Amount</strong></td> 
                        <td class="text-center"><strong>Total Amount</strong></td>                          
                    </tr> 
                </thead>
                <tbody>
                    <?php if(sizeof($clline)):$qty=0; $ta=0; $tldiscount=0;   foreach ($clline as $key => $item):  ?>                      
                    <tr>    
                        <?php $tldiscount+=$item->discountamount; ?>                                             
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name.'<br>'.$item->description ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',','); ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->tlqty; $qty+=$item->tlqty; ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->discount ?>% - <?php echo number_format((float)$item->discountamount,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalamount,2,'.',','); $ta+=$item->totalamount; ?></td>                       
                    </tr>
                    <?php endforeach;  else: $qty=0; $ta=0; $tldiscount=0; ?>
                        <tr class="text-center">
                          <td colspan="5">There are no Data</td>
                        </tr>
                    <?php endif  ?> 
                     <tr class="warning">
                        <td colspan="4"><strong>Total</strong></td>
                        <td class="text-center"><strong><?php echo number_format((float)$ta,2,'.',','); ?></strong></td>
                    </tr>
                </tbody>
            </table>

            <!-- Payment infomation -->
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <tr>
                    <td colspan="4" class="text-center"><strong>Payment Information</strong></td>
                </tr>
                <tr>
                    <td><strong>Principal Balance</strong></td>
                    <td><?php echo number_format((float)$cl[0]->principal_balance,2,'.',',') ?></td>
                    <td><strong>Terms</strong></td>
                    <td><?php echo $cl[0]->termsbymonth ?> Month/s</td>
                </tr>
                <tr>
                    <td><strong>Down payment:</strong></td>
                    <td><?php echo number_format((float)$cl[0]->downpayment,2,'.',',') ?></td>
                    <td><strong>Due Amount</strong></td>
                    <td><?php echo number_format((float)$cl[0]->due_amount,2,'.',',') ?></td>
                </tr>
                <tr>
                    <td><strong>Maturity</strong></td>
                    <td><?php echo date_format(date_create($cl[0]->maturity), 'm/d/Y'); ?></td>
                    <td><strong>Outstanding Balance</strong></td>
                    <td><?php echo number_format((float)$cl[0]->outstanding_balance,2,'.',',') ?></td>
                </tr>
            </table> 

            <!-- Repayment -->
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <tr>
                    <td colspan="7" class="text-center"><strong>Payment Table</strong></td>
                </tr>
                <tr>
                    <th class="text-center">Status</th>                    
                    <th class="text-center">Due Dates - Date Paid</th>
                    <th class="text-center">SOA</th>
                    <th class="text-center">Due Amount</th>
                    <th class="text-center">Penalty</th>
                    <th class="text-center">Amount Paid</th>
                    <th class="text-center">Action</th>
                </tr>
                <?php 
                    $m=1; $da=0;  $soa=0; $ap=0; $p=0;
                    foreach ($repayment as $key => $item): ?>
                    <tr class="warning">
                        <?php 
                        $da+=$item->due_amount;
                        $soa= $da-$ap;  ?>     
                        <td class="text-center">
                          <strong><?php echo $item->status?></strong>
                        </td>                        
                        <td class="text-center">
                            <?php echo date_format(date_create($item->due_date), 'm/d/Y'); ?>
                            <?php if($item->status == 'OPEN'){}else{ echo ' - '.date_format(date_create($item->date_payed), 'm/d/Y'); } ?></td>
                        <td class="text-center"><strong><?php echo number_format((float)$soa,2,'.',','); ?></strong></td>
                        <td class="text-center"><?php echo number_format((float)$item->due_amount,2,'.',','); ?></td>                        
                        <td class="text-center"><?php echo number_format((float)$item->penalty,2,'.',','); $p+=$item->penalty;?></td>                                               
                        <td class="text-center"><strong><?php echo number_format((float)$item->amount_payed,2,'.',','); $ap+=$item->amount_payed?></strong></td>
                        <td class="text-center">
                            <?php if($item->post == 'POSTED'){ echo '<strong>POSTED</strong>'; }else{  ?>
                            <a title="Update Payment" 
                            data-rno="<?php echo $item->r_no;?>"                                
                            data-soa="<?php echo $soa;?>"
                            data-dueamount="<?php echo $item->due_amount;?>"  
                            data-date="<?php echo date_format(date_create($item->date_payed), 'm/d/Y');?>"                          
                            data-penalty="<?php echo $item->penalty;?>"
                            data-amountpayed="<?php echo $item->amount_payed;?>"
                            data-status="<?php echo $item->status;?>"
                            data-toggle="modal" data-target="#updatepayment" 
                            class="glyphicon glyphicon-pencil btn btn-sm btn-info updatepayment"
                            data-backdrop="static" data-keyboard="false"></a>
                                <?php if($item->status == 'OPEN'){}else{ ?>
                                    <a type="button" title="POST" href="<?=site_url('Creditloan_con/postpayment/'.$item->r_no.'/'.$item->credit_loan_cl_no.'/'.$cl[0]->outstanding_balance.'/'.$item->amount_payed.'/'.$item->penalty.'/'.$item->customer_c_no)?>"
                                        class="btn btn-sm btn-warning" onclick="confirm('Do you want to post this file?');">POST</a>
                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php $m+=1; endforeach; ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                    <td class="text-center"><strong>Php <?php echo number_format((float)$da,2,'.',',') ?></strong></td>
                    <td class="text-center"><strong>Php <?php echo number_format((float)$p,2,'.',',') ?></strong></td>
                    <td class="text-center"><strong>Php <?php echo number_format((float)$ap,2,'.',',') ?></strong></td>
                    <td class="text-center"><a type="button" class="btn btn-default"><strong>PRINT SOA</strong></a></td>
                </tr>
            </table>

        </div> <!-- end of panel body -->
  
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
     
<!-- Modal edit product-->
<div id="updatepayment" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Payment</h4>
        </div>
               
        <form onsubmit="return updatepaymentform(this);" role="form" method="post" action="<?=site_url('Creditloan_con/updatepayment')?>">             
        <div class="modal-body">            

            <input id="rno" class="form-control input-sm hide" type="text" name="rno" />    
            <input class="form-control input-sm hide" type="text" name="clno" value="<?php echo $cl[0]->cl_no; ?>" />

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Date Paid</label>
                <div class="col-sm-8">
                <input id="from" type="text" name="date" class="form-control input-sm "  autocomplete="off" required>
                </div>   
            </div>
            <hr>
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-4 control-label">Statement of Account</label>
                <div class="col-sm-8">
                    <input style="text-transform: capitalize" id="soa" class="form-control input-sm hide" type="number" step="any" name="soa"  />
                    <input style="text-transform: capitalize" id="soa" class="form-control input-sm " type="number"  disabled />
                </div>   
            </div>
            <hr>
            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Due Amount</label>
                <div class="col-sm-8">
                    <input id="dueamount" class="form-control input-sm hide" type="number" name="dueamount" step="any" autocomplete="off" />
                    <input id="dueamount" class="form-control input-sm " type="number"   autocomplete="off" disabled />
                </div>   
            </div>
            
            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Penalty</label>
                <div class="col-sm-8">
                    <input id="penalty" class="form-control input-sm " type="number" min="0"  name="penalty" required autocomplete="off" />
                </div>  
            </div> 
            <hr>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Amount Paid</label>
                <div class="col-sm-8">
                    <input id="amountpayed" class="form-control input-sm " type="number" min="0" step="any" name="amountpayed" required autocomplete="off" />
                </div>   
            </div>
        </div>

        <div class="modal-footer">
            <a title="Close"  data-dismiss="modal" data-toggle="modal"  type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
            <input type="submit" class="btn btn-primary" name="updatepaymentbtn" value="submit">
        </div>
        </form>

    </div>
  </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>


<script type="text/javascript">

//for disabled of button
function updatepaymentform(formObj) {            
        formObj.updatepaymentbtn.disabled = true;  
        formObj.updatepaymentbtn.value = 'Please Wait...';  
        return true;    
    }

window.onload = function()
{          
    //update payment
    $(document).ready(function () {
        $(document).on('click', '.updatepayment', function(event) {        
            var rno = $(this).data('rno');
            var soa = $(this).data('soa');
            var dueamount = $(this).data('dueamount'); 
            var penalty = $(this).data('penalty');
            var amountpayed = $(this).data('amountpayed');
            var status = $(this).data('status');
            var date = $(this).data('date');
            $(".modal-body #rno").val( rno );
            $(".modal-body #soa").val( soa );
            $(".modal-body #dueamount").val( dueamount );
            $(".modal-body #penalty").val( penalty );
            $(".modal-body #amountpayed").val( amountpayed );
            $(".modal-body #status").val( status );
            $(".modal-body #from").val( date ); 
        });
    });

}

</script>
