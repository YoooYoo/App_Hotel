<?php

function payonarrival_config() {
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "Pay On Arrival" ), "instructions" => array( "FriendlyName" => "Pay On Arrival Instructions", "Type" => "textarea", "Rows" => "5", "Value" => "", "Description" => "The instructions you want displaying to customers who choose this payment method" ) );
	return $configarray;
}


function payonarrival_link($params) {
	
	$code = "<p>" . nl2br( $params['instructions'] ). "</p>";
	return $code;
}