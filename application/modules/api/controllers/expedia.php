<?php
header('Access-Control-Allow-Origin: *');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/api/libraries/REST_Controller.php';

class Expedia extends REST_Controller {
		public $cid;
		public $ci;
		public $rev;
		public $apiKey;
		public $local;
		public $currency;
		public $customerUserAgent;
		public $customerIpAddress;
		public $apiurl;
		public $bookingurl;
		public $apistr;
		public $secret;
		private $city;
		public $settings = array();
        public $numberofresults;

		function __construct($_apiKey = "n2cxz49a5vd9u9verw3afva7", $_local = "en_US", $_currency = "USD") {
// Construct our parent class
				parent :: __construct();
// Configure limits on our controller methods. Ensure
// you have created the 'limits' table and enabled 'limits'
// within application/config/rest.php
				$this->ci = & get_instance();
				$this->ci->load->model('admin/settings_model');
				$this->ci->load->model("ean/ean_model");
				$configdata = $this->ci->settings_model->get_front_settings("ean");
				$citydef = $configdata[0]->front_search_city;
                $this->numberofresults = $configdata[0]->front_listings;
				$this->city = $this->ean_model->get_city_name($citydef);
				if ($configdata[0]->testing_mode == "0") {
//  $this->apiurl = "http://api.ean.com/ean-services/rs/hotel/v3/";
						$this->apiurl = "http://api.eancdn.com/ean-services/rs/hotel/v3/";
						$this->bookingurl = "https://book.api.ean.com/ean-services/rs/hotel/v3/res?";
				}
				else {
						$this->apiurl = "http://dev.api.ean.com/ean-services/rs/hotel/v3/";
						$this->bookingurl = "https://dev.api.ean.com/ean-services/rs/hotel/v3/res?";
				}
				$this->cid = $configdata[0]->cid;
				$this->rev = '28';
				$this->apiKey = $configdata[0]->apikey;
				$this->secret = $configdata[0]->secret;
				$this->local = $this->get('locale');
				$this->currency = $configdata[0]->currency;
				$this->customerUserAgent = trim($_SERVER['HTTP_USER_AGENT']);
				$this->customerIpAddress = trim($this->ci->input->ip_address());
		}

/*
* function for API call using curl
*/
		function apiCall($url) {
				$url = str_replace(" ", '%20', $url);
// url encode for space
//            $ch=curl_init($url);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            $r=curl_exec($ch);
//            curl_close($ch);
//            $response = json_decode($r,true);
				$header[] = "Accept: application/json";
				$header[] = "Accept-Encoding: gzip";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_ENCODING, "gzip");
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = json_decode(curl_exec($ch));
				$curlinfo = curl_getinfo($ch);
//          echo "<pre>";
//          print_r($curlinfo);
				if (array_key_exists('EanWsError', $response)) {
						echo "<pre>";
						print_r($response);
						echo "<pre>";
						die();
				}
				else {
						return $response;
				}
		}

