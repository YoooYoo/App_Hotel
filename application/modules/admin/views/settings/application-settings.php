

<script>
  $(function(){
    themeinfo();
    offstatus();
  // mailserver options
  var mailserver = $("#mailserver").val();
  if(mailserver == "php"){
  $(".smtp").hide();
   }else{
  $(".smtp").show();
  }
  // mailserver options
  $("#mailserver").on('change', function() {
  var mserver = $(this).val();
  if(mserver == "php"){
  $(".smtp").hide();
  }else{
  $(".smtp").show();
  }

  });

    // offline status option
  $(".offstatus").on('change', function() {
    offstatus();

  });


  $("#hlogo").change(function(){



  var preview = $('.hlogo_preview_img');
  preview.fadeOut();

  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("hlogo").files[0]);

  oFReader.onload = function (oFREvent) {
  preview.attr('src', oFREvent.target.result).fadeIn();
  };

  });

  $("#favimage").change(function(){
  var abc = $(this).attr('name');


  var preview = $('.favimage_preview_img');
  preview.fadeOut();

  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("favimage").files[0]);

  oFReader.onload = function (oFREvent) {
  preview.attr('src', oFREvent.target.result).fadeIn();
  };

  });

  $(".testEmail").on('click',function(){
    var id = $(".testemailtxt").val();
    $.post("<?php echo base_url();?>admin/ajaxcalls/testingEmail", {email: id}, function(resp){
    alert(resp);
    console.log(resp);
    });
  })

  });

  function themeinfo(){
  var id = $(".theme").val();

  $.post("<?php echo base_url();?>admin/ajaxcalls/ThemeInfo", {theme: id}, function(resp){
  var obj = jQuery.parseJSON(resp);

  $("#themename").html(obj.Name);
  $("#themedesc").html(obj.Description);
  $("#themeauthor").html(obj.Author);
  $("#themeversion").html(obj.Version);
  $("#screenshot").prop("src",obj.screenshot);

  });
}


function offstatus(){
  var status = $(".offstatus").val();
  if(status == "1"){
    $("#offmsg").prop("readonly",false);
  }else{
    $("#offmsg").prop("readonly",true);
  }

}

</script>

<div class="col-sm-12">
 <?php if(!empty($errormsg)){  echo $errormsg; } ?>
  </div>


<h3 class="margin-top-0"> Application Settings</h3>


<form action="" method="POST" enctype="multipart/form-data">
<div class="panel panel-default">

<ul  class="nav nav-tabs nav-justified" role="tablist">
<li class="active"><a href="#GENERAL" data-toggle="tab">General</a></li>
<li class=""><a href="#DATE" data-toggle="tab">Date</a></li>
<li class=""><a href="#EMAIL" data-toggle="tab">Email</a></li>
<li class=""><a href="#THEMES" data-toggle="tab">Themes</a></li>
<li class=""><a href="#CONTACT" data-toggle="tab">Contact</a></li>
<li class=""><a href="#SERVER" data-toggle="tab">Server</a></li>
</ul>

<div class="panel-body">


<br>
<div class="tab-content form-horizontal">
<div class="tab-pane wow fadeIn animated active in" id="GENERAL">

<div class="well well-sm">
<div class="row form-group">
<label  class="col-md-2 control-label text-left">Business Logo</label>
<div class="col-md-4">
<div class="input-group input-xs">
<input type="file" class="btn btn-default" id="hlogo" name="hlogo">
<span class="help-block">Only PNG file supported</span>
</div>
</div>
<div class="col-md-4">
<img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.'logo.png';?>"  class="hlogo_preview_img img-responsive" />
</div>
</div>
</div>

<div class="well well-sm">
<div class="row form-group">
<label  class="col-md-2 control-label text-left">Favicon</label>

