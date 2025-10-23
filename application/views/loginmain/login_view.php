<div class="login-container">

        <img style="margin: 0 auto;width: 400px;" class="logo"  src="<?=base_url('SIMS.png');?>">
    
    <form class="form-signin-heading" id="formlogin" method="post" action="<?=site_url('Login_con/login')?>" role="form">    
        <h2 style="text-align: center;" class="form-signin-heading">SIMS ~ Please login</h2>
        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus autocomplete="off"/>
        <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off"/>      
        <br>
        <button class="btn btn-lg btn-primary btn-block submit" type="submit">Login</button>   
        </form>
</div>
        
<script type="text/javascript">
  $(function() {
   $("#formlogin").submit(function(evt) {
      evt.preventDefault();
      var url = $(this).attr('action');
      var postdata = $(this).serialize();
     $.post(url, postdata, function(o) {    
         if(o.result === 1){
             window.location.href = '<?=site_url('Dashboard')?>';
          }else {
              alert('Invalid Login');
         }
      }, 'json');
    });
  });

 </script>
