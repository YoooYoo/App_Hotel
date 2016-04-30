<script>
  $(function(){

        slideout();

        $(".searchdata").keypress(function(e) {
    if(e.which == 13) {
    var sterm = $(this).val();
    var perpage = $("#perpage").val();
  if($.trim(sterm).length < 1){

  }else{
 $(".loadbg").css("display","block");

     var dataString = 'search=1&searchdata='+sterm+'&perpage='+perpage;

    $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>admin/settings/states_ajax/",
           data: dataString,
           cache: false,
           success: function(result){
              $(".loadbg").css("display","none");
             $("#ajax-data").html(result);
                 $("#ajax-data").html(result);
                  $("#li_1").addClass("active");
           }
      });
     }
   }
});

      $("#li_1").addClass('active');
      var lilen = $(".litem").length;
      var last = $(".last").prop('id');
  var first = $(".first").prop('id');
  var nextlink = parseFloat(first) + 1;



  $('.del_selected').click(function(){

  var statesids = new Array();

       $(".selectedId_states:checkbox:checked").each(function(){

           statesids.push($(this).val());

        });


      var count_checked = $("[name='states_ids[]']:checked").length;

      if(count_checked == 0){
    $.alert.open('info', 'Please select states to delete.');
        return false;
         }


  $.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
    if (answer == 'yes')


    $.post("<?php echo base_url();?>admin/ajaxcalls/delete_multiple_states", { statesid: statesids }, function(theResponse){

                    location.reload();


  	});


  });

    });


    // disable selected state
        $('.disable_selected').click(function(){

     var statesids = new Array();

       $(".selectedId_states:checkbox:checked").each(function(){

           statesids.push($(this).val());

        });

      var count_checked = $("[name='states_ids[]']:checked").length;

      if(count_checked == 0){
     $.alert.open('info', 'Please select state to disable.');
        return false;
         }


  $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
     if (answer == 'yes')


             $.post("<?php echo base_url();?>admin/ajaxcalls/disable_multiple_states", { statesid: statesids }, function(theResponse){

                    location.reload();


  	});


  });
    });

        // enable selected state
        $('.enable_selected').click(function(){

    var statesids = new Array();

       $(".selectedId_states:checkbox:checked").each(function(){

           statesids.push($(this).val());

        });



      var count_checked = $("[name='states_ids[]']:checked").length;

      if(count_checked == 0){
       $.alert.open('info', 'Please select state to enable.');
        return false;
         }

  $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
    if (answer == 'yes')

        $.post("<?php echo base_url();?>admin/ajaxcalls/enable_multiple_states", { statesid: statesids }, function(theResponse){

                    location.reload();


  	});



  });
    });

    //delete single state
    $(".del_single").click(function(){
   var id = $(this).attr('id');

  $.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
    if (answer == 'yes')


     $.post("<?php echo base_url();?>admin/ajaxcalls/delete_single_state", { statesid: id }, function(theResponse){

                    location.reload();


  	});


  });

    });


            $('#select_all_states').click(function () {
        $('.selectedId_states').prop('checked', this.checked);
    });

    $('.selectedId_states').change(function () {
        var check = ($('.selectedId_states').filter(":checked").length == $('.selectedId_states').length);
        $('#select_all_states').prop("checked", check);
    });

  // Add New State Check
        $(".addnewstate").click(function(){


    var statename = $("#statename").val();


    if(statename.length < 1){

    $(".alert-danger").html("State Name field is required.").fadeIn('slow');
      return false;
    }else{

    return true;

    }
    });

      // updteState Check
        $(".updtestate").click(function(){

             var id = $(this).attr('id');

    var statename = $("#statename_"+id).val();


    if(statename.length < 1){

    $(".alert-danger").html("State Name field is required.").fadeIn('slow');
      return false;
    }else{

    return true;

    }
    });





  })

