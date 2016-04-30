$(function(){

  $(".makeDefault").on('click',function(){
  var id = $(this).attr('id');
  var baseurl =  $(this).data('url');
  var answer = confirm("Are you sure you want it Default?");
  if (answer){
     $.post(baseurl, { id: id }, function(theResponse){
          location.reload();
			});
  }

  });

  $(".fstar").on('click',function(){
  var id = $(this).prop('id');
  var url = $(this).data('url');
  var ft = $(this).data('featured');
  if(ft == "no"){
     $(this).removeClass('fa-star');
     $(this).addClass('fa-star-o');
     $(this).data('featured',"yes");
  }else{
     $(this).removeClass('fa-star-o');
     $(this).addClass('fa-star');
     $(this).data('featured',"no");
  }
   $.post(url, { isfeatured: ft, id: id }, function(theResponse){  });
  showNotify();
 })



})

 function updateOrder(order,id,olderval){
   var url = $("#order_"+id).data('url');   

    if(order != olderval){
     $.post(url, { order: order,id: id }, function(theResponse){
        if(theResponse == '1'){
            showNotify();
        }else{
        alert('Invalid Order');
        $("#order_"+id).val(olderval);
   }

  	});
  }


  }

  function showNotify(){
     new PNotify({
                      title: 'Changes Saved!',
                      type: 'info',
                      animation: 'fade'
                      });
  }

  function getReviewScore(score){

var sum = 0;
var avg = 0;

$('option:selected').each(function() {
  val = $(this).val();
  if(val != "No"){
sum += parseInt(val);

  }
 console.log(sum);
});
avg = sum/5;

$("#overall").val(avg);
  }

  function delfunc(id,baseurl){

  var answer = confirm("Are you sure you want to delete?");
  if (answer){
     $.post(baseurl, { id: id }, function(theResponse){
                 location.reload();
      });

  }
  return false;
  
  }


function approvefunc(id,baseurl){

  var answer = confirm("Are you sure you want to proceed with this action?");
  if (answer){
     $.post(baseurl, { id: id }, function(theResponse){
                 location.reload();
      });

  }
  return false;
  
  }

  function hideBooking(id,baseurl){ 

     $.post(baseurl, { id: id }, function(theResponse){
               
      });
     $("#"+id).fadeOut("slow");

  
  }
