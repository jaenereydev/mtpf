<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('customer_con/customerview')?>">
        <title>Print Customer</title>
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
                <h2>Customer File</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
        <div>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">
                <tr>
                    <td style="text-align: center;border: 1px solid;">#</td> 
                    <td style="text-align: center;border: 1px solid;">Name</td>
                    <td style="text-align: center;border: 1px solid;">Credit Limit</td>
                    <td style="text-align: center;border: 1px solid;">Total Balance</td>                
                </tr>
                <?php for($i=0;$i<count($cus);$i++){?>
                <tr>
                    <td style="text-transform: capitalize;text-align: center;"><?php echo $cus[$i]->c_no;?></td>  
                    <td style="text-transform: capitalize;"><?php echo $cus[$i]->name;?></td>
                    <td style="text-align: center;"><?php echo number_format((float)$cus[$i]->creditlimit,2,'.',',');?></td>                    
                    <td style="text-align: center;"><?php echo number_format((float)$cus[$i]->totalcredit,2,'.',',');?></td>                                
                </tr>
                <?php }?>
                <tr>
                    <td colspan="3" style="border-top: 1px solid;text-align: right;">Total:</td>
                    <td style="border-top: 1px solid;text-align: center"><?php echo number_format((float)$sum[0]->totalcredit,2,'.',',');?></td>
                </tr>
            </table>
        </div>      
        
    </body>
    
</html>