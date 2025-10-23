<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Bank Information</h3> 
            <a style="margin-left: 5px;" title="Excel print" href="<?=site_url('bank_con/excelprintreport');?>" class="btn btn-sm btn-default pull-right" ><img src="<?=site_url('excel.jpg')?>" style="width: 18px;"/></a>
            <a title="print" href="<?=site_url('bank_con/printreport');?>" class="btn btn-sm btn-default glyphicon glyphicon-print pull-right" ></a>           
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->              
        
        <div class="panel-body">                                              
                <form method="post" role="form" action="<?=site_url('bank_con/updatebank')?>">

                    <input class="form-control input-sm hide" type="text" name="bno" value="<?php echo $bank[0]->b_no;?>" required autocomplete="off">                    

                    <div class="form-group row row-offcanvas">
                        <label class="control-label col-sm-2">Bank Name</label>
                        <div class="col-sm-5">
                            <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Bank Name" value="<?php echo $bank[0]->bankname;  ?>" required autofocus autocomplete="off">                            
                        </div>
                    </div>                                   

                    <div class="form-group row row-offcanvas">
                        <label class="control-label col-sm-2">Address</label>
                        <div class="col-sm-5">
                            <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="address" placeholder="Address" value="<?php echo $bank[0]->address;  ?>" required autocomplete="off">                            
                        </div>
                    </div>                                   

                    <div class="form-group row row-offcanvas">
                        <label class="control-label col-sm-2">Current Balance</label>
                        <div class="col-sm-5">
                            <p style="text-transform: capitalize;" class="form-control input-sm"><?php echo number_format((float)$bank[0]->currentbal,2,'.',',');?></p>                                                                          
                        </div>
                        <div class="col-sm-3">
                            <button title="Save" type="Submit" class="btn btn-sm btn-success glyphicon glyphicon-floppy-save" ></button>
                            <button title="Reset" type="Reset" class="btn btn-sm btn-warning" >Reset</button>
                        </div>
                    </div>            

                </form> 
            <hr>
            <legend>Transaction History</legend>
            
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                    <tr class="info">  
                        <td class="text-center" ><strong>#</strong></td>
                        <td class="text-center" ><strong>Date</strong></td>
                        <td class="text-center"><strong>Description</strong></td> 
                        <td class="text-center"><strong>Deposit</strong></td>      
                        <td class="text-center"><strong>Withdrawal</strong></td>
                        <td class="text-center"><strong>Balance</strong></td>
                        
                    </tr> 
                </thead>
                <tbody>
                    <?php if($bh == null) {}else { ?>
                    <?php for($i=0; $i<count($bh); $i++) { ?>                    
                    <tr>   
                        <td class="text-center" style="text-transform: capitalize"><?php echo $bh[$i]->bh_no;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $bh[$i]->date;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $bh[$i]->description;?></td> 
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$bh[$i]->inamount,2,'.',',');?></td> 
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$bh[$i]->outamount,2,'.',',');?></td> 
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$bh[$i]->balance,2,'.',',');?></td> 
                    </tr>
                    <?php } }?>                         
                </tbody>                               
            </table>   
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>