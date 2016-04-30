<?php

class myweather {


   protected $ci = NULL;    //codeigniter instance

   private $apikey;
   private $city;

 function __construct() {
     $this->ci = &get_instance();
     $apresult = $this->get_apikey();
     $this->apikey = $apresult['apikey'];
     $this->city = $apresult['city'];

  }
  function get_apikey(){
      $result = array();
    @$res = $this->ci->db->get('pt_weather')->result();

    $result['apikey'] = $res[0]->apikey;
    $result['city'] = $res[0]->city;
    return $result;
  }

  function weather_module_details(){

  return $this->ci->db->get('pt_weather')->result();


  }

  function update_myweather($id,$apikey,$city,$status){

     $data = array(
     'apikey' => $apikey,
     'city' => $city,
     'status' => $status,
     );
     $this->ci->db->where('id',$id);
     $this->ci->db->update('pt_weather',$data);


  }

  function get_weather($count, $customcity = null){
    if($customcity != null){
      $this->city = $customcity;
    }
    $url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$this->city&mode=json&units=metric&cnt=$count&APPID=$this->apikey";


    $ch = curl_init();
    $timeout = 3;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt ($ch, CURLOPT_USERAGENT,
                 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
     @$json = json_decode($rawdata);
     return $json;

  }


}
