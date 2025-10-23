<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-12 "style="padding-top: 60px;" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-qrcode" ></span> Credit Payment Information
            </h3>            
        </div> <!-- end of panel heading -->        
        
        <form onsubmit="return updatecreditpaymentform(this);" role="form" method="post" action="<?=site_url('Creditpaymentinfo_con/submitcreditpayment')?>">             
        <div class="panel-body">  

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-1 control-label">Ref.No.</label>
                        <div class="col-sm-2">
                            <input class="form-control input-sm text-center" value="<?php echo $cp[0]->cp_no ?>"  disabled/>
                        </div>  
                        <label class="col-sm-1 control-label">Date</label>
                        <div class="col-sm-2">
                            <input id="mbirthday" class="form-control input-sm text-center" type="text" name="date" value="<?php echo date_format(date_create($cp[0]->date), 'm/d/Y');?>" autocomplete="off" <?php if($cp[0]->post == 'YES'){ echo 'disabled'; }else {} ?>/>
                        </div>                                                                

                        <label class="col-sm-2 control-label">Customer Name</label>
                        <div class="col-sm-4">
                            <button style="text-transform: capitalize" class="form-control input-sm"  type="button" data-toggle="modal" data-target="#changecustomer"<?php if($cp[0]->post == 'YES'){ echo 'disabled'; }else {} ?> ><strong><?php echo $cp[0]->name ?><?php if($cp[0]->post == 'YES'){ }else { ?> - <span class="text-danger"><strong>Php<?php echo number_format((float)$cp[0]->balance,2,'.',','); ?></strong></span> ...</strong ><?php } ?></button>
                        </div>  
                                          
                    </div>
                </div>
              
            </div>            
            <div class="row">

            <div class="col-md-6">
                <table class="table table-hover table-responsive table-bordered table-striped info" > 
                    <thead>
                        <tr class="info">
                            <?php if($cp[0]->post == 'YES'){ ?>
                                <td class="text-center" colspan="4"><strong>Credit Info</strong></td>
                            <?php }else { ?> 
                                <td class="text-center" colspan="4"><strong>Credit Info</strong></td>
                                <td class="text-center">
                                    <?php if($countcddl[0]->c == 1) {}else { ?>
                                     <button style="text-transform: capitalize" class="btn btn-info "  type="button" data-toggle="modal" data-target="#insertduedate"<?php if($cp[0]->post == 'YES'){ echo 'disabled'; }else {} ?> >INSERT</button>  
                                     <?php } ?>                                  
                                </td>
                            <?php } ?> 
                        </tr>
                        <tr class="info">  
                            <?php if($cp[0]->post == 'YES'){}else { ?>                                           
                                <td class="text-center"><strong>Action</strong></td>    
                            <?php } ?>   
                            <td class="text-center"><strong>#</strong></td>                     
                            <td class="text-center"><strong>Due Date</strong></td> 
                            <td class="text-center"><strong>C.I. No.</strong></td>                        
                            <td class="text-center"><strong>Credit Amount</strong></td> 
                            
                        </tr> 
                    </thead>
                    <tbody>
                          <?php $a=0; if(sizeof($cddlist)):  foreach ($cddlist as $key => $item):  
                            $bal = $item->amount-$item->amountpayed; ?>                      
                        <tr>     
                            <?php if($cp[0]->post == 'YES'){}else { ?> 
                                <td class="text-center" style="text-transform: capitalize">                             
                                    <a title="Edit" href="<?=site_url('Creditpaymentinfo_con/deletecreditduedateline/'.$item->cddl_no.'/'.$bal)?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Do you want to delete this credit');"></a>
                                </td>
                            <?php } ?>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->cdd_no ?> </td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->duedate ?> </td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no ?> </td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount,2,'.',','); $a+=($item->amount-$item->amountpayed); ?></td>                            
                        </tr>
                        <?php endforeach; else: ?>
                        <?php if($cp[0]->post == 'YES'){ ?>
                            <tr class="text-center">
                              <td colspan="4">There are no Data</td>
                            </tr>
                        <?php }else { ?>
                            <tr class="text-center">
                              <td colspan="5">There are no Data</td>
                            </tr>
                        <?php } ?>
                        <?php endif?> 
                        <?php if($cp[0]->post == 'YES'){}else { ?>
                            <tr class="warning">
                              <td class="text-right" colspan="4"><strong>Total</strong></td>
                              <td class="text-center"><strong><?php echo number_format((float)$a,2,'.',','); ?></strong></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> <!-- end of col-md-6 -->
            <div class="col-md-6">            
                <table class="table table-hover table-responsive table-bordered table-striped info" > 
                    <thead>
                        <tr class="info">
                            <?php if($cp[0]->post == 'YES'){ ?>
                                <td class="text-center" colspan="2"><strong>Payment Type</strong></td>
                            <?php }else { ?>
                                <td class="text-center" colspan="2"><strong>Payment Type</strong></td>
                                <td class="text-center">
                                    <button style="text-transform: capitalize" class="btn btn-info "  type="button" data-toggle="modal" data-target="#insertpayment"<?php if($cp[0]->post == 'YES'){ echo 'disabled'; }else {} ?> >INSERT</button>
                                </td>
                            <?php } ?>
                        </tr>
                        <tr class="info">  
                            <?php if($cp[0]->post == 'YES'){}else { ?>                                           
                                <td class="text-center"><strong>Action</strong></td>    
                            <?php } ?>                      
                            <td class="text-center"><strong>Type</strong></td> 
                            <td class="text-center"><strong>Amount</strong></td>         
                        </tr> 
                    </thead>
                    <tbody>
                          <?php $tp=0;  if(sizeof($cpl)):  foreach ($cpl as $key => $item): ?>                      
                        <tr>     
                            <?php if($cp[0]->post == 'YES'){}else { ?> 
                                <td class="text-center" style="text-transform: capitalize">                             
                                    <a title="Edit" href="<?=site_url('Creditpaymentinfo_con/deletecustomerpaymentline/'.$item->cpl_no.'/'.$item->amount)?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Do you want to delete this credit');"></a>
                                </td>
                            <?php } ?>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->type ?> </td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount,2,'.',','); $tp+=$item->amount; ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                            <tr class="text-center">
                              <td colspan="3">There are no Data</td>
                            </tr>
                        <?php endif?> 
                        <tr class="warning">
                             
                            <td <?php if($cp[0]->post == 'YES'){ ?> colspan="1"<?php }else { ?>colspan="2"<?php } ?>  class="text-right"><strong>Total Amount</strong></td>
                           
                            <td class="text-center"><strong><?php echo number_format((float)$tp,2,'.',','); ?></strong></td>
                        </tr>   
                    </tbody>
                </table>
            </div> <!-- end of col-md-6 -->

            </div>

           
             <div class="row">

                <div class="col-md-12">
                    <div class="form-group row row-offcanvas">                    
                        <label class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-10">
                            <input class="form-control input-sm " type="text" name="remarks" value="<?php echo $cp[0]->remarks;?>" autocomplete="off" <?php if($cp[0]->post == 'YES'){ echo 'disabled'; }else {} ?>  />
                        </div>                                   
                    </div>
                </div>               
            </div>
        </div> <!-- end of panel body -->
        <div class="modal-footer">
            <a title="Close" href="<?=site_url('Creditpayment_con')?>" onclick="return confirm('Do you want to go back');" type="button" class="btn btn-warning" >BACK</a>
            <?php if($cp[0]->post == 'YES'){}else { ?> 
            <input type="submit" class="btn btn-primary" onclick="return confirm('Do you to save this infomation');" name="updatecreditpaymentbtn" value="SUBMIT" <?php if($cp[0]->totalpayment == "0"){ echo 'disabled'; } ?> />
        <?php } ?>
        </div>
    </form>
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        
<!-- Modal -->
<div id="changecustomer" class="modal fade" role="dialog">
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
                            <a title="Select" href="<?=site_url('Creditpaymentinfo_con/changecustomer/'.$item->c_no)?>" class=" btn btn-info">SELECT</a>
                        </td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
            </div>                           
    </div>
  </div>
