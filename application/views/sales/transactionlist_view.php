<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list-alt" ></span> Transaction List    
            </h3>    
            <a type="button" target="_blank" 
                class="btn btn-primary pull-right" 
                style="margin-left: 10px;" 
                href="<?=site_url('Report_con/printsalesreport')?>"
            >
                <strong>PRINT</strong>
            </a>  
            <?php if(sizeof($cohinfo)): ?>
                <button type="button" 
                data-srno="<?php echo $cohinfo[0]->sr_no;?>"                                
                data-coh="<?php echo $cohinfo[0]->cashonhand;?>"
                data-toggle="modal" data-target="#changecoh" class="btn btn-warning pull-right changecoh" >CHANGE CASH ON HAND</button>
            <?php else : ?>        
            <button type="button" data-toggle="modal" data-target="#coh" class="btn btn-info pull-right" >INSERT CASH ON HAND</button>
            <?php endif ?>
            
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
            
            <div class="form-group row">
                <div class="col-md-6">
                    <table class="table table-hover table-responsive table-bordered  ">
                        <tr>
                            <td colspan="3" class="text-center"><strong><?php $date = date('m/d/y'); echo $date; ?></strong></td>
                            
                        </tr>
                        <tr>
                            <td><strong>Total Cash Sales</strong></td>
                            <td class="text-center"><?php $sca=0; if(sizeof($sumcash)): echo number_format((float)$sumcash[0]->ta,2,'.',','); $sca=$sumcash[0]->ta; endif ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Check Sales</strong></td>
                            <td class="text-center"><?php $sch=0; if(sizeof($sumcheck)): echo number_format((float)$sumcheck[0]->ta,2,'.',','); $sch=$sumcheck[0]->ta; endif ?></td>
                        </tr>
                        <!-- <tr>
                            <td><strong>Total Down payment</strong></td>
                            <td class="text-center"><?php $dp=0; if(sizeof($downpayment)): echo number_format((float)$downpayment[0]->dp,2,'.',','); $dp=$downpayment[0]->dp; endif ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Credit Loan Payment</strong></td>
                            <td class="text-center"><?php $clp=0; if(sizeof($creditloanpayment)): echo number_format((float)$creditloanpayment[0]->ap,2,'.',','); $clp=$creditloanpayment[0]->ap; endif ?></td>
                        </tr> -->
                        <tr>
                            <td><strong><a href="<?php echo site_url('Creditpayment_con') ?>">Total Credit Payment</a></strong></td>
                            <td class="text-center"><?php $scp=0; if(sizeof($sumcreditpayment)): echo number_format((float)$sumcreditpayment[0]->ta,2,'.',','); $scp=$sumcreditpayment[0]->ta; endif ?></td>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-center"><strong>Total Sales</strong></td>
                            <td class="text-center"><strong>Php <?php $ts=$sca+$sch+$scp;  echo number_format((float)$ts,2,'.',',');?></strong></td>
                        </tr>
                        <tr>
                            <td><strong>Total Return Sales</strong></td>
                            <td class="text-center">(Php <?php $sr=0; if(sizeof($sumreturn)): echo number_format((float)$sumreturn[0]->ta,2,'.',','); $sr=$sumreturn[0]->ta; endif ?>)</td>
                        </tr>
                        <tr >
                            <td><strong><a href="<?=site_url('Expenses_con')?>">Total Expenses</a></strong></td>
                            <td class="text-center">(Php <?php $se=0; if(sizeof($sumexpenses)): echo number_format((float)$sumexpenses[0]->ta,2,'.',','); $se=$sumexpenses[0]->ta; endif ?>)</td>
                        </tr>
                        <tr >
                            <td><strong><a href="<?=site_url('Deposit_con')?>">Total Desposit</a></strong></td>
                            <td class="text-center">(Php <?php $sd=0; if(sizeof($sumdeposit)): echo number_format((float)$sumdeposit[0]->ta,2,'.',','); $sd=$sumdeposit[0]->ta; endif ?>)</td>
                        </tr>
                        <tr >
                            <td colspan="2" class="text-center"><strong>Total</strong></td>
                            <td class="text-center"><strong>(Php <?php echo number_format((float)$sumexpenses[0]->ta+$sumreturn[0]->ta,2,'.',','); ?>)</strong></td>
                        </tr>
                        <tr >
                            <td colspan="2" class="text-right"><strong>Net Sales</strong></td>
                            <td class="text-center"><strong>Php <?php $ns=0; echo number_format((float)$ts-($sr+$se+$sd),2,'.',','); $ns=$ts-($sr+$se+$sd) ?></strong></td>
                        </tr>
                        <tr >
                            <td colspan="2" class="text-right"><strong>Cash On Hand</strong></td>
                            <td class="text-center"><strong>Php <?php $coh=0; if(sizeof($sumcashonhand)): echo number_format((float)$sumcashonhand[0]->ta,2,'.',','); $coh=$sumcashonhand[0]->ta; endif ?></strong></td>
                        </tr>
                        <tr >
                            <td colspan="2" class="text-right"><strong>Variance</strong></td>
                            <td class="text-center"><strong>Php <?php $v=$ns-$coh; echo number_format((float)$v,2,'.',','); if($v < '0'){ echo ' OVER'; }else if($v > 0){ echo ' SHORT'; }else{} ?></strong></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6"> 
                    <table class="table table-hover table-responsive table-bordered">
                        <tr>
                            <td><strong>Total Credit</strong></td>
                            <td>Php <?php if(sizeof($sumcredit)): echo number_format((float)$sumcredit[0]->ta,2,'.',','); endif ?></td>
                        </tr>
                    </table>
                </div>
            </div>                                                    

            <?php if(sizeof($t)):  ?>    
            <div class="form-group row">
                <div class="col-md-12">  
                <table class="table table-hover table-responsive table-bordered table-striped " > 
                    <thead>
                        <tr class="success">
                            <td class="text-center"colspan="5"><strong>Transaction List</strong></td>
                        </tr>
                        <tr >                                                                         
                            <td class="text-center"><strong>Date</strong></td> 
                            <td class="text-center"><strong>Ref. No.</strong></td>                         
                            <td class="text-center"><strong>Type</strong></td>   
                            <td class="text-center"><strong>Amount</strong></td>   
                            <td class="text-center"><strong>Action</strong></td>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php  foreach ($t as $key => $item): ?>                      
                        <tr class="<?php if($item->type=='RETURN'){ echo 'danger'; }else if($item->type=='VOID'){ echo 'warning'; }?>">                 
                            <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->type ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalamount,2,'.',','); ?></td>
                            <td class="text-center">                          
                                <?php if($item->customer_c_no == null || $item->customer_c_no == '') {
                                    $c = 0;
                                }else {
                                    $c = $item->customer_c_no;
                                } ?>   

                                <a 
                                    type="button" 
                                    target="_blank" 
                                    title="Reprint" 
                                    href="<?=site_url('Receipt_con/reprint/'. $item->t_no.'/'.$c)?>" 
                                    class="glyphicon glyphicon-print btn btn-default"></a>

                                <?php if($item->type == 'VOID' || $item->type == 'CREDIT' || $item->type == 'CREDIT RETURN' || $item->type == 'RETURN') {}else { ?>
                                    <a 
                                        type="button" 
                                        onclick="return confirm('This transaction will be void/cancel!');" 
                                        title="Void" 
                                        href="<?=site_url('Sales_con/voidtransaction/'. $item->t_no.'/'.$c)?>" 
                                        class="btn btn-warning">VOID</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php endforeach;  ?>                       
                    </tbody>
                </table>
                </div>  
            </div>
            <?php endif  ?> 


            <?php if(sizeof($creditpayment)):  ?>    
            <div class="form-group row">
                <div class="col-md-12">  
                    <table class="table table-hover table-responsive table-bordered table-striped " id=""> 
                        <thead>
                            <tr>
                                <td class="info text-center" colspan="2"><strong>Credit Payment</strong></td>
                            </tr>
                            <tr >                                                                            
                                <td class="text-center"><strong>Name</strong></td> 
                                <td class="text-center"><strong>Down payment</strong></td>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php $d=0; foreach ($creditpayment as $key => $item): ?>                      
                            <tr> 
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalpayment,2,'.',','); $d+=$item->totalpayment; ?></td>
                            </tr>
                            <?php endforeach;  ?>  
                            <tr>
                                <td class="text-center"><strong>Total</strong></td>
                                <td class="text-center"><strong><?php echo number_format((float)$d,2,'.',','); ?></strong></td>
                            </tr>                     
                        </tbody>
                    </table>
                </div>  
            </div>
            <?php endif  ?> 


            <?php if(sizeof($creditloan)):  ?>    
            <div class="form-group row">
                <div class="col-md-12">  
                    <table class="table table-hover table-responsive table-bordered table-striped " id=""> 
                        <thead>
                            <tr>
                                <td class="info text-center" colspan="3"><strong>Credit Loan</strong></td>
                            </tr>
                            <tr >                                                                            
                                <td class="text-center"><strong>Name</strong></td> 
                                <td class="text-center"><strong>Down payment</strong></td>
                                <td class="text-center"><strong>Action</strong></td>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php $d=0; foreach ($creditloan as $key => $item): ?>                      
                            <tr> 
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->downpayment,2,'.',','); $d+=$item->downpayment; ?></td>
                                <td class="text-center">                                                          
                                    <a 
                                        type="button" 
                                        target="_blank" 
                                        title="Reprint" 
                                        href="<?=site_url('Receipt_con/customerprint/'. $item->cl_no)?>" 
                                        class="glyphicon glyphicon-print btn btn-default"></a>                                                  
                                </td>
                            </tr>
                            <?php endforeach;  ?>  
                            <tr>
                                <td class="text-center"><strong>Total</strong></td>
                                <td class="text-center"><strong><?php echo number_format((float)$d,2,'.',','); ?></strong></td>
                            </tr>                     
                        </tbody>
                    </table>
                </div>  
            </div>
            <?php endif  ?> 

            <?php if(sizeof($creditloanpaymentlist)):  ?>    
            <div class="form-group row">
                <div class="col-md-12">  
                    <table class="table table-hover table-responsive table-bordered table-striped " id=""> 
                        <thead>
                            <tr>
                                <td class="info text-center" colspan="5"><strong>Credit Loan Payment</strong></td>
                            </tr>
                            <tr >                                                                             
                                <td class="text-center"><strong>Name</strong></td> 
                                <td class="text-center"><strong>Penalty</strong></td>
                                <td class="text-center"><strong>Amount</strong></td>
                                <td class="text-center"><strong>Status</strong></td>
                                <td class="text-center"><strong>Action</strong></td>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php $p=0; $a=0; foreach ($creditloanpaymentlist as $key => $item): ?>                      
                            <tr> 
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->penalty,2,'.',','); $p+=$item->penalty; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount_payed,2,'.',',');$a+=$item->amount_payed; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->status ?></td>
                                <td class="text-center">                                                          
                                    <a 
                                        type="button" 
                                        target="_blank" 
                                        title="VIew" 
                                        href="<?=site_url('Creditloan_con/creditloaninfo/'. $item->credit_loan_cl_no)?>" 
                                        class="glyphicon glyphicon-eye-open btn btn-info"></a>                                                  
                                </td>
                            </tr>
                            <?php endforeach;   ?>  
                            <tr>
                                <td class="text-center"><strong>Total</strong></td>
                                <td class="text-center"><?php echo number_format((float)$p,2,'.',','); ?></td>
                                <td class="text-center"><?php echo number_format((float)$a,2,'.',','); ?></td>
                                <td colspan="2" class="text-center"><strong><?php echo number_format((float)$a+$p,2,'.',','); ?></strong></td>
                            </tr>                 
                        </tbody>
                    </table>
                </div>  
            </div>
            <?php endif  ?> 

        </div> <!-- end of panel body -->
        
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->



