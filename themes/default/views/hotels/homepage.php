<div role="tabpanel" class="tab-pane fade active in" id="HOTELZ" aria-labelledby="home-tab">
  <?php if(!empty($featuredHotels)){ ?>
  <div class="col-md-6 go-right">
    <div class="row">
      <br>
      <p class="featured-text strong go-text-right"><?php echo trans('056');?></p>
      <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:7px 0px 7px 0px !important">
      <?php foreach($featuredHotels as $item){ ?>
      <a href="<?php echo $item->slug;?>" class="featured rippler rippler-inverse">
        <div class="featured">
          <div class="col-md-3 row go-right">
            <div class="lazy owl">
              <div class="item"><img class="lazyOwl img-fade" data-src="<?php echo $item->thumbnail;?>"></div>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 go-right">
            <p class="title strong go-text-right"><?php echo $item->title;?></p>
            <p class="subtitle go-right"><i class="fa fa-map-marker"></i> <?php echo $item->location;?></p>
            <div class="clearfix"></div>
            <span class="go-right"><?php echo $item->stars;?></span>
          </div>
          <div class="col-lg-3 col-md-3 row go-left">
            <span class="pull-right strong" style="color:#36C;font-size:16px;margin-top:15px">
              <small class="color-gray weak go-right"><?php echo trans('0273');?></small>
              <div class="clearfix"></div>
              <span><span class="go-left"><?php echo $item->currCode;?> <?php echo $item->currSymbol; ?>&nbsp;</span><?php echo $item->price;?></span>
            </span>
          </div>
          <div class="clearfix"></div>
        </div>
      </a>
      <div class="clearfix"></div>
      <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:6px 0px 6px 0px !important">
      <?php } ?>
    </div>
  </div>
  <?php } if(!empty($popularHotels)){ ?>
  <div class="row">
    <div class="col-md-6 go-left">
      <br>
      <p class="title strong go-text-right"><?php echo trans('0353');?></p>
      <div class="panel panel-default">
        <div class="lazy owl">
          <div class="item"><img class="lazyOwl" data-src="<?php echo $theme_url; ?>assets/images/hotels-home.jpg"></div>
        </div>
        <div class="panel-body">
          <?php foreach($popularHotels as $item){ ?>
          <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:7px 0px 7px 0px !important">
          <a href="<?php echo $item->slug;?>" class="featured">
            <div class="featured">
              <div class="col-md-3 row go-right">
                <div class="lazy owl">
                  <div class="item"><img class="lazyOwl img-fade" data-src="<?php echo $item->thumbnail;?>"></div>
                </div>
              </div>
              <div class="col-lg-7 col-md-7 go-right">
                <p class="title strong go-text-right"><?php echo $item->title;?></p>
                <p class="subtitle go-right"><i class="fa fa-map-marker"></i> <?php echo $item->location;?></p>
                <div class="clearfix"></div>
                <span class="go-right"><?php echo $item->stars;?></span>
              </div>
              <div class="col-lg-3 col-md-3 row go-left">
                <span class="pull-right strong" style="color:#36C;font-size:16px;margin-top:15px">
                  <small class="color-gray weak go-right"><?php echo trans('0273');?></small>
                  <div class="clearfix"></div>
                  <span><span class="go-left"><?php echo $item->currCode;?> <?php echo $item->currSymbol; ?>&nbsp;</span><?php echo $item->price;?></span>
                </span>
              </div>
              <div class="clearfix"></div>
            </div>
          </a>
          <div class="clearfix"></div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<style>
  /* OWL */
  .owl-item.loading{ min-height:80px; background: url(<?php echo $theme_url; ?>assets/images/loading.svg) no-repeat center; }
  .owl .item img{ display: block; width: 100%; height: auto; }
  .lazy .owl-wrapper{ display: block !important; width: 100% !important; height: auto !important; }
  .lazy .owl-item{ display: block !important; width: 100% !important; height: auto !important; }
  /* OWL */
</style>