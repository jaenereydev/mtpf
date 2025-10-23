<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?php echo site_url('milling_con') ?>">
        <title>Print Milling Transaction</title>
        <script type="text/javascript">
        window.print();
        //disabled F5
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
    </head>
    <body >          
     
        <table style="margin: 0 auto;">
        <tr>
            <td>
            <div class="pull-left">
                <img src="<?php echo $com[0]->logo;?>" width="60" height="60">
            </div>
            </td>
            <td style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">
                <div>
                <h2><?php echo $com[0]->companyname;?></h2>
                <?php echo $com[0]->address;?>          
                <h2>Milling Report</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">
                <tr>
                    <td><div style="vertical-align: top; font-size: 15px;"><strong>Output Product:</strong> <strong><span style="text-transform: capitalize;"><?php echo $m[0]->longdesc; ?></span> <?php echo " - "; echo $m[0]->uom; echo "("; echo $m[0]->packing; echo ") -  "; echo $m[0]->qty; echo "qty -  "; echo number_format((float)$m[0]->pcs,2,'.',',');echo "pc/s";?></strong></div></td>                                        
                </tr> 
                <tr>
                    <td><strong>Date:</strong> <strong><?php  echo date_format(date_create($m[0]->date), 'm/d/Y');?></strong></div></td>                                        
                </tr> 
            </table>
            <hr>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
                <tr class="info">                                                          
                    <td style="text-align: center;border: 1px solid;" ><strong>Product Name</strong></td>                     
                    <td style="text-align: center;border: 1px solid;" ><strong>UOM</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Packing</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Unit Price</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Unit Cost</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Qty per Packing</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Actual Count (Pcs/Kg)</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Total Amount</strong></td>                                                                                
                </tr> 
                
                <?php for($i=0; $i<count($ml); $i++) { ?>                              
                <tr>                                        
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $ml[$i]->longdesc;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $ml[$i]->uom;?></td>                            
                    <td style="border-bottom: 1px solid;text-align: center;"><?php echo $ml[$i]->packing;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($ml[$i]->unitprice == null || $ml[$i]->unitprice == ""){}else {echo number_format((float)$ml[$i]->unitprice,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($ml[$i]->unitcost == null || $ml[$i]->unitcost == ""){}else { echo number_format((float)$ml[$i]->unitcost,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($ml[$i]->qty == null || $ml[$i]->qty == ""){}else {echo number_format((float)$ml[$i]->qty,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($ml[$i]->pc == null || $ml[$i]->pc == ""){}else {echo number_format((float)$ml[$i]->pc,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($ml[$i]->totalamount == null || $ml[$i]->totalamount == ""){}else {echo number_format((float)$ml[$i]->totalamount,2,'.',',');}?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="6" style="text-align: right"><strong>Total</strong></td>
                    <td style="text-align: center;border-bottom: 2px double"><strong><?php echo number_format((float)$m[0]->totalqty,2,'.',',');?></strong></td>
                    <td style="text-align: center;border-bottom: 2px double"><strong><?php echo number_format((float)$m[0]->totalamount,2,'.',',');?></strong></td>
                </tr>
            </table>            
        </div>     
        
    </body>
    
</html>