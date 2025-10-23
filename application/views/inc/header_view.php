<!doctype html>
<html lang="en" dir="ltr" class="chrome chrome47">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex,nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIMS v1.0</title>        
        <!-- <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css" />  -->       
        <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.css" />        
        <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-theme.css" />  
        <link rel="stylesheet" href="<?=base_url()?>public/css/datepicker.css"> 
        <link rel="icon" type="image/x-icon" href="<?=base_url()?>favico.ico"/>
        <script src="<?=base_url()?>public/js/jquery.js"></script>
    </head>               
    
    
    <!--  oncontextmenu="return false;" style="background-color: #94BFFF" -->
<body style="background-color: #D9DDEB;" >
<nav class="navbar navbar-inverse navbar-fixed-top"  >
    <div class="container-fluid">
        <div class="navbar-header">
            <?php if($hidebtn == '1') {}else { ?>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php }?>
               <img class="navbar-brand" style="padding: 10px; width: 100px; height: 50px;" src="<?=base_url('SIMS.png');?>">
              <!--  <span class="navbar-brand">Sales and Inventory Management System</span> -->
            
        </div>
        <?php if($hidebtn == '1') {}else { ?>
        <div id="navbar" class="navbar-collapse collapse" >            
            <ul class="nav navbar-nav navbar-right">                                                
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-expanded="false"> Hi! <?php echo $users[0]->name;?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">     
                    <?php if($users[0]->position == "Admin"){ ?>        
                      <li><a href="<?=site_url('User_con')?>" class="glyphicon glyphicon-user"> User List</a></li>
                      <li><a target="_blank" href="<?=site_url('Company_con')?>" class="glyphicon glyphicon-cog"> Company Setup</a></li>
                    <?php } ?>
                      <li><a href="<?=site_url('dashboard/logout')?>" class="glyphicon glyphicon-log-out"> Logout</a></li>
                    </ul>
                </li>
                
               
                
            </ul>
        </div> <!-- end of collapse-->
        <?php }?>
    </div>
</nav> <!-- end of navbar-->

    