<div class="col-md-10">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Donation Information
            </h3>

            <div class="pull-right">
                <a href="<?= site_url('donation_con') ?>" class="btn btn-default">Back</a>
            </div>
        </div>

        <div class="panel-body">

            <?php $disabled = ($donation->post == 'YES') ? 'disabled' : ''; ?>

            <?php if ($donation->post == 'YES'): ?>
                <div class="alert alert-info">
                    <strong>Posted!</strong> This donation record is already posted and cannot be edited.
                </div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('donation_con/updatedonation') ?>">

                <input type="hidden" name="d_no" value="<?= $donation->d_no ?>">

                <div class="row">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input 
                            type="date" 
                            name="date" 
                            class="form-control" 
                            value="<?= date('Y-m-d', strtotime($donation->date)) ?>" 
                            <?= $disabled ?>
                            required>
                    </div>

                    <div class="col-md-4">
                        <label>Donate To</label>
                        <input 
                            type="text" 
                            name="donate_to" 
                            class="form-control" 
                            value="<?= $donation->donate_to ?>" 
                            <?= $disabled ?>
                            required>
                    </div>

                    <div class="col-md-4">
                        <label>Post Status</label>
                        <input type="text" class="form-control" value="<?= $donation->post ?>" readonly>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control" <?= $disabled ?>><?= $donation->remarks ?></textarea>
                </div>

                <hr>

                <table class="table table-bordered" id="donationLineTable">
                    <thead>
                        <tr class="info">
                            <th class="text-center">Product</th>
                            <th class="text-center">Quantity</th>

                            <?php if ($donation->post != 'YES'): ?>
                                <th class="text-center" width="80">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($donationline as $line): ?>
                            <tr>
                                <td>
                                    <select name="p_no[]" class="form-control" <?= $disabled ?> required>
                                        <option value="">Select Product</option>

                                        <?php foreach ($products as $product): ?>
                                            <option 
                                                value="<?= $product->p_no ?>"
                                                <?= ($product->p_no == $line->p_no) ? 'selected' : '' ?>>
                                                <?= $product->name ?> — Stock: <?= number_format($product->qty) ?>
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

                                <?php if ($donation->post != 'YES'): ?>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-donation-line">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if ($donation->post != 'YES'): ?>

                    <button type="button" class="btn btn-primary btn-sm" id="addDonationLine">
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

    $('#addDonationLine').on('click', function(e) {
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
                    <input 
                        type="number" 
                        name="qty[]" 
                        class="form-control text-center" 
                        min="1" 
                        required>
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-donation-line">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
        `;

        $('#donationLineTable tbody').append(row);
    });

    $(document).on('click', '.remove-donation-line', function(e) {
        e.preventDefault();

        var rowCount = $('#donationLineTable tbody tr').length;

        if (rowCount <= 1) {
            alert('At least one product line is required.');
            return;
        }

        $(this).closest('tr').remove();
    });

});
</script>