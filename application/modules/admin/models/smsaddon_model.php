<?php
class Smsaddon_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function update_details(){
    $temps = implode(",",$this->input->post('temps'));
    $mobile = $this->input->post('mobile');
    $status = $this->input->post('status');
    $url = $this->input->post('url');
  //  $burl = $this->input->post('burl');
    $msg_parameter = $this->input->post('msg_parameter');
    $receiver_parameter = $this->input->post('receiver_parameter');
    $sender_parameter = $this->input->post('sender_parameter');
    $sender_value = $this->input->post('sender_value');
    $username_parameter = $this->input->post('username_parameter');
    $username_value = $this->input->post('username_value');
    $password_parameter = $this->input->post('password_parameter');
    $password_value = $this->input->post('password_value');
    $optional1_parameter = $this->input->post('optional1_parameter');
    $optional1_value = $this->input->post('optional1_value');
    $optional2_parameter = $this->input->post('optional2_parameter');
    $optional2_value = $this->input->post('optional2_value');
    $optional3_parameter = $this->input->post('optional3_parameter');
    $optional3_value = $this->input->post('optional3_value');

    $data = array(

    'mobile' => $mobile,
    'url' => $url,
  //  'balance_url' => $burl,
    'msg_parameter' => $msg_parameter,
    'receiver_parameter' => $receiver_parameter,
    'sender_parameter' => $sender_parameter,
    'sender_value' => $sender_value,
    'username_parameter' => $username_parameter,
    'username_value' => $username_value,
    'password_parameter' => $password_parameter,
    'password_value' => $password_value,
    'opt1_parameter' => $optional1_parameter,
    'opt1_value' => $optional1_value,
    'opt2_parameter' => $optional2_parameter,
    'opt2_value' => $optional2_value,
    'opt3_parameter' => $optional3_parameter,
    'opt3_value' => $optional3_value,
    'allowed_templates' => $temps

    );

$this->db->where('smsaddon',"sms");
$this->db->update('pt_smsaddon',$data);
   $this->disable_enable($status);



    }

    public function disable_enable($status){
           $datamod = array(
            'module_status' => $status
    );

    $this->db->where('module_name',"smsaddon");
    $this->db->update('pt_modules',$datamod);
    }

    public function get_details(){
     return $this->db->get('pt_smsaddon')->result();
    }

    public function addon_status(){

    $this->db->where('module_name',"smsaddon");
    $r = $this->db->get('pt_modules')->result();
    return $r[0]->module_status;
    }

    public function smstest($template){
    $details = sms_template_detail($template);
     $this->load->library('smsaddonlib');

     return  $this->smsaddonlib->send_test_sms($details[0]->temp_body);

    }


}