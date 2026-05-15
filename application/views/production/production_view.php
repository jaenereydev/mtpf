<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-2" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Building Count
            </h3>  
        </div> <!-- end of panel heading -->     
        
        <div class="panel-body">  
        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<div class="col-md-2" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Production of the Day
            </h3>  
        </div> <!-- end of panel heading -->     
        
        <div class="panel-body">  
        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div class="col-md-2" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Production for this Week
            </h3>  
        </div> <!-- end of panel heading -->     
        
        <div class="panel-body">  
        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div class="col-md-4" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Production for this Month
            </h3>  
        </div> <!-- end of panel heading -->     
        
        <div class="panel-body">  
        
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Production List
            </h3>     
            
            <div class="pull-right">

            <button type="button" data-toggle="modal" data-target="#production" class="btn btn-info " >New</button> 

            <a 
                type="button" 
                class="btn btn-default pull-right " style="margin-left: 5px;" 
                onclick="return confirm('Do you want to create file?');"
                href="<?=site_url('Produciton_con/insertproduction')?>"
                >Building</a>
            </div>
        </div> <!-- end of panel heading -->     
        
        <div class="panel-body">  
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">           
                        
                        <td class="text-center"><strong>Action</strong></td>   
                        <td class="text-center"><strong>Date</strong></td>                           
                        <td class="text-center"><strong>User</strong></td>   
                        <td class="text-center"><strong>Posted</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($production as $key => $item): ?>                      
                    <tr> 
                        <td class="text-center">     

                            <a <?php if($item->post == 'YES') { ?>
                                    title="View" 
                                <?php }else { ?>  
                                    title="Edit"
                                <?php } ?> 
                                href="<?=site_url('production_con/productioninfo/'.$item->production_number)?>" 
                                <?php if($item->post == 'YES') { ?>
                                    class="glyphicon glyphicon-eye-open btn btn-info">
                                <?php }else { ?>  
                                    class="glyphicon glyphicon-pencil btn btn-info">
                                <?php }?>
                                
                            </a>

                            <?php if($item->post == 'YES') {}else{ ?>
                                <a 
                                    type="button" 
                                    title="Delete" 
                                    href="<?=site_url('production_con/deleteproduction/'. $item->production_number)?>" 
                                    onclick="return confirm('Do you want to delete this File?');" 
                                    class="glyphicon glyphicon-trash btn btn-danger">
                                </a> 
                            <?php } ?>  

                            <a  title="Post"
                                href="<?=site_url('production_con/postproduction/'.$item->production_number)?>" 
                                onclick="return confirm('Do you want to Post this file? This will update the Product Qty');"
                                class="btn btn-success">POST
                            </a>

                        </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name; ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->post ?></td>
                        
                    </tr>
                    <?php endforeach;  ?>     
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<!--Product insert Modal -->
<div id="production" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Production</h4>
        </div>
        <form role="form" method="post" action="<?=site_url('product_con/insertproduct')?>">                    
            <div class="modal-body">   

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-4 control-label">Date</label>
                    <div class="col-sm-8">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" id="from" name="date" placeholder="Date"  required autocomplete="off">
                    </div>                            
                </div>  

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-4 control-label">Building Number</label>
                    <div class="col-sm-8">
                        <select name="bno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" style="width: 100% !important;" aria-expanded="true" required>                             
                            <!-- <option value=""> --Please Select--</option>
                            <?php for($s=0;$s<count($sup);$s++) { ?>
                            <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                            <?php } ?> -->
                        </select>  
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-4 control-label">Quantity</label>
                    <div class="col-sm-8">
                        <input class="form-control input-sm" type="number" step="any" min="1"  name="quantity" placeholder="Quantity"  required  autocomplete="off">
                    </div>                            
                </div>  

            </div>
            
            <div class="modal-footer">
                <a title="Close"  type="button" data-dismiss="modal" data-toggle="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" > CANCEL</a>
                <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" name="savebtn" > SAVE</button>
            </div>
        </form>
    </div>
    </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">


function processform(formObj) {            
        formObj.savebtn.disabled = true;  
        formObj.savebtn.value = 'Please Wait...';  
        return true;    
    }  


</script>