<script type="text/javascript">
<script type="text/javascript">
 $(function(){ $(".sorting li a").click(function(){ var sortby = $(this).prop("id");
 $(".sortby").val(sortby); }); });
</script>

<div class="container">
 <div class="col-md-12 hidden-sm hidden-xs">

   <img class="img-responsive img-border" src="<?php echo $theme_url; ?>assets/images/tours.jpg" alt="hotels"/>

   <nav class="navbar navbar-default listing-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand   hidden-xs hidden-sm"><?php echo trans('0189');?> <?php echo trans('012');?></a>
        </div>

        <div class="collapse navbar-collapse">

          <form class="navbar-form navbar-left col-md-2" action="<?php echo base_url();?>tours/search" method="GET" role="search">
            <div class="form-group">

<select class="form-control" name="ocity" id="">
<option value=""> <?php echo trans('0225');?></option>
<?php $ocities = pt_origin_cities(); $dcities = pt_dest_cities();
@$varocity = $_GET['ocity'];
foreach($ocities as $oc){
?>
<option value="<?php echo $oc->city_id;?>" <?php if($varocity == $oc->city_id){echo "selected";}?> > <?php echo $oc->city_name;?></option>
<?php } ?>
</select>

<select class="form-control" name="dcity" id="">
<option value=""> <?php echo trans('0219');?></option>
<?php
@$vardcity = $_GET['dcity'];
foreach($dcities as $dc){
?>
<option value="<?php echo $dc->city_id;?>" <?php if($vardcity == $dc->city_id){echo "selected";}?> > <?php echo $dc->city_name;?></option>
<?php } ?>
</select>

            <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">

              <input type="text" placeholder="<?php echo trans('0225');?>" style="width:120px" id="tchkin" name="start" class="form-control" value="<?php echo $checkin; ?>" required>
              <i class="iconbox fa fa-calendar"></i>

            </div>

            <button type="submit" class="btn btn-default"><?php echo trans('0190');?></button>
          </form>

          <ul class="nav navbar-nav navbar-right   hidden-xs hidden-sm">
            <li class="sorting dropdown">
              <a href="javascript: void();"  class="dropdown-toggle" data-toggle="dropdown"><?php echo trans('0196');?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>tours/listing?sortby=p_lh" id="p_lh"><?php echo trans('070');?> ( <?php echo trans('0192');?> )</a></li>
                <li><a href="<?php echo base_url(); ?>tours/listing?sortby=p_hl" id="p_hl"><?php echo trans('070');?> ( <?php echo trans('0193');?> )</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 </div>
 <br><br>
 <div class="<?php echo leftpanel;?> hidden-xs hidden-sm" >


 <nav class="navbar navbarz" role="navigation" style="margin-bottom: 0px !important;border-radius: 2px 2px 0px 0px">
      <div class="container-fluid bg-blue">
        <div class="navbar-header">
          <a class="navbar-brand cw"><i class="fa fa-search"></i> <?php echo trans('0191');?> <?php echo trans('012');?></a>
        </div>
      </div>
    </nav>

  <div class="col-xs-12 col=sm-12 col-md-12 col-lg-12 offset-0">
    <div class="whitewell">
      <form action="<?php echo base_url();?>tours/search" method="GET">


        <button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#start">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0218');?></span><span class="collapsearrow"></span>
        </button>

         <div id="start" class="in panel-body">

<select class="chosen-select" name="ocity" id="">
<option value=""> <?php echo trans('0158');?></option>
<?php @$varocity = $_GET['ocity'];
foreach($ocities as $oc){
?>
<option value="<?php echo $oc->city_id;?>" <?php if($varocity == $oc->city_id){echo "selected";}?> > <?php echo $oc->city_name;?></option>
<?php } ?>
</select>
</div>


        <button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#end">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0219');?></span><span class="collapsearrow"></span>
        </button>

         <div id="end" class="in panel-body">
