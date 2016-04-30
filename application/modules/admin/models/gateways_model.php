<?php
use Omnipay\Common\GatewayFactory;
use Omnipay\Common\CreditCard;
class Gateways_model extends CI_Model {
             private $data = array();
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
         $this->data['app_settings'] = $this->settings_model->get_settings_data();
    }

     /********************************************

    Paypal express settings
     ***********************************************/
      function PayPal_Express($amount,$total){
       $this->db->where('payment_id','PayPal_Express');

       $res = $this->db->get('pt_payment_gateways')->result();
       $mode = $res[0]->payment_testmode;
       $username = $res[0]->payment_username;
       $password = $res[0]->payment_password;
       $signature = $res[0]->payment_signature;

    $gateway = GatewayFactory::create('PayPal_Express');
$gateway->setUsername($username);
$gateway->setPassword($password);
$gateway->setSignature($signature);
$gateway->setTestMode($mode);

$response = $gateway->purchase(
    array(

        'cancelUrl'=> base_url().'account',
        'returnUrl'=> base_url().'checkout/success',
        'amount' =>  $amount,
        'currency' => 'USD'
        )
)->send();

if ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}


/*echo $responsemsg=$response->getMessage();

    echo '<br><br><br>';
    $data = $response->getData();
    print_r($data);*/

     }

       function PayPal_Express_success($amount,$bookingid,$total){
             $this->db->where('payment_id','PayPal_Express');

     $res = $this->db->get('pt_payment_gateways')->result();
     $mode = $res[0]->payment_testmode;
     $username = $res[0]->payment_username;
     $password = $res[0]->payment_password;
     $signature = $res[0]->payment_signature;
      $gateway = GatewayFactory::create('PayPal_Express');
      $gateway->setUsername($username);
      $gateway->setPassword($password);
      $gateway->setSignature($signature);
      $gateway->setTestMode($mode);


     $response = $gateway->completePurchase(
                    array(
                       'cancelUrl'=> base_url().'account',
        'returnUrl'=> base_url().'checkout/success',
                        'amount' => $amount,
                               'currency' => 'USD'
                    )
            )->send();



    if ($response->isSuccessful()){
       $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);


       $this->load->helper('invoice');



      $this->db->select('booking_ref_no');
   $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);
    $booktype = $invoicedetails[0]->booking_type;

    if($booktype == "hotels"){
       $data2 = array(

      'booked_booking_status' => 'paid'

      );

   $this->db->where('booked_booking_id',$bookingid);

   $this->db->update('pt_booked_rooms',$data2);
    }elseif($booktype == "cars"){
      $data3 = array(

      'booked_booking_status' => 'paid'

      );

   $this->db->where('booked_booking_id',$bookingid);

   $this->db->update('pt_booked_cars',$data3);


    }


   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);


    }else{

        throw new Exception($response->getMessage());


    }


     }


    /********************************************
    End Paypal express settings
   ***********************************************/

    /***********************************************
   Start PayPal_Pro settings
   ************************************************/
   function PayPal_Pro($amount,$total){

     $this->db->where('payment_id','PayPal_Pro');

       $res = $this->db->get('pt_payment_gateways')->result();

       $mode = $res[0]->payment_testmode;
       $username = $res[0]->payment_username;
       $password = $res[0]->payment_password;
       $signature = $res[0]->payment_signature;


    $gateway = GatewayFactory::create('PayPal_Pro');
   $gateway->setUsername($username);
      $gateway->setPassword($password);
      $gateway->setSignature($signature);
      $gateway->setTestMode($mode);

    $formData = array('firstName' => $this->input->post('firstName'),'lastName' => $this->input->post('lastName'),'number' => $this->input->post('cardno'), 'expiryMonth' => $this->input->post('expMonth'), 'expiryYear' =>  $this->input->post('expYear'), 'cvv' => $this->input->post('ccv'));
$response = $gateway->purchase(array('amount' => $amount, 'currency' => 'USD', 'card' => $formData))->send();

if ($response->isSuccessful()){
    // payment was successful: update database

      $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);

        $data2 = array(
       'booked_booking_status' => 'paid'

       );
        $this->load->helper('invoice');
       $this->db->where('booked_booking_id',$bookingid);
       $this->db->update('pt_booked_rooms',$data2);
      $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);

   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);


redirect('checkout/success');

