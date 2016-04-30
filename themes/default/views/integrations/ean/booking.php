<script type="text/javascript">

  $(function(){

        $(".submitresult").hide();

        })

       function expcheck(){

          $(".submitresult").html("").fadeOut("fast");

       var cardno = $("#card-number").val();
       var cardtype = $("#cardtype").val();

       var email = $("#card-holder-email").val();

       var country = $("#country").val();

       var cvv = $("#cvv").val();

       var city = $("#card-holder-city").val();

       var state = $("#card-holder-state").val();

       var postalcode = $("#card-holder-postalcode").val();

       var firstname = $("#card-holder-firstname").val();

       var lastname = $("#card-holder-lastname").val();
       var policy = $("#policy").val();
      var minMonth = new Date().getMonth() + 1;

      var minYear = new Date().getFullYear();

      var month = parseInt($("#expiry-month").val(), 10);

      var year = parseInt($("#expiry-year").val(), 10);

       if(country == "US"){

        if($.trim(postalcode) == ""){

       $(".submitresult").html("Enter Postal Code").fadeIn("slow");

       return false;

       }else if($.trim(state) == ""){

      $(".submitresult").html("Enter State").fadeIn("slow");

       return false;

       }

       }

       if($.trim(firstname) == ""){

       $(".submitresult").html("Enter First Name").fadeIn("slow");

       return false;

       }else if($.trim(lastname) == ""){

      $(".submitresult").html("Enter Last Name").fadeIn("slow");

       return false;

       }else if($.trim(cardno) == ""){

      $(".submitresult").html("Enter Card number").fadeIn("slow");

       return false;

       }else if($.trim(cardtype) == ""){

      $(".submitresult").html("Select Card Type").fadeIn("slow");

       return false;

       }else if(month <= minMonth && year <= minYear){

        $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");

       return false;



       }else if($.trim(cvv) == ""){

        $(".submitresult").html("Enter Security Code").fadeIn("slow");

       return false;



       }else if($.trim(country) == ""){

        $(".submitresult").html("Select Country").fadeIn("slow");

       return false;



       }else if($.trim(city) == ""){

        $(".submitresult").html("Enter City").fadeIn("slow");

       return false;



       }else if($.trim(email) == ""){

        $(".submitresult").html("Enter Email").fadeIn("slow");

       return false;



       }else if($.trim(policy) == ""){

        $(".submitresult").html("Please Accept Cancellation Policy").fadeIn("slow");

       return false;



       }else{

         $(".paynowbtn").hide();

        $(".submitresult").removeClass("alert-danger");

        $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");

       }





       }

       function isNumeric(evt)

        {

          var e = evt || window.event; // for trans-browser compatibility

          var charCode = e.which || e.keyCode;

          if (charCode > 31 && (charCode < 47 || charCode > 57))

          return false;

          if (e.shiftKey) return false;

          return true;

       }





    </script>

<div class="container">

<div class="panel panel-default">

  <div class="panel-heading"><?php echo trans('0335');?></div>

  <div class="panel-body">





<div class="col-md-8">

