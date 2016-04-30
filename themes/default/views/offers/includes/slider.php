<div class="tabbable booking-details-tabbable">
  <div class="tab-content">
      <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
      <?php foreach($offer->sliderImages as $img){ ?>
        <img src="<?php echo $img['fullImage']; ?>" />
        <?php } ?>
      </div>
  </div>
</div>