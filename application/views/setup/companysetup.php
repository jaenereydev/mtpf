<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIMS</title>
        
        <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?=base_url()?>public/css/private.css" />
        <link rel="icon" type="image/x-icon" href="<?=base_url()?>favico.ico"/>
    </head>
    
    <body>
        <div class="container">                    
        <div style="margin: 0 auto;margin-top: 20px;" class="main">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Company Setup</h4>
                </div>
               
                
                <form role="form" method="post" action="<?=site_url('company_con/updatecompany')?>">
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" class="hide" name="c_no" value="<?php if( empty($com[0]->c_no)){}else{echo $com[0]->c_no;}?>">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="companyname" placeholder="Name" value="<?php if( empty($com[0]->name)){}else{echo $com[0]->name;}?>">
                            </div>                           
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address" value="<?php if( empty($com[0]->address)){}else{echo $com[0]->address;}?>">
                            </div>
                            <div class="form-group">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="telno" placeholder="Telephone Number" value="<?php if( empty($com[0]->telno)){}else{echo $com[0]->telno;}?>">
                            </div>                       
                        </div>
                    </div>
                    <div class="panel-footer">                    
                        <button title="Save" type="submit" class="glyphicon glyphicon-floppy-saved btn btn-success " onclick="return confirm('Do you want to Update?')"></button>                                
                    </div>
                </form>
                
            </div>
        </div>
        </div>
        <script src="<?=base_url()?>public/js/jquery-main.min.js"></script>
        <script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
    </body>
</html>