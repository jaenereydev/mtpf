<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> 
    <div class="modal-content">
      <div class="modal-header">                    
          <!-- <a title="Close" href="/mtpf/customer_con/customerview" onclick="return confirm('Do you want to cancel');" type="button" class="close" >&times;</a> -->
          <button type="button" class="close" title="Close">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Customer</h4>
      </div>
      <!-- <form role="form" method="post" action="<?=site_url('customer_con/insertcustomer')?>"> -->
      <form role="form" method="post" action="" id="addCustomer">
        <div class="modal-body">     
            <legend>Personal Information</legend>
          <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Name</label>
              <div class="col-sm-5">
                  <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Customer Name"  required autofocus autocomplete="off">
              </div>                            
          </div>
            
          <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Address</label>
              <div class="col-sm-9">
                  <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="address" placeholder="Address"  required autocomplete="off">
              </div>                            
          </div>                                                                               
            
          <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Tel No.</label>
              <div class="col-sm-5">
                  <input class="form-control input-sm" type="number" name="telno" placeholder="Telephone Number" autocomplete="off">
              </div>
          </div>
            
          <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Gender</label>
              <div class="col-sm-5">
                  <label class="radio-inline">
                      <input type="radio" name="gender" value="Male" required>Male
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="gender" value="Female" required>Female
                  </label>
              </div>
          </div>                                                
          
          <legend>Credit Information</legend>
          
          <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Credit Limit</label>
              <div class="col-sm-5">
                  <input class="form-control input-sm" type="number" name="creditlimit" placeholder="Credit Limit" step="any" autocomplete="off">
              </div>
          </div>
          
           <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Terms</label>
              <div class="col-sm-5">
                  <input class="form-control input-sm" type="number" name="terms" placeholder="Terms" step="any" autocomplete="off">
              </div>
          </div>
          
          <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Discount %</label>
              <div class="col-sm-5">
                  <input class="form-control input-sm" type="number" name="discount" placeholder="Discount %" step="any" autocomplete="off">
              </div>
          </div>
          <div class="form-group row row-offcanvas">
              <label class="col-sm-3 control-label">Schedule</label>
              <div class="col-sm-5">
                  <select name="sched" class="btn btn-default dropdown-toggle col-sm-9" data-toggle="dropdown" aria-expanded="true">                             
                      <option value=""></option>
                      <option value="Monday" >Monday</option> 
                      <option value="Tuesday" >Tuesday</option> 
                      <option value="Wednesday" >Wednesday</option>
                      <option value="Thursday" >Thursday</option>
                      <option value="Friday" >Friday</option>
                      <option value="Saturday" >Saturday</option>
                      <option value="Sunday" >Sunday</option>
                  </select>  
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <a title="Close" href="/mtpf/customer_con/customerview" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a> -->
          <button type="button" data-dismiss="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove"></button>
          <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
          <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
        </div>
      </form>
    </div>
  </div>
</div> <!-- End of model -->