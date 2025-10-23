<script type="text/javascript">

</script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">            
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Customer Information
            </h3>                            
        </div> <!-- end of panel heading -->              
        
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?php if($active == "1") { echo "active";} ?>"><a href="#customerdetails" data-toggle="tab">Customer Details</a></li>
            <li role="presentation" class="<?php if($active == "4") { echo "active";} ?>"><a href="#customercreditloan" data-toggle="tab">Credit Loan</a></li>
            <li role="presentation" class="<?php if($active == "2") { echo "active";} ?>"><a href="#customersaleshistory" data-toggle="tab">Sales History</a></li>
            <li role="presentation" class="<?php if($active == "3") { echo "active";} ?>"><a href="#customercredithistory" data-toggle="tab">Credit History</a></li>        
        </ul>
        
        <div class="panel-body">  
            
                <div class=" tab-content">
                    
                    <div class="tab-pane <?php if($active == "1") { echo "active";} ?>" id="customerdetails">
                    <form role="form" method="post" action="<?=site_url('customer_con/updatecustomer')?>">
                       
                        <input class="form-control input-sm hide" type="text" name="c_no" value="<?php echo $cus[0]->c_no;?>" required>
                        <div class="modal-body">  
                            
                            <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Customer No.</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm " type="text" value="<?php echo $cus[0]->c_no;?>" disabled>
                            </div>                            
                            </div>
                            <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Customer Name" value="<?php echo $cus[0]->name;?>" required autofocus autocomplete="off">
                            </div>                            
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="address" placeholder="Address" value="<?php echo $cus[0]->address; ?>" required autocomplete="off">
                                </div>                            
                            </div>                                                                               

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Tel No.</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="text" name="telno" placeholder="Telephone Number" value="<?php echo $cus[0]->telno; ?>" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-5">
                                    <select name="ccno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true">
                                        <option value=""> --Please Select--</option>
                                        <?php for($c=0;$c<count($cat);$c++) { ?>
                                        <option value="<?php echo $cat[$c]->cc_no; ?>" <?php if($cat[$c]->cc_no == $cus[0]->customer_category_cc_no){ echo 'selected'; } ?>  ><?php echo $cat[$c]->name;?></option>
                                        <?php } ?>
                                    </select>  
                                </div>
                            </div>  

                            <legend>Credit Information</legend>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Total Credit</label>
                                <div class="col-sm-5">
                                    <p class="form-control input-sm" type="number"  step="any"><?php if($cus[0]->balance == null || $cus[0]->balance == ""){ echo "0.00";}else { echo number_format((float)$cus[0]->balance,2,'.',',');}?></p>
                                </div>
                            </div>
                            
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Credit Limit</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="creditlimit" placeholder="Credit Limit" step="any" value="<?php echo $cus[0]->credit_limit; ?>" required autocomplete="off">
                                </div>
                            </div>

                             <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Terms</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="terms" placeholder="Terms "value="<?php echo $cus[0]->terms;?>" autocomplete="off">
                                </div>
                            </div>                            
                            
                        </div><!-- end of body -->

                        <div class="modal-footer">
                          <a title="Close" href="<?=site_url('customer_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                          <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                        </div>
                    </form>     
                    </div><!-- end of customer details -->                    
                   
                    <div class="tab-pane <?php if($active == "2") { echo "active";} ?>" id="customersaleshistory">                        
                             
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">      
                            <thead>
                            <tr class="info">                               
                                <td class="text-center"><strong>#</strong></td>       
                                <td class="text-center"><strong>Date</strong></td>       
                                <td class="text-center"><strong>Ref No.</strong></td>
                                <td class="text-center"><strong>Description</strong></td>
                                <td class="text-center"><strong>Amount</strong></td>
                                <td class="text-center"><strong></strong></td>
                              </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($cussaleshistory as $key => $item): ?>                    
                            <tr>                                     
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->csh_no ?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y'); ?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->transaction_t_no; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->description; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount,2,'.',',');?></td>     
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name; ?></td>                       
                            </tr>
                            <?php endforeach;  ?>
                            </tbody>
                        </table>                                             
                    </div> 
                    
                    <div class="tab-pane <?php if($active == "3") { echo "active";} ?>" id="customercredithistory">                        
                             
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable">      
                            <thead>
                            <tr class="info">                               
                                <td class="text-center"><strong>#</strong></td>       
                                <td class="text-center"><strong>Date</strong></td>       
                                <td class="text-center"><strong>Ref No.</strong></td>
                                <td class="text-center"><strong>Description</strong></td>
                                <td class="text-center"><strong>CI Amount</strong></td>
                                <td class="text-center"><strong>CI Payment</strong></td>
                                <td class="text-center"><strong>Balance</strong></td>
                                <td class="text-center"><strong></strong></td>
                              </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($cuscredithistory as $key => $item): ?>                    
                            <tr>                                     
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->cbh_no ?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y'); ?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no; ?></td>   
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->description; ?></td>                               
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->ci_amount,2,'.',',');?></td>       
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->ci_payment,2,'.',',');?></td>       
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->balance,2,'.',',');?></td>    
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name; ?></td>                           
                            </tr>
                            <?php endforeach;  ?>
                            </tbody>
                        </table>                                             
                    </div> 

                    <div class="tab-pane <?php if($active == "4") { echo "active";} ?>" id="customercreditloan">                        
                             
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="ThirdTable">      
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
                                        <!-- <a title="View" href="<?=site_url('/'.$item->cl_no)?>" class="glyphicon glyphicon-pencil btn btn-primary btn-sm"></a> -->
                                        <a type="button" target="_blank" title="VIew" href="<?=site_url('Creditloan_con/creditloaninfo/'. $item->cl_no)?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>    
                                        <a title="Print" href="<?=site_url('Creditloan_con/reprint/'.$item->cl_no)?>" class="glyphicon glyphicon-print btn btn-default btn-sm" target="_blank"></a>
                                                                                      
                                    </td> 
                                </tr>
                                <?php endforeach;  ?>   
                            </tbody>
                        </table>                                             
                    </div> 

                </div>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>  