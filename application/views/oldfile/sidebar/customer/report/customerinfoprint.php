<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('customer_con/customerview')?>">
        <title>Print Customer Info</title>
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
                <h2>Customer Information</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
        <div>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">                                
                <tr>                                             
                   <td style="text-align: left;text-transform: capitalize;"><strong><?php echo $cus[0]->name;?></strong></td>       
                   <td style="text-align: Right;"><strong>Total Credit <?php if($cus[0]->totalcredit == null || $cus[0]->totalcredit == ""){ echo "0.00";}else { echo number_format((float)$cus[0]->totalcredit,2,'.',',');}?></strong></td>                  
                </tr>   
                <tr>
                    <td style="text-align: left;"><strong>Tel #: <?php echo $cus[0]->telno;?></strong></td>
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
        <div style="width: 100%;height: 100px;position: absolute;bottom: 0;left: 0;">
            <table style="width: 100%;border: 1px solid; font-size: 10px;" >
                <tr>
                    <td style="border: 1px solid;">Created by: <?php echo $users[0]->fname;?></td>
                    <td style="border: 1px solid;">Date: <?php echo date('m/d/Y'); ?></td>
                </tr>
            </table>
        </div>       
        
    </body>
    
</html>