/*
* function for API call using curl POST
*/
		function apiPostCall($url, $data) {
				$url = str_replace(" ", '%20', $url);
				$fields = array(
                'cid' => $this->cid,
                'apiKey' => $this->apiKey,
                'customerUserAgent' => urlencode($this->customerUserAgent),
                'customerIpAddress' => urlencode($this->customerIpAddress),
                'customerSessionId' => urlencode($data['customerSessionId']),
                'locale' => $this->local,
                'currencyCode' => $this->currency,
                'hotelId' => $data['hotelId'],
                'arrivalDate' => $data['checkIn'],
                'departureDate' => $data['checkOut'],
                'supplierType' => E,
                'rateKey' => $data['ratekey'],
                'roomTypeCode' => $data['roomType'],
                'rateCode' => $data['rateCode'],
                'chargeableRate' => $data['total'],
                'room1' => $data['adults'],
                'room1FirstName' => urlencode($data['firstName']),
                'room1LastName' => urlencode($data['lastName']),
                'firstName' => urlencode($data['firstName']),
                'lastName' => urlencode($data['lastName']),
                'email' => $data['email'],
                'creditCardType' => $data['cardType'],
                'creditCardNumber' => $data['cardNumber'],
                'creditCardIdentifier' => $data['cvv'],
                'creditCardExpirationMonth' => $data['cardExpirationMonth'],
                'creditCardExpirationYear' => $data['cardExpirationYear'],
                'address1' => $data['address'],
                'city' => $data['city'],
                'homePhone' => $data['phone'],
                'stateProvinceCode' => $data['state'],
                'countryCode' => $data['country'],
                'postalCode' => $data['postal']
                );
//url-ify the data for the POST
				foreach ($fields as $key => $value) {
						$fields_string .= $key . '=' . $value . '&';
				}
				rtrim($fields_string, '&');
// url encode for space
//            $ch=curl_init($url);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            $r=curl_exec($ch);
//            curl_close($ch);
//            $response = json_decode($r,true);
				$ch = curl_init();
				$timeout = 3;
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ch, CURLOPT_POST, count($fields));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$rawdata = curl_exec($ch);
				curl_close($ch);
				@ $response = json_decode($rawdata);
				if (array_key_exists('EanWsError', $response)) {
						echo "<pre>";
						print_r($response);
						echo "<pre>";
						die();
				}
				else {
						return $response;
				}
		}

/*
* funtion to get the list of hotels
*/
		function HotelListsDateless($arrayInfo) {
				$city = $arrayInfo['city'];
				$cityId = array_key_exists('cityId', $arrayInfo) ? $arrayInfo['cityId'] : '';
				$countryCode = $arrayInfo['countryCode'];
				$rooms = $arrayInfo['rooms'];
				$numberOfResult = array_key_exists('numberOfResult', $arrayInfo) ? $arrayInfo['numberOfResult'] : 10;
/*filtering
* please check the Filtering Methods section for compleate list http://developer.ean.com/docs/read/hotel_list
*/
				$propertyCategory = array_key_exists('propertyCategory', $arrayInfo) ? $arrayInfo['propertyCategory'] : '';
				$amenities = array_key_exists('amenities', $arrayInfo) ? $arrayInfo['amenities'] : '';
				$maxStarRating = array_key_exists('maxStarRating', $arrayInfo) ? $arrayInfo['maxStarRating'] : '';
				$minStarRating = array_key_exists('minStarRating', $arrayInfo) ? $arrayInfo['minStarRating'] : '';
				$minRate = array_key_exists('minRate', $arrayInfo) ? $arrayInfo['minRate'] : '';
				$maxRate = array_key_exists('maxRate', $arrayInfo) ? $arrayInfo['maxRate'] : '';
/*
* sorting
* please check the Sorting Options section for compleate list http://developer.ean.com/docs/read/hotel_list
*
*/
				$sort = $arrayInfo['sort'] = array_key_exists('sort', $arrayInfo) ? $arrayInfo['sort'] : 'NO_SORT';
				$str = $this->apiurl . 'list?minorRev=' . $this->rev . '&cid=' . $this->cid . '&apiKey=' . $this->apiKey . '&customerSessionId&customerUserAgent&customerIpAddress&locale=' . $this->local . '&currencyCode=' . $this->currency . '&city=' . $city . '&destinationId=' . $cityId . '&countryCode=' . $countryCode . '&propertyCategory=' . $propertyCategory . '&amenities=' . $amenities . '&maxStarRating=' . $maxStarRating . '&minStarRating=' . $minStarRating . '&minRate=' . $minRate . '&maxRate' . $maxRate . '&sort=' . $sort . '&supplierCacheTolerance=MED&arrivalDate=' . $checkIn . '&departureDate=' . $checkOut . '&' . $rooms . '&numberOfResults=' . $numberOfResult . '&supplierCacheTolerance=MED_ENHANCED';
				return $this->apiCall($str);
		}