</div> <!-- End of model -->

<!-- Modal -->
<div id="insertduedate" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Crediit Due Date</h4>
        </div>
                           
            <div class="modal-body">                    

                <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">                                                                
                        <td class="text-center"><strong>Due Date</strong></td> 
                        <td class="text-center"><strong>Ref.No.</strong></td> 
                        <td class="text-center"><strong>Credit Amount</strong></td> 
                        <td class="text-center"><strong>Payed Amount</strong></td> 
                        <td class="text-center"><strong>Total Amount</strong></td>  
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($cdd as $key => $item): ?>                      
                    <tr>                         
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->duedate ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no; ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amountpayed,2,'.',','); $s=$item->amount-$item->amountpayed;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount-$item->amountpayed,2,'.',',');?></td>
                        <td class="text-center">     
                            <a title="Select" href="<?=site_url('Creditpaymentinfo_con/insertcreditduedateline/'.$item->cdd_no.'/'.$s.'/'.$cp[0]->totalcredit)?>" class=" btn btn-info">SELECT</a>
                        </td>
                    </tr>
                     <?php endforeach;  ?>     
                </tbody>
            </table>
            </div>                           
    </div>
  </div>
</div> <!-- End of model -->

<!-- Modal -->
<div id="insertpayment" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Payment</h4>
        </div>
               
        <form onsubmit="return paymentform(this);" role="form" method="post" action="<?=site_url('Creditpaymentinfo_con/insertpayment')?>">             
        <div class="modal-body">     

            <input class="hide " type="number" step="any" name="totalpayment" value="<?php echo $cp[0]->totalpayment; ?>" />

           <div class="form-group row row-offcanvas">
                <label class="col-sm-6 control-label">Type</label>
                <div class="col-sm-6">
                     <select name="type" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                        <option value="Cash"> Cash</option>   
                        <option value="Check"> Check</option>                            
                    </select>  
                </div>                            
            </div>      

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-6 control-label">Amount</label>
                <div class="col-sm-6">
                    <input class="form-control input-sm " type="number" step="any" name="amount" required autocomplete="off" />
                </div>   

            </div>

         
        </div>
        <div class="modal-footer">
                <a title="Close"   class="close" data-dismiss="modal" data-toggle="modal" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <input type="submit" class="btn btn-primary" name="paymentbtn" value="submit">
            </div>
        </form>

    </div>
  </div>
</div> <!-- End of model -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">

function paymentform(formObj) {            
        formObj.paymentbtn.disabled = true;  
        formObj.paymentbtn.value = 'Please Wait...';  
        return true;    
    } 

function updatecreditpaymentform(formObj) {            
        formObj.updatecreditpaymentbtn.disabled = true;  
        formObj.updatecreditpaymentbtn.value = 'Please Wait...';  
        return true;    
    } 

</script>