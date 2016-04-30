<script type="text/javascript">
  $(function(){

  $('.comments').popover({ trigger: "hover" });
  // Update Profile
  $('.updateprofile').click(function(){
  $('html, body').animate({
  scrollTop: $(".toppage").offset().top
  },'slow');
  $.post("<?php echo base_url();?>account/update_profile", $("#profilefrm").serialize(), function(msg){

  $(".accountresult").html(msg).fadeIn("slow");
  slidediv();
  });
  });

  //newsletter subscription
  $(".newsletter").click(function(){
  var email = $(this).val();
  var action = '';
  var msg = '';
  if($(this).prop( "checked" )){
  action = 'add';
  msg = 'Subscribed Successfully';
  }else{
  action = 'remove';
  msg = 'Unsubscribed Successfully';
  }
  $.post("<?php echo base_url();?>account/newsletter_action", { email: email, action: action }, function(resp){
  $(".accountresult").html('<div class="alert alert-success">'+msg+'</div>').fadeIn("slow");
  slidediv();
  });
  });
  // Remove wish
  $(".removewish").on('click',function(){
  var id = $(this).prop('id');
var confirm1 = confirm("<?php echo trans('0436');?>");
  if(confirm1){
     $("#wish"+id).fadeOut("slow");
  $.post("<?php echo base_url();?>account/wishlist/single", { id: id }, function(theResponse){
  });
  }


  });

  // Request Cancellation
  $(".cancelreq").on('click',function(){
  var id = $(this).prop('id');
  $.alert.open('confirm', 'Are you sure you want to Cancel this booking', function(answer) {
  if (answer == 'yes'){
  $.post("<?php echo base_url();?>account/cancelbooking", { id: id }, function(theResponse){
  location.reload();
  });
  }
  })
  });

  // Request EAN Cancellation
  $(".ecancel").on('click',function(){
  var id = $(this).prop('id');
  $.alert.open('confirm', 'Are you sure you want to Cancel this booking', function(answer) {
  if (answer == 'yes'){
  $.post("<?php echo base_url();?>ean/cancel", { id: id }, function(theResponse){
    if(theResponse != "0"){
      alert(theResponse);
    }
  //console.log(theResponse);
  location.reload();
  });
  }
  })
  });

  $('.reviewscore').change(function(){
  var sum = 0;
  var avg = 0;
  var id = $(this).attr("id");
  $('.reviewscore_'+id+' :selected').each(function() {
  sum += Number($(this).val());
  });
  avg = sum/5;
  $("#avgall_"+id).html(avg);
  $("#overall_"+id).val(avg);
  });


  //submit review
  $(".addreview").on("click",function(){
  var id = $(this).prop("id");
  $.post("<?php echo base_url();?>account/addreview", $("#reviews-form-"+id).serialize(), function(resp){
  if($.trim(resp) == "done"){
  $("#review_result"+id).html("<div id='rotatingDiv'></div>").fadeIn("slow");
  location.reload();
  }else{
  $("#review_result"+id).html(resp).fadeIn("slow");
  }

  });

  setTimeout(function(){

  $("#review_result"+id).fadeOut("slow");

  }, 3000);

  });

  })

  function slidediv(){

  setTimeout(function(){

  $(".accountresult").fadeOut("slow");

  }, 4000);

  }


</script>
<style>
  .login_box{
  background: -webkit-gradient(linear, center top, center bottom, from(rgba(255,255,255,1)), to(rgba(238, 240, 242, 1)));
  background: -webkit-linear-gradient(rgba(255,255,255,1), rgba(238, 240, 242, 1));
  }
  .login_control{
  background-color:#FFF;
  padding:10px;
  }
  .control {
  color:#000;
  margin:10px;
  }
  .line{
  border-bottom : 2px solid #F32D27;
  }
