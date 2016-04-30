<style>
  .modal-content { box-shadow: none !important; }
  .modal-footer { background-color: #E3E3E3;    }
  .btn-circle {
  border-radius: 50%;
  font-size: 54px;
  padding: 10px 20px;
  }

  #rotatingImg {
  display: none;
  }
  #rotatingDiv {
  display: block;
  margin: 32px auto;
  height: 100px;
  width: 100px;
  -webkit-animation: rotation .9s infinite linear;
  -moz-animation: rotation .9s infinite linear;
  -o-animation: rotation .9s infinite linear;
  animation: rotation .9s infinite linear;
  border-left: 8px solid rgba(0,0,0,.20);
  border-right: 8px solid rgba(0,0,0,.20);
  border-bottom: 8px solid rgba(0,0,0,.20);
  border-top: 8px solid rgba(33,128,192,1);
  border-radius: 100%;
  }
  @keyframes rotation {
  from {
  transform: rotate(0deg);
  }
  to {
  transform: rotate(359deg);
  }
  }
  @-webkit-keyframes rotation {
  from {
  -webkit-transform: rotate(0deg);
  }
  to {
  -webkit-transform: rotate(359deg);
  }
  }
  @-moz-keyframes rotation {
  from {
  -moz-transform: rotate(0deg);
  }
  to {
  -moz-transform: rotate(359deg);
  }
  }
  @-o-keyframes rotation {
  from {
  -o-transform: rotate(0deg);
  }
  to {
  -o-transform: rotate(359deg);
  }
  }
  /*************************** Loading animation Ending ****************************/


</style>

<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-body">


      <br><br>
      <div class="center-block">
      <?php if(!empty($errormsg)){ ?>
    <div class="alert alert-danger"><?php echo $errormsg; ?></div>
    <?php  } ?>
        
        <center>
          <?php if($invoice->status == "unpaid"){ ?>
          <button class="btn btn-circle block-center btn-lg btn-warning wow rotateIn animated">&#x1f552;</button>
          <br><br>
          <div class="text-center">
            <div class="wow fadeInLeft animated" id="countdown"></div>
          </div>
          <h3 style="margin-top:0px" class="text-center"><?php echo trans('0409');?> <b class="text-warning wow flash animted"><?php echo trans('082');?></b></h3>
          <div class="form-group">
          <?php if($payOnArrival){ ?>
            <button class="btn-arrival arrivalpay" data-module="<?php echo $invoice->module; ?>" id="<?php echo $invoice->id;?>"><?php echo trans('0345');?></button>
          <?php } if($singleGateway != "payonarrival"){ ?>  
            <button data-toggle="modal" data-target="#paynow" type="submit" class="btn btn-primary"><?php echo trans('0117');?></button>
          <?php } ?>
          </div>
          <?php }elseif($invoice->status == "reserved"){ ?>
        <button class="btn btn-circle block-center btn-lg btn-warning wow rotateIn animated">&#x1f552;</button>
        <h3 style="margin-top:0px" class="text-center"><?php echo trans('0409');?> <b class="text-warning wow flash animted"><?php echo trans('0445');?></b></h3>
        <?php if($invoice->paymethod == "payonarrival"){ ?>
        <p class="text-center"> <?php echo $msg;?></p>
        <?php } }else{ ?>    
          <button class="btn btn-circle block-center btn-lg btn-success"><i class="fa fa-check"></i></button>
          <h3 class="text-center"><?php echo trans('0409');?> <b class="text-success wow flash animted"><?php echo trans('081');?></b></h3>
          <p class="text-center"><?php echo trans('0410');?> <?php echo $invoice->accountEmail;?></p>
           <?php } ?>
        </center>
      </div>

            <hr>

    <?php require $themeurl . 'views/hotels/invoice.php';?>

    </div>
    <div class="row hidden-xs">
    <div class="panel-footer">
      <strong><?php echo trans('0131');?>,</strong>
      <p><?php echo $app_settings[0]->site_title;?> | <?php echo trans('0132');?></p>
    </div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<!-- PHPtravels Bank Transfer Modal Starting-->
<div class="modal fade" id="banktrans" tabindex="-1" role="dialog" aria-labelledby="banktrans" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo trans('0355');?></h4>
      </div>
      <div class="modal-body">
        <?php echo "banktransfer"; ?>
      </div>
    </div>
  </div>
</div>
<!-- PHPtravels Bank Transfer Modal Ending-->




<!-- Modal -->
<div class="modal fade" id="paynow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo trans('0377');?></h4>
      </div>
      <div class="modal-body">




<div role="form" class="form-horizontal">
<div class="form-group">
<label for="form-input" class="col-sm-2 control-label"><?php echo trans('0154');?></label>
<div class="col-sm-6">
<?php //print_r($paymentGateways); ?>
        <select class="form-control form" name="gateway" id="gateway">
        <option value="">Select Payment Method</option>
         <?php foreach ($paymentGateways as $pay) { if($pay['name'] != "payonarrival"){ ?>
            <option value="<?php echo $pay['name']; ?>"><?php echo $pay['displayName']; ?></option>
         <?php } } ?>
        </select>
      
