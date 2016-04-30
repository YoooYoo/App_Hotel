

              <br><br><h3 class="offset-0-tb strong"><?php echo character_limiter($hotelslib->title, 45);?></h3>

                  <p class="text-small"><i class="fa fa-map-marker"></i> <?php echo $hotelslib->city;?>, <?php if(!empty($hotelslib->state)){ echo $hotelslib->state.","; };?> <?php echo $hotelslib->country;?></p>
                    <ul class="list list-inline text-small">
                      <?php  if(!empty($hotelslib->email)){   ?>  <li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $hotelslib->email;?>"><?php echo trans('0392');?></a></li>  <?php } ?>
                      <?php  if(!empty($hotelslib->website)){ ?>  <li><i class="fa fa-home"></i> <a href="<?php echo $hotelslib->website;?>"><?php echo trans('0393');?></a></li>           <?php } ?>
                      <?php  if(!empty($hotelslib->phone)){   ?>  <li><i class="fa fa-phone"></i> <a href="tel:<?php echo $hotelslib->phone;?>"><?php echo $hotelslib->phone;?></a></li>    <?php } ?>
                    </ul>

                      <?php include 'includes/tripadvisor.php';  ?>

                    <h3><?php echo $avg_reviews[0]->totalreviews;?> <small ><?php echo trans('0396');?></small></h3>
                            <div class="booking-item-rating">
                             <span class="h2"><?php pt_create_stars($details[0]->hotel_stars);?></span>
                            <span class="h4"><b ><?php echo round($avg_reviews[0]->overall, 1);?></b> <?php echo trans('0400');?> 10 <small class="text-smaller"><?php echo trans('0401');?></small></span>
                            <br><br>
                        </div>

                                <hr>


           <div class="clearfix"></div>




               <?php if (@ $avg_reviews[0]->overall > 0) {?>
        <h3><?php echo trans('035');?></h3>
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <div class="row rating-desc">
              <div class="col-xs-3 col-md-3 text-left">
                <?php echo trans('030');?>
              </div>
              <div class="col-xs-8 col-md-9">
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                    aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avg_reviews[0]->clean * 10;?>%">
                    <span class="sr-only"><?php echo round($avg_reviews[0]->clean, 1);?></span>
                  </div>
                </div>
              </div>
              <!-- end 5 -->
              <div class="col-xs-3 col-md-3 text-left">
                <?php echo trans('031');?>
              </div>
              <div class="col-xs-8 col-md-9">
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                    aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avg_reviews[0]->comfort * 10;?>%">
                    <span class="sr-only"><?php echo round($avg_reviews[0]->comfort, 1);?></span>
                  </div>
                </div>
              </div>
              <!-- end 4 -->
              <div class="col-xs-3 col-md-3 text-left">
                <?php echo trans('032');?>
              </div>
              <div class="col-xs-8 col-md-9">
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                    aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avg_reviews[0]->location * 10;?>%">
                    <span class="sr-only"><?php echo round($avg_reviews[0]->location, 1);?></span>
                  </div>
                </div>
              </div>
              <!-- end 3 -->
              <div class="col-xs-3 col-md-3 text-left">
                <?php echo trans('033');?>
              </div>
              <div class="col-xs-8 col-md-9">
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                    aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avg_reviews[0]->facilities * 10;?>%">
                    <span class="sr-only"><?php echo round($avg_reviews[0]->facilities, 1);?></span>
                  </div>
                </div>
              </div>
              <!-- end 2 -->
              <div class="col-xs-3 col-md-3 text-left">
                <?php echo trans('034');?>
              </div>
              <div class="col-xs-8 col-md-9">
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avg_reviews[0]->staff * 10;?>%">
                    <span class="sr-only"><?php echo round($avg_reviews[0]->staff, 1);?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

             </div>
                 <br>
                    <div class="row">
                   <div class="col-xs-6 col-md-6"><button data-toggle="modal" data-target="#read-reviews" class="btn btn-block btn-success"><?php echo trans('0394');?></button></div>
                   <div class="col-xs-6 col-md-6"><button data-toggle="modal" data-target="#AddReview" class="btn btn-block btn-action"><?php echo trans('0395');?></button></div>
        <div class="clearfix"></div></div>

           <?php }?>







        <!------- Comments modal ------------->
<div class="modal fade" id="AddReview" tabindex="" role="dialog" aria-labelledby="AddReview" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title"><i class="fa fa-smile-o"></i> <?php echo trans('084');?> <?php echo $hotelslib->title;?> </h4>
                         </div>
                           <div class="modal-body">

                           <form class="form-horizontal" method="POST" id="reviews-form" action="" onsubmit="return false;">

                  <div id="review_result" >

                  </div>

                  <div class="panel-body">
                      <div class="alert resp" style="display:none"></div>

              <div class="spacer20px">
                     <div class="col-md-4">
                    <div class="well well-sm">
                    <div class="well well-sm whitewell">

                    <h3 class="text-center"><strong class="text-primary"><?php echo trans('0389');?></strong>&nbsp;<span id="avgall"> 1</span> / 10</h3>
                     </div>

                               <hr>

                                 <div class="form-group">
							   <label class="col-md-5 control-label"><?php echo trans('030');?></label>
                               <div class="col-md-5">
                               <select class="form-control reviewscore" id="" name="reviews_clean">
                                 <option value="1"> 1 </option>
                                 <option value="2"> 2 </option>
                                 <option value="3"> 3 </option>
                                 <option value="4"> 4 </option>
                                 <option value="5"> 5 </option>
                                 <option value="6"> 6 </option>
                                 <option value="7"> 7 </option>
                                 <option value="8"> 8 </option>
                                 <option value="9"> 9 </option>
                                 <option value="10"> 10 </option>
                                 </select>
                               </div>
                               </div>

                               <div class="form-group">
							   <label class="col-md-5 control-label"><?php echo trans('031');?></label>
                               <div class="col-md-5">
                               <select class="form-control reviewscore" id="" name="reviews_comfort">
                                 <option value="1"> 1 </option>
                                 <option value="2"> 2 </option>
                                 <option value="3"> 3 </option>
                                 <option value="4"> 4 </option>
                                 <option value="5"> 5 </option>
                                 <option value="6"> 6 </option>
                                 <option value="7"> 7 </option>
                                 <option value="8"> 8 </option>
                                 <option value="9"> 9 </option>
                                 <option value="10"> 10 </option>
                                 </select>
                               </div>
                               </div>

                               <div class="form-group">
							   <label class="col-md-5 control-label"><?php echo trans('032');?></label>
                               <div class="col-md-5">
                               <select class="form-control reviewscore" id="" name="reviews_location">
                                 <option value="1"> 1 </option>
                                 <option value="2"> 2 </option>
                                 <option value="3"> 3 </option>
                                 <option value="4"> 4 </option>
                                 <option value="5"> 5 </option>
                                 <option value="6"> 6 </option>
                                 <option value="7"> 7 </option>
                                 <option value="8"> 8 </option>
                                 <option value="9"> 9 </option>
                                 <option value="10"> 10 </option>
                                 </select>
                               </div>
                               </div>

                               <div class="form-group">
							   <label class="col-md-5 control-label"><?php echo trans('033');?></label>
                               <div class="col-md-5">
                               <select class="form-control reviewscore" id="" name="reviews_facilities">
                                 <option value="1"> 1 </option>
                                 <option value="2"> 2 </option>
                                 <option value="3"> 3 </option>
                                 <option value="4"> 4 </option>
                                 <option value="5"> 5 </option>
                                 <option value="6"> 6 </option>
                                 <option value="7"> 7 </option>
                                 <option value="8"> 8 </option>
                                 <option value="9"> 9 </option>
                                 <option value="10"> 10 </option>
                                 </select>
                               </div>
                               </div>

                               <div class="form-group">
							   <label class="col-md-5 control-label"><?php echo trans('034');?></label>
                               <div class="col-md-5">
                               <select class="form-control reviewscore" id="" name="reviews_staff">
                                 <option value="1"> 1 </option>
                                 <option value="2"> 2 </option>
                                 <option value="3"> 3 </option>
                                 <option value="4"> 4 </option>
                                 <option value="5"> 5 </option>
                                 <option value="6"> 6 </option>
                                 <option value="7"> 7 </option>
                                 <option value="8"> 8 </option>
                                 <option value="9"> 9 </option>
                                 <option value="10"> 10 </option>
                                 </select>
                               </div>
                               </div>
                              </div>
							  </div>

		<div class="col-md-8">
		<div class="col-md-6" style="padding-left: 0px;">

        <div class="panel panel-default">
           <div class="panel-heading"><strong><?php echo trans('0350');?></strong></div>
                  <input class="form-control" type="text" name="fullname" placeholder="<?php echo trans('0390');?> <?php echo trans('0350');?>">
        </div>
        </div>

        		<div class="col-md-6" style="padding-right: 0px;">

        <div class="panel panel-default">
           <div class="panel-heading"><strong><?php echo trans('094');?></strong></div>
                  <input class="form-control" type="text" name="email" placeholder="<?php echo trans('0390');?> <?php echo trans('094');?>">
        </div>

        </div>
           <div class="clearfix"></div>
                <div class="panel panel-default">
           <div class="panel-heading"><strong><?php echo trans('0381');?></strong></div>
                <textarea class="form-control" type="text" placeholder="Your Review" name="reviews_comments" id="" cols="30" rows="10"></textarea>
        </div>
            <p class="text-danger"><strong><?php echo trans('0371');?></strong> : <?php echo trans('085');?>.</p>
            </div>
            </div>
            </div>
      <input type="hidden" name="overall" id="overall" value="1" />
      <input type="hidden" name="reviewmodule" value="hotels" />
      <input type="hidden" name="reviewfor" value="<?php echo $details[0]->hotel_id; ?>" />


                                </form>
                           </div>
                        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234');?></button>
          <button type="button" class="btn btn-primary addreview" id="#" ><i class="fa fa-save"></i> <?php echo trans('086');?></button>
                    </div>
                  </div>
                </div>
              </div>
              <!---Comments Modal-->