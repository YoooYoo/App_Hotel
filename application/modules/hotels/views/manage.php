<script type="text/javascript">
$(function(){
   var slug = $("#slug").val();
   $(".submitfrm").click(function(){
     var submitType = $(this).prop('id');
          for ( instance in CKEDITOR.instances )

    {

        CKEDITOR.instances[instance].updateElement();

    }
             $(".output").html("");
              $('html, body').animate({

              scrollTop: $('body').offset().top

              }, 'slow');
     if(submitType == "add"){
     url = "<?php echo base_url();?>admin/hotels/add" ;

     }else{
     url = "<?php echo base_url();?>admin/hotels/manage/"+slug;

     }

     $.post(url,$(".hotel-form").serialize() , function(response){
        if($.trim(response) != "done"){
        $(".output").html(response);
        }else{
           window.location.href = "<?php echo base_url().$adminsegment."/hotels/"?>";
        }

        });

   })



})
</script>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>

    <div class="output"></div>
<form action="" method="POST" class="hotel-form" enctype="multipart/form-data" onsubmit="return false;" >
    <div class="panel panel-default">

        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active"><a href="#GENERAL" data-toggle="tab">General</a></li>
            <li class=""><a href="#FACILITIES" data-toggle="tab">Facilities</a></li>
            <li class=""><a href="#META_INFO" data-toggle="tab">Meta Info</a></li>
            <li class=""><a href="#POLICY" data-toggle="tab">Policy</a></li>
            <li class=""><a href="#CONTACT" data-toggle="tab">Contact</a></li>
            <li class=""><a href="#TRANSLATE" data-toggle="tab">Translate</a></li>
        </ul>

        <div class="panel-body">

            <br>
            <div class="tab-content form-horizontal">
                <div class="tab-pane wow fadeIn animated active in" id="GENERAL">


                    <div class="clearfix"></div>
                     <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Status</label>
                        <div class="col-md-2">
                            <select data-placeholder="Select" class="form-control" name="hotelstatus">
                                <option value="yes" <?php if(@$hdata[0]->hotel_status == "yes"){ echo "selected"; }?> >Enabled</option>
                                <option value="no" <?php if(@$hdata[0]->hotel_status == "no"){ echo "selected"; }?> >Disabled</option>

                            </select>
                        </div>
                     </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Hotel Name</label>
                        <div class="col-md-4">
                            <input name="hotelname" type="text" placeholder="Hotel Name" class="form-control" value="<?php echo @$hdata[0]->hotel_title;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Hotel Description</label>
                        <div class="col-md-10">
                         <?php $this->ckeditor->editor('hoteldesc', @$hdata[0]->hotel_desc, $ckconfig,'hoteldesc'); ?>
                         </div>
                    </div>
                     <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Stars</label>
                        <div class="col-md-2">
                            <select data-placeholder="Select" class="form-control" name="hotelstars">
                            <?php for($stars = 1; $stars <= 7;$stars++){ ?>
                                <option value="<?php echo $stars;?>" <?php if(@$hdata[0]->hotel_stars == $stars){ echo 'selected'; } ?> > <?php echo $stars; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                     </div>

                     <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Hotel Type</label>
                        <div class="col-md-2">
                            <select data-placeholder="Select" class="form-control" name="hoteltype">
                            <?php foreach($htypes as $ht){ ?>
                            <option value="<?php echo $ht->sett_id;?>" <?php if(@$hdata[0]->hotel_type == $ht->sett_id){ echo 'selected'; } ?>  ><?php echo $ht->sett_name;?></option>
                            <?php } ?>
                            </select>
                        </div>
                     </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Featured</label>
                        <div class="col-md-2">
                            <select data-placeholder="Select" class="form-control" name="isfeatured">
                                <option value="yes" <?php if(@$hdata[0]->hotel_is_featured == "yes"){ echo 'selected'; } ?>>Yes</option>
                                <option value="no" <?php if(@$hdata[0]->hotel_is_featured == "no"){ echo 'selected'; } ?>>No</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input name="ffrom" type="text" placeholder="From" class="form-control dpd1" value="<?php echo @$featuredfrom; ?>" />
                        </div>

                        <div class="col-md-2">
                            <input name="fto" type="text" placeholder="To" class="form-control dpd2" value="<?php echo @$featuredto; ?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Location</label>
                        <div class="col-md-4">
                            <input type="text" name="hotelcity" class="form-control Places" id="location" placeholder="Location" value="<?php echo @$hdata[0]->hotel_city;?>" />
                        </div>

                        <div class="col-md-2">
                            <input name="longitude" type="text" placeholder="Longitude" id="long" class="form-control" value="<?php echo @$hdata[0]->hotel_longitude;?>" />
                        </div>

                        <div class="col-md-2">
                            <input name="latitude" type="text" placeholder="Latitude" id="lat" class="form-control" value="<?php echo @$hdata[0]->hotel_latitude;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">TripAdvisor</label>
                        <div class="col-md-4">
                            <input type="text" name="tripadvisor" class="form-control" placeholder="TripAdvisor ID" value="<?php echo @$hdata[0]->tripadvisor_id;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left text-success">Deposit / Commission</label>
                        <div class="col-md-2">
                            <select name="deposittype" class="form-control">
                                <option value="fixed" <?php if(@$hoteldeposittype == "fixed"){ echo 'selected'; } ?> >Fixed</option>
                                <option value="percentage" <?php if(@$hoteldeposittype == "percentage"){ echo 'selected'; } ?>>Percentage</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" id="" placeholder="Value" name="depositvalue" value="<?php echo @$hoteldepositval;?>">
                        </div>

                    </div>

                    <div class="row form-group">

                        <label class="col-md-2 control-label text-left text-danger">Vat Tax</label>
                        <div class="col-md-2">
                            <select name="taxtype" class="form-control">
                                <option value="fixed" <?php if(@$hoteltaxtype == "fixed"){ echo 'selected'; } ?> >Fixed</option>
                                <option value="percentage" <?php if(@$hoteltaxtype == "percentage"){ echo 'selected'; } ?> >Percentage</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input class="form-control" id="" Placeholder="Value" type="text" name="taxvalue" value="<?php echo @$hoteltaxval;?>" />
                        </div>

                    </div>

                           <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Related Hotels</label>
                        <div class="col-md-8">
                            <select multiple class="chosen-multi-select" name="relatedhotels[]">
                                <?php foreach($all_hotels as $hotel){ if($hdata[0]->hotel_id != $hotel->hotel_id){ ?>
                                <option value="<?php echo $hotel->hotel_id;?>" <?php  if(in_array($hotel->hotel_id,@$hrelated)){ echo 'selected'; } ?>  >
                                    <?php echo $hotel->hotel_title;?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="tab-pane wow fadeIn animated in" id="FACILITIES">
                    <div class="row form-group">

                        <div class="col-md-12">
                        <div class="col-md-4">
                        <label class="pointer"><input class="all" type="checkbox" name="" value="" id="select_all" > Select All</label>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="clearfix"></div>

                    <?php $hamenity = explode(",",@$hdata[0]->hotel_amenities);
                       foreach($hamts as $hamt){ ?>
                                      <div class="col-md-4">
                                      <label class="pointer"><input class="checkboxcls" <?php if($submittype == "add"){ if( $hamt->sett_selected == "1"){echo "checked";} }else{ if(in_array($hamt->sett_id,$hamenity)){ echo "checked"; } } ?> type="checkbox" name="hotelamenities[]" value="<?php echo $hamt->sett_id;?>"  > <?php echo $hamt->sett_name;?></label>
                                      </div>
                                       <?php } ?>

                        </div>



                    </div>

                </div>

                <div class="tab-pane wow fadeIn animated in" id="META_INFO">
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Meta Title</label>
                        <div class="col-md-6">
                            <input name="hotelmetatitle" type="text" placeholder="Title" class="form-control" value="<?php echo @$hdata[0]->hotel_meta_title;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Meta Keywords</label>
                        <div class="col-md-6">
                            <textarea name="hotelkeywords" placeholder="Keywords" class="form-control" id="" cols="30" rows="2"><?php echo @$hdata[0]->hotel_meta_keywords;?></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Meta Description</label>
                        <div class="col-md-6">
                            <textarea name="hotelmetadesc" placeholder="Description" class="form-control" id="" cols="30" rows="4"><?php echo @$hdata[0]->hotel_meta_desc;?></textarea>
                        </div>
                    </div>


                </div>



                <div class="tab-pane wow fadeIn animated in" id="POLICY">

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Check In</label>
                        <div class="col-md-2">
                            <input name="checkintime" type="text" placeholder="Check In" class="form-control timepicker" data-format="hh:mm A" value="<?php echo $checkin;?>" />
                        </div>
                        <label class="col-md-2 control-label text-left">Check Out</label>
                        <div class="col-md-2">
                            <input name="checkouttime" type="text" placeholder="Check Out" class="form-control timepicker" data-format="hh:mm A" value="<?php echo $checkout;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Payment Options</label>
                        <div class="col-md-6">
                            <select multiple class="chosen-multi-select" name="hotelpayments[]">
                                <?php foreach($hpayments as $hpayment){ ?>
                                <option value="<?php echo $hpayment->sett_id;?>" <?php if($submittype == "add"){ if( $hpayment->sett_selected == "1"){echo "selected";} }else{ if(in_array($hpayment->sett_id,$hotelpaytypes)){ echo "selected"; } } ?> >
                                    <?php echo $hpayment->sett_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Policy And Terms</label>
                        <div class="col-md-8">
                            <textarea name="hotelpolicy" placeholder="Policy..." class="form-control" id="" cols="30" rows="7"><?php echo @$hdata[0]->hotel_policy;?></textarea>
                        </div>
                    </div>

                </div>


                <div class="tab-pane wow fadeIn animated in" id="CONTACT">
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Hotel's Email</label>
                        <div class="col-md-4">
                            <input name="hotelemail" type="text" placeholder="Email" class="form-control " value="<?php echo @$hdata[0]->hotel_email;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Hotel's Website</label>
                        <div class="col-md-4">
                            <input name="hotelwebsite" type="text" placeholder="Website" class="form-control " value="<?php echo @$hdata[0]->hotel_website;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Phone</label>
                        <div class="col-md-4">
                            <input name="hotelphone" type="text" placeholder="Phone" class="form-control" value="<?php echo @$hdata[0]->hotel_phone;?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Full Address</label>
                        <div class="col-md-6">
                            <input name="hoteladdress" type="text" placeholder="Address" class="form-control" value="<?php echo @$hdata[0]->hotel_address;?>" />
                        </div>
                    </div>
                </div>


                <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">

                    <?php foreach($languages as $lang => $val){ if($lang != "en"){ @$trans = getBackHotelTranslation($lang,$hotelid); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val; ?></div>
                        <div class="panel-body">
                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Hotel Name</label>
                                <div class="col-md-4">
                                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Hotel Name" class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Hotel Description</label>
                                <div class="col-md-10">
                                 <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig,"translated[$lang][desc]"); ?>
                                <!--    <textarea name='<?php echo "translated[$lang][desc]"; ?>' placeholder="Description..." class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->trans_desc;?></textarea>   -->
                                </div>
                            </div>

                            <hr>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Meta Title</label>
                                <div class="col-md-6">
                                    <input name='<?php echo "translated[$lang][metatitle]"; ?>' type="text" placeholder="Title" class="form-control" value="<?php echo @$trans[0]->metatitle;?>" />
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Meta Keywords</label>
                                <div class="col-md-6">
                                    <textarea name='<?php echo "translated[$lang][keywords]"; ?>' placeholder="Keywords" class="form-control" id="" cols="30" rows="2"><?php echo @$trans[0]->metakeywords;?></textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Meta Description</label>
                                <div class="col-md-6">
                                    <textarea name='<?php echo "translated[$lang][metadesc]"; ?>' placeholder="Description" class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->metadesc;?></textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Policy And Terms</label>
                                <div class="col-md-8">
                                    <textarea name='<?php echo "translated[$lang][policy]"; ?>' placeholder="Policy..." class="form-control" id="" cols="15" rows="4"><?php echo @$trans[0]->trans_policy;?></textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    <?php } } ?>

                </div>
            </div>
        </div>
        <div class="panel-footer">
        <input type="hidden" id="slug" value="<?php echo @$hdata[0]->hotel_slug;?>" />
        <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
        <input type="hidden" name="hotelid" value="<?php echo @$hotelid;?>" />
            <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Submit</button>
        </div>
    </div>
</form>

  <!-- google places -->
<script type='text/javascript' src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
 var automplete
getPlace_dynamic();
function getPlace_dynamic() {
var input = document.getElementsByClassName('Places');
var location = $("#location").val();
for (i = 0; i < input.length; i++) {
autocomplete = new google.maps.places.Autocomplete(input[i]);

}

google.maps.event.addListener(autocomplete, 'place_changed', function() {

    var place = autocomplete.getPlace();
     $('#lat').val(place.geometry.location.lat());
     $('#long').val(place.geometry.location.lng());

  });

}

});//]]>


</script>

<script>
    $(document).ready(function() {
        if (window.location.hash != "") {
            $('a[href="' + window.location.hash + '"]').click()
        }
    });
</script>
