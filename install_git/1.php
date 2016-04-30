<?php session_start(); session_destroy();   ?>
<?php chmod("../database.php", 0755);  ?>
<?php include 'header.php' ?>
<?php $G1 = 'active bold'; ?>
<div class="col-sm-12">
  <?php include 'side-bar.php' ?>
  <div class="col-md-8">
    <p class="bold">Thank you for purchasing PHPTRAVELS and turning your business online to our application! We know you're excited to get started, so we'll help you get through the install process as quickly as possible.</p>
    <p>Before getting started with this installation please make sure below steps are done.</p>
    <li>Create database and set username and password</li>
    <li>Use secure and valid hosting</li>
    <li>Read our privacy statement & service terms before get started <a class="bold target" href="http://phptravels.com/terms-and-conditions/" target="_blank">Here</a></li>
  </div>
</div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <?php $value ="0"; ?>
  <?php include 'progress.php' ?>
  <form action="2.php" method="POST">
    <input type="hidden" name="step2" value="2" />
    <button type="submit" class="btn btn-primary">Next</button>
  </form>
</div>
</div>
</div>
</body>
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