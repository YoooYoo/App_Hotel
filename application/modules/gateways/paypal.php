<?php

function paypal_config() {

	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "PayPal" ), "UsageNotes" => array( "Type" => "System", "Value" => "You must enable IPN inside your PayPal account and set the URL to " . base_url() ), "email" => array( "FriendlyName" => "PayPal Email", "Type" => "text", "Size" => "40","Description" => "You must enable IPN inside your PayPal account and set the Return URL to  ".base_url()."invoice/notifyUrl/paypal" ), "sandbox" => array( "FriendlyName" => "Sandbox", "Type" => "yesno", "Description" => "Tick to enable test mode" ));
	return $configarray;
}


function paypal_link($params) {
	$invoiceid = $params['invoiceid'];
	$paypalemail = $params['email'];

	$code = "<table><tr>";
if($params['sandbox']){
	$code .= "<td><form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">";
}else{
	$code .= "<td><form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">";

	}

	$code .="<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
			  <input type=\"hidden\" name=\"business\" value=\"" . $paypalemail . "\">";

	
		

	$code .= "<input type=\"hidden\" name=\"charset\" value=\"" . $params['charset'] . "\">
		<input type=\"hidden\" name=\"amount\" value=\"" . $params['amount'] . "\"> 
<input type=\"hidden\" name=\"currency_code\" value=\"" . $params['currency'] . "\">
<input type=\"hidden\" name=\"custom\" value=\"" . $params['invoiceid'] . "\">
<input type=\"hidden\" name=\"return\" value=\"" .base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref']."\">
<input type=\"hidden\" name=\"cancel_return\" value=\"" .base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref']."\">
<input type=\"hidden\" name=\"notify_url\" value=\"" . base_url(). "invoice/notifyUrl/paypal\">
<input type=\"hidden\" name=\"rm\" value=\"2\">
<input type=\"image\" src=\"https://www.paypal.com/en_US/i/btn/x-click-but03.gif\" border=\"0\" name=\"submit\" alt=\"Make a one time payment with PayPal\">
</form></td>";


	$code .= "</tr></table>";
	return $code;
}

//function for verification of payment. It will be used in notify url
function paypal_verifypayment($params){

//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any 
$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");

$postipn = "cmd=_notify-validate";
$orgipn = "";

foreach ($_POST as $key => $value) {
	$orgipn .= ("" . $key . " => " . $value . "\r\n");
	$postipn .= "&" . $key . "=" . urlencode(html_entity_decode($value, ENT_QUOTES));
}

if($params['sandbox']){
	$reply = curlCall("https://www.sandbox.paypal.com/cgi-bin/webscr", $postipn);
}else{
	$reply = curlCall("https://www.paypal.com/cgi-bin/webscr", $postipn);

	}



if (!strcmp($reply, "VERIFIED")) {
	$paypalemail = $_POST['receiver_email'];
$payment_status = $_POST['payment_status'];
$txn_type = $_POST['txn_type'];
$txn_id = $_POST['txn_id'];
$mc_gross = $_POST['mc_gross'];
$mc_fee = $_POST['mc_fee'];
$invoiceid = $_POST['custom'];


if ($txn_type == "web_accept" && $payment_status == "Completed") {
	
	$result = array("status" => "success","invoiceid" => $invoiceid,"paid" => $mc_gross,"transactionid" => $txn_id);
	return $result;

}

} else {
	if (!strcmp($reply, "INVALID")) {
		return $result;
		exit();
	} else {
		return $result;
		
	}
}



}