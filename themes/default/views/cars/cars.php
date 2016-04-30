<script type="text/javascript">
 $(function(){ $(".sorting li a").click(function(){ var sortby = $(this).prop("id");
 $(".sortby").val(sortby); }); });
</script>

  <?php $checkin = @$_GET['checkin']; $checkout = @$_GET['checkout']; ?>

<div class="container">
 <div class="col-md-12 hidden-sm hidden-xs">

    <img class="img-responsive img-border" src="<?php echo $theme_url; ?>assets/images/cars.jpg" alt="hotels"/>


    <nav class="navbar navbar-default listing-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand  hidden-xs hidden-sm"><?php echo trans('0189');?> <?php echo trans('012');?></a>
        </div>

        <div class="collapse navbar-collapse">

          <form class="navbar-form navbar-left col-md-2" action="<?php echo base_url();?>cars/search" method="GET" role="search">
            <div class="form-group">
            <input name="searching" style="width:300px" type="text" class="form-control searchingcar" placeholder="<?php echo trans('0209');?>" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>">
            <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
            <input type="text" placeholder="<?php echo trans('0210');?>" style="width:120px" id="dpd3" name="checkin" class="form-control" value="<?php echo $checkin; ?>" ><i class="iconbox fa fa-calendar"></i>
            <input type="text" class="form-control" style="width:120px" id="dpd4" placeholder="<?php echo trans('0211');?>" name="checkout" value="<?php echo $checkout; ?>"><i class="iconbox fa fa-calendar"></i>
            </div>

            <button type="submit" class="btn btn-default"><?php echo trans('0190');?></button>
          </form>

          <ul class="nav navbar-nav navbar-right  hidden-xs hidden-sm">

            <li class="sorting dropdown">
              <a href="javascript: void();"  class="dropdown-toggle" data-toggle="dropdown"><?php echo trans('0196');?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url();?>cars/listings?sortby=p_lh" id="p_lh"><?php echo trans('070');?> ( <?php echo trans('0192');?> )</a></li>
                <li><a href="<?php echo base_url();?>cars/listings?sortby=p_hl" id="p_hl"><?php echo trans('070');?> ( <?php echo trans('0193');?> )</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url();?>cars/listings?sortby=s_lh" id="s_lh"><?php echo trans('0137');?> ( <?php echo trans('0192');?> )</a></li>
                <li><a href="<?php echo base_url();?>cars/listings?sortby=s_hl" id="s_hl"><?php echo trans('0137');?> ( <?php echo trans('0193');?> )</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 </div>
 <br><br>

 <div class="<?php echo leftpanel;?> hidden-xs hidden-sm">
  <div class="whitewell">
  <nav class="navbar navbarz" role="navigation" style="margin-bottom: 0px !important;border-radius: 2px 2px 0px 0px">
      <div class="container-fluid bg-blue">
        <div class="navbar-header">
          <a class="navbar-brand cw"><i class="fa fa-search"></i> <?php echo trans('0191');?> <?php echo trans('012');?></a>
        </div>
      </div>
    </nav>


      <form action="<?php echo base_url();?>cars/search" method="GET">

        <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#findwhat">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('06');?></span><span class="collapsearrow"></span>
        </button>

         <div id="findwhat" class="in panel-body">
          <input name="searching" type="text" class="form-control searchingcar" placeholder="<?php echo trans('0209');?>">
         </div>

         <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#when">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('067');?></span><span class="collapsearrow"></span>
        </button>

         <div id="when" class="in" style="margin-top:15px">

          <div class='col-xs-6 form-group cvc required'>
            <input type="text" id="dpd1" class="form-control input-sm checkinsearch" placeholder="<?php echo trans('0210');?>" value="<?php echo $checkin;?>" name="checkin">
          </div>
          <div class='col-xs-6 form-group expiration required'>
            <input type="text" id="dpd2" class="form-control input-sm" placeholder="<?php echo trans('0211');?>" value="<?php echo $checkout;?>" name="checkout">
          </div>
        </div>




        <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#grade">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('069');?></span><span class="collapsearrow"></span>
        </button>

         <div id="grade" class="in panel-body">
         <div class=".col-xs-6 .col-sm-6">
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "1"   <?php if(@$_GET['stars'] == "1"){echo "checked";}?> /> <i class="fa fa-star"></i>
        </div>
        <div class=".col-xs-6 .col-sm-6">
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "2"   <?php if(@$_GET['stars'] == "2"){echo "checked";}?> /> <i class="fa fa-star"></i><i class="fa fa-star"></i>
        </div>
        <div class=".col-xs-6 .col-sm-6">
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "3"   <?php if(@$_GET['stars'] == "3"){echo "checked";}?>/> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        </div>
        <div class=".col-xs-6 .col-sm-6">
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "4"   <?php if(@$_GET['stars'] == "4"){echo "checked";}?> /> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        </div>
        <div class=".col-xs-6 .col-sm-6">
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "5"    <?php if(@$_GET['stars'] == "5"){echo "checked";}?> /> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        </div>
        <div class=".col-xs-6 .col-sm-6">
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "7"    <?php if(@$_GET['stars'] == "7"){echo "checked";}?> /> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        </div>
        </div>

         <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#price">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0216');?></span><span class="collapsearrow"></span>
        </button>

         <div id="price" class="in panel-body">


        <div class="well well-sm" style="padding: 20px">
          <?php echo trans('0217');?> : <b><?php echo @$minprice;?> to <?php echo @$maxprice;?> </b>
          <?php if(!empty($_GET['price'])){
            $selectedprice = $_GET['price'];
            }else{
             $selectedprice =  $minprice.",".$maxprice;
                 }?>
          <input type="text" class="col-xs-12 col-sm-8 col-md-7 col-lg-11" value="" data-slider-min="<?php echo @$minprice;?>" data-slider-max="<?php echo @$maxprice;?> " data-slider-step="10" data-slider-value="[<?php echo $selectedprice;?>]" id="sl2" name="price">
        </div>
        <script>
          $(function(){
          $('#sl1').slider({
          formater: function(value) {
          return 'Current value: '+value;
          }
          });
          $('#sl2').slider();
          });
        </script>
        <script src="assets/js/bootstrap-slider.js"></script>

        </div>

         <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#type">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0214');?></span><span class="collapsearrow"></span>
        </button>

         <div id="type" class="in panel-body">

        <?php $ctypes = pt_get_csettings_data("ctypes");
          if(!empty($ctypes)){ ?>

        <?php @$vartype = $_GET['type'];
          if(empty($vartype)){
          $vartype = array();
          }
          foreach($ctypes as $ctype){
          ?>

        <div class=".col-xs-6 .col-sm-6">

          <label><input class="pull-left" type="checkbox" name="type[]" value="<?php echo $ctype->sett_id;?>" <?php if(in_array($ctype->sett_id,$vartype)){echo "checked";}?> />&nbsp; <?php echo $ctype->sett_name;?></label>
        </div>
        <?php }} ?>
         </div>

         <div class="line3"></div>


        <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#passengers">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0212');?></span><span class="collapsearrow"></span>
        </button>

         <div id="passengers" class="in collapse panel-body">
         <?php @$varpass = $_GET['passengers'];  ?>
         <p><input type="radio" value="4" name="passengers" <?php if($varpass == "4"){ echo "checked";}?>/> 4 <i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i></p>
         <p><input type="radio" value="5" name="passengers" <?php if($varpass == "5"){ echo "checked";}?>/> 5 <i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i></p>
         <p><input type="radio" value="6" name="passengers" <?php if($varpass == "6"){ echo "checked";}?>/> 6+ <i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i></p>

         </div>

        <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#doors">
        <span class="pull-left"><i class="glyphicon glyphicon-chevron-right"></i> <?php echo trans('0213');?></span><span class="collapsearrow"></span>
        </button>

         <div id="doors" class="in collapse panel-body">
         <?php @$vardoors = $_GET['doors'];  ?>
         <p><input type="checkbox" value="2" name="doors[]" <?php if(in_array('2',$vardoors)){ echo "checked";}?> /> 2 <i class="fa fa-fax"></i> <i class="fa fa-fax"></i></p>
         <p><input type="checkbox" value="3" name="doors[]" <?php if(in_array('3',$vardoors)){ echo "checked";}?> /> 3 <i class="fa fa-fax"></i> <i class="fa fa-fax"></i> <i class="fa fa-fax"></i></p>
         <p><input type="checkbox" value="4" name="doors[]" <?php if(in_array('4',$vardoors)){ echo "checked";}?> /> 4 <i class="fa fa-fax"></i> <i class="fa fa-fax"></i> <i class="fa fa-fax"></i> <i class="fa fa-fax"></i></p>
         <p><input type="checkbox" value="5"  name="doors[]" <?php if(in_array('5',$vardoors)){ echo "checked";}?> /> 5 <i class="fa fa-fax"></i> <i class="fa fa-fax"></i> <i class="fa fa-fax"></i> <i class="fa fa-fax"></i> <i class="fa fa-fax"></i></p>

         </div>



        <div class="panel-body">
          <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
          <button type="submit" class="btn btn-success btn-lg btn-block wow flipInX" ><span class="glyphicon glyphicon-search"></span> <?php echo trans('012');?></button>
        </div>
      </form>
      </div>
 </div>

   <div class="visible-xs visible-sm"><br><br></div>

  <div class="<?php echo rightpanel; ?>">


   <?php
        if(!empty($allcars['all'])){
        foreach($allcars['all'] as $car){
        $carslib->set_id($car->car_id,$app_settings[0]->currency_sign,$app_settings[0]->currency_code);
        $carslib->car_short_details();
        if($carslib->isavailable){

        ?>
  <div class="panel panel-default">


           <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4  offset-0">

                    <?php $cimg = pt_default_car_image($car->car_id); if(empty($cimg)){ ?>
                    <a href="<?php echo base_url();?>cars/<?php echo $car->car_slug;?>"> <img src="<?php echo PT_BLANK; ?>" class="<?php echo imgthumb;?>" alt="<?php echo $car->car_slug;?>" /> </a>
                    <?php }else{ ?>
                    <a href="<?php echo base_url();?>cars/<?php echo $car->car_slug;?>"> <img src="<?php echo PT_CARS_SLIDER_THUMB.$cimg; ?>" class="<?php echo imgthumb;?>" alt="<?php echo $car->car_slug;?>" /> </a>
                    <?php } ?>

            </div>

            <div class="col-xs-8 col-sm-5 col-md-5 col-lg-5 mt0 mb0">

            <p class="panel-heading h5 mt0 pdrt0 mb0 bold"><a href="<?php echo base_url();?>cars/<?php echo $car->car_slug;?>"><?php echo character_limiter($carslib->title,18); ?></a>

            <span class="pull-right">
            <?php if($carslib->isfeatured == "1"){ ?> <button title="<?php echo trans("0341");?>" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-xs hidden-xs"><i class="fa fa-bell"></i> </button><?php  } ?>
            <?php if($carslib->isspecial){ ?> <?php echo PT_OFFER; ?> <?php } ?>
            <?php if($car->car_airport_pickup == "yes"){ ?><button data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs hidden-xs" data-original-title="<?php echo trans('0207');?>"><i class="fa fa-plane"></i></button><?php } ?>

            </span>
             <br> <span class="fs12"><i class="fa fa-map-marker"></i> <?php echo $carslib->city.", ".character_limiter($carslib->country,7); ?></span><br>

             <span class="star fs12"><?php pt_create_stars($car->car_stars); ?> </span> <i class="fa fa-car"></i> <?php echo $carslib->cartype;?>

             </p>
                <table class="table mb0 hidden-xs">
                  <tbody>

                    <tr>
                     <td>

                <i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0198');?>" class="fa fa-child"></i> <?php echo $car->car_passengers;?>
                <i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0199');?>" class="fa fa-briefcase"></i> <?php echo $car->car_baggage;?>
                <i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0200');?>" class="fa fa-fax"></i> <?php echo $car->car_doors;?>
                <i data-toggle="tooltip" data-placement="top" data-original-title="<?php echo trans('0201');?>" class="fa fa-joomla"></i> <?php echo $car->car_transmission;?>

                     </td>

                     <td>
                     </td>
                    </tr>
                  </tbody>
                </table>

                          <span class="hidden-xs hidden-sm hidden-md small"><?php echo character_limiter($carslib->desc, 70);?></span>

            </div>

          <div class="col-sm-3 col-md-3 col-lg-3 offset-0 hidden-xs">

          <div style="margin-top:25px"></div>.
          <div class="bordertype4">

            <?php
              $advprice = pt_car_advanced_price($car->car_id);
               $mulcur = pt_default_currencies();
              $basicprice = $car->car_basic_price;
               $discountprice = $car->car_basic_discount;
              if(!empty($advprice)){
              $basicprice = $advprice['basic'];
              $discountprice = $advprice['discount'];
              }

              if($discountprice > 0){
              if(empty($mulcur)){
              ?>


                      <p class="text-center text-warning fs20"><small><?php echo $app_settings[0]->currency_code;?> </small> <?php echo $app_settings[0]->currency_sign.$discountprice;?> / <del> <?php echo  $app_settings[0]->currency_sign.$basicprice;?> </del></p>
                      <?php }else{ ?>
                      <p class="text-center text-warning fs20"> <?php echo $geo->pt_convert($discountprice);?> / <del> <?php echo $geo->pt_convert($basicprice);?></del></p>
                      <?php } }else{ if(empty($mulcur)){ ?>
                      <p class="text-center foffset text-warning fs20"> <?php echo $app_settings[0]->currency_code;?> <?php echo $app_settings[0]->currency_sign; ?><strong class="fs28"><?php echo $basicprice;?></strong></p>
                      <?php }else{ ?>
                      <p class="text-center text-warning fs20"><strong><?php echo $geo->pt_convert($basicprice);?>    </strong></p>
                      <?php } } ?>


           </div>
          </div>

           <div class="clearfix"></div>

        </div>

        <?php }else{} } }else{ echo trans("066"); } ?>


    <div class="pull-right">
   <?php echo @$plinks;?>
  </div>
 </div>

 <div class="<?php echo adspanel;?>">
    <?php echo run_widget(80); ?>
  </div>

</div>


