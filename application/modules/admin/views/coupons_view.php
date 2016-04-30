<script type="text/javascript">
  $(function(){

  $(".generate").click(function(){ 
  $.post("<?php echo base_url();?>admin/coupons/generate_coupon", {}, function(resp){
  $(".code").val(resp);
  });
  });
  //add coupon
  $(".submitcoupon").on("click",function(){

  $.post("<?php echo base_url();?>admin/coupons/addcoupon", $("#addcoupon").serialize(), function(resp){
  if($.trim(resp) == ""){
  $("#coupon_result").html("please wait....").fadeIn("slow");
  location.reload();
  }else{
  $("#coupon_result").html(resp).fadeIn("slow");
  }
  });

  setTimeout(function(){

  $("#coupon_result").fadeOut("slow");

  }, 3000);

  });
  //update coupon
  $(".editcoupon").on("click",function(){
  var id = $(this).prop('id');
  $.post("<?php echo base_url();?>admin/coupons/updatecoupon", $("#editcoupon"+id).serialize(), function(resp){
  if($.trim(resp) == ""){
  $("#coupon_result"+id).html("please wait....").fadeIn("slow");
  location.reload();
  }else{
  $("#coupon_result"+id).html(resp).fadeIn("slow");
  }
  });

  setTimeout(function(){

  $("#coupon_result").fadeOut("slow");

  }, 3000);

  });

  });



</script>
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>

   <div class="panel-body">
   <div class="add_button_modal" > <button type="button" data-toggle="modal" data-target="#ADD_COUPON" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</button></div>
     <?php echo $content; ?>
   </div>
 </div>


 <!--Add Coupon Modal -->
<div class="modal fade" id="ADD_COUPON" tabindex="" role="dialog" aria-labelledby="CouponModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Coupon Code</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" id="addcoupon" action="" onsubmit="return false;">
          <div class="">
            <div class="">
              <div class="panel-body">
                <div id="coupon_result"></div>
                <div class="spacer20px">
                  <div class="col-lg-5">
                    <div class="well">
                      <div class="form-group">
                        <label class="col-md-4 control-label">Status</label>
                        <div class="col-md-8">
                          <select class="form-control" id="#" name="status">
                            <option value="Yes" selected> Enable </option>
                            <option value="No"> Disable </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Percentage</label>
                        <div class="col-md-4">
                          <input type="text" placeholer="Percentage" class="form-control" name="rate" id="rate" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="col-lg-12 well">
                      <div class="input-group">
                        <input type="text" name="code" placeholder="Coupon Code" class="form-control input-lg code" value="" readonly>
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-lg generate" type="button">Generate</button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submitcoupon" id="#" ><i class="fa fa-save"></i> Submit</button>
      </div>
    </div>
  </div>
</div>
<!-----end add coupon modal------>

 <!-- edit coupon Modal -->
 <?php foreach($coupons as $cop){ ?>
<!--PHPTravels Edit coupon modal--->
          <div class="modal fade" id="editCop<?php echo $cop->coupon_id;?>" tabindex="" role="dialog" aria-labelledby="CouponModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Edit Coupon Code "<?php echo $cop->coupon_code;?>"</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" method="POST" id="editcoupon<?php echo $cop->coupon_id;?>" action="" onsubmit="return false;">
                    <div class="">
                      <div class="">
                        <div class="panel-body">
                          <div id="coupon_result<?php echo $cop->coupon_id;?>"></div>
                          <div class="spacer20px">
                            <div class="col-lg-5">
                              <div class="col-lg-12 well">
                                <div class="form-group">
                                  <label class="col-md-4 control-label">Status</label>
                                  <div class="col-md-8">
                                    <select class="form-control" id="#" name="status">
                                      <option value="Yes" <?php if($cop->coupon_status == 'Yes'){ echo "selected"; }?>> Enable </option>
                                      <option value="No" <?php if($cop->coupon_status == 'No'){ echo "selected"; }?>> Disable </option>
                                    </select>
                                  </div>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label class="col-md-4 control-label">Percentage</label>
                                  <div class="col-md-4">
                                    <input type="text" placeholer="Percentage" class="form-control" name="rate" value="<?php echo $cop->coupon_rate;?>" />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="couponid" value=" <?php echo $cop->coupon_id;?>" />
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary editcoupon" id="<?php echo $cop->coupon_id;?>" ><i class="fa fa-save"></i> Update</button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
<!----edit modal--->