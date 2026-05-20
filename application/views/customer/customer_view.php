<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

    <div class="col-md-5">
        <div class="panel panel-default dashboard-panel">
            <div class="panel-body">
                <div class="panel-body dashboard-panel-body">
                    <div class="row">

                        <div class="col-xs-4 text-center dashboard-icon-box">
                            <h3>
                                <span class="glyphicon glyphicon-user dashboard-icon customer-color"></span>
                            </h3>
                        </div>

                        <div class="col-xs-8 dashboard-count-box">
                            <div class="dashboard-count">
                                <h2><?php echo isset($customercount) ? number_format($customercount) : 0; ?></h2>
                            </div>
                            <div class="dashboard-label">
                                <h4>Customer Count</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel panel-default dashboard-panel">
            <div class="panel-body">
                <div class="panel-body dashboard-panel-body">
                    <div class="row">

                        <div class="col-xs-4 text-center dashboard-icon-box">
                            <h3>
                                <span class="glyphicon glyphicon-credit-card dashboard-icon balance-color"></span>
                            </h3>
                        </div>

                        <div class="col-xs-8 dashboard-count-box">
                            <div class="dashboard-count">
                                <h2><?php echo isset($customerbalance) ? number_format($customerbalance, 2) : '0.00'; ?></h2>
                            </div>
                            <div class="dashboard-label">
                                <h4>Customer Balance</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Customer List
            </h3>         
            <div class="panel-toolbar text-right">
                <a href="<?php echo site_url('Customer_con/get_allcustomer') ?>" class="btn btn-default">
                    <span class="glyphicon glyphicon-list"></span> Show All
                </a>
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info" data-backdrop="static" data-keyboard="false">New</button>       
                <a href="<?php echo site_url('Customercategory_con') ?>" type="button" class="btn btn-warning " >Customer Category</a>  
                
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if($cus == null){ ?>
                <!-- product search form -->
                <form role="form" method="post" action="<?=site_url('customer_con/customersearch')?>">                    
                    
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-2 control-label">Customer Search</label>
                        <div class="col-sm-5">
                            <input  class="form-control input-md" type="text" name="csearch" placeholder="Name"  required autofocus autocomplete="off">
                        </div>   
                        <div class="col-sm-1">
                            <button title="Search" type="Submit" class="btn btn-success" >Search</button>
                        </div>          
                    </div>  
                </form>   
            <?php }else { ?>
                <form role="form" method="post" action="<?=site_url('customer_con/customersearch')?>">                    
                    
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-2 control-label">Customer Search</label>
                        <div class="col-sm-5">
                            <input  class="form-control input-md" type="text" name="csearch" placeholder="Name"  required autofocus autocomplete="off">
                        </div>   
                        <div class="col-sm-1">
                            <button title="Search" type="Submit" class="btn btn-success" >Search</button>
                        </div>    
                    </div>  
                </form> 
                <hr>
                <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                    <thead>
                        <tr class="info">                                             
                            
                            <td class="text-center"><strong>#</strong></td>                         
                            <td class="text-center"><strong>Customer Name</strong></td> 
                            <td class="text-center"><strong>Balance</strong></td>   
                            <td class="text-center"><strong>Action</strong></td>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php for($i=0; $i<count($cus); $i++) { ?>                    
                        <tr> 
                            
                            <td class="text-center" style="text-transform: capitalize"><?php echo $cus[$i]->c_no;?></td>                        
                            <td class="text-center" style="text-transform: capitalize"><?php echo $cus[$i]->name;?></td>  
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$cus[$i]->balance,2,'.',',');?></td>  
                            <td class="text-center">
                            <a title="Edit" href="<?=site_url('customer_con/customerinfo/'.$cus[$i]->c_no)?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <?php if($users[0]->position == "Cashier"){}else { ?>
                            <a type="button" title="Delete" href="<?=site_url('customer_con/delcustomer/'.$cus[$i]->c_no)?>" onclick="return confirm('Do you want to delete this Customer?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                           
                            <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>   
                    </tbody>
                </table>
            <?php } ?>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

    <!-- Modal -->
    <div id="report" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm"> 
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-info">                                        
                <h4 class="modal-title"><span class="glyphicon glyphicon-print" style="font-size: 20px;padding-right: 10px;"></span>Customer Report</h4>
            </div>                                    
            <div class="modal-body">
                <div class="form-group row row-offcanvas">
                <a style="margin-left: 10px" title="Print" href="/mtpf/customer_con/allcustomerprint" type="button" class="pull-left btn-lg btn-info glyphicon glyphicon-print" > Print</a>                                
                <a style="margin-right: 10px" title="Export to Excel" href="/mtpf/customer_con/allcustomerprintexcel" class="pull-right btn-lg btn-success glyphicon glyphicon-print " > Excel</a>                                        
                </div>
            </div>               
        </div>
        </div>
    </div> <!-- End of model -->
    
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg"> 
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">                    
                <a title="Close" href="<?=site_url('customer_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="close" >&times;</a>                    
                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Customer</h4>
            </div>
            <form role="form" method="post" action="<?=site_url('customer_con/insertcustomer')?>">                    
                <div class="modal-body">     
                    <legend>Personal Information</legend>
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Customer Name"  required autofocus autocomplete="off">
                        </div>                            
                    </div>
                    
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                            <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="address" placeholder="Address"  autocomplete="off">
                        </div>                            
                    </div>                                                                               
                    
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Tel No.</label>
                        <div class="col-sm-9">
                            <input class="form-control input-sm" type="number" name="telno" placeholder="Telephone Number" autocomplete="off">
                        </div>
                    </div>                                                                                
                    
                    <legend>Credit Information</legend>
                    
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Total Credit<span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input class="form-control input-sm" type="number" name="balance" placeholder="Total Limit" value="0" step="any" autocomplete="off" required>
                        </div>
                    </div>
                    
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Credit Limit<span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input class="form-control input-sm" type="number" name="creditlimit" placeholder="Credit Limit" value="0" step="any" autocomplete="off" required>
                        </div>
                    </div>
                    
                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Terms<span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input class="form-control input-sm" type="number" name="terms" placeholder="Terms" value="1" step="any" autocomplete="off" required>
                        </div>
                    </div>  

                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Category<span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <select name="cno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                                                
                                <?php for($c=0;$c<count($cat);$c++) { ?>
                                <option value="<?php echo $cat[$c]->cc_no;?>" ><?php echo $cat[$c]->name;?></option>
                                <?php } ?>
                            </select>  
                        </div>
                    </div>                            
                    
                </div>
                
                <div class="modal-footer">
                    <a title="Close" href="<?=site_url('customer_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                    <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                </div>
            </form>
        </div>
        </div>
    </div> <!-- End of model -->

