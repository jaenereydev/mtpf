<html>
    <head>
        <meta http-equiv="refresh" content="0; url=<?=site_url('dailyinventory_con')?>">
        <title>Print Daily Inventory</title>
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
                <h2>Daily Inventory Report</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">               
                <tr>
                    <td><strong>Category: </strong> <strong><?php if($cno == 'all'){ echo "ALL";                        
                                            }else { 
                                                for($c=0;$c<count($cat);$c++){ 
                                                    if($cno == $cat[$c]->c_no){ 
                                                        echo $cat[$c]->description;                                                         
                                            }}}?>
                    </strong></td>                                        
                </tr>
                <tr>
                    <td><strong>Date: </strong> <strong><?php  echo $d;?></strong></td>                                        
                </tr> 
            </table>
            <hr>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
                 <tr >
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2" ><strong>Products</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>BEGINNING INVENTORY</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>RECEIVED</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>CLASSIFYING</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="1" colspan="2"><strong>MILLED</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>SALES</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>CREDIT</strong></td>      
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="1" colspan="2"><strong>ADJUSTMENT</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>DISPOSE</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>Total</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>ACTUAL INVENTORY</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" rowspan="2"><strong>Variance</strong></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;">(+)</td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;">(-)</td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;">(+)</td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;">(-)</td>
                </tr>
                <?php   $inv = 0; 
                        $rec = 0;
                        $clas = 0; 
                        $inmil = 0;
                        $outmil = 0;
                        $sales = 0;
                        $credit = 0;
                        $inadj = 0;
                        $outadj = 0;
                        $disposed = 0;
                        $tolal = 0;
                        $actinv = 0;
                        $var = 0;
                    for($p=0;$p<count($prod);$p++) { ?>
                <tr>                         
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $prod[$p]->longdesc;?></td> 
                    <?php for($h=0;$h<count($prodh);$h++) {
                        if ($prodh[$h]->p_no == $prod[$p]->p_no) { 
                        $inv += $prodh[$h]->INVENTORY; 
                        $rec += $prodh[$h]->RECEIVED;
                        $clas += $prodh[$h]->CLASSIFYING; 
                        $inmil += $prodh[$h]->INMILLED;
                        $outmil += $prodh[$h]->OUTMILLED;
                        $sales += $prodh[$h]->SALES;
                        $credit += $prodh[$h]->CREDIT;
                        $inadj += $prodh[$h]->INADJUSTMENT;
                        $outadj += $prodh[$h]->OUTADJUSTMENT;
                        $disposed += $prodh[$h]->DISPOSED;
                        $tolal += ($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED);
                        $actinv += $prodh[$h]->ACTUALINVENTORY;
                        $var += (($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY;
                                ?>                                           
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->INVENTORY,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->RECEIVED,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->CLASSIFYING,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->INMILLED,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->OUTMILLED,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->SALES,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->CREDIT,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->INADJUSTMENT,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->OUTADJUSTMENT,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->DISPOSED,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED),2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->ACTUALINVENTORY,2,'.',',');?></td>                            
                        <?php if(((($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY) < 0){ ?>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;">
                        <?php }else if(((($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY) > 0){?>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;">
                        <?php }else {?>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;">
                        <?php }?>
                        <?php echo number_format((float)(($prodh[$h]->INVENTORY+$prodh[$h]->RECEIVED+$prodh[$h]->CLASSIFYING+$prodh[$h]->INMILLED+$prodh[$h]->INADJUSTMENT)-($prodh[$h]->SALES+$prodh[$h]->CREDIT+$prodh[$h]->OUTADJUSTMENT+$prodh[$h]->DISPOSED))-$prodh[$h]->ACTUALINVENTORY,2,'.',',');?></td>
                        <?php } ?>

                        <?php }?>
                </tr>
                <?php }?> 
                <tr class="text-center">
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;">Total</td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($inv == null || $inv == "0"){ echo "0.00";}else{ echo number_format((float)$inv,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($rec == null || $rec == "0"){ echo "0.00";}else{ echo number_format((float)$rec,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($clas == null || $clas == "0"){ echo "0.00";}else{ echo number_format((float)$clas,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($inmil == null || $inmil == "0"){ echo "0.00";}else{ echo number_format((float)$inmil,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($outmil == null || $outmil == "0"){ echo "0.00";}else{ echo number_format((float)$outmil,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($sales == null || $sales == "0"){ echo "0.00";}else{ echo number_format((float)$sales,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($credit == null || $credit == "0"){ echo "0.00";}else{ echo number_format((float)$credit,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($inadj == null || $inadj == "0"){ echo "0.00";}else{ echo number_format((float)$inadj,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($outadj == null || $outadj == "0"){ echo "0.00";}else{ echo number_format((float)$outadj,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($disposed == null || $disposed == "0"){ echo "0.00";}else{ echo number_format((float)$disposed,2,'.',',');}?></td>                        
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($tolal == null || $tolal == "0"){ echo "0.00";}else{ echo number_format((float)$tolal,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($actinv == null || $actinv == "0"){ echo "0.00";}else{ echo number_format((float)$actinv,2,'.',',');}?></td>
                    <?php if($var < 0) { ?>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" class="text-center danger">
                    <?php }else if($var > 0) { ?> 
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" class="text-center warning">
                    <?php }else { ?>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;">
                    <?php }?>
                        <?php if($var == null || $var == "0"){ echo "0.00";}else{ echo number_format((float)$var,2,'.',',');}?></td>
                </tr>
            </table>            
        </div>
    </body>
    
</html>