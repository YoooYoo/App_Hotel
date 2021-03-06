<?php
header('Access-Control-Allow-Origin: *');

class Invoice extends MX_Controller {
		private $data = array();

		function __construct() {
				parent :: __construct();
				modules :: load('home');
				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$this->data['errormsg'] = $this->session->flashdata("invoiceerror");
				$this->data['lang_set'] = $this->session->userdata('set_lang');
				$defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])) {
						$this->data['lang_set'] = $defaultlang;
				}
				$this->lang->load("front", $this->data['lang_set']);
//$this->data['geo'] = $this->load->get_var('geolib');
		}

		public function index() {
				$this->load->helper('invoice');
				$this->data['hideLang'] = "hide";
				$this->data['hideCurr'] = "hide";
				$this->data['hidden'] = "hidden-sm hidden-xs";
				$bookingid = $this->input->get('id');
				$bookingref = $this->input->get('sessid');
				$ebookingid = $this->input->get('eid');
				if (!empty ($ebookingid)) {
						$this->data['invoice'] = pt_get_einvoice_details($ebookingid, $bookingref);
						if (empty ($this->data['invoice'])) {
								redirect(base_url());
						}
						else {
/* $this->session->set_userdata('checkout_amount', $this->data['invoice'][0]->booking_deposit);
$this->session->set_userdata('checkout_total', $this->data['invoice'][0]->booking_total);*/
								$contact = $this->settings_model->get_contact_page_details();
								$this->data['contactphone'] = $contact[0]->contact_phone;
								$this->data['contactemail'] = $contact[0]->contact_email;
								$this->data['contactaddress'] = $contact[0]->contact_address;
								$this->data['page_title'] = 'Invoice';
//   $this->theme->partial('invoice',$this->data);
								$this->load->view('admin/modules/global/einvoice', $this->data);
						}
				}
				else {
						if (empty ($bookingref) || empty ($bookingid)) {
								$bookingid = $this->session->userdata("BOOKING_ID");
								$bookingref = $this->session->userdata("REF_NO");
						}
						$this->data['invoice'] = invoiceDetails($bookingid, $bookingref);
						if (empty ($this->data['invoice']->id)) {
								redirect(base_url());
						}
						else {
								$this->session->set_userdata('checkout_amount', $this->data['invoice']->checkoutAmount);
								$this->session->set_userdata('checkout_total', $this->data['invoice']->checkoutTotal);
								$contact = $this->settings_model->get_contact_page_details();
								$this->load->model('admin/payments_model');
								$paygateways = $this->payments_model->getAllPaymentsBack();

								$this->data['msg'] = $this->payments_model->getGatewayMsg($this->data['invoice']->paymethod);

								$this->data['paymentGateways'] = $paygateways['activeGateways'];
								$this->data['payOnArrival'] = $this->payments_model->payOnArrivalIsActive($paygateways['activeGateways']);
								$singleGateway = $this->payments_model->onlySinglePaymentGatewayActive($paygateways['activeGateways']);
								if($singleGateway['status'] == "yes"){
									
									$this->data['singleGateway'] = $singleGateway['name'];
								
								}else{

									$this->data['singleGateway'] = "";
								}
								//sort on basic of order
								usort($this->data['paymentGateways'], function($a, $b) {
								return $a['order'] - $b['order'];
								});

								$this->data['contactphone'] = $contact[0]->contact_phone;
								$this->data['contactemail'] = $contact[0]->contact_email;
								$this->data['contactaddress'] = $contact[0]->contact_address;
								$this->data['page_title'] = 'Invoice';

								$this->theme->view('admin/modules/global/invoice', $this->data);
						}
				}
		}

		function validate_coupon() {
				$code = $this->input->post('code');
				$bookingid = $this->input->post('bookingid');
				$this->load->model('admin/coupons_model');
				$resp = $this->coupons_model->validatecoupon($code);
				if ($resp > 0) {
						$amount = $this->session->userdata('checkout_amount');
						$totalpay = $this->session->userdata('checkout_total');
						$alteredamount = $amount * $resp / 100;
						$alteredtotal = $totalpay * $resp / 100;
						$amount = $amount - round($alteredamount, 2);
						$totalpay = $totalpay - round($alteredtotal, 2);
						$data = array('coupon_used' => '1');
						$this->db->where('coupon_code', $code);
						$this->db->update('pt_coupons', $data);
						$data2 = array('booking_deposit' => $amount, 'booking_total' => $totalpay, 'booking_remaining' => $totalpay, 'booking_coupon' => $code, 'booking_coupon_rate' => $resp);
						$this->db->where('booking_id', $bookingid);
						$this->db->update('pt_bookings', $data2);
						echo $resp;
				}
				else {
						echo $resp;
				}
		}

		
		function updatePayOnArrival(){
			
			if ($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$id = $this->input->post('id');
				$module = $this->input->post('module');
				$data = array(
					'booking_status' => 'reserved',
					'booking_payment_type' => 'payonarrival'
					);

				$this->db->where('booking_id',$id);
				$this->db->update('pt_bookings',$data);
				if($module == "hotels"){
					$data2 = array(
					'booked_booking_status' => 'reserved'
					);
				
				$this->db->where('booked_booking_id',$id);
				$this->db->update('pt_booked_rooms',$data2);
					
				}
				
			}
				
			}
			
		}

		function getGatewaylink($bookingid,$bookingref){
			$this->load->helper('invoice');

			if ($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$invoicdata = invoiceDetails($bookingid,$bookingref);
				$this->load->model('admin/payments_model');
				$gateway = $this->input->post('gateway');
				echo $this->payments_model->getGatewayMsg($gateway,$invoicdata);

			}

		}
			
		}

		function notifyUrl($gateway){

			$this->load->helper('invoice');
			$payResult = array();
			$postdata = $this->input->post();
			
			if(!empty($postdata)){

			require_once "./application/modules/gateways/" . $gateway . ".php";
			$this->load->model('admin/payments_model');
			$params = $this->payments_model->getGatewayParams($gateway);
			if (function_exists($gateway . "_verifypayment")) {
			$payResult = call_user_func($gateway . "_verifypayment",$params);
			}
			$this->load->model("admin/bookings_model");
		
		
		if($payResult['status'] == "success"){
			$shortInfo = $this->bookings_model->bookingShortInfo($payResult['invoiceid']);

			if($shortInfo[0]->booking_deposit == $payResult['paid']){

				updateInvoiceStatus($payResult['invoiceid'],$payResult['paid'],$payResult['transactionid'],$gateway,"paid", $shortInfo[0]->booking_type,$shortInfo[0]->booking_total);
				$invoicedetails = invoiceDetails($payResult['invoiceid'],$shortInfo[0]->booking_ref_no);

				$this->load->model('admin/emails_model');

				$this->emails_model->paid_sendEmail_customer($invoicedetails);
				$this->emails_model->paid_sendEmail_admin($invoicedetails);
				$this->emails_model->paid_sendEmail_owner($invoicedetails);



			}else{

			}
			
		}
		
		}

			
		}

}