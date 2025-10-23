<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('inventory_con/inventoryview')?>">
        <title>Print Count Sheet</title>
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
                <h2>Count Sheet</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>           
            
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
                <tr class="info">                                                          
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Count</strong></td>                     
                    <td style="text-align: center;border: 1px solid;" ><strong>Product Name</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>UOM</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Packing</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Qty per Packing</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Stock On Hand(PCs/K.G)</strong></td>
                    
                                                            
                </tr>                  
                <?php for($i=0; $i<count($prod); $i++) { ?>                              
                <tr>              
                    <td style="border-bottom:  1px solid;" colspan="2"></td>
                    <td style="text-align: center;text-transform: capitalize;"><?php echo $prod[$i]->longdesc;?></td>
                    <td style="text-align: center;text-transform: capitalize;"><?php echo $prod[$i]->uom;?></td>
                    <td style="text-align: center;text-transform: capitalize;"><?php echo $prod[$i]->packing;?></td>
                    <td style="text-align: center;text-transform: capitalize;"><?php if(($prod[$i]->qty%$prod[$i]->packing) == '0'){echo number_format($prod[$i]->qty/$prod[$i]->packing,0,'.',','); echo ' / 0';}else{ echo number_format(floor($prod[$i]->qty/$prod[$i]->packing),0,'.',','); echo ' / '; echo number_format($prod[$i]->qty%$prod[$i]->packing,0,'.',',');}?></td>
                    <td style="text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$i]->qty,2,'.',',');?></td>                                                 
                </tr>
                <?php } ?>                                                                          
            </table>            
        </div>     
        
    </body>
    
</html>