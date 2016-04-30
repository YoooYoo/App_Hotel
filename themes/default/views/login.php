

<!-- PHPTRAVELS forget password starting -->
    <div class="modal wow fadeInDown" id="ForgetPassword" tabindex="" role="dialog" aria-labelledby="ForgetPassword" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-asterisk"></i> <?php echo trans('0112');?></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="" id="passresetfrm" accept-charset="UTF-8" onsubmit="return false;">
              <div class="resultreset"></div>
              <div class="input-group">
                <input type="text" placeholder="your@email.com" class="form-control form" id="resetemail" name="email" required>
                <span class="input-group-btn">
                <button type="submit" class="btn btn-primary resetbtn" type="button"><?php echo trans('0114');?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- PHPTRAVELS forget password ending -->
<script type="text/javascript">
$(function(){
     var url = $(".url").val();
 // start login functionality
    $(".loginbtn").on('click',function(){
    $.post("<?php echo base_url();?>account/login",$("#loginfrm").serialize(), function(response){ if(response != 'true'){
    $(".resultlogin").html("<div class='alert alert-danger'>"+response+"</div>"); }else{
    $(".resultlogin").html("<div id='rotatingDiv'></div> <div class='alert alert-info'><?php echo trans('0427');?></div>");
    window.location.replace(url); }}); });
    // end login functionality
                      
    // start password reset functionality
    $(".resetbtn").on('click',function(){
      var resetemail = $("#resetemail").val();
        $(".resultreset").html("<div id='rotatingDiv'></div>");
    $.post("<?php echo base_url();?>account/resetpass",$("#passresetfrm").serialize(), function(response){
    if($.trim(response) == '1'){
    $(".resultreset").html("<div class='alert alert-success'>New Password sent to "+resetemail+", <?php echo trans('0426');?></div>");

    }else{
     $(".resultreset").html("<div class='alert alert-danger'><?php echo trans('0425');?></div>");

    } }); });
    // end password reset functionality


})

</script>

    <div class="text-center col-md-12">
      <h1 class="hidden-xs strong"><?php echo trans('0424');?></h1>
    <div class="footer text-footer text-center">
        <div class=""> <span> <?php echo trans('0305');?> </span>  <a href="<?php echo base_url();?>register">  <?php echo trans('0237');?> </a> </div>
    </div>  </div>

    <div class="clearfix"></div>
      <div class="modal-dialog modal-login">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title go-right"><?php echo trans('0236');?></h4><div class="clearfix"></div>
          </div>
          <div class="modal-body">
            <?php  if(!empty($customerloggedin)){ ?>
             <li><a href="<?php echo base_url()?>account/logout"><?php echo trans('03');?></a></li>
            <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ ?>
                           <div class="row">
                              <div class="col-md-12">
                                 <form method="POST" action="" id="loginfrm" accept-charset="UTF-8" onsubmit="return false;">

                                    <div class="form-group">
                                       <input type="email" class="form-control input-lg padding-10"  placeholder="Email address" required="required" name="username">
                                    </div>
                                    <div class="form-group">
                                       <input type="password" class="form-control input-lg padding-10"  placeholder="Password" required="required" name="password">
                                    </div>



              <div class="row">
              <div class="col-md-6 checkbox go-right">
              <label class="go-right"><input class="go-right" type="checkbox" name="remember" id="remember-me" value="1"> <span style="font-size:13px;color:#000"><span class="go-left"> &nbsp; <?php echo trans('0187');?> &nbsp; </span></span></label>
              </div>

              <div class="col-md-6 go-left">
              <a class="go-left" style="float: right;margin-top:6px" data-toggle="modal" href="#ForgetPassword"><span class="strong" style="font-size:13px;color:#000"><?php echo trans('0112');?></span></a>
              </div>
              </div>
              <div class="clearfix"></div>
              <br>
                                    <div class="form-group">
                                   <?php if(!empty($url)){ ?>
                                    <input type="hidden" class="url" value="<?php echo base_url().'ean/reservation/'.$url;?>" />
                                   <?php }else{ ?>
                                   <input type="hidden" class="url" value="<?php echo base_url();?>account/" />
                                   <?php } ?>
                                    <button type="submit" class="loginbtn btn-lg btn btn-warning btn-block"><?php echo trans('04');?></button>
                                    </div>
                                 </form>
                                <?php if($fblogin){ ?>
                                 <div class="form-group">
                                    <a href="<?php echo $fbloginurl;?>" class="btn btn-facebook btn-block"><i class="fa fa-facebook-square" ></i> <?php echo trans('0266');?></a>
                                 </div>
                                <?php } ?>
                              </div>
                              </div>
                           <?php } }  ?>

          </div>
          <div class="modal-footer">
           <form action="<?php echo base_url();?>register" method="post"><button type="submit" class="btn btn-default"><?php echo trans('0237');?></button></form>
          </div>
        </div>
      </div>


    <div id="login-overlay" class="modal-dialog">
     <div class="resultlogin"></div>
  </div>

     <br><br><br><br><br><br><br>
