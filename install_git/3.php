<?php
session_start();

if(empty($_POST['step3']) && empty($_SESSION['step3'])){
header("Location: 1.php");

}else{


 $_SESSION['step3'] = 3;
}

if(!empty($_SESSION['db_error'])){
 $error = $_SESSION['db_error'];
}else{
 $error = "";
}


if(!empty($_SESSION['dbfields'])){
 $fields = $_SESSION['dbfields'];
}else{
$fields = "";
}

?>

<?php include 'header.php' ?>
<?php $G3 = 'active bold'; ?>
           <form action="4.php" method="POST">
       <div class="col-sm-12">
       <?php include 'side-bar.php' ?>

        <div class="col-sm-9">


          <?php if(!empty($error)){ ?>
           <div class="alert alert-danger" role="alert">
        <?php echo $error;?>
         </div>
          <?php } ?>
            <table class="table table-striped table-responsive table-bordered">

          <tbody>
          <tr>
          <td>Hostname</td>
          <td><input type="text" name="hostname" class="form-control input-sm" value="<?php if(!empty($fields)){ echo $fields['hostname']; } ?>" required /></td>
          <td>Input your hostname or server IP</td>
          </tr>

          <tr>
          <td>Database Name</td>
          <td><input type="text" name="database" class="form-control input-sm" value="<?php if(!empty($fields)){ echo $fields['database']; } ?>" required /></td>
          <td>MySQL database name here</td>
          </tr>

          <tr>
          <td>MySQL Username</td>
          <td><input type="text" name="username" class="form-control input-sm" value="<?php if(!empty($fields)){ echo $fields['username']; } ?>" required /></td>
          <td>Database username goes here</td>
          </tr>

          <tr>
          <td>MySQL Password</td>
          <td><input type="text" name="password" class="form-control input-sm" value="<?php if(!empty($fields)){ echo $fields['password']; } ?>" /></td>
          <td>Database password goes here</td>
          </tr>


          </tbody>
          </table>

         <p>Please be sure that you've already created a MySQL database for your application. Enter the connection information for this database. If you don't know this information, please contact your hosting provider for assistance. </p>

        </div>
        </div>
           </div>
          <div class="clearfix"></div>
         <div class="modal-footer">

         <?php $value ="40"; ?>
        <?php include 'progress.php' ?>

              <a href="2.php"><button type="button" class="btn btn-default">Back</button></a>
         <input type="hidden" name="step4" value="4" />
      <button type="submit" class="btn btn-primary">Next</button>

     </div>
      </form>
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