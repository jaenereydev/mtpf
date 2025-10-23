<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> User List
            </h3>        
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" data-backdrop="static" data-keyboard="false">New</button>        
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->        

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" href="/mtpf/user_con/userview" onclick="return confirm('Do you want to cancel');" type="button" class="close" data-modal="dismiss">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert User</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('user_con/insertuser')?>">
                    <div class="modal-body">
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-3" style="padding-right: 1px;">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="lastname" placeholder="Last Name"  required autofocus autocomplete="off">
                            </div>
                            <div class="col-sm-3" style="padding-right: 1px; padding-left: 1px;">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="firstname" placeholder="First Name" requred autocomplete="off">
                            </div>
                            <div class="col-sm-3" style="padding-right: 1px;padding-left: 1px;">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="middlename" placeholder="Middle Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="text" name="username" placeholder="Username"  required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="text" name="password" placeholder="Password"  required autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Access Code</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="text" name="accesscode" placeholder="Access Code"  required autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Position</label>
                            <div class="col-sm-5">
                                <select name="position" class="btn btn-default dropdown-toggle col-sm-9" data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value="Administrator" >Administrator</option> 
                                    <option value="Cashier" >Cashier</option> 
                                    <option value="Inventory Custodian" >Inventory Custodian</option>
                                    <option value="Milling Personnel" >Milling Personnel</option>
                                    <option value="Supervisor" >Supervisor</option>
                                    <option value="Accouting Personel" >Accounting Personnel</option>
                                    <option value="Account Receivable Personnel" >Accounts Receivable Personnel</option>
                                    <option value="Account Payable Personnel" >Accounts Payable Personnel</option>
                                    <option value="Farm Manager" >Farm Manager</option>
                                </select>  
                            </div>
                        </div>
                        
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-12 control-label label-info">PERMISSION</label>
                        </div>                                                
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">P.O.S</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="pos" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pos" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Credit Sales</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="credit" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="credit" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Expenses</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="expenses" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="expenses" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>                                                
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Supplier</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="supplier" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="supplier" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Product</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="product" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="product" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Dashboard</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="dashboard" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="dashboard" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Customer</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="customer" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="customer" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Receiving</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="receiving" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="receiving" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Ordering</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="ordering" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="ordering" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Inventory</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="inventory" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inventory" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                       
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Maintenance</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="maintenance" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="maintenance" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">User</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="user" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="user" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Account Receivable</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="accountreceivable" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="accountreceivable" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Account Payable</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="accountpayable" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="accountpayable" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Accounting</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="accounting" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="accounting" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Reports</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="report" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="report" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Poultry</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="poultry" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="poultry" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Bank Transaction</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="bt" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="bt" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Bank </label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="bank" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="bank" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Loan Transaction</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="loan" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="loan" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Store Processing</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="sp" value="ENABLED" required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sp" value="DISABLED" required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" href="/mtpf/user_con/userview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->
        
        <div class="panel-body">  
           <table class="table table-hover table-responsive table-bordered table-striped info" id="ThirdTable">                                                
               <thead>
                    <tr class="info">
                        <td class="text-center" ><strong>Action</strong></td>
                        <?php if($users[0]->status === 'default'){?>
                        <td class="text-center"><strong>#</strong></td> 
                        <?php }?>
                        <td class="text-center"><strong>Name</strong></td>
                        <td class="text-center"><strong>Position</strong></td>                        
                    </tr> 
                    </thead>
                    <tbody>
                    <?php for($i=0; $i<count($user); $i++) { ?>                    
                    <tr>   
                        <td class="text-center info">
                            <a title="Edit" href="/mtpf/user_con/userinfo/<?php echo $user[$i]->u_no;?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <a type="button" title="Delete" href="/mtpf/user_con/deluser/<?php echo $user[$i]->u_no;?>" onclick="return confirm('Do you want to delete the User?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                        </td>
                        <?php if($users[0]->status === 'default'){?>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $user[$i]->u_no;?></td>
                        <?php }?>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $user[$i]->fname; echo ' '; echo $user[$i]->lname;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $user[$i]->position;?></td>                        
                    </tr>
                    <?php } ?>                         
                    </tbody>                      
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>