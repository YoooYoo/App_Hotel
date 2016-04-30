<style>
.line { margin-top: 5px; margin-bottom: 5px; border: 0; border-top: 1px solid #eeeeee; }
#rotatingImg {
display: none;
}
#rotatingDiv {
display: block;
margin: 32px auto;
height:50px;
width:50px;
-webkit-animation: rotation .7s infinite linear;
-moz-animation: rotation .7s infinite linear;
-o-animation: rotation .7s infinite linear;
animation: rotation .7s infinite linear;
border-left:8px solid rgba(0,0,0,.20);
border-right:8px solid rgba(0,0,0,.20);
border-bottom:8px solid rgba(0,0,0,.20);
border-top:8px solid rgba(33,128,192,1);
border-radius:100%;
}
@keyframes rotation {
from {transform: rotate(0deg);}
to {transform: rotate(359deg);}
}
@-webkit-keyframes rotation {
from {-webkit-transform: rotate(0deg);}
to {-webkit-transform: rotate(359deg);}
}
@-moz-keyframes rotation {
from {-moz-transform: rotate(0deg);}
to {-moz-transform: rotate(359deg);}
}
@-o-keyframes rotation {
from {-o-transform: rotate(0deg);}
to {-o-transform: rotate(359deg);}
}
.booking-bg {
padding: 10px 0 5px 0;
width: 100%;
background-image: url('<?php echo $theme_url; ?>assets/images/step-bg.png');
background-color: #222;
text-align: center;
}
.bookingFlow__message {
color: white;
font-size: 18px;
margin-top: 5px;
margin-bottom: 15px;
letter-spacing: 1px;
}
/*Form Wizard*/
.bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
.bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #5087E7; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {   content: ' ';  width: 20px; height: 20px; background: #FFFFFF; border-radius: 50px; position: absolute; top: 5px; left: 5px; }
.bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #5087E7;}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
/*END Form Wizard*/
</style>
<div class="booking-bg" style="margin-top:-25px">
  <p class="bookingFlow__message"><?php echo trans('0128');?></p>
  <div class="container" style="margin-top: -35px;">
    <div class="row bs-wizard" style="border-bottom:0;">
      <div class="col-md-4 bs-wizard-step complete">
        <div class="text-center bs-wizard-stepnum">&nbsp;</div>
        <div class="progress">
          <div class="progress-bar"></div>
        </div>
        <a href="#" class="bs-wizard-dot"></a>
        <div class="bs-wizard-info text-center"><?php echo trans('0238');?></div>
      </div>
      <div class="col-md-4 bs-wizard-step active bdetails">
        <!-- complete -->
        <div class="text-center bs-wizard-stepnum">&nbsp;</div>
        <div class="progress">
          <div class="progress-bar"></div>
        </div>
        <a href="#" class="bs-wizard-dot"></a>
        <div class="bs-wizard-info text-center"><?php echo trans('0239');?></div>
      </div>
      <div class="col-md-4 bs-wizard-step disabled bsuccess">
        <!-- complete -->
        <div class="text-center bs-wizard-stepnum">&nbsp;</div>
        <div class="progress">
          <div class="progress-bar"></div>
        </div>
        <a href="#" class="bs-wizard-dot"></a>
        <div class="bs-wizard-info text-center"><?php echo trans('0240');?></div>
      </div>
    </div>
  </div>
</div>
<div class="container breadcrub">
  <div class="clearfix"></div>
