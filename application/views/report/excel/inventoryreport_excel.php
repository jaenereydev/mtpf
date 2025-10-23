<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
ob_start();
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"Iventoryreport_excel.xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style>
    table, th, td {
        border: 1px  black solid;
        border-collapse: collapse;
        }
</style>
<div>
    <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px" > 
            
                <tbody>
                    <tr>                        
                        <td style="text-align: center;"><strong>Name</strong></td>   
                        <td style="text-align: center;"><strong>Qty</strong></td>   
                        <td style="text-align: center;"><strong>Unit Cost</strong></td>  
                        <td style="text-align: center;"><strong>Total Amount</strong></td>  
                    </tr> 

                    <?php foreach ($product as $key => $item): ?>                     
                    <tr> 
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name;?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty; ?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unitcost,2,'.',',');?></td>  
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->qty*$item->unitcost,2,'.',',');?></td>  
                    </tr>
                    <?php endforeach;  ?>   
                </tbody>
            </table>
    </div>
    <?php ob_end_flush(); ?>