<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('invoiceDetails'))
{
    function invoiceDetails($id,$ref)
    {
      $CI = get_instance();
        $CI->db->select('pt_bookings.*,pt_accounts.ai_mobile,pt_accounts.accounts_id,pt_accounts.ai_country,pt_accounts.accounts_email,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.ai_address_1,pt_accounts.ai_address_2');
        $CI->db->where('pt_bookings.booking_id',$id);
        $CI->db->where('pt_bookings.booking_ref_no',$ref);
        $CI->db->join('pt_accounts','pt_bookings.booking_user = pt_accounts.accounts_id','left');
        $invoiceData = $CI->db->get('pt_bookings')->result();
        $bookingsubitem = json_decode($invoiceData[0]->booking_subitem);
        $bookingExtras = json_decode($invoiceData[0]->booking_extras);
        $bookingExtrasInfo = array();
        $subItemData = "";
        $itemData = "";
        $fullExpiry =  date('F j Y',$invoiceData[0]->booking_expiry);
         foreach($bookingExtras as $bext){
          $extTitle = getExtraTitle($bext->id);
          $bookingExtrasInfo[] = (object)array("id" => $bext->id,"title" => $extTitle,"price" => $bext->price);
        }
        if($invoiceData[0]->booking_type == 'hotels'){
          $CI->load->library('hotels/hotels_lib');
          $CI->hotels_lib->set_id($invoiceData[0]->booking_item);
          $CI->hotels_lib->hotel_short_details();
          $itemData = array(
            "title" => $CI->hotels_lib->title,
            'thumbnail' => $CI->hotels_lib->thumbnail,
            'stars' => pt_create_stars($CI->hotels_lib->stars), 
            'location' => $CI->hotels_lib->location,  
            );
          $roomTitle = $CI->hotels_lib->getRoomTitleOnly($bookingsubitem->id);
          $subItemData = (object)array(
            'id' => $bookingsubitem->id,
            'title' => $roomTitle,
            'price' => $bookingsubitem->price,
            'quantity' => $bookingsubitem->count,
            'totalNightsPrice' => $bookingsubitem->price * $bookingsubitem->count * $invoiceData[0]->booking_nights,
            'total' => $bookingsubitem->price * $bookingsubitem->count);


        }

        $returnData = (object)array("id" => $invoiceData[0]->booking_id, 
          "module" => $invoiceData[0]->booking_type,
          "itemid" => $invoiceData[0]->booking_item,
          "paymethod" => $invoiceData[0]->booking_payment_type,
          "code" => $invoiceData[0]->booking_ref_no,
          "nights" => $invoiceData[0]->booking_nights,
          "checkin" => fromDbToAppFormatDate($invoiceData[0]->booking_checkin),
          "checkout" => fromDbToAppFormatDate($invoiceData[0]->booking_checkout),
          "date" => pt_show_date_php($invoiceData[0]->booking_date),
          "currCode" => $invoiceData[0]->booking_curr_code,
          "currSymbol" => $invoiceData[0]->booking_curr_symbol,
          "checkoutAmount" => $invoiceData[0]->booking_deposit,
          "checkoutTotal" => $invoiceData[0]->booking_total,
          "status" => $invoiceData[0]->booking_status,
          "accountEmail" => $invoiceData[0]->accounts_email,
          "bookingID" => $invoiceData[0]->booking_id,
          "expiry" => pt_show_date_php($invoiceData[0]->booking_expiry),
          "expiryUnixtime" => $invoiceData[0]->booking_expiry,
          "bookingDate" => pt_show_date_php($invoiceData[0]->booking_date),
          "title" => $itemData['title'],
          "thumbnail" => $itemData['thumbnail'],
          "stars" => $itemData['stars'],
          "location" => $itemData['location'],
          "nights" => $invoiceData[0]->booking_nights,
          "tax" => $invoiceData[0]->booking_tax,
          "subItem" => $subItemData,
          "extraBeds" => $invoiceData[0]->booking_extra_beds,
          "extraBedsCharges" => $invoiceData[0]->booking_extra_beds_charges,
          "cancelRequest" => $invoiceData[0]->booking_cancellation_request,
          "expiryFullDate" => $fullExpiry,
          "reviewsData" => $reviewData,
          "bookingExtras" => $bookingExtrasInfo,
          "amountPaid" => $invoiceData[0]->booking_amount_paid,
          "bookingUser" => $invoiceData[0]->booking_user,
          "userCountry" => $invoiceData[0]->ai_country,
          "userFullName" => $invoiceData[0]->ai_first_name . " " . $invoiceData[0]->ai_last_name,
          "userMobile" => $invoiceData[0]->ai_mobile,
          "remainingAmount" => $invoiceData[0]->booking_remaining

          );

          return $returnData;


    }
}

