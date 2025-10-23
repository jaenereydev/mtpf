<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-baby-formula" ></span> Formulation List
            </h3>        
        <div class="pull-right">
            <a type="button" href="<?=site_url('formulation_con/insertview')?>" class="btn btn-info" >New</a> 
        </div>
        </div> <!-- end of panel heading -->               
        
        <div class="panel-body">  
            
            <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable">                                                
                <thead>
                    <tr class="info">  
                        <td class="text-center" ><strong>Action</strong></td>
                        <td class="text-center"><strong>Name</strong></td> 
                        <td class="text-center"><strong>Output</strong></td>                      
                    </tr> 
                </thead>
                <tbody>
                <?php for($i=0; $i<count($f); $i++) { ?>                    
                <tr>   
                    <td class="text-center info">
                        <a title="Edit" href="/mtpf/formulation_con/editf/<?php echo $f[$i]->f_no; ?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                        <a type="button" title="Delete" href="/mtpf/formulation_con/delformulation/<?php echo $f[$i]->f_no; ?>" onclick="return confirm('Do you want to delete this Formulation?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                    </td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $f[$i]->name; ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php for($k=0; $k<count($prod); $k++){ if( $f[$i]->output == $prod[$k]->p_no){ echo $prod[$k]->longdesc; }}?></td>
                </tr>
                <?php } ?>                         
                </tbody>                                 
            </table>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>