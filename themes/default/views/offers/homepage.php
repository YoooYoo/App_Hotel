<!---Special Offers-->
<?php if($offersCount > 0){ ?>
<section class="body-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style=" margin:2% 0px;">
        <h3 class="heading_01 text-center"><strong><?php echo trans('002');?></strong></h3>
        <div style="position:relative;">
          <div class="owl-buttons hidden-sm hidden-xs">
            <div class="owl-prev prev"><i class="fa fa-caret-left"></i></div>
            <div class="owl-next next"><i class="fa fa-caret-right"></i></div>
          </div>
          <div class="spcial_offers owl owl-carousel">
            <?php foreach($specialoffers as $offer){ ?>
            <a href="<?php echo $offer->slug;?>">
              <div class="item" style="  padding: 0px;
                margin: 10px;">
                <div class="demo_img trim img-fade" style=" background:url(<?php echo $offer->thumbnail;?>) no-repeat center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;"></div>
                <div class="demo_content">
                  <p class="title go-right"><?php echo $offer->title;?></p>
                  <p class="subtitle go-text-right"><?php echo character_limiter($offer->desc,120);?></p>
                </div>
                <div class="demo_rate">
                  <div class="rate">
                    <h3><span class="go-left"><?php echo $offer->currCode;?> <?php echo $offer->currSymbol; ?> &nbsp; </span> &nbsp; <span class="strong h3"><?php echo $offer->price;?></span></h3>
                  </div>
                  <button class="rate_click"><i class="fa fa-angle-right"></i></button>
                </div>
              </div>
            </a>
            <?php } ?>
          </div>
        </div>
        <!-- another -->
      </div>
    </div>
  </div>
</section>
<?php } ?>
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/include/owl/owl.css" />
<script>
  $(document).ready(function(){
    var owl = $(".spcial_offers");
    var owl2 = $(".hotels");

    owl.owlCarousel({items:5,itemsDesktop:[1199,4],itemsDesktopSmall:[979,3],itemsTablet:[768,3],itemsTabletSmall:[600,2],itemsMobile:[479,1]});
    owl2.owlCarousel({items:5,itemsDesktop:[1199,4],itemsDesktopSmall:[979,3],itemsTablet:[768,3],itemsTabletSmall:[600,2],itemsMobile:[479,1]});

    $(".owl-next").click(function(){owl.trigger('owl.next');})
    $(".owl-prev").click(function(){owl.trigger('owl.prev');})

    $(".owl-next2").click(function(){owl2.trigger('owl.next');})
    $(".owl-prev2").click(function(){owl2.trigger('owl.prev');})

    }

    );
</script>