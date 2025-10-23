<script type="text/javascript">

window.onload = function()
{	        
        $(document).ready(function () {

            $('.addpayment').click(function () {                       
                var apno = $(this).data('ap');
                $(".modal-body #apno").val( apno );                
            });

        }); 
};
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left " style="padding-top: 8px;font-size: 20px;"> 
                <span class="glyphicon glyphicon-minus-sign"></span> Accounts Payable
            </h3>                
        <a type="button" href="<?=site_url('accountpayable_con/accountpayableinsertview')?>" class="btn btn-info pull-right">Insert</a>
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <!--Modal-->
            <div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
               <div class="modal-dialog modal-sm">
               <!--             Modal content-->
               <div class="modal-content">
                   <div class="modal-header">                    
                       <a title="Close" type="button" class="close" data-dismiss="modal" >&times;</a>                    
                       <h4 class="modal-title"><span class="glyphicon glyphicon-plus" style="font-size: 20px;padding-right: 10px;"></span>Add Payment</h4>
                   </div><!-- End of Modal Header -->
                  
                    <div class="modal-body">   
                    <form role="form" method="post" action="<?=site_url('accountpayable_con/addpayment')?>">  
                        <input class="form-control input-sm hide" type="text" name="apno" id="apno">
                        <div class="form-group row row-offcanvas">              
                            <label class="col-sm-12 control-label">O.R. #</label>
                            <div class="col-sm-12">
                                <input class="form-control input-sm" type="text" name="orno" placeholder="O.R. #" autofocus autocomplete="off">
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
                                    <input class="form-control input-sm" type="text" name="date" id="birthday" placeholder="click to show datepicker"  autocomplete="off">                                    
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>                    
                            </div>                     
                        </div>
                        
                        <div class="form-group row row-offcanvas">              
                            <label class="col-sm-12 control-label">Amount</label>
                            <div class="col-sm-12">
                                <input class="form-control input-sm" type="number" name="amount" placeholder="Amount" required autocomplete="off">
                            </div>                 
                        </div>
                            
                        <div class="modal-footer">
                        <a title="Close" data-dismiss="modal" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                        <button title="Save" type="Submit" onclick="return confirm('Do you want to Save');" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                        
                    </div>
               </form>
                    </div><!--End of Modal Body -->   
                    
               </div>
               </div>
            </div><!--   End of model -->
        
        <div class="panel-body">              
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">                                                
                <thead>
                <tr class="info">                                      
                    <td class="text-center"><strong>Action</strong></td>
                    <td class="text-center"><strong>PAYMENT ENTRY</strong></td>
                    <td class="text-center"><strong>POSTED</strong></td>
                    <td class="text-center"><strong>Date</strong></td>     
                    <td class="text-center"><strong>#</strong></td>                                        
                    <td class="text-center"><strong># Supplier Name</strong></td> 
                    <td class="text-center"><strong>Status</strong></td>                                         
                </tr> 
                </thead>
                <tbody>
                <?php for($i=0; $i<count($ap); $i++) { ?>   
                <?php if($ap[$i]->posted == 'POSTED'){?> 
                <tr class="success">
                <?php }else { ?>
                <tr>
                <?php }?>
                    <?php if($ap[$i]->filestat == 'OPEN'){?>
                    <td title="Cannot Edit" class="text-center">OPEN
                    <?php if($users[0]->position == "Administrator") { ?>
                    <a title="close" href="/mtpf/accountpayable_con/closeap/<?php echo $ap[$i]->ap_no;?>" class="btn btn-info">Close</a>
                    <?php }?>
                    </td>
                    <?php }else if($ap[$i]->posted == 'POSTED'){?>     
                    <td class="text-center ">
                        <a type="button" title="View" href="/mtpf/accountpayable_con/viewdoc/<?php echo $ap[$i]->ap_no;?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>
                        <a type="button" title="Print" href="/mtpf/accountpayable_con/printdoc/<?php echo $ap[$i]->ap_no;?>" onclick="return confirm('Do you want to Print this Document');" class="glyphicon glyphicon-print btn btn-default"></a>
                    </td>
                    <?php } else{?>
                    <td class="text-center ">
                        <a title="Edit" href="/mtpf/accountpayable_con/edit_ap/<?php echo $ap[$i]->ap_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                        <a type="button" title="Delete" href="/mtpf/accountpayable_con/delap/<?php echo $ap[$i]->ap_no;?>" onclick="return confirm('Do you want to delete this Document?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                        <?php if($ap[$i]->posted == 'POSTED' ){ ?>                         
                        <a type="button" title="Print" href="/mtpf/accountpayable_con/printdoc/<?php echo $ap[$i]->ap_no;?>" onclick="return confirm('Do you want to Print this Document');" class="glyphicon glyphicon-print btn btn-default"></a>
                        <?php }else if( $ap[$i]->s_no == null || $ap[$i]->grandtotal == null || $ap[$i]->grandtotal == ""){ ?>
                        <?php }else {?>                        
                        <a type="button" title="Post Document" href="/mtpf/accountpayable_con/postap/<?php echo $ap[$i]->ap_no;?>" onclick="return confirm('Do you want to POST this Document?');" class="btn btn-success">POST</a>
                        <?php }?>
                    </td>
                    <?php }?>
                    <td class="text-center" style="text-transform: capitalize">
                        <?php if($ap[$i]->posted == 'POSTED'){ ?>
                        <a title="View Payment" href="/mtpf/accountpayable_con/viewpayment/<?php echo $ap[$i]->ap_no;?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>
                        <?php }else if($ap[$i]->s_no == null || $ap[$i]->grandtotal == null || $ap[$i]->grandtotal == "") {}else {?>
                        <a title="View Payment" href="/mtpf/accountpayable_con/viewpayment/<?php echo $ap[$i]->ap_no;?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>
                        <button  data-toggle="modal" 
                            data-target="#myModal"
                            data-backdrop="static" 
                            data-ap="<?php echo $ap[$i]->ap_no;?>"
                            data-keyboard="false" 
                            type="button"  title="ADD Payment" class="btn btn-success glyphicon glyphicon-plus addpayment"></button>                                                    
                        <?php }?>
                    </td>                          
                    <td class="text-center" style="text-transform: capitalize"><?php echo $ap[$i]->posted;?></td>                          
                    <td class="text-center" style="text-transform: capitalize"><?php echo $ap[$i]->date;?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $ap[$i]->ref_no;?></td>  
                    <td class="text-center" style="text-transform: capitalize"><?php if($ap[$i]->s_no == null){}else{for($s=0;$s<count($sup);$s++){if($ap[$i]->s_no == $sup[$s]->s_no){echo $ap[$i]->s_no; echo " "; echo $sup[$s]->name;}}}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php if($ap[$i]->stat == 'NOTYETPAYED'){ echo "";}else{ echo $ap[$i]->stat;}?></td>                    
                </tr>                
                <?php } ?>                         
                </tbody>                                 
            </table>  
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>