 <h4 class="strong"><i class="fa fa-bed text-warning"></i> <?php echo trans('0372');?></h4>

  <nav class="well well-sm">
    <form  action="" method="GET" role="search">

     <div class="col-md-2 col-sm-6 col-xs-6">
      <div class="form-group">
       <label class="control-label"><?php echo trans('07');?></label>
              <input type="text" id="dpd3" placeholder="&#xf073; <?php echo trans('07');?>" name="checkin" class="form-control" value="<?php echo $hotelslib->checkin;?>" required>
      </div>
     </div>

     <div class="col-md-2 col-sm-6 col-xs-6">
      <div class="form-group">
       <label class="control-label"><?php echo trans('09');?></label>
              <input type="text" id="dpd4" placeholder="&#xf073; <?php echo trans('09');?>" name="checkout" class="form-control" value="<?php echo $hotelslib->checkout;?>" required>
      </div>
     </div>

     <div class="col-md-2 col-lg-2 col-sm-6 col-xs-6">
      <div class="form-group">
       <label class="control-label"><?php echo trans('010');?></label>
      <select data-placeholder="<?php echo trans('010');?>" class="form-control" name="adults" required>
           <?php for($adults = 1; $adults < 11;$adults++){ ?>
           <option value="<?php echo $adults;?>" <?php if($adults == $hotelslib->adults){ echo "selected"; } ?> > <?php echo $adults;?> </option>
           <?php } ?>
            </select>

          </div>
     </div>

     <div class="hidden-md col-lg-2 col-sm-6 col-xs-6">
      <div class="form-group">
       <label class="control-label"><?php echo trans('011');?></label>
<select data-placeholder="Children" class="form-control" name="child">
              <option value="0" selected>0</option>
            <?php for($child = 1; $child < 6;$child++){ ?>
           <option value="<?php echo $child;?>" <?php if($child == $hotelslib->children){ echo "selected"; } ?>> <?php echo $child;?> </option>
           <?php } ?>
                          </select>      </div>
     </div>

        <div class="col-md-3 col-lg-4 col-xs-12 col-sm-12">

      <div class="form-group">
       <label class="control-label">&nbsp;</label>
            <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search"></i> <?php echo trans('0106');?></button>
      </div>
     </div>

        </form>
        <div class="clearfix"></div>
          </nav>

























         <table class="table table-bordered table-responsive mb0">

      <thead>
            <tr>
              <th><?php echo trans('0246');?></th>
              <th style="width:100px" class="hidden-xs text-center"><?php echo trans('0373');?></th>
              <th style="width:180px" class="text-center"><?php echo trans('0375') ?> <span class="btn btn-success btn-xs"><?php echo $hotelslib->stay; ?></span> <?php echo trans('0122');?></th>
            </tr>
          </thead>





        <tbody>




          <?php

               foreach($rooms['HotelRoomResponse'] as $room){ $nonrefund = $room['RateInfos']['RateInfo']['nonRefundable']; ?>


        <tr>
          <td>
              <div class="col-md-4 col-lg-3 row">

              <?php if(!empty($room['RoomImages']['RoomImage'])){ ?>
                     <a href="<?php echo $room['RoomImages']['RoomImage']['url']; ?>" rel="room_<?php echo $room['rateCode'];?>"> <img src="<?php echo $room['RoomImages']['RoomImage']['url']; ?>" href="<?php echo $room['RoomImages']['RoomImage']['url']; ?>" class="img-responsive colorbox"/></a>
                     <?php }else{  ?>
                   <a href="<?php echo PT_BLANK; ?>" rel="room_<?php echo $room['rateCode'];?>"> <img src="<?php echo PT_BLANK; ?>" href="<?php echo PT_BLANK; ?>" class="img-responsive colorbox"/></a>
                     <?php } ?>

              <a href="#" rel="room_49"> <img src="" href="" class="img-responsive colorbox fade-img wow fadeIn animated cboxElement animated"></a>
            </div>

              <div class="col-md-8 col-lg-9">
               <p class="strong"><?php echo $room['rateDescription']; ?></p>
                <h5 class="hidden-xs"><?php echo character_limiter($room['RoomType']['descriptionLong'],120);?></h5>
                  <button class="hidden-xs btn btn-warning btn-xs" data-toggle="collapse" data-target="#<?php echo $room['rateCode']; ?>">More Details</button>
                 <?php if($nonrefund){ ?><div class="btn btn-xs btn-info"><?php echo trans("0309");?></div><?php } ?>

              </div>
          </td>

          <td class="hidden-xs" style="padding:38px 10px 0px 10px ">

          <h3 class="btn-md btn btn-default"> <?php echo trans('050');?> <?php echo $room['rateOccupancyPerRoom']; ?> </h3>

          </td>

          <form action="#" method="GET"></form>



          <td>

           <?php

                          // $price = $room['RateInfos']['RateInfo']['ChargeableRateInfo']['@total'];
                           $price = $room['RateInfos']['RateInfo']['ChargeableRateInfo']['@maxNightlyRate'];
                           $currency = $room['RateInfos']['RateInfo']['ChargeableRateInfo']['@currencyCode'];

                           ?>

            <div class="text-center">
             <p><?php echo $currency; ?><span class="strong fs20">  <?php echo $price; ?></span></p>

            </div>

            <div class="form-group">
            <a href="<?php echo base_url();?>ean/reservation?hotel=<?php echo $hotelid; ?>&checkin=<?php echo $_GET['checkin'];?>&checkout=<?php echo $_GET['checkout'];?>&adults=<?php echo $_GET['adults'];?>&roomtype=<?php echo $room['RoomType']['@roomCode']; ?>&ratekey=<?php echo $room['RateInfos']['RateInfo']['RoomGroup']['Room']['rateKey']; ?>&ratecode=<?php echo $room['rateCode']; ?>&sessionid=<?php echo $sessionid;?>" ><button class="btn btn-success btn-block btn-lg chk"><?php echo trans('0142');?></button></a>


            </div>

          </td>

            </tr>
            <tr>

            <td class="alert alert-success" style="margin:0px;padding:0px">
            <div id="<?php echo $room['rateCode']; ?>" class="collapse modal-body">

            <?php echo $room['RoomType']['descriptionLong'];?>


                        <hr>

             <?php  $ramenities = $room['RoomType']['roomAmenities']['RoomAmenity'];

                         if(!empty($ramenities)){ ?>
                      <div class="hpadding20">
                           <p>  <strong><?php echo trans('055');?> : </strong></p>
                           <div class="col-md-6">
                              <ul class="checklist">
                                 <?php
                                    $ramcount = 0;
                                    foreach($ramenities as $ram){
                                       $ramcount++;
                                       ?>
                                 <li><?php echo ucwords($ram['amenity']);?></li>
                                 <?php if($ramcount % 2 == 0){ ?>
                              </ul>
                           </div>
                           <div class="col-md-6">
                              <ul class="checklist">
                                 <?php } } ?>
                              </ul>
                           </div>
                        </div>
                        <?php } ?>
                        <!-- END PHPTRAVELS Room Amenties -->

          <div class="clearfix"></div>
        </div>
            </td></tr>
             <?php } ?>








                     </tbody></table>
























