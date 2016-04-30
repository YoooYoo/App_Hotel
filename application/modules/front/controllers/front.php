<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Front extends MX_Controller {
		public $frontdata = array();

		function __construct() {
				$theme = @ $_GET['theme'];
				// $lang = @ $_GET['lang'];
				// if (!empty ($lang)) {
				// 		set_language($lang);
				// }
				if (!empty ($theme)) {
						$this->session->set_userdata('pt_theme_preview', $theme);
						$this->theme->set_theme($theme);
				}
				$themepreview = $this->session->userdata('pt_theme_preview');
				if (!empty ($themepreview)) {
						$this->theme->set_theme($themepreview);
				}
				parent :: __construct();
				$this->load->model('admin/cms_model');
				$this->load->model('admin/modules_model');
				//$this->load->model('hotels/hotels_model');
				//$this->load->library('hotels/hotels_lib');
				$this->load->library('bootpagination');
				$this->load->library('geolib');
				$this->load->helper('settings');
				$this->load->helper('text');
				$res = $this->settings_model->get_contact_page_details();
				$this->frontdata['phone'] = $res[0]->contact_phone;
				$this->frontdata['contactemail'] = $res[0]->contact_email;
				$this->frontdata['geolib'] = $this->geolib;
				$this->__bookings_expired();
				$this->__visitors_count($this->input->ip_address());
				$this->load->vars($this->frontdata);
				$this->__modulecheck();
		}

		function __bookings_expired() {

				$this->db->select('booking_id');
				$this->db->where('booking_expiry <', time());
				$this->db->where('booking_status', 'unpaid');
				$bookings = $this->db->get('pt_bookings')->result();
				
				foreach($bookings as $b){
					$this->db->where('booked_booking_id',$b->booking_id);
					$this->db->delete('pt_booked_rooms');
				

					$this->db->where('booking_id',$b->booking_id);
					$this->db->delete('pt_bookings');
				}
				
				
		}

		function __modulecheck() {
				$mods = array("hotels", "tours", "cars", "flights", "blog", "ean", "tripadvisor");
				$this->load->library("ptmodules");
				$modlist = $this->ptmodules->allmoduleslist;
				foreach ($mods as $m) {
						if (!in_array($m, $modlist)) {
								$this->__update_module_status($m);
						}
				}
		}

		function __update_module_status($m) {
				$data = array('page_header_menu' => '0', 'page_status' => 'No');
				$this->db->where("page_slug", $m);
				$this->db->update("pt_cms", $data);
		}

		function __visitors_count($ip) {
				$today = date("Y-m-d");
				$this->db->select('visits_ip,visits_hits_count');
				$this->db->where('visits_ip', $ip);
				$this->db->where('visits_date', $today);
				$q = $this->db->get('pt_visitors_count');
				$res = $q->result();
				$nums = $q->num_rows();
				if ($nums > 0) {
						$hits = $res[0]->visits_hits_count + 1;
						$data = array('visits_hits_count' => $hits);
						$this->db->where('visits_ip', $ip);
						$this->db->where('visits_date', $today);
						$this->db->update('pt_visitors_count', $data);
				}
				else {
						$datainsert = array('visits_ip' => $ip, 'visits_hits_count' => 1, 'visits_unique_count' => 1, 'visits_date' => $today);
						$this->db->insert('pt_visitors_count', $datainsert);
				}
		}

}