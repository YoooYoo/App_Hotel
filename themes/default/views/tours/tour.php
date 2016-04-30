  <div class="container">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url();?>"><?php echo trans('01');?></a></li>
      <li><a href="<?php echo base_url();?><?php echo trans('003');?>/"><?php echo trans('003');?></a></li>
      <li><a href="#">City Name</a></li>
      <li><a href="<?php echo base_url();?><?php echo trans('003');?>/<?php echo $hotelslib->slug;?>?lang=<?php echo $lang_set;?>"><?php  echo character_limiter($tourtitle,45);?></a></li>
    </ul>

    <div class="<?php echo div_slider; ?>">
     <?php include 'includes/slider.php';  ?>
    </div>


     <div class="<?php echo div_text; ?>">
      <?php include 'includes/text.php';  ?>
     </div>


  </div>



