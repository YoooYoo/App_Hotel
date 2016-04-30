<style>
  body {
  background-color : #fff
  }
  .overlay {
  background:transparent;
  position:relative;
  width:100%;
  height:480px; /* your iframe height */
  top:400px;  /* your iframe height */
  margin-top:-500px;  /* your iframe height */
  z-index:9999;
  }
  aside.sidebar-right {
  padding-left: 30px;
  border-left: 1px solid #d4d4d4;
  }
  .list {
  list-style: none;
  margin: 0;
  padding: 0;
  }
  .list a {
  color: #ed8323;
  text-decoration: none;
  }
  .address-list > li > h5 {
  margin-bottom: 3px;
  }
  h5 {
  font-size: 18.2px;
  font-weight: 300;
  }
</style>
<div style="margin-top:-20px">
  <div class="overlay" onClick="style.pointerEvents='none'"></div>
<address>
<?php if(!empty($res2[0]->contact_address)){ echo $res2[0]->contact_address; } ?>    
</address>

</div>
<br><br>
<div class="container">
  <?php if(isset($successmsg)){ ?>
  <div class="alert alert-success">
    <i class="fa fa-check-square-o"></i>
    <?php echo @$successmsg; ?>
  </div>
  <?php } if(!empty($validationerrors)){ ?>
  <div class="alert alert-danger">
    <i class="fa fa-times-circle"></i>
    <?php echo $validationerrors; ?>
  </div>
  <?php } ?>
</div>
<div class="container">
  <div class="col-md-7">
    <p class="go-right"><?php echo trans('0260');?></p><div class="clearfix"></div>
    <form action="" class="row" method="POST">
      <fieldset>
        <div class="col-md-6 go-right">
          <label class="go-right" for="name"><?php echo trans('0350');?></label><input class="form-control form" type="text" name="contact_name" value="" required />
        </div>
        <div class="col-md-6 go-left">
          <label class="go-right" for="email"><?php echo trans('094');?></label><input class="form-control form" type="email" name="contact_email" value="" required /><br>
        </div>
        <div class="col-md-12 go-right">
          <label class="go-right" for="subject"><?php echo trans('0261');?></label><input class="form-control form" type="text" name="contact_subject" value="" required /><br>
        </div>
        <div class="col-md-12 go-left">
          <label class="go-right" for="message"><?php echo trans('0262');?></label><textarea class="form-control form" name="contact_message" rows="5" cols="25" required></textarea><br>
        </div>
        <div class="col-md-12 go-right">
          <input class="btn btn-primary go-right" type="submit" name="submit_contact" value="<?php echo trans('0263');?>">
        </div>
        <br>
        <!-- END CONTACT FORM -->
      </fieldset>
    </form>
  </div>
  <div class="col-md-5">
    <aside class="sidebar-right">
      <ul class="address-list list">
        <?php if(!empty($res2[0]->contact_email)){ ?>
        <li>
          <h5><?php echo trans('094');?></h5>
          <a href="mailto:<?php echo $res2[0]->contact_email;?>"><?php echo $res2[0]->contact_email;?></a>
        </li>
        <?php } ?>
        <?php if(!empty($res2[0]->contact_phone)){ ?>
        <li>
          <h5><?php echo trans('0256');?></h5>
          <a href="//tel:<?php echo $res2[0]->contact_phone;?>"> <?php echo $res2[0]->contact_phone;?></a>
        </li>
        <?php } ?>
        <li>
          <h5><?php echo trans('0255');?></h5>
          <p><?php if(!empty($res2[0]->contact_address)){ echo $res2[0]->contact_address; } ?></p>
        </li>
      </ul>
    </aside>
  </div>
</div>


<script>
  $(document).ready(function(){
  $("address").each(function(){
  var embed ="<iframe width='100%' height='315' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='//maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&amp;output=embed'></iframe>";
  $(this).html(embed);
  }); });
</script>