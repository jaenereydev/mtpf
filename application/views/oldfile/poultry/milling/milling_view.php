<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-tint" ></span> Milling
            </h3>        
        <div class="pull-right">
            <a type="button" href="<?=site_url('milling_con/insertview')?>" class="btn btn-info" >New</a> 
        </div>
        </div> <!-- end of panel heading -->               
        
        <div class="panel-body">  
            
            <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable">                                                
                <thead>
                    <tr class="info">  
                        <td class="text-center" ><strong>Action</strong></td>
                        <td class="text-center"><strong>Date</strong></td> 
                        <td class="text-center"><strong>Ref No</strong></td> 
                        <td class="text-center"><strong>Output Product</strong></td> 
                        <td class="text-center"><strong>Posted</strong></td>   
                        <?php if($users[0]->position === 'Administrator') { ?> 
                        <td class="text-center"><strong>USER</strong></td> 
                        <?php }?>
                    </tr> 
                </thead> 
                <tbody>
                <?php for($i=0; $i<count($m); $i++) { ?>  
                    <?php if($m[$i]->posted == "POSTED") {?>
                    <tr class="warning">
                    <?php }else { ?>
                    <tr>   
                    <?php }?>
                    <td class="text-center info">
                        <?php if($m[$i]->filestat == 'OPEN') {?>
                        OPEN
                            <?php if($users[0]->position === 'Administrator') { ?>
                            <a title="Closed" href="/mtpf/milling_con/closedm/<?php echo $m[$i]->m_no; ?>" class="btn btn-info">CLOSED</a>
                            <?php } ?>
                        <?php }else { if($m[$i]->posted == 'POSTED') { ?>
                            <a title="View" href="/mtpf/milling_con/editm/<?php echo $m[$i]->m_no; ?>" class="glyphicon glyphicon-eye-open btn btn-info"></a>
                            <a title="Print" href="/mtpf/milling_con/printm/<?php echo $m[$i]->m_no; ?>" onclick="return confirm('Do you want to Print this Document?');" class="glyphicon glyphicon-print btn btn-default"></a>
                            <?php }else { ?>
                            <a title="Edit" href="/mtpf/milling_con/editm/<?php echo $m[$i]->m_no; ?>" class="glyphicon glyphicon-pencil btn btn-info"></a>
                            <a type="button" title="Delete" href="/mtpf/milling_con/delmilling/<?php echo $m[$i]->m_no; ?>" onclick="return confirm('Do you want to delete this Milling?');" class="glyphicon glyphicon-trash btn btn-danger"></a>
                            <a type="button" title="Post" href="/mtpf/milling_con/postmilling/<?php echo $m[$i]->m_no; ?>" onclick="return confirm('Do you want to Post this Document?');" class="btn btn-success" <?php if($m[$i]->p_no == null || $m[$i]->pcs == null || $m[$i]->pcs == '0.00'){ ?> disabled<?php } ?> >POST</a>
                        <?php } } ?>
                    </td>         
                    <td class="text-center" style="text-transform: capitalize"><?php if($m[$i]->date == null){ }else { echo date_format(date_create($m[$i]->date), 'm/d/Y'); }?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $m[$i]->ref_no; ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php for($k=0; $k<count($prod); $k++){ if( $m[$i]->p_no == $prod[$k]->p_no){ echo $prod[$k]->longdesc; }}?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $m[$i]->posted; ?></td>
                    <?php if($users[0]->position === 'Administrator') { ?> 
                    <td class="text-center" style="text-transform: capitalize"><?php for($o=0; $o<count($u); $o++){if($u[$o]->u_no == $m[$i]->user){ echo $u[$o]->fname;}} ?></td>
                    <?php }?>
                </tr>
                <?php } ?>                         
                </tbody>                                  
            </table>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>