<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Creditpaymemtreport(". $from ."-". $to.").xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
    
<table style="margin: 0 auto;">
        <tr>
            <td <?php if($cno == 'all') { ?>colspan="5"<?php } else { ?>colspan="4" <?php }?> style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">             
                <h2><?php echo $com[0]->companyname;?></h2>                
            </td>            
        </tr>
        <tr>
            <td <?php if($cno == 'all') { ?>colspan="5"<?php } else { ?>colspan="4" <?php }?> style="text-align: center;" >                
                <?php echo $com[0]->address;?>                        
            </td>            
        </tr>
        <tr>
            <td <?php if($cno == 'all') { ?>colspan="5"<?php } else { ?>colspan="4" <?php }?> style="text-align: center;" >                
                Customer Credit Payment Report              
            </td>             
        </tr>
        </table><!-- End of Heading -->        
        
      
    <div>
        <table style="width: 100%;margin: 0 auto;" width="500px">               
            <tr>
                <tr>
                   <td <?php if($cno == 'all') { ?>colspan="3"<?php } else { ?>colspan="2" <?php }?> style="text-transform: capitalize;"><strong>Customer: </strong> <strong><?php if($cno == 'all'){ echo "ALL";                        
                                            }else { 
                                                for($c=0;$c<count($cus);$c++){ 
                                                    if($cno == $cus[$c]->c_no){ 
                                                        echo $cus[$c]->name;                                                         
                                            }}}?>
                    </strong></td>       
                    <td><strong>From: </strong> <strong><?php  echo $from;?></strong></td>                                        
                    <td><strong>To: </strong> <strong><?php  echo $to;?></strong></td>                                         
                </tr> 
            </tr>
        </table>
        
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