<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER.'favicon.png';?> ">
    <title>Administration Login</title>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/facebook.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/fa.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/include/login/ladda-themeless.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.js"></script>
    <script src="<?php echo base_url(); ?>assets/include/login/spin.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/include/login/ladda.min.js"></script>
  </head>
  <style>
    body {
    background-color: #168eda !important;
    background: radial-gradient(circle,#94d2f8,#168eda) !important;
    background: radial-gradient(circle,#94d2f8,#3a92c8) !important;
    overflow-y: scroll;
    }
    .shadow {
    -webkit-box-shadow: 0 2px 10px rgba(0,0,0,0.24),0 0 0 3px #fff inset;
    -moz-box-shadow: 0 2px 10px rgba(0,0,0,0.24),0 0 0 3px #fff inset;
    box-shadow: 0 2px 10px rgba(0,0,0,0.24),0 0 0 3px #fff inset;
    border-radius: 5px;
    background-color: #fff;
    border: 1px solid #c4c5c9;
    max-width: 350px;
    margin: 0 auto;
    margin-bottom: 15px;
    }
  </style>
  <script>
    $(function() {
      Login.init()
    });
  </script>
  <script type="text/javascript">
    $(function () {
       //login functionality
    $(".form-signin").on('submit',function(){
    $(".resultlogin").html("<div class='alert alert-info loading wow fadeOut animated'>Hold On...</div>");
    $.post("<?php echo base_url().$this->uri->segment(1);?>/login",$(".form-signin").serialize(), function(response){
      console.log(response);
      if($.trim(response) != 'true')
      {
        $(".resultlogin").html("<div class='alert alert-danger loading wow fadeIn animated'>"+response+"</div>"); }else{
        $(".resultlogin").html("<div class='alert alert-success login wow fadeIn animated'>Redirecting Please Wait...</div>");
    window.location.replace("<?php echo current_url();?>"); }}); });
    // end login functionality

    // start password reset functionality
    $(".resetbtn").on('click',function(){
    var resetemail = $("#resetemail").val();
    $(".resultreset").html("<div id='rotatingDiv'></div>");
    $.post("<?php echo base_url();?>admin/resetpass",$("#passresetfrm").serialize(), function(response){
    if($.trim(response) == '1'){
    $(".resultreset").html("<div class='alert alert-success'>New Password sent to "+resetemail+", admin check email.</div>");

    }else{
    $(".resultreset").html("<div class='alert alert-danger'>Email Not Found</div>");

    } }); });
    // end password reset functionality


    });
  </script>
  <div class="container">
    <!-- BEGIN SIGNIN SECTION-->
    <form method="POST" role="form" style="margin-top:60px;" class="shadow form-signin form-horizontal wow flipInX animated" style="display: block;" onsubmit="return false;">
      <!-- //Notice .form-heading class-->
      <h2 class="form-heading text-center">Sign in</h2>
      <input type="text" name="email" placeholder="Username" required="" autofocus="" class="form-control">
      <input type="password" name="password" placeholder="Password" required="" class="form-control">
      <div class="row">
        <div class="col-xs-6">
          <label class="checkbox">
          <input type="checkbox" name="remember" value="remember-me"> Remember me
          </label>
        </div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block ladda-button" data-style="zoom-in">Sign in</button>
        </div>
      </div>
      <div class="forget-password">Forgot password?
        <a id="link-forgot" href="#"> Click here to reset</a>
      </div>
      <div class="resultlogin"></div>
    </form>
    <!-- END SIGNIN SECTION-->
    <!-- BEGIN SIGNUP SECTION-->
    <!-- BEGIN FORGOT PASSWORD SECTION-->
    <form role="form" class="form-forgot form-horizontal wow flipInY animated" style="display: none; margin-top:60px;"  id="passresetfrm" onsubmit="return false;">
      <h2 class="form-heading text-center"> Forgot Password</h2>
      <div class="resultreset"></div>
      <div class="text-center">Enter your email address to reset your password</div>
      <br>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope"></i>
        </span>
        <input type="email" id="resetemail" name="email" placeholder="Email" class="form-control">
      </div>
      <br>
      <div class="form-actions">
        <button type="button" class="btn btn-primary btn-back"><i class="fa fa-angle-left"></i>&nbsp;Back</button>
        <button id="btn-forgot" type="button" class="btn btn-success pull-right resetbtn ladda-button">Reset My Password</button>
      </div>
    </form>
    <!-- END FORGOT PASSWORD SECTION-->
  </div>
  <script>
    // Bind normal buttons
    Ladda.bind( 'div:not(.progress-demo) button', { timeout: 2000 } );

    // Bind progress buttons and simulate loading progress
    Ladda.bind( '.progress-demo button', {
    	callback: function( instance ) {
    		var progress = 0;
    		var interval = setInterval( function() {
    			progress = Math.min( progress + Math.random() * 0.1, 1 );
    			instance.setProgress( progress );
    			if( progress === 1 ) {
    				instance.stop();
    				clearInterval( interval );
    			}
    		}, 200 );
    	}
    } );
  </script>
  <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
  <!-- icheck -->
  <script src="<?php echo base_url(); ?>assets/include/icheck/icheck.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/include/icheck/square/grey.css" rel="stylesheet">
  <script>
    var cb, optionSet1;
        $(".checkbox").iCheck({
          checkboxClass: "icheckbox_square-grey",
          radioClass: "iradio_square-grey"
        });

        $(".radio").iCheck({
          checkboxClass: "icheckbox_square-grey",
          radioClass: "iradio_square-grey"
        });
  </script>