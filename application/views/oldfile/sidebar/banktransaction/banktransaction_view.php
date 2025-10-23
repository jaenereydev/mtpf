<script type="text/javascript">

window.onload = function()
{       	        
        $(document).ready(function () {
            $('.bt-edit').click(function () {                                
                var btno = $(this).data('btno');
                var typ = $(this).data('typ');    
                var amount = $(this).data('amount');
                var remarks = $(this).data('remarks');
                var date = $(this).data('date');
                var tn = $(this).data('tn');
                $(".modal-body #fbirthday").val( date );                
                $(".modal-body #amount").val( amount );
                $(".modal-body #typ").val( typ );                
                $(".modal-body #remarks").val( remarks );
                $(".modal-body #tn").val( tn );
                $(".modal-body #btno").val( btno );
            });
        });
}
</script>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-piggy-bank" ></span> Bank Transaction
            </h3>        
        <div class="pull-right">
          <?php if($this->session->userdata('ZReading') == true):?>
            <a href="<?php echo site_url('reports_con/sales_and_expense_report') ?>" class="btn btn-primary">Expense And Sales Report</a>
          <?php endif; ?>
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info" data-backdrop="static" data-keyboard="false">New</button> 
        </div>
        </div> <!-- end of panel heading -->        

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" onclick="return confirm('Do you want to cancel');" type="button" data-dismiss="modal" class="close" tabindex="-1">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Bank Transaction</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('banktransaction_con/insertbt')?>">                    
                    <div class="modal-body">     
                        <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                        <div class="form-group row row-offcanvas">   
                            <label class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-5" id="datepicker"> 
                                <div class="input-group">
                                <input class="form-control input-sm" type="text" name="date" id="fbirthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>" requred autocomplete="off">                                    
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                                </div>                    
                            </div>                      
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Transaction No.</label>
                            <div class="col-sm-5">
                                <input  class="form-control input-sm" type="text" name="transno" placeholder="Transaction No"  autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-5">
                                <select  name="typ" class="btn btn-default dropdown-toggle col-sm-9" data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value="Deposit" >Deposit (+)</option> 
                                    <option value="Withdrawal" >Withdrawal (-)</option> 
                                    <option value="Charges" >Charges (-)</option> 
                                    <option value="Interest" >Interest (+)</option> 
                                </select>
                            </div>                            
                        </div>
                                                                                                                               
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-5">
                                <input  class="form-control input-sm" type="number" step="any" name="amount" placeholder="Amount" required autocomplete="off">
                            </div>
                        </div>
                             
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-5">
                                <input  class="form-control input-sm" type="text" name="remarks" placeholder="Remarks" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close"  onclick="return confirm('Do you want to cancel');" type="button" data-dismiss="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->
        
        <!-- Modal -->
        <div id="btmodal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" onclick="return confirm('Do you want to cancel');" type="button" data-dismiss="modal" class="close" tabindex="-1">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Expenses</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('banktransaction_con/updatebt')?>">                                          
                    <div class="modal-body">         
                        <input id="btno" class="form-control input-sm hide" type="text" name="btno">
                        <div class="form-group row row-offcanvas">   
                            <label class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-5" id="datepicker"> 
                                <div class="input-group">
                                <input class="form-control input-sm" type="text" name="date" id="fbirthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>" requred autocomplete="off">                                    
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                                </div>                    
                            </div>                      
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Transaction No.</label>
                            <div class="col-sm-5">
                                <input id="tn" class="form-control input-sm" type="text" name="transno" placeholder="Transaction No"  autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-5">
                                <select id="typ" name="typ" class="btn btn-default dropdown-toggle col-sm-9" data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value="Deposit" >Deposit (+)</option> 
                                    <option value="Withdrawal" >Withdrawal (-)</option> 
                                    <option value="Charges" >Charges (-)</option> 
                                    <option value="Interest" >Interest (+)</option> 
                                </select>
                            </div>                            
                        </div>
                                                                                                                               
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-5">
                                <input id="amount" class="form-control input-sm" type="number" step="any"  name="amount" placeholder="Amount" required autocomplete="off">
                            </div>
                        </div>
                             
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-5">
                                <input id="remarks" class="form-control input-sm" type="text" name="remarks" placeholder="Remarks" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" type="button" data-dismiss="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                     
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->
        
        <div class="panel-body">  
            <div style="height: 400px; overflow: auto; margin: 0 auto;"> 
            <table class="table table-hover table-responsive table-bordered table-striped info" >                                                                
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>   
                        <td class="text-center"><strong>Date</strong></td>
                        <td class="text-center"><strong>Type</strong></td>
                        <td class="text-center"><strong>Amount</strong></td>                         
                        <td class="text-center"><strong>Remarks</strong></td>
                    </tr> 
                    <?php for($i=0; $i<count($bt); $i++) { ?>       
                    <?php if(($users[0]->position == "Administrator") || ($bt[$i]->u_no == $users[0]->u_no)){ ?>
                    <tr> 
                        <td class="text-center info">
                            <?php 
                            $date = date('m/d/Y'); 
                            if(date_format(date_create($bt[$i]->date), 'm/d/Y') == $date) { if($bt[$i]->u_no == $users[0]->u_no || $users[0]->position == "Administrator") {?>
                                <?php if($bt[$i]->posted == "POSTED") {}else {?>
                                <button title="Edit" 
                                        data-btno="<?php echo $bt[$i]->bt_no;?>"
                                        data-typ="<?php echo $bt[$i]->stat;?>"
                                        data-amount="<?php echo $bt[$i]->amount;?>"
                                        data-remarks="<?php echo $bt[$i]->remarks;?>"
                                        data-tn="<?php echo $bt[$i]->trans_no;?>"
                                        data-date="<?php echo date_format(date_create($bt[$i]->date), 'm/d/Y');?>"
                                        data-toggle="modal" data-target="#btmodal" data-backdrop="static" data-keyboard="false"
                                        class="glyphicon glyphicon-pencil btn btn-info bt-edit"></button>
                                <a type="button" title="Delete" href="/mtpf/banktransaction_con/delbt/<?php echo $bt[$i]->bt_no;?>" onclick="return confirm('Do you want to delete this Bank Transaction?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                                <a type="button" title="Post" href="/mtpf/banktransaction_con/postbt/<?php echo $bt[$i]->bt_no;?>/<?php echo $bt[$i]->stat;?>" onclick="return confirm('Do you want to Post this Bank Transaction?');" class=" btn btn-success">POST</a>
                            <?php } } }else { if($users[0]->position == "Administrator") {?>
                                <?php if($bt[$i]->posted == "POSTED") {}else {?>
                                <button title="Edit" 
                                        data-btno="<?php echo $bt[$i]->bt_no;?>"
                                        data-typ="<?php echo $bt[$i]->stat;?>"
                                        data-amount="<?php echo $bt[$i]->amount;?>"
                                        data-tn="<?php echo $bt[$i]->trans_no;?>"
                                        data-remarks="<?php echo $bt[$i]->remarks;?>"
                                        data-date="<?php echo date_format(date_create($bt[$i]->date), 'm/d/Y');?>"
                                        data-toggle="modal" data-target="#btmodal" data-backdrop="static" data-keyboard="false"
                                        class="glyphicon glyphicon-pencil btn btn-info bt-edit"></button>
                                <a type="button" title="Delete" href="/mtpf/banktransaction_con/delbt/<?php echo $bt[$i]->bt_no;?>" onclick="return confirm('Do you want to delete this Bank Transaction?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                                <a type="button" title="Post" href="/mtpf/banktransaction_con/postbt/<?php echo $bt[$i]->bt_no;?>/<?php echo $bt[$i]->stat;?>" onclick="return confirm('Do you want to Post this Bank Transaction?');" class=" btn btn-success">POST</a>
                             <?php }}} ?>
                        </td>                            
                        <td class="text-center" style="text-transform: capitalize"><?php echo $bt[$i]->date;?></td>                           
                        <td class="text-center" style="text-transform: capitalize"><?php echo $bt[$i]->stat;?></td>   
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$bt[$i]->amount,2,'.',',');?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $bt[$i]->remarks;?></td>
                    </tr>
                    <?php }else if($bt[$i]->user != $users[0]->u_no){}} ?>                                                                          
            </table>
            </div>
            <form role="form" method="post" action="<?=site_url('banktransaction_con/searchbt')?>">
                <div class="form-group row row-offcanvas" style="margin-top: 10px;">
                    <label class="col-sm-1 control-label">Search</label>                    
                    <div class="col-sm-5">
                        <input style="margin-top: 3px;" class="form-control input-sm" type="text" name="search" placeholder="Type, Date, Amount" autofocus autocomplete="off">                                                
                    </div>
                    <button type="submit" class="glyphicon glyphicon-search btn btn-default"></button>
                </div>
            </form>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->