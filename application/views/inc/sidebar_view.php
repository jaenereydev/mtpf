<div style="padding-top: 60px;" class="container-fluid" >
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar  hidden-phone" id="MainMenu"  >
            <div  class="list-group panelbody">    
                <a title="Dashboard" class="list-group-item" href="<?php echo site_url('dashboard') ?>"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>

                <a title="Customer" class="list-group-item" href="<?php echo site_url('customer_con') ?>"><span class="glyphicon glyphicon-user"></span> Customer</a>

                <a title="Product" class="list-group-item" href="<?php echo site_url('product_con') ?>"><span class="glyphicon glyphicon-barcode"></span> Product</a>

                <?php if($users[0]->position == "Cashier"){}else { ?>
                    <a title="Delivery" class="list-group-item" href="<?php echo site_url('Delivery_con') ?>"><span class="	glyphicon glyphicon-qrcode"></span> Delivery</a>
                <?php } ?>

                <a title="Sales" class="list-group-item" href="<?php echo site_url('Sales_con') ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Sales</a>
                
                <a title="Credit" class="list-group-item" href="<?php echo site_url('Salescredit_con') ?>"><span class="glyphicon glyphicon-book"></span> Credit Sales</a>  
                
                <a title="Credit Payment" class="list-group-item" href="<?php echo site_url('Creditpayment_con') ?>"><span class="glyphicon glyphicon-folder-open"></span> Credit Payment</a>

                <a title="Sales" class="list-group-item" href="<?php echo site_url('Creditloan_con') ?>"><span class="glyphicon glyphicon-credit-card"></span> Credit Loan</a>

                <a title="Expenses" class="list-group-item" href="<?php echo site_url('Expenses_con') ?>"><span class="glyphicon glyphicon-list-alt"></span> Expenses</a>

                <a title="Deposit" class="list-group-item" href="<?php echo site_url('Deposit_con') ?>"><span class="glyphicon glyphicon-usd"></span> Deposit</a>

                <a title="Transaction List" class="list-group-item" href="<?php echo site_url('Sales_con/transactionlist') ?>"><span class="glyphicon glyphicon-lock"></span> Transaction List</a>
                <?php if($users[0]->position == "Cashier"){}else { ?>
                    <a title="Task" class="list-group-item" href="<?php echo site_url('Task_con') ?>"><span class="glyphicon glyphicon-tasks"></span> Task Mgt.</a>
                    <a title="Reports" class="list-group-item" href="<?php echo site_url('Report_con') ?>"><span class="glyphicon glyphicon-signal"></span> Reports</a>
                <?php } ?>
               
            </div>
        </div><!--end of sidebar -->        