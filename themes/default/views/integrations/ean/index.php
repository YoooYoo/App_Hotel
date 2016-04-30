<div class="container">

<div  id="top" class="col-md-12">
    <img class="img-responsive img-border hidden-xs hidden-sm img-rtl" src="<?php echo $theme_url; ?>assets/images/hotels.jpg" alt="hotels"/>
    <div class="visible-sm visible-xs m100"></div>
    <div class="clearfix"></div>
    <nav class="navbar navbar-default listing-nav">
      <form  action="<?php echo base_url();?>ean/search" method="GET" role="search">
        <div class="col-md-3 col-lg-4 col-sm-12 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('012');?></label>
            <input id="HotelsPlaces" name="city"  type="text" class="RTL form-control form searching location-icon searchingexp" placeholder="&nbsp;<?php echo trans('026');?>" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; } ?>" required >
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('07');?></label>
            <input type="text" placeholder="<?php echo trans('07');?>" id="eandpd" name="checkIn" class="RTL form-control form calender-icon" value="<?php echo $checkin; ?>" required >
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('09');?></label>
            <input type="text" class="RTL form-control form calender-icon" id="eandpd2" placeholder="<?php echo trans('09');?>" name="checkOut" value="<?php echo $checkout; ?>" required >
          </div>
        </div>
        <div class="col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right">
          <div class="form-group">
            <div class="clearfix"></div>
            <label class="control-label go-right"><?php echo trans('010');?></label>
            <select class="RTL form-control form" placeholder=" <?php echo trans('');?>"  name="adults">
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

        <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
        <input name="adults" type="hidden" class="sortby" value="<?php if(!empty($_GET['adults'])){ echo $_GET['adults']; }else{ echo "1"; } ?>">
        <input name="search" type="hidden" value="1">

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





  <div class="col-md-12">
    <?php
      $multiplelocations =  $result['HotelListResponse']['LocationInfos']['@size'];
      $locations = $result['HotelListResponse']['LocationInfos']['LocationInfo'];
      //  echo $eanlib->apistr;
       $totalcounts = $result['HotelListResponse']['HotelList']['@size'];
       if(empty($result['HotelListResponse']['EanWsError'])){
       if(!empty($result)){

      if($totalcounts > 1){
       $resultarray = $result['HotelListResponse']['HotelList']['HotelSummary'];
      }else{
      $resultarray[] = $result['HotelListResponse']['HotelList']['HotelSummary'];
      }

      foreach($resultarray as $res){
      //    print_r($res);
      ?>
    <div class="panel panel-default fade-white" style="margin-bottom:10px">
      <a class="tdn dpick" data-toggle="modal" href="#datepicker">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 offset-0">
          <?php
            @$search = $_GET['search'];
            if(!empty($search)){ ?>
     <div class="owl"> <a href="<?php echo base_url();?>ean/hotel/<?php echo $res['hotelId']; ?>/<?php echo $result['HotelListResponse']['customerSessionId']; ?>?adults=<?php echo $adults;?>&checkin=<?php echo $checkin;?>&checkout=<?php echo $checkout;?>"><img data-original="https://images.travelnow.com<?php echo str_replace("_t","_b",$res['thumbNailUrl']);?>" src="" class="img-responsive lazy fade-img"></a></div>

      <?php }else{ ?>
      <a class="fs24 dpick" data-toggle="modal" href="#datepicker" data-url="<?php echo base_url();?>ean/hotel/<?php echo $res['hotelId']; ?>/<?php echo $result['HotelListResponse']['customerSessionId']; ?>?adults=<?php echo $adults;?>" ><img style="max-height:175px;width:275px" src="https://images.travelnow.com<?php echo str_replace("_t","_b",$res['thumbNailUrl']);?>" class="img-responsive fade-img" ></a>
      <?php } ?>
      </div>
      </a>
      <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 featured">
        <a class="tdn dpick" data-toggle="modal" href="#datepicker" >
          <p class="h4 mt0 pdrt0 mb0"><span class="pull-left"><?php echo character_limiter($res['name'],35);?></span> <span class="pull-right small">Avg/Night</span></p>
          <div class="clearfix"></div>
          <p><span class="star fs12"><img style="height:12px" src="<?php echo str_replace("http","https",@$res['tripAdvisorRatingUrl']); ?>" alt="" /> <span class="text-success"><i class="fa fa-map-marker"></i> <?php echo $res['city'];?></span></span> <span class="pull-right strong text-primary fs24"><small class="fs14"><?php echo $res['rateCurrencyCode']; ?></small> <?php echo $res['lowRate'];?> </p>
        </a>
        <p class="hidden-xs"><a class="tdn dpick" data-toggle="modal" href="#datepicker"><button class="btn btn-success"> <i class="fa fa-thumbs-up"></i> <span data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo trans('019');?>"><?php echo $res['tripAdvisorRating']; ?></span></button>
          <button class="btn btn-default btn-sm"><i class="fa fa-smile-o"></i> <?php echo $res['tripAdvisorReviewCount'];?></button>
          <a class="maps btn btn-default" href="<?php echo base_url();?>home/maps/<?php echo $res['latitude'];?>/<?php echo $res['longitude'];?>/hotel/<?php echo 0;?>" ><i class="fa fa-map-marker"></i> <?php echo trans('064');?></a>
          </a>
        </p>
        <span class="hidden-xs"> <?php $shortdesc = character_limiter($res['shortDescription'],180);
          $details = html_entity_decode(str_replace("Property Location","",$shortdesc));
          echo strip_tags($details);
          ?></span>

        <small class="hidden-xs"> </small>
   </div>
      <div class="clearfix"></div>
    </div>
    <?php } } } ?>
    <?php
      $multiplelocations =  $result['HotelListResponse']['LocationInfos']['@size'];
      $locations = $result['HotelListResponse']['LocationInfos']['LocationInfo'];
      //  echo $eanlib->apistr;
       $totalcounts = $result['HotelListResponse']['HotelList']['@size'];
       if(empty($result['HotelListResponse']['EanWsError'])){
       if(!empty($result)){

      if($totalcounts > 1){
       $resultarray = $result['HotelListResponse']['HotelList']['HotelSummary'];
      }else{
      $resultarray[] = $result['HotelListResponse']['HotelList']['HotelSummary'];
      }

      foreach($resultarray as $res){
      //    print_r($res);
      ?>
    <!--    <p class="panel-heading h5 mt0 pdrt0 mb0 strong">
      <?php if(!empty($search)){ ?>
      <a href="<?php echo base_url();?>ean/hotel/<?php echo $res['hotelId']; ?>/<?php echo $result['HotelListResponse']['customerSessionId']; ?>?adults=<?php echo $adults;?>&checkin=<?php echo $checkin;?>&checkout=<?php echo $checkout;?>" style="border-radius:0px !important;"><?php echo $res['name'];?></a>
      <?php }else{ ?>
      <a class="dpick" data-toggle="modal" href="#datepicker" data-url="<?php echo base_url();?>ean/hotel/<?php echo $res['hotelId']; ?>/<?php echo $result['HotelListResponse']['customerSessionId']; ?>?adults=<?php echo $adults;?>" ><?php echo character_limiter($res['name'],35);?></a>
      <?php } ?>
      <a href="<?php echo base_url();?>hotels/<?php echo $hotel->hotel_slug;?>?lang=<?php echo $lang_set;?>"></a>
      </p>-->
    <?php  } } }elseif($multiplelocations > 1){ $getvars = $_GET;    ?>
    <br>
    <h1 class="text-center"><?php echo trans("0302");?></h1>
    <?php foreach($locations as $loc){
      $getvars['city'] = $loc['city'];
      $getvars['destinationId'] = $loc['destinationId'];

      $link = base_url().'ean/search?'.http_build_query($getvars);
      echo "<a href=$link>".$loc['city']." - ".$loc['countryName']."</a> <br>";
      //  echo 'destinationid - '.$loc['destinationId'].'<br> city - '.$loc['city'].'<br><hr>';

      }


      }else{ echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
    <?php if($totalcounts > 1){ ?>
    <span class=" pull-right"><?php echo @$plinks['pages'];?></span>
    <?php } ?>
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
<!-- PHPtravels Modal Starting-->
<div class="modal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm  wow zoomIn animated">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-calendar"></i> <?php echo trans('0232');?></h4>
      </div>
      <form method="GET" id="frm" action="" class="form-horizontal my-form">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-2 control-label"><?php echo trans('000003');?> </label>
            <div class="col-md-10">
              <input class="form-control" type="text" id="eandpd5" placeholder="From" value="" name="checkin" required >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"><?php echo trans('000004');?></label>
            <div class="col-md-10">
              <input class="form-control" id="eandpd6" type="text" placeholder="To" value="" name="checkout" required >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-6">
              <select  required class="form-control" placeholder="<?php echo trans('010');?>" name="adults" id="adults">
                <option value=""><?php echo trans('010');?></option>
                <option value="1">1</option>
                <option value="2">2</option>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234');?></button>
          <button type="submit" class="btn btn-primary"><?php echo trans('0233');?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- PHPtravels Modal Ending-->

            <style>
              /* OWL */
              .owl-item.loading{ min-height:160px; background: url(<?php echo $theme_url; ?>assets/images/loading.svg) no-repeat center; }
              .owl .item img{ display: block; width: 100%; height: auto; }
              .owl-wrapper{ display: block !important; width: 100% !important; height: auto !important; }
              .owl-item{ display: block !important; width: 100% !important; height: auto !important; }
              /* OWL */
            </style>