<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Coupons extends MX_Controller { exit;
		private $data = array();
		public $role;

//private $userid = 1; //$this->session->userdata('userid');
		function __construct() {
				parent :: __construct();
				modules :: load('admin');
				$chkadmin = modules :: run('admin/validadmin');
				if (!$chkadmin) {
						redirect('admin');
				}
				$chk = modules :: run('home/is_module_enabled', 'coupons');
				if (!$chk) {
						redirect('admin');
				}
				$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
				$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
    			$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
    			$this->role = $this->session->userdata('pt_role');
				$this->data['role'] = $this->role;
    
				if (!pt_permissions('coupons', $this->data['userloggedin'])) {
						redirect('admin');
				}
				$this->load->model('coupons_model');
// $this->data['modModel'] = $this->modules_model;
		}

		public function index() {
				$this->load->helper('xcrud');
				$xcrud = xcrud_get_instance();
				$xcrud->table('pt_coupons');
                $xcrud->label('coupon_rate','Rate %');
                $xcrud->label('coupon_status','Enabled');
                $xcrud->column_callback('coupon_date','fmtDate');
                $xcrud->search_columns('coupon_code,coupon_status,coupon_rate');
                $xcrud->button('#editCop{coupon_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('data-toggle' => 'modal'));
                $xcrud->unset_add();
                $xcrud->unset_edit();
				$this->data['content'] = $xcrud->render();
                $this->data['coupons'] = $this->coupons_model->get_all_coupons();
				$this->data['page_title'] = 'Coupon Codes Management';
				$this->data['main_content'] = 'coupons_view';
				$this->data['header_title'] = 'Coupon Codes Management';
				$this->load->view('template', $this->data);
		}
// Disable coupons

		public function disable_multiple_codes() {
				$codelist = $this->input->post('codelist');
				foreach ($codelist as $id) {
						$this->coupons_model->disable_coupon($id);
				}
				$this->session->set_flashdata('flashmsgs', "Disabled Successfully");
		}
// Enable coupons

		public function enable_multiple_codes() {
				$codelist = $this->input->post('codelist');
				foreach ($codelist as $id) {
						$this->coupons_model->enable_coupon($id);
				}
				$this->session->set_flashdata('flashmsgs', "Enabled Successfully");
		}
// Delete Single Coupon

		public function delete_single_coupon() {
				$id = $this->input->post('codeid');
				$this->coupons_model->delete_coupon($id);
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}
// Delete coupons

		public function delete_multiple_codes() {
				$codelist = $this->input->post('codelist');
				foreach ($codelist as $id) {
						$this->coupons_model->delete_coupon($id);
				}
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}
// add coupon

		public function addcoupon() {
				$this->form_validation->set_message('is_unique', 'Error Occurred Kindly Generate New Code.');
				$this->form_validation->set_rules('rate', 'Percentage', 'trim|required|is_numeric|greater_than[0]');
				$this->form_validation->set_rules('code', 'Coupon Code', 'trim|required|is_unique[pt_coupons.coupon_code]');
				if ($this->form_validation->run() == FALSE) {
						echo '
<div class="alert alert-danger">' . validation_errors() . '</div>
<br>';
				}
				else {
						$this->coupons_model->add_coupon();
						$this->session->set_flashdata('flashmsgs', "Coupon Added Successfully");
				}
		}
// update coupon

		public function updatecoupon() {
				$this->form_validation->set_rules('rate', 'Percentage', 'trim|required|is_numeric|greater_than[0]');
				if ($this->form_validation->run() == FALSE) {
						echo '
<div class="alert alert-danger">' . validation_errors() . '</div>
<br>';
				}
				else {
						$this->coupons_model->update_coupon();
						$this->session->set_flashdata('flashmsgs', "Coupon Updated Successfully");
				}
		}
// generate coupon

		public function generate_coupon() {
				$settings = $this->settings_model->get_settings_data();
				$len = $settings[0]->coupon_code_length;
				$type = $settings[0]->coupon_code_type;
				echo random_string($type, $len);
		}

}