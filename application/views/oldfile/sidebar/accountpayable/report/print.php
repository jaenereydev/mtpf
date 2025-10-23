<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('accountpayable_con/accountpayableview')?>">
        <title>Print Receiving Good/s from the Supplier</title>
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
                <h2>Account Payable</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
        <div>
            <table style="width: 100%;margin: 0 auto; border: 1px solid; font-size: 10px;" width="500px">
                <tr>
                    <td rowspan="2" colspan="2"><div style="text-decoration: underline;vertical-align: top; font-size: 15px;"><strong>Suppier Name:</strong></div><br><span style="font-size: 20px;text-transform: capitalize;"><strong><?php for($s=0;$s<count($sup);$s++){if($ap[0]->s_no == $sup[$s]->s_no){echo $sup[$s]->name;}}?></strong></span></td>                    
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                    
                    <td style="border: 1px solid;"><div><strong>Date:</strong> <div style="text-align: right;font-size: 12px;"><storng><?php echo $ap[0]->date;?></storng></div></div></td>                    
                </tr> 
                <tr>
                    <td></td>
                    <td style="border: 1px solid;">
                        <div><strong>Doc. No.:</strong> <div style="text-align: right;font-size: 12px;"><strong><?php echo $ap[0]->ref_no;?></strong></div></div>
                    </td>
                </tr>               
            </table>
            
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">
                <tr>
                    <td style="text-align: center;border: 1px solid;">Ref. No.</td>                    
                    <td style="text-align: center;border: 1px solid;">Delivery Date</td>                    
                    <td style="text-align: center;border: 1px solid;">Amount</td>                    
                </tr>
                <?php for($i=0;$i<count($apl);$i++){?>
                <tr>
                    <td style="text-align: center;"><?php echo $apl[$i]->ref_no;?></td>                    
                    <td style="text-align: center;"><?php echo $apl[$i]->deldate;?></td>                    
                    <td style="text-align: center;"><?php echo number_format((float)$apl[$i]->delamount,2,'.',',');?></td>                                
                </tr>
                <?php }?>
                <tr>
                    <td style="border-top: 1px solid;"></td>
                    <td style="border-top: 1px solid;text-align: right;">SUBTOTAL</td>                                        
                    <td style="border-top: 1px solid;text-align: center;"><?php echo number_format((float)$aplsum[0]->delamount,2,'.',',');?></td>
                </tr>
                <tr>
                    <td ></td>
                    <td style="text-align: right;">Addition Amount</td>                                        
                    <td style="border-top: 1px solid;text-align: center;"><?php echo number_format((float)$ap[0]->additionalamount,2,'.',',');?></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">Discount Amount</td>                                        
                    <td style="border-top: 1px solid;text-align: center;"><?php echo number_format((float)$ap[0]->discountamount,2,'.',',');?></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid;"></td>
                    <td style="border-top: 1px solid;text-align: right;"><strong>Grand Total</strong></td>                                        
                    <td style="border-top: 1px solid;text-align: center;"><?php echo number_format((float)$ap[0]->grandtotal,2,'.',',');?></td>
                </tr>
            </table>
            
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                                                
                <tr>                                                 
                    <td style="text-align: center;border: 1px solid;"><strong>Mode of Payment</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Check Number</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Check Date</strong></td>     
                    <td style="text-align: center;border: 1px solid;"><strong>Bank Name</strong></td>  
                    <td style="text-align: center;border: 1px solid;"><strong>Amount</strong></td>
                    
                </tr> 
                <?php for($i=0; $i<count($cr); $i++) { ?>                    
                <tr>                    
                    <td style="text-align: center;text-transform: capitalize"><?php if($cr[$i]->checkno == null || $cr[$i]->checkno == ""){ echo "Cash"; }else{ echo "Check";}?></td>
                    <td style="text-align: center;text-transform: capitalize"><?php echo $cr[$i]->checkno;?></td>
                    <td style="text-align: center;text-transform: capitalize"><?php echo $cr[$i]->checkdate;?></td>
                    <td style="text-align: center;text-transform: capitalize"><?php echo $cr[$i]->bankname;?></td>
                    <td style="text-align: center;text-transform: capitalize"><?php echo number_format((float)$cr[$i]->checkamount,2,'.',',');?></td>
                </tr>
                <?php } ?>                         
                <tr>
                    <td style="text-align: center;border-top: 1px solid;"></td> 
                    <td style="text-align: center;border-top: 1px solid;"></td>
                    <td style="text-align: center;border-top: 1px solid;"></td>
                    <td style="text-align: center;border-top: 1px solid;"><strong>Total Payment</strong></td>
                    <td style="text-align: center;border-top: 1px solid;"><?php echo number_format((float)$crsum[0]->amount,2,'.',',');?></td>
                </tr>                                  
            </table>
        </div>
        
        <div style="width: 100%;height: 100px;position: absolute;bottom: 0;left: 0;">
            <table style="width: 100%;border: 1px solid; font-size: 10px;" >
                <tr>
                    <td style="border: 1px solid;">Created by: <?php for($u=0;$u<count($users);$u++){ if($ap[0]->u_no == $users[$u]->u_no){echo $users[0]->fname;}}?></td>
                    <td style="border: 1px solid;">Date: <?php echo date('m/d/Y'); ?></td>
                    <td style="border: 1px solid;">Remarks: <?php echo $ap[0]->remarks; ?></td>
                </tr>
            </table>
        </div>       
        
    </body>
    
</html>