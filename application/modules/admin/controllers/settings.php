<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Settings extends MX_Controller {
		private $data = array();
		public $role;
		public $langdef;

		function __construct() {
				modules :: load('admin');
				$chkadmin = modules :: run('admin/validadmin');
				if (!$chkadmin) {
						redirect('admin');
				}
				$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
                $this->langdef = DEFLANG;
                $this->data['languages'] = pt_get_languages();
                $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
                $this->role = $this->session->userdata('pt_role');
				$this->data['role'] = $this->role;
				$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
				
        }

		public function index() {
				$this->app_settings();
		}

		public function app_settings() {
		        $this->load->helper('themes');
				$this->load->model('admin/uploads_model');
				$this->load->model('admin/emails_model');
				$this->load->model('payments_model');
				$this->load->library('myweather');
                $this->load->library('browser');
                $this->data['browserlib'] = $this->browser;
                $this->data['themes'] = directory_map('./themes/',2);
				$seosettings = $this->input->post('seosettings');
				$globalsettings = $this->input->post('globalsettings');
				$updatecurr = $this->input->post('updatecurr');
				$currlist = $this->input->post('default_currencies');
				$jsupdate = $this->input->post('jsupdate');
				$bhrs_update = $this->input->post('bhrs_update');
				$watermark_settings = $this->input->post('watermark_settings');
				$mailserver_settings = $this->input->post('mailserver_update');
				$updateweather = $this->input->post('weatherupdate');
				$securitysettings = $this->input->post('securitysettings');
				$mobilesettings = $this->input->post('mobilesettings');
				if (!empty ($updateweather)) {
						$this->form_validation->set_rules('apikey', 'API Key', 'trim|required');
						if ($this->form_validation->run() == FALSE) {
						}
						else {
								$this->myweather->update_myweather($this->input->post('weatherid'), $this->input->post('apikey'), $this->input->post('weathercity'), $this->input->post('status'));
								$this->data['successmsg'] = "Updated Successfully";
						}
				}
				if (!empty ($updatecurr)) {
						$this->settings_model->update_currency_code();
						if (!empty ($currlist)) {
								foreach ($currlist as $cl) {
										$this->settings_model->udpate_currencies($cl);
								}
								$this->settings_model->change_currencies_status($currlist);
						}
						$this->data['successmsg'] = "Updated Successfully";
				}
				if (!empty ($globalsettings)) {
						$error = true;
						$this->settings_model->update_settings();
						$this->settings_model->update_contact_page_details();
                        $mails = $this->input->post('defmailer');
						if ($mails == 'smtp') {
								$this->form_validation->set_rules('smtppass', 'SMTP Password', 'required');
								$this->form_validation->set_rules('smtpuser', 'SMTP Username', 'trim|required');
								$this->form_validation->set_rules('smtphost', 'SMTP Hostname', 'trim|required');
								$this->form_validation->set_rules('smtpport', 'SMTP Port', 'trim|required');
								if ($this->form_validation->run() == FALSE) {
								}
								else {
										$this->emails_model->update_mailserver();
										$this->data['successmsg'] = "Updated Successfully";
								}
						}
						else {
								$this->emails_model->update_mailserver();
								$this->data['successmsg'] = "Updated Successfully";
						}
						$this->settings_model->update_facebook_settings();
						$error = false;
						if (!empty ($_FILES['hlogo']) && !empty ($_FILES['hlogo']['name'])) {
								$res = $this->uploads_model->__fav_and_logo("hlogo");
								if ($res == "success") {
										$error = false;
								}
								else {
										$error = true;
										$errortxt = $res;
								}
						}
						if (!empty ($_FILES['flogo']) && !empty ($_FILES['flogo']['name'])) {
								$ress = $this->uploads_model->__fav_and_logo("flogo");
								if ($ress == "success") {
										$error = false;
								}
								else {
										$error = true;
										$errortxt = $ress;
								}
						}
						if (!empty ($_FILES['favimg']) && !empty ($_FILES['favimg']['name'])) {
								$resss = $this->uploads_model->__fav_and_logo("favimg");
								if ($resss == "success") {
										$error = false;
								}
								else {
										$error = true;
										$errortxt = $resss;
								}
						}
						if ($error == FALSE) {
								$this->data['successmsg'] = "Updated Successfully";
						}
						else {
								$this->data['errormsg'] = $errortxt;
						}
                        redirect('admin/settings','refresh');
                        redirect('admin/settings','refresh');
				}
				if (!empty ($seosettings)) {
						$this->settings_model->update_seo_settings();
						$this->data['successmsg'] = "Updated Successfully";
				}
				if (!empty ($securitysettings)) {
						$this->settings_model->update_security();
						$this->data['successmsg'] = "Updated Successfully";
				}
				if (!empty ($jsupdate)) {
						$this->settings_model->update_js();
						$this->data['successmsg'] = "Updated Successfully";
				}

			
				if (!empty ($mobilesettings)) {
						$this->settings_model->update_mobile_settings();
						$this->data['successmsg'] = "Updated Successfully";
				}
				$paymentdata = $this->payments_model->getAllPaymentsBack();
				$this->data['all_payments'] = $paymentdata;
				$this->data['all_cities'] = $this->countries_model->get_all_cities();
				$this->data['weather'] = $this->myweather->weather_module_details();
				$this->data['business_hrs'] = $this->settings_model->get_business_hours();
				$this->data['contact_data'] = $this->settings_model->get_contact_page_details();
				$this->data['settings'] = $this->settings_model->get_settings_data();
				$this->data['wm_settings'] = $this->settings_model->get_watermark_data();
				$this->data['currencies'] = $this->settings_model->get_currencies();
				$this->data['mailserver'] = $this->emails_model->get_mailserver();
				$this->data['fbsettings'] = $this->settings_model->get_facebook_settings();
				$this->data['main_content'] = 'settings/application-settings';
				$this->data['page_title'] = 'Applcation Settings';
				$this->load->view('template', $this->data);
		}

		public function modules() {
				$this->data['modules'] = $this->modules_model->get_all_modules();
				$this->data['main_content'] = 'settings/modules';
				$this->data['page_title'] = 'Modules';
				$this->load->view('template', $this->data);
		}

		public function widgets() {

        Xcrud_config::$editor_url = base_url().'assets/include/ckeditor/ckeditor.js';

        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('pt_widgets');
        $xcrud->order_by('widget_id','desc');
        $xcrud->columns('widget_name,widget_id, widget_status');
        $xcrud->label('widget_id','Widget Code');
        $xcrud->column_callback('widget_id', 'widgetCode');
        $xcrud->search_columns('widget_name,widget_status');
        $xcrud->fields('widget_name,widget_status,widget_content');
        $this->data['content'] = $xcrud->render();
        $this->data['dontload'] = "yes";
        $this->data['page_title'] = 'Widgets Management';
        $this->data['main_content'] = 'temp_view';
        $this->data['header_title'] = 'Widgets Management';
        $this->load->view('template', $this->data);


				}


		public function paymentgateways() {
				$this->load->model('payments_model');
				$action = $this->input->post('action');
				if ($action == "activate") {

					$gateway = $this->input->post('gateway');
					$gatewayconfig = $this->payments_model->getGatewayConfigData($gateway);
					$this->payments_model->activateGateway($gatewayconfig);
					redirect('admin/settings/paymentgateways');
				}
				if ($action == "save") {

					//print_r($this->input->post()); exit;
					$this->payments_model->updateGateway();
					redirect('admin/settings/paymentgateways');
				}
				if ($action == "deactivate") {

					$this->payments_model->deActivateGateway();
					redirect('admin/settings/paymentgateways');
				}
				$this->data['all_payments'] = $this->payments_model->getAllPaymentsBack();

				//sort on basic of order
				usort($this->data['all_payments']['activeGateways'], function($a, $b) {
					return $a['order'] - $b['order'];
					});
				//end sort on basis of order

				$this->data['main_content'] = 'settings/payment-gateways';
				$this->data['page_title'] = 'Payment Gateways';
				$this->load->view('template', $this->data);
		}

		public function themesettings() {
				$this->load->helper('directory');
				$this->load->helper('themes');
				$uploadtheme = $this->input->post('uploadtheme');
				if (!empty ($uploadtheme)) {
//  $this->data['msg'] =  $this->settings_model->pt_install_theme();
				}
				$this->data['currtheme'] = $this->settings_model->get_theme();
				$this->data['main_content'] = 'settings/themesettings';
				$this->data['page_title'] = 'Theme Settings';
				$this->load->view('template', $this->data);
		}

		public function sliders($trans = null, $id = null, $lang = null) {

        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('pt_sliders');

        if (!empty ($trans) && !empty ($id)) {
						$this->load->library('sliders_lib');
                        $this->data['sliderlib'] = $this->sliders_lib;
						$this->sliders_lib->set_id($id);

						$update = $this->input->post('update');

						if (empty ($id)) {
								redirect('admin/sliders/');
						}

						if (!empty ($update)) {
						  $this->sliders_lib->update_translation($this->input->post('translated'),$id);
                      	  redirect("admin/settings/sliders/translate/" . $id);
						}

						$this->data['slideid'] = $this->sliders_lib->get_id();
						$this->data['lang'] = $lang;
 						$this->data['main_content'] = 'settings/slidertranslate';
						$this->data['page_title'] = 'Translate Slide';
						$this->load->view('template', $this->data);
				}else{
                        $xcrud->change_type('slide_image', 'image', false, array(              
                        'path' => '../../'.PT_SLIDER_IMAGES_UPLOAD
                        ));
                        $xcrud->columns('slide_image,slide_title_text,slide_desc_text,slide_optional_text,slide_status,slide_order,slide_link');
                        $xcrud->fields('slide_image,slide_title_text,slide_desc_text,slide_optional_text, slide_status'); // fields in details
                        $xcrud->column_callback('slide_order', 'orderInputSlider');
                        $xcrud->column_callback('slide_link', 'translateSlider');
                        $xcrud->column_class('slide_image','zoom_img');
                        $xcrud->label('slide_link','Translate');
                        $this->data['content'] = $xcrud->render();
                        $this->data['page_title'] = 'Slider Management';
                        $this->data['main_content'] = 'temp_view';
                        $this->data['header_title'] = 'Slider Management';
                        $this->load->view('template', $this->data);


				}






		}

		public function social() {

        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('pt_socials');
        $xcrud->change_type('social_icon', 'image', false, array(
        'width' => 450,
        'path' => '../../'.PT_SOCIAL_IMAGES_UPLOAD));
        
        $xcrud->columns('social_icon,social_name,social_link,social_order,social_status');
        $xcrud->fields('social_icon,social_name,social_link,social_status'); // fields in details
        $xcrud->column_class('social_icon','zoom_img');
        $xcrud->column_callback('social_order', 'orderInputSocial');
        $this->data['content'] = $xcrud->render();
        $this->data['page_title'] = 'Social Connections Management';
        $this->data['main_content'] = 'temp_view';
        $this->data['header_title'] = 'Social Connections Management';
        $this->load->view('template', $this->data);

           		}

		public function cscm($args = null) {
				$this->load->model('uploads_model');
				$updatecombined = $this->input->post('addcombined');
				if ($args == null) {
						if (!empty ($updatecombined)) {
								$this->countries_model->updatecombined();
								$this->session->set_flashdata('flashmsgs', 'Updated Successfully');
								redirect('admin/settings/cscm/');
						}
						$this->data['main_content'] = 'settings/cscm/combined';
						$this->data['page_title'] = 'Combined Management';
						$this->data['all_states'] = $this->countries_model->get_all_states();
						$this->data['all_cities'] = $this->countries_model->get_all_cities();
						$this->data['all_countries'] = $this->countries_model->get_all_countries();
						$this->data['count'] = $this->countries_model->get_all_combined();
						$this->data['perpage'] = '10';
						$this->data['p_fro'] = 1;
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], 1);
						$this->data['all_combined'] = $this->countries_model->get_all_combined_limit($this->data['perpage']);
				}
				else
						if ($args == 'cities') {
								$addcity = $this->input->post('addcity');
								$updatecity = $this->input->post('updatecity');
								if (!empty ($addcity)) {
										$this->form_validation->set_rules('cityname', 'City Name', 'trim|required|is_unique[pt_cities.city_name]');
										if ($this->form_validation->run() == FALSE) {
										}
										else {
												$result = $this->countries_model->addcity();
												$this->session->set_flashdata('flashmsgs', 'City added Successfully');
												redirect('admin/settings/cscm/cities');
										}
								}
								if (!empty ($updatecity)) {
										$this->countries_model->updatecity();
										$this->session->set_flashdata('flashmsgs', 'City Updated Successfully');
										redirect('admin/settings/cscm/cities');
								}
								$this->data['main_content'] = 'settings/cscm/cities';
								$this->data['page_title'] = 'Cities Management';
								$this->data['count'] = $this->countries_model->get_all_cities();
								$this->data['perpage'] = '10';
								$this->data['p_fro'] = 1;
								$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], 1);
								$this->data['all_cities'] = $this->countries_model->get_all_cities_limit($this->data['perpage']);
						}
						elseif ($args == 'states') {
								$addstate = $this->input->post('addstate');
								$updatestate = $this->input->post('updatestate');
								if (!empty ($updatestate)) {
										$this->countries_model->updatestate();
										$this->session->set_flashdata('flashmsgs', 'State Updated Successfully');
										redirect('admin/settings/cscm/states');
								}
								if (!empty ($addstate)) {
										$this->form_validation->set_rules('statename', 'State Name', 'trim|required|is_unique[pt_states.state_name]');
										if ($this->form_validation->run() == FALSE) {
										}
										else {
												$this->countries_model->addstate();
												$this->session->set_flashdata('flashmsgs', 'State added Successfully');
												redirect('admin/settings/cscm/states');
										}
								}
								$this->data['main_content'] = 'settings/cscm/states';
								$this->data['page_title'] = 'States Management';
								$this->data['count'] = $this->countries_model->get_all_states();
								$this->data['perpage'] = '10';
								$this->data['p_fro'] = 1;
								$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], 1);
								$this->data['all_states'] = $this->countries_model->get_all_states_limit($this->data['perpage']);
						}
						elseif ($args == 'countries') {
								$addcountry = $this->input->post('addcountry');
								$updatecountry = $this->input->post('updatecountry');
								if (!empty ($addcountry)) {
										$this->form_validation->set_rules('countrycode', 'Country Short Code ', 'trim|required|is_unique[pt_countries.iso2]');
										if ($this->form_validation->run() == FALSE) {
										}
										else {
												if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
														$result = $this->uploads_model->__countryimg();
												}
												else {
														$this->countries_model->addcountry();
														$result = "done";
												}
												if ($result != 'done') {
														$this->data['errormsg'] = $result;
												}
												elseif ($result == 'done') {
														$this->session->set_flashdata('flashmsgs', 'Country added Successfully');
														redirect('admin/settings/cscm/countries');
												}
										}
								}
								if (!empty ($updatecountry)) {
										$oldcode = $this->input->post('oldcode');
										$new = $this->input->post('countrycode');
										if ($oldcode != $new) {
												$this->form_validation->set_rules('countrycode', 'Country Short Code ', 'trim|required|is_unique[pt_countries.iso2]');
										}
										$this->form_validation->set_rules('countryname', 'Country Name', 'trim|required');
										if ($this->form_validation->run() == FALSE) {
												echo "<font color='red'>" . validation_errors() . "</font>";
												exit;
										}
										else {
												if (isset ($_FILES['photo']['name'])) {
														$countryid = $this->input->post('countryid');
														$result = $this->uploads_model->__countryimg($countryid);
														echo $result;
														if ($result == "done") {
																$oldpic = $this->input->post('oldphoto');
																$this->session->set_flashdata('flashmsgs', 'Country Updated Successfully');
																if (!empty ($oldpic)) {
																		unlink(PT_FLAG_IMAGES_UPLOAD . $oldpic);
																}
																exit;
														}
												}
												else {
														$countryid = $this->input->post('countryid');
														$this->countries_model->updatecountry($countryid);
														echo "done";
														$this->session->set_flashdata('flashmsgs', 'Country Updated Successfully');
														exit;
												}
										}
								}
								$this->data['main_content'] = 'settings/cscm/countries';
								$this->data['page_title'] = 'Countries Management';
								$this->data['count'] = $this->countries_model->get_all_countries_count();
								$this->data['perpage'] = '10';
								$this->data['p_fro'] = 1;
								$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], 1);
								$this->data['all_countries'] = $this->countries_model->get_all_countries_limit($this->data['perpage']);
						}
						$this->load->view('template', $this->data);
		}

		function states_ajax($offset = 1) {
				$search = $this->input->post('searchdata');
				if (!empty ($search)) {
						$searchterm = $this->input->post('searchdata');
						$this->data['searchterm'] = $this->input->post('searchdata');
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->search_all_states($searchterm);
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_states'] = $this->countries_model->search_all_states_limit($searchterm, $this->data['perpage'], $offset);
						$this->load->view('settings/cscm/states', $this->data);
				}
				else {
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->get_all_states();
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_states'] = $this->countries_model->get_all_states_limit($this->data['perpage'], $offset);
						$this->load->view('settings/cscm/states', $this->data);
				}
		}

		function cities_ajax($offset = 1) {
				$search = $this->input->post('searchdata');
				if (!empty ($search)) {
						$searchterm = $this->input->post('searchdata');
						$this->data['searchterm'] = $this->input->post('searchdata');
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->search_all_cities($searchterm);
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_cities'] = $this->countries_model->search_all_cities_limit($searchterm, $this->data['perpage'], $offset);
						$this->load->view('settings/cscm/cities', $this->data);
				}
				else {
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->get_all_cities();
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_cities'] = $this->countries_model->get_all_cities_limit($this->data['perpage'], $offset);
						$this->load->view('settings/cscm/cities', $this->data);
				}
		}

		function combined_ajax($offset = 1) {
				$search = $this->input->post('searchdata');
				if (!empty ($search)) {
						$searchterm = $this->input->post('searchdata');
						$this->data['searchterm'] = $this->input->post('searchdata');
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->search_all_combined($searchterm);
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_combined'] = $this->countries_model->search_all_combined_limit($searchterm, $this->data['perpage'], $offset);
						$this->data['all_countries'] = $this->countries_model->get_all_countries();
						$this->data['all_states'] = $this->countries_model->get_all_states();
						$this->data['all_cities'] = $this->countries_model->get_all_cities();
						$this->load->view('settings/cscm/combined', $this->data);
				}
				else {
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->get_all_combined();
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_combined'] = $this->countries_model->get_all_combined_limit($this->data['perpage'], $offset);
						$this->data['all_countries'] = $this->countries_model->get_all_countries();
						$this->data['all_states'] = $this->countries_model->get_all_states();
						$this->data['all_cities'] = $this->countries_model->get_all_cities();
						$this->load->view('settings/cscm/combined', $this->data);
				}
		}

		function countries_ajax($offset = 1) {
				$search = $this->input->post('searchdata');
				if (!empty ($search)) {
						$searchterm = $this->input->post('searchdata');
						$this->data['searchterm'] = $this->input->post('searchdata');
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->search_all_countries($searchterm);
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_countries'] = $this->countries_model->search_all_countries_limit($searchterm, $this->data['perpage'], $offset);
						$this->load->view('settings/cscm/countries', $this->data);
				}
				else {
						$this->data['ajaxreq'] = '1';
						$this->data['perpage'] = $this->input->post('perpage');
						$this->data['p_fro'] = $offset;
						$this->data['count'] = $this->countries_model->get_all_countries_count();
						$this->data['paginationCount'] = getPagination($this->data['count']['nums'], $this->data['perpage'], $offset);
						$this->data['all_countries'] = $this->countries_model->get_all_countries_limit($this->data['perpage'], $offset);
						$this->load->view('settings/cscm/countries', $this->data);
				}
		}

		public function dummy() {
				$this->data['main_content'] = 'modules/hotels/dummy';
				$this->data['page_title'] = 'Social Connections';
				$this->load->view('template', $this->data);
		}

		function integrations() {
				$hasintegration = $this->ptmodules->has_integration();
				if ($hasintegration) {
						$this->data['modules'] = $this->ptmodules->integratedmodules;
						$this->data['main_content'] = 'settings/integrations';
						$this->data['page_title'] = 'Modules';
						$this->load->view('template', $this->data);
				}
				else {
						redirect('admin/settings');
				}
		}

        function api(){

              $submit = $this->input->post('mobilesettings');
              if(!empty($submit)){
                $data = array(
                'default_gateway' => $this->input->post('defaultgateway')
                );
                $this->db->where('user','webadmin');
                $this->db->update('pt_app_settings',$data);
                $this->session->set_flashdata('flashmsgs', 'Updated Successfully');
                redirect('admin/settings/mobile');

              }
              $this->data['settings'] = $this->settings_model->get_settings_data();
              $this->load->model('payments_model');
              $this->data['all_payments'] = $this->payments_model->get_all_payments_back();
              $this->data['main_content'] = 'settings/api';
              $this->data['page_title'] = 'API Settings';
              $this->load->view('template', $this->data);
        }

       public function currencies(){
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('pt_currencies');
        $xcrud->columns('name,symbol,code,rate,is_active,is_default');
        $xcrud->column_callback('is_default', 'MakeDefault');
        $xcrud->search_columns('name,symbol,code,rate,is_active');
        $xcrud->label('is_active','Active')->label('is_default','Default');
        $xcrud->fields('name,symbol,code,rate,is_active');
        $this->data['content'] = $xcrud->render();
        $this->data['page_title'] = 'Currencies Management';
        $this->data['main_content'] = 'temp_view';
        $this->data['header_title'] = 'Currencies Management';
        $this->load->view('template', $this->data);

       }

       function redirectSettings($param){
      redirect('admin/settings/'.$param,'refresh');
   }

}