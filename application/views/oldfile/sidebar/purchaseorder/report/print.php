<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('purchaseorder_con/orderingview')?>">
        <title>Print Purchase Order</title>
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
                <h2>Purchase Order</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
        <div>
            <table style="width: 100%;margin: 0 auto; border: 1px solid; font-size: 10px;" width="500px">
                <tr>
                    <td rowspan="2"><div style="text-decoration: underline;vertical-align: top; font-size: 15px;"><strong>Suppier Name:</strong></div><br><span style="font-size: 20px;text-transform: capitalize;"><strong><?php for($s=0;$s<count($sup);$s++){if($po[0]->s_no == $sup[$s]->s_no){echo $sup[$s]->name;}}?></strong></span></td>
                    <td style="border: 1px solid;"><h3>P.O. No.:</h3> <div style="text-align: right;font-size: 20px;"><strong><?php echo $po[0]->ref_no;?></strong></div></td>
                </tr> 
                <tr>
                    <td style="border: 1px solid;"><strong>Delivery Date:</strong> <div style="text-align: right;font-size: 13px;"><storng><?php echo $po[0]->deliverydate;?></storng></div></td>
                </tr>
            </table>
            <table style="width: 100%;margin: 0 auto; font-size: 10px; margin-top: 5px;" width="500px">
                <tr>
                    <td style="text-align: center;border: 1px solid;">Product Name</td> 
                    <td style="text-align: center;border: 1px solid;">UOM</td>
                    <td style="text-align: center;border: 1px solid;">Qty</td>
                    <td style="text-align: center;border: 1px solid;">PCS</td>
                    <td style="text-align: center;border: 1px solid;">Unit Price</td>
                    <td style="text-align: center;border: 1px solid;">Total Amount</td>                    
                </tr>
                <?php for($i=0;$i<count($pol);$i++){?>
                <tr>
                    <td style="text-transform: capitalize"><?php echo $pol[$i]->longdesc;?></td> 
                    <td style="text-align: center;text-transform: capitalize;"><?php echo $pol[$i]->uom; echo " "; echo $pol[$i]->packing;?></td>
                    <td style="text-align: center;"><?php echo number_format((float)$pol[$i]->qty,2,'.',',');?></td>
                    <td style="text-align: center;"><?php echo number_format((float)$pol[$i]->pcs,2,'.',',');?></td>
                    <td style="text-align: center;"><?php echo number_format((float)$pol[$i]->unitprice,2,'.',',');?></td>
                    <td style="text-align: center;"><?php echo number_format((float)$pol[$i]->totalamount,2,'.',',');?></td>                                
                </tr>
                <?php }?>
                <tr>
                    <td style="border-top: 1px solid;"><strong>TOTAL</strong></td>
                    <td style="border-top: 1px solid;"></td>
                    <td style="border-top: 1px solid; text-align: center;text-transform: capitalize;"><?php echo number_format((float)$polsum[0]->totalqty,2,'.',',');?></td>
                    <td style="border-top: 1px solid; text-align: center;"><?php echo number_format((float)$polsum[0]->totalpcs,2,'.',',');?></td>
                    <td style="border-top: 1px solid;"></td>
                    <td style="border-top: 1px solid;text-align: center;"><strong><?php echo number_format((float)$polsum[0]->totalamount,2,'.',',');?></strong></td>
                </tr>
            </table>
        </div>
        <div style="width: 100%;height: 100px;position: absolute;bottom: 0;left: 0;">
            <table style="width: 100%;border: 1px solid; font-size: 10px;" >
                <tr>
                    <td style="border: 1px solid;">Created by: <?php for($u=0;$u<count($users);$u++){ if($po[0]->u_no == $users[$u]->u_no){echo $users[0]->fname;}}?></td>
                    <td style="border: 1px solid;">Date: <?php echo date('m/d/Y'); ?></td>
                    <td style="border: 1px solid;">Remarks: <?php echo $po[0]->remarks; ?></td>
                </tr>
            </table>
        </div>       
        
    </body>
    
</html>