/*
* funtion to get the list of hotels
*/
		function list_get() {
				$checkin = date("m/d/Y", strtotime("+1 days"));
				$checkout = date("m/d/Y", strtotime("+2 days"));
				$this->data['checkin'] = $checkin;
				$this->data['checkout'] = $checkout;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$adults = 1;
				$this->data['adults'] = $adults;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$arrayInfo['rooms'] = "room1=$adults";
//	$arrayInfo['numberOfResult'] = $this->numberofresults;
				$city = $arrayInfo['city'];
				$cityId = array_key_exists('destinationId', $arrayInfo) ? $arrayInfo['destinationId'] : '';
// $countryCode = $arrayInfo['countryCode'];
				$checkIn = $arrayInfo['checkIn'];
				$checkOut = $arrayInfo['checkOut'];
				$rooms = $arrayInfo['rooms'];
				$numberOfResult =  $this->numberofresults;//array_key_exists('numberOfResult', $arrayInfo) ? $arrayInfo['numberOfResult'] : 10;
/*filtering
* please check the Filtering Methods section for compleate list http://developer.ean.com/docs/read/hotel_list
*/
				$propertyCategory = array_key_exists('propertyCategory', $arrayInfo) ? $arrayInfo['propertyCategory'] : '';
				$amenities = array_key_exists('amenities', $arrayInfo) ? $arrayInfo['amenities'] : '';
				$maxStarRating = array_key_exists('maxStarRating', $arrayInfo) ? $arrayInfo['maxStarRating'] : '';
				$minStarRating = array_key_exists('minStarRating', $arrayInfo) ? $arrayInfo['minStarRating'] : '';
				$minRate = array_key_exists('minRate', $arrayInfo) ? $arrayInfo['minRate'] : '';
				$maxRate = array_key_exists('maxRate', $arrayInfo) ? $arrayInfo['maxRate'] : '';
/*
* sorting
* please check the Sorting Options section for compleate list http://developer.ean.com/docs/read/hotel_list
*
*/
				$sort = $arrayInfo['sort'] = array_key_exists('sort', $arrayInfo) ? $arrayInfo['sort'] : 'NO_SORT';
				$str = $this->apiurl . 'list?minorRev=' . $this->rev . '&cid=' . $this->cid . '&apiKey=' . $this->apiKey . '&customerSessionId&customerUserAgent&customerIpAddress&locale=' . $this->local . '&currencyCode=' . $this->currency . '&city=' . $city . '&arrivalDate=' . $checkIn . '&departureDate=' . $checkOut . '&' . $rooms .
//   '&city='.$city.'&arrivalDate='.$checkIn.'&departureDate='.$checkOut.'&'.$rooms.
				'&numberOfResults='.$numberOfResult.'&destinationId=' . $cityId;
//  '&countryCode='.$countryCode.
//  '&propertyCategory='.$propertyCategory.
//  '&amenities='.$amenities.
//  '&maxStarRating='.$maxStarRating.
//  '&minStarRating='.$minStarRating.
//   '&minRate='.$minRate.
//   '&maxRate'.$maxRate.
//   '&sort='.$sort.
//   '&supplierCacheTolerance=MED&arrivalDate='.$checkIn.
//    '&supplierCacheTolerance=MED_ENHANCED';

				$this->apistr = $str;

				$this->response($this->apiCall($str), 200);
		}

/*
* funtion to get the list of hotels by search
*/
		function search_get() {

				$city = $this->get('location');
                $adults =  $this->get('adults');
				$checkIn = $this->get('checkIn');
				$checkOut = $this->get('checkOut');
				$did = $this->get('destinationId');

				$rooms = "room1=$adults";
                $numberOfResult =  $this->numberofresults;
			   //	$numberOfResult = array_key_exists('numberOfResult', $arrayInfo) ? $arrayInfo['numberOfResult'] : 10;
/*filtering
* please check the Filtering Methods section for compleate list http://developer.ean.com/docs/read/hotel_list
*/
			  /*
* sorting
* please check the Sorting Options section for compleate list http://developer.ean.com/docs/read/hotel_list
*
*/             $str = $this->apiurl . 'list?minorRev=' . $this->rev . '&cid=' . $this->cid . '&apiKey=' . $this->apiKey . '&customerSessionId&customerUserAgent&customerIpAddress&locale=' . $this->local . '&currencyCode=' . $this->currency . '&city=' . $city . '&arrivalDate=' . $checkIn . '&departureDate=' . $checkOut . '&' . $rooms.'&numberOfResults='.$numberOfResult .'&destinationId=' . $did;
				$this->apistr = $str;
				$this->response($this->apiCall($str), 200);
		}

