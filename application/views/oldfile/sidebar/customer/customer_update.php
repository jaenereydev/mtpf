<script type="text/javascript">

window.onload = function()
{       	        
        $(document).ready(function () {
            $('.exp-edit').click(function () {                                
                var chno = $(this).data('chno');
                var docno = $(this).data('docno');                        
                var desc = $(this).data('desc');
                var ac = $(this).data('ac');
                var as = $(this).data('as');
                var rc = $(this).data('rc');
                var date = $(this).data('date');
                $(".modal-body #chno").val( chno );
                $(".modal-body #docno").val( docno );                                
                $(".modal-body #desc").val( desc );
                $(".modal-body #ac").val( ac );
                $(".modal-body #as").val( as );
                $(".modal-body #rc").val( rc );
                $(".modal-body #mbirthday").val( date );
            });
        });
}
</script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">            
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Customer Update
            </h3>                            
        </div> <!-- end of panel heading -->              
        
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?php if($activeTab == "1") { echo "active";} ?>"><a href="#customerdetails" data-toggle="tab">Customer Details</a></li>
            <li role="presentation" class="<?php if($activeTab == "2") { echo "active";} ?>"><a href="#customerhistory" data-toggle="tab">Customer History</a></li>
        </ul>
        
        <div class="panel-body">  
            
                <div class=" tab-content">
                    
                    <div class="tab-pane <?php if($activeTab == "1") { echo "active";} ?>" id="customerdetails">
                    <form role="form" method="post" action="<?=site_url('customer_con/updatecustomer')?>">
                        <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $cus[0]->u_no;?>" required>
                        <input class="form-control input-sm hide" type="text" name="c_no" value="<?php echo $cus[0]->c_no;?>" required>
                        <div class="modal-body">  
                            
                            <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Customer No.</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm " type="text" value="<?php echo $cus[0]->c_no;?>" disabled>
                            </div>                            
                            </div>
                            <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Customer Name" value="<?php echo $cus[0]->name;?>" required autofocus autocomplete="off">
                            </div>                            
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="address" placeholder="Address" value="<?php echo $cus[0]->address;?>" required autocomplete="off">
                                </div>                            
                            </div>                                                                               

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Tel No.</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="telno" placeholder="Telephone Number" value="<?php echo $cus[0]->telno;?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Gender</label>
                                <div class="col-sm-5">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="Male" <?php if($cus[0]->gender == 'Male'){echo 'checked';}?> required>Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="Female" <?php if($cus[0]->gender == 'Female'){echo 'checked';}?> required>Female
                                    </label>
                                </div>
                            </div>                                                

                            <legend>Credit Information</legend>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Total Credit</label>
                                <div class="col-sm-5">
                                    <p class="form-control input-sm" type="number"  step="any"><?php if($cus[0]->totalcredit == null || $cus[0]->totalcredit == ""){ echo "0.00";}else { echo number_format((float)$cus[0]->totalcredit,2,'.',',');}?></p>
                                </div>
                            </div>
                            
                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Credit Limit</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="creditlimit" placeholder="Credit Limit" step="any" value="<?php echo $cus[0]->creditlimit;?>" autocomplete="off">
                                </div>
                            </div>

                             <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Terms</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="terms" placeholder="Terms" step="any" value="<?php echo $cus[0]->terms;?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Discount %</label>
                                <div class="col-sm-5">
                                    <input class="form-control input-sm" type="number" name="discount" placeholder="Discount %" step="any" value="<?php echo $cus[0]->discount;?>" autocomplete="off">
                                </div>
                            </div>


                            <div class="form-group row row-offcanvas">
                                <label class="col-sm-3 control-label">Schedule</label>
                                <div class="col-sm-5">
                                    <select name="sched" class="btn btn-default dropdown-toggle col-sm-9" data-toggle="dropdown" aria-expanded="true">                             
                                        <option value="" ></option>
                                        <option value="Monday" <?php if($cus[0]->schedule == 'Monday'){echo 'selected';}?> >Monday</option> 
                                        <option value="Tuesday" <?php if($cus[0]->schedule == 'Tuesday'){echo 'selected';}?> >Tuesday</option> 
                                        <option value="Wednesday" <?php if($cus[0]->schedule == 'Wednesday'){echo 'selected';}?> >Wednesday</option>
                                        <option value="Thursday" <?php if($cus[0]->schedule == 'Thursday'){echo 'selected';}?> >Thursday</option>
                                        <option value="Friday" <?php if($cus[0]->schedule == 'Friday'){echo 'selected';}?> >Friday</option>
                                        <option value="Saturday" <?php if($cus[0]->schedule == 'Saturday'){echo 'selected';}?> >Saturday</option>
                                        <option value="Sunday" <?php if($cus[0]->schedule == 'Sunday'){echo 'selected';}?> >Sunday</option>
                                    </select>  
                                </div>
                            </div>
                        </div><!-- end of body -->

                        <div class="modal-footer">
                          <a title="Close" href="/mtpf/customer_con/customerview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                          <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                          <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                        </div>
                    </form>     
                    </div><!-- end of customer details -->                    
                   
                    <div class="tab-pane <?php if($activeTab == "2") { echo "active";} ?>" id="customerhistory">                        
                             
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">      
                            <thead>
                            <tr class="info">
                                <?php if($users[0]->position === 'Administrator') { ?>
                                <td class="text-center"><strong>Action</strong></td>  
                                <?php }?>
                                <td class="text-center"><strong>#</strong></td>       
                                <td class="text-center"><strong>Date</strong></td>       
                                <td class="text-center"><strong>Doc #</strong></td>
                                <td class="text-center"><strong>Description</strong></td>
                                <td class="text-center"><strong>Amount Credit</strong></td>
                                <td class="text-center"><strong>Amount Sales</strong></td>
                                <td class="text-center"><strong>Remaining Balance</strong></td>
                                <td class="text-center"><strong>User</strong></td>
                              </tr> 
                            </thead>
                            <tbody>
                            <?php for($i=0; $i<count($cushist); $i++) { ?>                    
                            <tr>      
                                <?php if($users[0]->position === 'Administrator') { ?>
                                <td class="text-center" style="text-transform: capitalize">
                                    <button title="Edit" 
                                        data-chno="<?php echo $cushist[$i]->ch_no;?>"
                                        data-docno="<?php echo $cushist[$i]->doc_no;?>"                                        
                                        data-desc="<?php echo $cushist[$i]->description;?>"
                                        data-ac="<?php echo $cushist[$i]->amountcredit;?>"
                                        data-as="<?php echo $cushist[$i]->amountsales;?>"
                                        data-rc="<?php echo $cushist[$i]->remainingcredit;?>"
                                        data-date="<?php echo date_format(date_create($cushist[$i]->date), 'm/d/Y');?>"
                                        data-toggle="modal" data-target="#ch" data-backdrop="static" data-keyboard="false"
                                        class="glyphicon glyphicon-pencil btn btn-info exp-edit"></button>
                                </td>
                                <?php }?>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $cushist[$i]->ch_no;?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo $cushist[$i]->date;?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo $cushist[$i]->doc_no;?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $cushist[$i]->description;?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$cushist[$i]->amountcredit,2,'.',',');?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$cushist[$i]->amountsales,2,'.',',');?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$cushist[$i]->remainingcredit,2,'.',',');?></td>                                    
                                <td class="text-center" style="text-transform: capitalize"><?php if($users[0]->u_no == $cushist[$i]->user){ echo $users[0]->fname;}?></td>
                            </tr>
                            <?php } ?>  
                            </tbody>
                        </table>                                             
                    </div><!-- end of Customer history -->  
                    
                </div>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<!-- Modal -->
        <div id="ch" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" onclick="return confirm('Do you want to cancel');" type="button" data-dismiss="modal" class="close" tabindex="-1">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Customer History</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('customer_con/updatech')?>">                                        
                    <div class="modal-body">                             
                        <input id="chno" class="form-control input-sm hide" type="number" name="ch_no" required autocomplete="off">
                        <input class="form-control input-sm hide" type="text" name="c_no" value="<?php echo $cus[0]->c_no;?>" >
                        <div class="form-group row row-offcanvas">   
                            <label class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-5" id="datepicker"> 
                                <div class="input-group">
                                <input  class="form-control input-sm" type="text" name="date" id="mbirthday" placeholder="click to show datepicker"  requred autocomplete="off">                                    
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                                </div>                    
                            </div>                      
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Total Credit</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="totalcredit" placeholder="Total Credit" value="<?php echo number_format((float)$cus[0]->totalcredit,2,'.',',');?>" autocomplete="off">
                            </div>                            
                        </div> 
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Doc. No.</label>
                            <div class="col-sm-5">
                                <input id="docno" style="text-transform: capitalize;" class="form-control input-sm" type="number" name="docno" placeholder="Document No" autocomplete="off">
                            </div>                            
                        </div>                                              
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <input id="desc" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="description" placeholder="Particulars"  autocomplete="off">
                            </div>                            
                        </div>                                                                               
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Amount Credit</label>
                            <div class="col-sm-5">
                                <input id="ac" class="form-control input-sm" type="number" name="ac" placeholder="Amount credit" step="any"  autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Amount Sales</label>
                            <div class="col-sm-5">
                                <input id="as" class="form-control input-sm" type="number" name="as" placeholder="Amount sales" step="any"  autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Remaining balance</label>
                            <div class="col-sm-5">
                                <input id="rc" class="form-control input-sm" type="number" name="rc" placeholder="Remaining Balance" step="any"  autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" type="button" data-dismiss="modal" onclick="return confirm('Do you want to cancel');" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                     
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>  