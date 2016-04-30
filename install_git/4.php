<?php session_start();
  include 'includes/database_class.php';
  include 'includes/core_class.php';
  $db = new Database();
  $core = new Core();
  if(empty($_POST['step4']) && empty($_SESSION['step4'])){
  header("Location: 1.php");

  }else{

  if(!empty($_SESSION['db_error'])){

  $connection = $db->check_connection($_POST);
  $_SESSION['dbfields'] = $_POST;


  }else{
   $_SESSION['dbfields'] = $_POST;
   $connection = $db->check_connection($_SESSION['dbfields']);

  }

  if(!$connection){

  $_SESSION['db_error'] = "Couldn't connect with database, Kindly check Database Credentials.";
  $_SESSION['dbfields'] = $_POST;
  header("Location: 3.php");
  }else{
   unset($_SESSION['db_error']);
   $core->write_config($_SESSION['dbfields']);
   $core->write_xcrudconfig($_SESSION['dbfields']);
   $db->create_tables($_SESSION['dbfields']);

   $_SESSION['step4'] = 4;


  }

  }

  ?>
<?php include 'header.php' ?>
<?php $G4 = 'active bold'; ?>
<form action="5.php" method="POST">
  <div class="col-sm-12">
    <?php include 'side-bar.php'; ?>
    <div class="loading">
      <div id="rotatingDiv"></div>
    </div>
    <div class="col-sm-9 content">
      <p>Please login to your <span class="text-primary">Client Area</span> to get your domains lincense key. to get the license key please <a href="//phptravels.org" class="target" target="_blank"><strong>Click Here</strong></a> and login to your client area. from menu click on <span class="text-primary">Services</span> and select <span class="text-primary"> My Services</span> from the menu. once visit on services page you can see your license number below product name. please copy the license number and paste here below to continue this installation.</p>
      <hr>
      <div class="form-group form-horizontal">
        <label for="form-input" class="col-sm-2 control-label">License Key</label>
        <div class="col-sm-6">
          <input id="form-input" type="text" name="license" placeholder="e.g. phptravelsbea3e7c1b00509b" class="form-control" required >
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="clearfix"></div>
  <div class="modal-footer content">
    <?php $value ="60"; ?>
    <?php include 'progress.php' ?>
    <a href="3.php"><button type="button" class="btn btn-default">Back</button></a>
    <input type="hidden" name="step5" value="5" />
    <button type="submit" class="btn btn-primary">Next</button>
  </div>
</form>
</div>
</div>
</body>
<script type="text/javascript">
  $(function(){

  $(".content").hide();

  setTimeout(function(){
     $(".loading").fadeOut("fast");
     $(".content").fadeIn("slow");
    }, 15000);

  })
</script>
</html>
<!-- fade starts -->
<script>
  var speed = 'slow';
  $('html, body').hide();
  $(document).ready(function() {
  $('html, body').fadeIn(speed, function() {
  $('a[href], button[href]').click(function(event) {
  if(!$(this).hasClass('target')){
  var url = $(this).attr('href');
  if (url.indexOf('#') == 0 || url.indexOf('javascript:') == 0) return;
  event.preventDefault();
  $('html, body').fadeOut(speed, function() {
  window.location = url;
  }); } }); }); });
</script>
<!-- fade ends -->