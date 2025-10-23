<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10 main">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">            
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-signal" ></span> Reports
            </h3>  
            
           <!--  <button type="button" data-toggle="modal" data-target="#storeprocess" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">Store Process</button>                  -->                         
          
        </div> <!-- end of panel heading -->
        <div class="panel-body" >   

            <div class="row col-sm-12">
                <div class="col-sm-4">
                    <div class="form-group row"> 
                        <a type="button" href="<?=site_url('report_con/inventorycost')?>" class="btn btn-default col-sm-12" >INVENTORY</a>
                    </div>  
                </div>

                <div class="col-sm-4">
                    <div class="form-group row"> 
                        <a type="button" href="<?=site_url('report_con/customersummary')?>" class="btn btn-default col-sm-12" >CUSTOMER</a>
                    </div>  
                </div>

                <div class="col-sm-4">
                    <div class="form-group row"> 
                        <a type="button" href="<?=site_url('Duedate_con')?>" class="btn btn-default col-sm-12" >Due Dates</a>
                    </div>  
                </div>

                <div class="col-sm-4">
                    <div class="form-group row"> 
                        <a type="button" href="<?=site_url('Report_con/salesreport')?>" class="btn btn-default col-sm-12" >Sales Report</a>
                    </div>  
                </div>

                <div class="col-sm-4">
                    <div class="form-group row"> 
                        <a type="button" href="<?=site_url('Report_con/transactionsalesreport')?>" class="btn btn-default col-sm-12" >Transaction Sales Report</a>
                    </div>  
                </div>

                <div class="col-sm-4">
                    <div class="form-group row"> 
                        <a type="button" href="<?=site_url('Report_con/profitreport')?>" class="btn btn-default col-sm-12" >Profit Report</a>
                    </div>  
                </div>
             
                 
            </div>
         
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->    
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>