<select class="chosen-select" name="dcity" id="">
<option value=""> <?php echo trans('0158');?></option>
<?php
@$vardcity = $_GET['dcity'];
$dcities = pt_dest_cities();
foreach($dcities as $dc){
?>
<option value="<?php echo $dc->city_id;?>" <?php if($vardcity == $dc->city_id){echo "selected";}?> > <?php echo $dc->city_name;?></option>
<?php } ?>
</select>
</div>

 <button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#package">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0220');?></span><span class="collapsearrow"></span>
        </button>

         <div id="package" class="in panel-body">

<select class="chosen-select" name="ptype">
<?php @$varptype = $_GET['ptype']; ?>
<option value=""> <?php echo trans('0158');?> </option>
<option value="group" <?php if($varptype == "group"){echo "selected";}?>> Group </option>
<option value="individual" <?php if($varptype == "individual"){echo "selected";}?> > Individual </option>
</select>
</div>

<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#category">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0221');?></span><span class="collapsearrow"></span>
        </button>

         <div id="category" class="in panel-body">
          <?php $tcats = pt_get_tsettings_data("tcategory");
if(!empty($tcats)){ ?>
<select class="chosen-select" name="category">

<option value=""> <?php echo trans('0158');?></option>
<?php @$varcat = $_GET['category'];

foreach($tcats as $tcat){
?>
<option value="<?php echo $tcat->sett_id;?>" <?php if($tcat->sett_id == $varcat){echo "selected";}?> ><?php echo $tcat->sett_name;?></option>
<?php } ?>
</select>
</div>

<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#type">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0222');?></span><span class="collapsearrow"></span>
        </button>
            <?php }
 $ttypes = pt_get_tsettings_data("ttypes");
if(!empty($ttypes)){ ?>
         <div id="type" class="in panel-body">

<select class="chosen-select" name="type" >
<option value=""> Select</option>
<?php @$vartype = $_GET['type'];
if(empty($vartype)){
$vartype = array();
}
foreach($ttypes as $ttype){
?>
<option value="<?php echo $ttype->sett_id;?>" <?php  if($ttype->sett_id == $vartype){ echo "selected";} ?> ><?php echo $ttype->sett_name;?></option>
<?php } ?>
</select>
</div>
<?php } ?>



<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#dates">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0223');?></span><span class="collapsearrow"></span>
        </button>

         <div id="dates" class="in" style="margin-top:15px">

          <div class='col-xs-6 form-group cvc required'>
            <input type="text" id="dpd1" class="form-control input-sm" placeholder="<?php echo trans('0273');?> <?php echo trans('08');?>" value="" name="start">
          </div>
          <div class='col-xs-6 form-group expiration required'>
            <input type="text" id="dpd2" class="form-control input-sm" placeholder="<?php echo trans('0274');?> <?php echo trans('08');?>" value="" name="end">
          </div>
        </div>



<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#price">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0216');?></span><span class="collapsearrow"></span>
        </button>

         <div id="price" class="in panel-body">

        <div class="well well-sm" style="padding: 20px">
          Filter : <b><?php echo @$minprice;?> to <?php echo @$maxprice;?> </b>
          <?php if(!empty($_GET['price'])){
            $selectedprice = $_GET['price'];
            }else{
             $selectedprice =  $minprice.",".$maxprice;
                 }?>
          <input type="text" class="col-xs-12 col-sm-8 col-md-7 col-lg-11" value="" data-slider-min="<?php echo @$minprice;?>" data-slider-max="<?php echo @$maxprice;?> " data-slider-step="10" data-slider-value="[<?php echo $selectedprice;?>]" id="sl2" name="price">
        </div>
        <script> $(function(){ $('#sl1').slider({ formater: function(value) { return 'Current value: '+value; } }); $('#sl2').slider(); }); </script>
        <script src="assets/js/bootstrap-slider.js"></script>
    </div>


    <button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#dates">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0224');?></span><span class="collapsearrow"></span>
        </button>

         <div id="dates" class="in" style="margin-top:15px">

          <div class='col-xs-6 form-group cvc required'>
          <input type="number" name="days" class="form-control  input-sm" placeholder="<?php echo trans('0275');?>" value="" />
          </div>
          <div class='col-xs-6 form-group expiration required'>