</style>
<div class="container">
  <div class="col-md-3 go-right">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><?php echo trans('02');?></div>
      <div class="login_box">
        <div class="" align="center">
          <h3>
            <script> function startTime() { var today=new Date(); var h=today.getHours(); var m=today.getMinutes(); var s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('txt').innerHTML=h+":"+m+":"+s; t=setTimeout(function(){startTime()},500); } function checkTime(i) { if (i<10) { i="0" + i; } return i; } </script>
            <strong>
              <body onload="startTime()">
                <div id="txt"></div>
              </body>
            </strong>
            <span class="h4">
              <script> var tD = new Date(); var datestr =  tD.getDate(); document.write(""+datestr+""); </script> <script type="text/javascript"> var d=new Date(); var weekday=new Array("","","","","","", ""); var monthname=new Array("January","February","March","April","May","June","July","August","September","Octobar","November","December"); document.write(monthname[d.getMonth()] + " "); </script>
              <script> var tD = new Date(); var datestr = tD.getFullYear(); document.write(""+datestr+""); </script>
            </span>
          </h3>
          <hr>
          <img style="height:150px" src="<?php echo PT_DEFAULT_IMAGE."user.png";?>" class="img-responsive img-thumbnail">
          <h3 class="RTL"><?php echo trans('0307');?> <?php echo $profile[0]->ai_first_name; ?> </h3>
          <br>
        </div>
        <div class="login_control">
          <div class="list-group">
            <a href="#MyBookings" data-toggle="tab" class="list-group-item go-text-right"><i class="fa fa-tags text-success go-right"></i> <?php echo trans('072');?> &nbsp; </a>
            <a href="#MyProfile" data-toggle="tab" class="list-group-item go-text-right"><i class="glyphicon glyphicon-user text-primary go-right"></i> <?php echo trans('073');?> &nbsp; </a>
            <a href="#WishList" data-toggle="tab" class="list-group-item go-text-right"><i class="fa fa-star text-warning go-right"></i> <?php echo trans('074');?> &nbsp; </a>
            <a href="#NewsLetter" data-toggle="tab" class="list-group-item go-text-right"><i class="fa fa-envelope go-right"></i> <?php echo trans('023');?> &nbsp; </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-9">
      <div id="" class="tab-content">
        <div class="tab-pane fade in active" id="MyBookings">
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo trans('075');?></div>
            <div class="panel-body">
           <?php if(!empty($bookings)){ foreach($bookings as $b){ ?>
              <div class="featured">
                  <div class="col-md-2 row go-right">
                    <img class="img-responsive img-fade well-sm" src="<?php echo $b->thumbnail;?>" alt="">
                  </div>
                  <div class="col-md-4 go-right well-sm">
                    <p class="title strong go-text-right"><?php echo $b->title;?></p>
                    <p class="subtitle go-right"><i class="fa fa-map-marker"></i> <?php echo $b->location;?></p>
                    <div class="clearfix"></div>
                    <span class="go-right"><?php echo $b->stars;?></span>
                  </div>
                  <div class="col-md-3  well-sm">
                      <?php echo trans('08');?> : <?php echo $b->date;?><br>
                      <?php echo trans('079');?> : <?php echo $b->expiry;?><br>
                      <?php echo trans('080');?> :
                      <?php if($b->status == "paid"){ ?> 
                      <span class="label label-success"> <?php echo trans('081');?></span><?php }else{ ?>
                      <span class="label label-warning"> <?php echo trans('082');?></span><?php } ?>


                  </div>
                  <div class="col-md-2 row go-right">
             <a href="<?php echo base_url();?>invoice?id=<?php echo $b->id;?>&sessid=<?php echo $b->code;?>" class="btn btn-xs btn-block btn-primary"> <?php echo trans('0348');?></a>


             <!--  <span class="btn btn-warning btn-block btn-xs cancelreq"><?php echo trans('0346');?></span> -->
              <span data-toggle="modal" href="#AddReview<?php echo $b->id;?>" class="btn btn-xs btn-block btn-success"><?php echo trans('083');?></span>

              <span type="button" class="comments" title="<?php echo pt_show_date_php($b->review_date);?>" data-container="body" data-toggle="popover" data-placement="left" data-content="<?php echo $b->review_comment;?>"></span>

              </div>
              <div class="col-md-2 row go-left">
              <span class="pull-right strong" style="color:#36C;font-size:16px;margin-top:15px">
              <small class="color-gray weak go-right"><?php echo trans('078');?></small>
              <div class="clearfix"></div>
              <?php echo $b->currCode;?> <?php echo $b->currSymbol;?><?php echo $b->checkoutTotal;?></span>
              </div>
              <div class="clearfix"></div>
              </div>

              <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:7px 0px 7px 0px !important">
            
<!--Comments modal -->
              <div class="modal fade" id="AddReview<?php echo $b->id;?>" tabindex="" role="dialog" aria-labelledby="AddReview" aria-hidden="true">
              <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-smile-o"></i> <?php echo trans('084');?> <?php echo $b->title;?> </h4>
              </div>
              <div class="modal-body">
              <?php if($b->reviewsData['reviewGiven'] == "yes"){ ?>
              Date: <?php echo $b->reviewsData['reviewDate']; ?><br>
              Overall: <?php echo $b->reviewsData['overall']; ?><br>
              Comment: <?php echo $b->reviewsData['reviewComment']; ?><br>
              <?php }else{ ?>
              <form class="form-horizontal" method="POST" id="reviews-form-<?php echo $b->id;?>" action="" onsubmit="return false;">
              <div class="">
              <div id="review_result<?php echo $b->id?>" >
              </div>
              <div class="">
              <div class="panel-body">
              <div class="spacer20px">
              <div class="col-lg-4">
              <div class="panel panel-body">
              <div class="form-group">
              <label class="col-md-5 control-label">Overall</label>
              <div class="col-md-5">
              <label class="col-md-4 control-label"> <span class="badge badge-warning"><span id="avgall_<?php echo $b->id;?>">1</span> / 10 </span> </label>
              <input type="hidden" name="overall" id="overall_<?php echo $b->id;?>" value="1" />
              <input type="hidden" name="bookingid" value="<?php echo $b->id;?>" />
              <input type="hidden" name="userid" value="<?php echo $profile[0]->accounts_id;?>" />
              <input type="hidden" name="fullname" value="<?php echo $profile[0]->ai_first_name.' '.$profile[0]->ai_last_name;?>" />
              <input type="hidden" name="reviewmodule" value="<?php echo $b->booking_type;?>" />
              <input type="hidden" name="reviewfor" value="<?php echo $b->booking_item;?>" />
              </div>
              </div>
              <hr>
              <div class="form-group">
              <label class="col-md-5 control-label"><?php echo trans('030');?></label>
              <div class="col-md-5">
              <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_clean">
              <option value="1"> 1 </option>
              <option value="2"> 2 </option>
              <option value="3"> 3 </option>
              <option value="4"> 4 </option>
              <option value="5"> 5 </option>
              <option value="6"> 6 </option>
              <option value="7"> 7 </option>
              <option value="8"> 8 </option>
              <option value="9"> 9 </option>
              <option value="10"> 10 </option>
              </select>
              </div>
              </div>
              <div class="form-group">
              <label class="col-md-5 control-label"><?php echo trans('031');?></label>
              <div class="col-md-5">
              <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_comfort">
              <option value="1"> 1 </option>
              <option value="2"> 2 </option>
              <option value="3"> 3 </option>
              <option value="4"> 4 </option>
              <option value="5"> 5 </option>
              <option value="6"> 6 </option>
              <option value="7"> 7 </option>
              <option value="8"> 8 </option>
              <option value="9"> 9 </option>
              <option value="10"> 10 </option>
              </select>
              </div>
              </div>
              <div class="form-group">
              <label class="col-md-5 control-label"><?php echo trans('032');?></label>
              <div class="col-md-5">
              <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_location">
              <option value="1"> 1 </option>
              <option value="2"> 2 </option>
              <option value="3"> 3 </option>
              <option value="4"> 4 </option>
              <option value="5"> 5 </option>
              <option value="6"> 6 </option>
              <option value="7"> 7 </option>
              <option value="8"> 8 </option>
              <option value="9"> 9 </option>
              <option value="10"> 10 </option>
              </select>
              </div>
              </div>
              <div class="form-group">
              <label class="col-md-5 control-label"><?php echo trans('033');?></label>
              <div class="col-md-5">
              <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_facilities">
              <option value="1"> 1 </option>
              <option value="2"> 2 </option>
              <option value="3"> 3 </option>
              <option value="4"> 4 </option>
              <option value="5"> 5 </option>
              <option value="6"> 6 </option>
              <option value="7"> 7 </option>
              <option value="8"> 8 </option>
              <option value="9"> 9 </option>
              <option value="10"> 10 </option>
              </select>
              </div>
              </div>
              <div class="form-group">
              <label class="col-md-5 control-label"><?php echo trans('034');?></label>
              <div class="col-md-5">
              <select class="form-control reviewscore reviewscore_<?php echo $b->id;?>" id="<?php echo $b->id;?>" name="reviews_staff">
              <option value="1"> 1 </option>
              <option value="2"> 2 </option>
              <option value="3"> 3 </option>
              <option value="4"> 4 </option>
              <option value="5"> 5 </option>
              <option value="6"> 6 </option>
              <option value="7"> 7 </option>
              <option value="8"> 8 </option>
              <option value="9"> 9 </option>
              <option value="10"> 10 </option>
              </select>
              </div>
              </div>
              </div>
              </div>
              <div class="col-lg-8">
              <div class="col-lg-12 panel panel-body">
              <label class="control-label"> <?php echo trans('042');?> </label>
              <textarea class="form-control" placeholder="Add review here..." rows="12" name="reviews_comments"></textarea>
              </div>
              <p class="text text-danger"><?php echo trans('Note');?>  <?php echo trans('085');?>.</p>
              </div>
              </div>
              </div>
              </div>
              <input type="hidden" name="addreview" value="1" />
              </div>
              </form>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-primary addreview" id="<?php echo $b->id;?>" ><i class="fa fa-save"></i> <?php echo trans('086');?></button>
              </div>
              <?php } ?>
              </div>
              </div>
              </div>
              <!---Comments Modal-->

            <?php } }else{ ?>
              <table class="table table-hover table-border table-responsive table-striped">

                <tbody>

                  <h4><strong> <?php echo trans('087');?> </strong></h4>

                </tbody>
              </table><?php } ?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="MyProfile">
          <!-- PHPTRAVELS profile Starting  -->
          <div class="col-md-12">
            <form action="" id="profilefrm" method="POST" onsubmit="return false;">
              <div class="form-horizontal">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title go-text-right"><?php echo trans('088');?></h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('090');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('090');?>" name="firstname"  value="<?php echo $profile[0]->ai_first_name; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('091');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('091');?>" name="lastname"  value="<?php echo $profile[0]->ai_last_name; ?>"  readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('092');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('092');?>" name="phone"  value="<?php echo $profile[0]->ai_mobile; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title go-text-right"><?php echo trans('093');?>?</h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('094');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="<?php echo $profile[0]->accounts_email; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('095');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="password" placeholder="<?php echo trans('095');?>" name="password"  value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('096');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="password" placeholder="<?php echo trans('096');?>" name="confirmpassword"  value="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title go-text-right"><?php echo trans('097');?></h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('098');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('098');?>" name="address1"  value="<?php echo $profile[0]->ai_address_1; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('099');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('099');?>" name="address2"  value="<?php echo $profile[0]->ai_address_2; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('0100');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('0100');?>" name="city"  value="<?php echo $profile[0]->ai_city; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('0101');?>/<?php echo trans('0102');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('0101');?>/<?php echo trans('0102');?>" name="state"  value="<?php echo $profile[0]->ai_state; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('0103');?>/<?php echo trans('0104');?></div>
                      <div class="col-md-6 go-right">
                        <input class="form-control form" type="text" placeholder="<?php echo trans('0103');?>/<?php echo trans('0104');?>" name="zip"  value="<?php echo $profile[0]->ai_postal_code; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 go-right"><?php echo trans('0105');?></div>
                      <div class="col-md-6 go-right">
                        <select  class="form-control form" name="country">
                          <option value="">Select Country</option>
                          <?php
                            foreach($allcountries as $country){
                            ?>
                          <option value="<?php echo $country->iso2;?>" <?php if($profile[0]->ai_country == $country->iso2){echo "selected";}?> ><?php echo $country->short_name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="oldemail" value="<?php echo $profile[0]->accounts_email;?>" />
                <button class="btn btn-primary updateprofile"><i class="fa fa-save"></i> <?php echo trans('0106');?> </button>
                <br><br><br>
              </div>
            </form>
            <div class="toppage"></div>
            <div class="accountresult"></div>
          </div>
          <!-- PHPTRAVELS profile Ending  -->
        </div>
        <!-- PHPTRAVELS WishList Starting   -->
        <div class="tab-pane fade" id="WishList">
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo trans('0107');?></div>
            <div class="panel-body">
              <?php if(!empty($wishlist)){ ?>
              <?php $count = 0; foreach($wishlist as $wl){ $count++;  ?>
              <div class="featured" id="wish<?php echo $wl->wishid;?>">
                  <div class="col-md-2 row go-right">
                    <img class="img-responsive img-fade" src="<?php echo $wl->thumbnail;?>" alt="">
                  </div>
                  <div class="col-md-6 go-right">
                    <p class="title strong go-text-right"><?php echo $wl->title;?></p>
                    <p class="subtitle go-right"><i class="fa fa-map-marker"></i> <?php echo $wl->location;?></p>
                    <div class="clearfix"></div>
                    <span class="go-right"> <?php echo $wl->stars;?></span>
                  </div>
                  <div class="col-md-2 row go-left">
                    <?php echo trans('08');?><br>
                    <?php echo $wl->date;?>
                  </div>
                  <div class="col-md-2 row go-left">
                    <span class="btn btn btn-block btn-danger btn-sm removewish" id="<?php echo $wl->wishid;?>">  <?php echo trans('0108');?></span>
              <a href="<?php echo base_url().$wl->slug;?>" target="_blank"><span class="btn btn-block btn-sm btn-primary">  <?php echo trans('0109');?></span></a>
              </div>
              <div class="clearfix"></div>
              </div>
             
              <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:6px 0px 6px 0px !important">
              <?php } }else{  ?>
              <h4><?php echo trans('0110');?></h4>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- PHPTRAVELS WishList Ending   -->
        <!-- PHPTRAVELS newsletter Starting   -->
        <div class="tab-pane fade" id="NewsLetter">
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo trans('023');?></div>
            <div class="panel-body">
              <p>
              <div class="checkbox pull-left">
                <label class="go-right"><input type="checkbox" class="newsletter" value="<?php echo $profile[0]->accounts_email;?>" <?php if($is_subscribed){echo "checked";}?> > <?php echo trans('0111');?></label>
              </div>
              <div class="pull-right">
                <button class="btn btn-primary btn-sm"><?php echo trans('086');?></button>
              </div>
              </p>
            </div>
          </div>
        </div>
        <!-- PHPTRAVELS newsletter Ending   -->
      </div>
  </div>
</div>





