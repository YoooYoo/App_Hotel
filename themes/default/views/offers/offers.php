<div id="Slider" style="background-color:#000;margin-top:-20px" class="carousel carousel-fade slide" data-ride="carousel">
  <div class="carousel-inner">
        <div class="item active">
      <div class="zoomClass">
        <img class="wow fadeIn animated img-rtl animated" src="<?php echo $theme_url; ?>assets/images/offer.jpg" alt="" style="visibility: visible; animation-name: fadeIn; -webkit-animation-name: fadeIn;">
      </div>
    </div>
      </div>
</div>

<div class="container">
  <div  id="top" class="col-md-12">
    <div class="visible-sm visible-xs m100"></div>
    <div class="clearfix"></div>
    <nav class="navbar navbar-default listing-nav">
      <form  action="<?php echo base_url();?>offers/search" method="GET" role="search">
        <div class="col-md-3 col-lg-4 col-sm-12 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('012');?></label>
            <input id="" name="searching" type="text" class="RTL form-control form searching" placeholder=" <?php echo trans('0350');?>" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>">
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('0273');?></label>
            <input type="text" placeholder=" <?php echo trans('0273');?> " name="dfrom" class="RTL form-control form calender-icon dpd1" value="<?php echo $dfrom; ?>" >
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('0274');?></label>
            <input type="text" placeholder=" <?php echo trans('0274');?> " name="dto" class="RTL form-control form calender-icon dpd2" value="<?php echo $dto; ?>" >
          </div>
        </div>
       
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label">&nbsp;</label>
            <button type="submit" class="btn btn-block btn-success"><i class="fa fa-search go-right"></i> <span class="go-right"> &nbsp; <?php echo trans('012');?> &nbsp; </span></button>
          </div>
        </div>
      </form>
    </nav>
  </div>


  <div class="col-xs-12 col=sm-6 col-md-3 col-lg-3 hidden-xs hidden-sm go-right">
    <div style="background-color: #1e65dd; color: #fff;pading:35px;font-weight:bold" class="panel-heading go-text-right"> <?php echo trans('0235');?></div>

    <?php echo run_widget(63); ?>


  </div>
  <div class="visible-xs visible-sm"><br><br></div>
  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

     <?php
        if(!empty($offers)){
        foreach($offers as $item){ ?>

    <div class="panel panel-default">
      <a href="<?php echo $item->slug;?>" class="featured">
        <div class="featured">
          <div class="col-md-4 row go-right">
            <div class="owl">
              <a href="<?php echo $item->slug;?>"><div class="item"><img class="lazyOwl img-fade" data-src="<?php echo $item->thumbnail;?>"></div></a>
            </div>          </div>
          <div class="col-md-8">
            <div class="go-left pull-right">
              <span class="go-left pull-right strong" style="color:#36C;font-size:16px;margin-top:5px">
                <small class="color-gray weak go-right"><?php echo trans('0273');?></small>
                <div class="clearfix"></div>
                                   <span><span class="go-left weak"><?php echo $item->currCode;?> <?php echo $item->currSymbol; ?>&nbsp;</span><?php echo $item->price;?></span>
              </span>
            </div>
            <h5 class="title strong go-text-right"><?php echo $item->title;?></h5>
      <div class="clearfix"></div>
      <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:10px 0px 5px 0px !important">
      <div class="clearfix"></div>
      <span class="hidden-md hidden-sm hidden-xs go-text-right go-right" style="color:#737373"><?php echo character_limiter($item->desc,250);?></span>

      </div>
      <div class="clearfix"></div>
      </div>
      </a>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
    <hr class="row" style="border-top: 1px solid #D9D9D9 !important;margin:10px 0px 10px 0px !important">
    <div class="clearfix"></div>
    <div class="pull-left"><?php echo createPagination($info);?></div>
    <div class="pull-right">
      <a href="#top" class="strong"><?php echo trans('0423');?></a>
    </div>
    <?php }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
  </div>
</div>

<br><br>

 <style>
              /* OWL */
              .owl-item.loading{ min-height:160px; background: url(<?php echo $theme_url; ?>assets/images/loading.svg) no-repeat center; }
              .owl .item img{ display: block; width: 100%; height: auto; }
              .owl-wrapper{ display: block !important; width: 100% !important; height: auto !important; }
              .owl-item{ display: block !important; width: 100% !important; height: auto !important; }
              /* OWL */
            </style>
