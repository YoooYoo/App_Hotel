<?php session_start();
  include 'includes/database_class.php';
  include 'includes/core_class.php';
  $db = new Database();

  if(empty($_POST['step5']) && empty($_SESSION['step5'])){
  header("Location: 1.php");

  }else{

   $db->add_license($_POST,$_SESSION['dbfields']);


   $_SESSION['step5'] = 5;



  }

  ?>
<?php include 'header.php' ?>
<?php $G5 = 'active bold'; ?>
<form action="complete.php" method="POST">
  <div class="col-sm-12">
    <?php include 'side-bar.php' ?>
    <div class="col-md-8">
      <style>
        .form-group {
        margin-bottom: 5px;
        }
      </style>
      <div class="col-md-6" style="margin-top:-11px">
        <div class="form-group">
          <label class="control-label">Admin Name</label>
          <input id="form-input" type="text" placeholder="e.g. John Ibraheem" name="adminname" class="form-control" required>
        </div>
        <div class="form-group">
          <label class="control-label">Admin Email</label>
          <input id="form-input" type="email" placeholder="Email"  name="adminemail"  class="form-control" required>
        </div>
        <div class="form-group">
          <label class="control-label">Admin Password</label>
          <input id="form-input" type="text" placeholder="password" name="adminpass" class="form-control" required>
        </div>
        <div class="form-group">
          <label class="control-label">Site Status</label>
          <select id="form-input" class="form-control" name="site_offine">
            <option value="1">Offline</option>
            <option value="0" selected>Online</option>
          </select>
        </div>
      </div>
      <div class="col-md-6" style="margin-top:-11px">
        <div class="form-group">
          <label class="control-label">Domain Name</label>
          <input id="form-input" value="<?php echo $_SERVER['HTTP_HOST']; ?>" type="text" placeholder="yourdomain.com" name="site_url" class="form-control domain" required>
        </div>
        <div class="form-group">
          <label class="control-label">Company Name</label>
          <input id="form-input" type="text" placeholder="e.g. PHPTRAVELS" name="company" class="form-control">
        </div>
        <div class="form-group">
          <label class="control-label">Copyrights</label>
          <input id="form-input" type="text" placeholder="Reserved by company Name" name="copyright" class="form-control">
        </div>
        <div class="form-group">
          <label class="control-label">Date Formate</label>
          <select id="form-input" type="text" placeholder="password" name="pt_date_format" class="form-control">
            <option value="d/m/Y">dd/mm/yyyy</option>
            <option value="m/d/Y">mm/dd/yyyy</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="clearfix"></div>
  <div class="modal-footer">
    <?php $value ="80"; ?>
    <?php include 'progress.php' ?>
    <a href="4.php"><button type="button" class="btn btn-default">Back</button></a>
    <input type="hidden" name="complete" value="complete" />
    <button type="submit" class="btn btn-primary next">Next</button>
  </div>
</form>
</div>
</div>
</body>
<script type="text/javascript">
  $(function(){
   $(".domain").blur(function(){
       var hasSpace = $(this).val().indexOf(' ')>=0;
       if(hasSpace){
     $(".dcheck").fadeIn("slow");
     $(".next").prop("disabled","disabled");
     $(this).focus();
       }else{

   $(".next").removeAttr("disabled");
   $(".dcheck").fadeOut("fast");
       }



   })


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