

        <h4 class="go-text-right"> <strong><i class="mdi-social-domain text-warning go-right"></i> <?php echo $hotel->title; ?> <?php echo trans('046');?> &nbsp; </strong></h4>
        <div class="panel panel-primary">
        <div class="panel-body go-text-right">
        <?php echo $hotel->desc; ?>
        </div>
        </div>

        <h4 class="go-text-right"> <strong><i class="mdi-social-mood text-warning go-right"></i> <?php echo trans('048');?> &nbsp; </strong></h4>
        <div class="panel panel-primary">
        <div class="panel-body go-text-right">
        <?php foreach($hotel->amenities as $amt){ if(!empty($amt['name'])){ ?>
        <span style="margin:10px;"><img style="margin-top:-0px;" src="<?php echo $amt['icon'];?>" alt=""><span class="text-left go-text-right"> <?php echo $amt['name']; ?></span></span>
        <?php } } ?>

        </div>
        </div>

        <h4 class="go-text-right"> <strong><i class="mdi-action-report-problem text-warning go-right"></i> <?php echo trans('0148');?> &nbsp; </strong></h4>
        <div class="panel panel-primary">
        <div class="panel-body">


          <p class="go-text-right"><i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('07');?> </strong> :   <?php echo $hotel->defcheckin;?> - <i class="fa fa-clock-o text-warning"></i>   <strong> <?php echo trans('09');?> </strong> :  <?php echo $hotel->defcheckout;?> </p>

        <hr>

        <div class="RTL"><strong> <?php echo trans('0265');?> </strong> : <?php foreach($hotel->paymentOptions as $pay){ if(!empty($pay['name'])){ echo $pay['name'];?>  <b>-</b> <?php } } ?>

        <hr>
        <div class="RTL"> <?php echo $hotel->policy; ?> </div>
        </div>
        </div>
        </div>