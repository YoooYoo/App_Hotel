<style>
    #gallery-t-group {
        width: 100%;
    }

    .rsDefaultInv,
    .rsDefaultInv .rsOverflow,
    .rsDefaultInv .rsSlide,
    .rsDefaultInv .rsVideoFrameHolder,
    .rsDefaultInv .rsThumbs {

    }

    #gallery-t-group .rsThumb {
        float: left;
        overflow: hidden;
        width: 56px;
        height: 54px;
    }

    #gallery-t-group .rsThumbs {
        width: 285px;
        height: 100%;
        position: absolute;
        top: 0;
        padding: 0 0 0 1px;
        right: 0;
    }

    #gallery-t-group .rsGCaption {
        right: 285px;
        line-height: 12px;
        padding: 1px 7px;
        font-size: 11px;
        background: #EEE;
        position: absolute;
        width: auto;
        bottom: 0;
        float: none;
        text-align: left;
    }

    @media screen and (min-width: 0px) and (max-width: 1200px) {
        #gallery-t-group .rsThumbs {
            width: 228px;
        }

        #gallery-t-group .rsGCaption {
            right: 228px;
        }
    }

    @media screen and (min-width: 0px) and (max-width: 760px) {
        #gallery-t-group .rsThumbs {
            left: 0;
            position: relative;
            width: 100%;
            height: auto;
            padding: 1px 0 0 1px;
        }

        #gallery-t-group .rsThumbsContainer {
            height: auto !important;
        }

        #gallery-t-group .rsGCaption {
            right: 0;
        }

    }
</style>

