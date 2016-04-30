<?php if($myweather_staus[0]->status == '1'){ ?>
<div class="panel panel-primary weather"  style="max-height:230px !important">
  <div class="panel-body">
    <link rel="stylesheet" type="text/css" href="assets/include/weather/css/default.css" />
    <link rel="stylesheet" type="text/css" href="assets/include/weather/css/climacons.css" />
    <link rel="stylesheet" type="text/css" href="assets/include/weather/css/component2.css" />
    <script src="assets/include/weather/js/modernizr.custom.js"></script>
    <div class="container" style="max-width: 200px">
      <ul id="rb-grid" class="rb-grid clearfix">
        <?php if(!empty($myweather->city)){ ?><li class="icon-clima-<?php echo pt_weather_icons($myweather->list[0]->weather[0]->description);?>">
          <h3><?php echo $myweather->city->name;?></h3>
          <span class="rb-temp"><?php echo ceil($myweather->list[0]->temp->max);?>&deg;C</span>
          <div class="rb-overlay">
            <span class="rb-close">close</span>
            <div class="rb-week">
              <div><span class="rb-city"><?php echo $myweather->city->name;?></span><span class="icon-clima-<?php echo pt_weather_icons($myweather->list[0]->weather[0]->description);?>"></span><span><?php echo ceil($myweather->list[0]->temp->max);?>&deg;C</span></div>
              <?php foreach($myweather->list as $w){ ?> <div><span><?php echo date("D",$w->dt);?><h5><?php echo pt_show_date_php($w->dt);?></h5></span><span class="icon-clima-<?php echo pt_weather_icons($w->weather[0]->description);?>"></span><span><?php echo ceil($w->temp->max);?>&deg;C </span></div> <?php } ?>
            </div>
          </div>
        </li>
      </ul>     <br>
      <script> $(function() { Boxgrid.init(); }); </script>
      <script src="assets/include/weather/js/jquery.fittext.js"></script>
      <script src="assets/include/weather/js/boxgrid.example2.js"></script>
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>

