<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=AllSupplier.xls");
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
                Supplier File                
            </td>             
        </tr>
        </table><!-- End of Heading -->     
        
    <div>
        <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">
            <tr>                    
                <td style="text-align: center;border: 1px solid;"><strong>#</strong></td>                         
                <td colspan="3" style="text-align: center;border: 1px solid;"><strong>Supplier Name</strong></td>                                     
            </tr>
            <?php for($i=0; $i<count($sup); $i++) { ?>   
            <tr>
                <td style="text-transform: capitalize;text-align: center;"><?php echo $sup[$i]->s_no;?></td>                        
                <td colspan="3" style="text-transform: capitalize;text-align: left;padding-left: 50px"><?php echo $sup[$i]->name;?></td> 
            </tr>
            <?php }?>                                
        </table>
    </div>