<!-- Modal -->
<div id="customerdeposit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Customer Deposit</h4>
        </div>
            
        <form onsubmit="return customerdepositform(this);" role="form" method="post" action="<?=site_url('Customer_con/customerdeposit')?>">             
        <div class="modal-body">            

            <input id="cno" class="form-control input-sm hide" type="text" name="cno" /> 
            <input id="bal" class="form-control input-sm hide" type="text" name="bal" />    

            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-6 control-label">Customer Name</label>
                <div class="col-sm-6">
                    <input style="text-transform: capitalize" id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>
        

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-6 control-label">Amount</label>
                <div class="col-sm-6">
                    <input class="form-control input-sm " type="number" name="amount" required autocomplete="off" />
                </div>   

            </div>
            
    
        </div>
        <div class="modal-footer">
            <a title="Close"  data-dismiss="modal" data-toggle="modal"  type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
            <input type="submit" class="btn btn-primary" name="customerdepositbtn" value="submit">
        </div>
        </form>

    </div>
    </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<style>
    .dashboard-panel {
        border-radius: 4px;
    }

    .dashboard-panel-body {
        padding: 10px;
    }

    .dashboard-icon-box {
        border-right: 1px solid #ddd;
        min-height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-icon-box h3 {
        margin: 0;
    }

    .dashboard-icon {
        font-size: 38px;
    }

    .dashboard-count-box {
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dashboard-count h2 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
        color: #333;
    }

    .dashboard-label h4 {
        margin: 5px 0 0;
        font-size: 12px;
        color: #777;
        text-transform: uppercase;
        line-height: 1.2;
    }

    .customer-color {
        color: #337ab7;
    }

    .balance-color {
        color: #d9534f;
    }
</style>

<script type="text/javascript">

function customerdepositform(formObj) {            
        formObj.customerdepositbtn.disabled = true;  
        formObj.customerdepositbtn.value = 'Please Wait...';  
        return true;    
    }  


window.onload = function()
{                         

    $(document).ready(function () {
        $(document).on('click', '.customerdeposit', function(event) {        
            var cno = $(this).data('cno');
            var name = $(this).data('name');  
            var bal = $(this).data('bal');           
            $(".modal-body #cno").val( cno );
            $(".modal-body #name").val( name );
            $(".modal-body #bal").val( bal );
        });
    });

    setTimeout(function() {
    $('#message').fadeOut();
    }, 3000 );
}

</script>