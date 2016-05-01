<h3 class="go-text-right strong" style="margin-top:0px"><?php echo $hotel->title; ?></h3>
<p class="text-small go-text-right "><i class="fa fa-map-marker go-right"></i> <?php echo $hotel->location; ?> &nbsp;
    <br>
    <?php echo $hotel->stars; ?>
</p>
<ul class="list list-inline text-small go-text-right ">
    <?php if (!empty($hotel->email)) { ?>
        <li><i class="fa fa-envelope go-right"></i> <a href="mailto:<?php echo $hotel->email; ?>">
                &nbsp; <?php echo trans('0392'); ?> &nbsp; </a></li>
    <?php } ?>
    <?php if (!empty($hotel->website)) { ?>
        <li><i class="fa fa-home go-right"></i> <a href="<?php echo $hotel->website; ?>">
                &nbsp; <?php echo trans('0393'); ?> &nbsp; </a></li>
    <?php } ?>
    <?php if (!empty($hotel->phone)) { ?>
        <li><i class="fa fa-phone go-right"></i> <a href="tel<?php echo $hotel->phone; ?>">
                &nbsp; <?php echo $hotel->phone; ?> &nbsp; </a></li>
    <?php } ?>
</ul>
<span class="strong  go-right"><i class="fa fa-smile-o  go-right"></i> &nbsp; <?php echo $avgReviews->totalReviews; ?>
    &nbsp; </span>
<small class="go-right"><?php echo trans('0396'); ?></small>
<div class="clearfix"></div>
<hr class="row" style="border-top: 1px solid #EDEDED !important;margin:6px 0px -12px 0px !important">
<div class="clearfix"></div>
<span class="h4 go-right"></span>
<h3 class="go-text-right"><?php echo trans('035'); ?> <span class="strong"><?php echo $avgReviews->overall; ?></span>
    <small><?php echo trans('0400'); ?></small>
    10
</h3>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="row rating-desc">
            <div class="col-xs-3 col-md-3 text-left">
                <span class="go-right"><?php echo trans('030'); ?></span>
            </div>
            <div class="col-xs-8 col-md-9">
                <div class="progress">
                    <div class="progress-bar progress-bar-warning go-right" role="progressbar" aria-valuenow="20"
                         aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avgReviews->clean * 10; ?>%">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <!-- end 5 -->
            <div class="col-xs-3 col-md-3 text-left">
                <span class="go-right"><?php echo trans('031'); ?></span>
            </div>
            <div class="col-xs-8 col-md-9">
                <div class="progress">
                    <div class="progress-bar progress-bar-warning go-right" role="progressbar" aria-valuenow="20"
                         aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->comfort * 10; ?>%">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <!-- end 4 -->
            <div class="col-xs-3 col-md-3 text-left">
                <span class="go-right"><?php echo trans('032'); ?></span>
            </div>
            <div class="col-xs-8 col-md-9">
                <div class="progress">
                    <div class="progress-bar progress-bar-warning go-right" role="progressbar" aria-valuenow="20"
                         aria-valuemin="0" aria-valuemax="100"
                         style="width: <?php echo $avgReviews->location * 10; ?>%">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <!-- end 3 -->
            <div class="col-xs-3 col-md-3 text-left">
                <span class="go-right"><?php echo trans('033'); ?></span>
            </div>
            <div class="col-xs-8 col-md-9">
                <div class="progress">
                    <div class="progress-bar progress-bar-warning go-right" role="progressbar" aria-valuenow="20"
                         aria-valuemin="0" aria-valuemax="100"
                         style="width: <?php echo $avgReviews->facilities * 10; ?>%">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <!-- end 2 -->
            <div class="col-xs-3 col-md-3 text-left">
                <span class="go-right"><?php echo trans('034'); ?></span>
            </div>
            <div class="col-xs-8 col-md-9">
                <div class="progress">
                    <div class="progress-bar progress-bar-warning go-right" role="progressbar" aria-valuenow="80"
                         aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->staff * 10; ?>%">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row form-group">
    <div class="col-xs-6 col-md-6 go-right">
        <button data-toggle="modal" data-target="#read-reviews"
                class="btn btn-block btn-success"><?php echo trans('0394'); ?></button>
    </div>
    <div class="col-xs-6 col-md-6 go-left">
        <button data-toggle="modal" data-target="#AddReview"
                class="btn btn-block btn-action"><?php echo trans('0395'); ?></button>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row">
    <?php $currenturl = current_url();
    $wishlist = pt_check_wishlist($customerloggedin, $hotel->id);
    if ($wishlist) { ?>
        <div class="col-xs-6 col-md-12"><span class="btn btn-block wish removewishlist btn-warning"><span
                    class="wishtext"> <i class="fa fa-remove"></i> <?php echo trans('028'); ?></span></span></div>
    <?php } else { ?>
        <div class="col-xs-6 col-md-12"><span class="btn btn-block wish addwishlist btn-primary"><span class="wishtext"> <i
                        class="fa fa-star"></i> <?php echo trans('029'); ?></span></span></div>
    <?php } ?>
    <input type="hidden" id="loggedin" value="<?php echo $customerloggedin; ?>"/>
    <input type="hidden" id="itemid" value="<?php echo $hotel->id; ?>"/>
    <input type="hidden" id="module" value="hotels"/>
    <input type="hidden" id="addtxt" value="<i class='fa fa-star'></i> <?php echo trans('029'); ?>"/>
    <input type="hidden" id="removetxt" value="<i class='fa fa-remove'></i> <?php echo trans('028'); ?>"/>
