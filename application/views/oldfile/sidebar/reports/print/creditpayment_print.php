<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('creditpayment_con')?>">
        <title>Print Customer Credit Payment Report</title>
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
                <h2>Customer Credit Payment Report</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->                     
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">                               
                <tr>
                    <td style="text-transform: capitalize;"><strong>Customer: </strong> <strong><?php if($cno == 'all'){ echo "ALL";                        
                                            }else { 
                                                for($c=0;$c<count($cus);$c++){ 
                                                    if($cno == $cus[$c]->c_no){ 
                                                        echo $cus[$c]->name;                                                         
                                            }}}?>
                    </strong></td>       
                    <td><strong>From: </strong> <strong><?php  echo $from;?></strong></td>                                        
                    <td><strong>To: </strong> <strong><?php  echo $to;?></strong></td>                                        
                </tr> 
            </table>
            <hr>            
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
                <tr>
                    <?php if($cno == 'all') { ?>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Name</strong></td>
                    <?php } else {}?>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Ref. No.</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Date</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Description</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Amount</strong></td>                 
                </tr>                
                
                <?php for($p=0;$p<count($pay);$p++) { ?>
                    <tr>    
                        <?php if($cno == 'all') { ?>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $pay[$p]->name;?></td>
                        <?php } else {}?>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $pay[$p]->ref_no;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $pay[$p]->date;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $pay[$p]->description;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$pay[$p]->amount,2,'.',',');?></td>                                  
                    </tr>
                <?php }?>
                
                    <tr>
                        <td style="border-top: 1px solid;text-align: right;text-transform: capitalize;" <?php if($cno == 'all') { ?>colspan="4"<?php } else { ?>colspan="3" <?php }?> ><strong>Total Cash</strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumcash[0]->amount,2,'.',',');?></strong></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid;text-align: right;text-transform: capitalize;" <?php if($cno == 'all') { ?>colspan="4"<?php } else { ?>colspan="3" <?php }?> ><strong>Total Check</strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumcheck[0]->amount,2,'.',',');?></strong></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid;text-align: right;text-transform: capitalize;" <?php if($cno == 'all') { ?>colspan="4"<?php } else { ?>colspan="3" <?php }?> ><strong>Total Amount</strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumcash[0]->amount+$sumcheck[0]->amount,2,'.',',');?></strong></td>
                    </tr>
            </table>  
                  
        </div>
    </body>
    
</html>