</div>
<div class="container">
  <div class="row">
  <div class="panel-body result"></div></div>
  <div class="row loadinvoice">
    <?php if(!empty($error)){ ?>
    <h1 class="text-center strong"><?php echo trans('0432');?></h1>
    <h3 class="text-center"><?php echo trans('0431');?></h3>
    <br>
    <?php }else{ ?>
    <!-- LEFT CONTENT -->
    <div class="col-md-8">
      <!-- Account Starting -->
      <div class="acc_section">
        <?php if(empty($usersession)){ ?>
        <ul class="nav nav-tabs RTL">
          <li class="active text-center"><a href="#Guest" id="guesttab" data-toggle="tab"><i class="glyphicon glyphicon-user"></i> <?php echo trans('0167');?></a></li>
          <?php if($app_settings[0]->allow_registration == "1"){ ?>
          <li class="text-center" ><a href="#Sign-In" id="signintab" data-toggle="tab"><i class="fa fa-sign-in"></i> <?php echo trans('0168');?></a></li>
          <?php } ?>
        </ul>
        <!-- PHPTRAVELS Booking tabs ending  -->
        <div  class="tab-content">
          <!-- PHPTRAVELS Guest Booking Starting  -->
          <div class="tab-pane fade in active" id="Guest">
            <form id="guestform">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="col-md-6  go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0171');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('0171');?>" name="firstname"  value="">
                    </div>
                  </div>
                  <div class="col-md-6  go-left">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0172');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('0172');?>" name="lastname"  value="">
                    </div>
                  </div>
                  <div class="col-md-6 go-right">
                    <div class="form-group ">
                      <label  class="required  go-right"><?php echo trans('094');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="">
                    </div>
                  </div>
                  <div class="col-md-6 go-left">
                    <div class="form-group">
                      <label  class="required go-right"><?php echo trans('0175');?> <?php echo trans('094');?></label>
                      <input class="form-control form" type="email" placeholder="<?php echo trans('0175');?> <?php echo trans('094');?>" name="confirmemail"  value="">
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-6 go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0173');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('0414');?>" name="phone"  value="">
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12  go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0178');?></label>
                      <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- PHPTRAVELS Guest Booking Ending  -->
          <!-- PHPTRAVELS Sign in Starting  -->
          <div class="tab-pane fade" id="Sign-In">
            <form action="" method="POST" id="loginform">
              <div class="panel panel-default">
                <div class="modal-body">
                  <div class="col-md-6 go-right">
                    <div class="form-group ">
                      <label  class="required  go-right"><?php echo trans('094');?></label>
                      <input class="form-control form" type="text" placeholder="Email" name="username" id="username"  value="">
                    </div>
                  </div>
                  <div class="col-md-6 go-left">
                    <div class="form-group">
                      <label  class="required go-right"><?php echo trans('095');?></label>
                      <input class="form-control form" type="password" placeholder="<?php echo trans('095');?>" name="password" id="password"  value="">
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0178');?></label>
                      <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </form>
          </div>
          <!-- PHPTRAVELS Sign in Ending  -->
        </div>
        <?php }else{ ?>
       <!-- PHPTRAVELS LoggeIn Booking Starting  -->
          <div class="" id="loggeduserdiv">
            <form id="loggedform">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="col-md-6  go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0171');?></label>
                      <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_first_name?>" disabled="disabled" style="background-color: #DEDEDE !important"/>
                    </div>
                  </div>
                  <div class="col-md-6  go-left">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0172');?></label>
                      <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_last_name?>" disabled="disabled" style="background-color: #DEDEDE !important">
                    </div>
                  </div>
                  <div class="col-md-6 go-right">
                    <div class="form-group ">
                      <label  class="required  go-right"><?php echo trans('094');?></label>
                      <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->accounts_email?>" disabled="disabled" style="background-color: #DEDEDE !important">
                    </div>
                  </div>
                 <div class="clearfix"></div>
                 <div class="col-md-12  go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0178');?></label>
                      <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                    </div>
                 </div>
                </div>
              </div>
            </form>
          </div>
          <!-- PHPTRAVELS LoggedIn User Booking Ending  -->
        <?php } ?>
        <div class="row">
          <div class="col-md-12">
<?php if(!empty($hotel->policy)){ ?>
<a href="#" class="text-danger" data-toggle="modal" data-target="#terms">
  <?php echo trans('0416');?>
</a>
<?php } ?>


<!-- Modal -->
<div class="modal fade" id="terms" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo trans('0148');?></h4>
      </div>
      <div class="modal-body">
       <?php echo $hotel->policy;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
          </div>
         <br><br>
          <div class="col-md-6">

          <?php if(!empty($hotel->extras)){  ?>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">
          <?php echo trans('0430');?>
          </button>
          <?php } ?>

          </div>
          <div class="col-md-6"><div class="form-group">
          <span id="waiting"></span>
            <button type="submit" class="btn btn-success btn-lg btn-block completebook" name="<?php if(empty($usersession)){ echo "guest";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');"><?php echo trans('0306');?></button>
          </div></div>
        </div>
        <br>
        
        <!-- Account Ending -->
        <!--Extras Starting-->
        <form id="bookingdetails" action="" onsubmit="return false">
          <?php if(!empty($hotel->extras)){  ?>

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><?php echo trans('0156');?></h4>
                </div>
                <div class="panel-body">
                  <?php foreach($hotel->extras as $extra){ ?>
                  <div class="featured">
                    <div class="featured">
                      <div class="col-md-2 row go-right">
                        <img class="img-responsive img-fade" src="<?php echo $extra->thumbnail;?>" alt="">
                      </div>
                      <div class="col-md-8 go-right RTL">
                        <p class="h3 strong go-text-right"><span class="go-right"><?php echo $extra->extraTitle;?> &nbsp; </span> <small class="weak go-text-left"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo $extra->extraPrice;?></small></p>
                        <div class="clearfix"></div>
                      </div>
                      <div class="col-md-2 row go-left">
                        <span class="pull-right strong" style="color:#36C;font-size:16px;margin-top:15px">
                          <div class="checkbox go-right">
                            <label class="go-right"><input class="pull-left go-right" type="checkbox" name="extras[]" value="<?php echo $extra->id;?>" onclick="updateBookingData('<?php echo $hotel->extraChkUrl;?>')">&nbsp; <span class="go-left"> <?php echo trans('0399');?> &nbsp; </span></label>
                          </div>
                        </span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                  <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:7px 0px 7px 0px !important">
                  <?php } ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success go-right" data-dismiss="modal"><?php echo trans('0233');?></button>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <!-- Extras Ending -->
          <script type="text/javascript">
          $(function(){
          $('.popz').popover({ trigger: "hover" });
          });
          </script>
          <br><br><br>
        </div>
        <!-- Complete This booking button only starting -->
        <div class="panel panel-default btn_section" style="display:none;">
          <div class="panel-body">
            <center>
            
          </div>
        </div>
        <!-- End Complete This booking button only -->
        <!-- Booking Final Starting -->
        <div class="panel panel-default final_section" style="display:none;">
          <div class="panel-body">
            <div class="step-pane" id="step4">
              <div id="rotatingDiv" class="show"></div>
              <h2 class="text-center"><?php echo trans('0179');?></h2>
              <p class="text-center"><?php echo trans('0180');?></p>
            </div>
          </div>
        </div>
        <!-- Booking Final Ending -->
      </div>
      <!-- END OF LEFT CONTENT -->
      <!-- Right CONTENT -->
      <div class="col-md-4">
        <div class="panel well-sm">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <img class="img-responsive" src="<?php echo $hotel->thumbnail;?>"></div>
          </div>
          <h5 class="strong go-text-right" style="margin-bottom: 1px;"> <?php echo $hotel->title;?></h5>
          <p class="go-text-right" style="margin-top: 1px;margin-bottom: 1px;"> <small><i class="fa fa-map-marker go-right"></i> <?php echo $hotel->location;?> &nbsp;</small></p><div class="clearfix"></div>
          <p class="go-right" style="margin-top: 1px;margin-bottom: 1px;"> <?php echo $hotel->stars;?> </p><div class="clearfix"></div>
          <div class="line"></div>
          <span class="pull-left go-right"> <strong><?php echo trans('07');?></strong> : <?php echo $hotel->checkin;?> &nbsp;&nbsp;&nbsp;<strong><?php echo trans('09');?> </strong> : <?php echo $hotel->checkout;?></span>
          <div class="clearfix"></div>
          <div class="line"></div>
          <span class="pull-left  go-right strong RTL"><?php echo trans('060');?> : <small><?php echo $room->stay;?></small></span>
          <div class="clearfix"></div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <!---Room details-->
            <p class="strong RTL"><span class=" go-right"><?php echo trans('0246');?> : &nbsp; </span> <small class="weak"><?php echo $room->title;?></small><span class="strong pull-right go-left"> <?php echo $room->roomscount;?> </span> </p>
            <div class="clearfix"></div>
            <div class="line"></div>
            <span class="pull-left go-right"><?php echo trans('0412');?></span>
            <span class="pull-right strong go-left"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo $room->perNight;?></span>
            <div class="clearfix"></div>
            <div class="line"></div>
            <!---End Room details-->
            <!--Extra bed charges-->
            <?php if($room->extraBedsCount > 0){ ?>
            <span class="pull-left go-right"><small><?php echo trans('0429');?> </small></span> <small>  <span class="pull-right go-left"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo $room->extraBedCharges; ?></span></small>
            <div class="clearfix"></div>
            <div class="line"></div>
            <?php } ?>
            <!--extra bed charges end -->
            <!--extras details-->
            <div class="extraspanel">
            </div>
            <!--end extras details-->
            <span class="pull-left go-right"><small><?php echo trans('0153');?> </small></span> <small>  <span class="pull-right go-left"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaytax"><?php echo $hotel->taxAmount;?></span></span></small>
            <div class="clearfix"></div>
            <div class="line"></div>
            
            <div class="clearfix"></div>
            <h4><span class="pull-left strong go-right"> <?php echo trans('0124');?></span>  <span class="pull-right go-left"><strong><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaytotal"><?php echo $room->price;?></span></strong></span></h4>
            <div class="clearfix"></div>
            <div class="booking-deposit">
              <div><span class="pull-left booking-deposit-font go-right"><?php echo trans('0126');?></span>   <span class="pull-right booking-deposit-font go-left"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaydeposit"><?php echo $hotel->depositAmount?></span></span></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <p class="text-success  go-text-right"><?php echo trans('0413');?></p>
      </div>
      <?php } ?>
      <input type="hidden" name="itemid" value="<?php echo $hotel->id;?>" />
      <input type="hidden" name="subitemid" value="<?php echo $room->id;?>" />
      <input type="hidden" name="roomscount" value="<?php echo $room->roomscount;?>" />
      <input type="hidden" name="bedscount" value="<?php echo $room->extraBedsCount;?>" />
      <input type="hidden" name="checkout" value="<?php echo $hotel->checkout;?>" />
      <input type="hidden" name="checkin" value="<?php echo $hotel->checkin;?>" />
      <input type="hidden" name="adults" value="<?php echo $hotel->adults;?>" />
      <input type="hidden" name="children" value="<?php echo $hotel->children;?>" />
      <input type="hidden" name="btype" value="hotels" />
    </form>
  </div>
  <!-- END OF RIGHT CONTENT -->
</div>
<script src="<?php echo base_url(); ?>assets/js/booking.js"></script>