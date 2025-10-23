<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=InventoryCostReport.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
    
<table style="margin: 0 auto;">
        <tr>
            <td colspan="5" style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">             
                <h2><?php echo $com[0]->companyname;?></h2>                
            </td>            
        </tr>
        <tr>
            <td colspan="5" style="text-align: center;" >                
                <?php echo $com[0]->address;?>                        
            </td>            
        </tr>
        <tr>
            <td colspan="5" style="text-align: center;" >                
                INVENTORY COST REPORT BASED ON CURRENT STOCKS             
            </td>             
        </tr>
        </table><!-- End of Heading -->        
        
      
    <div>
        <table style="width: 100%;margin: 0 auto;" width="500px">               
            <tr>
                <tr>
                    <td colspan="3"><strong>Supplier: </strong> <strong><?php if($sno == 'all'){ echo "ALL";                        
                                            }else { 
                                                for($c=0;$c<count($sup);$c++){ 
                                                    if($sno == $sup[$c]->s_no){ 
                                                        echo $sup[$c]->name;                                                         
                                            }}}?>
                    </strong></td>  
                    <td colspan="3"><strong>Category: </strong> <strong><?php if($cno == 'all'){ echo "ALL";                        
                                            }else { 
                                                for($c=0;$c<count($cat);$c++){ 
                                                    if($cno == $cat[$c]->c_no){ 
                                                        echo $cat[$c]->description;                                                         
                                            }}}?>
                    </strong></td>                                               
                </tr> 
            </tr>
        </table>
        
        <?php if($prod == null) {?>
            <p class="text-center">No Data available.</p>    
        <?php }else { ?>
        <table style="width: 100%;margin: 0 auto; margin-top: 5px;" >                   
                     <tr>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>#</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Products</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Amount</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Qty on Hand</strong></td>
                        <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Total  Cost</strong></td>
                    </tr>    
              
                <?php for($p=0;$p<count($prod);$p++) { ?>                    
                    <tr>                                         
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $prod[$p]->p_no;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $prod[$p]->longdesc;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->price1,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->qty,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->qty*$prod[$p]->price1,2,'.',',');?></td>                        
                    </tr>  
                <?php }?> 
                    <tr>
                        <td style="border-top: 1px solid;text-align: right;text-transform: capitalize;" colspan="3" ><strong>Total</strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumprod[0]->qty,2,'.',',');?></strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumprod[0]->total,2,'.',',');?></strong></td>
                    </tr>    
            </table> 
        <?php }?>             
            
    </div>