<script>
    $(function () {
        $('a[href*=#]:not([href=#])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>


<!-- Jquery ProductSlider -->
<link href="assets/include/ProductSlider/ProductSlider.css" rel="stylesheet">
<script src="assets/include/ProductSlider/jquery.ProductSlider.min.js"></script>
<!-- Jquery ProductSlider -->
<script type='text/javascript'>//<![CDATA[
    $(window).load(function () {
        var fixmeTop = $('.fixme').offset().top;
        $(window).scroll(function () {
            var currentScroll = $(window).scrollTop();
            if (currentScroll >= fixmeTop) {
                $('.fixme').css({
                    position: 'fixed',
                    top: '0',
                    left: '0'
                });
                $(".fixme").addClass("navbar-fixed-top");
            } else {
                $('.fixme').css({
                    position: 'static'
                });
            }
        });
    });//]]>

</script>
<style>
    .collapsebtn2 {
        width: 100%;
        height: 32px;
        border: 0px solid black;
        text-align: left;
        padding-right: 20px;
        color: #666666;
        font-size: 14px;
        font-weight: bold;
        background: #FFFFFF;
    }

    .btn-blue {
        background-color: #3394de !important;
        border-bottom: 5px solid #1F78BD !important;
    }
</style>


<div style="margin:8px"></div>


<div id="chkavblty"></div>

<div class="container">

    <?php $currenturl = current_url(); ?>

    <div class="<?php echo maindiv; ?>">
        <div class=" well well-sm whitewell">
            <div class="col-md-8 col-lg-8 offset-0">
                <div id="gallery-t-group" class="royalSlider rsDefaultInv">

                    <?php if ( ! empty( $HotelImages['HotelImage'] )) {
                        foreach ($HotelImages['HotelImage'] as $hi) { ?>
                            <a class="rsImg" data-rsBigImg="<?php echo $hi['url']; ?>" href="<?php echo $hi['url']; ?>">
                                <img width="96" height="72" class="rsTmb img-thumbnail"
                                     src="<?php echo $hi['thumbnailUrl']; ?>"/></a>
                        <?php }
                    } else { ?>
                        <a class="rsImg" data-rsBigImg="<?php echo PT_BLANK; ?>" href="<?php echo PT_BLANK; ?>"><img
                                width="96" height="72" class="rsTmb img-thumbnail" src="<?php echo PT_BLANK; ?>"/></a>
                    <?php } ?>

                </div>
            </div>

            <div class="col-md-4 col-lg-4 detailsright offset-0">

                <div class="panel-body">

                    <h4><?php echo character_limiter($HotelSummary['name'], 55); ?></h4>

                </div>

                <div class="line3"></div>

                <div class="panel-body">


                    <div class="col-lg-7n col-md-6">
                        <h2>
                            <i class="fa fa-smile-o text-warning"></i> <?php echo $HotelSummary['tripAdvisorReviewCount']; ?>
                        </h2>
                        <?php echo trans('0194'); ?>
                    </div>

                    <div class="col-lg-5 col-md-6">
                        <h2><i class="fa fa-thumbs-up text-primary"></i> <?php echo $HotelSummary['hotelRating']; ?>
                            /<strong class="rating10">5</strong></h2>
                        <?php echo trans('0195'); ?>
                    </div>

                </div>
                <div class="line3"></div>

                <div class="panel-body">
                    <div class="pull-left">
                        <img src="<?php echo $HotelSummary['tripAdvisorRatingUrl']; ?>" alt="Trip Advisor Rating"/>
                    </div>
                    <div class="pull-right">
                        <a href="<?php echo base_url(); ?>home/maps/<?php echo $HotelSummary['latitude']; ?>/<?php echo $HotelSummary['longitude']; ?>/hotel/<?php echo 0; ?>"
                           class="btn btn-success btn-sm showmap maps cboxElement"><i
                                class="fa fa-map-marker"></i> <?php echo trans('064'); ?></a>
                    </div>
                </div>

                <div class="line3"></div>

                <div class="panel-body hidden-md">
                    <span><strong><?php echo trans('0227'); ?> </strong> <?php echo $HotelDetails['numberOfRooms']; ?></span>
                </div>

            </div>

            <div class="clearfix"></div>

        </div>

    </div>


    <?php include 'includes/rooms.php'; ?>
    <?php include 'includes/overview.php'; ?>


    <iframe style="display:none"
            src="<?php echo base_url(); ?>home/maps/<?php echo $HotelSummary['latitude']; ?>/<?php echo $HotelSummary['longitude']; ?>/hotel/<?php echo 0; ?>"
            width="100%" height="200" frameborder="0" style="border:0"></iframe>

    <!--<div class="panel panel-primary weather"  style="max-height:230px !important">

     <div class="panel-body">
        <link rel="stylesheet" type="text/css" href="assets/include/weather/css/default.css" />
        <link rel="stylesheet" type="text/css" href="assets/include/weather/css/climacons.css" />
        <link rel="stylesheet" type="text/css" href="assets/include/weather/css/component2.css" />
        <script src="assets/include/weather/js/modernizr.custom.js"></script>

        <div class="container" style="max-width: 200px">
          <ul id="rb-grid" class="rb-grid clearfix">
<?php if ( ! empty( $myweather->city )) { ?><li class="icon-clima-<?php echo pt_weather_icons($myweather->list[0]->weather[0]->description); ?>">
            <h3><?php echo $myweather->city->name; ?></h3>
              <span class="rb-temp"><?php echo ceil($myweather->list[0]->temp->max); ?>&deg;C</span>
              <div class="rb-overlay">
                <span class="rb-close">close</span>
                <div class="rb-week">
                  <div><span class="rb-city"><?php echo $myweather->city->name; ?></span><span class="icon-clima-<?php echo pt_weather_icons($myweather->list[0]->weather[0]->description); ?>"></span><span><?php echo ceil($myweather->list[0]->temp->max); ?>&deg;C</span></div>
<?php foreach ($myweather->list as $w) { ?> <div><span><?php echo date("D",
        $w->dt); ?><h5><?php echo pt_show_date_php($w->dt); ?></h5></span><span class="icon-clima-<?php echo pt_weather_icons($w->weather[0]->description); ?>"></span><span><?php echo ceil($w->temp->max); ?>&deg;C </span></div> <?php } ?>
               </div>
              </div>
            </li>
          </ul>     <br>
          <script> $(function() { Boxgrid.init(); }); </script>
          <script src="assets/include/weather/js/jquery.fittext.js"></script>
          <script src="assets/include/weather/js/boxgrid.example2.js"></script>
            <?php } ?>
        </div>
      </div>
      </div>
-->

    <?php if ( ! empty( $related_hotels )) { ?>
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo trans('063'); ?></div>
            <?php
            foreach ($related_hotels as $rh):
                $hotelslib->set_id($rh->hotel_id);
                $hotelslib->hotel_short_details();
                $himg = pt_default_hotel_image($rh->hotel_id);
                ?>
                <div class="panel-body white offset-0">
                    <div class="col-md-6">
                        <a href="<?php echo base_url(); ?>hotels/<?php echo $rh->hotel_slug; ?>?lang=<?php echo $lang_set; ?>">
                            <?php if (empty( $himg )) { ?>
                                <img src="<?php echo PT_BLANK; ?>">
                            <?php } else { ?>
                                <img src="<?php echo PT_HOTELS_SLIDER_THUMBS . $himg; ?>" class="img-responsive"
                                     alt="<?php echo $rh->hotel_slug; ?>">
                            <?php } ?>
                        </a>
                    </div>
                    <div class="col-md-6">
          <span>
            <a href="<?php echo base_url(); ?>hotels/<?php echo $rh->hotel_slug; ?>?lang=<?php echo $lang_set; ?>"><?php echo $hotelslib->title; ?> </a><br>
              <?php pt_create_stars($rh->hotel_stars);
              $advprice = pt_hotel_advanced_price($rh->hotel_id);

              $basicprice    = $rh->hotel_basic_price;
              $discountprice = $rh->hotel_basic_discount;
              if ( ! empty( $advprice )) {
                  $basicprice    = $advprice['basic'];
                  $discountprice = $advprice['discount'];
              }

              if ($discountprice > 0) {
                  if (empty( $mulcur )) {
                      ?>
                      <p><span class="green strong size14"><small><?php echo $app_settings[0]->currency_code; ?></small> <?php echo $app_settings[0]->currency_sign . $discountprice; ?> </span>
                          /
                          <del><?php echo $app_settings[0]->currency_sign . $basicprice; ?></del>
                      </p>
                  <?php } else { ?>
                      <p><?php echo $geo->pt_convert($discountprice, 'green strong size14'); ?> /
                          <del><?php echo $geo->pt_convert($basicprice); ?></del>
                      </p>
                  <?php }
              } else {
                  if (empty( $mulcur )) { ?>
                      <p><span class="green strong size14"><small><?php echo $app_settings[0]->currency_code; ?></small> <?php echo $app_settings[0]->currency_sign . $basicprice; ?> </span>
                      </p>
                  <?php } else { ?>
                      <h2 class="text-center"><strong> </strong></h2>
                      <p><span class="green strong size14"><?php echo $geo->pt_convert($basicprice); ?> </span></p>
                  <?php }
              } ?>
          </span>
                    </div>
                </div>
                <div class="line3"></div>
            <?php endforeach; ?>
        </div>
    <?php } ?>


</div>


<!-- Jquery ProductSlider Slider -->
<script>
    jQuery(document).ready(function () {
        var win = $(window);
        var slider = $('#gallery-t-group').royalSlider({
            controlNavigation: 'thumbnails',
            thumbs: {
                orientation: 'vertical',
                navigation: false,
                fitInViewport: (win.width() < 760) ? false : true,
                spacing: 1,
                autoCenter: false
            },
            deeplinking: {
                enabled: true,
                change: true,
                prefix: 'image-'
            },
            globalCaption: false,
            numImagesToPreload: 2,
            fadeinLoadedSlide: true,
            imageAlignCenter: true,
            imageScaleMode: 'fill',
            transitionType: 'fade',
            autoScaleSlider: true,
            autoScaleSliderWidth: 900,
            autoScaleSliderHeight: 400,
            loop: true,
            arrowsNav: false,
            keyboardNavEnabled: true
        }).data('royalSlider');

        win.resize(function () {
            if (win.width() < 760) {
                slider.st.thumbs.fitInViewport = false;
            } else {
                slider.st.thumbs.fitInViewport = true;
            }
        });
        $('#btn').click(function () {
            console.log('click');
            return false;
        });
    });


</script>
<!-- Jquery ProductSlider Slider -->






