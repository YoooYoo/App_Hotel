<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <?php if(@$addpermission){ ?>
   <form class="add_button" action="<?php echo $add_link; ?>" method="post"><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</button></form>
  <?php } ?>
   <div class="panel-body">
     <?php echo $content; ?>
   </div>
 </div>