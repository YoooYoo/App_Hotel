<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Hotels extends MX_Controller
{
    private $data = array();
    private $validlang;

    function __construct()
    {
        parent:: __construct();
        modules:: load('home');
        $this->load->library('hotels/hotels_lib');
        $this->load->model('hotels/hotels_model');
        $this->load->model('hotels/context_model');
        $this->data['phone'] = $this->load->get_var('phone');
        $this->data['contactemail'] = $this->load->get_var('contactemail');
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $this->data['usersession'] = $this->session->userdata('pt_logged_customer');

        $chk = modules:: run('home/is_main_module_enabled', 'hotels');
        if (!$chk) {
            Error_404($this->data);
        }

        $languageid = $this->uri->segment(2);
        $this->validlang = pt_isValid_language($languageid);

        if ($this->validlang) {
            $this->data['lang_set'] = $languageid;
        } else {
            $this->data['lang_set'] = $this->session->userdata('set_lang');
        }

        $defaultlang = pt_get_default_language();
        if (empty ($this->data['lang_set'])) {
            $this->data['lang_set'] = $defaultlang;
        }

        $this->lang->load("front", $this->data['lang_set']);
        $this->hotels_lib->set_lang($this->data['lang_set']);
        $this->data['hotelslib'] = $this->hotels_lib;
    }

    public function index()
    {
        $this->load->library('myweather');
        $this->load->library('hotels/hotels_calendar_lib');
        $this->data['calendar'] = $this->hotels_calendar_lib;
        $this->data['myweather_staus'] = $this->myweather->weather_module_details();
        $settings = $this->settings_model->get_front_settings('hotels');
        $this->data['minprice'] = $settings[0]->front_search_min_price;
        $this->data['maxprice'] = $settings[0]->front_search_max_price;
        if ($this->validlang) {

            $hotelname = $this->uri->segment(3);

        } else {

            $hotelname = $this->uri->segment(2);
        }

        $check = $this->hotels_model->hotel_exists($hotelname);
        if ($check && !empty($hotelname)) {

            $this->hotels_lib->set_hotelid($hotelname);
            $this->data['hotel'] = $this->hotels_lib->hotel_details();

            $this->data['rooms'] = $this->hotels_lib->hotel_rooms($this->data['hotel']->id);

            // Availability Calender settings variables
            $this->data['from1'] = date("F Y");
            $this->data['to1'] = date("F Y", strtotime('+6 months'));
            $this->data['from2'] = date("F Y", strtotime('+7 months'));
            $this->data['to2'] = date("F Y", strtotime('+12 months'));
            $this->data['from3'] = date("F Y", strtotime('+13 months'));
            $this->data['to3'] = date("F Y", strtotime('+18 months'));
            $this->data['from4'] = date("F Y", strtotime('+19 months'));
            $this->data['to4'] = date("F Y", strtotime('+24 months'));
            $this->data['first'] = date("m") . "," . date("Y");
            $this->data['second'] = date("m", strtotime('+7 months')) . "," . date("Y", strtotime('+7 months'));
            $this->data['third'] = date("m", strtotime('+13 months')) . "," . date("Y", strtotime('+13 months'));
            $this->data['fourth'] = date("m", strtotime('+19 months')) . "," . date("Y", strtotime('+19 months'));

            // End Availability Calender settings variables
            $this->data['tripadvisorinfo'] = tripAdvisorInfo($this->data['hotel']->tripadvisorid);
            if (pt_is_module_enabled('reviews')) {
                $this->data['reviews'] = $this->hotels_lib->hotelReviews($this->data['hotel']->id);
                $this->data['avgReviews'] = $this->hotels_lib->hotelReviewsAvg($this->data['hotel']->id);
            }
            $this->data['page_title'] = $this->data['hotel']->title;
            $this->data['metakey'] = $this->data['hotel']->keywords;
            $this->data['metadesc'] = $this->data['hotel']->metadesc;
            $this->data['langurl'] = base_url() . "hotels/{langid}/" . $this->data['hotel']->slug;

            // Get context data
            $context = $this->context_model->getContext();
            $this->data['contexts'] = !empty($context['all']) ? $context['all'] : null;

            $this->theme->view('hotels/hotel', $this->data);
        } else {
            $this->listing();
        }
    }

    function listing($offset = null)
    {
        $this->data['sorturl'] = base_url() . 'hotels/listings?';
        $settings = $this->settings_model->get_front_settings('hotels');
        $this->data['minprice'] = $settings[0]->front_search_min_price;
        $this->data['maxprice'] = $settings[0]->front_search_max_price;
        //$this->data['popular_hotels'] = $this->hotels_model->popular_hotels_front();
        $allhotels = $this->hotels_lib->show_hotels($offset);
        $this->data['hotelTypes'] = $this->hotels_lib->getHotelTypes();
        $this->data['checkin'] = @$_GET['checkin'];
        $this->data['checkout'] = @$_GET['checkout'];
        if (empty($checkin)) {
            $this->data['checkin'] = $this->hotels_lib->checkin;
        }

        if (empty($checkout)) {
            $this->data['checkout'] = $this->hotels_lib->checkout;
        }

        $chin = $this->hotels_lib->checkin;
        $chout = $this->hotels_lib->checkout;
        if (empty($chin) || empty($chout)) {
            $this->data['pricehead'] = trans('0396');
        } else {
            $this->data['pricehead'] = trans('0397') . " " . $this->hotels_lib->stay . " " . trans('0122');

        }
        $this->data['hotels'] = $allhotels['all_hotels'];
        $this->data['info'] = $allhotels['paginationinfo'];
        $this->data['plinks2'] = $allhotels['plinks2'];
        $this->data['page_title'] = $settings[0]->header_title;
        $this->data['langurl'] = base_url() . "hotels/{langid}";
        $this->theme->view('hotels/hotels', $this->data);
    }

    function search($offset = null)
    {
        $surl = http_build_query($_GET);
        $this->data['sorturl'] = base_url() . 'hotels/search?' . $surl . '&';
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $adult = $this->input->get('adults');
        $child = $this->input->get('child');
        $type = $this->input->get('type');
        $txtsearch = $this->input->get('searching');

        if (array_filter($_GET)) {
            if (!empty ($txtsearch)) {
                $allhotels = $this->hotels_lib->search_hotels_by_text($offset);
            } else {
                $allhotels = $this->hotels_lib->search_hotels($offset);
            }
            $this->data['hotels'] = $allhotels['all'];
            $this->data['info'] = $allhotels['paginationinfo'];

            $this->data['plinks'] = $allhotels['plinks'];
        } else {
            $this->data['hotels'] = array();
        }
        $this->data['checkin'] = @$_GET['checkin'];
        $this->data['checkout'] = @$_GET['checkout'];
        if (empty($checkin)) {
            $this->data['checkin'] = $this->hotels_lib->checkin;
        }

        if (empty($checkout)) {
            $this->data['checkout'] = $this->hotels_lib->checkout;
        }


        $chin = $this->hotels_lib->checkin;
        $chout = $this->hotels_lib->checkout;
        if (empty($chin) || empty($chout)) {
            $this->data['pricehead'] = trans('0396');
        } else {
            $this->data['pricehead'] = trans('0397') . " " . $this->hotels_lib->stay . " " . trans('0122');

        }
        $settings = $this->settings_model->get_front_settings('hotels');
        $this->data['minprice'] = $settings[0]->front_search_min_price;
        $this->data['maxprice'] = $settings[0]->front_search_max_price;
        $this->data['page_title'] = 'Search Results';
        $this->data['metakey'] = $txtsearch . " " . $country;
        $this->data['metadesc'] = $txtsearch . " " . $country;
        $this->data['langurl'] = base_url() . "hotels/{langid}";
        $this->theme->view('hotels/hotels', $this->data);
    }

    function book($hotelname)
    {
        $check = $this->hotels_model->hotel_exists($hotelname);
        $this->load->library("paymentgateways");
        //echo "<pre>";
        //print_r($this->paymentgateways->getAllGateways());
        //echo "</pre>";
        if ($check && !empty($hotelname)) {
            $this->load->model('admin/payments_model');
            $this->data['error'] = "";
            $this->hotels_lib->set_hotelid($hotelname);
            $hotelID = $this->hotels_lib->get_id();
            $roomID = $this->input->get('roomid');
            $roomsCount = $this->input->get('roomscount');
            $extrabeds = $this->input->get('extrabeds');
            $bookInfo = $this->hotels_lib->getBookResultObject($hotelID, $roomID, $roomsCount, $extrabeds);
            $this->data['hotel'] = $bookInfo['hotel'];
            $this->data['room'] = $bookInfo['room'];
            if ($this->data['room']->price < 1 || $this->data['room']->stay < 1) {
                $this->data['error'] = "error";
            }
            // $this->data['paymentTypes'] = $this->payments_model->get_all_payments_front();
            $this->load->model('admin/accounts_model');
            $loggedin = $this->loggedin = $this->session->userdata('pt_logged_customer');
            $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
            $this->data['page_title'] = $this->data['hotel']->title;
            $this->data['metakey'] = $this->data['hotel']->keywords;
            $this->data['metadesc'] = $this->data['hotel']->metadesc;
            $this->theme->view('hotels/booking', $this->data);
        } else {
            redirect("hotels");
        }
    }

    function txtsearch()
    {
        echo $this->hotels_model->textsearch();
    }

    function roomcalendar()
    {
        $this->load->library('hotels/hotels_calendar_lib');
        $this->data['calendar'] = $this->hotels_calendar_lib;
        $this->data['roomid'] = $this->input->post('roomid');
        $monthYear = explode(",", $this->input->post('monthyear'));
        $this->data['initialmonth'] = $monthYear[0];
        $this->data['year'] = $monthYear[1];

        $this->load->view('calendar', $this->data);
    }
}