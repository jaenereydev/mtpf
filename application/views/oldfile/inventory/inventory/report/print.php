<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('inventory_con/inventoryview')?>">
        <title>Print Physical Count</title>
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
                <h2>Physical Count Report</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">
                <tr>
                    <td><div style="vertical-align: top; font-size: 15px;"><strong>Supplier :</strong> <strong><?php if($inv[0]->s_no == null || $inv[0]->s_no == ""){ echo "ALL Supplier";}else { for($s=0;$s<count($sup);$s++){if($inv[0]->s_no == $sup[$s]->s_no){ echo $sup[$s]->name;}}}?></strong></div></td>                                        
                </tr> 
                <tr>
                    <td><strong>Date</strong> <strong><?php  echo $inv[0]->date;?></strong></div></td>                                        
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
                
                <?php for($i=0; $i<count($invl); $i++) { ?>                              
                <tr>                                        
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $invl[$i]->longdesc;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $invl[$i]->uom;?></td>                            
                    <td style="border-bottom: 1px solid;text-align: center;"><?php echo $invl[$i]->packing;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($invl[$i]->unitprice == null || $invl[$i]->unitprice == ""){}else {echo number_format((float)$invl[$i]->unitprice,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($invl[$i]->unitcost == null || $invl[$i]->unitcost == ""){}else { echo number_format((float)$invl[$i]->unitcost,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($invl[$i]->qty == null || $invl[$i]->qty == ""){}else {echo number_format((float)$invl[$i]->qty,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($invl[$i]->pcs == null || $invl[$i]->pcs == ""){}else {echo number_format((float)$invl[$i]->pcs,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($invl[$i]->totalamount == null || $invl[$i]->totalamount == ""){}else {echo number_format((float)$invl[$i]->totalamount,2,'.',',');}?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="6" style="text-align: right"><strong>Total</strong></td>
                    <td style="text-align: center;border-bottom: 2px double"><strong><?php echo number_format((float)$inv[0]->totalqty,2,'.',',');?></strong></td>
                    <td style="text-align: center;border-bottom: 2px double"><strong><?php echo number_format((float)$inv[0]->totalamount,2,'.',',');?></strong></td>
                </tr>
            </table>            
        </div>
    </body>
    
</html>