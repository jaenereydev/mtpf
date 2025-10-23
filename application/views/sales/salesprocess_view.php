<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>


<div class="col-md-6 col-sm-offset-3" style="margin-top:60px;" >
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-shopping-cart" ></span> 
                <?php if($this->session->userdata('type') == "RETURN") { ?>
                    RETURN SALES     
                <?php } else if($this->session->userdata('type') == "CREDIT") { ?>
                    CREDIT SALES
                <?php } else  { ?>
                    POS
                <?php } ?> 
                - Please Review Orders
            </h3>            
            <div class="panel-toolbar text-right">               
                <a title="Back" class="btn btn-danger btn-sm" 
                <?php if($this->session->userdata('type') == "RETURN") { ?>
                    href="<?=site_url('Salesreturn_con')?>"
                <?php } else if($this->session->userdata('type') == "CREDIT") { ?>
                    href="<?=site_url('Salescredit_con')?>"
                <?php } else  { ?>
                    href="<?=site_url('Sales_con')?>"
                <?php } ?> 
               
                ><span class=" glyphicon glyphicon-arrow-left"></span> Back</a>                   
            </div>
        </div> <!-- end of panel heading -->  
        
        <form onsubmit="return processform(this);" role="form" method="post" 
        <?php if($this->session->userdata('type') == "RETURN") { ?>
             action="<?=site_url('Salesreturn_con/submitsales')?>"
         <?php } else if($this->session->userdata('type') == "CASH" || $this->session->userdata('type') == "CHECK") { ?>
             action="<?=site_url('Sales_con/submitsales')?>"
         <?php } else  { ?>
              action="<?=site_url('Salescredit_con/submitsales')?>"
        <?php } ?>   
        >
        <div class="panel-body">
            <div class="form-group row">
                <label class="col-md-12 text-center"><strong><?php echo $this->session->userdata('type') ?></strong></label>
            </div>  
            <div class="form-group row">
                <label class="col-md-3">Date</label>
                <div class="col-md-9">     
                    <input type="text" class="form-control input-sm text-center"   value="<?php echo date_format(date_create($this->session->userdata('date')), 'm/d/Y'); ?>" disabled>
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3">Sales Invoice #</label>
                <div class="col-md-9"> 
                    <input type="text" class="form-control input-sm text-center"  name="date" value="<?php echo $this->session->userdata('refno'); ?>" disabled>
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3">Customer Name</label>
                <div class="col-md-9">                    
                    <?php if($customer == null){ ?>

                    <input type="text" class="hide"  name="cno" value="<?php echo $this->session->userdata('customer') ?>" >
                    <input type="text"  class="form-control input-sm text-center" value="<?php echo"No Customer" ?>" disabled >            
                    <?php }else { ?>
                    
                    <input type="text" class="hide" name="cno" value="<?php echo $this->session->userdata('customer') ?>" >
                     <input type="text" style="text-transform: capitalize" class="form-control input-sm text-center" value="<?php echo $customer[0]->name ?>" disabled >
                   
                    <?php } ?>     
                                       
                </div>
            </div>
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <thead>
                    <tr class="info">                                            
                        <td class="text-center"><strong>Name</strong></td>    
                        <td class="text-center"><strong>Price</strong></td>     
                        <td class="text-center"><strong>QTY</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td> 
                        <td class="text-center"><strong>Discount %-Amount</strong></td> 
                        <td class="text-center"><strong>Total Amount</strong></td>                          
                    </tr> 
                </thead>
                <tbody>
                    <?php if(sizeof($tl)):$qty=0; $ta=0; $tldiscount=0;   foreach ($tl as $key => $item):  ?>                      
                    <tr>    
                        <?php $tldiscount+=$item->discountamount; ?>                                             
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name.'<br>'.$item->description ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',','); ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->tlqty; $qty+=$item->tlqty; ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->tlqty*$item->price,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->discount ?>% - <?php echo number_format((float)$item->discountamount,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalamount,2,'.',','); $ta+=$item->totalamount; ?></td>                       
                    </tr>
                    <?php endforeach;  else: $qty=0; $ta=0; $tldiscount=0; ?>
                        <tr class="text-center">
                          <td colspan="6">There are no Data</td>
                        </tr>
                    <?php endif  ?> 
                     <tr class="warning">
                        <td colspan="2"><strong>Total QTY</strong></td>
                        <td class="text-center"><strong><?php echo $qty; ?></strong></td>
                        <td class="text-right"></td>
                        <td class="text-right"><strong>Total Purchase</strong></td>
                        <td class="text-center"><strong>Php <?php echo number_format((float)$ta,2,'.',','); ?></strong></td>
                    </tr>
                    
                    <tr class="warning">
                        <td colspan="5" class="text-right"><strong>Discount Amount</strong></td>
                        <td class="text-center"><strong>(<?php echo number_format((float)$this->session->userdata('discount'),2,'.',','); ?>)</strong></td>
                    </tr>
                   
                    <tr class="warning">
                        <td colspan="5" class="text-right"><strong>Net Sales</strong></td>
                        <td class="text-center"><strong>Php <?php echo number_format((float)$this->session->userdata('totalamount'),2,'.',','); ?></strong></td>
                    </tr>
                    <?php if($this->session->userdata('type') == "CREDIT") {}else { ?>
                     <tr class="warning">
                        <td colspan="5" class="text-right"><strong><?php if($this->session->userdata('type') == "CHECK") { echo 'Check On Hand'; } else { echo 'Cash On Hand'; } ?></strong></td>
                        <td class="text-center"><strong>Php <?php echo number_format((float)$this->session->userdata('cashonhand'),2,'.',','); ?></strong></td>
                    </tr>
                    <tr class="<?php if($this->session->userdata('change') < '0' ){ echo 'danger'; }else { echo 'success'; } ?>">
                        <td colspan="5" class="text-right"><strong>Change</strong></td>
                        <td class="text-center"><strong>Php <?php echo number_format((float)$this->session->userdata('change'),2,'.',','); ?></strong></td>
                    </tr>
                    <?php } ?>
                    <?php if($this->session->userdata('change') < '0' ){ ?>
                        <?php if($this->session->userdata('type') == "RETURN") {}else { ?>
                        <tr class="danger">
                            <td colspan="6" class="text-right"><strong>*The Change is Negative.Please check your Orders</strong></td>
                        </tr>
                          <?php } ?> 
                    <?php } ?>
                </tbody>
            </table>
             
        </div> <!-- end of panel body --> 
        <div class="modal-footer">

            <a title="Reset"
            <?php if($this->session->userdata('type') == "RETURN") { ?>
                href="<?=site_url('Salesreturn_con/resettransaction')?>" 
            <?php } else if($this->session->userdata('type') == "CASH" || $this->session->userdata('type') == "CHECK") { ?>
                href="<?=site_url('Sales_con/resettransaction')?>" 
            <?php } else  { ?>
               href="<?=site_url('Salescredit_con/resettransaction')?>" 
            <?php } ?>   
             onclick="return confirm('Do you want to reset this transaction');" type="button" class="btn btn-warning glyphicon glyphicon-floppy-remove" ></a>

            <input <?php if($this->session->userdata('change') < '0' ){ if($this->session->userdata('type') == "CASH") { echo 'disabled'; } else {} } ?> title="Process" type="submit" class="btn btn-primary" name="processbtn" value="Process">
        </div>       
        </form>
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
     


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

