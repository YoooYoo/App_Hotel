<?php
session_start();
include 'includes/database_class.php';
include 'includes/core_class.php';
$db = new Database();
function addhttp($url)
{
    if ( ! preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }

    return $url;
}

if (empty ( $_POST['complete'] )) {
    header("Location: 1.php");
} else {
    $db->app_settings($_POST, $_SESSION['dbfields']);
    session_destroy();
}
?>
<?php include 'header.php' ?>
<h3 class="text-success text-center">Hello <strong><?php echo $_POST['adminname']; ?>!</strong></h3>
<p class="bold text-center">Congratulations PHPTRAVELS installed successfully and ready to get started.</p>
<hr>
<div class="col-md-4">
    <div class="block">
        <div class="panel-body">
            <form action="<?php echo addhttp($_POST['site_url']); ?>" target="_blank" method="post">
                <button class="btn btn-default btn-lg btn-block">
                    <h4 class="text-center">Homepage</h4>
                </button>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img class="img-rounded img-responsive" src="assets/customer.png" alt="customer">
                </div>
                <div class="col-md-9 row">
                    <div class="visible-lg">
                        <div style="margin-top:10px"></div>
                    </div>
                    <strong>Email</strong> user@phptravels.com<br>
                    <strong>Password</strong> demouser
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="block">
        <div class="panel-body">
            <form action="<?php echo addhttp($_POST['site_url']); ?>/admin" target="_blank" method="post">
                <button class="btn btn-default btn-lg btn-block">
                    <h4 class="text-center">Administrator</h4>
                </button>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img class="img-rounded img-responsive" src="assets/admin.png" alt="admin">
                </div>
                <div class="col-md-9 row">
                    <div class="visible-lg">
                        <div style="margin-top:10px"></div>
                    </div>
                    <strong>Email</strong> <?php echo $_POST['adminemail']; ?><br>
                    <strong>Password</strong> <?php echo $_POST['adminpass']; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="block">
        <div class="panel-body">
            <form action="<?php echo addhttp($_POST['site_url']); ?>/supplier" target="_blank" method="post">
                <button class="btn btn-default btn-lg btn-block">
                    <h4 class="text-center">Supplier</h4>
                </button>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <img class="img-rounded img-responsive" src="assets/supplier.png" alt="admin">
                </div>
                <div class="col-md-9 row">
                    <div class="visible-lg">
                        <div style="margin-top:10px"></div>
                    </div>
                    <strong>Email</strong> supplier@phptravels.com<br>
                    <strong>Password</strong> demosupplier
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<hr>
<div class="clearfix"></div>
<p class="bold">XML Sitemap For better SEO</p>
<p><a target="_blank" class="target"
      href="<?php echo addhttp($_POST['site_url']); ?>/sitemap.xml"><?php echo addhttp($_POST['site_url']); ?>
        /sitemap.xml</a></p>
<p>------------------------------------------</p>
<p>to get more details about how to get started and setup the website please <a target="_blank" class="target"
                                                                                href="//phptravels.info"><strong>Click
            Here</strong> </a></p>
<p>Looking forward to hearing from you.</p>
<hr>
<p><span class="bold">Regards</span><br>
    PHPTRAVELS Team
</p>
</div>
</div>
</div>
</body>
</html>
<br><br><br>
<!-- fade starts -->
<script>
    var speed = 'slow';
    $('html, body').hide();
    $(document).ready(function () {
        $('html, body').fadeIn(speed, function () {
            $('a[href], button[href]').click(function (event) {
                if (!$(this).hasClass('target')) {
                    var url = $(this).attr('href');
                    if (url.indexOf('#') == 0 || url.indexOf('javascript:') == 0) return;
                    event.preventDefault();
                    $('html, body').fadeOut(speed, function () {
                        window.location = url;
                    });
                }
            });
        });
    });
</script>
<!-- fade ends -->