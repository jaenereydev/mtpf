<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Product Sales Report</h3>                          
            <div class="panel-toolbar text-right">
                <a href="<?php echo site_url('reports_con') ?>" title="Back" class="glyphicon glyphicon-arrow-left btn btn-info btn-sm" ></a>
    		<a data-toggle="modal" data-target="#printreport" class="btn btn-primary btn-sm">
    			<span class="glyphicon glyphicon-print"></span> Print
    		</a>
    		<a data-toggle="modal" data-target="#excelprintreport" class="btn btn-success btn-sm">
    			<span class="glyphicon glyphicon-floppy-save"></span> Export to Excel
    		</a>
    	</div>
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->              
        
        <div class="panel-body">    
            <form role="form" method="post" action="<?=site_url('Productsales_con/search')?>">                  
                <div class="form-group row row-offcanvas" style="margin-top: 10px;">     
                    <label class="col-sm-1 control-label">Category</label>
                    <div class="col-sm-2">
                        <select name="c_no" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                                                                                        
                            <option value="all" >All</option>
                            <?php for($c=0;$c<count($cat);$c++) {?>
                            <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->description;?></option>
                            <?php } ?>
                        </select>  
                    </div>
                    <label class="col-sm-1 control-label">From</label>
                    <div class="col-sm-3" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="from" id="birthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>                           
                    </div> 
                    <label class="col-sm-1 control-label">To:</label>
                    <div class="col-sm-3" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="to" id="fbirthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>                           
                    </div>
                    <div class="col-sm-1" > 
                        <button type="submit" class="glyphicon glyphicon-filter btn-default btn btn-sm pull-left"></button>
                    </div>
                </div>
            </form>
            <hr>
            
            <?php if($prod == null) {?>
                <p class="text-center">No Sales Data available.</p>    
            <?php }else { ?>
            <legend>Sales Transaction</legend>
            <table class="table table-bordered table-condensed" id="MTable">                  
                <thead>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Date</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Products</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Unit Price</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Qty</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>SRP</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Total</strong></td>
                    </tr>                  
                </thead>
                <tbody>     
                    <?php for($p=0;$p<count($prod);$p++) { ?>
                    <tr>                                         
                        <td class="text-center" style="text-transform: capitalize;"><?php echo $prod[$p]->date;?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo $prod[$p]->longdesc;?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->unitprice,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->qty,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->price,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->qty*$prod[$p]->price,2,'.',',');?></td>                        
                    </tr>        
                    <?php }?> 
                </tbody>                               
            </table>    
            <?php }?>
            <hr>
            <?php if($creditprod == null) {?>
                <p class="text-center">No Credit Data available.</p>    
            <?php }else { ?>
            <legend>Credit Sales Transaction</legend>
            <table class="table table-bordered table-condensed" id="CoTable">                                                
                <thead>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Date</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Products</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Unit Price</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Qty</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>SRP</strong></td>
                        <td class="text-center" style="vertical-align: middle;" ><strong>Total</strong></td>
                    </tr>                  
                </thead>
                <tbody>     
                    <?php for($p=0;$p<count($creditprod);$p++) { ?>
                    <tr>                                         
                        <td class="text-center" style="text-transform: capitalize;"><?php echo $creditprod[$p]->date;?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo $creditprod[$p]->longdesc;?></td>                        
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->unitprice,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->qty,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->price,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->qty*$creditprod[$p]->price,2,'.',',');?></td>   
                    </tr>        
                    <?php }?> 
                </tbody>                               
            </table>    
            <?php }?>
           
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<!--Modal-->
<div id="printreport" class="modal fade " role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1050;">
   <div class="modal-dialog modal-sm">
   <!--             Modal content-->
    <div class="modal-content">
        <div class="modal-header">                        
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                    
            <h4 class="modal-title"><span class="glyphicon glyphicon-print" style="font-size: 20px;padding-right: 10px;"></span>Print</h4>
        </div><!-- End of Modal Header -->

        <form role="form" method="post" action="<?=site_url('productsales_con/printreport')?>">
            <div class="modal-body">                                                             
                <div class="form-group row row-offcanvas" style="margin-top: 10px;">                    
                    <label class="col-sm-12 control-label">Category</label>
                    <div class="col-sm-12">
                        <select name="c_no" class="btn btn-default dropdown-toggle col-sm-12 " data-toggle="dropdown" aria-expanded="true" required>                                                                                        
                            <option value="all" >All</option>
                            <?php for($c=0;$c<count($cat);$c++) {?>
                            <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->description;?></option>
                            <?php } ?>
                        </select>  
                    </div>
                    <label class="col-sm-12 control-label">From:</label>
                    <div class="col-sm-12" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="from" id="from" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>                           
                    </div>  
                    
                    <label class="col-sm-12 control-label">To:</label>
                    <div class="col-sm-12" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="to" id="to" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>                           
                    </div>
                </div>               
                <div class="modal-footer">
                      <a title="Close"   data-dismiss="modal" data-toggle="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                       
                </div>
            </div><!--End of Modal Body -->
        </form>  
    </div>
   </div>
</div><!--   End of model -->       

<div id="excelprintreport" class="modal fade " role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1050;">
   <div class="modal-dialog modal-sm">
   <!--             Modal content-->
    <div class="modal-content">
        <div class="modal-header">                        
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                    
            <h4 class="modal-title"><span class="glyphicon glyphicon-print" style="font-size: 20px;padding-right: 10px;"></span>Excel Print</h4>
        </div><!-- End of Modal Header -->

        <form role="form" method="post" action="<?=site_url('productsales_con/excelprintreport')?>">
            <div class="modal-body">                                                             
                <div class="form-group row row-offcanvas" style="margin-top: 10px;">                    
                    <label class="col-sm-12 control-label">Category</label>
                    <div class="col-sm-12">
                        <select name="c_no" class="btn btn-default dropdown-toggle col-sm-12 " data-toggle="dropdown" aria-expanded="true" required>                                                                                        
                            <option value="all" >All</option>
                            <?php for($c=0;$c<count($cat);$c++) {?>
                            <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->description;?></option>
                            <?php } ?>
                        </select>  
                    </div>
                    <label class="col-sm-12 control-label">From:</label>
                    <div class="col-sm-12" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="from" id="from2" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocompletfrome="off">                                                                                
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>                           
                    </div>  
                    
                    <label class="col-sm-12 control-label">To:</label>
                    <div class="col-sm-12" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="to" id="to2" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>                           
                    </div>
                </div>               
                <div class="modal-footer">
                      <a title="Close"   data-dismiss="modal" data-toggle="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                                                       
                </div>
            </div><!--End of Modal Body -->
        </form>  
    </div>
   </div>
</div><!--   End of model -->   
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
