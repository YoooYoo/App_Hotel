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

.detailsright {
height: 322px;
border-left: 1px solid #e7e7e7;
}
</style>

    <div id="chkavblty"></div>
     <div class="container">
   <?php  $mulcur = pt_default_currencies(); $currenturl = current_url();?>
   <div class="col-lg-12">

<div class="pull-left"><h2><?php echo $cartitle;?></h2></div>
<div class="pull-right"><h2>


                  <?php
                  $advprice = pt_car_advanced_price($details[0]->car_id);
                  $mulcur = pt_default_currencies();
                  $basicprice = $details[0]->car_basic_price;
                   $discountprice = $details[0]->car_basic_discount;
                  if(!empty($advprice)){
                  $basicprice = $advprice['basic'];
                  $discountprice = $advprice['discount'];
                  }

                  if($discountprice > 0){
                  if(empty($mulcur)){
                  ?>
           <small><?php echo $app_settings[0]->currency_code;?></small> <?php echo $app_settings[0]->currency_sign.$discountprice;?> / <del><?php echo $app_settings[0]->currency_sign.$basicprice;?></del>
               <?php }else{ ?>
               <?php echo $geo->pt_convert($discountprice);?> / <del><?php echo $geo->pt_convert($basicprice);?></del>
               <?php } }else{ if(empty($mulcur)){ ?>
             <small><?php echo $app_settings[0]->currency_code;?></small> <?php echo $app_settings[0]->currency_sign.$basicprice;?>
               <?php }else{ ?>
             <?php echo $geo->pt_convert($basicprice);?>
               <?php } } ?>


</h2></div>

  </div>

   <div class="col-lg-12">
<div class=" well well-sm whitewell">
<div class="col-md-8 col-lg-8 offset-0">
<div id="gallery-t-group" class="royalSlider rsDefaultInv">

            <?php if(!empty($slider_images)){ foreach($slider_images as $si){ ?>
            <a class="rsImg" data-rsBigImg="<?php echo PT_CARS_SLIDER.$si->cimg_image; ?>" href="<?php echo PT_CARS_SLIDER.$si->cimg_image; ?>">
            <img style="width:96px !important;height:72px !important" class="rsTmb img-thumbnail" src="<?php echo PT_CARS_SLIDER.$si->cimg_image; ?>" /></a>
            <?php } }else{ ?>
            <a class="rsImg" data-rsBigImg="<?php echo PT_DEFAULT_IMAGE.'noimg.jpg';?>" href="<?php echo PT_DEFAULT_IMAGE.'noimg.jpg';?>"><img style="margin-left:50px !important;"width="96" height="72" class="rsTmb img-thumbnail" src="<?php echo PT_DEFAULT_IMAGE.'noimg.jpg';?>" /></a>
            <?php } ?>

</div>
</div>