/*
* function to get hotelList more page
*/
		function listMore_get() {
				$customerSessionId = trim($this->get('customerSessionId'));
				$cacheKey = trim($this->get('cacheKey'));
				$cacheLocation = trim($this->get('cacheLocation'));
				$str = $this->apiurl . "list?minorRev=21&cid=" . $this->cid . "&apiKey=" . $this->apiKey . "&customerUserAgent=" . $this->customerUserAgent . "customerIpAddress=" . $this->customerIpAddress . "&customerSessionId=" . $customerSessionId . "&locale=" . $this->local . "&currencyCode=" . $this->currency . "&cacheKey=" . $cacheKey . "&cacheLocation=" . $cacheLocation;
				$this->apistr = $str;
                $this->response($this->apiCall($str), 200);
		}

/*
* function to get hoteldetails
*/
		function hoteldetails_get() {
				$hotelId = $this->get('hotelId');
				$customerSessionId = $this->get('customerSessionId');
				$checkIn = $this->get('checkIn');
				$checkOut = $this->get('checkOut');
				$roomcode = $this->get('roomTypeCode');
				$ratekey = $this->get('rateKey');
				$ratecode = $this->get('rateCode');
				$adults = $this->input->get('adults');
				$rooms = "room1=$adults";
				$str1 = $this->apiurl . "info?minorRev=" . $this->rev . "&cid=" . $this->cid . "&apiKey=" . $this->apiKey . "&customerUserAgent=" . $this->customerUserAgent . "&customerIpAddress=" . $this->customerIpAddress . "&customerSessionId=" . $customerSessionId . "&locale=" . $this->local . "&currencyCode=" . $this->currency . "&hotelId=" . $hotelId . "&options=0";
				$response['response']['hoteldata'] = $this->apiCall($str1);
//rooms availability info
				$str2 = $this->apiurl . "avail?minorRev=" . $this->rev . "&cid=" . $this->cid . "&apiKey=" . $this->apiKey . "&customerUserAgent=" . $this->customerUserAgent . "&customerIpAddress=" . $this->customerIpAddress . "&customerSessionId=" . $customerSessionId . "&locale=" . $this->local . "&currencyCode=" . $this->currency . "&hotelId=" . $hotelId . "&arrivalDate=" . $checkIn . "&departureDate=" . $checkOut . "&roomTypeCode=" . $roomcode . "&rateKey=" . $ratekey . "&rateCode=" . $ratecode . "&includeDetails=true&includeRoomImages=true&options=ROOM_TYPES,ROOM_AMENITIES&" . $rooms;
				$response['response']['roomsdata'] = $this->apiCall($str2);
				$this->response($response, 200);
		}

        function getCardTypes_get(){
            //TODO
            $hotelId = $this->get('hotelId');
            $customerSessionId = $this->get('customerSessionId');
            $ratekey = $this->get('rateKey');

            $str = $this->apiurl."paymentInfo?minorRev=".$this->rev."&cid=".$this->cid.
                    "&apiKey=".$this->apiKey.
                    "&customerUserAgent=".$this->customerUserAgent.
                    "&customerIpAddress=".$this->customerIpAddress.
                    "&customerSessionId=".$customerSessionId.
                    "&hotelId=".$hotelId.
                    "&rateKey=".$ratekey;
            $this->response($this->apiCall($str), 200);
        }



/*
* function to book hotel room Reservation
*/
		function proceedBooking_post() {
		  $this->response($this->apiPostCall($this->bookingurl, $this->post()), 200);
		  // $this->response($this->post(), 200);
		}

}