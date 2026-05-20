<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<style>
    .dashboard-panel {
        border-radius: 4px;
    }

    .dashboard-panel-body {
        padding: 10px;
    }

    .dashboard-icon-box {
        border-right: 1px solid #ddd;
        min-height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-icon-box h3 {
        margin: 0;
    }

    .dashboard-icon {
        font-size: 38px;
    }

    .dashboard-count-box {
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dashboard-count h2 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
        color: #333;
    }

    .dashboard-label h4 {
        margin: 5px 0 0;
        font-size: 12px;
        color: #777;
        text-transform: uppercase;
        line-height: 1.2;
    }

    .product-color {
        color: #f0ad4e;
    }

    .qty-color {
        color: #5cb85c;
    }

    .production-color {
        color: #337ab7;
    }

    .warning-color {
        color: #f0ad4e;
    }

    .danger-color {
        color: #d9534f;
    }

    .donation-color {
        color: #d9534f;
    }

    .reclassify-color {
        color: #5bc0de;
    }

    .cash-color {
        color: #5cb85c;
    }

    .credit-color {
        color: #337ab7;
    }

    .payment-color {
        color: #5bc0de;
    }

    .expenses-color {
        color: #d9534f;
    }

    .netcash-color {
        color: #f0ad4e;
    }

    .panel-heading strong {
        font-size: 15px;
    }

    .table-dashboard td,
    .table-dashboard th {
        vertical-align: middle !important;
    }

    .section-title {
        margin: 10px 0 15px;
        font-weight: bold;
        color: #555;
        border-bottom: 1px solid #ddd;
        padding-bottom: 6px;
    }
</style>

<div class="col-md-10">

    <!-- DASHBOARD FILTER -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Dashboard Filter</strong>
        </div>

        <div class="panel-body">
            <form method="get" action="<?= site_url('dashboard') ?>">
                <div class="row">

                    <div class="col-md-3">
                        <label>From Date</label>
                        <input 
                            type="date" 
                            name="date_from" 
                            class="form-control" 
                            value="<?= isset($date_from) ? $date_from : date('Y-m-01') ?>">
                    </div>

                    <div class="col-md-3">
                        <label>To Date</label>
                        <input 
                            type="date" 
                            name="date_to" 
                            class="form-control" 
                            value="<?= isset($date_to) ? $date_to : date('Y-m-t') ?>">
                    </div>

                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">
                            <span class="glyphicon glyphicon-search"></span>
                            Apply Filter
                        </button>
                    </div>

                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <a href="<?= site_url('dashboard') ?>" class="btn btn-default btn-block">
                            <span class="glyphicon glyphicon-refresh"></span>
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- INVENTORY SUMMARY -->
    <h4 class="section-title">Inventory Summary</h4>

    <div class="row">

        <!-- Product Count -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-barcode dashboard-icon product-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($productcount) ? $productcount : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Product Count</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Product Qty -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-scale dashboard-icon qty-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($totalproductqty) ? $totalproductqty : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Total Product Qty</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-warning-sign dashboard-icon warning-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($lowstockcount) ? $lowstockcount : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Low Stock</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Negative Stock -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-alert dashboard-icon danger-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($negativestockcount) ? $negativestockcount : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Negative Stock</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- PRODUCTION SUMMARY -->
    <h4 class="section-title">Production Summary</h4>

    <div class="row">

        <!-- Production Today -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-stats dashboard-icon production-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($production_today) ? $production_today : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Production Today</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Production Week -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-calendar dashboard-icon production-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($production_week) ? $production_week : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Production Week</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Production Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-tasks dashboard-icon production-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($production_period) ? $production_period : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Production Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-heart-empty dashboard-icon donation-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($donation_period) ? $donation_period : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Donation Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">

        <!-- Reclassify Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-transfer dashboard-icon reclassify-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($reclassify_period) ? $reclassify_period : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Reclassify Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- FINANCIAL SUMMARY -->
    <h4 class="section-title">Financial Summary</h4>

    <div class="row">

        <!-- Cash Sales Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-shopping-cart dashboard-icon cash-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($cash_sales_period) ? $cash_sales_period : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Cash Sales Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Credit Sales Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-book dashboard-icon credit-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($credit_sales_period) ? $credit_sales_period : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Credit Sales Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Credit Payment Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-folder-open dashboard-icon payment-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($credit_payment_period) ? $credit_payment_period : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Payment Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expenses Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-list-alt dashboard-icon expenses-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($expenses_period) ? $expenses_period : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Expenses Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">

        <!-- Net Cash Period -->
        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-piggy-bank dashboard-icon netcash-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($net_cash_period) ? $net_cash_period : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Net Cash Period</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- CHARTS AND TABLES -->
    <h4 class="section-title">Statistics</h4>

    <div class="row">

        <!-- Production Chart -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Production Chart</strong>
                </div>

                <div class="panel-body">
                    <canvas id="productionChart" height="140"></canvas>
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Low / Negative Stock Products</strong>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-dashboard">
                        <thead>
                            <tr class="info">
                                <th class="text-center">Product</th>
                                <th class="text-center">Qty</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($lowstockproducts)): ?>
                                <?php foreach ($lowstockproducts as $item): ?>
                                    <tr>
                                        <td><?= $item->name; ?></td>
                                        <td class="text-center">
                                            <?php if ($item->qty < 0): ?>
                                                <span class="label label-danger">
                                                    <?= number_format($item->qty); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="label label-warning">
                                                    <?= number_format($item->qty); ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">No low stock products.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <div class="row">

        <!-- Product Movement -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Top Product Movement</strong>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-dashboard">
                        <thead>
                            <tr class="info">
                                <th class="text-center">Product</th>
                                <th class="text-center">In Qty</th>
                                <th class="text-center">Out Qty</th>
                                <th class="text-center">Current Balance</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($product_movement)): ?>
                                <?php foreach ($product_movement as $item): ?>
                                    <tr>
                                        <td><?= $item->name; ?></td>
                                        <td class="text-center"><?= number_format($item->total_in); ?></td>
                                        <td class="text-center"><?= number_format($item->total_out); ?></td>
                                        <td class="text-center">
                                            <?php if ($item->current_balance < 0): ?>
                                                <span class="label label-danger">
                                                    <?= number_format($item->current_balance); ?>
                                                </span>
                                            <?php else: ?>
                                                <?= number_format($item->current_balance); ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No product movement for selected period.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>


<script>
$(document).ready(function() {

    var productionLabels = [
        <?php if (!empty($production_chart)): ?>
            <?php foreach ($production_chart as $row): ?>
                "<?= date('M d', strtotime($row->date)); ?>",
            <?php endforeach; ?>
        <?php endif; ?>
    ];

    var productionData = [
        <?php if (!empty($production_chart)): ?>
            <?php foreach ($production_chart as $row): ?>
                <?= $row->total_qty ? $row->total_qty : 0; ?>,
            <?php endforeach; ?>
        <?php endif; ?>
    ];

    var ctx = document.getElementById('productionChart');

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productionLabels,
                datasets: [{
                    label: 'Production Qty',
                    data: productionData,
                    backgroundColor: 'rgba(51, 122, 183, 0.5)',
                    borderColor: 'rgba(51, 122, 183, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

});
</script>