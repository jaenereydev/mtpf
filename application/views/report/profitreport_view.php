<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-ruble" ></span> Profit Report
            </h3>         
            <div class="panel-toolbar text-right">
            </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body">  
           
            <form role="form" method="post" action="<?=site_url('Report_con/searchprofitreport')?>">                    
                    
                <div class="form-group row row-offcanvas">
                    <div class="col-sm-5">
                        <input  class="form-control input-md" type="text" name="search" placeholder="Search by Date" id="birthday" required autocomplete="off">
                    </div>   
                    <div class="col-sm-1">
                        <button title="Search" type="Submit" class="btn btn-success" >Search</button>
                    </div>          
                </div>  
            </form>   

            <?php if($profitreportlist == null){}else { ?>
                <hr>
                <table class="table table-hover table-responsive table-bordered table-striped info"> 
                    <thead>
                        <tr class="info">                                             
                            <td class="text-center"><strong>Action</strong></td>
                            <td class="text-center"><strong>Ref. #</strong></td> 
                            <td class="text-center"><strong>DATE</strong></td>     
                            <td class="text-center"><strong>Type</strong></td> 
                            <td class="text-center"><strong>Total Cost</strong></td> 
                            <td class="text-center"><strong>Total Amount</strong></td> 
                            <td class="text-center"><strong>Profit</strong></td>       
                        </tr> 
                    </thead>
                    <tbody>
                        <?php 
                            $totalcost = 0;
                            $totalamount = 0;
                            $profit = 0;
                            foreach ($profitreportlist as $key => $item):  
                            $totalcost += $item->total_cost; 
                            $totalamount += $item->total_amount;
                            $profit += $item->profit; ?>                    
                        <tr> 
                            <td class="text-center">
                                <a target="_blank" 
                                    title="Print"
                                    href="<?=site_url('Receipt_con/reprint/'.$item->t_no.'/'.$item->customer_c_no)?>" 
                                    class="glyphicon glyphicon-print btn btn-default"></a>                            
                            </td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no;?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->date;?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->type;?></td> 
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->total_cost,2,'.',',');?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->total_amount,2,'.',',');?></td>        
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->profit,2,'.',',');?></td>      
                        </tr>
                        <?php endforeach;  ?>   
                    </tbody>
                    <tfooter>
                        <td class="text-center" style="text-transform: capitalize" colspan="4"><strong>Grand Total</strong></td>
                        <td class="text-center" style="text-transform: capitalize" ><strong><?php echo number_format((float)$totalcost,2,'.',','); ?></strong></td>
                        <td class="text-center" style="text-transform: capitalize" ><strong><?php echo number_format((float)$totalamount,2,'.',','); ?></strong></td>
                        <td class="text-center" style="text-transform: capitalize" ><strong><?php echo number_format((float)$profit,2,'.',','); ?></strong></td>
                    </tfooter>
                </table>
            <?php } ?>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
