<div id="Slider" class="carousel carousel-fade slide" data-ride="carousel" style="margin-top:-30px">

<div class="container">

<br>

<div class="col-sm-5 col-md-5 col-lg-3 offset-0 main-search-tab" style="z-index:100">



        <div class="tabbable tabs-left" style="height:320px">

        <!--  <ul class="nav nav-tabs" style="height:328px;">

        

        <?php  if(pt_main_module_available('hotels')){ ?>  <li class="active" data-title="HOTELS"><a href="#HOTELS" data-toggle="tab"><i class="fa fa-building-o"></i> <?php echo trans('Hotels');?></a></li> <?php } ?>

        <?php  if(pt_main_module_available('flightsdohop')){ ?><li class=""  data-title="FLIGHTS-DOHOP"><a class="" href="#FLIGHTS-DOHOP" data-toggle="tab"><i class="fa fa-plane"></i>  <?php echo trans('Flightsdohop');?></a></li><?php } ?>

        <?php  if(pt_main_module_available('ean')){ ?><li class="" data-title="EXPEDIA"><a class="" href="#EXPEDIA" data-toggle="tab"><i class="fa fa-home"></i>  <?php echo trans('Ean');?></a></li> <?php } ?>

        <?php  if(pt_main_module_available('booking')){ ?>  <li class="" data-title="BOOKING"><a href="#BOOKING" data-toggle="tab"><i class="fa fa-building-o"></i> <?php echo trans('Booking');?></a></li> <?php } ?>  

        <?php  if(pt_main_module_available('tours')){ ?>  <li class="" data-title="TOURS"><a href="#TOURS" data-toggle="tab"><i class="fa fa-briefcase"></i> <?php echo trans('Tours');?></a></li> <?php } ?>

        <?php  if(pt_main_module_available('cars')){ ?>  <li class="" data-title="CARS"><a href="#CARS" data-toggle="tab"><i class="fa fa-cab"></i> <?php echo trans('Cars');?></a></li> <?php } ?>

        <?php  if(pt_main_module_available('cruises')){ ?>  <li class="" data-title="CRUISES"><a href="#CRUISES" data-toggle="tab"><i class="fa fa-anchor"></i> <?php echo trans('Cruises');?></a></li> <?php } ?> 

        

         </ul> -->

         

         <div class="tab-content">

        <?php require $themeurl.'views/hotels/main-search.php'; ?>
        <?php require $themeurl.'views/integrations/ean/main-search.php'; ?>
        <?php require $themeurl.'views/integrations/flights/dohop/main_search.php'; ?>



        </div>

       </div>

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

      <img class="animated fadeIn" style="height:400px" src="<?php echo PT_SLIDER_IMAGES.$ms->slide_image;?>" alt="">

      <div class="container hidden-xs">

        <div class="carousel-caption">

          <div class="row hidden-sm" style="margin-top:140px">

            <div class="slider-cap">

              <h1 class="text-right wow fadeInUp" style="font-size:48px"><strong><?php echo $sliderlib->title;?></strong></h1>

              <p class="text-right wow flash"><?php echo $sliderlib->desc;?> <span class="star"><?php  for($i=1; $i<=$ms->slide_optional_text; $i++) { echo "<i class='fa fa-star'></i>"; } ?></span></p>

             <!--  <p class="text-left"><?php echo $ms->slide_optional_text;?></p> -->

            </div>

          </div>

        </div>

      </div>

    </div>

    <?php } ?>

  </div>

 <a class="left carousel-control" href="#Slider" data-slide="prev"> <!--<span class="glyphicon glyphicon-chevron-left"></span>--> </a>

  <a class="right carousel-control" href="#Slider" data-slide="next"> <!--<span class="glyphicon glyphicon-chevron-right"></span>--> </a>

</div>

