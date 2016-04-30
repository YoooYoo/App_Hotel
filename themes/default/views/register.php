<div class="container">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel-body">
      <?php  if(!empty($customerloggedin)){ ?>
      <li><a href="<?php echo base_url()?>account/logout"><?php echo trans('03');?></a></li>
      <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ ?>
      <div class="row">
        <form class="form-horizontal" action="" method="POST" id="headersignupform" onsubmit="return false;">
          <div class="col-md-8 go-right">
            <!-- PHPTRAVELS register Modal Starting -->
            <div class="modal-body">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo trans('088');?></h3>
                </div>
                <div class="panel-body form-horizontal">
                  <div class="form-group">
                    <div class="col-md-12">
                      <input class="form-control" type="text" placeholder="<?php echo trans('090');?>" name="firstname" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <input class="form-control" type="text" placeholder="<?php echo trans('091');?>" name="lastname"  value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <input class="form-control" type="text" placeholder="<?php echo trans('0173');?>" name="phone"  value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-horizontal">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"><?php echo trans('093');?>?</h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-md-12">
                        <input class="form-control" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <input class="form-control" type="password" placeholder="<?php echo trans('095');?>" name="password"  value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <input class="form-control" type="password" placeholder="<?php echo trans('096');?>" name="confirmpassword"  value="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <div class="col-md-12">
            <div class="resultsignup"></div>


           <button class="btn btn-action signupbtn go-right"> <i class="fa fa-check-square-o"></i> <?php echo trans('0115');?></button>


          </div>
          </div>



          <?php if(!empty($url)){ ?>
          <input type="hidden" class="url" value="<?php echo base_url().'ean/reservation/?'.$url;?>" />
          <?php }else{ ?>
          <input type="hidden" class="url" value="<?php echo base_url();?>account/" />
          <?php } ?>

        </form>
        <?php } }  ?>
      </div>
    </div>
  </div>
</div>
<br>
<script type="text/javascript">
  $(function(){
      var url = $(".url").val();
  // start sign up functionality
      $(".signupbtn").on('click',function(){
      $.post("<?php echo base_url();?>account/signup",$("#headersignupform").serialize(), function(response){
      if($.trim(response) == 'true'){
      $(".resultsignup").html("<div id='rotatingDiv'></div>");
      window.location.replace(url);
      }else{
      $(".resultsignup").html(response); } }); });
  // end signup functionality
  })

</script>