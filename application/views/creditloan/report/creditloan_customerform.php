<html>
    <head>
        <?php if($desc == 'creditloan') { ?>
            <meta http-equiv="refresh" content="0.1; url=<?=site_url('Creditloan_con/successtransaction')?>">
        <?php }if($desc == 'reprint'){ ?>
            <meta  content="0.1;" >
        <?php } if($desc == 'transactionlist'){ ?>
            <meta  content="0.1;" >
        <?php } ?>

        <link rel="icon" type="image/x-icon" href="<?=base_url()?>favico.ico"/>
        <title>Credit loan customer form</title>

        <script type="text/javascript">

        <?php if($desc == 'creditloan') { ?>
            window.print();      
        <?php }if($desc == 'reprint'){ ?>
            
        <?php } if($desc == 'transactionlist'){ ?>
            
        <?php } ?>

        document.onkeydown = function() 
        {
            switch (event.keyCode) 
            {
                case 116 : //F5 button
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;       
            }
        };
        </script>

        <style>
            td {
                border: 1px solid;
                text-transform: capitalize;
            }
        </style>
    </head>
    <body>          
              
        <div>
            <table style="font-family: arial;width: 100%; font-size: 24pt;">
                <tr>
                    <td style="border: 0px ;float: right;"><img style="width: 70px;" class="logo"  src="<?=base_url($com[0]->imglink);?>"></td>
                    <td style="border: 0px ;text-align: center;"><?php echo $com[0]->name; ?><br><span style="font-size: 12pt;">CUSTOMER FORM</span></td>
                    <td style="border: 0px ;text-align: right; font-size: 12pt;"><strong>Serial No. <span style="text-align:right;text-decoration: underline;"><?php echo $cl[0]->cl_no; ?></span></strong></td>
                </tr>
            </table> 
            <table style="font-family: arial;width: 100%; font-size: 12pt;" >
                <tr>
                    <td colspan="2"><strong>Customer Information</strong></td>
                </tr>
                <tr>
                    <td>Name: <strong><?php echo $cl[0]->tname; ?></strong></td>
                    <td>Date: <?php echo date('m/d/Y', strtotime($cl[0]->date));?></td>
                </tr>
                <tr>
                    <td colspan="2">Address: <?php echo $cl[0]->address; ?></td>
                </tr>
                <tr>
                    <td>Agent Name: <?php if($cl[0]->agent_id == null){ echo "NO AGENT"; }else{ echo $cl[0]->aname; } ?></td>
                    <td>Contact No.: <?php echo $cl[0]->telno; ?></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <table style="font-family: arial;width: 100%; font-size: 12pt;">
                            <tr><td colspan="5"style="text-align: center;" ><strong>Product Information</strong></td></tr>
                            <tr>
                                <td style="text-align: center;">Particulars</td>
                                <td style="text-align: center;">Amount</td>
                                <td style="text-align: center;">Qty</td>
                                <td style="text-align: center;">Discount</td>
                                <td style="text-align: center;">Total Amount</td>
                            </tr>
                            
                            <?php $ta=0; foreach ($clline as $key => $item): ?>
                            <tr>
                                <td>
                                    <?php echo $item->barcode.'<br>'.$item->name.'<br>'.$item->description; ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php echo number_format((float)$item->price,2,'.',',');?>
                                </td>
                                <td style="text-align: center;">
                                    <?php echo $item->qty;?>
                                </td>
                                <td style="text-align: center;">
                                    <?php echo number_format((float)$item->discountamount,2,'.',',');?>
                                </td>
                                <td style="text-align: center;">
                                    <?php echo number_format((float)$item->totalamount,2,'.',',');?>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>    
            </table> 
            <table style="font-family: arial;width: 100%; font-size: 12pt;padding-top: 20px;" >
                <tr>   
                    <td colspan="4"style="text-align: center;"><strong>Payment Information<strong></td>
                </tr>
                <tr>
                    <td>Down Payment</td>
                    <td style="text-align: center;"><?php echo number_format((float)$cl[0]->downpayment,2,'.',','); ?></td>
                    <td>Terms</td>
                    <td style="text-align: center;"><?php echo $cl[0]->termsbymonth; ?></td>
                </tr>
                <tr>
                    <td>Maturity</td>
                    <td style="text-align: center;"><?php echo $cl[0]->maturity; ?></td>
                    <td>Due Amount</td>
                    <td style="text-align: center;"><?php echo number_format((float)$cl[0]->due_amount,2,'.',','); ?></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table style="font-family: arial;width: 100%; font-size: 12pt;" >                        
                            <tr>    
                                <td colspan="3"style="text-align: center;"><strong>Payment Table<strong></td>                            
                            </tr>
                            <tr>
                                <td style="text-align: center;">Month No.</td>
                                <td style="text-align: center;">Due Dates</td>
                                <td style="text-align: center;">Due Amount</td>
                            </tr>
                            <?php $tr=0; $m=1; foreach ($repayment as $key => $item): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $m; $m+=1; ?></td>
                                    <td style="text-align: center;"><?php echo $item->due_date ?></td>
                                    <td style="text-align: center;"><?php echo number_format((float)$item->due_amount,2,'.',','); $tr+=$item->due_amount; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2" style="text-align: right;">Total</td>
                                <td style="text-align: center;"><?php echo number_format((float)$tr,2,'.',','); ?></td>
                            </tr>
                        </table>  
                    </td>
                </tr>
            </table>                 
            
            <div>
                <p>
                    <strong>Warranty:</strong><br>
                    I understand/ that-items for warranty and /or damaged items will not be a reason for non-payment.<br>
                    That we will only be responsible (<strong>Tindahan ni Lia & Our Agents</strong>) for warrant based on (Supplier company's warranty policy)
                </p>
                <p>
                    <strong>Non-warranty:</strong><br>
                    Defect  or damage caused due to improper seft-installation by the customer or any unauthorized technician, 
                    by improper testing , operation, demonstration, maintenanance, installation, non-preinstalled software, adjustment,
                    alteration, or modifiation of any kind without following product guidelines.
                </p>
                <input type="checkbox">Received the item/s in good condition.<br><br><br>
            
                    <p style="text-align:left;text-decoration: overline;">
                    CUSTOMER SIGNATURE
                        <span style="float:right;text-decoration: overline">
                        CO-MAKER SIGNATURE/OVER PRINTER NAME
                        </span>
                    </p>                
                                
            </div>
            
        </div>                                                   
    </body>
    
</html>