<?php if($result == "success"){ ?>



<center><img class="img-responsive" src="<?php base_url(); ?>assets/images/success.jpg" alt="" /></center>

<br><br>

<div class="alert alert-success wow bounce" role="alert"> <p><?php echo $msg;?></p></div>



<?php  }else{ if(!empty($result)){ ?>



<div class="alert alert-success wow bounce" role="alert"> <p><?php echo $msg;?></p></div> <?php } ?>



<form  class="form-horizontal" role="form" action="" method="POST">

          <fieldset>

           <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-email"><?php echo trans('094');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="email" id="card-holder-email" placeholder="Email" value="<?php echo set_value('email');?>">

              </div>

            </div>

            <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-name"><?php echo trans('0314');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="firstName" id="card-holder-firstname" placeholder="Card Holder's First Name" value="<?php echo set_value('firstName');?>">

              </div>

            </div>

            <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-name"><?php echo trans('0315');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="lastName" id="card-holder-lastname" placeholder="Card Holder's Last Name" value="<?php echo set_value('lastName');?>">

              </div>

            </div>

             <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-address"><?php echo trans('098');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="address" id="card-holder-address" placeholder="Card Holder's Address" value="<?php echo set_value('address');?>">

              </div>

            </div>

            <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-phone"><?php echo trans('092');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" required name="phone" id="card-holder-phone" placeholder="Card Holder's Phone" value="<?php echo set_value('phone');?>">

              </div>

            </div>

             <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-city"><?php echo trans('0100');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="city" id="card-holder-city" placeholder="Card Holder's City" value="<?php echo set_value('city');?>">

              </div>

            </div>

              <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-postalcode"><?php echo trans('0103');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="postalcode" id="card-holder-postalcode" placeholder="Postal Code" value="<?php echo set_value('postalcode');?>">

              </div>

            </div>

            <div class="form-group">

              <label class="col-sm-4 control-label" for="card-holder-state"><?php echo trans('0101');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="province" id="card-holder-state" placeholder="Card Holder's State/Province code" value="<?php echo set_value('province');?>">

              </div>

            </div>

             <div class="form-group">

              <label class="col-sm-4 control-label" for="country"><?php echo trans('0105');?></label>

              <div class="col-sm-8">

                <div class="row">

                  <div class="col-xs-6">

                <select data-placeholder="Select" id="country" name="country" class="chosen-select">

                <option value=""> <?php echo trans('0158');?> <?php echo trans('0105');?> </option>

                <?php foreach($allcountries as $c){

                ?>

                <option value="<?php echo $c->iso2;?>"><?php echo $c->short_name;?></option>

                <?php



                }



                ?>

                </select>

                  </div>



                </div>

              </div>

            </div>



            <div class="form-group">

              <label class="col-sm-4 control-label" for="card-number"><?php echo trans('0316');?></label>

              <div class="col-sm-8">

                <input type="text" class="form-control" name="cardno" id="card-number" pattern=".{12,}" required title="12 characters minimum" placeholder="Credit Card Number" onkeypress="return isNumeric(event)" value="<?php echo set_value('cardno');?>" >

              </div>

            </div>

            <div class="form-group">

              <label class="col-sm-4 control-label" for="expiry-month"><?php echo trans('0317');?></label>

              <div class="col-sm-8">

                <div class="row">

                  <div class="col-xs-6">

                    <select class="form-control col-sm-2" name="expMonth" id="expiry-month">

                      <option value="01"><?php echo trans('0317');?> (01)</option>

                      <option value="02"><?php echo trans('0318');?> (02)</option>

                      <option value="03"><?php echo trans('0319');?> (03)</option>

                      <option value="04"><?php echo trans('0320');?> (04)</option>

                      <option value="05"><?php echo trans('0321');?> (05)</option>

                      <option value="06"><?php echo trans('0322');?> (06)</option>

                      <option value="07"><?php echo trans('0323');?> (07)</option>

                      <option value="08"><?php echo trans('0324');?> (08)</option>

                      <option value="09"><?php echo trans('0325');?> (09)</option>

                      <option value="10"><?php echo trans('0326');?> (10)</option>

                      <option value="11"><?php echo trans('0327');?> (11)</option>

                      <option value="12"><?php echo trans('0328');?> (12)</option>

                    </select>

                  </div>

                  <div class="col-xs-6">

                    <select class="form-control" name="expYear" id="expiry-year">

                      <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>

                      <option value="<?php echo $y?>"><?php echo $y; ?></option>

                      <?php } ?>

                    </select>

                  </div>

                </div>

              </div>

            </div>

            <div class="form-group">

              <label class="col-sm-4 control-label" for=""><?php echo trans('0330');?> </label>

              <div class="col-sm-4">

              <select class="form-control" name="cardtype" id="cardtype">
               <option value="">Select Card</option>
             <?php foreach($payment as $pay){ ?>

              <option value="<?php echo $pay['code'];?>"> <?php echo $pay['name'];?> </option>

             <?php  } ?>



              </select>

              </div>

            </div>

            <div class="form-group">

              <label class="col-sm-4 control-label" for="cvv"><?php echo trans('0331');?></label>

              <div class="col-sm-4">

                <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code" value="<?php echo set_value('cvv');?>">

              </div>

            </div>

              <div class="form-group">
              <label class="col-sm-4 control-label" for="">&nbsp;</label>
              <div class="col-sm-8">

              <input type="checkbox" id="policy" name="policy" value="1"> I acknowledge that i read and accept <a href="javascript: void()" data-toggle="tooltip" data-placement="top" target="" title="" data-original-title="<?php echo $cancelpolicy; ?> ">Cancellation Policy</a>

              </div>

              </div>

            <div class="form-group">

              <div class="col-sm-offset-4 col-sm-9">

                <div class="alert alert-danger submitresult"></div>

                <input type="hidden" name="pay" value="1" />

                <input type="hidden" name="adults" value="<?php echo $_GET['adults'];?>" />

                <input type="hidden" name="sessionid" value="<?php echo $_GET['sessionid']; ?>" />

                <input type="hidden" name="hotel" value="<?php echo $_GET['hotel']; ?>" />

                <input type="hidden" name="hotelname" value="<?php echo $HotelSummary['name'];?>" />

                <input type="hidden" name="roomname" value="<?php echo $roomname; ?>" />

                <input type="hidden" name="roomtotal" value="<?php echo $currency." ".$roomtotal; ?>" />

                <input type="hidden" name="checkin" value="<?php echo $_GET['checkin']; ?>" />

                <input type="hidden" name="checkout" value="<?php echo $_GET['checkout']; ?>" />

                <input type="hidden" name="roomtype" value="<?php echo $_GET['roomtype']; ?>" />

                <input type="hidden" name="ratecode" value="<?php echo $_GET['ratecode']; ?>" />

                <input type="hidden" name="currency" value="<?php echo $currency; ?>" />

                <input type="hidden" name="total" value="<?php echo $total; ?>" />

                <input type="hidden" name="tax" value="<?php echo $currency." ".$tax; ?>" />

                <input type="hidden" name="nights" value="<?php echo $nights; ?>" />

                <button type="submit" class="btn btn-success btn-lg paynowbtn" onclick="return expcheck();"><?php echo trans('0117');?></button>

              </div>

            </div>

          </fieldset>

        </form><?php } ?>

        </div>





        <div class="col-md-4">

       <p> <img width="96" height="72" class="img-thumbnail" src="<?php echo $HotelImages['HotelImage'][0]['thumbnailUrl']; ?>" /></p>

        <h3 class="strong"><?php echo $HotelSummary['name'];?> </h3>

        <hr>

        <strong><p><?php echo trans("07");?>: &nbsp; <?php echo $checkin;?></p>

        <p><?php echo trans("09");?>: &nbsp; <?php echo $checkout;?></p> </strong>

        <p><?php echo $roomname; ?></p>

        <p><?php echo trans('0332');?>: <?php echo $currency." ".$roomtotal; ?> </p>

        <p><?php echo trans('0333');?>: <?php echo $currency." ".$tax; ?> </p>

        <strong><p><?php echo trans('0334');?>: <?php echo $currency." ".$total; ?> </p> </strong>

        </div>



</div>

</div>





</div>

