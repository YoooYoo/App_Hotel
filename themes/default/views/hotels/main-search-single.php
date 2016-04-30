<?php  if(pt_main_module_available('hotels')){ ?>
<div class="tab-pane fade <?php pt_searchbox('hotels'); ?>" id="HOTELS">
       
    <nav class="navbar navbar-default main-box" style="background-color:#fff; border-bottom: 2px dotted #ccc">
     <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand"><i class="fa fa-search"></i> <?php echo trans('012');?></a>
    </div>
   </div>
  </nav>
 <br>
             <form method="GET" action="<?php echo base_url();?>hotels/search">
             
                 <div class="<?php echo findwhat;?>">
                    <div class="form-group">
                      <?php  echo pt_search_select_box('hotels','home');?>
                    </div>
                  </div>
                  <div class="<?php echo checkin;?>"><p><?php echo trans('07');?></p>
                    <input required type="text" class="input-sm form-control checkinsearch" name="checkin" id="dpd1" placeholder="<?php echo trans('08');?>">
                  </div>
                  <div class="<?php echo checkout;?>"><p><?php echo trans('09');?></p>
                    <input required type="text" class="input-sm form-control" id="dpd2" name="checkout" placeholder="<?php echo trans('08');?>">
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
                  <div class="<?php echo checkchild;?>">
                    <p><?php echo trans('011');?></p>
                    <select name="child" class="form-control">
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <div class="<?php echo mainsearch;?>">
                    <button type="submit" id="searchform" class="btn btn-primary btn-block wow flipInX animated"><i class="fa fa-search"></i> <?php echo trans('012');?></button>
                  </div>
                </form>

         </div>
         <?php } ?>