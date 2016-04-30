 <?php  if(pt_main_module_available('ean')){ ?>
           <div class="tab-pane fade <?php pt_searchbox('expedia'); ?>" id="EXPEDIA">


                <form action="<?php echo base_url();?>ean/search" method="GET">
                  <div class="<?php echo findwhat;?>">
                    <div class="form-group">
                       <h3><?php echo trans('06');?></h3>
                      <input name="city" type="text" class="form-control Places" id="" placeholder="<?php echo trans('026');?>" required />
                    </div>
                  </div>
                  <div class="<?php echo checkin;?>"><p><?php echo trans('07');?></p>
                    <input type="text" class="input-sm form-control checkinsearch" name="checkIn" id="eandpd" placeholder="<?php echo trans('08');?>" required />
                  </div>
                  <div class="<?php echo checkout;?>"><p><?php echo trans('09');?></p>
                    <input type="text" class="input-sm form-control" id="eandpd2" name="checkOut" placeholder="<?php echo trans('08');?>" required />
                  </div>
                  <div class="<?php echo checkadults;?>">
                    <p><?php echo trans('010');?></p>
                    <select name="adults" class="form-control">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                  </div>

                  <div class="<?php echo mainsearch;?>">

                  <input type="hidden" name="search" value="search" >

                  <button style="top:15px;" type="submit" class="btn btn-primary btn-block wow flipInX animated"><i class="fa fa-search"></i> <?php echo trans('012');?></button>
                  </div>
                </form>

    
         </div>
         <?php } ?>