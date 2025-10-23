<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-barcode" ></span> Product List / Supplier
            </h3>        
        <div class="panel-toolbar text-right">  
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info " >New</button> 
            <a href="<?php echo site_url('category_con') ?>" type="button" class="btn btn-warning " >Category</a>            
        </div>
        </div> <!-- end of panel heading -->        
        
        
        <div class="panel-body" >  
            <table class="table table-hover table-responsive table-bordered table-striped info nm" id="MTable" tabindex="-1" role="dialog"> 
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>
                        <td class="text-center"><strong>#</strong></td>                         
                        <td class="text-center"><strong>Name</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($sup as $key => $item): ?>                     
                    <tr> 
                        <td class="text-center">
                           <button title="Edit" 
                                data-sno="<?php echo $item->s_no;?>"
                                data-name="<?php echo $item->name;?>"
                                data-address="<?php echo $item->address;?>"
                                data-salesman="<?php echo $item->salesman;?>"
                                data-terms="<?php echo $item->terms;?>"
                                data-toggle="modal" data-target="#sup-edit" 
                                class="glyphicon glyphicon-pencil btn btn-info sup-edit"></button>

                           <a type="button" title="Delete" href="<?=site_url('supplier_con/delsupplier/'.$item->s_no)?>" onclick="return confirm('Do you want to delete this Supplier?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                           
                          
                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->s_no?></td>                        
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name;?></td>  
                    </tr>
                    <?php endforeach;  ?>   
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
        
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog"  >
  <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
             <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>           
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Supplier</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('supplier_con/insertsupplier')?>">                    
            <div class="modal-body">   
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Supplier Name"  required autocomplete="off">
                    </div>                            
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="address" placeholder="Address"  autocomplete="off">
                    </div>                            
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Salesman</label>
                    <div class="col-sm-5">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="salesman" placeholder="Salesman" autocomplete="off">
                    </div>                            
                </div>                                                                            
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Terms</label>
                    <div class="col-sm-5">
                        <input class="form-control input-sm" type="number" name="terms" placeholder="Terms" autocomplete="off">
                    </div>
                </div>                                                                                
                                        
                
            </div>
            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('supplier_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
  </div>
</div> <!-- End of model -->


<!-- Modal -->
<div id="sup-edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
             <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>              
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Supplier</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('supplier_con/updatesupplier')?>">                    
            <div class="modal-body">   
                <input id="sno" type="text" class="hide" name="sno" >
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-5">
                        <input id="name" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Product Name"  required autocomplete="off">
                    </div>                            
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-5">
                        <input id="address" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="address" placeholder="Address"  autocomplete="off">
                    </div>                            
                </div>
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Salesman</label>
                    <div class="col-sm-5">
                        <input id="salesman" style="text-transform: capitalize;" class="form-control input-sm" type="text" name="salesman" placeholder="Salesman" autocomplete="off">
                    </div>                            
                </div>                                                                            
                
                <div class="form-group row row-offcanvas">
                    <label class="col-sm-3 control-label">Terms</label>
                    <div class="col-sm-5">
                        <input id="terms" class="form-control input-sm" type="number" name="terms" placeholder="Terms" autocomplete="off">
                    </div>
                </div>                                                                                
                                        
                
            </div>
            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('supplier_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
            </div>
        </form>
    </div>
  </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">

window.onload = function()
{                       

        $(document).ready(function () {
            $(document).on('click', '.sup-edit', function(event) {
                 var sno = $(this).data('sno');
                var name = $(this).data('name');
                var address = $(this).data('address');
                var salesman = $(this).data('salesman');
                var terms = $(this).data('terms');
                $(".modal-body #sno").val( sno );
                $(".modal-body #name").val( name );
                $(".modal-body #address").val( address );
                $(".modal-body #salesman").val( salesman );
                $(".modal-body #terms").val( terms );
            });
        });
    
}
</script>