// print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}


   }

   /*
    function PayPal_Pro_success($amount,$bookingid,$total){
       $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);

        $data2 = array(
       'booked_booking_status' => 'paid'

       );
        $this->load->helper('invoice');
       $this->db->where('booked_booking_id',$bookingid);
       $this->db->update('pt_booked_rooms',$data2);
      $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);

   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);


     }*/


   /***********************************************
   End PayPal_Pro settings
   ************************************************/

   /***********************************************
   Start TwoCheckout settings
   ************************************************/
   function TwoCheckout($amount,$total){

       $this->db->where('payment_id','TwoCheckout');

       $res = $this->db->get('pt_payment_gateways')->result();
       $mode = $res[0]->payment_testmode;
       $accountno = $res[0]->payment_username;
       $secret = $res[0]->payment_password;

    $gateway = GatewayFactory::create('TwoCheckout');
$gateway->setAccountNumber($accountno);
$gateway->setTransactionId('Booking');
$gateway->setSecretWord($secret);
$gateway->setTestMode($mode);

$response = $gateway->purchase(
    array(

        'cancelUrl'=> base_url().'account',
        'returnUrl'=> base_url().'checkout/success',
        'amount' =>  $amount,
        'currency' => 'USD'
        )
)->send();

if ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}



   }


    function TwoCheckout_success($amount,$bookingid,$total){

   $this->db->where('payment_id','TwoCheckout');

       $res = $this->db->get('pt_payment_gateways')->result();
       $mode = $res[0]->payment_testmode;
       $accountno = $res[0]->payment_username;
       $secret = $res[0]->payment_password;

    $gateway = GatewayFactory::create('TwoCheckout');
$gateway->setAccountNumber($accountno);
$gateway->setTransactionId('Booking');
$gateway->setSecretWord($secret);
$gateway->setTestMode($mode);


     $response = $gateway->completePurchase(
                    array(
         'cancelUrl'=> base_url().'account',
        'returnUrl'=> base_url().'checkout/success',
          'amount' => $amount,
           'currency' => 'USD'
                    )
            )->send();



    if ($response->isSuccessful()){
       $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);

        $data2 = array(
       'booked_booking_status' => 'paid'

       );
        $this->load->helper('invoice');
       $this->db->where('booked_booking_id',$bookingid);
       $this->db->update('pt_booked_rooms',$data2);
      $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);

   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);



    }else{

        throw new Exception($response->getMessage());


    }


     }
   /***********************************************
   End TwoCheckout settings
   ************************************************/
   /***********************************************
   Start Stripe settings
   ************************************************/
   function Stripe($amount,$total){

     $this->db->where('payment_id','Stripe');

       $res = $this->db->get('pt_payment_gateways')->result();
      $apikey = $res[0]->payment_apikey;


    $gateway = GatewayFactory::create('Stripe');
    $gateway->setApiKey($apikey);
   // $formData = ['number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123'];
    $formData = array('firstName' => $this->input->post('firstName'),'lastName' => $this->input->post('lastName'),'number' => $this->input->post('cardno'), 'expiryMonth' => $this->input->post('expMonth'), 'expiryYear' =>  $this->input->post('expYear'), 'cvv' => $this->input->post('ccv'));
$response = $gateway->purchase(array('amount' => $amount, 'currency' => 'USD', 'card' => $formData))->send();

if ($response->isSuccessful()){
    // payment was successful: update database
    $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);

        $data2 = array(
       'booked_booking_status' => 'paid'

       );
        $this->load->helper('invoice');
       $this->db->where('booked_booking_id',$bookingid);
       $this->db->update('pt_booked_rooms',$data2);
      $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);

   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);



redirect('checkout/success');

