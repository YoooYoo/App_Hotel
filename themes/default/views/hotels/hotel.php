<!-- container starts -->
<div class="container">
  <div class="row">
    <!-- slider starts -->
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 go-right pull-left">
      <?php include 'includes/slider.php';  ?>
    </div>
    <!-- slider ends  -->
    <!-- text starts  -->
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 go-left panel pull-right">
      <div class="panel-body">
        <?php include 'includes/text.php';  ?>
      </div>
 
      <div class="panel-body">
        <?php  include 'includes/tripadvisor.php';  ?>
      </div>
    </div>
    <!-- text ends -->
  </div>
  <!-- reviews modal starts -->
  <div class="modal fade" id="read-reviews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?php include 'includes/reviews.php';?>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234');?></button>
        </div>
      </div>
    </div>
  </div>
  <!-- reviews modal ends -->


  <div class="clearfix"></div>
  <?php include 'includes/rooms.php';?>
  <?php include 'includes/overview.php';?>
  <div class="clearfix"></div>
</div>
<?php include 'includes/related.php';?>
<!-- container ends -->