<?php

class Smsaddonlib
{
    protected $ci       = NULL;
    public $allowedtemps       = array();
    public $testnumber   = "";
    public $url = "";

    function __construct()
    {

       $this->ci = &get_instance();
       $this->testnumber = $this->testmobile();
       $this->allowedtemps = $this->allowed_temps();
    }

    function url(){

       $this->ci->db->select('url');
       $r = $this->ci->db->get('pt_smsaddon')->result();
       return $r[0]->url;
    }

     function allowed_temps(){

       $this->ci->db->select('allowed_templates');
       $r = $this->ci->db->get('pt_smsaddon')->result();
       $temps = explode(",",$r[0]->allowed_templates);
       return $temps;
    }

    function testmobile(){

       $this->ci->db->select('mobile');
       $r = $this->ci->db->get('pt_smsaddon')->result();
       return $r[0]->mobile;
    }

    function api_parameters_and_values($msg = null,$receiver = null){
     $res = $this->ci->db->get('pt_smsaddon')->result();
     $username = $res[0]->username_parameter."=".$res[0]->username_value;
     $password = "&".$res[0]->password_parameter."=".$res[0]->password_value;
     $sender = "&".$res[0]->sender_parameter."=".$res[0]->sender_value;
     $msg = "&".$res[0]->msg_parameter."=".$msg;
     $rec = "&".$res[0]->receiver_parameter."=".$receiver;
     if(!empty($res[0]->opt1_parameter)){
      $opt1 = "&".$res[0]->opt1_parameter."=".$res[0]->opt1_value;
     }else{
      $opt1 = "";
     }

     if(!empty($res[0]->opt2_parameter)){
      $opt2 = "&".$res[0]->opt2_parameter."=".$res[0]->opt2_value;
     }else{
      $opt2 = "";
     }

     if(!empty($res[0]->opt3_parameter)){
      $opt3 = "&".$res[0]->opt3_parameter."=".$res[0]->opt3_value;
     }else{
      $opt3 = "";
     }

    $parameters = "?".$username.$password.$sender.$rec.$msg.$opt1.$opt2.$opt3;
    return $parameters;

    }

    function send_sms($msg,$receiver,$template){
       $message = urlencode($msg);
     if(in_array($template,$this->allowedtemps)){
     $url = $this->url().$this->api_parameters_and_values($message,$receiver);
    $ret = file($url);
   /* return print_r($ret);*/

  //  return $url;
     }else{
       return FALSE;
     }

    }

    function send_test_sms($msg){
    $message = urlencode($msg);
    $url = $this->url().$this->api_parameters_and_values($message,$this->testnumber);
    $ret = file($url);
    return $ret;
    }

     function send_quick_sms($values){
    $singlenumber = $values['mobilenumber'];
    $multiplenumbers = $values['numbers'];

    $message = urlencode($values['message']);
    if(!empty($singlenumber)){
     $url = $this->url().$this->api_parameters_and_values($message,$singlenumber);
    $ret = file($url);
    return $ret;
    }elseif(!empty($multiplenumbers)){

    foreach($multiplenumbers as $multinum){
    $url = $this->url().$this->api_parameters_and_values($message,$multinum);
    $ret = file($url);
    return $ret;
    }


    }


    }




}