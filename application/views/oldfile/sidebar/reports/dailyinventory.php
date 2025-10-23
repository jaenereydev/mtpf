<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Daily Inventory</h3>                          
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
            <form role="form" method="post" action="<?=site_url('dailyinventory_con/search')?>">                  
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
                    <label class="col-sm-1 control-label">Date</label>
                    <div class="col-sm-2" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>                           
                    </div>      
                    <div class="col-sm-1" > 
                        <button type="submit" class="glyphicon glyphicon-filter btn-default btn btn-sm pull-left"></button>
                    </div>
                </div>
            </form>
            <hr>
            <div style="height: 500px; overflow: auto; margin: 0 auto;margin-bottom: 5px;"> 
            <table class="table table-hover table-responsive table-bordered table-striped info" >                                                
                <thead>
                    <tr >
                        <td class="text-center" style="vertical-align: middle;" rowspan="2" ><strong>Products</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>BEGINNING INVENTORY</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>RECEIVED</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>CLASSIFYING</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="1" colspan="2"><strong>MILLED</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>SALES</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>CREDIT</strong></td>      
                        <td class="text-center" style="vertical-align: middle;"  rowspan="1" colspan="2"><strong>ADJUSTMENT</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>DISPOSE</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>Total</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>ACTUAL INVENTORY</strong></td>
                        <td class="text-center" style="vertical-align: middle;"  rowspan="2"><strong>Variance</strong></td>
                    </tr>
                    <tr>
                        <td class="text-center">(+)</td>
                        <td class="text-center">(-)</td>
                        <td class="text-center">(+)</td>
                        <td class="text-center">(-)</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $inv = 0; 
                          $rec = 0;
                          $clas = 0; 
                          $inmil = 0;
                          $outmil = 0;
                          $sales = 0;
                          $credit = 0;
                          $inadj = 0;
                          $outadj = 0;
                          $disposed = 0;
                          $tolal = 0;
                          $actinv = 0;
                          $var = 0;
                            for($p=0;$p<count($prod);$p++) { ?>
                    <tr>                         
                        <td class="text-center" style="text-transform: capitalize;"><?php echo $prod[$p]->longdesc;?></td> 
                        <?php  
                                for($h=0;$h<count($prodh);$h++) {
                            if ($prodh[$h]->p_no == $prod[$p]->p_no) { 
                                $inv += $prodh[$h]->INVENTORY; 
                                $rec += $prodh[$h]->RECEIVED;
                                $clas += $prodh[$h]->CLASSIFYING; 
                                $inmil += $prodh[$h]->INMILLED;
                                $outmil += $prodh[$h]->OUTMILLED;
                                $sales += $prodh[$h]->SALES;
                                $credit += $prodh[$h]->CREDIT;
                                $inadj += $prodh[$h]->INADJUSTMENT;
                                $outadj += $prodh[$h]->OUTADJUSTMENT;
                                $disposed += $prodh[$h]->DISPOSED;
                                $tolal += ($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED);
                                $actinv += $prodh[$h]->ACTUALINVENTORY;
                                $var += (($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY;
                                ?>                        
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->INVENTORY,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->RECEIVED,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->CLASSIFYING,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->INMILLED,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->OUTMILLED,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->SALES,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->CREDIT,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->INADJUSTMENT,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->OUTADJUSTMENT,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->DISPOSED,2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED),2,'.',',');?></td>
                            <td class="text-center"><?php echo number_format((float)$prodh[$h]->ACTUALINVENTORY,2,'.',',');?></td>                            
                            <?php if(((($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY) < 0){ ?>
                            <td class="text-center danger">
                            <?php }else if(((($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY) > 0){?>
                            <td class="text-center warning">
                            <?php }else {?>
                            <td class="text-center">
                            <?php }?>
                            <?php echo number_format((float)(($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY,2,'.',',');?></td>
                            <?php }?>                            
                            <?php }?>
                    </tr>
                    
                    <?php }?> 
                    <tr class="text-center">
                        <td><strong>Total</strong></td>
                        <td><?php if($inv == null || $inv == "0"){ echo "0.00";}else{ echo number_format((float)$inv,2,'.',',');}?></td>
                        <td><?php if($rec == null || $rec == "0"){ echo "0.00";}else{ echo number_format((float)$rec,2,'.',',');}?></td>
                        <td><?php if($clas == null || $clas == "0"){ echo "0.00";}else{ echo number_format((float)$clas,2,'.',',');}?></td>
                        <td><?php if($inmil == null || $inmil == "0"){ echo "0.00";}else{ echo number_format((float)$inmil,2,'.',',');}?></td>
                        <td><?php if($outmil == null || $outmil == "0"){ echo "0.00";}else{ echo number_format((float)$outmil,2,'.',',');}?></td>
                        <td><?php if($sales == null || $sales == "0"){ echo "0.00";}else{ echo number_format((float)$sales,2,'.',',');}?></td>
                        <td><?php if($credit == null || $credit == "0"){ echo "0.00";}else{ echo number_format((float)$credit,2,'.',',');}?></td>
                        <td><?php if($inadj == null || $inadj == "0"){ echo "0.00";}else{ echo number_format((float)$inadj,2,'.',',');}?></td>
                        <td><?php if($outadj == null || $outadj == "0"){ echo "0.00";}else{ echo number_format((float)$outadj,2,'.',',');}?></td>
                        <td><?php if($disposed == null || $disposed == "0"){ echo "0.00";}else{ echo number_format((float)$disposed,2,'.',',');}?></td>                        
                        <td><?php if($tolal == null || $tolal == "0"){ echo "0.00";}else{ echo number_format((float)$tolal,2,'.',',');}?></td>
                        <td><?php if($actinv == null || $actinv == "0"){ echo "0.00";}else{ echo number_format((float)$actinv,2,'.',',');}?></td>
                        <?php if($var < 0) { ?>
                            <td class="text-center danger">
                        <?php }else if($var > 0) { ?> 
                            <td class="text-center warning">
                        <?php }else { ?>
                            <td>
                        <?php }?>
                            <?php if($var == null || $var == "0"){ echo "0.00";}else{ echo number_format((float)$var,2,'.',',');}?></td>
                    </tr>
                    
                </tbody>                               
            </table>     
            </div>
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

        <form role="form" method="post" action="<?=site_url('dailyinventory_con/printreport')?>">
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
                    <label class="col-sm-12 control-label">Date</label>
                    <div class="col-sm-12" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
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

        <form role="form" method="post" action="<?=site_url('dailyinventory_con/excelprintreport')?>">
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
                    <label class="col-sm-12 control-label">Date</label>
                    <div class="col-sm-12" id="datepicker"> 
                        <div class="input-group">                       
                            <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>"  required autocomplete="off">                                                                                
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