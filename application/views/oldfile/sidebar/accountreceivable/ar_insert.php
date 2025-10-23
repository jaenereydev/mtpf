<script type="text/javascript">

window.onload = function()
{
	var date1= document.getElementById('birthday'); // Date 1        
        var date2 = document.getElementById('date2');   //Date          
                       
        date2.value = date1.value;                                         
	
        document.getElementById('birthday').onchange = function()
	{		
                date2.value = this.value;
	};                       
};

</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div style="margin-top:60px;" class="col-md-12 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-plus-sign"></span> Insert Account Receivable
            </h3>                
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            
            <div class="form-group row row-offcanvas">      
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-2" id="datepicker"> 
                    <div class="input-group">
                        <?php if($ar[0]->posted == "POSTED") { ?>
                        <p class="form-control input-sm" ><?php if($ar[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($ar[0]->date), 'm/d/Y');}?></p>                                    
                        <?php } else { ?>
                        <input class="form-control input-sm" type="text" name="date1" id="birthday" placeholder="click to show datepicker" value="<?php if($ar[0]->date == null){echo date('m/d/Y');}else{ echo date_format(date_create($ar[0]->date), 'm/d/Y');}?>"  required autocomplete="off">                                    
                        <?php }?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>                    
                </div>   
                <label class="col-sm-1 control-label">Ref. No.</label>
                <div class="col-sm-2">
                    <?php if($ar[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" ><?php echo $ar[0]->ref_no; ?></p>
                    <?php } else { ?>
                    <input id="ref_no1" class="form-control input-sm" type="text" name="ref_no1"  value="<?php echo $ar[0]->ref_no; ?>" required disabled autocomplete="off">
                    <?php }?>
                </div>    
                <label class="col-sm-1 control-label">Customer:</label>
                <div class="col-sm-5">
                    <?php if($ar[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" ><?php for($r=0;$r<count($cus);$r++)
                                {
                                if($ar[0]->c_no == ""||$ar[0]->c_no == null){}
                                else { if($cus[$r]->c_no == $ar[0]->c_no)
                                        { echo $cus[$r]->name; }
                                        }} ?></p>
                    <?php } else { ?>
                    <div class="input-group">
                    <p class="form-control input-sm"><?php for($r=0;$r<count($cus);$r++)
                                {
                                if($ar[0]->c_no == ""||$ar[0]->c_no == null){}
                                else { if($cus[$r]->c_no == $ar[0]->c_no)
                                        { echo $cus[$r]->name; }
                                        }} ?></p>                                        
                    <a type="button" title="Select Customer" data-toggle="modal" data-target="#Customerlist" data-backdrop="static" data-keyboard="false"  class="btn btn-default input-group-addon"><span >...</span></a>                               
                    </div>
                    <?php }?>
                </div>
            </div>  
            <div class="form-group row row-offcanvas">
                <div class="col-sm-6">
                    <label class="control-label">Credit Information</label>
                    <div  style="height: 220px; overflow: auto; margin: 0 auto;margin-bottom: 5px; background-color: #E8E8E8 ;"> 
                    <table class="table table-responsive table-bordered table-hover">                                                                
                       <tr class="info">  
                            <?php if($ar[0]->posted == "POSTED") {}else { ?>
                            <td class="text-center"><strong>ACTION</strong></td>   
                            <?php }?>
                            <td class="text-center"><strong>Ref. No.</strong></td> 
                            <td class="text-center"><strong>C.I. No.</strong></td> 
                            <td class="text-center"><strong>Amount</strong></td> 
                        </tr>        
                        <?php for($i=0; $i<count($arl); $i++) { ?>
                        <tr style="background-color: white;">
                            <?php if($ar[0]->posted == "POSTED") {}else { ?>
                            <td class="text-center">
                                <a class="btn-sm btn-danger glyphicon glyphicon-trash" href="/mtpf/accountreceivable_con/delarl/<?php echo $arl[$i]->cpl_no;?>/<?php echo $ar[0]->cp_no;?>"></a>
                            </td>  
                            <?php }?>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $arl[$i]->ref_no; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $arl[$i]->ci_no; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$arl[$i]->amount,2,'.',','); ?></td>
                        </tr>
                        <?php }?>
                    </table>                     
                    </div>
                    <div style="background-color: #E8E8E8 ;" >                        
                        <div class="form-group row row-offcanvas" style="">  
                        <div class="col-sm-4 pull-right">
                            <p class="form-control input-sm text-right" ><?php if($sumarl[0]->amount == null){ echo "0.00";}else{ echo number_format((float)$sumarl[0]->amount,2,'.',',');} ?></p>
                        </div>
                        <label class="col-sm-3 pull-right control-label text-right" >Total Credit:</label> 
                        <?php if($ar[0]->posted == "POSTED") {}else { ?>
                        <button title="Select Credit Order" data-toggle="modal" data-target="#Creditorder" data-backdrop="static" data-keyboard="false" class="glyphicon glyphicon-plus pull-right btn btn-primary" style="margin-right: 5px; " <?php if($ar[0]->c_no == null){?>disabled<?php }else{}?> ></button>
                        <?php }?>
                        </div>  
                    </div>                    
                </div>
                
                <div class="col-sm-6">
                    <label class="control-label">Payment</label>
                    <div  style="height: 220px; overflow: auto; margin: 0 auto;margin-bottom: 5px;background-color: #E8E8E8 ;"> 
                    <table class="table table-responsive table-bordered table-hover">                                                                
                        <tr class="info">           
                            <?php if($ar[0]->posted == "POSTED") {}else { ?>
                            <td class="text-center"><strong>ACTION</strong></td>
                            <?php }?>
                            <td class="text-center"><strong>Description</strong></td> 
                            <td class="text-center"><strong>Amount</strong></td> 
                        </tr>        
                        <?php for($i=0; $i<count($pr); $i++) { ?>
                        <tr style="background-color: white;">
                            <?php if($ar[0]->posted == "POSTED") {}else { ?>
                            <td class="text-center">
                                <a class="btn-sm btn-danger glyphicon glyphicon-trash" href="/mtpf/accountreceivable_con/delpr/<?php echo $pr[$i]->pr_no;?>/<?php echo $ar[0]->cp_no;?>"></a>
                            </td>
                            <?php }?>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $pr[$i]->description; ?></td>
                            <td class="text-center" title="<?php echo "#";echo $pr[$i]->checkno; echo '  - '; echo $pr[$i]->checkdate; echo ' - '; echo $pr[$i]->bankname; ?>" style="text-transform: capitalize"><?php echo number_format((float)$pr[$i]->amount,2,'.',','); ?></td>
                        </tr>
                        <?php }?>
                    </table>                        
                    </div>
                    <div style="background-color: #E8E8E8 ;" >                        
                        <div class="form-group row row-offcanvas" >  
                        <div class="col-sm-4 pull-right">
                            <p class="form-control input-sm text-right" ><?php if($sumpr[0]->amount == null){ echo "0.00";}else{ echo number_format((float)$sumpr[0]->amount,2,'.',',');} ?></p>
                        </div>
                        <label class="col-sm-3 pull-right control-label text-right" >Total Payment:</label>
                        <?php if($ar[0]->posted == "POSTED") {}else { ?>
                        <button title="Add Payment" data-toggle="modal" data-target="#Addpayment" data-backdrop="static" data-keyboard="false" class="glyphicon glyphicon-plus pull-right btn btn-primary" style="margin-right: 5px; " <?php if($ar[0]->c_no == null){?>disabled<?php }else{}?>></button>
                        <?php }?>
                        </div>  
                    </div>  
                </div>
            </div>           
            <form role="form" method="post" action="<?=site_url('accountreceivable_con/savecp')?>">
            <div class="form-group row row-offcanvas">   
                <input id="date2" class="form-control input-sm hide" type="text" name="date" required  >
                <input class="form-control input-sm hide" type="text" name="arno" value="<?php echo $ar[0]->cp_no;?>" required  >
                <input class="form-control input-sm hide" name="ta" value="<?php if($sumpr[0]->amount == null){}else{ echo $sumpr[0]->amount;} ?>">
                <label class="col-sm-1 control-label">O.R. No.</label>
                <div class="col-sm-2">
                    <?php if($ar[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" ><?php echo $ar[0]->or_no; ?></p>
                    <?php }else {?>
                    <input  class="form-control input-sm" type="text" name="or_no"  value="<?php echo $ar[0]->or_no; ?>" required autocomplete="off">
                    <?php }?>
                </div> 
                
                <label class="col-sm-1 control-label">Remarks</label>
                <div class="col-sm-2">
                    <?php if($ar[0]->posted == "POSTED") { ?>
                    <p class="form-control input-sm" ><?php echo $ar[0]->remarks; ?></p>
                    <?php }else {?>
                    <input class="form-control input-sm" type="text" name="remarks"  value="<?php echo $ar[0]->remarks; ?>"  autocomplete="off">
                    <?php }?>
                </div> 
                
                <?php if($ar[0]->posted == "POSTED") {}else{ ?>
                <label class="col-sm-1 control-label">Balance:</label>
                <?php }?>
                <div class="col-sm-5"> 
                    <?php if($ar[0]->posted == "POSTED") { ?>                   
                     <?php }else {?>
                    <p class="form-control input-sm text-right"><?php for($r=0;$r<count($cus);$r++)
                                {
                                if($ar[0]->c_no == ""||$ar[0]->c_no == null){}
                                else { if($cus[$r]->c_no == $ar[0]->c_no)
                                {  echo "Php "; echo number_format((float)($cus[$r]->totalcredit-$sumpr[0]->amount),2,'.',',');}
                                }} ?></p> 
                    <?php }?>
                </div>
                
;            </div>  
             <div class="modal-footer">
                <?php if($ar[0]->posted == "POSTED") { ?>
                 <a title="Back" href="/mtpf/accountreceivable_con/arview"  type="button" class="btn btn-info glyphicon glyphicon-arrow-left" ></a>
                <?php }else {?>
                <a title="Close" href="/mtpf/accountreceivable_con/backupdatear/<?php echo $ar[0]->cp_no;?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                <button title="Save" type="Submit" onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" <?php if($ar[0]->c_no == null){?>disabled<?php }else{}?>></button>                        
                <?php }?>
             </div>
            </form>                                  
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div class="modal fade" id="Customerlist" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
          <h4 class="modal-title text-center" id="creditModalLabel">Customer List</h4>
        </div>
            <div class="modal-body table-responsive">
                <table class="table table-condensed table-bordered " id="MTable">
                    <thead>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center">Customer Name</td>                             
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(sizeof($cus)):
                            foreach ($cus as $key => $item): ?>
                            <tr>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $item->c_no ?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $item->name ?></td>                                    
                                <td class="text-center">
                                    <a href="/mtpf/accountreceivable_con/selectcus/<?php echo $item->c_no ?>/<?php echo $ar[0]->cp_no;?> ?>" class="btn btn-primary prod-add" >SELECT</a>
                                </td>
                            </tr>
                        <?php endforeach;
                            else: ?>
                            <tr>
                                <td colspan="4">There are no Customer.</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Creditorder" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
          <h4 class="modal-title text-center" id="creditModalLabel">Credit Order</h4>
        </div>
            <div class="modal-body table-responsive">
                <table class="table table-condensed table-bordered" id="CoTable">
                    <thead>
                        <tr>
                            <td class="text-center">Date</td>
                            <td class="text-center">Ref No.</td>                             
                            <td class="text-center">C.I. No.</td>
                            <td class="text-center">Total Amount</td>
                            <td class="text-center">Status</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>   
                        <?php for($e=0;$e<count($arlstat);$e++) { ?>
                            <tr>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $arlstat[$e]->date;?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $arlstat[$e]->ref_no;?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $arlstat[$e]->ci_no;?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$arlstat[$e]->amount,2,'.',',');?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $arlstat[$e]->status;?></td>
                                <td class="text-center">
                                    <a href="/mtpf/accountreceivable_con/insertcplp/<?php echo $arlstat[$e]->co_no; ?>/<?php echo $ar[0]->cp_no;?>/<?php echo $arlstat[$e]->amount; ?>" class="btn btn-primary prod-add" >SELECT</a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php for($o=0;$o<count($cpl);$o++) { ?>
                            <tr>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $cpl[$o]->date;?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $cpl[$o]->ref_no;?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo $cpl[$o]->ci_no;?></td>
                                <td class="text-center" style="text-transform: capitalize;"><?php echo number_format((float)$cpl[$o]->totalamount,2,'.',',');?></td>
                                <td class="text-center" style="text-transform: capitalize;"></td>
                                <td class="text-center">
                                    <a href="/mtpf/accountreceivable_con/insertco/<?php echo $cpl[$o]->co_no; ?>/<?php echo $ar[0]->cp_no;?>" class="btn btn-primary prod-add" >SELECT</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Addpayment" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>
          <h4 class="modal-title" id="creditModalLabel">Add Payment</h4>
        </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=site_url('accountreceivable_con/addpayment')?>">  
                    <input class="form-control input-sm hide" type="text" name="arno" value="<?php echo $ar[0]->cp_no;?>">
                    <div class="form-group row row-offcanvas">              
                        <label class="col-sm-12 control-label">Description</label>
                        <div class="col-sm-12">
                            <select  name="description" class="btn btn-default dropdown-toggle col-sm-12" data-toggle="dropdown" aria-expanded="true" required>                             
                                <option value="Cash" >Cash</option> 
                                <option value="Check" >Check</option> 
                                <option value="Transfer" >Transfer</option> 
                                <option value="Payroll" >Payroll</option>
                                <option value="Delivery" >Delivery</option>
                            </select>
                        </div>                 
                    </div>

                    <div class="form-group row row-offcanvas">              
                        <label class="col-sm-12 control-label">Bank Name</label>
                        <div class="col-sm-12">
                            <input class="form-control input-sm" type="text" name="bankname" placeholder="Bank Name" autocomplete="off">
                        </div>                 
                    </div>

                    <div class="form-group row row-offcanvas">              
                        <label class="col-sm-12 control-label">Check Number </label>
                        <div class="col-sm-12">
                            <input class="form-control input-sm" type="text" name="checkno" placeholder="Check Number" autocomplete="off">
                        </div>                 
                    </div>

                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-12 control-label">Check Date</label>
                        <div class="col-sm-12" id="datepicker"> 
                            <div class="input-group">
                                <input class="form-control input-sm" type="text" name="cdate" id="mbirthday" placeholder="click to show datepicker"  autocomplete="off">                                    
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>                    
                        </div>                     
                    </div>

                    <div class="form-group row row-offcanvas">              
                        <label class="col-sm-12 control-label">Amount</label>
                        <div class="col-sm-12">
                            <input class="form-control input-sm" type="number" step="any" name="amount" placeholder="Amount" required autocomplete="off">
                        </div>                 
                    </div>

                    <div class="modal-footer">
                        <a title="Close" data-dismiss="modal" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                        <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                        
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>