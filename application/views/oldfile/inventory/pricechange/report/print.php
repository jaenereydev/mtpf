<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('pricechange_con/pricechangeview')?>">
        <title>Print Price Change</title>
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
                <h2>Price Change Report</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto; border: 1px solid; font-size: 10px;" width="500px">
                <tr>
                    <td rowspan="3" colspan="3"><div style="text-decoration: underline;vertical-align: top; font-size: 15px;"><strong>Requested By:</strong></div><br><span style="font-size: 20px;text-transform: capitalize;"><strong><?php echo $pc[0]->requestedby;?></strong></span></td>                    
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                    
                    <td style="border: 1px solid;"><div><strong>Date:</strong> <div style="text-align: right;font-size: 12px;"><storng><?php echo $pc[0]->date;?></storng></div></div></td>                    
                </tr> 
                <tr>
                    <td></td>
                    <td style="border: 1px solid;">
                        <div><strong>Ref. No.:</strong> <div style="text-align: right;font-size: 12px;"><strong><?php echo $pc[0]->ref_no;?></strong></div></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid;">
                        <div><strong>Effective Date:</strong> <div style="text-align: right;font-size: 12px;"><strong><?php echo $pc[0]->effectivedate;?></strong></div></div>
                    </td>
                </tr>
            </table>
            
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
                <tr class="info">                                                          
                    <td style="text-align: center;border: 1px solid;" rowspan="2"><strong>Product Name</strong></td>                     
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>UOM</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Packing</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Unit Price</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Unit Cost</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Retail Price</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Wholesale Price</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 3</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 4</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 5</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 6</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 7</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 8</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 9</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Price 10</strong></td>
                    <td style="text-align: center;border: 1px solid;" colspan="2"><strong>Discount Price</strong></td>
                    
                                                            
                </tr> 
                <tr class="info">     
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Old</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>New</strong></td>
                </tr> 
                <?php for($i=0; $i<count($pcl); $i++) { ?>                              
                <tr>                                        
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $pcl[$i]->longdesc;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $pcl[$i]->olduom;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $pcl[$i]->newuom;?></td>                              
                    <td style="border-bottom: 1px solid;text-align: center;"><?php echo $pcl[$i]->oldpacking;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php echo $pcl[$i]->newpacking;?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldunitprice == null || $pcl[$i]->oldunitprice == ""){}else {echo number_format((float)$pcl[$i]->oldunitprice,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newunitprice == null || $pcl[$i]->newunitprice == ""){}else {echo number_format((float)$pcl[$i]->newunitprice,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldunitcost == null || $pcl[$i]->oldunitcost == ""){}else { echo number_format((float)$pcl[$i]->oldunitcost,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newunitcost == null || $pcl[$i]->newunitcost == ""){}else {echo number_format((float)$pcl[$i]->newunitcost,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice1 == null || $pcl[$i]->oldprice1 == ""){}else {echo number_format((float)$pcl[$i]->oldprice1,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice1 == null || $pcl[$i]->newprice1 == ""){}else {echo number_format((float)$pcl[$i]->newprice1,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice2 == null || $pcl[$i]->oldprice2 == ""){}else {echo number_format((float)$pcl[$i]->oldprice2,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice2 == null || $pcl[$i]->newprice2 == ""){}else {echo number_format((float)$pcl[$i]->newprice2,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice3 == null || $pcl[$i]->oldprice3 == ""){}else {echo number_format((float)$pcl[$i]->oldprice3,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice3 == null || $pcl[$i]->newprice3 == ""){}else {echo number_format((float)$pcl[$i]->newprice3,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice4 == null || $pcl[$i]->oldprice4 == ""){}else {echo number_format((float)$pcl[$i]->oldprice4,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice4 == null || $pcl[$i]->newprice4 == ""){}else {echo number_format((float)$pcl[$i]->newprice4,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice5 == null || $pcl[$i]->oldprice5 == ""){}else {echo number_format((float)$pcl[$i]->oldprice5,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice5 == null || $pcl[$i]->newprice5 == ""){}else {echo number_format((float)$pcl[$i]->newprice5,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice6 == null || $pcl[$i]->oldprice6 == ""){}else {echo number_format((float)$pcl[$i]->oldprice6,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice6 == null || $pcl[$i]->newprice6 == ""){}else {echo number_format((float)$pcl[$i]->newprice6,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice7 == null || $pcl[$i]->oldprice7 == ""){}else {echo number_format((float)$pcl[$i]->oldprice7,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice7 == null || $pcl[$i]->newprice7 == ""){}else {echo number_format((float)$pcl[$i]->newprice7,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice8 == null || $pcl[$i]->oldprice8 == ""){}else {echo number_format((float)$pcl[$i]->oldprice8,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice8 == null || $pcl[$i]->newprice8 == ""){}else {echo number_format((float)$pcl[$i]->newprice8,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice9 == null || $pcl[$i]->oldprice9 == ""){}else {echo number_format((float)$pcl[$i]->oldprice9,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice9 == null || $pcl[$i]->newprice9 == ""){}else {echo number_format((float)$pcl[$i]->newprice9,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice10 == null || $pcl[$i]->oldprice10 == ""){}else {echo number_format((float)$pcl[$i]->oldprice10,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice10 == null || $pcl[$i]->newprice10 == ""){}else {echo number_format((float)$pcl[$i]->newprice10,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->oldprice11 == null || $pcl[$i]->oldprice11 == ""){}else {echo number_format((float)$pcl[$i]->oldprice11,2,'.',',');}?></td>
                    <td style="border-bottom: 1px solid;text-align: center;"><?php if($pcl[$i]->newprice11 == null || $pcl[$i]->newprice11 == ""){}else {echo number_format((float)$pcl[$i]->newprice11,2,'.',',');}?></td>
                </tr>
                <?php } ?>                                                                          
            </table>            
        </div>       
        
    </body>
    
</html>