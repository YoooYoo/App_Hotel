<!--<section style="background:#fff;">
  <div class="container">
<div class="hotel_destinations" style="margin: 15px 0px -25px 1px;">
          <div class="containter">
          <div class="col-md-12 offset-0">
          <h3 class="mtb0"><strong><?php echo trans('013');?> <?php echo trans('003');?></strong></h3>
          <hr class="mtb0"><br>
          <div class="clearfix"></div>

          <div class="col-md-8 bw">
        <?php if(!empty($featured_tours)){ foreach($featured_tours as $ft){ $tourslib->set_id($ft->tour_id, $app_settings[0]->currency_sign, $app_settings[0]->currency_code); $tourslib->tour_short_details();  ?>
<a href="<?php echo base_url();?>tours/<?php echo $tourslib->slug;?>">
  <div class="col-md-12 well well-sm">
    <div class="col-md-3 offset-0">
      <img src="<?php echo $tourslib->thumbnail;?>" class="img-responsive fade-img" alt="" />
    </div>
    <div class="col-md-9">
      <div class="body-panel">
        <h3 class="mtb0"><?php echo $tourslib->title; ?> <span class="pull-right"><?php pt_create_stars($tourslib->stars);?></span></h3>
        <h4 ><small><?php echo $tourslib->currencycode;?></small><span class="text-success"> <?php echo $tourslib->currencysign.$tourslib->basicprice;?></span></h4>
        <p><?php echo character_limiter(strip_tags($tourslib->desc),210);?></p>
      </div>
    </div>
    <div class="clearfix"></div>

  </div>
</a>
     <?php } } ?>

          </div>
          <div class="col-md-4">
          <?php echo run_widget(81); ?>

          <div class="list-group">
              <div class="panel panel-default">
              <div class="panel-heading">Blog News</div>
               <?php if(!empty($posts)){ ?>
                         <?php foreach($posts as $post){ $bloglib->set_id($post->post_id); $bloglib->post_short_details(); ?>
                            <a href="<?php echo base_url()."blog/".$bloglib->slug;?>" class="list-group-item"><?php echo character_limiter($bloglib->title,35);?></a>
                            <?php } ?>
                            <?php } ?>
                             </div></div>
          <hr>

         <div class="clearfix"></div>
          <div style="line3"></div>
           <div class="well well-sm">
          <h5 class="fcd"><span class="text-success strong"><i class="fa fa-check"></i></span> <?php echo trans('0383');?></h5>
          <h5 class="fcd"><span class="text-success strong"><i class="fa fa-check"></i></span> <?php echo trans('0384');?></h5>
          <h5 class="fcd"><span class="text-success strong"><i class="fa fa-check"></i></span> <?php echo trans('0385');?></h5>
          <h5 class="fcd"><span class="text-success strong"><i class="fa fa-check"></i></span> <?php echo trans('0386');?></h5>
          <h5 class="fcd"><span class="text-success strong"><i class="fa fa-check"></i></span> <?php echo trans('0387');?></h5>
           </div>
           </div>
          </div>

    </div>
    </div>
    </div>

  </section>

-->

