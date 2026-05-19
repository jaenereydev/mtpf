<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>favico.ico"/>
    <title>Print Classify</title>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .print-container {
            width: 800px;
            margin: 20px auto;
        }

        .print-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .print-header h3,
        .print-header h4 {
            margin: 3px 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 4px;
        }

        .table-print {
            width: 100%;
            border-collapse: collapse;
        }

        .table-print th,
        .table-print td {
            border: 1px solid #000;
            padding: 6px;
        }

        .table-print th {
            text-align: center;
            background: #eee;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .signature-section {
            margin-top: 60px;
            width: 100%;
        }

        .signature-box {
            width: 33%;
            text-align: center;
            float: left;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin: 40px 20px 5px 20px;
        }

        .no-print {
            margin-bottom: 15px;
        }

        @media print {
            .no-print {
                display: none;
            }

            .print-container {
                width: 100%;
                margin: 0;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>

<div class="print-container">

    <div class="no-print text-right">
        <button onclick="window.print();" class="btn btn-primary">
            <span class="glyphicon glyphicon-print"></span>
            Print
        </button>

        <button onclick="window.close();" class="btn btn-default">
            Close
        </button>
    </div>

    <div class="print-header">
        <h3>CLASSIFY REPORT</h3>
        <h4>Reference No: <?= $classify->c_no ?></h4>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>Date:</strong></td>
            <td width="35%"><?= date('m/d/Y', strtotime($classify->date)) ?></td>

            <td width="15%"><strong>Status:</strong></td>
            <td width="35%"><?= $classify->post ?></td>
        </tr>

        <tr>
            <td><strong>User:</strong></td>
            <td><?= $classify->name ?></td>

            <td><strong>Printed Date:</strong></td>
            <td><?= date('m/d/Y h:i A') ?></td>
        </tr>
    </table>

    <table class="table-print">
        <thead>
            <tr>
                <th width="10%">No.</th>
                <th width="60%">Product</th>
                <th width="30%">Quantity</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                $total_qty = 0;
                $no = 1;
            ?>

            <?php foreach ($classifyline as $line): ?>
                <?php $total_qty += $line->qty; ?>

                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $line->productname ?></td>
                    <td class="text-right"><?= number_format($line->qty, 2) ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="2" class="text-right">
                    <strong>Total Quantity</strong>
                </td>
                <td class="text-right">
                    <strong><?= number_format($total_qty, 2) ?></strong>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            Prepared By
        </div>

        <div class="signature-box">
            <div class="signature-line"></div>
            Checked By
        </div>

        <div class="signature-box">
            <div class="signature-line"></div>
            Approved By
        </div>
    </div>

</div>

</body>
</html>