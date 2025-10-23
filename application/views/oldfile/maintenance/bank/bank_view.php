<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">Bank Information</h3>                
        <div class="clearfix"></div>
        </div> <!-- end of panel heading -->              
        
        <div class="panel-body">                
            <form method="post" role="form" action="<?=site_url('bank_con/insertbank')?>" >
                <div class="form-group row row-offcanvas">
                    <label class="control-label col-sm-2">Bank Name</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Bank Name" required autofocus autocomplete="off">                            
                    </div>
                </div>                                   

                <div class="form-group row row-offcanvas">
                    <label class="control-label col-sm-2">Address</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="address" placeholder="Address"  required autocomplete="off">                            
                    </div>
                </div>                                   

                <div class="form-group row row-offcanvas">
                    <label class="control-label col-sm-2">Current Balance</label>
                    <div class="col-sm-5">                          
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="number" name="bal" placeholder="Amount" required autocomplete="off">                                                      
                    </div>
                    <div class="col-sm-2">                     
                        <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                
                    </div>                
                </div>
            </form>           
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>