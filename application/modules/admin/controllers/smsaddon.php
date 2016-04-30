<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Smsaddon extends MX_Controller {  exit;
		private $data = array();
		public $role;

		function __construct() {
				modules :: load('admin');
				$chkadmin = modules :: run('admin/validadmin');
				if (!$chkadmin) {
						redirect('admin');
				}
				$seturl = $this->uri->segment(3);
				if ($seturl != "settings") {
						$chk = modules :: run('home/is_module_enabled', 'smsaddon');
						if (!$chk) {
								redirect('admin');
						}
				}
				$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
				$this->role = $this->session->userdata('pt_role');
				$this->data['role'] = $this->role;
				if (!pt_permissions('smsaddon', $this->data['userloggedin'])) {
						redirect('admin');
				}
				$this->load->model('smsaddon_model');
				$this->load->helper('settings');
		}

		function index() {
		}

		function settings() {
				$this->load->model('admin/templates_model');
				$this->data['templates'] = $this->templates_model->get_all_templates();
				$updatesett = $this->input->post('updatesettings');
				if (!empty ($updatesett)) {
						$this->smsaddon_model->update_details();
						redirect('admin/smsaddon/settings');
				}
				$this->load->library('smsaddonlib');
				$this->data['lib'] = $this->smsaddonlib;
				$this->data['allowedtemplates'] = $this->smsaddonlib->allowedtemps;
				$this->data['settings'] = $this->smsaddon_model->get_details();
				$this->data['status'] = $this->smsaddon_model->addon_status();
				$this->data['main_content'] = 'modules/smsaddon/settings';
				$this->data['page_title'] = 'SMS Addon Settings';
				$this->load->view('template', $this->data);
		}

}