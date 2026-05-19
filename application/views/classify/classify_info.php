<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Classify Information
            </h3>

            <div class="pull-right">
                <a href="<?= site_url('classify_con') ?>" class="btn btn-default">
                    Back
                </a>
            </div>
        </div>

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

            <?php $disabled = ($classify->post == 'YES') ? 'disabled' : ''; ?>

            <?php if ($classify->post == 'YES'): ?>
                <div class="alert alert-info">
                    <strong>Posted!</strong> This classify record is already posted and cannot be edited.
                </div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('classify_con/updateclassify') ?>">

                <input type="hidden" name="c_no" value="<?= $classify->c_no ?>">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input 
                                type="date" 
                                name="date" 
                                class="form-control" 
                                value="<?= date('Y-m-d', strtotime($classify->date)) ?>" 
                                <?= $disabled ?>
                                required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Post Status</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                value="<?= $classify->post ?>" 
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>User</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                value="<?= $classify->name ?>" 
                                readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <h4>Product Lines</h4>

                <table class="table table-bordered table-striped" id="classifyLineTable">
                    <thead>
                        <tr class="info">
                            <th class="text-center">Product</th>
                            <th class="text-center">Quantity</th>

                            <?php if ($classify->post != 'YES'): ?>
                                <th class="text-center" width="80">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($classifyline as $line): ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="cl_no[]" value="<?= $line->cl_no ?>">

                                    <select name="p_no[]" class="form-control" <?= $disabled ?> required>
                                        <option value="">Select Product</option>

                                        <?php foreach ($products as $product): ?>
                                            <option 
                                                value="<?= $product->p_no ?>"
                                                <?= ($product->p_no == $line->p_no) ? 'selected' : '' ?>>
                                                <?= $product->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>

                                <td>
                                    <input 
                                        type="number" 
                                        name="qty[]" 
                                        class="form-control text-center" 
                                        value="<?= $line->qty ?>"
                                        min="1"
                                        <?= $disabled ?>
                                        required>
                                </td>

                                <?php if ($classify->post != 'YES'): ?>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-line">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if ($classify->post != 'YES'): ?>

                    <button type="button" class="btn btn-primary btn-sm" id="addClassifyLine">
                        <span class="glyphicon glyphicon-plus"></span>
                        Add Line
                    </button>

                    <hr>

                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                        Save Changes
                    </button>

                <?php endif; ?>

            </form>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $('#addClassifyLine').on('click', function() {
        var row = `
            <tr>
                <td>
                    <input type="hidden" name="cl_no[]" value="">

                    <select name="p_no[]" class="form-control" required>
                        <option value="">Select Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product->p_no ?>">
                                <?= $product->name ?>
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