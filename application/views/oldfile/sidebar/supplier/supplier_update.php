<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list-alt" ></span> Supplier Update
            </h3>                
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->              
        
        <div class="panel-body">  
           <form role="form" method="post" action="<?=site_url('supplier_con/updatesupplier')?>">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                    <input class="form-control input-sm hide" type="text" name="s_no" value="<?php echo $sup[0]->s_no;?>" required>
                    <div class="modal-body">
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Supplier Name</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Name" value="<?php echo $sup[0]->name;?>" required autofocus autocomplete="off">
                            </div>                            
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-9">
                                <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="address" placeholder="address" value="<?php echo $sup[0]->address;?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Tel No.</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="telno" placeholder="Telephone Number" value="<?php echo $sup[0]->telno;?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Sales Man</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="salesman" placeholder="Sales Man" value="<?php echo $sup[0]->salesman;?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Contact Number</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="contactno" placeholder="Contact Number" value="<?php echo $sup[0]->contactno;?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Email Address</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="email" name="email" placeholder="Email Address" value="<?php echo $sup[0]->email;?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Terms</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="terms" placeholder="terms" value="<?php echo $sup[0]->terms;?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Discount 1</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="discount1" placeholder="Discount 1" value="<?php echo $sup[0]->discount1;?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Discount 2</label>
                            <div class="col-sm-5">
                                <input class="form-control input-sm" type="number" name="discount2" placeholder="Discount 2" value="<?php echo $sup[0]->discount2;?>" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" href="/mtpf/supplier_con/supplierview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div>
                </form>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->