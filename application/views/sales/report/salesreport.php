<html>
    <head>
    
        <link rel="icon" type="image/x-icon" href="<?=base_url()?>favico.ico"/>
        <title>Sales Report</title>

        <script type="text/javascript">

        // window.print();      

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

        <style>
            td {
                border: 1px solid;
                text-transform: capitalize;
                text-align: center;
            }
            .row {
            display: flex;
            margin-left:-5px;
            margin-right:-5px;
            }

            .column {
            flex: 60%;
            padding: 5px;
            }
            .column2 {
            flex: 40%;
            padding: 5px;
            }


        </style>
    </head>
    <body>          
            
        <div>
            <table style="font-family: arial;width: 100%; font-size: 24pt;">
                <tr>
                    <!-- <td style="border: 0px ;float: right;"><img style="width: 70px;" class="logo"  src="<?=base_url($com[0]->imglink);?>"></td> -->
                    <td style="border: 0px ;text-align: center;"><?php echo $com[0]->name; ?><br><span style="font-size: 12pt;">SALES REPORT</span></td>
                    <td style="border: 0px ;text-align: right; font-size: 12pt;"><strong>Date <span style="text-align:right;text-decoration: underline;"><?php echo date_format(date_create($cohinfo[0]->date), 'm/d/Y'); ?></span></strong></td>
                </tr>
            </table> 
            <div class="row">
                <div class="column">
                    <table style="font-family: arial;width: 100%; font-size: 12pt;">
                        <tr>
                            <td><strong>Total Cash Sales</strong></td>
                            <td><?php $sca=0; if(sizeof($sumcash)): echo number_format((float)$sumcash[0]->ta,2,'.',','); $sca=$sumcash[0]->ta; endif ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Check Sales</strong></td>
                            <td><?php $sch=0; if(sizeof($sumcheck)): echo number_format((float)$sumcheck[0]->ta,2,'.',','); $sch=$sumcheck[0]->ta; endif ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Down payment</strong></td>
                            <td><?php $dp=0; if(sizeof($downpayment)): echo number_format((float)$downpayment[0]->dp,2,'.',','); $dp=$downpayment[0]->dp; endif ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Credit Loan Payment</strong></td>
                            <td><?php $clp=0; if(sizeof($creditloanpayment)): echo number_format((float)$creditloanpayment[0]->ap,2,'.',','); $clp=$creditloanpayment[0]->ap; endif ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Credit Payment</strong></td>
                            <td><?php $scp=0; if(sizeof($sumcreditpayment)): echo number_format((float)$sumcreditpayment[0]->ta,2,'.',','); $scp=$sumcreditpayment[0]->ta; endif ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>Total Sales</strong></td>
                            <td><strong>Php <?php $ts=$sca+$sch+$scp+$dp+$clp;  echo number_format((float)$ts,2,'.',',');?></strong></td>
                        </tr>
                        <tr>
                            <td><strong>Total Return Sales</strong></td>
                            <td>(Php <?php $sr=0; if(sizeof($sumreturn)): echo number_format((float)$sumreturn[0]->ta,2,'.',','); $sr=$sumreturn[0]->ta; endif ?>)</td>
                        </tr>
                        <tr >
                            <td><strong>Total Expenses</strong></td>
                            <td>(Php <?php $se=0; if(sizeof($sumexpenses)): echo number_format((float)$sumexpenses[0]->ta,2,'.',','); $se=$sumexpenses[0]->ta; endif ?>)</td>
                        </tr>
                        <tr >
                            <td><strong>Total Desposit</strong></td>
                            <td>(Php <?php $sd=0; if(sizeof($sumdeposit)): echo number_format((float)$sumdeposit[0]->ta,2,'.',','); $sd=$sumdeposit[0]->ta; endif ?>)</td>
                        </tr>
                        <tr >
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>(Php <?php echo number_format((float)$sumexpenses[0]->ta+$sumreturn[0]->ta,2,'.',','); ?>)</strong></td>
                        </tr>
                        <tr >
                            <td colspan="2"><strong>Net Sales</strong></td>
                            <td><strong>Php <?php $ns=0; echo number_format((float)$ts-($sr+$se+$sd),2,'.',','); $ns=$ts-($sr+$se+$sd) ?></strong></td>
                        </tr>
                        <tr >
                            <td colspan="2"><strong>Cash On Hand</strong></td>
                            <td><strong>Php <?php $coh=0; if(sizeof($sumcashonhand)): echo number_format((float)$sumcashonhand[0]->ta,2,'.',','); $coh=$sumcashonhand[0]->ta; endif ?></strong></td>
                        </tr>
                        <tr >
                            <td colspan="2"><strong>Variance</strong></td>
                            <td><strong>Php <?php $v=$ns-$coh; echo number_format((float)$v,2,'.',','); if($v < '0'){ echo ' OVER'; }else if($v > 0){ echo ' SHORT'; }else{} ?></strong></td>
                        </tr>
                    </table>
                </div>
                <div class="column2">
                    <table style="font-family: arial;width: 100%; font-size: 12pt;">
                        <tr>
                            <td><strong>Total Credit</strong></td>
                            <td>Php <?php if(sizeof($sumcredit)): echo number_format((float)$sumcredit[0]->ta,2,'.',','); endif ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
                <?php if(sizeof($t)):  ?>
                <table style="font-family: arial;width: 100%; font-size: 12pt;"> 
                    <thead>
                        <tr >
                            <td class="text-center"colspan="5"><strong>Transaction List</strong></td>
                        </tr>
                        <tr >                                                                         
                            <td class="text-center"><strong>Date</strong></td> 
                            <td class="text-center"><strong>Ref. No.</strong></td>                         
                            <td class="text-center"><strong>Type</strong></td>   
                            <td class="text-center"><strong>Amount</strong></td> 
                        </tr> 
                    </thead>
                    <tbody>
                        <?php  foreach ($t as $key => $item): ?>                      
                        <tr class="<?php if($item->type=='RETURN'){echo 'danger'; } ?>">                 
                            <td class="text-center" style="text-transform: capitalize"><?php echo date_format(date_create($item->date), 'm/d/Y');?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->type ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalamount,2,'.',','); ?></td>
                        </tr>
                        <?php endforeach;  ?>                       
                    </tbody>
                </table>
                <br>
                <?php endif  ?> 
                           
                <?php if(sizeof($creditpayment)):  ?>            
                <table style="font-family: arial;width: 100%; font-size: 12pt;"> 
                    <thead>
                        <tr >
                            <td class="text-center"colspan="5"><strong>Credit Payment</strong></td>
                        </tr>
                        <tr >                                                                         
                            <td class="text-center"><strong>Name</strong></td> 
                            <td class="text-center"><strong>Down payment</strong></td>
                        </tr> 
                    </thead>
                    <tbody>
                            <?php $d=0; foreach ($creditpayment as $key => $item): ?>                      
                            <tr> 
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalpayment,2,'.',','); $d+=$item->totalpayment; ?></td>
                            </tr>
                            <?php endforeach;  ?>  
                            <tr>
                                <td class="text-center"><strong>Total</strong></td>
                                <td class="text-center"><strong><?php echo number_format((float)$d,2,'.',','); ?></strong></td>
                            </tr>                   
                    </tbody>
                </table>
                <br>
                <?php endif  ?> 
                
                <?php if(sizeof($creditloan)):  ?>
                <table style="font-family: arial;width: 100%; font-size: 12pt;"> 
                    <thead>
                        <tr>
                            <td class="info text-center" colspan="3"><strong>Credit Loan</strong></td>
                        </tr>
                        <tr >                                                                            
                            <td class="text-center"><strong>Name</strong></td> 
                            <td class="text-center"><strong>Down payment</strong></td>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php $d=0; foreach ($creditloan as $key => $item): ?>                      
                        <tr> 
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->downpayment,2,'.',','); $d+=$item->downpayment; ?></td>
                        </tr>
                        <?php endforeach;  ?>  
                        <tr>
                            <td class="text-center"><strong>Total</strong></td>
                            <td class="text-center"><strong><?php echo number_format((float)$d,2,'.',','); ?></strong></td>
                        </tr>                     
                    </tbody>
                </table>            
                <br>
                <?php endif  ?> 

                <?php if(sizeof($creditloanpaymentlist)):  ?> 
                <table style="font-family: arial;width: 100%; font-size: 12pt;"> 
                    <thead>
                        <tr>
                            <td class="info text-center" colspan="5"><strong>Credit Loan Payment</strong></td>
                        </tr>
                        <tr >                                                                             
                            <td class="text-center"><strong>Name</strong></td> 
                            <td class="text-center"><strong>Penalty</strong></td>
                            <td class="text-center"><strong>Amount</strong></td>
                            <td class="text-center"><strong>Status</strong></td>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php $p=0; $a=0; foreach ($creditloanpaymentlist as $key => $item): ?>                      
                        <tr> 
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->penalty,2,'.',','); $p+=$item->penalty; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->amount_payed,2,'.',',');$a+=$item->amount_payed; ?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->status ?></td>
                        </tr>
                        <?php endforeach;   ?>  
                        <tr>
                            <td class="text-center"><strong>Total</strong></td>
                            <td class="text-center"><?php echo number_format((float)$p,2,'.',','); ?></td>
                            <td class="text-center"><?php echo number_format((float)$a,2,'.',','); ?></td>
                            <td colspan="2" class="text-center"><strong><?php echo number_format((float)$a+$p,2,'.',','); ?></strong></td>
                        </tr>                 
                    </tbody>
                </table>
                <?php endif  ?> 
        </div>    
        <br><br>
        <p style="text-align:left;font-size: 14pt;text-decoration: underline;font-weight: bold;">
        Prepared by: <?php echo $user[0]->name; ?>                
        </p>                                                
    </body>
    
</html>