<div class="tabbable booking-details-tabbable">
  <ul class="nav nav-tabs">
    <li class="active text-center"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i> <?php echo trans('017');?></a> </li>
    <li class="text-center"><a href="#google-map-tab" data-toggle="tab" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $hotel->latitude;?>/<?php echo $hotel->longitude;?>/hotel/<?php echo $hotel->id;?>','mapContent')"><i class="fa fa-map-marker"></i> <?php echo trans('041');?></a> </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab-1">
      <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
        <?php foreach($hotel->sliderImages as $img){ ?>
        <img src="<?php echo $img['fullImage']; ?>" />
        <?php } ?>
      </div>
    </div>
    <div class="tab-pane fade" id="google-map-tab">
      <div id="mapContent">
      </div>
    </div>
  </div>
</div>