<html>
    <head>
        <!-- <meta http-equiv="refresh" content="0.1; url=<?=site_url('Sales_con/transactionlist')?>"> -->
        <title>Print Receipt</title>
        <link rel="icon" type="image/x-icon" href="<?=base_url()?>favico.ico"/>
        <!-- <script type="text/javascript">
        window.print();        
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
        </script> -->
    </head>
    <body>          
           
        <div>
            <div style="font-family: arial;text-align: left;  text-transform: capitalize;font-size: 10pt; padding-top: 30px; padding-left: 20px; margin-top: 50px"><strong><?php echo $t[0]->type.' - '.$t[0]->user_id; ?></strong></div>
            <div style="font-family: arial;text-align: left;  text-transform: capitalize;font-size: 9pt; padding-left: 100px; padding-top:10px;"><strong><?php echo $t[0]->date.' - #'.$t[0]->t_no; ?></strong></div>
            <div style="font-family: arial;text-align: left; margin-left: 100px; text-transform: capitalize;font-size: 10pt;" >
               <?php if($customer == null){ ?>
                <strong>Walk-In Customer</strong>
               <?php }else { ?>   
                  <strong><?php echo $customer[0]->name ?></strong>
              <?php } ?>
            </div>            
        </div>
        <div>
            <?php if(empty($tl)){ ?> 
            <p style="width: 100%;margin: 0 auto; font-size: 200%;"><strong>No Transaction.</strong></p>
            <?php }else{ ?>
        
            <table style="font-family: arial;width: 40%; font-size: 8pt;padding-top: 70px;" >

                <?php $ta=0; foreach ($tl as $key => $item): ?>
                    <tr >
                        <td style="text-align: center;width: 10%"><?php echo $item->tlqty ?></td>
                        <td style="text-align: lefte;width: 30%"><?php echo $item->barcode.'<br>'.$item->name.'<br>'.$item->description.'<br>'; if($item->discount >=1){ echo ' - ('.$item->discount.'%)' ;} ?></td>
                        <td style="text-align: center;width: 10%"><?php echo number_format((float)$item->price,2,'.',','); ?></td>
                        <td style="text-align: center;width: 10%"><?php echo number_format((float)$item->totalamount,2,'.',','); $ta+=$item->totalamount; ?></td>                                                  
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4"><hr></td>
                </tr>
                <tr>
                    <td style="text-align: right;width: 40%" colspan="3">Total Amount</td>            
                    <td style="text-align: center;width: 10%"><?php echo number_format((float)$ta,2,'.',',') ?></td>
                </tr> 
                <?php if($t[0]->discount == '0'){}else { ?>
                    <tr>
                        <td style="text-align: right;width: 40%" colspan="3">Discount</td>            
                        <td style="text-align: center;width: 10%">(<?php echo number_format((float)$t[0]->discount,2,'.',',') ?>)</td>
                    </tr> 
                <?php } ?>
                <tr>
                    <td style="text-align: right;width: 40%" colspan="3">TOTAL:</td>            
                    <td style="text-align: center;width: 10%"><?php echo number_format((float)$t[0]->totalamount,2,'.',',') ?></td>
                </tr> 
                <?php if($t[0]->type == "CREDIT"){}else{ ?>
                <tr>
                    <td style="text-align: right;width: 40%" colspan="3">CASH</td>            
                    <td style="text-align: center;width: 10%"><?php echo number_format((float)$t[0]->cashonhand,2,'.',',') ?></td>
                </tr>  
                 <tr>
                    <td style="text-align: right;width: 40%" colspan="3">CHANGE</td>            
                    <td style="text-align: center;width: 10%"><strong><?php echo number_format((float)$t[0]->change,2,'.',',') ?></strong></td>
                </tr>   
                <?php } ?>               
            </table> 
            <?php } ?>
        </div>                                                   
    </body>
    
</html>