function changePagination(pageId,liId){

    $(".loadbg").css("display","block");
     var perpage = $("#perpage").val();
    var last = $(".last").prop('id');
    var prev = pageId - 1;
    var next =  parseFloat(liId) + 1;
     var dataString = 'perpage='+ perpage;
     $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>admin/settings/states_ajax/"+pageId,
           data: dataString,
           cache: false,
           success: function(result){
              $(".loadbg").css("display","none");
                 $("#ajax-data").html(result);
                if(liId != '1'){
                 $(".first").after("<li class='previous'><a href='javascript:void(0)' onclick=changePagination('"+prev+"','"+prev+"') >Previous</a></li>");
                 }



                  $(".litem").removeClass("active");
                $("#li_"+liId).addClass("active");

           }
      });
}

function changePerpage(perpage){

  $(".loadbg").css("display","block");

     var dataString = 'perpage='+ perpage;

    $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>admin/settings/states_ajax/1",
           data: dataString,
           cache: false,
           success: function(result){
              $(".loadbg").css("display","none");
             $("#ajax-data").html(result);
             $("#li_1").addClass("active");
           }
      });
}




</script>


  <?php
    $validationerrors = validation_errors();
     if(isset($errormsg) || !empty($validationerrors)){
     ?>
  <div class="alert alert-danger">
    <i class="fa fa-times-circle"></i>
    <?php
      echo @$errormsg;
      echo $validationerrors; ?>
  </div>
  <?php
    }
    ?>
  <?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } echo LOAD_BG; ?>
     <?php if(empty($ajaxreq)){ ?>
        <div class="<?php echo body;?>">
     <input type="hidden" value="0" id="isajax" />





       <div class="panel panel-primary table-bg">

        <div class="panel-heading">
      <span class="panel-title pull-left"><i class="fa fa-flag"></i> States Management</span>
      <div class="pull-right">
          <a data-toggle="modal" href="#State"><?php echo PT_ADD; ?></a>
          <span class="del_selected">   <?php echo PT_DEL_SELECTED; ?></span>
          <span class="disable_selected">   <?php echo PT_DIS_SELECTED; ?></span>
          <span class="enable_selected">   <?php echo PT_ENA_SELECTED; ?></span>
          <?php echo PT_BACK; ?>
      </div>
      <div class="clearfix"></div>

    </div>

            <?php } ?>


      <div class="panel-body">
         <div id="ajax-data">




      <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline" role="grid">
          <div class="row">
            <div class="col-sm-12">
          <div class="pull-left"><div class="dataTables_filter"><label><input type="text" aria-controls="DataTables_Table_0" placeholder="Search" class="form-control input-sm searchdata" value="<?php echo @$searchterm;?>"></label></div>

            </div>
              <div class="pull-right">
                <div >
                  <label>
                    Show
                    <select size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control input-sm" id="perpage" onchange="changePerpage(this.options[this.selectedIndex].value);">
                      <option value="10" <?php if($perpage == 10){ echo "selected"; } ?> >10</option>
                      <option value="25" <?php if($perpage == 25){ echo "selected"; } ?>>25</option>
                      <option value="50" <?php if($perpage == 50){ echo "selected"; } ?>>50</option>
                      <option value="100" <?php if($perpage == 100){ echo "selected"; } ?>>100</option>
                    </select>
                    Rows
                  </label>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
         <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-bordered dataTable" >
            <thead>
              <tr role="row">
                            <th class="width25"><i class="fa fa-list-ol" data-toggle="tooltip" data-placement="top" title="Number">&nbsp;</i></th>
                            <th class="width25"><input class="pointer" type="checkbox" data-toggle="tooltip" data-placement="top"  title="Select All" id="select_all_states" /></th>
                           <th><span class="fa fa-flag" data-toggle="tooltip" data-placement="top" title="State Name"></span> States</th>
							<th><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Status">&nbsp;</i></th>
						   <th><i class="fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Action"></i> Action</th>
             </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

              <?php
              $count_states = 0;
              foreach($all_states as $state){
                if($count_states % 2 == 0){
                  $evenodd = "even";
                }else{
                   $evenodd = "odd";
                }
              $count_states++
               ?>
            <tr class="<?php echo $evenodd;?>">
              <td class="sorting_1"><?php echo $state->state_id;?></td>
              <td><input type="checkbox" name="states_ids[]" value="<?php echo $state->state_id;?>" class="selectedId_states" /></td>
              <td><?php echo $state->state_name;?></td>
              <td class="center">
                <?php if($state->state_status == '0'){
                  ?>
                <span class="times"><i class="fa fa-times"  data-toggle="tooltip" data-placement="top" title="Disabled"></i></span>
                <?php
                  }else{
                   ?>
                <span class="check"><i class="fa fa-check"  data-toggle="tooltip" data-placement="top" title="Enabled"></i></span>
                <?php
                  }

                  ?>
              </td>
                   <td align="center" class=" ">
                   <span data-toggle="modal" href="#editstate_<?php echo $state->state_id;?>"> <?php echo PT_EDIT; ?> </span>
                    <span id="<?php echo $state->state_id;?>" class="del_single"><?php echo PT_DEL; ?></span>
                </td>
            </tr>
            <?php
              }
              ?>


           </tbody>
          </table>
          <div class="row">
            <div class="col-sm-12">
              <div class="pull-left">

                <div class="dataTables_info" >Total Records: <?php echo $count['nums'];?>,  Showing <?php echo $p_fro;?> of <?php echo $paginationCount['total'];?> </div>
              </div>
              <div class="pull-right">
                <div class="dataTables_paginate paging_bs_full" id="DataTables_Table_0_paginate">
                <?php echo $paginationCount['pages'];  ?>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>


      </div>
    </div>


