<style>
  #owl-demo .item{padding:0px;margin:10px;height:auto;min-height:200px;}
  .owl-buttons{position:absolute;z-index:999;top:175px;width:100%}
  .owl-buttons div{padding:2px 11px;color:#929292;display:inline-block;zoom:1;background:#f2f2f2;filter: Alpha(Opacity=50);opacity:.5;border:3px solid #929292;}
  .owl-buttons div>i.fa{margin:2px 0px 0px 0px;padding:0px;font-size:20px;color:#929292}
  .owl-buttons>.owl-prev{left:-45px;top:0px;position:absolute}
  .owl-buttons>.owl-next{right:-45px;top:0px;position:absolute}
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
          <div id="owl-demo" class="owl-carousel"> <?php //print_r(); ?>
            <?php foreach($hotel->relatedHotels as $item){ ?>
            <a href="<?php echo $item->slug;?>">
              <div class="item">
                <div class="demo_img trim img-fade" style=" background:url(<?php echo $item->thumbnail;?>) no-repeat center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;"></div>
                <div class="featured">
                  <div style="padding:5px">
                    <p class="title strong go-text-right"><?php echo character_limiter($item->title,20); ?></p>
                    <div class="clearfix"></div>
                    <p class="go-text-right" style="color:#999999"><i class="fa fa-map-marker go-right"></i>  <?php echo character_limiter($item->location,18); ?> &nbsp;</p>
                    <div class="clearfix"></div>
                    <div class="pull-left go-right">
                      <?php echo $item->stars;?>
                    </div>
                    <div class="pull-right go-left">
                      <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </a>
            <?php } ?>
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