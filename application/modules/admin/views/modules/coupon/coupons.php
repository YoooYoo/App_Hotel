<script type="text/javascript">
  $(function(){

        slideout();


    $('.del_selected').click(function(){
      var codelist = new Array();
      $("input:checked").each(function() {
           codelist.push($(this).val());
        });
      var count_checked = $("[name='coupon_ids[]']:checked").length;
      if(count_checked == 0) {

         $.alert.open('info', 'Please select an Code to Delete.');
        return false;
         }


    $.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
        if (answer == 'yes')


  $.post("<?php echo base_url();?>admin/coupons/delete_multiple_codes", { codelist: codelist }, function(theResponse){

                    location.reload();


  	});


    });

    });


  $('.disable_selected').click(function(){
  var codelist = new Array();
  $("input:checked").each(function() {
  codelist.push($(this).val());
  });
  var count_checked = $("[name='coupon_ids[]']:checked").length;
  if(count_checked == 0) {

  $.alert.open('info', 'Please select an Code to Disable.');
  return false;
  }



  $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
  if (answer == 'yes')
  $.post("<?php echo base_url();?>admin/coupons/disable_multiple_codes", { codelist: codelist }, function(theResponse){

  location.reload();


  });


  });


  });


  $('.enable_selected').click(function(){
  var codelist = new Array();
  $("input:checked").each(function() {
  codelist.push($(this).val());
  });
  var count_checked = $("[name='coupon_ids[]']:checked").length;
  if(count_checked == 0) {

  $.alert.open('info', 'Please select an Code to Enable.');
  return false;
  }

  $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
  if (answer == 'yes')
  $.post("<?php echo base_url();?>admin/coupons/enable_multiple_codes", { codelist: codelist }, function(theResponse){

  location.reload();


  });


  });


  });



  $(".del_single").click(function(){
  var id = $(this).attr('id');
  $.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
  if (answer == 'yes')
  $.post("<?php echo base_url();?>admin/coupons/delete_single_coupon", { codeid: id }, function(theResponse){
  location.reload();
  });
  });
  });


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
<div class="<?php echo body;?>">
  <?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } ?>
  <div class="panel panel-primary table-bg">
    <div class="panel-heading">
      <span class="panel-title pull-left"><i class="fa fa-fa fa-asterisk"></i> Coupon Codes Management</span>
      <div class="pull-right">
        <a data-toggle="modal" href="#CopModal"> <?php echo PT_ADD; ?></a>
        <span class="del_selected">   <?php echo PT_DEL_SELECTED; ?></span>
        <span class="disable_selected">   <?php echo PT_DIS_SELECTED; ?></span>
        <span class="enable_selected">   <?php echo PT_ENA_SELECTED; ?></span>
        <?php echo PT_BACK; ?>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-hover table-striped table-bordered">
        <thead>
          <tr>
            <th><i class="fa fa-list-ol" data-toggle="tooltip" data-placement="top" title="Number">&nbsp;</i></th>
            <th style="width:50px;"><input class="pointer" type="checkbox" data-toggle="tooltip" data-placement="top" title="Select All" id="select_all"  /></th>
            <th><span class="" data-toggle="tooltip" data-placement="top" title="Code Number"></span> Code </th>
            <th><span class="" data-toggle="tooltip" data-placement="top" title="Percentage"></span> Percentage </th>
            <th><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="Added On Date"></i> Date</th>
            <th><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Status">&nbsp;</i></th>
            <th><i class="fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Action"></i> Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($coupons)){
            $count = 0;
            foreach($coupons as $cop){ $count++;?>
          <tr>
            <td><?php echo $count;?></td>
            <td><?php if($cop->coupon_used == '0'){ ?><input type="checkbox" name="coupon_ids[]" value="<?php echo $cop->coupon_id;?>" class="selectedId"  /> <?php } ?></td>
            <td><?php echo $cop->coupon_code;?></td>
            <td><?php echo $cop->coupon_rate;?></td>
            <td><?php echo pt_show_date_php($cop->coupon_date);?></td>
            <td><?php if($cop->coupon_status == '1'){ ?>   <span class="check"><i class="fa fa-check"  data-toggle="tooltip" data-placement="top" title="Enabled"></i></span>
              <?php }else{ ?> <span class="times"><i class="fa fa-times"  data-toggle="tooltip" data-placement="top" title="Disabled"></i></span>  <?php } ?>
            </td>
            <td align="center">
              <?php if($cop->coupon_used == '0'){ ?>
              <span class="btn btn-xs btn-warning" data-toggle="modal" href="#editCop<?php echo $cop->coupon_id;?>"><i class="fa fa-external-link"></i> edit</span>
              <span class="btn btn-xs btn-danger del_single" id="<?php echo $cop->coupon_id;?>"><i class="fa fa-times"></i> delete</span> <?php } ?>
            </td>
          </tr>
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
                                      <option value="1" <?php if($cop->coupon_status == '1'){ echo "selected"; }?>> Enable </option>
                                      <option value="0" <?php if($cop->coupon_status == '0'){ echo "selected"; }?>> Disable </option>
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
          <!--PHPTravels Edit coupon code modal--->
          <?php }} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- PHPTravels Add Coupon Modal Starting -->
<div class="modal fade" id="CopModal" tabindex="" role="dialog" aria-labelledby="CouponModal" aria-hidden="true">
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
                            <option value="1" selected> Enable </option>
                            <option value="0"> Disable </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Percentage</label>
                        <div class="col-md-4">
                          <input type="text" placeholer="Percentage" class="form-control" name="rate" />
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
<!---PHPTravels Add Coupon Ending Modal-->