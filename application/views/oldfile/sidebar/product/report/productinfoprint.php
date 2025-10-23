<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('product_con/productview')?>">
        <title>Print Product Info</title>
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
                <h2>Product Information</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
        <div>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                
                <tr>                                             
                   <td style="text-align: left;text-transform: capitalize;"><strong><?php echo "#"; echo $prod[0]->p_no; echo " "; echo $prod[0]->longdesc;?></strong></td>       
                   <td style="text-align: Right;"><strong><?php echo $prod[0]->description;?></strong></td>                  
                </tr>   
                <tr>
                    <td style="text-align: left;"><strong><?php echo $prod[0]->name;?></strong></td>
                </tr>
            </table>           
            <hr>
            <legend>Product History</legend>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                                 
                <tr>                                             
                    <td style="text-align: center;border: 1px solid;"><strong>Date</strong></td>                         
                    <td style="text-align: center;border: 1px solid;"><strong>Ref. No.</strong></td>                        
                    <td style="text-align: center;border: 1px solid;"><strong>Description</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>In</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Out</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Balance</strong></td>
                  </tr> 
                <?php for($i=0; $i<count($prodhist); $i++) { ?>                    
                <tr>                          
                    <td style="text-align: center; text-transform: capitalize"><?php echo $prodhist[$i]->date;?></td>                        
                    <td style="text-align: center; text-transform: capitalize"><?php echo $prodhist[$i]->ref_no;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php if($prodhist[$i]->description == 'MILLED'){ echo "MILLED";}else if($prodhist[$i]->description == 'RECEIVED'){ echo "Received Good/s";}else if($prodhist[$i]->description == 'SALES'){ echo "Sales POS";}else if($prodhist[$i]->description == 'CREDIT'){echo "Credit Sales";}else if($prodhist[$i]->description == 'RETURN'){echo "Return Sale";}else if($prodhist[$i]->description == 'ADJUST'){echo "Adjusted Good/s";}else if($prodhist[$i]->description == 'RETURNRECEIVED'){echo "Return Received Good/s";}else if($prodhist[$i]->description == 'INVENTORY'){echo "Physical Count";}?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php if($prodhist[$i]->instock == null || $prodhist[$i]->instock == ""){}else {echo number_format((float)$prodhist[$i]->instock,2,'.',',');} ?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php if($prodhist[$i]->outstock == null || $prodhist[$i]->outstock == ""){}else {echo number_format((float)$prodhist[$i]->outstock,2,'.',',');}?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo number_format((float)$prodhist[$i]->rqty,2,'.',',');?></td>                    
                </tr>
                <?php } ?>     
            </table>
            <?php if($pc == null) {}else { ?>
            <hr>
            <legend>Product Price Change Transaction</legend>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                                 
                <tr>                                    
                    <td style="text-align: center;border: 1px solid;"><strong>#</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Requested By</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Date</strong></td>                        
                    <td style="text-align: center;border: 1px solid;"><strong>Effective Date</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Posted</strong></td> 
                </tr> 
                <?php for($i=0; $i<count($pc); $i++) { ?>                                
                <tr>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->ref_no;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->requestedby;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->date;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->effectivedate;?></td>
                    <td style="text-align: center; text-transform: capitalize"><strong><?php echo $pc[$i]->stat;?></strong></td>
                </tr>
                <?php } ?>    
            </table>
            <?php }?>
        </div>              
        
    </body>
    
</html>