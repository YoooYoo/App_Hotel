
      <?php if (!empty ($related_hotels)) {?>

      <style>

      #owl-demo .item{background:#fff;padding:0px;margin:10px;color:#fff;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-align:center;height:auto;min-height:350px;-webkit-border-radius:8px;-moz-border-radius:8px;border-radius:8px}.owl-buttons{position:absolute;z-index:999;top:175px;width:100%}.owl-buttons div{padding:2px 11px;-webkit-border-radius:30px;-moz-border-radius:30px;border-radius:30px;color:#929292;display:inline-block;zoom:1;background:#f2f2f2;filter: Alpha(Opacity=50);opacity:.5;border:3px solid #929292;text-align:center}.owl-buttons div>i.fa{margin:2px 0px 0px 0px;padding:0px;text-align:center;font-size:20px;color:#929292}.owl-buttons>.owl-prev{left:-45px;top:0px;position:absolute}.owl-buttons>.owl-next{right:-45px;top:0px;position:absolute}

      </style>
<link rel="stylesheet" href="assets/include/owl/owl.css" />


     <section class="body-bg">

  <div class="container">

    <div class="row">

      <div class="col-md-12" style=" margin:2% 0px;">

        <h3 class="heading_01 text-center"><strong><?php echo trans('0290');?></strong></h3>

        <div style="position:relative;">

          <div class="owl-buttons hidden-sm hidden-xs">

            <div class="owl-prev"><i class="fa fa-caret-left"></i></div>

            <div class="owl-next"><i class="fa fa-caret-right"></i></div>

          </div>

          <div id="owl-demo" class="owl-carousel">



              <?php
            foreach ($related_hotels as $rh) :
            		$hotelslib->set_id($rh->hotel_id);
            		$hotelslib->hotel_short_details();
            		$himg = pt_default_hotel_image($rh->hotel_id);
            		?>
            <a href="<?php echo base_url();?>hotels/<?php echo $rh->hotel_slug;?>?lang=<?php echo $lang_set;?>">

              <div class="item">

              <?php if (empty ($himg)) {?>
                              <div class="demo_img trim fade-img" style=" background:url(<?php echo PT_BLANK;?>) no-repeat center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;"></div>

                     <?php }else {?>

                              <div class="demo_img trim fade-img" style=" background:url(<?php echo PT_HOTELS_SLIDER_THUMBS . $himg;?>) no-repeat center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;"></div>

                     <?php }?>


                <div class="demo_content">

                  <h4><?php echo $hotelslib->title;?></h4>

                 <?php pt_create_stars($rh->hotel_stars);?>

                </div>

                <div class="demo_rate">

                  <div class="rate">

                  <?php
                      $advprice = pt_hotel_advanced_price($rh->hotel_id);
                      $basicprice = $rh->hotel_basic_price;
                      $discountprice = $rh->hotel_basic_discount;
                      if (!empty ($advprice)) {
                      		$basicprice = $advprice['basic'];
                      		$discountprice = $advprice['discount'];
                      }
                      if ($discountprice > 0) {
                      		if (empty ($mulcur)) {
                      				?>



                  <?php }}else {if (empty ($mulcur)) {?>

                    <h3><span class="fs14"><?php echo $app_settings[0]->currency_code;?></span> <?php echo $app_settings[0]->currency_sign . $basicprice;?></h3>
                      <?php }}?>
                  </div>

                  <button class="rate_click"><i class="fa fa-angle-right"></i></button>

                </div>

              </div>

            </a>
             <?php endforeach;?>
          <?php }?>




          </div>

        </div>

      </div>

    </div>

  </div>

</section>


<script src="assets/include/owl/owl.carousel.js"></script>
<script>$(document).ready(function(){var owl=$("#owl-demo");owl.owlCarousel({items:5,itemsDesktop:[1199,4],itemsDesktopSmall:[979,3],itemsTablet:[768,3],itemsTabletSmall:[600,2],itemsMobile:[479,1]});$(".owl-next").click(function(){owl.trigger('owl.next');})
$(".owl-prev").click(function(){owl.trigger('owl.prev');})});
</script>


