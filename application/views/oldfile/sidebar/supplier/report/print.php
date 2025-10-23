<html>
    <head>
        <meta http-equiv="refresh" content="1; url=<?=site_url('supplier_con/supplierview')?>">
        <title>Print Supplier</title>
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
                <h4>Supplier File</h4>
                </div>
            </td>        
        </tr>
        </table><!-- End of Heading -->        
        <hr>
      
        <div>
            <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px">
                <tr>                    
                    <td style="text-align: center;border: 1px solid;"><strong>#</strong></td>                         
                    <td style="text-align: center;border: 1px solid;"><strong>Supplier Name</strong></td>                                     
                </tr>
                <?php for($i=0; $i<count($sup); $i++) { ?>   
                <tr>
                    <td style="text-transform: capitalize;text-align: center;"><?php echo $sup[$i]->s_no;?></td>                        
                    <td style="text-transform: capitalize;text-align: left;padding-left: 50px"><?php echo $sup[$i]->name;?></td> 
                </tr>
                <?php }?>                                
            </table>
        </div>    
        
    </body>
    
</html>