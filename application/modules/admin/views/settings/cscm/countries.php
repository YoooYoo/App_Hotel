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
           url: "<?php echo base_url();?>admin/settings/countries_ajax/",
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



                     var options = {   beforeSend: function()
    {

    },
    uploadProgress: function(event, position, total, percentComplete)
    {

    },
    success: function()
    {

    },
    complete: function(response)
    {

    if(response.responseText == "done"){
      $(".output").html('please Wait...');
      location.reload();
    }
    },
    target: '.output' };
    $('.my-form').submit(function() {
        $(this).ajaxSubmit(options);

        return false;
    });

    $('.del_selected').click(function(){

 var countriesids = new Array();

        $(".selectedId_country:checkbox:checked").each(function(){

           countriesids.push($(this).val());

        });


      var count_checked = $("[name='country_ids[]']:checked").length;

      if(count_checked == 0){
      $.alert.open('info', 'Please select country to delete.');  
        return false;
         }

$.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
    if (answer == 'yes')


   $.post("<?php echo base_url();?>admin/ajaxcalls/delete_multiple_countries", { countriesid: countriesids }, function(theResponse){

                    location.reload();


			});


});

    });


    // disable selected country
        $('.disable_selected').click(function(){

    var countriesids = new Array();

      $(".selectedId_country:checkbox:checked").each(function(){

           countriesids.push($(this).val());

        });

      var count_checked = $("[name='country_ids[]']:checked").length;

      if(count_checked == 0){
        $.alert.open('info', 'Please select country to disable.');
        return false;
         }

$.alert.open('confirm', 'Are you sure you want to Disable it', function(answer) {
    if (answer == 'yes')

           $.post("<?php echo base_url();?>admin/ajaxcalls/disable_multiple_countries", { countriesid: countriesids }, function(theResponse){

                    location.reload();


			});


});

    });

        // enable selected country
        $('.enable_selected').click(function(){

   var countriesids = new Array();

      $(".selectedId_country:checkbox:checked").each(function(){

           countriesids.push($(this).val());

        });



      var count_checked = $("[name='country_ids[]']:checked").length;

      if(count_checked == 0){
       $.alert.open('info', 'Please select Countries to Enable.');
        return false;
         }


$.alert.open('confirm', 'Are you sure you want to Enable it', function(answer) {
    if (answer == 'yes')


       $.post("<?php echo base_url();?>admin/ajaxcalls/enable_multiple_countries", { countriesid: countriesids }, function(theResponse){

                    location.reload();


			});



});


    });

    //delete single country
    $(".del_single").click(function(){
   var id = $(this).attr('id');

$.alert.open('confirm', 'Are you sure you want to Delete it', function(answer) {
    if (answer == 'yes')


     $.post("<?php echo base_url();?>admin/ajaxcalls/delete_single_country", { countriesid: id }, function(theResponse){

                    location.reload();


			});


});

    });


         $('#select_all_countries').click(function () {
        $('.selectedId_country').prop('checked', this.checked);
    });

    $('.selectedId_country').change(function () {
        var check = ($('.selectedId_country').filter(":checked").length == $('.selectedId_country').length);
        $('#select_all_countries').prop("checked", check);
    });


 // Adding new country check
    $(".addnewcountry").click(function(){


    var countryname = $("#countryname").val();
    var countrycode = $("#countrycode").val();
    var image = $("#image").val();

    if(countryname.length < 1){

    $(".alert-danger").html("Country Name field is required.").fadeIn('slow');
      return false;
    }else if(countrycode.length < 1){
        $(".alert-danger").html("Country Code is required.").fadeIn('slow');

       return false;
    }else{

    return true;

    }
    });

     // update country check
    $(".updatecountry").click(function(){

            var id = $(this).attr('id');

    var countryname = $("#countryname_"+id).val();
    var countrycode = $("#countrycode_"+id).val();


    if(countryname.length < 1){

    $(".alert-danger").html("Country Name field is required.").fadeIn('slow');
      return false;
    }else if(countrycode.length < 1){
        $(".alert-danger").html("Country Code is required.").fadeIn('slow');

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
           url: "<?php echo base_url();?>admin/settings/countries_ajax/"+pageId,
           data: dataString,
           cache: false,
           success: function(result){
              $(".loadbg").css("display","none");
                 $("#ajax-data").html(result);
                if(liId != '1'){
                 $(".first").after("<li class='previous'><a href='javascript:void(0)' onclick=changePagination('"+prev+"','"+prev+"') >Previous</a></li>");
                 }

             /*    if(liId < last){
                 $(".last").before("<li id='next'><a href='javascript:void(0)' onclick=changePagination('"+next+"','"+next+"') >Next</a></li>");
                 }else{
                     $("#next").hide();
                 }
                  $(".next").hide();*/

                  $(".litem").removeClass("active");
                $("#li_"+liId).css("display","block");
                $("#li_"+liId).addClass("active");

           }
      });
}

