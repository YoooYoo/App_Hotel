<?php require $themeurl . 'views/home/slider.php';?>
<section style="background-color:#fafafa">
  <div class="container">
    <div class="row modal-body">
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 go-right">
      <div class="lazy owl">
     <div class="item"><img style="max-height:200px;max-width:200px" class="center-block lazyOwl img-fade" data-src="<?php echo $theme_url; ?>assets/images/search.png"></div>
       </div>
        <div class="info">
          <h3 class="text-center strong"><?php echo trans('0379');?></h3>
          <p class="text-center"><?php echo trans('0380');?></p>
        </div>
      </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 go-right">
      <div class="lazy owl">
     <div class="item"><img style="max-height:200px;max-width:200px" class="center-block lazyOwl img-fade" data-src="<?php echo $theme_url; ?>assets/images/compare.png"></div>
       </div>
        <div class="info">
          <h3 class="text-center strong"><?php echo trans('0381');?></h3>
          <p class="text-center"><?php echo trans('0382');?></p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 go-right">
      <div class="lazy owl">
     <div class="item"><img style="max-height:200px;max-width:200px" class="center-block lazyOwl img-fade" data-src="<?php echo $theme_url; ?>assets/images/book.png"></div>
       </div>
        <div class="info">
          <h3 class="text-center strong"><?php echo trans('0388');?></h3>
          <p class="text-center"><?php echo trans('0397');?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<section style="background-color:#fff" class="hidden-sm hidden-xs">
  <div class="container" >
    <ul class="nav nav-tabs" role="tablist">
      <?php  if(pt_main_module_available('hotels')){ ?><li role="presentation" class="active text-center"> <a href="<?php echo site_url('hotels') ?>" data-toggle="" aria-controls="" aria-expanded=""><i class="fa-lg mdi-maps-local-hotel"></i> <?php echo trans('Hotels');?></a></li><?php } ?>
      <?php // if(pt_main_module_available('tours')){ ?><!--<li role="presentation" class="text-center"> <a href="#TOURZ" data-toggle="tab" aria-controls="tab" aria-expanded="true"><i class="fa-lg mdi-action-assignment-ind"></i> --><?php //echo trans('Tours');?><!--</a></li>--><?php //} ?>
      <?php // if(pt_main_module_available('cars')){ ?><!-- <li role="presentation" class="text-center"> <a href="#CARZ" data-toggle="tab" aria-controls="tab" aria-expanded="true"><i class="fa-lg mdi-maps-directions-car"></i> --><?php //echo trans('Cars');?><!--</a></li>--><?php //} ?>
    </ul>
    <div class="tab-content">
    <?php include $themeurl.'views/hotels/homepage.php'; ?>

    </div>
  </div>
</section>
<?php include $themeurl.'views/offers/homepage.php'; ?>