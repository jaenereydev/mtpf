<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/datatables.min.css"/>

<div class="col-md-10">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Disposal List
            </h3>

            <div class="pull-right">
                <button type="button" data-toggle="modal" data-target="#disposalModal" class="btn btn-info">
                    New
                </button>
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

            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">
                <thead>
                    <tr class="info">
                        <td class="text-center"><strong>Date</strong></td>
                        <td class="text-center"><strong>Remarks</strong></td>
                        <td class="text-center"><strong>Total Qty</strong></td>
                        <td class="text-center"><strong>Post</strong></td>
                        <td class="text-center"><strong>User</strong></td>
                        <td class="text-center"><strong>Action</strong></td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($disposal as $item): ?>
                        <tr>
                            <td class="text-center"><?= $item->date; ?></td>
                            <td class="text-center"><?= $item->remarks; ?></td>
                            <td class="text-center"><?= number_format($item->total_qty); ?></td>
                            <td class="text-center"><?= $item->post; ?></td>
                            <td class="text-center"><?= $item->name; ?></td>

                            <td class="text-center">

                                <?php if ($item->post != 'YES'): ?>

                                    <a 
                                        title="Edit"
                                        href="<?= site_url('disposal_con/disposalinfo/'.$item->dis_no) ?>"
                                        class="glyphicon glyphicon-pencil btn btn-info btn-sm">
                                    </a>

                                    <a 
                                        title="Post"
                                        href="<?= site_url('disposal_con/postdisposal/'.$item->dis_no) ?>"
                                        onclick="return confirm('Do you want to POST this disposal? This will deduct product inventory.');"
                                        class="glyphicon glyphicon-ok btn btn-success btn-sm">
                                    </a>

                                    <a 
                                        title="Print"
                                        href="<?= site_url('disposal_con/printdisposal/'.$item->dis_no) ?>"
                                        target="_blank"
                                        class="glyphicon glyphicon-print btn btn-primary btn-sm">
                                    </a>

                                    <a 
                                        title="Delete"
                                        href="<?= site_url('disposal_con/deletedisposal/'.$item->dis_no) ?>"
                                        onclick="return confirm('Do you want to delete this disposal record?');"
                                        class="glyphicon glyphicon-trash btn btn-danger btn-sm">
                                    </a>

                                <?php else: ?>

                                    <span class="label label-success">POSTED</span>

                                    <a 
                                        title="View"
                                        href="<?= site_url('disposal_con/disposalinfo/'.$item->dis_no) ?>"
                                        class="glyphicon glyphicon-eye-open btn btn-default btn-sm">
                                    </a>

                                    <a 
                                        title="Print"
                                        href="<?= site_url('disposal_con/printdisposal/'.$item->dis_no) ?>"
                                        target="_blank"
                                        class="glyphicon glyphicon-print btn btn-primary btn-sm">
                                    </a>

                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div id="disposalModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <form method="post" action="<?= site_url('disposal_con/insertdisposal') ?>">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <span class="glyphicon glyphicon-trash"></span>
                        New Disposal
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="col-md-8">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control" placeholder="Example: Rotten eggs">
                        </div>
                    </div>

                    <hr>

                    <table class="table table-bordered" id="disposalLineTable">
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
                                    <button type="button" class="btn btn-danger btn-sm remove-disposal-line">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary btn-sm" id="addDisposalLine">
                        <span class="glyphicon glyphicon-plus"></span>
                        Add Line
                    </button>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                        Save
                    </button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>public/js/datatables.min.js"></script>

<script>
$(document).ready(function() {

    $('#MTable').DataTable();

    $('#addDisposalLine').on('click', function(e) {
        e.preventDefault();

        var row = `
            <tr>
                <td>
                    <select name="p_no[]" class="form-control" required>
                        <option value="">Select Product</option>
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
                    <button type="button" class="btn btn-danger btn-sm remove-disposal-line">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
        `;

        $('#disposalLineTable tbody').append(row);
    });

    $(document).on('click', '.remove-disposal-line', function(e) {
        e.preventDefault();

        var rowCount = $('#disposalLineTable tbody tr').length;

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