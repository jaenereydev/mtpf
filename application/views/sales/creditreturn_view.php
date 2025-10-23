<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-8 main" style="margin-top:60px;" >
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-book" ></span><span class="text-danger"><strong> CREDIT RETURN</strong></span>
            </h3>            
            <div class="panel-toolbar text-right">
                <a title="Dashboard" class="btn btn-default btn-sm" href="<?=site_url('dashboard')?>"><span class=" glyphicon glyphicon-dashboard"></span> Dashboard</a>      
                <a title="Dashboard" class="btn btn-info btn-sm" href="<?=site_url('Expenses_con')?>"><span class=" glyphicon glyphicon-list-alt"></span> Expenses</a>   
                <a title="Dashboard" class="btn btn-success btn-sm" href="<?=site_url('Sales_con')?>"><span class=" glyphicon glyphicon-shopping-cart"></span> Sales</a>                   
            </div>
        </div> <!-- end of panel heading -->  
        
                
        <div class="panel-body">  

            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <thead>
                    <tr class="info">                                               
                        <td class="text-center"><strong>Name</strong></td>    
                        <td class="text-center"><strong>Price</strong></td>     
                        <td class="text-center"><strong>QTY</strong></td> 
                        <td class="text-center"><strong>Discount %</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td>  
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                    <?php if(sizeof($rtl)):$qty=0; $ta=0; foreach ($rtl as $key => $item):  ?>                      
                    <tr class="danger">                                          
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',',');?></a>
                            </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->rtlqty; $qty+=$item->rtlqty; ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->discount ?>%</td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalamount,2,'.',','); $ta+=$item->totalamount; ?></td>
                        <td class="text-center" style="text-transform: capitalize">                           

                            <a title="Edit" href="<?=site_url('Creditreturn_con/deletereturntransactionline/'.$item->rtl_no)?>" class="glyphicon glyphicon-trash btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this product');"></a>
                        </td>
                    </tr>
                    <?php endforeach;  else: $qty=0; $ta=0;  ?>
                        <tr class="text-center">
                          <td colspan="6">There are no Data</td>
                        </tr>
                    <?php endif  ?> 
                     <tr class="danger">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="text-center"><strong><?php echo $qty; ?></strong></td>
                        <td class="text-center"></td>
                        <td class="text-center"><strong>Php <?php echo number_format((float)$ta,2,'.',','); ?></strong></td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
            </table>
             
        </div> <!-- end of panel body -->        
        
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
<div>
    <div class="col-md-4" style="margin-top:60px;" >
    <div class="panel panel-default">
        <div class="panel-heading ">                
            <div class="panel-toolbar text-right" >    
            <span class="text-danger"><strong>CREDIT RETURN</strong></span>  
            <?php if($returnrefno == null){}else { ?>         
               <input type="button" class="btn btn-sm btn-info text-center " data-toggle="modal" data-target="#addproduct" value="ADD PRODUCT" />       
            <?php } ?>           
            </div>
        </div> <!-- end of panel heading -->  
        <form onsubmit="return processform(this);" role="form" method="post" action="<?=site_url('Creditreturn_con/processreturn')?>">                        
            <div class="panel-body"> 

                <input type="text" name="date" class="hide"  value="<?php echo date('Y/m/d'); ?>"  >
                <input type="number" name="totalamount" class="hide" value="<?php echo $ta; ?>"  >
                <input type="number" name="totalqty" class="hide" value="<?php echo $qty; ?>"  >

                <div class="row">
                    <div class="col-md-12">
                        <label for="customer">Select Customer (Required)</label>
                        <?php if($returncustomer == null){ ?>
                        <button style="text-transform: capitalize" class="form-control input-sm"  type="button" data-toggle="modal" data-target="#selectcustomer"><strong><?php echo "No Customer"?></strong></button>
                        <?php }else { ?>
                        <div class="row">
                            <div class="col-md-10">
                                <button style="text-transform: capitalize" class="form-control input-md"  type="button" data-toggle="modal" data-target="#selectcustomer"><strong><?php echo $returncustomer[0]->name; ?></strong></button>
                            </div>
                            <div class="col-md-2">                        
                                <a title="Edit" href="<?=site_url('Creditreturn_con/deletecustomer')?>" class="glyphicon glyphicon-minus btn btn-danger btn-sm" onclick="return confirm('Do you want to Remove this Customer');"></a>
                            </div>
                        </div>
                        <?php } ?>     
                                           
                    </div>
                </div>  

                <?php if($returncustomer == null){}else { ?>
                <div class="row">
                    <div class="col-md-12">
                        <label for="customer">Select Ref No. (Required)</label>
                        <?php if($returnrefno == null){ ?>
                        <button style="text-transform: capitalize" class="form-control input-sm"  type="button" data-toggle="modal" data-target="#selectrefno"><strong><?php echo "Please Select C.I. No"?></strong></button>
                        <?php }else { ?>
                        <div class="row">
                            <div class="col-md-10">
                                <button style="text-transform: capitalize" class="form-control input-md"  type="button" data-toggle="modal" data-target="#selectrefno"><strong><?php echo $returnrefno[0]->ref_no; ?></strong></button>
                            </div>
                            <div class="col-md-2">                        
                                <a title="Edit" href="<?=site_url('Creditreturn_con/deleterefno')?>" class="glyphicon glyphicon-minus btn btn-danger btn-sm" onclick="return confirm('Do you want to Remove this C.I. No.');"></a>
                            </div>
                        </div>
                        <?php } ?>     
                                           
                    </div>
                </div> 
                <?php } ?>
               
            </div>
            <?php if($ta == '0') {}else { ?>
            <div class="modal-footer">
                <a title="Reset" href="<?=site_url('Creditreturn_con/resettransaction')?>"  onclick="return confirm('Do you want to reset this transaction');" type="button" class="btn btn-warning glyphicon glyphicon-floppy-remove" ></a>
                <input title="Process" type="submit" onclick="return confirm('Do you want to Return this file?')" class="btn btn-primary" name="processbtn" value="Process">
            </div>
             <?php } ?>
        </form>
