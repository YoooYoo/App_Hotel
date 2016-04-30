<div style="background-color:#fff" class="<?php echo @$hidden; ?>">
  <br>
  <!-- Legal Action Will Be Taken If This Line Was Removed !!! -->
  <?php //if(PT_SHOW == '1'){?>
  <!--<div class="container text-center" style="margin-top:10px">-->
  <!--  <p> Powered by : <a data-toggle="tooltip" data-placement="top" title="Developed by PHPTRAVELS" href="http://www.phptravels.com" target="blank"><strong>PHPTRAVELS</strong></a></p>-->
  <!--</div>-->
  <?php //} ?>
  <!-- Legal Action Will Be Taken If This Line Was Removed !!! -->
  <!--<div class="modal-body">-->
  <?php //echo run_widget(79); ?>
  <!--</div>-->
</div>
<?php  $CI = &get_instance(); $app_settings = $CI->settings_model->get_settings_data(); $lang_set = $CI->theme->_data['lang_set']; ?>

<footer id="main-footer" class="<?php echo @$hidden; ?>">
  <br>
  <div class="container">
    <!--<div class="row">-->
      <!--<div class="col-md-12">-->
      <!--  <div class="h4 go-text-right">--><?php //echo trans('023');?><!--</div>-->
      <!--</div>-->
      <!-- PHPTRAVELS Newsletter starting -->
      <?php //if(pt_is_module_enabled('newsletter')){ ?>
      <!--<form role="search">-->
      <!--  <div class="form-group">-->
      <!--    <div class="col-lg-4 col-md-3 col-sm-6 go-right">-->
      <!--     <input style="color:#fff" type="email" placeholder="--><?php //echo trans('0403');?><!--" class="form-control sub_email RTL" required>-->
      <!--    <div class="subscriberesponse"></div>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--  <div class="form-group">-->
      <!--    <div class="col-md-2 col-lg-2 col-sm-6 go-right">-->
      <!--      <button style="margin-top:-0px" class="btn btn-action btn-block sub_newsletter" type="button">--><?php //echo trans('025');?><!--</button>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</form>-->
      <?php //} ?>
      <!-- PHPTRAVELS Newsletter ending -->
      <!--<div class="col-md-4 col-lg-4 col-sm-8 go-right">-->
      <!--  <div class="go-right">-->
      <!--    <i class="fa fa-check text-success go-right"></i> <span class="go-right">  &nbsp; --><?php //echo trans('024');?><!-- &nbsp; </span>  <br>-->
      <!--    <i class="fa fa-check text-success go-right"></i> &nbsp; --><?php //echo trans('0404');?><!-- &nbsp;-->
      <!--  </div>-->
      <!--</div>-->
      <!--<div class="col-md-3 col-lg-2 col-sm-4 hidden-xs go-left">-->
        <!--<ul class="center-block">-->
          <?php
          //  $footersocials = pt_get_footer_socials();
          //  foreach($footersocials as $fs){
          //  ?>
          <!--<a href="--><?php //echo $fs->social_link;?><!--" target="_blank"><img src="--><?php //echo PT_SOCIAL_IMAGES; ?><!----><?php //echo $fs->social_icon;?><!--" class="social-icons-footer" /></a>-->
          <?php //} ?>
        <!--</ul>-->
      <!--</div>-->
    <!--</div>-->
    <!--<hr style="border-top: 1px solid #434242 !important;">-->
  </div>
  <section class="tab-content">
    <div class="container">
      <div class="row">
        <!--<span class="hidden-xs">-->
        <?php //get_footer_menu_items(3,"col-lg-2 col-md-2 col-sm-4 go-right","widget-title go-text-right","small-menu go-right go-text-right" );?>
        <?php //get_footer_menu_items(4,"col-lg-2 col-md-2 col-sm-4 go-right","widget-title go-text-right","small-menu go-right go-text-right" );?>
        <?php //get_footer_menu_items(7,"col-lg-2 col-md-2 col-sm-4 go-right","widget-title go-text-right","small-menu go-right go-text-right" );?>
        <!--</span>-->
        <div class="col-lg-3 col-md-3 col-sm-6 go-right">
         <!--<img class="img-responsive img-rtl" src="--><?php //echo base_url(); ?><!--uploads/cms/images/mobile_app.png"/>-->
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6  go-right">
          <!--<h4 class="text-center"><strong><span class=" hidden-md">--><?php //echo trans('059');?><!--</span> --><?php //echo trans('058');?><!--</strong></h4>-->
          <!--<hr style="border-top: 1px solid #3E3D3D !important;">-->
          <!--<div class="col-md-12 col-sm-12">-->
          <!--  <div class="row">-->
          <!--    <div class="col-md-3 col-sm-3  col-sm-3 col-xs-3"><a  target="_blank" href="//phptravels.mobi/"><img title="Google Play" data-toggle="tooltip" data-placement="top"  class="img-responsive" src="../../uploads/cms/images/google.png" /></a></div>-->
          <!--    <div class="col-md-3 col-sm-3  col-sm-3 col-xs-3"><a  target="_blank" href="//phptravels.mobi/"><img title="Apple iStore" data-toggle="tooltip" data-placement="top"  class="img-responsive" src="../../uploads/cms/images/apple.png" /></a></div>-->
          <!--    <div class="col-md-3 col-sm-3  col-sm-3 col-xs-3"><a  target="_blank" href="//phptravels.mobi/"><img title="Windows Store" data-toggle="tooltip" data-placement="top"  class="img-responsive" src="../../uploads/cms/images/windows.png" /></a></div>-->
          <!--    <div class="col-md-3 col-sm-3  col-sm-3 col-xs-3"><a  target="_blank" href="//phptravels.mobi/"><img title="BlackBerry AppWorld" data-toggle="tooltip" data-placement="top"  class="img-responsive" src="../../uploads/cms/images/bbm.png" /></a></div>-->
          <!--  </div>-->
          <!--</div>-->
          <!--<div class="clearfix"></div>-->
        </div>
      </div>
      <!--<div class="visible-xs modal-body">&nbsp;</div>-->
      <!--<div style="border-top: 1px solid #626060 !important;margint-bottom:15px"></div>-->
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bottom">
        <span class="go-right">  <?php echo trans('0308');?> <b class="text-orange tahoma fs14"><i class="fa fa-phone"></i> <?php echo $phone; ?></b></span>
        <p class="pull-right hidden-xs go-left"><?php echo $app_settings[0]->copyright;?></p>
      </div>
    </div>
  </section>
</footer>

<?php include'scripts.php'; ?>


</body>
</html>