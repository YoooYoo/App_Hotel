
<div class="tabbable booking-details-tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i> <?php echo trans('017');?></a> </li>
                                <?php if(!empty($interior_images)){ ?><li><a href="#int" data-toggle="tab"><i class="fa fa-image"></i> <?php echo trans('059');?> <?php echo trans('0376');?></a> </li> <?php } ?>
                                <?php if(!empty($exterior_images)){ ?><li><a href="#ext" data-toggle="tab"><i class="fa fa-image"></i> <?php echo trans('060');?> <?php echo trans('0376');?></a> </li> <?php } ?>
                                <li><a href="#videos" data-toggle="tab"><i class="fa fa-play-circle"></i> <?php echo trans('018');?></a> </li>
                                <li><a href="#google-map-tab" data-toggle="tab"><i class="fa fa-map-marker"></i> <?php echo trans('041');?></a> </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-1">
                                    <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">



                                        <?php if(!empty($HotelImages['HotelImage'])){ foreach($HotelImages['HotelImage'] as $hi){ ?>
                                        <img src="<?php echo $hi['url']; ?>" alt="" width="500" style="width:500px;height:600px !important;" title="" />

                                        <?php } }else{ ?>

                                        <img src="<?php echo PT_BLANK;?>" alt="" title="" />

                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="google-map-tab">
                                    <?php if (!empty ($details[0]->hotel_latitude) && !empty ($details[0]->hotel_longitude)) {?>
    <span class="thumbnail">
    <a href="<?php echo base_url();?>home/maps/<?php echo $details[0]->hotel_latitude;?>/<?php echo $details[0]->hotel_longitude;?>/hotel/<?php echo $details[0]->hotel_id;?>" style="position:absolute;margin-top:415px;margin-left:12px" class="btn btn-default showmap maps cboxElement"><i class="fa fa-search"></i> View larger</a>
    <iframe src="<?php echo base_url();?>home/maps/<?php echo $details[0]->hotel_latitude;?>/<?php echo $details[0]->hotel_longitude;?>/hotel/<?php echo $details[0]->hotel_id;?>" width="100%" height="464" frameborder="0" style="border:0"></iframe>
    </span>
    <?php }?>
                                </div>

                                 <?php if(!empty($interior_images)){ ?>
                                <div class="tab-pane fade" id="int">


                                <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">


        <?php foreach($interior_images as $inti){ ?>

                                        <img src="<?php echo PT_HOTELS_INTERIOR.$inti->himg_image; ?>" alt="" title="" />
                                         <?php } ?>


                                    </div>


                                </div>
                                <?php }?>

                                  <?php if(!empty($exterior_images)){ ?>
                                <div class="tab-pane fade" id="ext">

                                <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">


        <?php foreach($exterior_images as $ei){ ?>

                                        <img src="<?php echo PT_HOTELS_EXTERIOR.$ei->himg_image; ?>" alt="" title="" />
                                         <?php } ?>


                                    </div>

                                </div>

                                 <?php }  ?>

                                 <div class="tab-pane fade" id="videos">
                                     <!-- videos -->
    <?php if($has_video){ ?>

      <div class="fotorama hotelvids">
 <!-- <a href="https://player.vimeo.com/video/16529274"><img src="https://i.vimeocdn.com/video/101381899_640.jpg"></a>




          <a href="https://player.vimeo.com/video/52373422"><img src="https://i.vimeocdn.com/video/361894663_640.jpg"></a>
-->

  </div>


    <?php } ?>
    <!-- videos -->
                                </div>


                            </div>
                        </div>