<div class="col-md-4">
<div class="input-group input-xs">
<input type="file" class="btn btn-default" id="favimage" name="favimg">
<span class="help-block">Only PNG file supported</span>
</div>
</div>
<div class="col-md-1">
 <img src="<?php echo PT_GLOBAL_IMAGES_FOLDER;?>favicon.png" width="60" height="60" alt="" class="img-responsive favimage_preview_img" />

</div>
</div>
</div>



<div class="row form-group">
<label  class="col-md-2 control-label text-left">Business Name</label>
<div class="col-md-4">
<input name="site_title" type="text"  placeholder="Business Name" class="form-control" value="<?php echo $settings[0]->site_title;?>" />
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Slogan</label>
<div class="col-md-4">
<input name="slogan" type="text" placeholder="Slogan" class="form-control" value="<?php echo $settings[0]->home_title;?>" />
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Site URL</label>
<div class="col-md-4">
<input class="form-control" type="text" placeholder="Website url here" name="site_url" value="<?php echo $settings[0]->site_url;?>">
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">License Key</label>
<div class="col-md-4">
<input class="form-control" type="text" placeholder="License Key" name="license" value="<?php echo $settings[0]->license_key;?>">
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Copyrights</label>
<div class="col-md-4">
<input name="copyright" type="text" placeholder="copyrights" class="form-control" value="<?php echo $settings[0]->copyright; ?>"/>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Multi Language</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control" name="multi_lang">
<option value="1" <?php if ($settings[0]->multi_lang == '1') {echo 'selected';}?> >Enabled</option>
<option value="0" <?php if ($settings[0]->multi_lang == '0') {echo 'selected';}?> >Disabled</option>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Default Language</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control" name="default_lang">
<?php
$language_list = pt_get_languages(); 
foreach ($language_list as $langid => $langname) {
?>
<option value="<?php echo $langid;?>" <?php if ($settings[0]->default_lang == $langid) {echo 'selected';}?> ><?php echo $langname['name'];?></option>
<?php
}
?>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Users Registration</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control" name="allow_registration">
<option value="1" <?php if ($settings[0]->allow_registration == "1") {echo "selected";}?> >Yes</option>
<option value="0" <?php if ($settings[0]->allow_registration == "0") {echo "selected";}?> >No</option>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Suppliers Registration</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control" name="allow_supplier_registration">
<option value="1" <?php if ($settings[0]->allow_supplier_registration == "1") {echo "selected";}?> >Yes</option>
<option value="0" <?php if ($settings[0]->allow_supplier_registration == "0") {echo "selected";}?> >No</option>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Reviews</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control" name="reviews">
<option value="Yes" <?php if ($settings[0]->reviews == "Yes") {echo "selected";}?> >Auto Approve</option>
<option value="No" <?php if ($settings[0]->reviews == "No") {echo "selected";}?> >Admin Approve</option>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Offline</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control offstatus" name="site_offine">
<option value="1" <?php if ($settings[0]->site_offline == '1') {echo 'selected';}?> >Yes</option>
<option value="0" <?php if ($settings[0]->site_offline == '0') {echo 'selected';}?> >No</option>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Offline Message</label>
<div class="col-md-8">
<textarea name="offlinemsg" id="offmsg" placeholder="Our website is currently offline for maintenance. Please visit us later." class="form-control" cols="" rows="2"><?php echo $settings[0]->offline_message; ?></textarea>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Default Keywords</label>
<div class="col-md-8">
<input class="form-control" type="text" placeholder="Keyword of homepage" name="keywords" value="<?php echo $settings[0]->keywords;?>" ></div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Default Description</label>
<div class="col-md-8">
<textarea class="form-control" rows="2" placeholder="Description of homepage" name="meta_description" ><?php echo $settings[0]->meta_description;?></textarea>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Force SSL</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control" name="ssl_url">
<option value="1" <?php if ($settings[0]->ssl_url == '1') {echo 'selected';}?> >Enabled</option>
<option value="0" <?php if ($settings[0]->ssl_url == '0') {echo 'selected';}?> >Disabled</option>
</select>
</div>
</div>