</div>
</div>
  <div class="col-sm-12" id="response"></div>
   <div class="col-sm-12 creditcardform" style="display:none;">
        <form  class="form-horizontal" role="form" action="<?php echo base_url();?>creditcard" method="POST">
          <fieldset>
          <div class="form-group">
              <label class="col-sm-4 control-label" for="card-holder-name">First Name</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="firstname" id="card-holder-firstname" placeholder="Card Holder's First Name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="card-holder-name">Last Name</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="lastname" id="card-holder-lastname" placeholder="Card Holder's Last Name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="card-number">Card Number</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="cardnum" id="card-number" placeholder="Card Number" onkeypress="return isNumeric(event)" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="expiry-month">Expiration Date</label>
              <div class="col-sm-8">
                <div class="row">
                  <div class="col-xs-6">
                    <select class="form-control col-sm-2" name="expMonth" id="expiry-month">
                      <option value="01">Jan (01)</option>
                      <option value="02">Feb (02)</option>
                      <option value="03">Mar (03)</option>
                      <option value="04">Apr (04)</option>
                      <option value="05">May (05)</option>
                      <option value="06">June (06)</option>
                      <option value="07">July (07)</option>
                      <option value="08">Aug (08)</option>
                      <option value="09">Sep (09)</option>
                      <option value="10">Oct (10)</option>
                      <option value="11">Nov (11)</option>
                      <option value="12">Dec (12)</option>
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
              <label class="col-sm-4 control-label" for="cvv">Card CVV</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-9">
                <div class="alert alert-danger submitresult"></div>
                <input type="hidden" name="paymethod" id="creditcardgateway" value="" />
                <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $invoice->bookingID;?>" />
                <input type="hidden" name="refno" id="bookingid" value="<?php echo $invoice->code;?>" />
                <button type="submit" class="btn btn-success btn-lg paynowbtn" onclick="return expcheck();">Pay Now</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
</div>



      <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  // set the date we're counting down to
 // var target_date = new Date('<?php echo $invoice->expiryFullDate; ?>').getTime();
  var target_date = <?php echo $invoice->expiryUnixtime * 1000; ?>;

  // variables for time units
  var days, hours, minutes, seconds;

  // get tag element
  var countdown = document.getElementById('countdown');
  var ccc = new Date().getTime();
  
  // update the tag with id "countdown" every 1 second
  setInterval(function () {

  // find the amount of "seconds" between now and target
  var current_date = new Date().getTime();
 
  var seconds_left = (target_date - current_date) / 1000;

  // do some time calculations
  days = parseInt(seconds_left / 86400);
  seconds_left = seconds_left % 86400;

  hours = parseInt(seconds_left / 3600);
  seconds_left = seconds_left % 3600;

  minutes = parseInt(seconds_left / 60);
  seconds = parseInt(seconds_left % 60);

  // format countdown string + set tag value
  countdown.innerHTML = '<span class="days">' + days +  ' <b><?php echo trans("0440");?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441");?></b></span> <span class="minutes">'
  + minutes + ' <b><?php echo trans("0442");?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443");?></b></span>';

  }, 1000);

  $(function(){ 
      $(".submitresult").hide();
    $(".arrivalpay").on("click",function(){
      var id = $(this).prop("id");
      var module = $(this).data("module"); 
      var check = confirm("Are you sure you want to pay at arrival?");
      if(check){
      $.post("<?php echo base_url();?>invoice/updatePayOnArrival", {id: id,module: module}, function(resp){
        location.reload();
      });

      }
      
    });

    $("#gateway").on("change",function(){ 
      var gateway = $(this).val();
      $("#response").html("<div id='rotatingDiv'></div>");
      $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
       var response = $.parseJSON(resp);
       console.log('response');
       if(response.iscreditcard == "1"){
        $(".creditcardform").fadeIn("slow");
        $("#creditcardgateway").val(response.gateway);
        $("#response").html("");
       }else{
       $(".creditcardform").hide();
       $("#response").html(response.htmldata); 
       }
       
     
      });
    })
  });

 function expcheck(){
          $(".submitresult").html("").fadeOut("fast");
       var cardno = $("#card-number").val();
       var firstname = $("#card-holder-firstname").val();
       var lastname = $("#card-holder-lastname").val();
      var minMonth = new Date().getMonth() + 1;
      var minYear = new Date().getFullYear();
      var month = parseInt($("#expiry-month").val(), 10);
      var year = parseInt($("#expiry-year").val(), 10);

       if($.trim(firstname) == ""){
       $(".submitresult").html("Enter First Name").fadeIn("slow");
       return false;
       }else if($.trim(lastname) == ""){
      $(".submitresult").html("Enter Last Name").fadeIn("slow");
       return false;
       }else if($.trim(cardno) == ""){
      $(".submitresult").html("Enter Card number").fadeIn("slow");
       return false;
       }else if(month <= minMonth && year <= minYear){
        $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");
       return false;

       }else{
         $(".paynowbtn").hide();
        $(".submitresult").removeClass("alert-danger");
        $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");
       }


       }

</script>