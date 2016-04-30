<?php  if(pt_main_module_available('tours')){ ?>
          <div class="tab-pane fade" id="tours">

    <?php $ltcount = 4;

  foreach($latest_tours as $lt){
     $ocity = pt_get_city_name($lt->tour_ocity);
       $dcity = pt_get_city_name($lt->tour_dcity);
    $pt_tours->set_id($lt->tour_id);
  $pt_tours->tour_short_details();

  $ltcount++; if($ltcount == 1){
  $activeclass = "active"; }else{
  $activeclass = ""; } ?>

          <div class="panel-body white offset-0">
          <div class="col-sm-4 col-lg-3 col-md-4">

                    <?php $timg = pt_default_tour_image($lt->tour_id); if(empty($timg)){ ?>
                    <a href="<?php echo base_url();?>tours/<?php echo $lt->tour_slug;?>"> <img src="<?php echo PT_BLANK; ?>" class="<?php echo imgthumb;?>" alt="<?php echo $lt->tour_slug;?>" /> </a>
                    <?php }else{ ?>
                    <a href="<?php echo base_url();?>tours/<?php echo $lt->tour_slug;?>"> <img src="<?php echo PT_TOURS_SLIDER_THUMB.$timg; ?>" class="<?php echo imgthumb;?>" alt="<?php echo $lt->tour_slug;?>" /> </a>
                    <?php } ?>

          </div>

          <div class="col-md-8 col-lg-9">
           <p><a class="fs24" href="<?php echo base_url();?>tours/<?php echo $lt->tour_slug;?>"><?php echo $pt_tours->title;?> </a></p>

          <span style="font-size:16px"><label><?php echo trans('0218');?> </label>: <?php echo $ocity[0]->city_name;?>
          <br><label><?php echo trans('0219');?> </label> : <?php echo $dcity[0]->city_name;?></span>

          <span class="pull-right fs24" style="margin-top:-30px">

              <?php

              $basicprice = $lt->tour_basic_price;
              $discountprice = $lt->tour_basic_discount;
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