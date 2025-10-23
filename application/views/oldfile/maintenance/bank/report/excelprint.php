<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=BankInformation.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
    
    <table style="margin: 0 auto;">
        <tr>
            <td colspan="6" style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">             
                <h2><?php echo $com[0]->companyname;?></h2>                
            </td>            
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;" >                
                <?php echo $com[0]->address;?>                        
            </td>            
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;" >                
                Bank Information              
            </td>             
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
    <div>
        <table style="width: 100%;margin: 0 auto;" width="500px">
                <tr>
                    <td col="6" style="text-transform: capitalize;"><strong>Bank Name:          <?php echo $bank[0]->bankname;?></strong></td>                    
                </tr>
                <tr>                    
                    <td col="6" style="text-transform: capitalize;"><strong>Address:            <?php echo $bank[0]->address;?></strong></td>                    
                </tr> 
                <tr>                    
                    <td col="6" style="text-transform: capitalize;"><strong>Current Balance:    Php <?php echo number_format((float)$bank[0]->currentbal,2,'.',',');?></strong></td>
                </tr> 
            </table>
            
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">
                <tr>  
                    <td style="text-align: center;border: 1px solid;"><strong>#</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Date</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Description</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Deposit</strong></td>      
                    <td style="text-align: center;border: 1px solid;"><strong>Withdrawal</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Balance</strong></td>
                </tr> 
                
                <?php if($bh == null) {}else { ?>
                <?php for($i=0; $i<count($bh); $i++) { ?>                    
                <tr>   
                    <td style="text-align: center;"><?php echo $bh[$i]->bh_no;?></td>
                    <td style="text-align: center;"><?php echo $bh[$i]->date;?></td>
                    <td style="text-align: center;"><?php echo $bh[$i]->description;?></td> 
                    <td style="text-align: center;"><?php echo number_format((float)$bh[$i]->inamount,2,'.',',');?></td> 
                    <td style="text-align: center;"><?php echo number_format((float)$bh[$i]->outamount,2,'.',',');?></td> 
                    <td style="text-align: center;"><?php echo number_format((float)$bh[$i]->balance,2,'.',',');?></td> 
                </tr>
                <?php } }?> 
                
            </table>
    </div>