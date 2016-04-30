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
           url: "<?php echo base_url();?>admin/settings/cities_ajax/",
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

    $('.del_selected').click(function(){

      var citiesids = new Array();


          $(".selectedId_cities:checkbox:checked").each(function(){

           citiesids.push($(this).val());

        });


      var count_checked = $("[name='cities_ids[]']:checked").length;

      if(count_checked == 0){
        $.alert.open('info', 'Please select Cities to Delete.');
        return false;
         }

  $.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
      if (answer == 'yes')

     $.post("<?php echo base_url();?>admin/ajaxcalls/delete_multiple_cities", { citiesid: citiesids }, function(theResponse){

                    location.reload();


  	});


  });


    });


    // disable selected city
        $('.disable_selected').click(function(){

      var citiesids = new Array();


          $(".selectedId_cities:checkbox:checked").each(function(){

           citiesids.push($(this).val());

        });

      var count_checked = $("[name='cities_ids[]']:checked").length;

      if(count_checked == 0){
         $.alert.open('info', 'Please select a City to Disable.');
        return false;
         }
            $.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
    if (answer == 'yes')


         $.post("<?php echo base_url();?>admin/ajaxcalls/disable_multiple_cities", { citiesid: citiesids }, function(theResponse){

                    location.reload();


  	});


  });


    });

        // enable selected city
        $('.enable_selected').click(function(){

      var citiesids = new Array();


          $(".selectedId_cities:checkbox:checked").each(function(){

           citiesids.push($(this).val());

        });



      var count_checked = $("[name='cities_ids[]']:checked").length;

      if(count_checked == 0){
       $.alert.open('info', 'Please select a City to Enable.');
        return false;
         }


          $.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
    if (answer == 'yes')

       $.post("<?php echo base_url();?>admin/ajaxcalls/enable_multiple_cities", { citiesid: citiesids }, function(theResponse){

                    location.reload();


  	});


  });


    });

    //delete single city
    $(".del_single").click(function(){
   var id = $(this).attr('id');

    $.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
    if (answer == 'yes')

   $.post("<?php echo base_url();?>admin/ajaxcalls/delete_single_city", { citiesid: id }, function(theResponse){

                    location.reload();


  	});


  });


    });


      $('#select_all_cities').click(function () {
      $('.selectedId_cities').prop('checked', this.checked);
      });

      $('.selectedId_cities').change(function () {
      var check = ($('.selectedId_cities').filter(":checked").length == $('.selectedId_cities').length);
      $('#select_all_cities').prop("checked", check);
      });

       // Add New City Check
        $(".addnewcity").click(function(){


    var cityname = $("#cityname").val();


    if(cityname.length < 1){

    $(".alert-danger").html("City Name field is required.").fadeIn('slow');
      return false;
    }else{

    return true;

    }
    });

           // Update City Check
        $(".updatecity").click(function(){
              var id = $(this).attr('id');

    var cityname = $("#cityname_"+id).val();


    if(cityname.length < 1){

    $(".alert-danger").html("City Name field is required.").fadeIn('slow');
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
           url: "<?php echo base_url();?>admin/settings/cities_ajax/"+pageId,
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
           url: "<?php echo base_url();?>admin/settings/cities_ajax/1",
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



       <div class="panel panel-primary table-bg">

        <div class="panel-heading">
      <span class="panel-title pull-left"><i class="fa fa-flag"></i> Cities Management</span>
      <div class="pull-right">
          <a data-toggle="modal" href="#City"><?php echo PT_ADD; ?></a>
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
                            <th class="width25"><input class="pointer" type="checkbox" data-toggle="tooltip" data-placement="top"  title="Select All" id="select_all_cities" /></th>
                           <th><span class="fa fa-flag" data-toggle="tooltip" data-placement="top" title="State Name"></span> Cities</th>
							<th><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Status">&nbsp;</i></th>
						   <th><i class="fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Action"></i> Action</th>
             </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

              <?php
                    $count_cities = 0;

              foreach($all_cities as $city){
                if($count_cities % 2 == 0){
                  $evenodd = "even";
                }else{
                   $evenodd = "odd";
                }
              $count_cities++
               ?>
            <tr class="<?php echo $evenodd;?>">
              <td class="sorting_1"><?php echo $city->city_id;?></td>
              <td><input type="checkbox" name="cities_ids[]" value="<?php echo $city->city_id;?>" class="selectedId_cities" /></td>
              <td><?php echo $city->city_name;?></td>
              <td class="center">
                <?php if($city->city_status == '0'){
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
                   <span data-toggle="modal" href="#editcity_<?php echo $city->city_id;?>"> <?php echo PT_EDIT; ?> </span>
                    <span id="<?php echo $city->city_id;?>" class="del_single"><?php echo PT_DEL; ?></span>
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


<div class="modal fade" id="City" role="dialog" aria-labelledby="City" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">City</h4>
      </div>
       <form class="form-horizontal" action="" method="POST">
      <div class="modal-body">

          <fieldset>
            <div class="alert alert-danger" style="display:none;">
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Status</label>
              <div class="col-md-4">
                <select data-placeholder="Enable" id="citystatus" class="chosen-select" name="citystatus">
                  <option value="1">Enable</option>
                  <option value="0">Disable</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Name</label>
              <div class="col-md-7">
                <input class="form-control" type="text" id="cityname" name="cityname" placeholder="Type name here">
              </div>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="addcity" value="1" />
      <button type="submit" class="btn btn-primary addnewcity" ><i class="fa fa-save"></i> Add</button>

      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
         </form>
    </div>
  </div>
</div>
<!----Modal for edit city--------------->
<?php
  foreach($all_cities as $allcit){
  ?>
<div class="modal fade" id="editcity_<?php echo $allcit->city_id;?>" role="dialog" aria-labelledby="City" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">City</h4>
      </div>
        <form class="form-horizontal" action="" method="POST">
      <div class="modal-body">

          <fieldset>
            <div class="alert alert-danger" style="display:none;">
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Status</label>
              <div class="col-md-4">
                <select data-placeholder="Enable" id="citystatus" class="chosen-select" name="citystatus">
                  <option value="1" <?php if($allcit->city_status == '1'){echo "selected";}?>>Enabled</option>
                  <option value="0" <?php if($allcit->city_status == '0'){echo "selected";}?>>Disabled</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Name</label>
              <div class="col-md-7">
                <input class="form-control" type="text" id="cityname_<?php echo $allcit->city_id;?>" name="cityname" placeholder="Type name here" value="<?php echo $allcit->city_name;?>">
              </div>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="updatecity" value="1" />
      <input type="hidden" name="up_cityid" value="<?php echo $allcit->city_id;?>" />
      <button type="submit" class="btn btn-primary updatecity" id="<?php echo $allcit->city_id;?>"><i class="fa fa-save"></i> Update</button>

      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
           </form>
    </div>
  </div>
  </div>

<?php
  }

  ?>
<!----End Modal for edit city--------------->
            </div>  </div>