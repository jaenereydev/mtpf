<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('disposal_con')?>">
        <title>Print Disposal</title>
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
                <h2>Disposal Report</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">
                <tr>
                    <td><div style="vertical-align: top; font-size: 15px;"><strong>Reason: </strong><span style="text-transform: capitalize"><?php  echo $d[0]->reason;?></span></div></td>                                        
                </tr> 
                <tr>
                    <td><strong>Date: </strong> <strong><?php  echo $d[0]->date;?></strong></div></td>                                        
                </tr> 
            </table>
            <hr>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
                <tr class="info">                                                          
                    <td style="text-align: center;border: 1px solid;" ><strong>Product Name</strong></td>                     
                    <td style="text-align: center;border: 1px solid;" ><strong>Qty</strong></td>                                                                               
                </tr> 
                
                <?php for($i=0; $i<count($dl); $i++) { ?>                              
                <tr>                                        
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $dl[$i]->longdesc;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $dl[$i]->qty;?></td>                            
                </tr>
                <?php } ?>
                <tr>
                    <td style="text-align: right"><strong>Total</strong></td>
                    <td style="text-align: center;border-bottom: 2px double"><strong><?php echo number_format((float)$sum[0]->qty,2,'.',',');?></strong></td>
                </tr>
            </table>            
        </div>
    </body>
    
</html>