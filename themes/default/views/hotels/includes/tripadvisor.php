<?php if (!empty ($tripadvisorinfo->rating)) {?>
<a href="<?php echo $tripadvisorinfo->web_url;?>" target="_blank"><img class="img-responsive" style="height:30px" src="<?php echo PT_GLOBAL_IMAGES_FOLDER . 'tripadvisor.png';?>" alt="" /></a>
<p><?php echo trans('0303');?> <?php echo $tripadvisorinfo->ranking_data->ranking_string;?></p>
<h4><strong><?php echo trans('0230');?></strong> <?php echo $tripadvisorinfo->rating;?>/<strong>5</strong></h4>
<h4><img src="<?php echo $tripadvisorinfo->rating_image_url;?>" alt="" /></h4>
<a href="<?php echo $tripadvisorinfo->web_url;?>" target="_blank"> <?php echo $tripadvisorinfo->num_reviews;?> <?php echo trans('042');?></a>
|
<a href="<?php echo $tripadvisorinfo->write_review;?>" target="_blank"><?php echo trans('0337');?></a>
|
<a href="//tripadvisor.com/pages/terms.html" target="_blank"> &copy TripAdvisor 2014</a>
<?php }?>