<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('Bank_con/viewa')?>">
        <title>Print Bank Information</title>
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
                <h2>Bank Information</h2>
                </div>
            </td>            
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
        <div>
            <table style="width: 100%;margin: 0 auto;" width="500px">
                <tr>
                    <td col="6" style="text-transform: capitalize;"><strong>Bank Name:          <?php echo $bank[0]->bankname;?></strong></td>                    
                </tr>
                <tr>                    
                    <td col="6" style="text-transform: capitalize;"><strong>Address:            <?php echo $bank[0]->address;?></strong></td>                    
                </tr> 
                <tr>                    
                    <td col="6" style="text-transform: capitalize;"><strong>Current Balance:    Php <?php echo number_format((float)$bank[0]->currentbal,2,'.',',');?></strong></td>
                </tr> 
            </table>
            
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">
                <tr>  
                    <td style="text-align: center;border: 1px solid;"><strong>#</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Date</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Description</strong></td> 
                    <td style="text-align: center;border: 1px solid;"><strong>Deposit</strong></td>      
                    <td style="text-align: center;border: 1px solid;"><strong>Withdrawal</strong></td>
                    <td style="text-align: center;border: 1px solid;"><strong>Balance</strong></td>
                </tr> 
                
                <?php if($bh == null) {}else { ?>
                <?php for($i=0; $i<count($bh); $i++) { ?>                    
                <tr>   
                    <td style="text-align: center;"><?php echo $bh[$i]->bh_no;?></td>
                    <td style="text-align: center;"><?php echo $bh[$i]->date;?></td>
                    <td style="text-align: center;"><?php echo $bh[$i]->description;?></td> 
                    <td style="text-align: center;"><?php echo number_format((float)$bh[$i]->inamount,2,'.',',');?></td> 
                    <td style="text-align: center;"><?php echo number_format((float)$bh[$i]->outamount,2,'.',',');?></td> 
                    <td style="text-align: center;"><?php echo number_format((float)$bh[$i]->balance,2,'.',',');?></td> 
                </tr>
                <?php } }?> 
                
            </table>
        </div>       
        
    </body>
    
</html>