// print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}


   }

  /*

    function Stripe_success($amount,$bookingid,$total){
       $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);

        $data2 = array(
       'booked_booking_status' => 'paid'

       );
        $this->load->helper('invoice');
       $this->db->where('booked_booking_id',$bookingid);
       $this->db->update('pt_booked_rooms',$data2);
      $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);

   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);



     }*/


   /***********************************************
   End Stripe settings
   ************************************************/

    /***********************************************
   Start AuthorizeNet_AIM settings
   ************************************************/
   function AuthorizeNet_AIM($amount){

     $this->db->where('payment_id','AuthorizeNet_AIM');

       $res = $this->db->get('pt_payment_gateways')->result();

      $apilogin = $res[0]->payment_username;
      $transkey = $res[0]->payment_apikey;
      $mode = $res[0]->payment_testmode;
      $devmode = $res[0]->payment_development_mode;


    $gateway = GatewayFactory::create('AuthorizeNet_AIM');
    $gateway->setApiLoginId($apilogin);
    $gateway->setTransactionKey($transkey);
     $gateway->setTestMode($mode);
     $gateway->setDeveloperMode($devmode);

    $formData = array('firstName' => $this->input->post('firstName'),'lastName' => $this->input->post('lastName'),'number' => $this->input->post('cardno'), 'expiryMonth' => $this->input->post('expMonth'), 'expiryYear' =>  $this->input->post('expYear'), 'cvv' => $this->input->post('ccv'));
$response = $gateway->purchase(array('amount' => $amount, 'currency' => 'USD', 'card' => $formData))->send();

if ($response->isSuccessful()){
    // payment was successful: update database
redirect('checkout/success');

// print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}


   }


    function AuthorizeNet_AIM_success($amount,$bookingid,$total){
       $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);

        $data2 = array(
       'booked_booking_status' => 'paid'

       );
        $this->load->helper('invoice');
       $this->db->where('booked_booking_id',$bookingid);
       $this->db->update('pt_booked_rooms',$data2);
      $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);

   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);


     }


   /***********************************************
   End AuthorizeNet_AIM settings
   ************************************************/
     /********************************************

     Skrill settings
     ***********************************************/
      function Skrill($amount){
        $this->db->where('payment_id','Skrill');

     $res = $this->db->get('pt_payment_gateways')->result();
     $mode = $res[0]->payment_testmode;
     $username = $res[0]->payment_username;
      $gateway = GatewayFactory::create('Skrill');
      $gateway->setEmail($username);
      $gateway->setTestMode($mode);
      $gateway->setNotifyUrl(base_url().'checkout/success');


$response = $gateway->purchase(
    array(

        'cancelUrl'=> base_url().'account',
        'returnUrl'=> base_url().'checkout/success',
        'amount' =>  $amount,
         'language' => 'EN',
         'details' => 'Booking',
        'currency' => 'USD'
        )
)->send();

if ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}


/*echo $responsemsg=$response->getMessage();

    echo '<br><br><br>';
    $data = $response->getData();
    print_r($data);*/

     }

       function Skrill_success($amount,$bookingid,$total){
        $this->load->helper('invoice');
   /*    $this->db->where('payment_id','Skrill');

     $res = $this->db->get('pt_payment_gateways')->result();
     $mode = $res[0]->payment_testmode;
     $username = $res[0]->payment_username;
      $gateway = GatewayFactory::create('Skrill');
      $gateway->setEmail($username);
      $gateway->setTestMode($mode);

      $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;

    $custEmail = invoiceDetails($bookingid,$refnum);
    $cEmail = $custEmail[0]->accounts_email;
     $response = $gateway->authorizeTransfer(
                    array(
                       'cancelUrl'=> base_url().'checkout/cancel',
        'returnUrl'=> base_url().'checkout/success',
                        'amount' => $amount,
                        'language' => 'EN',
                          'subject' => 'Booking',
                          'note' => 'Booking Success',
                          'customerEmail' => $username,
                          'currency' => 'USD'
                    )
            )->send();*/



  //  if ($response->isSuccessful()){
       $data = array(
       'booking_status' => 'paid',
       'booking_deposit' => $amount,
       'booking_total' => $total,
       'booking_amount_paid' => $amount,
       'booking_remaining' => $total - $amount,
       'booking_payment_date' => time()

       );
       $this->db->where('booking_id',$bookingid);
       $this->db->update('pt_bookings',$data);

        $data2 = array(
       'booked_booking_status' => 'paid'

       );

       $this->db->where('booked_booking_id',$bookingid);
       $this->db->update('pt_booked_rooms',$data2);
      $this->db->select('booking_ref_no');
   $this->db->where('booking_id',$bookingid);
   $refno = $this->db->get('pt_bookings')->result();
   $refnum = $refno[0]->booking_ref_no;
     $this->load->model('admin/emails_model');
    $invoicedetails = invoiceDetails($bookingid,$refnum);

   $this->emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);
   $this->emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title,$this->data['app_settings'][0]->currency_sign,$this->data['app_settings'][0]->currency_code);

 /*
    }else{

        throw new Exception($response->getMessage());


    }*/


     }


    /********************************************
    End Skrill settings
   ***********************************************/





}