</div>

<!-- Comments modal -->
<div class="modal fade" id="AddReview" tabindex="" role="dialog" aria-labelledby="AddReview" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i
                        class="fa fa-smile-o"></i> <?php echo trans('084'); ?> <?php echo $hotel->title; ?> </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="reviews-form-<?php echo $hotel->id; ?>" action=""
                      onsubmit="return false;">
                    <div id="review_result<?php echo $hotel->id; ?>">
                    </div>
                    <div class="panel-body">
                        <div class="alert resp" style="display:none"></div>
                        <div class="spacer20px">
                            <div class="col-md-4 go-right">
                                <div class="well well-sm">
                                    <div class="well-sm">
                                        <h3 class="text-center"><strong
                                                class="text-primary"><?php echo trans('0389'); ?></strong>&nbsp;<span
                                                id="avgall_<?php echo $hotel->id; ?>"> 1</span> / 10</h3>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5 control-label"><?php echo trans('030'); ?></label>
                                        <div class="col-md-5">
                                            <select
                                                class="form-control reviewscore reviewscore_<?php echo $hotel->id; ?>"
                                                id="<?php echo $hotel->id; ?>" name="reviews_clean">
                                                <option value="1"> 1</option>
                                                <option value="2"> 2</option>
                                                <option value="3"> 3</option>
                                                <option value="4"> 4</option>
                                                <option value="5"> 5</option>
                                                <option value="6"> 6</option>
                                                <option value="7"> 7</option>
                                                <option value="8"> 8</option>
                                                <option value="9"> 9</option>
                                                <option value="10"> 10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-5 control-label"><?php echo trans('031'); ?></label>
                                        <div class="col-md-5">
                                            <select
                                                class="form-control reviewscore reviewscore_<?php echo $hotel->id; ?>"
                                                id="<?php echo $hotel->id; ?>" name="reviews_comfort">
                                                <option value="1"> 1</option>
                                                <option value="2"> 2</option>
                                                <option value="3"> 3</option>
                                                <option value="4"> 4</option>
                                                <option value="5"> 5</option>
                                                <option value="6"> 6</option>
                                                <option value="7"> 7</option>
                                                <option value="8"> 8</option>
                                                <option value="9"> 9</option>
                                                <option value="10"> 10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-5 control-label"><?php echo trans('032'); ?></label>
                                        <div class="col-md-5">
                                            <select
                                                class="form-control reviewscore reviewscore_<?php echo $hotel->id; ?>"
                                                id="<?php echo $hotel->id; ?>" name="reviews_location">
                                                <option value="1"> 1</option>
                                                <option value="2"> 2</option>
                                                <option value="3"> 3</option>
                                                <option value="4"> 4</option>
                                                <option value="5"> 5</option>
                                                <option value="6"> 6</option>
                                                <option value="7"> 7</option>
                                                <option value="8"> 8</option>
                                                <option value="9"> 9</option>
                                                <option value="10"> 10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-5 control-label"><?php echo trans('033'); ?></label>
                                        <div class="col-md-5">
                                            <select
                                                class="form-control reviewscore reviewscore_<?php echo $hotel->id; ?>"
                                                id="<?php echo $hotel->id; ?>" name="reviews_facilities">
                                                <option value="1"> 1</option>
                                                <option value="2"> 2</option>
                                                <option value="3"> 3</option>
                                                <option value="4"> 4</option>
                                                <option value="5"> 5</option>
                                                <option value="6"> 6</option>
                                                <option value="7"> 7</option>
                                                <option value="8"> 8</option>
                                                <option value="9"> 9</option>
                                                <option value="10"> 10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-5 control-label"><?php echo trans('034'); ?></label>
                                        <div class="col-md-5">
                                            <select
                                                class="form-control reviewscore reviewscore_<?php echo $hotel->id; ?>"
                                                id="<?php echo $hotel->id; ?>" name="reviews_staff">
                                                <option value="1"> 1</option>
                                                <option value="2"> 2</option>
                                                <option value="3"> 3</option>
                                                <option value="4"> 4</option>
                                                <option value="5"> 5</option>
                                                <option value="6"> 6</option>
                                                <option value="7"> 7</option>
                                                <option value="8"> 8</option>
                                                <option value="9"> 9</option>
                                                <option value="10"> 10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="col-md-6" style="padding-left: 0px;">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading"><strong><?php echo trans('0350'); ?></strong></div>
                                        <input class="form-control form" type="text" name="fullname"
                                               placeholder="<?php echo trans('0390'); ?> <?php echo trans('0350'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-right: 0px;">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading"><strong><?php echo trans('094'); ?></strong></div>
                                        <input class="form-control form" type="text" name="email"
                                               placeholder="<?php echo trans('0390'); ?> <?php echo trans('094'); ?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong><?php echo trans('0446'); ?></strong></div>
                                    <select multiple class="chosen-multi-select" name="reviews_contexts[]">
                                        <option value="28">Ngữ cảnh 1</option>
                                        <option value="29">Ngữ cảnh 2</option>
                                        <option value="30">Ngữ cảnh 3</option>
                                        <option value="31">Ngữ cảnh 4</option>
                                        <option value="32">Ngữ cảnh 5</option>
                                        <option value="33">Ngữ cảnh 6</option>
                                    </select>
                                </div>

                                <div class="clearfix"></div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong><?php echo trans('0381'); ?></strong></div>
                                    <textarea class="form-control form" type="text" placeholder="Nội dung bình luận"
                                              name="reviews_comments" id="" cols="30" rows="5"></textarea>
                                </div>
                                <p class="text-danger"><strong><?php echo trans('0371'); ?></strong>
                                    : <?php echo trans('085'); ?>.</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="addreview" value="1"/>
                    <input type="hidden" name="overall" id="overall_<?php echo $hotel->id; ?>" value="1"/>
                    <input type="hidden" name="reviewmodule" value="hotels"/>
                    <input type="hidden" name="reviewfor" value="<?php echo $hotel->id; ?>"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234'); ?></button>
                <button type="button" class="btn btn-primary addreview" id="<?php echo $hotel->id; ?>"><i
                        class="fa fa-save"></i> <?php echo trans('086'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.chosen-select').select2( { width:'100%', maximumSelectionSize: 1 } );
        $(document).ready(function() {
            $(".chosen-multi-select").select2( { width:'100%', } ); }); }); function slideout(){ setTimeout(function(){
        $(".alert-success").fadeOut("slow", function () { });
        $(".alert-danger").fadeOut("slow", function () { }); }, 4000);}
