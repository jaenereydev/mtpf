<div class="col-md-10">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Reclassify Information
            </h3>

            <div class="pull-right">
                <a href="<?= site_url('reclassify_con') ?>" class="btn btn-default">Back</a>
            </div>
        </div>

        <div class="panel-body">

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php $disabled = ($reclassify->post == 'YES') ? 'disabled' : ''; ?>

            <?php if ($reclassify->post == 'YES'): ?>
                <div class="alert alert-info">
                    <strong>Posted!</strong> This reclassify record is already posted and cannot be edited.
                </div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('reclassify_con/updatereclassify') ?>">

                <input type="hidden" name="r_no" value="<?= $reclassify->r_no ?>">

                <div class="row">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input 
                            type="date" 
                            name="date" 
                            class="form-control" 
                            value="<?= date('Y-m-d', strtotime($reclassify->date)) ?>" 
                            <?= $disabled ?>
                            required>
                    </div>

                    <div class="col-md-4">
                        <label>Post Status</label>
                        <input type="text" class="form-control" value="<?= $reclassify->post ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label>User</label>
                        <input type="text" class="form-control" value="<?= $reclassify->name ?>" readonly>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control" <?= $disabled ?>><?= $reclassify->remarks ?></textarea>
                </div>

                <hr>

                <table class="table table-bordered" id="reclassifyLineTable">
                    <thead>
                        <tr class="info">
                            <th class="text-center">From Product</th>
                            <th class="text-center">To Product</th>
                            <th class="text-center">Quantity</th>

                            <?php if ($reclassify->post != 'YES'): ?>
                                <th class="text-center" width="80">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($reclassifyline as $line): ?>
                            <tr>
                                <td>
                                    <select name="from_p_no[]" class="form-control" <?= $disabled ?> required>
                                        <option value="">Select From Product</option>

                                        <?php foreach ($products as $product): ?>
                                            <option 
                                                value="<?= $product->p_no ?>"
                                                <?= ($product->p_no == $line->from_p_no) ? 'selected' : '' ?>>
                                                <?= $product->name ?> - Stock: <?= number_format($product->qty) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>

                                <td>
                                    <select name="to_p_no[]" class="form-control" <?= $disabled ?> required>
                                        <option value="">Select To Product</option>

                                        <?php foreach ($products as $product): ?>
                                            <option 
                                                value="<?= $product->p_no ?>"
                                                <?= ($product->p_no == $line->to_p_no) ? 'selected' : '' ?>>
                                                <?= $product->name ?> - Stock: <?= number_format($product->qty) ?>
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

                                <?php if ($reclassify->post != 'YES'): ?>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-reclassify-line">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if ($reclassify->post != 'YES'): ?>

                    <button type="button" class="btn btn-primary btn-sm" id="addReclassifyLine">
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


<script type="text/javascript" src="<?= base_url() ?>public/js/datatables.min.js"></script>

<script>
$(document).ready(function() {

    $('#MTable').DataTable();

    $('#addReclassifyLine').on('click', function(e) {
        e.preventDefault();

        var row = `
            <tr>
                <td>
                    <select name="from_p_no[]" class="form-control" required>
                        <option value="">Select From Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product->p_no ?>">
                                <?= $product->name ?> - Stock: <?= number_format($product->qty) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <td>
                    <select name="to_p_no[]" class="form-control" required>
                        <option value="">Select To Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product->p_no ?>">
                                <?= $product->name ?> - Stock: <?= number_format($product->qty) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <td>
                    <input type="number" name="qty[]" class="form-control text-center" min="1" required>
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-reclassify-line">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
        `;

        $('#reclassifyLineTable tbody').append(row);
    });

    $(document).on('click', '.remove-reclassify-line', function(e) {
        e.preventDefault();

        var rowCount = $('#reclassifyLineTable tbody tr').length;

        if (rowCount <= 1) {
            alert('At least one line is required.');
            return;
        }

        $(this).closest('tr').remove();
    });

    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);

});
</script>