<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=AllProduct.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
    
<table style="margin: 0 auto;">
        <tr>
            <td colspan="7" style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">             
                <h2><?php echo $com[0]->companyname;?></h2>                
            </td>            
        </tr>
        <tr>
            <td colspan="7" style="text-align: center;" >                
                <?php echo $com[0]->address;?>                        
            </td>            
        </tr>
        <tr>
            <td colspan="7" style="text-align: center;" >                
                Supplier File                
            </td>             
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
    <div>
        <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                        
            <tr>                                                                    
                <td style="text-align: center;border: 1px solid;" ><strong>#</strong></td>                         
                <td style="text-align: center;border: 1px solid;" ><strong>Product Name</strong></td>
                <td style="text-align: center;border: 1px solid;" ><strong>UOM /Packing</strong></td>
                <td style="text-align: center;border: 1px solid;" ><strong>Quantity(PCS)</strong></td>
                <td style="text-align: center;border: 1px solid;" ><strong>Retail Price</strong></td>
                <td style="text-align: center;border: 1px solid;" ><strong>Wholesale Price</strong></td>  
                <td style="text-align: center;border: 1px solid;"><strong>Discounted Price</strong></td>  
            </tr> 
            <?php for($i=0; $i<count($prod); $i++) { ?>                    
            <tr>                         
                <td style="text-transform: capitalize;text-align: center;"><?php echo $prod[$i]->p_no;?></td>                        
                <td style="text-transform: capitalize;text-align: left;"><?php echo $prod[$i]->longdesc;?></td>
                <td style="text-transform: capitalize;text-align: center;"><?php echo $prod[$i]->uom; echo " - "; echo $prod[$i]->packing; ?></td>                    
                <td style="text-transform: capitalize;text-align: center;"><?php echo number_format((float)$prod[$i]->qty,0,'.',',');?></td>
                <td style="text-transform: capitalize;text-align: center;"><?php echo number_format((float)$prod[$i]->price1,2,'.',',');?></td>
                <td style="text-transform: capitalize;text-align: center;"><?php echo number_format((float)$prod[$i]->price2,2,'.',',');?></td>
                <td style="text-transform: capitalize;text-align: center;"><?php echo number_format((float)$prod[$i]->price11,2,'.',',');?></td>
            </tr>
            <?php } ?> 
        </table>
    </div>