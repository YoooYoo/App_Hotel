<div class="container sections-wrapper">
  <div class="row">
    <div class="primary col-md-8 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="item row">
            <div class="desc col-md-12 col-sm-8 col-xs-12">
              <div class="form-group title fs24"><a class="pull-left" href="<?php echo base_url().'blog/'.$post->post_slug;?>" ><?php echo $title;?></a> <span class="pull-right fs18 mt5 cs hidden-md"><?php echo $date;?> </span></div>
            </div>
            <!--//desc-->
            <div class="clearfix"></div>
            <hr class="divider" style="margin-bottom: 0px;">
            <div class="panel-body">

            <div class="owl">
             <div class="item"><img class="lazyOwl img-fade" data-src="<?php echo $thumbnail;?>"></div>
            </div>

              <br>
              <?php echo $desc; ?>
            </div>
            <!--//desc-->
          </div>
          <!--//item-->
        </div>
      </div>
      <?php if(!empty($related_posts)){ ?>
      <h3 class="go-right"><?php echo trans('0289');?></h3>
      <div class="clearfix"></div>
      <div class="row">
        <?php
          foreach($related_posts as $post):
           $bloglib->set_id($post->post_id);
           $bloglib->post_short_details(); ?>
        <div class="col-sm-4 col-md-3 col-sm-4 col-xs-12">
          <a href="<?php echo base_url().'blog/'.$post->post_slug;?>" class="thumbnail">
          <img src="<?php echo pt_post_thumbnail($post->post_id); ?>" style="height:100px" class="post-img img-fade" />
          <button style="padding-left:5px" class="btn btn-primary btn-block btn-xs"><?php echo character_limiter(strip_tags($bloglib->title), 20);?></button>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
      <?php  } ?>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <!--//row-->
</div>
<!--//masonry-->

  <style>
              /* OWL */
              .owl-item.loading{ min-height:260px; background: url(<?php echo $theme_url; ?>assets/images/loading.svg) no-repeat center; }
              .owl .item img{ display: block; width: 100%; height: auto; }
              .owl-wrapper{ display: block !important; width: 100% !important; height: auto !important; }
              .owl-item{ display: block !important; width: 100% !important; height: auto !important; }
              /* OWL */
            </style>