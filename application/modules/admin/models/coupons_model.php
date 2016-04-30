<?php

class Coupons_model extends CI_Model {

		function __construct() {
// Call the Model constructor
				parent :: __construct();
		}

// add coupon
		function add_coupon() {
				$data = array('coupon_code' => $this->input->post('code'), 'coupon_rate' => $this->input->post('rate'), 'coupon_date' => time(), 'coupon_status' => $this->input->post('status'));
				$this->db->insert('pt_coupons', $data);
		}

//udpate coupon
		function update_coupon() {
				$data = array('coupon_rate' => $this->input->post('rate'), 'coupon_status' => $this->input->post('status'));
				$this->db->where('coupon_id', $this->input->post('couponid'));
				$this->db->update('pt_coupons', $data);
		}

// get all coupons
		function get_all_coupons() {
				$this->db->order_by('coupon_id', 'desc');
				return $this->db->get('pt_coupons')->result();
		}

// get all data of single Supplement
		function get_thing_data($id) {
				$this->db->where('things_id', $id);
				return $this->db->get('pt_thingstodo')->result();
		}
// Disable Coupon

		public function disable_coupon($id) {
				$data = array('coupon_status' => '0');
				$this->db->where('coupon_id', $id);
				$this->db->update('pt_coupons', $data);
		}
// Enable Coupon

		public function enable_coupon($id) {
				$data = array('coupon_status' => '1');
				$this->db->where('coupon_id', $id);
				$this->db->update('pt_coupons', $data);
		}

		function delete_coupon($id) {
				$this->db->where('coupon_id', $id);
				$this->db->delete('pt_coupons');
		}

		function validatecoupon($coupon) {
				$this->db->where('coupon_code', $coupon);
				$this->db->where('coupon_status', '1');
				$res = $this->db->get('pt_coupons')->result();
				return $res[0]->coupon_rate;
		}

}