<input type="number" name="nights" class="form-control input-sm" placeholder="<?php echo trans('0276');?>" value="" />
          </div>
        </div>

           <br>
        <div class="line3"></div>
         <div class="panel-body">
          <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
        <button type="submit" class="btn btn-success btn-lg btn-block wow flipInX" ><span class="glyphicon glyphicon-search"></span> <?php echo trans('012');?></button>
        </div>
 </form>
    </div>
  </div>


    </div>


    <div class="visible-xs visible-sm"><br><br></div>

  <div class="<?php echo rightpanel;?>">


        <?php
        if(!empty($alltours['all'])){
       foreach($alltours['all'] as $tour){
       $ocity = pt_get_city_name($tour->tour_ocity);
       $dcity = pt_get_city_name($tour->tour_dcity);
       $tourslib->set_id($tour->tour_id, $app_settings[0]->currency_sign, $app_settings[0]->currency_code);
       $tourslib->tour_short_details();
        ?>
        <a href="<?php echo base_url();?>tours/<?php echo $tour->tour_slug;?>">
        <div class="panel panel-default fade-white">


           <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4  offset-0">
          <img class="img-responsive lazy fade-img" data-original="<?php echo $tourslib->thumbnail; ?>" src="<?php echo $tourslib->thumbnail; ?>" alt="<?php echo $tourslib->title;?>"/>
            </div>

            <div class="col-xs-8 col-sm-5 col-md-5 col-lg-5 mt0 mb0">
            <p class="panel-heading h4 mt0 pdrt0 mb0"><?php echo character_limiter($tourslib->title,15);?><br>
            <span class="star fs12"><?php pt_create_stars($tour->tour_stars); ?></span> <span class="fs12"><i class="fa fa-user"></i> 12</span>  <a class="maps fs12" href="<?php echo base_url();?>tours/tour_maps/<?php echo $tour->tour_id;?>" ><i class="fa fa-map-marker"></i> <?php echo trans('041');?></a>

            <span class="pull-right">
             <?php if($tourslib->isfeatured == "1"){ ?> <button title="<?php echo trans("0341");?>" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-xs hidden-xs"><i class="fa fa-bell"></i> </button><?php } ?>
             <?php if($tourslib->isspecial){ ?><?php echo PT_OFFER; ?> <?php } ?>
            </span>

             </p>

                <p class="hidden-xs"><?php echo character_limiter(strip_tags($tourslib->desc),80); ?></p>

            </div>

          <div class="col-sm-3 col-md-3 col-lg-3 offset-0 hidden-xs">

          <div class="bordertype4">

           <?php  if($tourslib->discountprice > 0){  ?>
          <p class="text-warning foffset text-center panel-body"><del class="fs20"><?php echo $tourslib->currencycode; ?> <?php echo $tourslib->currencysign.$tourslib->basicprice;?></del> <span class="fs24"><?php echo $tourslib->currencycode; ?> <?php echo $hotelslib->currencysign; ?></span><Strong class="fs28"><?php echo $hotelslib->discountprice;?> </strong></p>
          <?php  }else{  ?>
           <p class="text-warning foffset text-center"><span class="fs20"><?php echo $tourslib->currencycode; ?> <?php echo $tourslib->currencysign; ?></span><Strong class="fs28"><?php echo $tourslib->basicprice;?> </strong></p>
          <?php  } ?>

          <div class="nav bg-gray" style="padding: 5px">

        <li><i class="fa fa-info-circle"></i> <?php echo $tour->sett_name;?></li>
        <li><i class="fa fa-clock-o"></i> <?php echo trans('0334');?> <?php echo trans('0275');?> <?php echo $tour->tour_days;?></li>
        <li><i class="fa fa-level-up"></i> <?php echo trans('0218');?>  : <?php echo $ocity[0]->city_name;?></li>
        <li><i class="fa fa-level-down"></i> <?php echo trans('0219');?>  : <?php echo $dcity[0]->city_name;?></li>

          </div>
           </div>
          </div>

           <div class="clearfix"></div>

        </div>
          </a>
          <?php  } }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>

    <div class="col-lg-12">
    <span class=" pull-right"><?php echo @$plinks;?></span>
    </div>
  </div>

  <div class="<?php echo adspanel;?>">
    <?php echo run_widget(80); ?>
  </div>

</div>