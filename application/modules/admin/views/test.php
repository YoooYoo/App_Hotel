<script>
    $(function () {
    $("[data-toggle='tooltip']").tooltip();
    $('#showprofile').click(function(){
    $.post("<?php echo base_url();?>admin/accounts/userprofile", { }, function(theResponse){
    $('#pt_reload_modal').modal('show');
    $('#pt_reload_modal').modal('hide');
    $("#profilecontent").html(theResponse);
    $('#Profiled').modal('show');
    });
    });
    $('.divtoggle').click(function(){
    var id = $(this).prop('id');

    $.post("<?php echo base_url();?>admin/ajaxcalls/togglediv", {id: id }, function(theResponse){

    });
    });
    });
  </script>

  </head>
  <body>
  Testing oye....
  <!--   Profile Modal-->
    <div class="modal fade" id="Profiled" role="dialog" aria-labelledby="Profile" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> My Profile </h4>
          </div>

            <div id="profilecontent">
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>
          <button class="btn btn-primary" type="submit"> <i class="fa fa-save"></i> Update</button>
          </div>
        </div>
      </div>
    </div>

    </body>