<?php //print_r($allposts); ?>
<div class="container sections-wrapper">
  <div class="row">
    <div class="primary col-md-8 col-sm-12 col-xs-12 go-right">
      <div class="panel panel-default">
        <div class="panel-heading go-text-right">
          <?php  if($ptype == "search"){
            echo trans('0291');
            }elseif($ptype == "category"){
            echo trans('0292')." - ".$categoryname;
            }else{
             echo trans('0285');
            }  ?>
        </div>
        <div class="panel-body">
          <?php if(!empty($allposts['all'])){
            foreach($allposts['all'] as $post):
             $bloglib->set_id($post->post_id);
            $bloglib->post_short_details();
             ?>
          <div class="item row featured">
            <div class="col-md-3 go-right" >
            <div class="owl">
              <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><div class="item"><img class="lazyOwl img-fade" data-src="<?php echo pt_post_thumbnail($post->post_id); ?>"></div></a>
            </div>
            </div>
            <div class="desc col-md-9 col-sm-8 col-xs-12 go-left">
              <div class="form-group title"><a class="pull-left go-right strong" href="<?php echo base_url().'blog/'.$post->post_slug;?>" ><?php echo $bloglib->title;?></a> <span class="go-left pull-right text-warning hidden-md"><small><?php echo $bloglib->date; ?></small></span></div>
              <div class="clearfix"></div>
              <p class="go-text-right"><?php echo character_limiter(strip_tags($bloglib->desc), 240);?></p>
            </div>
            <!--//desc-->
          </div>
          <!--//item-->
          <hr style="margin-top:5px;margin-bottom:5px">
          <?php endforeach; }else{ echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
        </div>
      </div>
      <center>
       <?php echo createPagination($info);?>
      </center>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <!--//row-->
</div>
<!--//masonry-->

 <style>
              /* OWL */
              .owl-item.loading{ min-height:80px; background: url(<?php echo $theme_url; ?>assets/images/loading.svg) no-repeat center; }
              .owl .item img{ display: block; width: 100%; height: auto; }
              .owl-wrapper{ display: block !important; width: 100% !important; height: auto !important; }
              .owl-item{ display: block !important; width: 100% !important; height: auto !important; }
              /* OWL */
            </style>