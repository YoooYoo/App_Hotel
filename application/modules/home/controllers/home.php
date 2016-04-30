<?php
if ( ! defined('BASEPATH')) {
    exit ( 'No direct script access allowed' );
}

class Home extends MX_Controller
{

    private $data = [ ];

    private $validlang;


    function __construct()
    {
        modules:: load('front');
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $this->data['geo']          = $this->load->get_var('geolib');
        $this->data['phone']        = $this->load->get_var('phone');
        $this->data['contactemail'] = $this->load->get_var('contactemail');

        $pageslugg       = $this->uri->segment(1);
        $this->validlang = pt_isValid_language($pageslugg);
        if ($this->validlang) {
            $this->data['lang_set'] = $pageslugg;
        } else {
            $this->data['lang_set'] = $this->session->userdata('set_lang');
        }

        $defaultlang = pt_get_default_language();

        if (empty ( $this->data['lang_set'] )) {
            $this->data['lang_set'] = $defaultlang;
        }


    }


    public function index()
    {
        $this->lang->load("front", $this->data['lang_set']);
        $pageslug   = $this->uri->segment(1);
        $secondslug = $this->uri->segment(2);
        $this->load->library('myweather');
        $this->load->library('sliders_lib');
        $this->data['sliderlib']       = $this->sliders_lib;
        $this->data['myweather_staus'] = $this->myweather->weather_module_details();
        if ($this->data['myweather_staus'][0]->status == '1') {
            $this->data['myweather'] = $this->myweather->get_weather(7);
        }

        $langid      = $this->session->userdata('set_lang');
        $defaultlang = pt_get_default_language();
        if (empty ( $langid )) {
            $langid = $defaultlang;
        }
        if ($this->validlang) {
            $pageslug = $this->uri->segment(2);
        }
        $check = $this->cms_model->check($pageslug);

        if ($pageslug == null || $this->validlang && empty( $secondslug )) {
            $this->load->model('admin/special_offers_model');
            if (pt_main_module_available('hotels')) {
                $this->load->library('hotels/hotels_lib');
                $this->data['hotelslib'] = $this->hotels_lib;
                $this->load->helper("hotels/hotels");
                $this->load->model('hotels/hotels_model');

                //	$this->data['latest_hotels'] = $this->hotels_model->latest_hotels_front();
                $this->data['featuredHotels'] = $this->hotels_lib->getFeaturedHotels();
                $this->data['popularHotels']  = $this->hotels_lib->getTopRatedHotels();
                //	$this->data['hero_hotels'] = $this->hotels_lib->hero_hotels_list();
                //	$this->data['mini_hero_hotels'] = $this->hotels_lib->mini_hero_hotels_list();
            }

            if (pt_main_module_available('tours')) {
                $this->load->library('tours/tours_lib');
                $this->data['tourslib'] = $this->tours_lib;
                $this->load->helper("tours/tours_front");
                $this->load->model('tours/tours_model');
                $this->data['featured_tours'] = $this->tours_lib->featured_tours_list();
            }
            if (pt_main_module_available('cars')) {
                $this->load->library('cars/cars_lib');
                $this->data['carslib'] = $this->cars_lib;
                $this->load->helper("cars/cars_front");
                $this->load->model('cars/cars_model');
                $this->data['latest_cars'] = $this->cars_model->latest_cars_front();
            }
            if (pt_main_module_available('cruises')) {
                $this->load->helper("cruises/cruises_front");
                $this->load->model('cruises/cruises_model');
                $this->data['latest_cruises'] = $this->cruises_model->latest_cruises_front();
            }
            if (pt_main_module_available('blog')) {
                $this->load->library('blog/blog_lib');
                $this->data['bloglib'] = $this->blog_lib;
                $this->load->helper("blog/blog_front");
                $this->data['posts'] = $this->blog_lib->latest_posts_homepage();
            }
            $dohopsettings   = $this->settings_model->get_front_settings("flightsdohop");
            $hotelsettings   = $this->settings_model->get_front_settings("hotels");
            $bookingsettings = $this->settings_model->get_front_settings("booking");

            $this->data['topcities']     = explode(",", $hotelsettings[0]->front_top_cities);
            $this->data['offersenabled'] = $this->is_module_enabled('offers');
            if ($this->data['offersenabled']) {
                $this->load->library('offers_lib');
                $sOffers                     = $this->offers_lib->getHomePageOffers();
                $this->data['specialoffers'] = $sOffers['offers'];
                $this->data['offersCount']   = $sOffers['count'];
            }

            $this->data['checkin']       = date($this->data['app_settings'][0]->date_f,
                strtotime('+' . CHECKIN_SPAN . ' day', time()));
            $this->data['checkout']      = date($this->data['app_settings'][0]->date_f,
                strtotime('+' . CHECKOUT_SPAN . ' day', time()));
            $this->data['dohopusername'] = $dohopsettings[0]->cid;
            $this->data['affiliate']     = $bookingsettings[0]->cid;
            $this->data['main_content']  = 'index';
            $this->data['langurl']       = base_url() . "{langid}";
            $this->data['page_title']    = 'Home page';
            $this->theme->view('home/index', $this->data);
        } elseif ($check) {

            $content = $this->cms_model->get_page_content($pageslug, $langid);
            if (empty ( $content )) {
                $content = $this->cms_model->get_page_content($pageslug, '1');
            }
            $submitcontactform  = $this->input->post('submit_contact');
            $this->data['res2'] = $this->settings_model->get_contact_page_details();
            if ( ! empty ( $submitcontactform )) {
                $this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('contact_message', 'Message', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $this->data['validationerrors'] = validation_errors();
                } else {
                    $this->load->model("admin/emails_model");
                    $senddata = [
                        'contact_email'   => $this->input->post('contact_email'),
                        'contact_name'    => $this->input->post('contact_name'),
                        'contact_subject' => $this->input->post('contact_subject'),
                        'contact_message' => $this->input->post('contact_message')
                    ];
                    $this->emails_model->send_contact_email($this->data['res2'][0]->contact_email, $senddata);
                    $this->data['successmsg'] = "Message Sent Successfully";
                }
            }
            $this->data['page_contents'] = $content;
            $this->data['main_content']  = 'cms/page-data';
            $this->data['page_title']    = @ $content[0]->content_page_title;
            $this->data['langurl']       = base_url() . "{langid}/" . $pageslug;

            if (strpos(@ $content[0]->content_body, '{contact_us}') !== false) {
                $this->data['res'] = $this->settings_model->get_business_hours();
                $this->theme->view('contact', $this->data);
            } elseif (strpos(@ $content[0]->content_body, '{optional}') !== false) {
                $this->theme->view('optional', $this->data);
            } else {
                $this->theme->view('cms/page-data', $this->data);
            }
        } else {
            Error_404($this->data);
        }
    }