<!-- Modal -->
<div id="coh" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Cash On Hand</h4>
        </div>
               
        <form onsubmit="return cohform(this);" role="form" method="post" action="<?=site_url('Sales_con/insertcoh')?>">   

        <div class="modal-body">     
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-6 control-label">CASH ON HAND</label>
                <div class="col-sm-6">
                    <input class="form-control input-sm " type="number" step="any" min="0" name="coh" required/>
                </div>   
            </div>
        </div>

        <div class="modal-footer">
            <a title="Close" class="close" data-dismiss="modal" data-toggle="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
            <input type="submit" class="btn btn-primary" name="cohbtn" value="submit">
        </div>
        
        </form>

    </div>
  </div>
</div> <!-- End of model -->

<!-- Modal -->
<div id="changecoh" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Change Cash On Hand</h4>
        </div>
               
        <form onsubmit="return changecohform(this);" role="form" method="post" action="<?=site_url('Sales_con/updatecoh')?>">             
        <div class="modal-body">                        
            <input id="srno" class="hide"  type="number" name="srno" required/>
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-6 control-label">CASH ON HAND</label>
                <div class="col-sm-6">
                    <input id="coh" class="form-control input-sm " type="number" step="any" min="1" name="coh" required/>
                </div>   
            </div>
        
        </div>
        <div class="modal-footer">
                <a title="Close" class="close" data-dismiss="modal" data-toggle="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <input type="submit" class="btn btn-primary" name="changecohbtn" value="submit">
            </div>
        </form>

    </div>
  </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">

function cohform(formObj) {            
        formObj.cohbtn.disabled = true;  
        formObj.cohbtn.value = 'Please Wait...';  
        return true;    
    }  

function changecohform(formObj) {            
        formObj.changecohbtn.disabled = true;  
        formObj.changecohbtn.value = 'Please Wait...';  
        return true;    
    }      

window.onload = function()
{                         

    $(document).ready(function () {
        $(document).on('click', '.changecoh', function(event) {        
            var srno = $(this).data('srno');
            var coh = $(this).data('coh');
            $(".modal-body #srno").val( srno );
            $(".modal-body #coh").val( coh );
        });
    });

}

</script>