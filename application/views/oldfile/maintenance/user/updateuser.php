<div class="col-md-10 main" >    
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Update User
            </h3>                   
        </div> <!-- end of panel heading -->               
        
        <div class="panel-body">  
            <form role="form" method="post" action="<?=site_url('user_con/updateuser')?>">  
<!--                <div class="modal-footer">
                  <a title="Close" href="/mtpf/user_con/userview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                  <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                  
                </div>-->
                <hr>
                <?php if($users[0]->status === 'default') {?>
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">User No.</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="text" name="u_no" value="<?php echo $user[0]->u_no;?>" required autocomplete="off" disabled>
                    </div>
                </div>
                <?php }else {?>
                    <input class="hide" type="text" name="u_no" value="<?php echo $user[0]->u_no;?>" required autocomplete="off">
                <?php }?>
                    <input class="hide" type="text" name="uno" value="<?php echo $user[0]->u_no;?>" required autocomplete="off">
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-3" style="padding-right: 1px;">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="lastname" placeholder="Last Name" value="<?php echo $user[0]->lname;?>" required autofocus autocomplete="off">
                    </div>
                    <div class="col-sm-3" style="padding-right: 1px; padding-left: 1px;">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="firstname" placeholder="First Name" value="<?php echo $user[0]->fname;?>" requred autocomplete="off">
                    </div>
                    <div class="col-sm-3" style="padding-right: 1px;padding-left: 1px;">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="middlename" placeholder="Middle Name" value="<?php echo $user[0]->mname;?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="text" name="username" placeholder="Username" value="<?php echo $user[0]->username;?>" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="text" name="password" placeholder="Password" value="<?php echo $user[0]->password;?>" required autocomplete="off">
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">Access Code</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="text" name="accesscode" placeholder="Access Code" value="<?php echo $user[0]->accesscode;?>"  required autocomplete="off">
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">Position</label>
                    <div class="col-sm-5">
                        <select name="position" class="btn btn-default dropdown-toggle col-sm-9" data-toggle="dropdown" aria-expanded="true" required>                             
                            <option value="Administrator" <?php if($user[0]->position == 'Administrator'){echo 'selected';}?>>Administrator</option> 
                            <option value="Cashier" <?php if($user[0]->position == 'Cashier'){echo 'selected';}?>>Cashier</option> 
                            <option value="Inventory Custodian" <?php if($user[0]->position == 'Inventory Custodian'){echo 'selected';}?>>Inventory Custodian</option>
                            <option value="Milling Personnel" <?php if($user[0]->position == 'Milling Personnel'){echo 'selected';}?>>Milling Personnel</option>
                            <option value="Supervisor" <?php if($user[0]->position == 'Supervisor'){echo 'selected';}?>>Supervisor</option>
                            <option value="Accouting Personel" <?php if($user[0]->position == 'Accounting Personnel'){echo 'selected';}?>>Accounting Personnel</option>
                            <option value="Account Receivable Personnel" <?php if($user[0]->position == 'Account Receivable Personnel'){echo 'selected';}?>>Accounts Receivable Personnel</option>
                            <option value="Account Payable Personnel" <?php if($user[0]->position == 'Account Payable Personnel'){echo 'selected';}?>>Accounts Payable Personnel</option>
                            <option value="Farm Manager" <?php if($user[0]->position == 'Farm Manager'){echo 'selected';}?>>Farm Manager</option>
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
                            <input type="radio" name="pos" value="ENABLED" <?php if($user[0]->pos == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="pos" value="DISABLED" <?php if($user[0]->pos == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Credit Sales</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="credit" value="ENABLED" <?php if($user[0]->credit == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="credit" value="DISABLED" <?php if($user[0]->credit == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">EXPENSES</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="expenses" value="ENABLED" <?php if($user[0]->expenses == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="expenses" value="DISABLED" <?php if($user[0]->expenses == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>                                                

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Supplier</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="supplier" value="ENABLED" <?php if($user[0]->supplier == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="supplier" value="DISABLED" <?php if($user[0]->supplier == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>    
                    
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Product</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="product" value="ENABLED" <?php if($user[0]->product == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="product" value="DISABLED" <?php if($user[0]->product == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Dashboard</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="dashboard" value="ENABLED" <?php if($user[0]->dashboard == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="dashboard" value="DISABLED" <?php if($user[0]->dashboard == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Customer</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="customer" value="ENABLED" <?php if($user[0]->customer == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="customer" value="DISABLED" <?php if($user[0]->customer == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Receiving</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="receiving" value="ENABLED" <?php if($user[0]->receiving == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="receiving" value="DISABLED" <?php if($user[0]->receiving == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Ordering</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="ordering" value="ENABLED"  <?php if($user[0]->ordering == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="ordering" value="DISABLED" <?php if($user[0]->ordering == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Inventory</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="inventory" value="ENABLED" <?php if($user[0]->inventory == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="inventory" value="DISABLED" <?php if($user[0]->inventory == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>


                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Maintenance</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="maintenance" value="ENABLED" <?php if($user[0]->maintenance == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="maintenance" value="DISABLED" <?php if($user[0]->maintenance == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">User</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="user" value="ENABLED" <?php if($user[0]->user == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="user" value="DISABLED" <?php if($user[0]->user == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Account Receivable</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="accountreceivable" value="ENABLED" <?php if($user[0]->accountreceivable == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="accountreceivable" value="DISABLED" <?php if($user[0]->accountreceivable == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Account Payable</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="accountpayable" value="ENABLED" <?php if($user[0]->accountpayable == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="accountpayable" value="DISABLED" <?php if($user[0]->accountpayable == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Accounting</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="accounting" value="ENABLED" <?php if($user[0]->accounting == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="accounting" value="DISABLED" <?php if($user[0]->accounting == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Reports</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="report" value="ENABLED" <?php if($user[0]->report == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="report" value="DISABLED" <?php if($user[0]->report == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>
                    
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Poultry</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="poultry" value="ENABLED" <?php if($user[0]->poultry == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="poultry" value="DISABLED" <?php if($user[0]->poultry == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Bank Transaction</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" name="bt" value="ENABLED" <?php if($user[0]->banktransaction == 'ENABLED'){echo 'checked';}?> required>ENABLED
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="bt" value="DISABLED" <?php if($user[0]->banktransaction == 'DISABLED'){echo 'checked';}?> required>DISABLED
                        </label>
                    </div>
                </div>
                    
                <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Bank </label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="bank" value="ENABLED" <?php if($user[0]->bank == 'ENABLED'){echo 'checked';}?> required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="bank" value="DISABLED"  <?php if($user[0]->bank == 'DISABLED'){echo 'checked';}?> required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Loan Transaction</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="loan" value="ENABLED" <?php if($user[0]->loan == 'ENABLED'){echo 'checked';}?> required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="loan" value="DISABLED" <?php if($user[0]->loan == 'DISABLED'){echo 'checked';}?> required>DISABLED
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Store Processing</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="sp" value="ENABLED"  <?php if($user[0]->processing == 'ENABLED'){echo 'checked';}?> required>ENABLED
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sp" value="DISABLED" <?php if($user[0]->processing == 'DISABLED'){echo 'checked';}?> required>DISABLED
                                </label>
                            </div>
                        </div>

                <div class="modal-footer">
                  <a title="Close" href="/mtpf/user_con/userview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                  <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                  
                </div>
            </form>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->