<div class="col-md-4 col-lg-4 detailsright offset-0">


         <div class="panel-body">


         <p><?php echo $carslib->city.",".$carslib->state.",".$carslib->country;?></p>
         <p><?php echo $carslib->cartype;?></p>
         <span class="font-size-24 pull-left"> <i class="btn btn-success btn-sm fa fa-plane"></i> <b><?php echo trans('0207');?> </b> </span>
         <span class="star font-size-24 pull-right"><?php pt_create_stars($details[0]->car_stars); ?></span>

         </div>

         <div class="line3"></div>

          <table class="table" style="margin-bottom: 0px;">
                <tr>
                <td class="text-center"><i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0198');?>" class="fa fa-child"></i></td>
                <td class="text-center"><i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0199');?>" class="fa fa-briefcase"></i></td>
                <td class="text-center"><i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0200');?>" class="fa fa-fax"></i></td>
                <td class="text-center"><i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0201');?>" class="fa fa-joomla"></i></td>
                </tr>
                <tr style="font-size:12px">
                <td class="text-center"><?php echo $details[0]->car_passengers;?></td>
                <td class="text-center"><?php echo $details[0]->car_baggage;?></td>
                <td class="text-center"><?php echo $details[0]->car_doors;?></td>
                <td class="text-center"><?php echo $details[0]->car_transmission;?></td>
                </tr>

                </table>




         <div class="clearfix"></div>
         <div class="line3"></div>

         <div class="panel-body">
          <form action="<?php echo base_url();?>cars/book/<?php echo $details[0]->car_slug; ?>" method="GET">
            <div class="col-xs-6 col-sm-6 col-md-6">
               <div class="form-group">
                  <input type="text" class="form-control" id="dpd1" placeholder="<?php echo trans('0210');?>" name="pickup" required>
               </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
               <div class="form-group">
                  <input type="text" class="form-control" id="dpd2" placeholder="<?php echo trans('0211');?>" name="dropoff" required>
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                  <button type="submit" class="btn btn-blue btn-lg btn-block animated flipInX"><i class="fa fa-calendar"></i> <?php echo trans('0142');?></button>
                  <?php $wishlist = pt_check_wishlist($customerloggedin,$currenturl); if($wishlist){ ?>
                  <span class="btn btn-blue  btn-block wish removewishlist animated flipInX"><i style="color: #FF66CC" class="fa fa-heart"></i><span class="wishtext"> <?php echo trans('028');?> </span></span>
                  <?php }else{ ?>
                  <span class="btn btn-blue  btn-block wish addwishlist animated flipInX"><i class="fa fa-heart"></i> <span class="wishtext">  <?php echo trans('029');?></span> </span>
                  <?php } ?>
                  <input type="hidden" id="loggedin" value="<?php echo $customerloggedin;?>" />
                  <input type="hidden" id="addtxt" value=" <?php echo trans('029');?>" />
                  <input type="hidden" id="removetxt" value=" <?php echo trans('028');?>" />
                  <input type="hidden" id="url" value="<?php echo $currenturl;?>" />
                  <input type="hidden" id="title" value="<?php echo $details[0]->car_title;?>" />
               </div>
            </div>
         </form>
         </div>
        </div>
     <div class="clearfix"></div>
    </div>
   </div>



<!-- Jquery ProductSlider -->
<link href="assets/include/ProductSlider/ProductSlider.css" rel="stylesheet">
<script src="assets/include/ProductSlider/jquery.ProductSlider.min.js"></script>
<!-- Jquery ProductSlider -->

<script type="text/javascript">
   $(function(){
   // Start show datepicker on book now click
    $(".chk").on('click',function(){ $('#dpd1').datepicker('show');
    $('html, body').animate({ scrollTop: $('#chkavblty').offset().top }, 'slow');
    });
    // End show datepicker on book now click
   // Add/remove wishlist
   $(".wish").on('click',function(){
   var loggedin = $("#loggedin").val();
   var removelisttxt = $("#removetxt").val();
   var addlisttxt = $("#addtxt").val();
   var url = $("#url").val();
   var title = $("#title").val();
   if(loggedin > 0){ if($(this).hasClass('addwishlist')){
   $.alert.open('confirm', 'Are you sure you want to add it to wishlist', function(answer) {
   if (answer == 'yes'){ $(".wish").removeClass('addwishlist');
   $(".wish").addClass('removewishlist');
   $(".wishtext").html(removelisttxt);
   $.post("<?php echo base_url();?>account/wishlist/add", { loggedin: loggedin, url: url, title: title }, function(theResponse){ });
   } }); }else if($(this).hasClass('removewishlist')){
   $.alert.open('confirm', 'Are you sure you want to remove from wishlist', function(answer) {
   if (answer == 'yes'){ $(".wish").addClass('addwishlist'); $(".wish").removeClass('removewishlist');
   $(".wishtext").html(addlisttxt);
   $.post("<?php echo base_url();?>account/wishlist/remove", { loggedin: loggedin, url: url }, function(theResponse){
   }); } }); } }else{ $.alert.open('info', 'Please Login to add to wishlist.'); } });
   // End Add/remove wishlist
   })
   // End document ready
