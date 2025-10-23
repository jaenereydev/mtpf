<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('product_con/productview')?>">
        <title>Print Product</title>
        <script type="text/javascript">
        window.print();
        //disabled F5
        document.onkeydown = function() 
        {
            switch (event.keyCode) 
            {
                case 116 : //F5 button
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;       
            }
        };
        </script>
    </head>
    <body >          
     
        <table style="margin: 0 auto;">
        <tr>
            <td>
            <div class="pull-left">
                <img src="<?php echo $com[0]->logo;?>" width="60" height="60">
            </div>
            </td>
            <td style="text-align: center; padding-left: 40px;padding-right: 40px; font-size: 10px;">
                <div>
                <h2><?php echo $com[0]->companyname;?></h2>
                <?php echo $com[0]->address;?>          
                <h5>Product File</h5>
                </div>
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
                    <td style="text-align: center;border: 1px solid;" ><strong>Quantity</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Retail Price</strong></td>
                    <td style="text-align: center;border: 1px solid;" ><strong>Wholesale Price</strong></td>  
                    <td style="text-align: center;border: 1px solid;"><strong>Discounted Price</strong></td>  
                </tr> 
                <?php for($i=0; $i<count($prod); $i++) { ?>                    
                <tr>                         
                    <td style="text-transform: capitalize;text-align: center;"><?php echo $prod[$i]->p_no;?></td>                        
                    <td style="text-transform: capitalize;text-align: left;"><?php echo $prod[$i]->longdesc;?></td>
                    <td style="text-transform: capitalize;text-align: center;"><?php echo $prod[$i]->uom; echo " - "; echo $prod[$i]->packing; ?></td>                    
                    <td style="text-transform: capitalize;text-align: center;"><?php if(($prod[$i]->qty%$prod[$i]->packing) == '0'){echo number_format($prod[$i]->qty/$prod[$i]->packing,0,'.',','); echo ' / 0';}else{ echo number_format(floor($prod[$i]->qty/$prod[$i]->packing),0,'.',','); echo ' / '; echo number_format($prod[$i]->qty%$prod[$i]->packing,0,'.',',');}?></td>
                    <td style="text-transform: capitalize;text-align: center;"><?php echo number_format((float)$prod[$i]->price1,2,'.',',');?></td>
                    <td style="text-transform: capitalize;text-align: center;"><?php echo number_format((float)$prod[$i]->price2,2,'.',',');?></td>
                    <td style="text-transform: capitalize;text-align: center;"><?php echo number_format((float)$prod[$i]->price11,2,'.',',');?></td>
                </tr>
                <?php } ?> 
            </table>
        </div>        
    </body>
    
</html>