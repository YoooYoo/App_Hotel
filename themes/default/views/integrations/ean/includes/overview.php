

        <h4> <strong><i class="fa fa-info-circle text-warning"></i> <?php echo character_limiter($HotelSummary['name'], 55);?> <?php echo trans('046');?> </strong></h4>
         <div class="line2"></div>
        <p> <?php echo html_entity_decode(str_replace("Property Location","",$HotelDetails['propertyDescription']));?></p>

        <h4> <strong><i class="fa fa-coffee text-warning"></i> <?php echo trans('0188');?> </strong></h4>
        <div class="line2"></div>

          <!-- PHPTRAVELS HOTEL AMENTIES -->
               <?php
                if(!empty($Facilities)){  ?>


                  <div class="hpadding20">
                     <div class="col-md-3">
                        <ul class="checklist">
                           <?php $amcount = 0; foreach($Facilities as $ham){ $amcount++; ?>
                           <li><?php echo ucwords($ham['amenity']);?></li>
                           <?php if($amcount % 7 == 0){ ?>
                        </ul>
                     </div>
                     <div class="col-md-3">
                        <ul class="checklist">
                           <?php } } ?>
                        </ul>
                     </div>
                  </div>
                  <div class="clearfix"></div>

               <?php } ?>
               <!-- END PHPTRAVELS HOTEL AMENTIES -->

               <h4> <strong><i class="fa fa-dot-circle-o text-warning"></i> <?php echo trans('0148');?> </strong></h4>
              <div class="line2"></div>


              <div class="rooms-body panel-body">

                  <!-- PHPTRAVELS DESCRIPTION -->
                  <p>
                  <table width="100%">
                     <tbody>
                        <tr>
                          <th><?php echo trans('07');?> :      <?php echo $HotelDetails['checkInTime'];?>        </th>
                           <th><?php echo trans('09');?> :    <?php echo $HotelDetails['checkOutTime'];?>      </th>
                        </tr>
                     </tbody>
                  </table>
                  </p>
                  <!-- END PHPTRAVELS DESCRIPTION -->

               <div class="line2"></div>
                     <!-- PHPTRAVELS Terms & Conditions-->

               <button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#TermsConditions">
               CheckIn Instructions <span class="collapsearrow"></span>
               </button>
               <div id="TermsConditions" class="collapse in">
                  <div class="hpadding20">
                     <?php echo $HotelDetails['checkInInstructions'];?>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="line2"></div>

               <!-- END of PHPTRAVELS Terms & Conditions -->

               <!-- PHPTRAVELS MAIN POLICY-->

               <button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#MAINPOLICY">
               <?php echo trans('056');?> <span class="collapsearrow"></span>
               </button>
               <div id="MAINPOLICY" class="collapse in">
                  <div class="hpadding20">
                 <?php echo html_entity_decode($HotelDetails['hotelPolicy']);?>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="line2"></div>
               <!-- END of PHPTRAVELS PHPTRAVELS MAIN POLICY -->
               <br>
            </div>





