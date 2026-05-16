<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-folder-open" ></span> Sales Report
            </h3>         
            <div class="panel-toolbar text-right">
                <button type="button" data-toggle="modal" data-target="#coh" class="btn btn-info pull-right" >INSERT CASH ON HAND</button>
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
        
            <form role="form" method="post" action="<?=site_url('Report_con/searchsalesreport')?>">                    
                    
                <div class="form-group row row-offcanvas">
                    <div class="col-sm-5">
                        <input  class="form-control input-md" type="text" name="search" placeholder="Search by Date" id="birthday" required autocomplete="off">
                    </div>   
                    <div class="col-sm-1">
                        <button title="Search" type="Submit" class="btn btn-success" >Search</button>
                    </div>          
                </div>  
            </form>   

            <?php if($salesreport == null){}else { ?>
                <hr>
                <table class="table table-hover table-responsive table-bordered table-striped info"> 
                    <thead>
                        <tr class="info">                                             
                            <td class="text-center"><strong>Action</strong></td>
                            <td class="text-center"><strong>DATE</strong></td>                         
                            <td class="text-center"><strong>NAME</strong></td> 
                        </tr> 
                    </thead>
                    <tbody>
                        <?php foreach ($salesreport as $key => $item):  ?>                    
                        <tr> 
                            <td class="text-center">
                                <a target="_blank" title="Print" href="<?=site_url('Report_con/reprintsalesreport/'.$item->sr_no)?>" class="glyphicon glyphicon-print btn btn-default"></a>                            
                            </td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->date;?></td>                        
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->name;?></td>  
                        </tr>
                        <?php endforeach;  ?>   
                    </tbody>
                </table>
            <?php } ?>
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
                
            <form onsubmit="return cohform(this);" role="form" method="post" action="<?=site_url('Report_con/insertcohsalesreport')?>">
            
                <div class="modal-body">     
                    <div class="form-group row ">                                                        
                        <label class="col-sm-6 control-label">Date</label>
                        <div class="col-sm-6">
                            <input class="form-control input-sm " type="text" id="from" name="date" autocomplete="off" required/>
                        </div>   
                    </div>
                
                    <div class="form-group row ">                                                        
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

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
