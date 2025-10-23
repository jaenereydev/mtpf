<script type="text/javascript">

window.onload = function()
{       	        
    $(document).ready(function () {
        $('.loan-edit').click(function () {                                
            var lno = $(this).data('lno');                                               
            var desc = $(this).data('desc');
            var doc = $(this).data('doc');
            var name = $(this).data('name');
            var amount = $(this).data('amount');
            var remarks = $(this).data('remarks');
            var date = $(this).data('date');
            $(".modal-body #lno").val( lno );                              
            $(".modal-body #desc").val( desc );
            $(".modal-body #doc").val( doc );
            $(".modal-body #searchCustomer").val( name );
            $(".modal-body #amount").val( amount );
            $(".modal-body #remarks").val( remarks );
            $(".modal-body #mbirthday").val( date );
        });
    });
    
    $(document).ready(function () {
        $('.view-edit').click(function () {                                
            var lno = $(this).data('lno');                                               
            var desc = $(this).data('desc');
            var doc = $(this).data('doc');
            var name = $(this).data('name');
            var amount = $(this).data('amount');
            var remarks = $(this).data('remarks');
            var date = $(this).data('date');
            $(".modal-body #lno2").val( lno );                              
            $(".modal-body #desc2").val( desc );
            $(".modal-body #doc2").val( doc );
            $(".modal-body #c").val( name );
            $(".modal-body #amount2").val( amount );
            $(".modal-body #remarks2").val( remarks );
            $(".modal-body #date").val( date );
        });
    });
}
</script>
<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.min.css') ?>">