<div class="row form-group">
<label  class="col-md-2 control-label text-left">RSS Enabled</label>
<div class="col-md-2">
<select name="rss" class="form-control">
<option value="1" <?php if ($settings[0]->rss == '1') {echo 'selected';}?>>Enabled</option>
<option value="0" <?php if ($settings[0]->rss == '0') {echo 'selected';}?>>Disabled</option>
</select>
</div>
</div>

</div>
<div class="tab-pane wow fadeIn animated in" id="DATE">

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Date Formate</label>
<div class="col-md-2">
<select data-placeholder="Select" class="form-control" name="pt_date_format">
<option value="d/m/Y" <?php if ($settings[0]->date_f == "d/m/Y") {echo "selected";}?> >dd/mm/yyyy</option>
<option value="m/d/Y" <?php if ($settings[0]->date_f == "m/d/Y") {echo "selected";}?> >mm/dd/yyyy</option>
</select>
</div>
</div>


</div>

<div class="tab-pane wow fadeIn animated in" id="EMAIL">

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Mailer</label>
<div class="col-md-2">
<select name="defmailer" class="form-control" id="mailserver">
<option value="php" <?php if( $mailserver[0]->mail_default == "php"){ echo "selected"; } ?> >PHP Mailer</option>
<option value="smtp" <?php if( $mailserver[0]->mail_default == "smtp"){ echo "selected"; } ?>   >SMTP</option>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Email</label>
<div class="col-md-4">
<input type="email" name="emailfrom" placeholder="Email" class="form-control" value="<?php echo $mailserver[0]->mail_fromemail;?>" />
</div>
</div>


<hr>
<div class="smtp">
<div class="row form-group">
<label  class="col-md-2 control-label text-left">SMTP Secure</label>
<div class="col-md-2">
<select name="smtpsecure" class="form-control">
<option value="ssl" <?php if( $mailserver[0]->mail_secure == "ssl"){ echo "selected"; } ?>>SSL</option>
<option value="tls" <?php if($mailserver[0]->mail_secure == "tls"){ echo "selected"; } ?> >TLS</option>
<option value="no" <?php if($mailserver[0]->mail_secure == "no"){ echo "selected"; } ?> >No</option>
</select>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">SMTP Host</label>
<div class="col-md-4">
<input type="text" name="smtphost" placeholder="Host" class="form-control" value="<?php echo $mailserver[0]->mail_hostname;?>" />
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">SMTP Port</label>
<div class="col-md-2">
<input type="text" name="smtpport" placeholder="Port" value="<?php echo $mailserver[0]->mail_port;?>" class="form-control"/>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">SMTP Username</label>
<div class="col-md-4">
<input type="text" name="smtpuser" placeholder="Username" value="<?php echo $mailserver[0]->mail_username;?>" class="form-control"/>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">SMTP Password</label>
<div class="col-md-4">
<input type="text" name="smtppass" placeholder="password" value="<?php echo $mailserver[0]->mail_password;?>" class="form-control"/>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left">Test Email Reciever </label>
<div class="col-md-4">
<input type="text" name="" placeholder="Email" value="" class="form-control testemailtxt"/>
</div>
</div>

</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left "><br></label>
<div class="col-md-4">
<span class="btn btn-sm btn-primary testEmail">Test Email</span>
</div>
</div>

<hr>

<div class="row form-group">
<label  class="col-md-2 control-label text-left ">Global Email Header</label>
<div class="col-md-10">
<textarea name="mailheader" class="form-control" rows="4" cols="100"><?php echo $mailserver[0]->mail_header;?></textarea>
</div>
</div>

<div class="row form-group">
<label  class="col-md-2 control-label text-left ">Global Email Footer</label>
<div class="col-md-10">
<textarea name="mailfooter" class="form-control" rows="4" cols="100"><?php echo $mailserver[0]->mail_footer;?></textarea>
</div>
</div>
  

