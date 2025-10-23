<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=ProductInformation.xls");
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
            <td colspan="6" style="text-align: center;"><?php echo $com[0]->address;?></td>
        </tr>
        <tr>            
            <td colspan="6" style="text-align: center; font-size: 15px;"><strong>Product Information</strong></td>
        </tr>
        </table><!-- End of Heading -->  
      
    <div>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                
                <tr>                                             
                   <td colspan="5" style="text-align: left;text-transform: capitalize;"><strong><?php echo "#"; echo $prod[0]->p_no; echo " "; echo $prod[0]->longdesc;?></strong></td>       
                   <td style="text-align: Right;"><strong><?php echo $prod[0]->description;?></strong></td>                  
                </tr>   
                <tr>
                    <td colspan="6" style="text-align: left;"><strong><?php echo $prod[0]->name;?></strong></td>
                </tr>
            </table> 
            <strong>Product History</strong>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                                 
                <tr>                                             
                    <td style="text-align: center;border: 1px solid;"><strong>Date</strong></td>                         
                    <td style="text-align: center;border: 1px solid;"><strong>Ref. No.</strong></td>                        
                    <td style="text-align: center;border: 1px solid;"><strong>Description</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>In</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Out</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Balance</strong></td>
                  </tr> 
                <?php for($i=0; $i<count($prodhist); $i++) { ?>                    
                <tr>                          
                    <td style="text-align: center; text-transform: capitalize"><?php echo $prodhist[$i]->date;?></td>                        
                    <td style="text-align: center; text-transform: capitalize"><?php echo $prodhist[$i]->ref_no;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php $prodhist[$i]->description?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo number_format((float)$prodhist[$i]->instock,2,'.',',');?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo number_format((float)$prodhist[$i]->outstock,2,'.',',');?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo number_format((float)$prodhist[$i]->rqty,2,'.',',');?></td>                    
                </tr>
                <?php } ?>     
            </table>
            <?php if($pc == null) {}else { ?>
            <strong>Product Price Change Transaction</strong>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                                 
                <tr>                                    
                    <td style="text-align: center;border: 1px solid;"><strong>#</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Requested By</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Date</strong></td>                        
                    <td style="text-align: center;border: 1px solid;"><strong>Effective Date</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Posted</strong></td> 
                </tr> 
                <?php for($i=0; $i<count($pc); $i++) { ?>                                
                <tr>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->ref_no;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->requestedby;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->date;?></td>
                    <td style="text-align: center; text-transform: capitalize"><?php echo $pc[$i]->effectivedate;?></td>
                    <td style="text-align: center; text-transform: capitalize"><strong><?php echo $pc[$i]->stat;?></strong></td>
                </tr>
                <?php } ?>    
            </table>
            <?php }?>
        </div>        
        </div>