function changePerpage(perpage){

    $(".loadbg").css("display","block");

     var dataString = 'perpage='+ perpage;

    $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>admin/settings/countries_ajax/1",
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
      <span class="panel-title pull-left"><span class="glyphicon glyphicon-list"></span> Countries Management</span>
      <div class="pull-right">
 <a data-toggle="modal" href="#AddCountry"><?php echo PT_ADD; ?></a>
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

            <th style="width:50px;"><i class="fa fa-list-ol" data-toggle="tooltip" data-placement="top" title="Number">&nbsp;</i></th>
                            <th style="width:50px;"><input class="pointer" type="checkbox" data-toggle="tooltip" data-placement="top" title="Select All" id="select_all_countries" /></th>
							<th style="width:70px;"><span class="fa fa-picture-o" data-toggle="tooltip" data-placement="top" title="Image"></span> </th>
                            <th><span class="fa fa-compass" data-toggle="tooltip" data-placement="top" title="Country Code"></span> Code</th>
                            <th><span class="fa fa-globe" data-toggle="tooltip" data-placement="top" title="Country Name"></span> Country</th>
                            <th style="width:50px;"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Status">&nbsp;</i></th>
							<th><i class="fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Action"></i> Action</th>

            </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

              <?php

               $count_countries = 0;

              foreach($all_countries as $country){
                if($count_countries % 2 == 0){
                  $evenodd = "even";
                }else{
                   $evenodd = "odd";
                }
              $count_countries++
               ?>
            <tr class="<?php echo $evenodd;?>">


            <td><?php echo $country->country_id;?></td>
                            <td><input type="checkbox" name="country_ids[]" value="<?php echo $country->iso2;?>" class="selectedId_country" /></td>
                            <td class="zoom_img">
                            <?php if(empty($country->flag_img)){
                              ?>
                             <img src="<?php echo PT_DEFAULT_IMAGE.'flag.png';?>" title="" />

                              <?php
                              }else{
                                ?>
                             <img src="<?php echo PT_FLAG_IMAGES.$country->flag_img;?>" title="" />

                                <?php
                                }
                                ?>


                         </td>
                                <td><?php echo $country->iso2;?></td>
                                <td><?php echo $country->short_name;?></td>
             <td class="center">
             <?php if($country->country_status == '0'){
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

             <td align="center">

  <span data-toggle="modal" href="#editcountry_<?php echo $country->country_id;?>"> <?php echo PT_EDIT; ?> </span>
 <span id="<?php echo $country->iso2;?>" class="del_single"><?php echo PT_DEL; ?></span>
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














   <div class="modal fade" id="AddCountry" role="dialog" aria-labelledby="AddCountry" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title">Country</h4>
            </div>
            	 <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >

              <div class="modal-body">

                   <fieldset>
                   <div class="output"> </div>
                     <div class="alert alert-danger" style="display:none;">

                            </div>

                      <div class="form-group">
						 <label class="col-md-4 control-label">Status</label>
							 <div class="col-md-4">
								 <select data-placeholder="Enable" class="chosen-select" name="countrystatus">

                                 <option value="1">Enable</option>
                                 <option value="0">Disable</option>
                                 </select>
						     </div>
                        </div>

                        <div class="form-group">
     				        <label class="col-md-4 control-label">Country Short Code</label>
						   <div class="col-md-2">
					      <input class="form-control" type="text" id="countrycode" name="countrycode" placeholder="Code">
					    </div>
                        <small> Example: 'PK' for Pakistan</small>
                      </div>

                       <div class="form-group">
     				        <label class="col-md-4 control-label">Name</label>
						   <div class="col-md-7">
					      <input class="form-control" type="text" name="countryname" id="countryname" placeholder="Type name here">
					    </div>
                      </div>

                       <div class="form-group">
									<label class="col-md-4 control-label">Picture</label>
									<div class="col-md-8">
										<input type="file" name="photo" class="btn btn-default" id="image">
										<p class="help-block">
									  <img src="<?php echo PT_DEFAULT_IMAGE.'flag.png';?>" class="preview_img" class="img-rounded" width="80" height="80" alt="" />
										</p>
									</div>
								</div>


                   </fieldset>


              </div>
            <div class="modal-footer">
            <input type="hidden" name="addcountry" value="1" />
          <button type="submit" class="btn btn-primary addnewcountry" ><i class="fa fa-save"></i> Add</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

      </div>    	</form>
    </div>
   </div>  </div>






 <!----End Modal for edit country--------------->

 <?php
         foreach($all_countries as $allcn){
   ?>

   <div class="modal fade" id="editcountry_<?php echo $allcn->country_id;?>" role="dialog" aria-labelledby="AddCountry" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title">Country</h4>
            </div>
                <form class="form-horizontal my-form" action=""  method="POST" enctype="multipart/form-data" >

              <div class="modal-body">

                   <fieldset>
                    <div class="output"> </div>
                     <div class="alert alert-danger" style="display:none;">

                            </div>

                      <div class="form-group">
						 <label class="col-md-4 control-label">Status</label>
							 <div class="col-md-4">
								 <select data-placeholder="Enable" class="chosen-select" name="countrystatus">

                                 <option value="1" <?php if($allcn->country_status == '1'){echo "selected";} ?>>Enabled</option>
                                 <option value="0" <?php if($allcn->country_status == '0'){echo "selected";} ?>>Disabled</option>
                                 </select>
						     </div>
                        </div>

                        <div class="form-group">
     				        <label class="col-md-4 control-label">Country Short Code</label>
						   <div class="col-md-2">
					      <input class="form-control" type="text"  name="countrycode" id="countrycode_<?php echo $allcn->country_id;?>"  placeholder="Code" value="<?php echo $allcn->iso2; ?>">
					    </div>
                        <small> Example: 'PK' for Pakistan</small>
                      </div>

                       <div class="form-group">
     				        <label class="col-md-4 control-label">Name</label>
						   <div class="col-md-7">
					      <input class="form-control" type="text" name="countryname" id="countryname_<?php echo $allcn->country_id;?>" placeholder="Type name here"  value="<?php echo $allcn->short_name; ?>">
					    </div>
                      </div>

                       <div class="form-group">
									<label class="col-md-4 control-label">Picture</label>
									<div class="col-md-8">
										<input type="file" name="photo" class="btn btn-default" id="image">
										<p class="help-block">
                                        <?php
                                        if(empty($allcn->flag_img)){
                                          ?>
									  <img src="<?php echo PT_DEFAULT_IMAGE.'flag.png';?>" class="preview_img" class="img-rounded" width="80" height="80" alt="" />
                                      <?php
                                      }else{
                                      ?>
                                       <img src="<?php echo PT_FLAG_IMAGES.$allcn->flag_img;?>" class="preview_img" class="img-rounded" width="80" height="80" alt="" />
                                      <?php
                                      }
                                      ?>
                                      </p>
									</div>
								</div>


                   </fieldset>


              </div>
            <div class="modal-footer">
            <input type="hidden" name="updatecountry" value="1" />
             <input type="hidden" name="oldcode" value="<?php echo $allcn->iso2;?>" />
             <input type="hidden" name="oldphoto" value="<?php echo $allcn->flag_img;?>" />
            <input type="hidden" name="countryid" value="<?php echo $allcn->country_id;?>" />
          <button type="submit" class="btn btn-primary updatecountry" id="<?php echo $allcn->country_id;?>"><i class="fa fa-save"></i> Update</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
        	</form>
    </div>
   </div>
 </div>

  <?php

  }

  ?>
 <!----End Modal for edit country--------------->


                    </div>
                    </div>