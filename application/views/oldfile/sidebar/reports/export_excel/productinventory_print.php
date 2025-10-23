<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Productsalesinventoy". $d .".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
    
<table style="margin: 0 auto;">
        <tr>
            <td colspan="4" style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">             
                <h2><?php echo $com[0]->companyname;?></h2>                
            </td>            
        </tr>
        <tr>
            <td colspan="4" style="text-align: center;" >                
                <?php echo $com[0]->address;?>                        
            </td>            
        </tr>
        <tr>
            <td colspan="4" style="text-align: center;" >                
                Product Sales Inventory                
            </td>             
        </tr>
        </table><!-- End of Heading -->        
        
      
    <div>
        <table style="width: 100%;margin: 0 auto;" width="500px">               
            <tr>
                <td colspan="3"><strong>Category: </strong> <strong><?php if($cno == 'all'){ echo "ALL";                        
                                        }else { 
                                            for($c=0;$c<count($cat);$c++){ 
                                                if($cno == $cat[$c]->c_no){ 
                                                    echo $cat[$c]->description;                                                         
                                        }}}?>
                </strong></td>          
                <td><strong>Date: </strong> <strong><?php  echo $d;?></strong></td>  
            </tr>
        </table>
        
        <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" >    
             <tr >
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Products</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>SALES</strong></td>
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>CREDIT</strong></td>   
                    <td style="vertical-align: middle;text-align: center;border: 1px solid;" ><strong>Total</strong></td>
            </tr>
            <?php   $sales = 0;
                    $credit = 0;
                    $total = 0; 
                for($p=0;$p<count($prod);$p++) { ?>
            <tr>                         
                <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo $prod[$p]->longdesc;?></td> 
                <?php for($h=0;$h<count($prodh);$h++) {
                    if ($prodh[$h]->p_no == $prod[$p]->p_no) { 
                        $sales += $prodh[$h]->SALES;
                        $credit += $prodh[$h]->CREDIT;
                        $total += ($prodh[$h]->SALES+$prodh[$h]->CREDIT);
                        ?>                        
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->SALES,2,'.',',');?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)$prodh[$h]->CREDIT,2,'.',',');?></td>
                    <td style="border-bottom: 1px solid;text-align: center;text-transform: capitalize;"><?php echo number_format((float)($prodh[$h]->SALES+$prodh[$h]->CREDIT),2,'.',',');?></td>
                    <?php } ?>
                    <?php }?>
            </tr>
            <?php }?> 
            <tr class="text-center">
                <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><strong>Total</strong></td>
                <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($sales == null || $sales == "0"){ echo "0.00";}else { echo number_format((float)$sales,2,'.',',');}?></td>
                <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($credit == null || $credit == "0"){ echo "0.00";}else { echo number_format((float)$credit,2,'.',',');}?></td>
                <td style="border-top: 1px solid;text-align: center;text-transform: capitalize;"><?php if($total == null || $total == "0"){ echo "0.00";}else { echo number_format((float)$total,2,'.',',');}?></td>
            </tr>
        </table>  
    </div>