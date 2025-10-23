<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Category Update</h3>                
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->                       
        
        <div class="panel-body">  
            
            <form role="form" method="post" action="<?=site_url('category_con/updatecat')?>">
                
                <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required autocomplete="off">
                <input class="form-control input-sm hide" type="text" name="c_no" value="<?php echo $cat[0]->c_no;?>" required autocomplete="off">                                              

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize" class="form-control input-sm" type="text" name="description" value="<?php echo $cat[0]->description;?>" required autocomplete="off">
                    </div>
                </div>
                
                <div class="modal-footer">
                  <a title="Close" href="/mtpf/category_con/categoryview" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                  <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                  <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                </div>              
            
            </form>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->