if ( ! function_exists('pt_get_einvoice_details'))
{
    function pt_get_einvoice_details($id,$itid)
    {
    $CI = get_instance();
    $CI->db->select('pt_ean_booking.*,pt_accounts.ai_mobile,pt_accounts.accounts_id,pt_accounts.ai_country,pt_accounts.accounts_email,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.ai_address_1,pt_accounts.ai_address_2');
    $CI->db->where('pt_ean_booking.book_id',$id);
    $CI->db->where('pt_ean_booking.book_itineraryid',$itid);
    $CI->db->join('pt_accounts','pt_ean_booking.book_user = pt_accounts.accounts_id','left');
    return $CI->db->get('pt_ean_booking')->result();


    }
}

if(! function_exists('updateInvoiceStatus')){
  function updateInvoiceStatus($invoiceid,$amount,$txnid,$paymethod,$status,$module,$totalamount){
    $CI = get_instance();
    $remaining = $totalamount - $amount;
    $bookingdata = array(
      'booking_status' => $status,
      'booking_amount_paid' => $amount,
      'booking_txn_id' => $txnid, 
      'booking_remaining' => $remaining, 
      'booking_payment_type' => $paymethod 
      );
    $CI->db->where('booking_id',$invoiceid);
    $CI->db->update('pt_bookings',$bookingdata);

    if($module == "hotels"){
    $roombookingdata = array("booked_booking_status" => $status);
    $CI->db->where('booked_booking_id', $invoiceid);
    $CI->db->update('pt_booked_rooms',$roombookingdata);
    }


  }
}

if ( ! function_exists('pt_get_selected_rooms'))
{
    function pt_get_selected_rooms($roomstring)
    {
      $CI = get_instance();
       $eachroom = explode(",",$roomstring);
       $detail = array();
       foreach($eachroom as $er){

         $detail[] = explode("_",$er);

       }

       return $detail;

    }
}



if ( ! function_exists('pt_get_room_title'))
{
    function pt_get_room_title($id)
    {
      $CI = get_instance();

$CI->db->select('room_title');
$CI->db->where('room_id',$id);
$res = $CI->db->get('pt_rooms')->result();
  return $res[0]->room_title;

    }
}




if ( ! function_exists('pt_booked_extras'))
{
    function pt_booked_extras($id)
    {
      $CI = get_instance();
   $result = array();
$CI->db->select('extras_title,extras_discount,extras_basic_price');
$CI->db->where('extras_id',$id);
$res = $CI->db->get('pt_extras')->result();
if(!empty($res)){

$result['title'] = $res[0]->extras_title;
if($res[0]->extras_discount > 0){

$result['price'] = $res[0]->extras_discount;


}else{

$result['price'] = $res[0]->extras_basic_price;


}

}
return $result;

  }
}



