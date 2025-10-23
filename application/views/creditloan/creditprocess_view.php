<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>


<div class="col-md-7 col-sm-offset-3" style="margin-top:60px;" >
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Please Review Credit Loan Application
            </h3>            
            <div class="panel-toolbar text-right">
                <a class="btn btn-sm btn-danger" href="<?=site_url('Creditloan_con')?>"><span class=" glyphicon glyphicon-arrow-left"></span> Back</a>                   
            </div>
        </div> <!-- end of panel heading -->  
        
        <form onsubmit="return processform(this);" role="form" method="post" 
                action="<?=site_url('Creditloan_con/submitcreditloan')?>">
        <div class="panel-body">
            <div class="form-group row">
                <label class="col-md-3">Date</label>
                <div class="col-md-9">     
                    <input type="text" class="form-control input-sm text-center"s value="<?php echo $this->session->userdata('date') ?>" disabled>
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3">Customer Information</label>
                <div class="col-md-9"> 
                    <input type="text" class="hide" name="customerno" value="<?php echo $this->session->userdata('customer') ?>" >
                    <input type="text" style="text-transform: capitalize" class="form-control input-sm text-left" value="<?php echo $customer[0]->name.' - '.$customer[0]->telno.' - '.$customer[0]->address ?>" disabled >                  
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">Agent Name</label>
                <div class="col-md-9"> 
                <?php if($agent == null){ ?>
                        <div class="col-md-9">  
                            <strong><?php echo "No Agent"?></strong>
                        </div>
                    <?php }else { ?>
                        <input type="text" class="hide" name="agentid" value="<?php echo $this->session->userdata('agent') ?>" >
                        <input type="text" style="text-transform: capitalize" class="form-control input-sm text-left" value="<?php echo $agent[0]->name ?>" disabled >                  
                    <?php } ?>
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
                    <?php if(sizeof($cll)):$qty=0; $ta=0; $tldiscount=0;   foreach ($cll as $key => $item):  ?>                      
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
                    <td><?php echo number_format((float)$this->session->userdata('principalbalance'),2,'.',',') ?></td>
                    <td><strong>Terms</strong></td>
                    <td><?php echo $this->session->userdata('terms') ?> Month/s</td>
                </tr>
                <tr>
                    <td><strong>Down payment:</strong></td>
                    <td><?php echo number_format((float)$this->session->userdata('downpayment'),2,'.',',') ?></td>
                    <td><strong>Due Amount</strong></td>
                    <td><?php echo number_format((float)$this->session->userdata('dueamount'),2,'.',',') ?></td>
                </tr>
                <tr>
                    <td><strong>Maturity</strong></td>
                    <td><?php echo date_format(date_create($this->session->userdata('maturity')), 'm/d/Y'); ?></td>
                    <td><strong>Outstanding Balance</strong></td>
                    <td><?php echo number_format((float)$this->session->userdata('outstandingbalance'),2,'.',',') ?></td>
                </tr>
            </table>

            <!-- Repayment -->
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <tr>
                    <td colspan="4" class="text-center"><strong>Payment Table</strong></td>
                </tr>
                <tr>
                    <th>Month No.</th>
                    <th>Due Dates</th>
                    <th>Due Amount</th>
                </tr>
                <?php 
                    $m=1; $ob=0;  
                    for( $i = 0; $i < $this->session->userdata('terms'); $i++){ ?>
                    <tr>
                        <td><strong><?php echo $m; ?></strong></td>
                        <td><?php echo date('m/d/Y', strtotime($this->session->userdata('date'). ' + '.$m.' months')) ?></td>
                        <td><?php echo number_format((float)$this->session->userdata('dueamount'),2,'.',','); $ob+=$this->session->userdata('dueamount');?></td>
                    </tr>
                <?php $m+=1; } ?>
                <tr>
                    <td colspan="2"><strong>TOTAL</strong></td>
                    <td><strong>Php <?php echo number_format((float)$ob,2,'.',',') ?></strong></td>
                </tr>
            </table>

        </div> <!-- end of panel body -->

        <div class="modal-footer">
            <a title="Reset" href="<?=site_url('Creditloan_con/resettransaction')?>" 
                    onclick="return confirm('Do you want to reset this transaction');" 
                    type="button" class="btn btn-warning glyphicon glyphicon-floppy-remove" ></a>

            <input title="Process" type="submit" class="btn btn-primary" name="processbtn" value="Process">
        </div>      
        </form>
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
     


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>


<script type="text/javascript">

//for disabled of button
function processform(formObj) {            
        formObj.processbtn.disabled = true;  
        formObj.processbtn.value = 'Please Wait...';  
        return true;    
    }  

</script>
