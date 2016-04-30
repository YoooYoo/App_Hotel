<h3 class="go-text-right strong" style="margin-top:0px"><?php echo $offer->title; ?></h3>

<?php if(!$offer->offerForever){ ?><span class="strong  go-right h4"><i class="fa fa-clock-o go-right"></i> &nbsp; <?php echo trans('0269');?>&nbsp; </span> <span class="go-right"> <span class="wow fadeInLeft animated" id="countdown"></span></span><?php } ?>
<div class="clearfix"></div>
<hr>
<?php if(!empty($offer->phone)){ ?>
<div class="row">
  <div class="col-xs-6 col-md-12"><span class="btn btn-block wish btn-primary" data-toggle="modal" data-target="#call"><span class="wishtext"> <i class="fa fa-phone"></i> <?php echo trans('0438');?></span></span></div>
</div>
<?php } ?>


<!-- Modal -->
<div class="modal fade" id="call" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo trans('0438');?></h4>
      </div>
      <div class="modal-body">

      <div class="form-group">
                <div class="col-md-8">
                <h3 class="text-danger"><i class="fa fa-phone"></i> <?php echo $offer->phone;?></h3>
                 </div>
              </div>
            <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
    </div>
  </div>
</div>


<hr>
<?php if(!empty($offer->email)){ ?>
       <form action="" method="POST">
       <fieldset>
       <?php if(!empty($success)){ ?>
       <div class="alert alert-success successMsg">Thanks For Contacting</div>
       <?php } ?>
        <div class="col-md-6 go-right">
          <label class="go-right"><?php echo trans('0350');?></label>
          <input class="form-control form" type="text" name="name" value="" required>
        </div>
        <div class="col-md-6 go-left">
          <label class="go-right"><?php echo trans('092');?></label>
          <input class="form-control form" type="text" name="phone" value="" required><br>
        </div>
        <div class="col-md-12">
          <label class="go-right"><?php echo trans('0262');?></label>
          <textarea class="form-control form" name="message" rows="4" cols="25" required></textarea><br>
        </div>
        <div class="col-md-12">
        <input type="hidden" name="toemail" value="<?php echo $offer->email;?>">
        <input type="hidden" name="sendmsg" value="1">
          <input class="btn btn-success go-right" type="submit" name="" value="<?php echo trans('0439');?>">
        </div>
        <br>
        <!-- END CONTACT FORM -->
      </fieldset>
      </form>

<?php } ?>




<!-- /.modal-content -->
<script type="text/javascript">

  // set the date we're counting down to
  var target_date = new Date('<?php echo $offer->fullExpiryDate; ?>').getTime();

  // variables for time units
  var days, hours, minutes, seconds;

  // get tag element
  var countdown = document.getElementById('countdown');

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
    setTimeout($(".successMsg").fadeOut("slow"),7000);
  })

</script>