if ( ! function_exists('pt_tax_details'))
{
    function pt_tax_details($type,$id)
    {
    $deftax = 0;
   $deftype = 'fixed';

   $CI = get_instance();
   $result = array();
   $CI->db->select('front_tax_fixed,front_tax_percentage');
   $CI->db->where('front_for',$type);
   $defaultsettings = $CI->db->get('pt_front_settings')->result();

   if($defaultsettings[0]->front_tax_fixed > 0){
   $deftax = $defaultsettings[0]->front_tax_fixed;
   $deftype = 'fixed';

   }elseif($defaultsettings[0]->front_tax_percentage > 0){

    $deftax = $defaultsettings[0]->front_tax_percentage;
   $deftype = 'percentage';

   }



   if($type == "hotels"){

   $CI->db->select('hotel_title,hotel_tax_fixed,hotel_tax_percentage');
   $CI->db->where('hotel_id',$id);
   $hotel = $CI->db->get('pt_hotels')->result();
   $result['title'] = $hotel[0]->hotel_title;

   if($hotel[0]->hotel_tax_fixed > 0){
   $result['tax'] = $hotel[0]->hotel_tax_fixed;
   $result['tax_type'] = 'fixed';

   }elseif($hotel[0]->hotel_tax_percentage > 0){

   $result['tax'] = $hotel[0]->hotel_tax_percentage;
   $result['tax_type'] = 'percentage';

   }else{

   $result['tax'] = $deftax;
   $result['tax_type'] = $deftype;


   }


   }elseif($type == "tours"){
   $CI->db->select('tour_title,tour_tax_fixed,tour_tax_percentage');
   $CI->db->where('tour_id',$id);
   $tour = $CI->db->get('pt_tours')->result();
   $result['title'] = $tour[0]->tour_title;

   if($tour[0]->tour_tax_fixed > 0){
   $result['tax'] = $tour[0]->tour_tax_fixed;
   $result['tax_type'] = 'fixed';

   }elseif($tour[0]->tour_tax_percentage > 0){

   $result['tax'] = $tour[0]->tour_tax_percentage;
   $result['tax_type'] = 'percentage';

   }else{

   $result['tax'] = $deftax;
   $result['tax_type'] = $deftype;


   }



   }elseif($type == "cars"){
   $CI->db->select('car_title,car_tax_fixed,car_tax_percentage');
   $CI->db->where('car_id',$id);
   $car = $CI->db->get('pt_cars')->result();
   $result['title'] = $car[0]->car_title;

   if($car[0]->tour_tax_fixed > 0){
   $result['tax'] = $car[0]->car_tax_fixed;
   $result['tax_type'] = 'fixed';

   }elseif($car[0]->car_tax_percentage > 0){

   $result['tax'] = $car[0]->car_tax_percentage;
   $result['tax_type'] = 'percentage';

   }else{

   $result['tax'] = $deftax;
   $result['tax_type'] = $deftype;


   }



   }elseif($type == "cruises"){
   $CI->db->select('cruise_title,cruise_tax_fixed,cruise_tax_percentage');
   $CI->db->where('cruise_id',$id);
   $cruise = $CI->db->get('pt_cruises')->result();
   $result['title'] = $cruise[0]->cruise_title;

   if($cruise[0]->cruise_tax_fixed > 0){
   $result['tax'] = $cruise[0]->cruise_tax_fixed;
   $result['tax_type'] = 'fixed';

   }elseif($cruise[0]->cruise_tax_percentage > 0){

   $result['tax'] = $cruise[0]->cruise_tax_percentage;
   $result['tax_type'] = 'percentage';

   }else{

   $result['tax'] = $deftax;
   $result['tax_type'] = $deftype;


   }



   }

return $result;

  }

}


if ( ! function_exists('pt_group_price'))
{
    function pt_group_price($id)
    {
    $CI = get_instance();
$CI->db->select('tour_group_price');
$CI->db->where('tour_id',$id);
$res = $CI->db->get('pt_tours')->result();


return $res[0]->tour_group_price;

  }
}




if ( ! function_exists('pt_total_accomodates'))
{
    function pt_total_accomodates($array)
    {

      $result = array();
      $comsep = explode(",",$array);
      foreach($comsep as $com){
      $items = explode("_",$com);
      $result[$items[0]] = $items[2];

      }
      return $result;

  }
}