    function supplier_register()
    {
        $this->lang->load("front", $this->data['lang_set']);
        $allowsupplierreg = $this->data['app_settings'][0]->allow_supplier_registration;
        if ($allowsupplierreg == "0") {
            Error_404();
            exit;
        }
        $this->load->model('admin/countries_model');
        $this->load->model('admin/accounts_model');
        $this->data['error']   = "";
        $this->data['success'] = $this->session->flashdata('success');
        $addaccount            = $this->input->post('addaccount');
        $url                   = http_build_query($_GET);
        if ( ! empty ( $addaccount )) {
            $this->form_validation->set_rules('email', 'Email',
                'trim|required|valid_email|is_unique[pt_accounts.accounts_email]');
            $this->form_validation->set_message('valid_email', 'Kindly Enter a Valid Email Address.');
            $this->form_validation->set_message('is_unique', 'Email Address is Already in Use.');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim');
            $this->form_validation->set_rules('state', 'State', 'trim');
            $this->form_validation->set_rules('fname', 'First Name', 'trim');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim');
            $this->form_validation->set_rules('address1', 'address 1', 'trim');
            $this->form_validation->set_rules('address2', 'address 2', 'trim');
            $this->form_validation->set_rules('mobile', 'mobile', 'trim');
            if ($this->form_validation->run() == false) {
                $this->data['error'] = validation_errors();
            } else {
                /* if(isset($_FILES['photo']) && !empty($_FILES['photo']['name'])){



                $result = $this->uploads_model->__profileimg();

                if($result == '1'){

                $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";



                }elseif($result == '2'){



                $this->data['errormsg'] = "Only upto 2MB size photos allowed";



                }elseif($result == '3'){





                $this->session->set_flashdata('flashmsgs', "Customer Account Added Successfully");



                redirect('admin/accounts/customers/');



                }

                }else{*/
                $this->accounts_model->register_supplier();
                $this->session->set_flashdata('success', trans('0244'));
                redirect(base_url() . 'supplier-register');
//   }
            }
        }
        $this->data['allcountries'] = $this->countries_model->get_all_countries();
        $this->data['modules']      = $this->available_modules();
        $this->data['page_title']   = "supplier Registration";
        $this->theme->view('supplier-register', $this->data);
    }


// get all available modules for front - without integration modules
    function available_modules()
    {
        $modules     = [ ];
        $modlib      = $this->ptmodules;
        $mainmodules = $modlib->moduleslist;
        $notallowed  = [ "blog" ];
        foreach ($mainmodules as $mainmod) {
            $istrue        = $modlib->is_mod_available_enabled($mainmod);
            $isintegration = $modlib->is_integration($mainmod);
            if ($istrue && ! $isintegration && ! in_array($mainmod, $notallowed)) {
                $modules[] = $mainmod;
            }
        }

        return $modules;
    }


// check module availability
    function is_module_enabled($module)
    {
        $result = $this->modules_model->check_module($module);

        return $result;
    }


// check main module availability
    function is_main_module_enabled($module)
    {
        $result = $this->modules_model->check_main_module($module);

        return $result;
    }


//subscribe to newsletter
    function subscribe()
    {
        if ( ! $this->input->is_ajax_request()) {
            redirect(base_url());
        } else {
            $this->load->model('admin/newsletter_model');
            $email = $this->input->post('email');
            $this->form_validation->set_message('valid_email', 'Kindly Enter a Valid Email Address.');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == false) {
                echo validation_errors();
            } else {
                $res = $this->newsletter_model->add_subscriber($email);
                if ($res) {
                    echo 'Subscribed Successfully';
                } else {
                    echo 'Already Subscribed';
                }
            }
        }
    }


    function txtsearch()
    {
        $q     = $this->input->get('q');
        $r     = $this->input->get('type');
        $term  = mysql_real_escape_string($q);
        $query = $this->db->query("SELECT short_name as name FROM pt_countries WHERE short_name LIKE '%$term%'

	UNION

          SELECT state_name as name FROM pt_states WHERE state_name LIKE '%$term%'

	UNION

		 SELECT city_name as name FROM pt_cities WHERE city_name LIKE '%$term%'

	")->result();
        foreach ($query as $qry) {
            echo $qry->name . "\n";
        }
    }


    function trackorder()
    {
        if ($this->input->is_ajax_request()) {
            $this->db->select('booking_status,booking_expiry,booking_deposit,booking_total');
            $this->db->where('booking_id', $this->input->post('code'));
            $rs = $this->db->get('pt_bookings')->result();
            if ( ! empty ( $rs )) {
                $html = "<p>Invoice Status : " . $rs[0]->booking_status . "</p>";
                $html .= "<p>Total : " . $this->data['app_settings'][0]->currency_code . " " . $this->data['app_settings'][0]->currency_sign . $rs[0]->booking_total . "</p>";
                if ($rs[0]->booking_status == "unpaid") {
                    $html .= " <p>Due Date : " . pt_translate_it($rs[0]->booking_expiry) . "</p>";
                }
                echo $html;
            } else {
                echo "<div class='alert alert-danger'>Invalid Code</div>";
            }
        } else {
            redirect(base_url());
        }
    }


    function maps($lat = null, $long = null, $type, $id)
    {
        if (empty ( $lat ) || empty ( $long )) {
            Error_404();
        } else {
            if ($type == "hotel") {
                $this->load->model("hotels/hotels_model");
                $hoteldata = $this->hotels_model->hotel_data_for_map($id);
                $img       = pt_default_hotel_image($id);
                $img       = PT_HOTELS_SLIDER_THUMBS . $img;
                if ( ! empty ( $hoteldata )) {
                    $title = $hoteldata[0]->hotel_title;
                    $slug  = $hoteldata[0]->hotel_slug;
                } else {
                    $title = '';
                }
                $link = site_url('hotels/' . $slug);
                pt_show_map($lat, $long, '100%', '100%', $title, $img, 150, 80, $link);
            } elseif ($type == "cruise") {
                $this->load->model('cruises/cruises_model');
                $cruisedata = $this->cruises_model->cruise_data_for_map($id);
                $img        = pt_default_cruise_image($id);
                if (empty ( $img )) {
                    $img = PT_DEFAULT_IMAGE . 'hotel.png';
                } else {
                    $img = PT_CRUISES_SLIDER_THUMBS . $img;
                }
                if ( ! empty ( $cruisedata )) {
                    $title = $cruisedata[0]->hotel_title;
                    $slug  = $cruisedata[0]->hotel_slug;
                } else {
                    $title = '';
                }
                $link = site_url('cruises/' . $slug);
                pt_show_map($lat, $long, '100%', '100%', $title, $img, 80, 80, $link);
            } elseif ($type == "car") {
                $this->load->model('cars/cars_model');
                $cardata = $this->cars_model->car_data_for_map($id);
                $img     = pt_default_car_image($id);
                if (empty ( $img )) {
                    $img = PT_DEFAULT_IMAGE . 'car.png';
                } else {
                    $img = PT_CARS_SLIDER_THUMB . $img;
                }
                if ( ! empty ( $cardata )) {
                    $title = $cardata[0]->car_title;
                    $slug  = $cardata[0]->car_slug;
                } else {
                    $title = '';
                }
                $link = site_url('cars/' . $slug);
                pt_show_map($lat, $long, '100%', '100%', $title, $img, 80, 80, $link);
            }
        }
    }


    function videos()
    {
        $hotelid = $this->input->post('hotelid');
        if (empty ( $hotelid )) {
            redirect(base_url());
        }
        $this->db->where('vid_hotel_id', $hotelid);
        $this->db->where('vid_approved', '1');
        $this->db->order_by('vid_order', 'asc');
        $q      = $this->db->get('pt_hotel_videos');
        $videos = $q->result();
        foreach ($videos as $vids) {
            ?>

            <?php if ($vids->vid_type != 'uploads') {
                echo pt_embed_videos_front($vids->vid_link);
            } else { ?>

                <video width="200" height="350" controls>

                    <source src="<?php echo PT_HOTELS_VIDEOS . $vids->vid_link; ?>">


                    Your browser does not support the video tag.

                </video>


            <?php } ?>


            <?php
        }
    }

}
