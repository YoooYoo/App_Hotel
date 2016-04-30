<div class="tabbable booking-details-tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i> <?php echo trans('017');?></a> </li>
    <li><a href="#videos" data-toggle="tab"><i class="fa fa-play-circle"></i> <?php echo trans('018');?></a> </li>
    <li><a href="#google-map-tab" data-toggle="tab"><i class="fa fa-map-marker"></i> <?php echo trans('041');?></a> </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab-1">
      <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
        <?php if(!empty($slider_images)){ foreach($slider_images as $si){ ?>
        <img src="<?php echo PT_TOURS_SLIDER.$si->timg_image; ?>" />
        <?php }}else {?>
        <img src="<?php echo PT_BLANK;?>" alt="<?php echo character_limiter($hoteltitle, 45);?>" title="<?php echo character_limiter($hoteltitle, 45);?>" />
        <?php }?>
      </div>
    </div>
    <div class="tab-pane fade" id="google-map-tab">
      <?php if($has_map){ ?>
      <div class="panel panel-default" id="map">
        <div class="panel-heading"><i class="fa fa-tags"></i> <?php echo trans('0272');?></div>
        <iframe src="<?php echo base_url();?>tours/tour_maps/<?php echo $details[0]->tour_id;?>" width="100%" height="400" frameborder="0" style="border:0"></iframe>
      </div>
      <?php } ?>
    </div>
    <?php if(!empty($interior_images)){ ?>
    <div class="tab-pane fade" id="int">
      <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
        <?php foreach($interior_images as $inti){ ?>
        <img src="<?php echo PT_HOTELS_INTERIOR.$inti->himg_image; ?>" alt="" title="" />
        <?php } ?>
      </div>
    </div>
    <?php }?>
    <?php if(!empty($exterior_images)){ ?>
    <div class="tab-pane fade" id="ext">
      <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
        <?php foreach($exterior_images as $ei){ ?>
        <img src="<?php echo PT_HOTELS_EXTERIOR.$ei->himg_image; ?>" alt="" title="" />
        <?php } ?>
      </div>
    </div>
    <?php }  ?>
    <div class="tab-pane fade" id="videos">

     <!-- videos -->
             <?php if($has_video){ ?>
              <div class="panel panel-default" id="videos">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <div class="alert-message alert-message-warning">
                     <h4><?php echo trans('018');?></h4>
                     </div>
                    </div>
                   </div>
                  <div class="panel-body">
                 <div class="tourvids"></div>
                </div>
               </div> <?php } ?>
              <!-- videos -->

    </div>
  </div>
</div>



<script>
   jQuery(document).ready(function($) {

   $('.showcalendar').click(function(){
      var roomid = $(this).prop('id');
      $("#roomcalendar").html("<div id='rotatingDiv'></div>");
      $('#availability-status').modal('show');
    $.post("<?php echo base_url();?>hotels/roomcalendar", { roomid: roomid}, function(theResponse){
    $("#roomcalendar").html(theResponse);

    });


    });

   $('#ProductSlider').royalSlider({
   fullscreen: {
   enabled: true,
   nativeFS: true
   },
   controlNavigation: 'thumbnails',
   autoScaleSlider: true,
   autoScaleSliderWidth: 960,
   autoScaleSliderHeight: 850,
   loop: true,
   imageScaleMode: 'fit-if-smaller',
   navigateByClick: true,
   numImagesToPreload:2,
   arrowsNav:true,
   arrowsNavAutoHide: true,
   arrowsNavHideOnTouch: true,
   keyboardNavEnabled: true,
   fadeinLoadedSlide: true,
   globalCaption: true,
   globalCaptionInside: false,
   thumbs: {
   appendSpan: true,
   firstMargin: true,
   paddingBottom: 4
   }
   });
   });

</script>
<!-- Jquery ProductSlider Slider -->