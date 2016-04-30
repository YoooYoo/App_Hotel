<div class="container">
  <div class="col-xs-14 col-sm-14 col-md-14 col-lg-14">
    <h3><?php echo trans('0241');?> </h3>
    <?php if(!empty($success)){   ?>
    <div class="alert alert-success">
      <i class="fa fa-check"></i>
      <?php  echo @$success;  ?>
    </div>
    <?php   }else{
      if(!empty($error)){  ?>
    <div class="alert alert-danger">
      <?php  echo @$error;  ?>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-8">
          <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
            <fieldset>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('090');?> </label>
                <div class="col-md-8">
                  <input class="form-control form" type="text" placeholder="<?php echo trans('090');?>" name="fname"  value="<?php echo set_value('fname'); ?>" required >
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('091');?></label>
                <div class="col-md-8">
                  <input class="form-control form" type="text" placeholder="<?php echo trans('091');?>" name="lname" value="<?php echo set_value('lname'); ?>" required >
                </div>
              </div>
              <hr class="soften">
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('094');?> </label>
                <div class="col-md-8">
                  <input class="form-control form" type="email" placeholder="<?php echo trans('094');?>" name="email" value="<?php echo set_value('email'); ?>" required >
                </div>
              </div>
              <hr class="soften">
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0130');?></label>
                <div class="col-md-8">
                  <input class="form-control form" type="text" placeholder="<?php echo trans('092');?>" name="mobile" value="<?php echo set_value('mobile'); ?>" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0105');?></label>
                <div class="col-md-8">
                  <select data-placeholder="Select" name="country" class="form-control form"  required>
                    <option value=""> Select Country </option>
                    <?php foreach($allcountries as $c){
                      ?>
                    <option value="<?php echo $c->iso2;?>"><?php echo $c->short_name;?></option>
                    <?php
                      }

                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0101');?></label>
                <div class="col-md-8">
                  <input class="form-control form" type="text" placeholder="<?php echo trans('0101');?>" name="state" value="<?php echo set_value('state'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0100');?></label>
                <div class="col-md-8">
                  <input class="form-control form" type="text" placeholder="<?php echo trans('0100');?>" name="city" value="<?php echo set_value('city'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('098');?></label>
                <div class="col-md-8">
                  <input class="form-control form" type="text" placeholder="<?php echo trans('098');?>" name="address1" value="<?php echo set_value('address1'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('099');?></label>
                <div class="col-md-8">
                  <input class="form-control form" type="text" placeholder="<?php echo trans('099');?>" name="address2" value="<?php echo set_value('address2'); ?>">
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo trans('0243');?> <?php echo trans('0184');?></label>
                <div class="col-md-8">
                  <select class="form-control form" multiple class="chosen-multi-select" name="permissions[]">
                    <?php  foreach($modules as $mainmod){  ?>
                    <option value="<?php echo $mainmod;?>"><?php echo ucfirst($mainmod);?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </fieldset>
            <div class="form-actions">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="addaccount" value="1" />
                  <input type="hidden" name="type" value="agnet" />
                  <hr class="soften">
                  <button class="btn btn-primary btn-lg" type="submit">
                  <?php echo trans('05');?>
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>