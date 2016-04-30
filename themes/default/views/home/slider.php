<div id="Slider"  style="background-color:#000;margin-top:-20px" class="carousel carousel-fade slide" data-ride="carousel">
  <div class="container">
    <div class="col-sm-6 col-md-4 col-lg-7 offset-0" id="rtl-menu" style="position:absolute;border-radius: 3px 3px 3px 3px; background: rgba(255, 255, 255, 0.98); color:#4C4C4C;margin-top:35px;z-index:100">
      <ul class="nav nav-tabs go-right RTL">
        <?php  if(pt_main_module_available('hotels')){ ?><li role="presentation" class="active text-center"> <a href="#HOTELS" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo trans('Hotels_Search');?></a></li><?php } ?>
        <?php  if(pt_main_module_available('ean')){ ?><li role="presentation" class="text-center"> <a href="#EXPEDIA" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo trans('Ean');?></a></li><?php } ?>
        <?php  if(pt_main_module_available('tours')){ ?><li role="presentation" class="text-center"> <a href="#TOURS" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo trans('Tours');?></a></li><?php } ?>
        <?php  if(pt_main_module_available('cars')){ ?><li role="presentation" class="text-center"> <a href="#CARS" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo trans('Cars');?></a></li><?php } ?>
      </ul>
      
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in <?php pt_searchbox('hotels'); ?>" id="HOTELS" aria-labelledby="home-tab">
          <?php require $themeurl.'views/hotels/main-search.php'; ?>
        </div>
        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('tours'); ?>" id="TOURS" aria-labelledby="home-tab">
          <?php require $themeurl.'views/tours/main-search.php'; ?>
        </div>
        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('cars'); ?>" id="CARS" aria-labelledby="home-tab">
          <?php require $themeurl.'views/cars/main-search.php'; ?>
        </div>
        <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('ean'); ?>" id="EXPEDIA" aria-labelledby="home-tab">
          <?php require $themeurl.'views/integrations/ean/main-search.php'; ?>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="carousel-inner">
    <?php
    $mulcur = "";
    $mainslides = pt_get_main_slides();
    $scount = 0;
    foreach($mainslides as $ms){
    $sliderlib->set_id($ms->slide_id);
    $sliderlib->slide_details();
    $scount++;
    $sactive = "";
    if($scount == 1){
    $sactive = "active";
    }else{
    $sactive = "";
    }
    ?>
    <div class="item <?php echo $sactive;?>">
      <div class="zoomClass">
        <img class="wow fadeIn animated img-rtl" src="<?php echo PT_SLIDER_IMAGES.$ms->slide_image;?>" alt="">
      </div>
      <div class="container hidden-xs">
        <div class="carousel-caption rt-menu-caption">
          <div class="row hidden-sm">
            <!--<div class="pull-right go-left">-->
            <!--  <h1 class="text-right go-text-right go-right wow fadeInUp RTL" style="font-size:26px"><strong>--><?php //echo $sliderlib->title;?><!--</strong></h1><div class="clearfix"></div>-->
            <!--  <p style="font-size:16px" class="text-right go-text-right go-right RTL wow flash">--><?php //echo $sliderlib->desc;?><!-- --><?php // for($i=1; $i<=$ms->slide_optional_text; $i++) { echo " <i class='text-warning fa fa-star go-left'></i> "; } ?><!-- </p>-->
            <!--</div>-->
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <a class="left carousel-control" href="#Slider" data-slide="prev"> <!--<span class="glyphicon glyphicon-chevron-left"></span>--> </a>
  <a class="right carousel-control" href="#Slider" data-slide="next"> <!--<span class="glyphicon glyphicon-chevron-right"></span>--> </a>
</div>