</div>   

<!-- Modal -->
<div id="selectcustomer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Customer with Active Credit</h4>
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
                            <a title="Select" href="<?=site_url('Creditreturn_con/selectcustomer/'.$item->c_no)?>" class=" btn btn-info">SELECT</a>
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
<div id="selectrefno" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Credit Invoice No.</h4>
        </div>
                           
            <div class="modal-body">                    

                <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable"> 
                <thead>
                    <tr class="info">                                                                
                        <td class="text-center"><strong>Date</strong></td> 
                        <td class="text-center"><strong>C.I. No.</strong></td> 
                        <td class="text-center"><strong>Due Date</strong></td>
                        <td class="text-center"><strong>Amount</strong></td>
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($creditlist as $key => $item): ?>                      
                    <tr>                         
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y'); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->duedate), 'm/d/Y'); ?></td>
                         <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount,2,'.',','); ?></td>
                        <td class="text-center info">     
                            <a title="Select" href="<?=site_url('Creditreturn_con/selectrefno/'.$item->cdd_no)?>" class=" btn btn-info">SELECT</a>
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
<div id="addproduct" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Product</h4>
        </div>
                           
        <div class="modal-body">                   
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
            <thead>
                <tr class="info">                                                                                
                    <td class="text-center"><strong>Product</strong></td>  
                    <td class="text-center"><strong>Price</strong></td>  
                    <td class="text-center"><strong>QTY</strong></td>  
                    <td class="text-center"><strong>Discount</strong></td> 
                    <td class="text-center"><strong>Amount</strong></td>  
                    <td class="text-center"><strong>Action</strong></td>  
                </tr> 
            </thead>
            <tbody>
                  <?php foreach ($prod as $key => $item): 
                    $dis = (($item->price*($item->qty-$item->returnqty))*$item->discount)/100; ?>                      
                <tr>                                             
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',','); ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty-$item->returnqty ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->discount.'% - '.number_format((float)$dis,2,'.',',') ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)($item->price*($item->qty-$item->returnqty))-$dis,2,'.',','); ?></td>
                    <td class="text-center info">                                
                          <button title="Add QTY" 
                            data-pno="<?php echo $item->p_no;?>"                                
                            data-name="<?php echo $item->name;?>"
                            data-unitcost="<?php echo $item->unitcost;?>" 
                            data-price="<?php echo $item->price;?>"
                            data-qty="<?php echo $item->qty-$item->returnqty;?>"
                            data-discount="<?php echo $item->discount;?>"                                
                            data-toggle="modal" data-target="#addqty" 
                            class="glyphicon glyphicon-plus btn btn-info addqty"
                            data-backdrop="static" data-keyboard="false"></button>
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
<div id="addqty" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Add Quantity</h4>
        </div>
               
        <form onsubmit="return qtyform(this);" role="form" method="post" action="<?=site_url('Creditreturn_con/insertreturntransactionline')?>">             
        <div class="modal-body">            

            <input id="pno" class="form-control input-sm hide" type="text" name="pno" />
            <input id="unitcost" class="form-control input-sm hide" type="text" name="unitcost" /> 
            <input id="price" class="form-control input-sm hide" type="text" name="price" /> 
            <input id="discount" class="form-control input-sm hide" type="number" name="discount" value="0" />

            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-6 control-label">Product Name</label>
                <div class="col-sm-6">
                    <input id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-6 control-label">Qty</label>
                <div class="col-sm-6">
                    <input id="qty" class="form-control input-sm" max="qty" type="number" name="qty" required autocomplete="off" />
                </div>   

            </div>
           
        </div>
        <div class="modal-footer">
            <a title="Close"  data-dismiss="modal" data-toggle="modal"  type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
            <input type="submit" class="btn btn-primary" name="qtyaddbtn" value="submit">
        </div>
        </form>

    </div>
  </div>
</div> <!-- End of model -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">


function processform(formObj) {            
        formObj.processbtn.disabled = true;  
        formObj.processbtn.value = 'Please Wait...';  
        return true;    
    }  

function qtyform(formObj) {            
        formObj.qtyaddbtn.disabled = true;  
        formObj.qtyaddbtn.value = 'Please Wait...';  
        return true;    
    }  


window.onload = function()
{                             

    $(document).ready(function () {
        $(document).on('click', '.addqty', function(event) {        
            var pno = $(this).data('pno');
            var name = $(this).data('name');            
            var unitcost = $(this).data('unitcost');
            var price = $(this).data('price');
            var qty = $(this).data('qty');
            var discount = $(this).data('discount');
            $(".modal-body #pno").val( pno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
            $(".modal-body #price").val( price );
            $(".modal-body #qty").val( qty );
            $(".modal-body #qty").attr({
                   "max" : qty,       
                   "min" : 1        
                });
            $(".modal-body #discount").val( discount );
        });
    });

  
}
</script>