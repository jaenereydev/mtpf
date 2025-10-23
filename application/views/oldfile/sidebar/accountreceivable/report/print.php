<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('accountreceivable_con/arview')?>">
        <title>Print Account Receivable</title>
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
                <h2>Account Receivable</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">
                <tr>
                    <td><div style="vertical-align: top; font-size: 15px;"><strong>Customer : <?php echo $ar[0]->name;?></strong></div></td> 
                    <td style="text-align: right;"><strong>Ref No.</strong> <strong><?php  echo $ar[0]->ref_no;?></strong></div></td>                                        
                </tr> 
                <tr>
                    <td><strong>O.R. No.</strong> <strong><?php  echo $ar[0]->or_no;?></strong></div></td>
                    <td style="text-align: right;"><strong>Date</strong> <strong><?php  echo date_format(date_create($ar[0]->date), "m/d/Y");?></strong></div></td>                                        
                </tr> 
            </table>
            <hr>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
                <tr>    
                    <td style="text-align: center;">
                        <table style="width: 100%;">
                            <tr>
                                <td colspan="3">Credit Information</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;border: 1px solid;" ><strong>Ref No.</strong></td>                     
                                <td style="text-align: center;border: 1px solid;" ><strong>C.I. No.</strong></td>
                                <td style="text-align: center;border: 1px solid;" ><strong>Amount</strong></td>
                            </tr>                        
                            <?php for($p=0;$p<count($cpl);$p++) { ?>
                                <tr>
                                    <td style="text-align: center;border-bottom: 1px solid;" ><?php echo $cpl[$p]->ref_no;?></td>
                                    <td style="text-align: center;border-bottom: 1px solid;" ><?php echo $cpl[$p]->ci_no;?></td>
                                    <td style="text-align: center;border-bottom: 1px solid;" ><?php echo number_format((float)$cpl[$p]->amount,2,'.',',');?></td>                            
                                </tr>
                            <?php }?>
                            <tr>
                                <td style="text-align: right;"colspan="2" >Total</td>
                                <td style="text-align: center;" ><?php echo $sumcpl[0]->amount;?></td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align: center;">
                        <table style="width: 100%;">
                        <tr>
                            <td colspan="2">Payment Information</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;border: 1px solid;" ><strong>Description</strong></td> 
                            <td style="text-align: center;border: 1px solid;" ><strong>Amount</strong></td>
                        </tr>                        
                        <?php for($p=0;$p<count($pr);$p++) { ?>
                            <tr>
                                <td style="text-align: center;border-bottom: 1px solid;" ><?php echo $pr[$p]->description; if($pr[$p]->description == "CHECK"){ echo " - "; echo $pr[$p]->checkno; echo " "; echo $pr[$p]->checkdate; echo " "; echo $pr[$p]->bankname;}?></td>
                                <td style="text-align: center;border-bottom: 1px solid;" ><?php echo number_format((float)$pr[$p]->amount,2,'.',',');?></td>                            
                            </tr>
                        <?php }?>
                        <tr>
                            <td style="text-align: right;" >Total</td>
                            <td style="text-align: center;" ><?php echo $sumpr[0]->amount;?></td>
                        </tr>
                    </table>
                    </td>
                </tr>                                 
            </table>            
        </div>
        <div style="width: 100%;height: 100px;position: absolute;bottom: 0;left: 0;">
            <table style="width: 100%;border: 1px solid; font-size: 10px;" >
                <tr>
                    <td style="border: 1px solid;">Created by: <?php echo $user[0]->fname;?></td>
                    <td style="border: 1px solid;">Date: <?php echo date('m/d/Y'); ?></td>
                    <td style="border: 1px solid;">Remarks:<?php echo $ar[0]->remarks;?></td>
                </tr>
            </table>
        </div>       
        
    </body>
    
</html>