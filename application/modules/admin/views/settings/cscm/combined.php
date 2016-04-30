<script>
  $(function(){ slideout();

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
           url: "<?php echo base_url();?>admin/settings/combined_ajax/",
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





  $(".del_comb").on('click',function(){
  var id = $(this).prop('id');
  $.alert.open('confirm', 'Are you sure you want to Delete This combination', function(answer) {
  if (answer == 'yes')
  $.post("<?php echo base_url();?>admin/ajaxcalls/del_cobmined", { id: id }, function(theResponse){
  $("#row_"+id).fadeOut();
  });});});})


function changePagination(pageId,liId){

 $(".loadbg").css("display","block");
     var perpage = $("#perpage").val();
    var last = $(".last").prop('id');
    var prev = pageId - 1;
    var next =  parseFloat(liId) + 1;
     var dataString = 'perpage='+ perpage;
     $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>admin/settings/combined_ajax/"+pageId,
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
           url: "<?php echo base_url();?>admin/settings/combined_ajax/1",
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
  <?php }  ?>
  <?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } echo LOAD_BG; ?>
   <?php if(empty($ajaxreq)){ ?>
   <div class="<?php echo body;?>">
       <div class="panel panel-primary table-bg">

        <div class="panel-heading">
      <span class="panel-title pull-left"><i class="fa fa-flag"></i> Country, State & City Management</span>
      <div class="pull-right">
        <button data-toggle="modal" href="#Connect" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add New</button>
        <a href="<?php echo base_url();?>admin/settings/cscm/countries"> <button class="btn btn-xs btn-primary"> Countries Management</button></a>
        <a href="<?php echo base_url();?>admin/settings/cscm/states">   <button  class="btn btn-xs btn-primary"> States Management</button></a>
        <a href="<?php echo base_url();?>admin/settings/cscm/cities"> <button class="btn btn-xs btn-primary"> Cities Management </button>  </a>
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
            <th><span class="fa fa-compass" data-toggle="tooltip" data-placement="top" title="Country Code"></span> Code</th>
            <th><span class="fa fa-globe" data-toggle="tooltip" data-placement="top" title="Country Name"></span> Country</th>
            <th><span class="fa fa-flag" data-toggle="tooltip" data-placement="top" title="State Name"></span> State</th>
            <th><span class="fa fa-map-marker" data-toggle="tooltip" data-placement="top" title="City Name"></span> City</th>
            <th><i class="fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Action"></i> Action</th>

             </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

              <?php

                  $count_all = 0;

              foreach($all_combined as $all){
                if($count_all % 2 == 0){
                  $evenodd = "even";
                }else{
                   $evenodd = "odd";
                }
              $count_all++
               ?>
            <tr class="<?php echo $evenodd;?>" id="row_<?php echo $all->city_id;?>">
                   <td><?php echo $count_all;?></td>
            <td><?php echo $all->iso2;?></td>
            <td><?php echo $all->short_name;?></td>
            <td><?php echo $all->state_name;?></td>
            <td><?php echo $all->city_name;?></td>

              </td>
                   <td align="center" class=" ">
                   <span data-toggle="modal" href="#connection_<?php echo $all->city_id;?>"> <?php echo PT_EDIT; ?> </span>
                    <span id="<?php echo $all->city_id;?>" class="del_comb"><?php echo PT_DEL; ?></span>
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


  <!-----  <div class="panel-body">
      <h4 class="pull-left">Combined</h4>
      <span class="pull-right">
      </span>
    </div>
    <div class="panel-body">
      <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-hover table-striped table-bordered">
        <thead>
          <tr>
            <th style="width:50px;"><i class="fa fa-list-ol" data-toggle="tooltip" data-placement="top" title="Number">&nbsp;</i></th>
            <th style="width:90px;"><span class="fa fa-compass" data-toggle="tooltip" data-placement="top" title="Country Code"></span> Code</th>
            <th><span class="fa fa-globe" data-toggle="tooltip" data-placement="top" title="Country Name"></span> Country</th>
            <th><span class="fa fa-flag" data-toggle="tooltip" data-placement="top" title="State Name"></span> State</th>
            <th><span class="fa fa-map-marker" data-toggle="tooltip" data-placement="top" title="City Name"></span> City</th>
            <th><i class="fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Action"></i> Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $count_all = 0;
            foreach($all_combined as $all){
            $count_all++;
            ?>
          <tr id="row_<?php echo $all->city_id;?>">
            <td><?php echo $count_all;?></td>
            <td><?php echo $all->iso2;?></td>
            <td><?php echo $all->short_name;?></td>
            <td><?php echo $all->state_name;?></td>
            <td><?php echo $all->city_name;?></td>
            <td align="center">
              <span id="<?php echo $all->city_id;?>" class="btn btn-xs btn-danger del_comb"><i class="fa fa-times"></i> delete</span>
              <button data-toggle="modal" href="#connection_<?php echo $all->city_id;?>" class="btn btn-xs btn-warning"><i class="fa fa-external-link"></i> edit</button>
          </tr>
          <?php
            }

            ?>
        </tbody>
      </table>
    </div> ---->

  <div class="modal fade" id="Connect" role="dialog" aria-labelledby="Connect" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Combination</h4>
        </div>
             <form class="form-horizontal" action="" method="POST">
        <div class="modal-body">

            <fieldset>
              <div class="form-group">
                <label class="col-md-3 control-label">Country</label>
                <div class="col-md-6">
                  <select data-placeholder="Select" class="chosen-select" name="c_country">
                    <?php
                      foreach($all_countries as $allc){
                      ?>
                    <option value="<?php echo $allc->iso2;?>"><?php echo $allc->short_name;?></option>
                    <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">State</label>
                <div class="col-md-6">
                  <select data-placeholder="Select" class="chosen-select" name="c_state">
                    <?php
                      foreach($all_states['all']->result() as $st){
                        ?>
                    <option value="<?php echo $st->state_id;?>"><?php echo $st->state_name;?></option>
                    <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">City</label>
                <div class="col-md-6">
                  <select data-placeholder="Select" class="chosen-select" name="c_city">
                    <?php
                      foreach($all_cities['all'] as $cit){
                       ?>
                    <option value="<?php echo $cit->city_id;?>"><?php echo $cit->city_name;?></option>
                    <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
            </fieldset>
        </div>
        <div class="modal-footer">
        <input type="hidden" name="addcombined" value="1" />
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Add</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
         </form>
      </div>
    </div>
  </div>
  <!---Modal for connection---->
  <?php
    foreach($all_combined as $allcom)
    {
      $city_data = pt_get_city_data($allcom->city_id);
      $sel_state = $city_data['state'];
      $sel_country = $city_data['country'];
    ?>
  <div class="modal fade" id="connection_<?php echo $allcom->city_id;?>" role="dialog" aria-labelledby="City" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Combination </h4>
        </div>
               <form class="form-horizontal" action="" method="POST">
        <div class="modal-body">

            <fieldset>
              <div class="form-group">
                <label class="col-md-3 control-label">Country</label>
                <div class="col-md-6">
                  <select data-placeholder="Select" class="chosen-select" name="c_country">
                    <?php
                      foreach($all_countries as $allc){
                      ?>
                    <option value="<?php echo $allc->iso2;?>"  <?php if($allc->iso2 == $sel_country){echo "selected";}?> ><?php echo $allc->short_name;?></option>
                    <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">State</label>
                <div class="col-md-6">
                  <select data-placeholder="Select" class="chosen-select" name="c_state">
                    <?php
                      foreach($all_states['all']->result() as $st){
                        ?>
                    <option value="<?php echo $st->state_id;?>"  <?php if($st->state_id == $sel_state){echo "selected";}?> ><?php echo $st->state_name;?></option>
                    <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">City</label>
                <div class="col-md-6">
                  <select data-placeholder="Select" class="chosen-select" name="c_city">
                    <?php
                      foreach($all_cities['all'] as $cit){
                       ?>
                    <option value="<?php echo $cit->city_id;?>" <?php if($cit->city_id == $allcom->city_id){echo "selected";}?>> <?php echo $cit->city_name;?> </option>
                    <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
            </fieldset>
        </div>
        <div class="modal-footer">
        <input type="hidden" name="addcombined" value="1" />
        <button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i> Update</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
         </form>
      </div>
    </div>
  </div>

<?php
  }

  ?>
<!--- End Modal for connection---->
</div> </div>