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
        font-size: 30px;
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

    .panel-heading strong {
        font-size: 15px;
    }

    .table-dashboard td,
    .table-dashboard th {
        vertical-align: middle !important;
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
</style>

<div class="col-md-10">

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

        <!-- Production Month -->
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
                                    <h2><?= number_format(isset($production_month) ? $production_month : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Production Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation Month -->
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
                                    <h2><?= number_format(isset($donation_month) ? $donation_month : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Donation Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">

        <!-- Reclassify Month -->
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
                                    <h2><?= number_format(isset($reclassify_month) ? $reclassify_month : 0); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Reclassify Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <h2><?= number_format(isset($cash_sales_today) ? $cash_sales_today : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Cash Sales Today</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-usd dashboard-icon cash-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($cash_sales_month) ? $cash_sales_month : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Cash Sales Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <h2><?= number_format(isset($credit_sales_month) ? $credit_sales_month : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Credit Sales Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <h2><?= number_format(isset($credit_payment_month) ? $credit_payment_month : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Payment Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                    <h2><?= number_format(isset($expenses_month) ? $expenses_month : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Expenses Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="panel-body dashboard-panel-body">
                        <div class="row">
                            <div class="col-xs-4 text-center dashboard-icon-box">
                                <h3>
                                    <span class="glyphicon glyphicon-credit-card dashboard-icon credit-color"></span>
                                </h3>
                            </div>

                            <div class="col-xs-8 dashboard-count-box">
                                <div class="dashboard-count">
                                    <h2><?= number_format(isset($credit_balance) ? $credit_balance : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Credit Balance</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <h2><?= number_format(isset($net_cash_month) ? $net_cash_month : 0, 2); ?></h2>
                                </div>
                                <div class="dashboard-label">
                                    <h4>Net Cash Month</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- Product Movement -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Top Product Movement This Month</strong>
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
                                    <td colspan="4" class="text-center">No product movement this month.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- Production Chart -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Production Last 7 Days</strong>
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


    

</div>


<script>
$(document).ready(function() {

    var productionLabels = [
        <?php foreach ($production_chart as $row): ?>
            "<?= date('M d', strtotime($row->date)); ?>",
        <?php endforeach; ?>
    ];

    var productionData = [
        <?php foreach ($production_chart as $row): ?>
            <?= $row->total_qty ? $row->total_qty : 0; ?>,
        <?php endforeach; ?>
    ];

    var ctx = document.getElementById('productionChart');

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productionLabels,
                datasets: [{
                    label: 'Production Qty',
                    data: productionData
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