</script>



      <div class="clearfix"></div>




     <div class="col-md-4">
                  <?php
     if(!empty($details[0]->car_lat) && !empty($details[0]->car_long)){
     ?>
      <span class="thumbnail">
            <a href="<?php echo base_url();?>home/maps/<?php echo $details[0]->car_lat;?>/<?php echo $details[0]->car_long;?>/car/<?php echo $details[0]->car_id;?>" style="position:absolute;margin-top:160px;margin-left:12px" class="btn btn-default btn-sm showmap maps cboxElement"><i class="fa fa-search"></i> View larger</a>
      <iframe src="<?php echo base_url();?>home/maps/<?php echo $details[0]->car_lat;?>/<?php echo $details[0]->car_long;?>/car/<?php echo $details[0]->car_id;?>" width="100%" height="200" frameborder="0" style="border:0"></iframe>
      </span>
      <?php } ?>


      <span class="thumbnail">
               <div class="cpadding1">
               <h3><?php echo trans('061');?>?</h3>
               <p class="size14 grey"><?php echo trans('062');?></p>
               <?php  if(!empty($phone)){ ?>
               <p class="blue"><i class="fa fa-phone"></i> <?php echo $phone;?></p>
               <?php } ?>
            </div>
              </span>



        <?php

        if(!empty($related_cars)){ ?>


           <div class="panel panel-default">
    <div class="panel-heading"><?php echo trans('063');?></div>

              <?php

             foreach($related_cars as $rc):
             $carslib->set_id($rc->car_id);
        $carslib->car_short_details();
             $cimg = pt_default_car_image($rc->car_id);
              ?>

          <div class="panel-body white offset-0">

          <div class="col-md-6">

                  <a href="<?php echo base_url();?>cars/<?php echo $rc->car_slug;?>">
                  <?php if(empty($cimg)){ ?>
                  <img src="<?php echo PT_DEFAULT_IMAGE.'car.png'; ?>" class="" alt="" >
                  <?php }else{ ?>
                  <img src="<?php echo PT_CARS_SLIDER_THUMB.$cimg; ?>" class="img-responsive" alt="" >
                  <?php } ?>
                  </a>

          </div>

          <div class="col-md-6">

          <span >
                     <a href="<?php echo base_url();?>cars/<?php echo $rc->car_slug;?>"><?php echo $carslib->title;?> </a><br>

                     <?php pt_create_stars($rc->car_stars);
                  $advprice = pt_car_advanced_price($rc->car_id);

                  $basicprice = $rc->car_basic_price;
                   $discountprice = $rc->car_basic_discount;
                  if(!empty($advprice)){
                  $basicprice = $advprice['basic'];
                  $discountprice = $advprice['discount'];
                  }

                  if($discountprice > 0){
                  if(empty($mulcur)){
                  ?>
                      <p><span class="green strong size14"><small><?php echo $app_settings[0]->currency_code;?></small> <?php echo $app_settings[0]->currency_sign.$discountprice;?> </span> / <del><?php echo $app_settings[0]->currency_sign.$basicprice;?></del></p>
               <?php }else{ ?>
               <p><?php echo $geo->pt_convert($discountprice,'green strong size14');?> / <del><?php echo $geo->pt_convert($basicprice);?></del></p>
               <?php } }else{ if(empty($mulcur)){ ?>
               <p><span class="green strong size14"><small><?php echo $app_settings[0]->currency_code;?></small> <?php echo $app_settings[0]->currency_sign.$basicprice;?> </span></p>
               <?php }else{ ?>
               <h2 class="text-center"> <strong> </strong> </h2>
               <p><span class="green strong size14"><?php echo $geo->pt_convert($basicprice);?> </span></p>
               <?php } } ?>
                  </span>

           </div>
           </div>
            <div class="line3"></div>
           <?php endforeach; ?>

              </div>

      <?php } ?>
            </div>

      <div class="col-md-8">




       <div class="panel panel-default">
         <div class="panel-heading"><i class="fa fa-info-circle"></i> <?php echo trans('039');?></div>
               <div class="linepace"></div>
               <div class="rooms-body">

               <!-- PHPTRAVELS DESCRIPTION -->
               <?php if(!empty($cardesc)){ ?><p> <strong><?php echo trans('046');?> : </strong> <?php echo $cardesc;?> </p> <div class="line2"></div> <?php } ?><br>
               <!-- END PHPTRAVELS DESCRIPTION -->

              </div>
              </div>


              </div>

            </div>







<!-- Jquery ProductSlider Slider -->
<script>
  jQuery(document).ready(function() {
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
    transitionType:'fade',
    autoScaleSlider: true,
    autoScaleSliderWidth: 900,
    autoScaleSliderHeight: 400,
    loop: true,
    arrowsNav: false,
    keyboardNavEnabled: true
  }).data('royalSlider');

  win.resize(function() {
    if(win.width() < 760) {
      slider.st.thumbs.fitInViewport = false;
    } else {
      slider.st.thumbs.fitInViewport = true;
    }
  });
  $('#btn').click(function() {
    console.log('click');
    return false;
  });
});

</script>
<!-- Jquery ProductSlider Slider -->






