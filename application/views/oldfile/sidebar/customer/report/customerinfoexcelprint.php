<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=CustomerInformation.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
    
<table style="margin: 0 auto;">
        <tr>            
            <td colspan="8" style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">                
                <h2><?php echo $com[0]->companyname;?></h2>             
            </td>            
            
        </tr>
        <tr>
            <td colspan="8" style="text-align: center;"><?php echo $com[0]->address;?></td>
        </tr>
        <tr>            
            <td colspan="8" style="text-align: center; font-size: 15px;"><strong>Customer Information</strong></td>
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
    <div>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                
                <tr>                                             
                    <td style="text-align: left;text-transform: capitalize;" colspan="7"><strong><?php echo $cus[0]->name;?></strong></td>                          
                   <td style="text-align: Right;"><strong>Total Credit <?php if($cus[0]->totalcredit == null || $cus[0]->totalcredit == ""){ echo "0.00";}else { echo number_format((float)$cus[0]->totalcredit,2,'.',',');}?></strong></td>                  
                </tr>   
                <tr>
                    <td style="text-align: left;" colspan="8"><strong>Tel #: <?php echo $cus[0]->telno;?></strong></td>
                </tr>
            </table>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                
                 <tr>                       
                    <td style="text-align: center;border: 1px solid;"><strong>#</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Date</strong></td>       
                    <td style="text-align: center;border: 1px solid;"><strong>Doc #</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Description</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Amount Credit</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Amount Sales</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Remaining Balance</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>User</strong></td>
                  </tr>                 
                <?php for($i=0; $i<count($cushist); $i++) { ?>                    
                <tr>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $cushist[$i]->ch_no;?></td>                        
                    <td style="text-align: center; text-transform: capitalize"><?php echo $cushist[$i]->date;?></td>                        
                    <td style="text-align: center; text-transform: capitalize"><?php echo $cushist[$i]->doc_no;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $cushist[$i]->description;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $cushist[$i]->amountcredit;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $cushist[$i]->amountsales;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $cushist[$i]->remainingcredit;?></td>                                    
                    <td style="text-align: center; text-transform: capitalize"><?php if($users[0]->u_no == $cushist[$i]->user){ echo $users[0]->fname;}?></td>
                </tr>
                <?php } ?>                              
            </table>
        </div>