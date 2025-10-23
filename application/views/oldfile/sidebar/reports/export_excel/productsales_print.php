<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Productsalesreport(". $from ."-". $to.").xls");
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
                Product Sales Report              
            </td>             
        </tr>
        </table><!-- End of Heading -->        
        
      
    <div>
        <table style="width: 100%;margin: 0 auto;" width="500px">               
            <tr>
                <tr>
                    <td colspan="2"><strong>Category: </strong> <strong><?php if($cno == 'all'){ echo "ALL";                        
                                            }else { 
                                                for($c=0;$c<count($cat);$c++){ 
                                                    if($cno == $cat[$c]->c_no){ 
                                                        echo $cat[$c]->description;                                                         
                                            }}}?>
                    </strong></td>       
                    <td colspan="2"><strong>From: </strong> <strong><?php  echo $from;?></strong></td>                                        
                    <td colspan="2"><strong>To: </strong> <strong><?php  echo $to;?></strong></td>                                        
                </tr> 
            </tr>
        </table>
        
        <?php if($prod == null) {?>
                <p class="text-center">No Sales Data available.</p>    
            <?php }else { ?>
            <legend>Sales Transaction</legend>
            <table style="width: 100%;margin: 0 auto; font-size: 14px; margin-top: 5px;" >    
                <tr>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Date</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Products</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Unit Price</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Qty</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>SRP</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Total</strong></td>                    
                </tr>                
                
                <?php for($p=0;$p<count($prod);$p++) { ?>
                    <tr>                                         
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $prod[$p]->date;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $prod[$p]->longdesc;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->unitprice,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->qty,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->price,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prod[$p]->qty*$prod[$p]->price,2,'.',',');?></td>                        
                    </tr>        
                <?php }?> 
                    <tr>
                        <td style="border-top: 1px solid;text-align: right;text-transform: capitalize;" colspan="3" ><strong>Total</strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumprod[0]->qty,2,'.',',');?></strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumprod[0]->price,2,'.',',');?></strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumprod[0]->totalamount,2,'.',',');?></strong></td>
                    </tr>    
            </table>  
            <?php }?>             
            <?php if($creditprod == null) {?>
                <p class="text-center">No Credit Data available.</p>    
            <?php }else { ?>
            <legend>Credit Sales Transaction</legend>
            <table style="width: 100%;margin: 0 auto; font-size: 14px; margin-top: 5px;">                                                
                <tr>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Date</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Products</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Unit Price</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Qty</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>SRP</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Total</strong></td>                    
                </tr>
                <?php for($p=0;$p<count($creditprod);$p++) { ?>
                    <tr>                                         
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $creditprod[$p]->date;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $creditprod[$p]->longdesc;?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->unitprice,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->qty,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->price,2,'.',',');?></td>
                        <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$creditprod[$p]->qty*$creditprod[$p]->price,2,'.',',');?></td>                        
                    </tr>        
                <?php }?>  
                    <tr>
                        <td style="border-top: 1px solid;text-align: right;text-transform: capitalize;" colspan="3" ><strong>Total</strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumcreditprod[0]->qty,2,'.',',');?></strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumcreditprod[0]->price,2,'.',',');?></strong></td>
                        <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;" ><strong><?php echo number_format((float)$sumcreditprod[0]->totalamount,2,'.',',');?></strong></td>
                    </tr>    
            </table>    
            <?php }?>
    </div>