</script>
<!-Comments Modal-->

<script type="text/javascript">
    $(function () {
        $('.reviewscore').change(function () {
            var sum = 0;
            var avg = 0;
            var id = $(this).attr("id");
            $('.reviewscore_' + id + ' :selected').each(function () {
                sum += Number($(this).val());
            });
            avg = sum / 5;
            $("#avgall_" + id).html(avg);
            $("#overall_" + id).val(avg);
        });

        //submit review
        $(".addreview").on("click", function () {
            var id = $(this).prop("id");
            $.post("<?php echo base_url();?>admin/ajaxcalls/postreview", $("#reviews-form-" + id).serialize(), function (resp) {
                var response = $.parseJSON(resp);
                // alert(response.msg);
                $("#review_result" + id).html("<div class='alert " + response.divclass + "'>" + response.msg + "</div>").fadeIn("slow");
            });

            setTimeout(function () {

                $("#review_result" + id).fadeOut("slow");

            }, 3000);

        });

    })
</script>
<script type="text/javascript">
    $(function () {
        // Add/remove wishlist
        $(".wish").on('click', function () {
            var loggedin = $("#loggedin").val();
            var removelisttxt = $("#removetxt").val();
            var addlisttxt = $("#addtxt").val();
            var title = $("#itemid").val();
            var module = $("#module").val();
            if (loggedin > 0) {
                if ($(this).hasClass('addwishlist')) {
                    var confirm1 = confirm("<?php echo trans('0437');?>");
                    if (confirm1) {
                        $(".wish").removeClass('addwishlist btn-primary');
                        $(".wish").addClass('removewishlist btn-warning');
                        $(".wishtext").html(removelisttxt);
                        $.post("<?php echo base_url();?>account/wishlist/add", {
                            loggedin: loggedin,
                            itemid: title,
                            module: module
                        }, function (theResponse) {
                        });

                    }
                    return false;

                } else if ($(this).hasClass('removewishlist')) {
                    var confirm2 = confirm("<?php echo trans('0436');?>");
                    if (confirm2) {
                        $(".wish").addClass('addwishlist btn-primary');
                        $(".wish").removeClass('removewishlist btn-warning');
                        $(".wishtext").html(addlisttxt);
                        $.post("<?php echo base_url();?>account/wishlist/remove", {
                            loggedin: loggedin,
                            itemid: title,
                            module: module
                        }, function (theResponse) {
                        });
                    }
                    return false;

                }
            } else {
                alert('Please Login to add to wishlist.');
            }
        });
        // End Add/remove wishlist
    })
    // End document ready
</script>
