<html>
    <head>
        <meta http-equiv="refresh" content="0; url=<?=site_url('productinventory_con')?>">
        <title>Print Product Sales Inventory</title>
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
                <h2>Product Sales Inventory Report</h2>
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
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Products</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>SALES</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>CREDIT</strong></td>   
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Total</strong></td>
                </tr>
                <?php   $sales = 0;
                        $credit = 0;
                        $total = 0; 
                    for($p=0;$p<count($prod);$p++) { ?>
                <tr>                         
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $prod[$p]->longdesc;?></td> 
                    <?php for($h=0;$h<count($prodh);$h++) {
                        if ($prodh[$h]->p_no == $prod[$p]->p_no) { 
                            $sales += $prodh[$h]->SALES;
                            $credit += $prodh[$h]->CREDIT;
                            $total += ($prodh[$h]->SALES+$prodh[$h]->CREDIT);
                            ?>        
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->SALES,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->CREDIT,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)($prodh[$h]->SALES+$prodh[$h]->CREDIT),2,'.',',');?></td>
                        <?php } ?>

                        <?php }?>
                </tr>
                <?php }?> 
                <tr class="text-center">
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><strong>Total</strong></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($sales == null || $sales == "0"){ echo "0.00";}else { echo number_format((float)$sales,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($credit == null || $credit == "0"){ echo "0.00";}else { echo number_format((float)$credit,2,'.',',');}?></td>
                    <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($total == null || $total == "0"){ echo "0.00";}else { echo number_format((float)$total,2,'.',',');}?></td>
                </tr>
            </table>            
        </div>
    </body>
    
</html>