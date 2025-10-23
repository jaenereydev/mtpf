<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('adjustment_con/adjustmentview')?>">
        <title>Print Stock Adjustment</title>
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
                <h2>Stock Adjustment Report</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">
                <tr>
                    <td><div style="vertical-align: top; font-size: 15px;"><strong>Sign : </strong> <strong><?php if($adj[0]->sign == '+'){echo "Addition(+)";}else{ echo "Subtraction(-)"; }?></strong></div></td>                                        
                </tr> 
                <tr>
                    <td><strong>Date : </strong> <strong><?php  echo $adj[0]->date;?></strong></div></td>                                        
                </tr> 
                <tr>
                    <td><strong>Remarks : </strong> <strong><?php  echo $adj[0]->remarks;?></strong></div></td>                                        
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
                
                <?php for($i=0; $i<count($adjl); $i++) { ?>                              
                <tr>                                        
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $adjl[$i]->longdesc;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $adjl[$i]->uom;?></td>                            
                    <td style="border-bottom: 1px solid;text-align: center;"><?php echo $adjl[$i]->packing;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($adjl[$i]->unitprice == null || $adjl[$i]->unitprice == ""){}else {echo number_format((float)$adjl[$i]->unitprice,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($adjl[$i]->unitcost == null || $adjl[$i]->unitcost == ""){}else { echo number_format((float)$adjl[$i]->unitcost,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($adjl[$i]->qty == null || $adjl[$i]->qty == ""){}else {echo number_format((float)$adjl[$i]->qty,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($adjl[$i]->pcs == null || $adjl[$i]->pcs == ""){}else {echo number_format((float)$adjl[$i]->pcs,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($adjl[$i]->totalamount == null || $adjl[$i]->totalamount == ""){}else {echo number_format((float)$adjl[$i]->totalamount,2,'.',',');}?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="6" style="text-align: right"><strong>Total</strong></td>
                    <td style="text-align: center;border-bottom: 2px double"><strong><?php echo number_format((float)$adj[0]->totalqty,2,'.',',');?></strong></td>
                    <td style="text-align: center;border-bottom: 2px double"><strong><?php echo number_format((float)$adj[0]->totalamount,2,'.',',');?></strong></td>
                </tr>
            </table>            
        </div>      
        
    </body>
    
</html>