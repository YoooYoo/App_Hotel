<?php  if(pt_main_module_available('cars')){ ?>



                <form method="GET" action="<?php echo base_url();?>cars/search">
                  <div class="form-group  col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:0px">
                   <div class="form-group">
                      <p style="margin-top:0px"><?php echo trans('032');?></p>
                        <input required name="searching" type="text" id="CarsPlaces" class="form-control empty" placeholder="&#xf041 <?php echo trans('0209');?>">
                    </div>
                  </div>

                  <div class="form-group  col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:0px">
                   <div class="form-group">
                                      <?php $ctypes = pt_get_csettings_data("ctypes"); if(!empty($ctypes)){ ?>

                                      <p><?php echo trans('0231');?></p>
                                      <select class="chosen-select" name="ctype" >
                                      <option value=""> <?php echo trans('0158');?></option>
                                      <?php
                                       foreach($ctypes as $ctype){
                                      ?>
                                      <option value="<?php echo $ctype->sett_id;?>" ><?php echo $ctype->sett_name;?></option>
                                      <?php } ?>
                                      </select>

                                      <?php } ?>
                                      </div>
                  </div>

                  <div class="form-group">
                  <div class="col-md-6"><p><?php echo trans('0210');?></p>
                    <input type="text" class="input-sm form-control checkinsearch empty" name="checkin" id="dpd3" placeholder="&#xf073; <?php echo trans('0210');?>">
                  </div>
                  <div class="col-md-6"><p><?php echo trans('0211');?></p>
                    <input type="text" class="input-sm form-control empty" id="dpd4" name="checkout" placeholder="&#xf073; <?php echo trans('0211');?>">
                  </div>
                  </div>

                  <div class="<?php echo mainsearch;?>">

                    <button style="margin-top:15px;" type="submit" id="searchform" class="<?php echo main_search_btn; ?>"><i class="fa fa-search"></i> <?php echo trans('012');?></button>
                  </div>
                </form>


      <?php } ?>