<div class="modal fade" id="State" role="dialog" aria-labelledby="State" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">State</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="" method="POST">
          <fieldset>
            <div class="alert alert-danger" style="display:none;">
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Status</label>
              <div class="col-md-4">
                <select data-placeholder="Enable" name="statestatus" class="chosen-select" tabindex="2">
                  <option value="1">Enable</option>
                  <option value="0">Disable</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Name</label>
              <div class="col-md-7">
                <input class="form-control" type="text" name="statename" id="statename" placeholder="Type name here">
              </div>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="addstate" value="1" />
      <button type="submit" class="btn btn-primary addnewstate"><i class="fa fa-save"></i> Add</button>
      </form>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!----Modal for edit state--------------->
<?php
  foreach($all_states as $sta){
  ?>
<div class="modal fade" id="editstate_<?php echo $sta->state_id;?>" role="dialog" aria-labelledby="State" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">State</h4>
      </div>
       <form class="form-horizontal" action="<?php echo base_url();?>admin/settings/cscm/states" method="POST">

      <div class="modal-body">
          <fieldset>
            <div class="alert alert-danger" style="display:none;">
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Status</label>
              <div class="col-md-4">
                <select data-placeholder="Enable" name="statestatus" class="chosen-select" tabindex="2">
                  <option value="1" <?php if($sta->state_status == '1'){echo "selected";} ?>>Enabled</option>
                  <option value="0" <?php if($sta->state_status == '0'){echo "selected";} ?>>Disabled</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Name</label>
              <div class="col-md-7">
                <input class="form-control" type="text" name="statename" id="statename_<?php echo $sta->state_id;?>" placeholder="Type name here" value="<?php echo $sta->state_name;?>">
              </div>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="updatestate" value="1" />
      <input type="hidden" name="up_stateid" value="<?php echo $sta->state_id;?>" />
      <button type="submit" class="btn btn-primary updatestate" id="<?php echo $sta->state_id;?>"><i class="fa fa-save"></i> Update</button>
      </form>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>
<?php
  }

  ?>
<!----End Modal for edit state--------------->
     </div>
     </div>