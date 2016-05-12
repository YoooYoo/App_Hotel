<div id="Slider" style="background-color:#000;margin-top:-20px" class="carousel carousel-fade slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="item active">
      <div class="zoomClass">
        <img class="wow fadeIn animated img-rtl animated" src="<?php echo $theme_url; ?>assets/images/hotels.jpg" alt="" style="visibility: visible; animation-name: fadeIn; -webkit-animation-name: fadeIn;">
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div  id="top" class="col-md-12">
    <div class="visible-sm visible-xs m100"></div>
    <div class="clearfix"></div>
    <nav class="navbar navbar-default listing-nav">
      <form  action="<?php echo base_url();?>hotels/search" method="GET" role="search">
        <div class="col-md-3 col-lg-4 col-sm-12 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('012');?></label>
            <input id="HotelsPlaces" name="searching" type="text" class="RTL form-control form searching location-icon" placeholder=" <?php echo trans('026');?>" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>">
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('07');?></label>
            <input type="text" placeholder=" <?php echo trans('07');?> " name="checkin" class="RTL form-control form calender-icon dpd1" value="<?php echo $checkin; ?>" required >
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('09');?></label>
            <input type="text" placeholder=" <?php echo trans('09');?> " name="checkout" class="RTL form-control form calender-icon dpd2" value="<?php echo $checkout; ?>" required >
          </div>
        </div>
        <div class="col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('010');?></label>
            <select  required class="RTL form-control form" placeholder=" <?php echo trans('');?> " name="adults" id="adults">
              <option value="">0</option>
              <option value="1">1</option>
              <option value="2" selected>2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
            </select>
          </div>
        </div>
        <div class="hidden-md col-lg-1 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('011');?></label>
            <select  class="RTL form-control form" placeholder=" <?php echo trans('011');?> " name="child" id="child">
              <option value="">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-lg-2 col-xs-12 col-sm-12 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label">&nbsp;</label>
            <button type="submit" class="btn btn-block btn-success"><i class="fa fa-search go-right"></i> <span class="go-right"> &nbsp; <?php echo trans('012');?> &nbsp; </span></button>
          </div>
        </div>
      </form>
    </nav>
    <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
  </div>
  <div class="col-xs-12 col=sm-6 col-md-3 col-lg-3 hidden-xs hidden-sm go-right">
    <div style="background-color: #1e65dd; color: #fff;pading:35px;font-weight:bold" class="panel-heading go-text-right search-icon"> <?php echo trans('0191');?> <?php echo trans('012');?></div>
    <form class="thumbnail" action="<?php echo base_url();?>hotels/search" method="GET">
      <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#grade">
      <span class="go-right"><i class="glyphicon glyphicon-chevron-right go-right"></i> <?php echo trans('069');?></span><span class="collapsearrow"></span>
      </button>
      <div id="grade" class="in panel-body">
        <?php $star = '<i class="fa fa-star text-warning"></i>'; ?>
        <div class="clearfix"></div>
        <div class="radio radio-warning go-right RTL">   <label >
          <input class="pull-right RTL" type = "radio" name = "stars"   value = "1"   <?php if(@$_GET['stars'] == "1"){echo "checked";}?> /><?php echo $star; ?>
          </label>
        </div>
        <div class="clearfix"></div>
        <div class="radio radio-warning go-right"> <label>
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "2"   <?php if(@$_GET['stars'] == "2"){echo "checked";}?> /> <?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?>
          </label>
        </div>
        <div class="clearfix"></div>
        <div class="radio radio-warning go-right">  <label>
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "3"   <?php if(@$_GET['stars'] == "3"){echo "checked";}?>/> <?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?>
          </label>
        </div>
        <div class="clearfix"></div>
        <div class="radio radio-warning go-right">  <label>
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "4"   <?php if(@$_GET['stars'] == "4"){echo "checked";}?> /> <?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?>
          </label>
        </div>
        <div class="clearfix"></div>
        <div class="radio radio-warning go-right">  <label>
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "5"    <?php if(@$_GET['stars'] == "5"){echo "checked";}?> /> <?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?>
          </label>
        </div>
        <div class="clearfix"></div>
        <div class="radio radio-warning go-right">  <label>
          <input type = "radio" name = "stars"  id = "sizeSmall"  value = "7"    <?php if(@$_GET['stars'] == "7"){echo "checked";}?> /> <?php for($i=1;$i<=7;$i++){ ?> <?php echo $star; ?> <?php } ?>
          </label>
        </div>
        <div class="clearfix"></div>
      </div>
      <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#price">
      <span class="pull-left go-right"><i class="glyphicon glyphicon-chevron-right go-right"></i> <?php echo trans('0216');?></span><span class="collapsearrow"></span>
      </button>
      <div id="price" class="in panel-body">
        <div class="" style="padding-left: 15px;"><br>
          <?php if(!empty($_GET['price'])){
            $selectedprice = $_GET['price'];
            }else{
             $selectedprice =  $minprice.",".$maxprice;
                 }?>
          <input type="text" class="col-xs-12 col-sm-8 col-md-7 col-lg-11" value="" data-slider-min="<?php echo @$minprice;?>" data-slider-max="<?php echo @$maxprice;?> " data-slider-step="10" data-slider-value="[<?php echo $selectedprice;?>]" id="sl2" name="price">
        </div>
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
      <button type="button" class="collapsebtn2 collapsed"  data-toggle="collapse" data-target="#type">
      <span class="pull-left go-right"><i class="glyphicon glyphicon-chevron-right go-right"></i> <?php echo trans('071');?></span><span class="collapsearrow"></span>
      </button>
      <div id="type" class="in panel-body">
        <?php @$vartype = $_GET['type'];
          if(empty($vartype)){
          $vartype = array();
          }
          foreach($hotelTypes as $htype){
          ?>
        <div class="checkbox go-right">
          <label class="go-right"><input class="pull-left go-right" type="checkbox" name="type[]" value="<?php echo $htype['id'];?>" <?php if(in_array($htype['id'],$vartype)){echo "checked";}?> />&nbsp; <span class="go-left"> <?php echo $htype['name'];?> &nbsp; </span></label>
        </div>
        <div class="clearfix"></div>
        <?php } ?>
      </div>
      <div class="line3"></div>
      <div class="panel-body">
        <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
        <button type="submit" class="btn btn-success btn-lg btn-block" id="searchform"> <span class="glyphicon glyphicon-search go-right"></span> <span class="go-right"> &nbsp; <?php echo trans('012');?> &nbsp; </span> </button>
      </div>
    </form>
  </div>
  <div class="visible-xs visible-sm"><br><br></div>
  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
    <?php if(!empty($hotels)){ foreach($hotels as $item){ ?>
    <div class="panel panel-default">
      <a href="<?php echo $item->slug;?>" class="featured">
        <div class="featured">
          <div class="col-md-4 row go-right">
            <div class="owl">
              <a href="<?php echo $item->slug;?>"><div class="item"><img class="lazyOwl img-fade" data-src="<?php echo $item->thumbnail;?>"></div></a>
            </div>
          </div>
          <div class="col-md-8">
            <div class="go-left pull-right">
              <span class="go-left pull-right strong" style="color:#36C;font-size:16px;margin-top:5px">
                <small class="color-gray weak go-right"><?php echo trans('0273');?></small>
                <div class="clearfix"></div>
                <span><span class="go-left weak"><?php echo $item->currCode;?> <?php echo $item->currSymbol; ?>&nbsp;</span><?php echo $item->price;?></span>
              </span>
            </div>
            <a href="<?php echo $item->slug;?>"><h5 class="title strong go-text-right"><?php echo $item->title;?></h5></a>
            <p class="go-text-right" style="color:#999999; margin: 0px -4px 2px;"><span class="go-right">&nbsp;<?php echo $item->location;?></span>&nbsp;<?php echo $item->stars;?></p>
            <?php if(pt_is_module_enabled('reviews')){ ?>
            <button style="padding:2px 8px 2px 8px" class="btn btn-success btn-sm go-right"><i class="fa fa-thumbs-up"></i><strong><?php echo $item->avgReviews->overall; ?></strong></button>
            <button style="padding:2px 8px 2px 8px;border: solid 1px #ccc;" class="btn btn-default btn-sm go-right"><i class="fa fa-smile-o"></i><strong> <?php echo $item->avgReviews->totalReviews; ?></strong></button> <?php } ?>
      <a><button style="padding:2px 8px 2px 8px;border: solid 1px #ccc;" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/hotel/<?php echo $item->id;?>','modal');" class="btn btn-default btn-sm go-right"><i class="fa fa-map-marker"></i><strong> <?php echo trans('041');?></strong></button></a>
      <div class="clearfix"></div>
      <hr class="row" style="border-top: 1px solid #EDEDED !important;margin:10px 0px 5px 0px !important">
      <div class="clearfix"></div>
      <span class="hidden-md hidden-sm hidden-xs go-text-right go-right" style="color:#737373"><?php echo character_limiter($item->desc,150);?></span>
      <div class="clearfix"></div>
      <div class="hidden-xs hidden-sm go-right">
      <?php foreach($item->amenities as $amt){ if(!empty($amt['name'])){ ?>
      <img data-toggle="tooltip" title="<?php echo $amt['name'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top" style="height:30px;max-width: 100%;" src="<?php echo $amt['icon'];?>" alt="" />
      <?php } } ?>
      </div>
      </div>
      <div class="clearfix"></div>
      </div>
      </a>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
    <hr class="row" style="border-top: 1px solid #D9D9D9 !important;margin:10px 0px 10px 0px !important">
    <div class="clearfix"></div>
    <div class="pull-left"><?php echo createPagination($info);?></div>
    <div class="pull-right">
      <a href="#top" class="strong"><?php echo trans('0423');?></a>
    </div>
    <?php }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
  </div>
</div>
<!-- PHPtravels Modal Starting-->
<div class="modal fade" id="datepicker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-calendar text-primary"></i> <?php echo trans('0232');?></h4>
      </div>
      <form method="GET" id="frm" action="" class="my-form">
        <div class="modal-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="checkIn" class="control-label"><?php echo trans('07');?></label>
              <input class="form-control" type="text" id="dpd5" placeholder="From" value="" name="checkin" required >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="checkIn" class="control-label"><?php echo trans('09');?></label>
              <input class="form-control" id="dpd6" type="text" placeholder="To" value="" name="checkout" required >
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="adults" class="control-label"><?php echo trans('010');?></label>
              <select  required class="form-control" placeholder="<?php echo trans('010');?>" name="adults" id="adults">
                <option value=""><?php echo trans('010');?></option>
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="adults" class="control-label"><?php echo trans('011');?></label>
              <select  class="form-control" placeholder="<?php echo trans('011');?>" name="child" id="child">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="btn" class="control-label">&nbsp;</label>
              <button type="submit" class="btn btn-block btn-success"><?php echo trans('0419');?></button>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- PHPtravels Modal Ending-->
<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="mapContent">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left go-right" data-dismiss="modal"> &nbsp; <?php echo trans('0234');?> &nbsp; </button>
      </div>
    </div>
  </div>
</div>
<!---- End Map Modal ---->
<script type="text/javascript">
  $(function(){

  $(".dpick").on("click",function(){

  var data = $(this).data('url');
  $("#frm").prop("action",data);

  })

  })
</script>

            <style>
              /* OWL */
              .owl-item.loading{ min-height:160px; background: url(<?php echo $theme_url; ?>assets/images/loading.svg) no-repeat center; }
              .owl .item img{ display: block; width: 100%; height: auto; }
              .owl-wrapper{ display: block !important; width: 100% !important; height: auto !important; }
              .owl-item{ display: block !important; width: 100% !important; height: auto !important; }
              /* OWL */
            </style>