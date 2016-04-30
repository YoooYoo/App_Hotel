 <?php  if(pt_main_module_available('cars')){ ?>
          <div class="tab-pane fade" id="cars">

    <?php $lccount = 4;

  foreach($latest_cars as $lc){
    /* $ocity = pt_get_city_name($lt->tour_ocity);
       $dcity = pt_get_city_name($lt->tour_dcity);*/

  $pt_cars->set_id($lc->car_id);
  $pt_cars->car_short_details();
  $lccount++; if($lccount == 1){
  $activeclass = "active"; }else{
  $activeclass = ""; } ?>

          <div class="panel-body white offset-0">
          <div class="col-sm-4 col-lg-3 col-md-4">

                    <?php $cimg = pt_default_car_image($lc->car_id); if(empty($cimg)){ ?>
                    <a href="<?php echo base_url();?>cars/<?php echo $lc->car_slug;?>"> <img src="<?php echo PT_BLANK; ?>" class="<?php echo imgthumb;?>" alt="<?php echo $lc->car_slug;?>" /> </a>
                    <?php }else{ ?>
                    <a href="<?php echo base_url();?>cars/<?php echo $lc->car_slug;?>"> <img src="<?php echo PT_CARS_SLIDER_THUMB.$cimg; ?>" class="<?php echo imgthumb;?>" alt="<?php echo $lc->car_slug;?>" /> </a>
                    <?php } ?>

          </div>

          <div class="col-md-8 col-lg-9">
           <p><a class="fs24" href="<?php echo base_url();?>cars/<?php echo $lc->car_slug;?>"><?php echo $pt_cars->title;?> </a></p>


          <?php echo $lc->sett_name;?>  <span class="star"><?php pt_create_stars($lc->car_stars); ?></span>
          <span class="pull-right main-price">

              <?php 
              $basicprice = $lc->car_basic_price;
              $discountprice = $lc->car_basic_discount;
              if($discountprice > 0){
              if(empty($mulcur)){ ?>

                      <strong><small><?php echo $app_settings[0]->currency_code;?></small> <?php echo $app_settings[0]->currency_sign.$discountprice;?></strong>/<del><small><?php echo  $app_settings[0]->currency_sign.$basicprice;?></small></del>
            <?php }else{ ?>
            <strong>  <?php echo @$geo->pt_convert($discountprice);?></strong> / <del><small><?php echo @$geo->pt_convert($basicprice);?></small></del>
            <?php } }else{ if(empty($mulcur)){ ?>
            <strong> <small>   <?php echo $app_settings[0]->currency_code;?></small> <?php echo $app_settings[0]->currency_sign.$basicprice;?>  </strong>
            <?php }else{ ?>
            <strong><?php echo @$geo->pt_convert($basicprice);?> </strong>
            <?php } } ?>
                  </span>
                 </div>
                <br>
             </div>
            <div class="line3"></div>
           <?php }  ?>
       </div>
      <?php } ?>