</div>



<div class="tab-pane wow fadeIn animated in" id="THEMES">
  <div class="row form-group">
<label  class="col-md-1 control-label text-left">Theme</label>

<div class="col-md-2">
<select name="theme" class="form-control theme">
<?php foreach($themes as $theme => $v )
       {     @$themeinfo = pt_getThemeInfo( "themes/$theme/style.css" );
?>
<option value="<?php echo $theme;?>" <?php if($settings[0]->default_theme == $theme){ echo "selected"; } ?> ><?php echo $themeinfo['Name']; ?></option>
<?php  } ?>
</select>
</div>

<div class="col-md-2">
<img id="screenshot" src="" class="img-responsive" alt="" />
</div>

<div class="col-md-6">
<p><strong>Theme Name :</strong> <span id="themename"></span></p>
<p><strong>Description :</strong> <span id="themedesc"></span></p>
<p><strong>Author :</strong> <span id="themeauthor"></span></p>
<p><strong>Version :</strong> <span id="themeversion"></span></p>
</div>

</div>
</div>

<div class="tab-pane wow fadeIn animated in" id="CONTACT">
  <div class="panel-body">




          <div class="row form-group">
<label class="col-md-2 control-label text-left">Phone Number</label>
<div class="col-md-4">
              <input class="form-control input-sm" type="text" placeholder="Phone Number" name="contact_phone" value="<?php echo $contact_data[0]->contact_phone;?>">
</div>
</div>

 <div class="row form-group">
<label class="col-md-2 control-label text-left">Email</label>
<div class="col-md-4">
              <input class="form-control input-sm" type="text" placeholder="Email address" name="contact_email" value="<?php echo $contact_data[0]->contact_email;?>">
</div>
</div>

<div class="row form-group">
<label class="col-md-2 control-label text-left">Address</label>
<div class="col-md-6">
<textarea cols="20" rows="5" type="text" class="form-control" placeholder="Office Address" name="contact_address"  /><?php echo $contact_data[0]->contact_address;?></textarea></div>
</div>

<input type="hidden" name="contact_page_id" value="<?php echo $contact_data[0]->contact_id;?>">

</div>
</div>

<div class="tab-pane wow fadeIn animated in" id="SERVER">

<div class="list-group">

      <a href="" class="list-group-item"><strong> Server OS </strong> <span  class="pull-right"><?php echo info_general('os');?></span></a>

      <a href="" class="list-group-item"><strong> Browser </strong> <span  class="pull-right"><?php echo $browserlib->getBrowser()." ".$browserlib->getVersion() ?> </span></a>

      <a data-toggle="modal" href="#phpinfo" class="list-group-item"><strong> PHP Version </strong> <span  class="pull-right"><?php echo phpversion(); echo phpversion('tidy'); ?></span></a>

      <a href="" class="list-group-item"><strong> MySQL Version </strong> <span  class="pull-right"><?php echo info_general('mysqlversion');?></span></a>

      <a href="" class="list-group-item"><strong> MySQLi </strong> <span  class="pull-right"> <?php $mysqli = info_general('mysqli'); if($mysqli){ ?><i class='btn btn-success btn-xs glyphicon glyphicon-ok'></i><?php }else{?><i class='btn btn-danger btn-xs glyphicon glyphicon-remove'></i> <?php } ?> </span></a>

      <a href="" class="list-group-item"><strong> Mod_Rewrite </strong> <span  class="pull-right"> <?php $modrewrite = info_general('modrewrite'); if($modrewrite){ ?><i class='btn btn-success btn-xs glyphicon glyphicon-ok'></i><?php }else{?><i class='btn btn-danger btn-xs glyphicon glyphicon-remove'></i> <?php } ?> </span></a>

    </div>

</div>
</div>
</div>
<div class="panel-footer">
<input type="hidden" name="globalsettings" value="1"/>
<button class="btn btn-primary">Submit</button>
</div>
</div>
</form>
