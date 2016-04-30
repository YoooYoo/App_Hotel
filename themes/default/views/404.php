
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1><img src="<?php echo $theme_url; ?>assets/images/warning.png" alt="404" class="img-responsive center-block" /></h1>
                <h3><strong><?php echo trans('0267');?></strong> </h3>
                <div class="error-details">
                   <?php echo trans('0268');?>
                </div>
                <div class="error-actions">
                <div class="center-block">
                    <form action="<?php echo base_url(); ?>" method="post"><button type="submit" class="btn btn-primary"><?php echo trans('01');?></button></form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
.error-template {padding: 10px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-bottom:10px; }
</style>