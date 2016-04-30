 <script src="<?php echo $theme_url; ?>assets/js/bootstrap.min.js"></script>
 <script src="<?php echo $theme_url; ?>assets/js/smooth.js"></script>
 <script src="<?php echo $theme_url; ?>assets/include/owl/lazy/owl.carousel.min.js"></script>
 <script src="<?php echo $theme_url; ?>assets/include/select2/select2.min.js"></script>
 <script src="<?php echo $theme_url; ?>assets/js/jquery.dropdown.js"></script>
 <script src="<?php echo $theme_url; ?>assets/js/ripples.min.js"></script>
 <script src="<?php echo $theme_url; ?>assets/js/material.min.js"></script>

 <script>

 /* material */
 $(function() { $.material.init();  });

 /* lollipop dropdown */
 $(".dropdown").dropdown();

 /* google places starts */
 google.maps.event.addDomListener(window, 'load', function () { var places = new google.maps.places.Autocomplete(document.getElementById('HotelsPlaces')); })
 google.maps.event.addDomListener(window, 'load', function () { var places = new google.maps.places.Autocomplete(document.getElementById('HotelsPlacesEan')); })
 /* google places ends */

 /* start change currency functionality */
 function change_currency(id){
 $("#loadingbg").css("display","block");
 $.post("<?php echo base_url();?>admin/ajaxcalls/changeCurrency", { id: id}, function(theResponse){
 location.reload(); }); }
 /* end change currency functionality */

 /* owl lazy load */
 $(document).ready(function() { $(".owl").owlCarousel({ items : 2, lazyLoad : true,  navigation : true }); });
 /* owl lazy load */

 /* select2 */
 $(function() { $('.chosen-select').select2( { width:'100%', maximumSelectionSize: 1 } ); });
 /* select2 */

 /* wow effects */
 wow = new WOW( { animateClass: 'animated', offset: 100 } ); wow.init();
 /* wow effects */

 /* tooltip */
 $(document).ready(function() { $('[data-toggle=tooltip]').tooltip(); });
 /* tooltip */

 /* datepickr */
 var fmt = "<?php echo $app_settings[0]->date_f_js;?>";
 if (top.location != location) { top.location.href = document.location.href ; }
 $(function(){ window.prettyPrint && prettyPrint(); $('.dob').datepicker({format: fmt,autoclose: true}).on('changeDate', function (ev) {
 $(this).datepicker('hide'); });
 $('#dp1').datepicker();
 $('#dp2').datepicker();

 // disabling dates
 var nowTemp = new Date();
 var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 var checkin = $('.dpd1').datepicker({format: fmt, onRender: function(date) { return date.valueOf() < now.valueOf() ? 'disabled' : ''; } }).on('changeDate', function(ev) {
 if (ev.date.valueOf() > checkout.date.valueOf()) {
 var newDate = new Date(ev.date)
 newDate.setDate(newDate.getDate() + 1); checkout.setValue(newDate); } checkin.hide();
 $('.dpd2')[0].focus(); }).data('datepicker'); var checkout = $('.dpd2').datepicker({format: fmt,
 onRender: function(date) { return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : ''; }
 }).on('changeDate', function(ev) { checkout.hide(); }).data('datepicker'); });
 /* datepickr */

 /* Newsletter subscription */
 (function(){
 $(".sub_newsletter").on('click',function(){
 var email = $(".sub_email").val();
 $.post("<?php echo base_url();?>home/subscribe", { email: email}, function(resp){
 $(".subscriberesponse").html(resp).fadeIn("slow");
 setTimeout(function(){
 $(".subscriberesponse").fadeOut("slow");
 }, 2000); }); }); })();
 /* Newsletter subscription */

 /* map iframe modal */
 function showMap(url,sType){
 if(sType == "modal"){
 $('#mapModal').modal('show')
 $('#mapModal').on('shown.bs.modal', function () {
 $('#mapModal .mapContent').html('<iframe src="'+url+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>'); }); }else{
 $("#"+sType).html('<iframe src="'+url+'" width="100%" height="450" frameborder="0" style="border:0"></iframe>'); } }
 /* map iframe modal */

 /* dropdown on hover */
 $(document).ready(function(){
 $('ul.nav li.dropdown').hover(function() {
 $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200); }, function() {
 $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
 }); });
 /* dropdown on hover */

 </script>
