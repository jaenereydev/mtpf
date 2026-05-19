<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Classify List
            </h3>     
            
            <div class="pull-right">
                <button type="button" data-toggle="modal" data-target="#classifyModal" class="btn btn-info">New</button>
            </div>

            
        </div> <!-- end of panel heading -->     
        
        <div class="panel-body">  
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">           
                        <td class="text-center"><strong>Date</strong></td>   
                        <td class="text-center"><strong>Post</strong></td>                         
                        <td class="text-center"><strong>Total Qty</strong></td>
                        <td class="text-center"><strong>User</strong></td>   
                        <td class="text-center"><strong>Action</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($classify as $key => $item): ?>                      
                        <tr> 

                            <td class="text-center">
                                <?php echo date('Y-m-d', strtotime($item->date)); ?>
                            </td>

                            <td class="text-center">
                                <?php echo $item->post; ?>
                            </td>

                            <td class="text-center">
                                <?php echo number_format($item->total_qty); ?>
                            </td>

                            <td class="text-center" style="text-transform: capitalize">
                                <?php echo $item->name; ?>
                            </td>

                            <td class="text-center">

                                <?php if ($item->post != 'YES'): ?>

                                    <a 
                                        title="Edit"
                                        href="<?= site_url('classify_con/classifyinfo/'. $item->c_no) ?>" 
                                        class="glyphicon glyphicon-pencil btn btn-info btn-sm">
                                    </a>

                                    <a 
                                        title="Post"
                                        href="<?= site_url('classify_con/postclassify/'. $item->c_no) ?>" 
                                        onclick="return confirm('Do you want to POST this classify record? Once posted, it cannot be edited or deleted.');" 
                                        class="glyphicon glyphicon-ok btn btn-success btn-sm">
                                    </a>

                                    <a 
                                        title="Print"
                                        href="<?= site_url('classify_con/printclassify/'. $item->c_no) ?>" 
                                        target="_blank"
                                        class="glyphicon glyphicon-print btn btn-primary btn-sm">
                                    </a>

                                    <a 
                                        type="button" 
                                        title="Delete" 
                                        href="<?= site_url('classify_con/deleteclassify/'. $item->c_no) ?>" 
                                        onclick="return confirm('Do you want to delete this classify record?');" 
                                        class="glyphicon glyphicon-trash btn btn-danger btn-sm">
                                    </a>

                                <?php else: ?>

                                    <span class="label label-success">POSTED</span>

                                    <a 
                                        title="View"
                                        href="<?= site_url('classify_con/classifyinfo/'. $item->c_no) ?>" 
                                        class="glyphicon glyphicon-eye-open btn btn-default btn-sm">
                                    </a>

                                    <a 
                                        title="Print"
                                        href="<?= site_url('classify_con/printclassify/'. $item->c_no) ?>" 
                                        target="_blank"
                                        class="glyphicon glyphicon-print btn btn-primary btn-sm">
                                    </a>

                                <?php endif; ?>

                            </td>

                        </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div id="classifyModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <form method="post" action="<?= site_url('classify_con/insertclassify') ?>">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        New Classify
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Date</label>
                        <input 
                            type="date" 
                            name="date" 
                            class="form-control" 
                            value="<?php echo date('Y-m-d'); ?>" 
                            required>
                    </div>

                    <hr>

                    <table class="table table-bordered" id="classifyLineTable">
                        <thead>
                            <tr class="info">
                                <th class="text-center">Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center" width="80">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <select name="p_no[]" class="form-control" required>
                                        <option value="">Select Product</option>
                                        <?php foreach ($products as $product): ?>
                                            <option value="<?php echo $product->p_no; ?>">
                                                <?php echo $product->name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>

                                <td>
                                    <input 
                                        type="number" 
                                        name="qty[]" 
                                        class="form-control text-center" 
                                        min="1" 
                                        required>
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm remove-line">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary btn-sm" id="addClassifyLine">
                        <span class="glyphicon glyphicon-plus"></span>
                        Add Line
                    </button>

                </div>

                <div class="modal-footer">
                
                    <button type="submit" class="btn btn-success">
                        Save Changes
                    </button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">
    
$(document).ready(function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);
});

$(document).ready(function() {

    $('#addClassifyLine').on('click', function() {
        var row = `
            <tr>
                <td>
                    <select name="p_no[]" class="form-control" required>
                        <option value="">Select Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product->p_no; ?>">
                                <?php echo $product->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <td>
                    <input 
                        type="number" 
                        name="qty[]" 
                        class="form-control text-center" 
                        min="1" 
                        required>
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-line">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
        `;

        $('#classifyLineTable tbody').append(row);
    });

    $(document).on('click', '.remove-line', function() {
        var rowCount = $('#classifyLineTable tbody tr').length;

        if (rowCount <= 1) {
            alert('At least one product line is required.');
            return;
        }

        $(this).closest('tr').remove();
    });

    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);

});
</script>