<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-list" ></span> Loan Transaction
            </h3>        
            <div class="pull-right">              
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info" data-backdrop="static" data-keyboard="false">New</button> 
            </div>
        </div> <!-- end of panel heading -->        

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" onclick="return confirm('Do you want to cancel');" type="button" data-dismiss="modal" class="close" tabindex="-1">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Loan</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('loan_con/insertloan')?>">
                    <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                    <div class="modal-body">                             
                        <div class="form-group row row-offcanvas">   
                            <label class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-5" id="datepicker"> 
                                <div class="input-group">
                                <input class="form-control input-sm" type="text" name="date" id="fbirthday" placeholder="click to show datepicker" value="<?php echo date('m/d/Y');?>" requred autocomplete="off">                                    
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                                </div>                    
                            </div>                      
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Customer</label>                            
                            <div class="col-sm-5">
                            <select name="c_no" id="searchCustomer" class="form-control toggler" id="selectisize" placeholder="Select a person..."  >
                                    <option val="">Select a person...</option>
                                    <?php foreach ($c as $value) : ?>
                                            <option value="<?php echo $value->c_no ?>"><?php echo ucwords($value->name); ?></option>
                                    <?php endforeach?>
                                    <option></option>
                            </select> 
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Doc. No.</label>
                            <div class="col-sm-5">
                                <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="doc_no" placeholder="Document Number" required autocomplete="off">
                            </div>                            
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <input style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="description" placeholder="Description" required autocomplete="off">
                            </div>                            
                        </div>                                                                               
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-5">
                                <input  class="form-control input-sm" type="number" name="amount" step="any" placeholder="Amount" required autocomplete="off">
                            </div>
                        </div>
                             
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-5">
                                <input  class="form-control input-sm" type="text" name="remarks" placeholder="Remarks" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close"  onclick="return confirm('Do you want to cancel');" type="button" data-dismiss="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                      <button title="Reset" type="Reset" class="btn btn-warning" >Reset</button>
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->
        
        <!-- Modal -->
        <div id="expmodal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close" onclick="return confirm('Do you want to cancel');" type="button" data-dismiss="modal" class="close" tabindex="-1">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Loan</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('loan_con/updateloan')?>">                                        
                    <div class="modal-body">                             
                        <input id="lno" class="form-control input-sm hide" type="number" name="l_no" required autocomplete="off">
                        <input class="form-control input-sm hide" type="text" name="u_no" value="<?php echo $users[0]->u_no;?>" required>
                        <div class="form-group row row-offcanvas">   
                            <label class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-5" id="datepicker"> 
                                <div class="input-group">
                                <input  class="form-control input-sm" type="text" name="date" id="mbirthday" placeholder="click to show datepicker"  requred autocomplete="off">                                    
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                    
                                </div>                    
                            </div>                      
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Customer</label>                            
                            <div class="col-sm-5">
                            <select name="c_no" id="searchCustomer" class="form-control toggler" id="selectisize" placeholder="Select a person..."  >
                                    <option val="">Select a person...</option>
                                    <?php foreach ($c as $value) : ?>
                                            <option value="<?php echo $value->c_no ?>"><?php echo ucwords($value->name); ?></option>
                                    <?php endforeach?>
                                    <option></option>
                            </select>  
                            </div>
                        </div>    
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Doc. No.</label>
                            <div class="col-sm-5">
                                <input id="doc" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="doc_no" placeholder="Document Number" required autocomplete="off">
                            </div>                            
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <input id="desc" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="description" placeholder="Particulars" required autocomplete="off">
                            </div>                            
                        </div>                                                                               
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-5">
                                <input id="amount" class="form-control input-sm" type="number" step="any" name="amount" placeholder="Amount" required autocomplete="off">
                            </div>
                        </div>
                             
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-5">
                                <input id="remarks"class="form-control input-sm" type="text" name="remarks" placeholder="Remarks" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                      <a title="Close" type="button" data-dismiss="modal" onclick="return confirm('Do you want to cancel');" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
                      <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>                     
                    </div>
                </form>
            </div>
          </div>
        </div> <!-- End of model -->
        
        <!-- Modal -->
        <div id="viewmodal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">                    
                    <a title="Close"  type="button" data-dismiss="modal" class="close" tabindex="-1">&times;</a>                    
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>View Loan</h4>
                </div>                                                    
                <div class="modal-body">                                                 
                    <div class="form-group row row-offcanvas">   
                        <label class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-5" > 
                            <input id="date" style="text-transform: capitalize;"  class="form-control input-sm"  disabled >                      
                        </div>                      
                    </div>

                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Customer</label>                            
                        <div class="col-sm-5">
                            <input id="c" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="doc_no" disabled>  
                        </div>
                    </div>    

                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Doc. No.</label>
                        <div class="col-sm-5">
                            <input id="doc2" style="text-transform: capitalize;"  class="form-control input-sm" type="text" name="doc_no" disabled >
                        </div>                            
                    </div>

                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input id="desc2" style="text-transform: capitalize;"  class="form-control input-sm" disabled>
                        </div>                            
                    </div>                                                                               

                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Amount</label>
                        <div class="col-sm-5">
                            <input id="amount2" class="form-control input-sm" disabled>
                        </div>
                    </div>

                    <div class="form-group row row-offcanvas">
                        <label class="col-sm-3 control-label">Remarks</label>
                        <div class="col-sm-5">
                            <input id="remarks2"class="form-control input-sm" disabled>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                  <a title="Close" type="button" data-dismiss="modal"  class="btn btn-danger glyphicon glyphicon-eye-close" ></a>                      
                </div>
                
            </div>
          </div>
        </div> <!-- End of model -->
        
        <div class="panel-body">  
            
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">   
                <thead>
                    <tr class="info">                                             
                        <td class="text-center"><strong>Action</strong></td>                                  
                        <td class="text-center"><strong>Date</strong></td> 
                        <td class="text-center"><strong>Doc. No.</strong></td> 
                        <td class="text-center"><strong># Customer Name</strong></td> 
                        <td class="text-center"><strong>Description</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td>
                        <td class="text-center"><strong>Remarks</strong></td>
                    </tr> 
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($l); $i++) { ?>                          
                    <tr> 
                        <td class="text-center info">        
                            <?php if($l[$i]->posted == 'POSTED'){ ?>
                            <button title="Edit" 
                                    data-lno = "<?php echo $l[$i]->l_no;?>"                                    
                                    data-desc = "<?php echo $l[$i]->description;?>"
                                    data-name = "<?php echo $l[$i]->name;?>"
                                    data-amount="<?php echo number_format((float)$l[$i]->amount,2,'.',',');?>"
                                    data-remarks="<?php echo $l[$i]->remarks;?>"
                                    data-doc="<?php echo $l[$i]->doc_no;?>"
                                    data-date="<?php echo date_format(date_create($l[$i]->date), 'm/d/Y');?>"
                                    data-toggle="modal" data-target="#viewmodal" data-backdrop="static" data-keyboard="false"
                                    class="glyphicon glyphicon-eye-open btn btn-default view-edit"></button>     
                            <?php  }else { ?>
                            <button title="Edit" 
                                    data-lno = "<?php echo $l[$i]->l_no;?>"                                    
                                    data-desc = "<?php echo $l[$i]->description;?>"
                                    data-name = "<?php echo $l[$i]->c_no;?>"
                                    data-amount="<?php echo $l[$i]->amount;?>"
                                    data-remarks="<?php echo $l[$i]->remarks;?>"
                                    data-doc="<?php echo $l[$i]->doc_no;?>"
                                    data-date="<?php echo date_format(date_create($l[$i]->date), 'm/d/Y');?>"
                                    data-toggle="modal" data-target="#expmodal" data-backdrop="static" data-keyboard="false"
                                    class="glyphicon glyphicon-pencil btn btn-info loan-edit"></button>
                            <a type="button" title="Delete" href="/mtpf/loan_con/delloan/<?php echo $l[$i]->l_no;?>" onclick="return confirm('Do you want to delete this Loan?');" class="glyphicon glyphicon-trash btn btn-danger"></a>                            
                            <a type="button" title="Post" href="/mtpf/loan_con/postloan/<?php echo $l[$i]->l_no;?>/<?php echo $l[$i]->c_no;?>" onclick="return confirm('Do you want to Post this Loan?');" class="btn btn-success">POST</a>
                            <?php }?>
                        </td>                                             
                        <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($l[$i]->date), 'm/d/Y');?></td>   
                        <td class="text-center" style="text-transform: capitalize"><?php echo $l[$i]->doc_no;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $l[$i]->c_no; echo " ";echo $l[$i]->name;?></td>   
                        <td class="text-center" style="text-transform: capitalize"><?php echo $l[$i]->description;?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$l[$i]->amount,2,'.',',');?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $l[$i]->remarks;?></td>
                    </tr>
                    <?php } ?>    
                </tbody>
            </table>            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script src="<?php echo base_url('public/js/moment.js')?>"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/selectize.min.js"></script>
<script src="<?php echo base_url('public/js/bootstrap-datetimepicker.min.js')?>"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/sales.js"></script>


<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>