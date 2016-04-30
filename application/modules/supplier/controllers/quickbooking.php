<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Quickbooking extends MX_Controller {
    private $data = array();
    public $role;

    function __construct() {
        modules :: load('supplier');
        $chksupplier = modules :: run('supplier/validsupplier');
        if (!$chksupplier) {
            redirect('supplier');
        }
        $this->load->model('admin/bookings_model');
        $this->load->model('admin/payments_model');
        $this->load->helper('check');
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $this->data['applytax'] = $this->session->userdata('applytax');
        $this->lang->load("back", "en");  
    }

    function index() {
        $userid = $this->session->userdata('pt_logged_supplier');
        $booknow = $this->input->post('booknow');
        $usertype = $this->input->post('usertype');
        $customer = $this->input->post('customer');
        if (!empty ($booknow)) {
            if ($usertype == "registered") {
                        $this->bookings_model->doQuickBooking($customer); 
                        }
                        else {
                        $this->bookings_model->doGuestBooking('quick'); 
                        }
            redirect(base_url() . "supplier/bookings");
        }
        $this->data['modules'] = $this->modules_model->get_module_names();
        $this->data['chklib'] = $this->ptmodules;
        $this->data['service'] = $this->input->get('service');
        $this->data['customers'] = $this->accounts_model->get_active_customers();
//hotels module
        if ($this->data['service'] == "hotels") {
            $this->data['checkinlabel'] = "Check-In";
            $this->data['checkoutlabel'] = "Check-Out";
            $this->data['hotels'] = $this->hotels_model->all_hotels_names($userid);
        }
//end hotels module
//cars module
        if ($this->data['service'] == "cars") {
            $this->data['checkinlabel'] = "Pick Up";
            $this->data['checkoutlabel'] = "Drop Off";
            $this->load->model('cars/cars_model');
            $this->data['cars'] = $this->cars_model->all_cars_names($userid);
        }
//tours module
        if ($this->data['service'] == "tours") {
            $this->data['checkinlabel'] = "Start Date";
            $this->data['checkoutlabel'] = "End Date";
            $this->load->model('tours/tours_model');
            $this->data['tours'] = $this->tours_model->all_tours_names($userid);
        }
//end tours module
//end cars module
       $this->data['paygateways'] = $this->payments_model->getAllPaymentsBack();
        $this->data['main_content'] = 'admin/quickbooking/index';
        $this->data['page_title'] = 'Quick booking';
        $this->load->view('admin/template', $this->data);
    }

    function populateRooms() {
        $hotelid = $this->input->post('hotelid');
        $this->db->select('room_id,room_hotel,room_title');
        $this->db->where('room_hotel', $hotelid);
        $rooms = $this->db->get('pt_rooms')->result();
        $html = "<option value=''>Select Room</option>";
        foreach ($rooms as $room) {
            $id = $room->room_id;
            $html .= "<option value=$id>" . $room->room_title . "</option>";
        }
        echo $html;
    }

    function hoteldetails() {
        $hotelid = $this->input->post('item');
        $this->db->select('hotel_title,hotel_comm_fixed,hotel_comm_percentage,hotel_tax_fixed,hotel_tax_percentage');
        $this->db->where('hotel_id', $hotelid);
        $hotel = $this->db->get('pt_hotels')->result();
        if ($hotel[0]->hotel_comm_fixed > 0) {
            $comtype = "fixed";
            $comval = $hotel[0]->hotel_comm_fixed;
        }
        elseif ($hotel[0]->hotel_comm_percentage > 0) {
            $comtype = "percentage";
            $comval = $hotel[0]->hotel_comm_percentage;
        }
        if ($hotel[0]->hotel_tax_fixed > 0) {
            $taxtype = "fixed";
            $taxval = $hotel[0]->hotel_tax_fixed;
        }
        elseif ($hotel[0]->hotel_tax_percentage > 0) {
            $taxtype = "percentage";
            $taxval = $hotel[0]->hotel_tax_percentage;
        }
        $result = json_encode(array('title' => $hotel[0]->hotel_title, 'comm_type' => $comtype, 'comm_val' => $comval, 'tax_type' => $taxtype, 'tax_val' => $taxval, 'id' => $hotelid, 'btype' => 'hotels'));
        echo $result;
    }

    function hroomdetails() {
         $roomid = $this->input->post('roomid');
                $checkin = $this->input->post('checkin');
                $checkout = $this->input->post('checkout');
                $this->load->library('hotels/hotels_lib');                
                $title = $this->hotels_lib->getRoomTitleOnly($roomid);
                $info = $this->rooms_model->getRoomPrice($roomid,$checkin,$checkout);
                $bookedrooms = pt_is_room_booked($roomid, $checkin, $checkout);
                $quantity = $info['quantity'];
                $availablerooms = $quantity - $bookedrooms;
                $nights = $info['stay'];
          
                 $optionstxt = "";
                if ($availablerooms > 0) {
                        for ($i = 1; $i <= $availablerooms; $i++) {
                                $optionstxt .= "<option value=$i>$i</option>";
                        }
                }

                        $result = json_encode(array(
                    'roomtitle' => $title, 
                    'info' => $info,
                    'price' => $info['perNight'],
                    'avail_rooms' => $availablerooms,
                    'quantity' => $optionstxt,
                    'stay' => $nights,
                    'currency' => $this->data['app_settings'][0]->currency_sign
                    ));



                echo $result;
    }

    function totalnights() {
        $checkin = $this->input->post('checkin');
        $checkout = $this->input->post('checkout');
        $nights = pt_count_days($checkin, $checkout);
        $result = json_encode(array('stay' => $nights));
        echo $result;
    }

    function hotelsupps() {
        $hotelid = $this->input->post('hotelid');
                $this->load->library('hotels/hotels_lib');
                $this->hotels_lib->set_id($hotelid);
                $sups = $this->hotels_lib->hotelExtras();

                if (!empty ($sups)) {
                        $has_sups = 1;
                }
                else {
                        $has_sups = 0;
                }
                $suphtml = "
<table class='table table-srtiped'>
  <thead>
    <tr>
      <td><b>Name</b></td>
      <td><b>Price</b></td>
      <td><b>Order</b></td>
    </tr>
  </thead>
  <tbody>
    ";
                $currencysign = $this->data['app_settings'][0]->currency_sign;
                foreach ($sups as $sup) {
                        $id = "extras_" . $sup->id;
                        $js = "select_sup($(this).data('price'),$(this).data('title'),$sup->id,'$currencysign');";
                        $suptitle = "data-title=" . str_replace(" ", "&nbsp;", $sup->extraTitle);
                        $supmainprice = $sup->extraPrice;
                        
                        $suphtml .= "
    <tr>
      <td>" . $sup->extraTitle . "</td>
      <td>$currencysign$supmainprice </td>
      " . "
      <td> <input type='checkbox' class='extras' id=$id $suptitle data-price=$supmainprice onclick=$js    name='extras[]'  value=$sup->id  ></td>
    </tr>
    ";
                }
                $suphtml .= "
  </tbody>
</table>
";
                $result = json_encode(array('hassups' => $has_sups, 'extras' => $suphtml));
                echo $result;
    }

    function applytax() {
        $resp = $this->input->post('apply');
        if ($resp == "yes") {
            $this->session->set_userdata('applytax', 'yes');
        }
        else {
            $this->session->set_userdata('applytax', 'no');
        }
    }

    function carprice() {
        $this->load->helper('check');
        $this->load->helper('cars/cars_front');
        $carid = $this->input->post('carid');
        $checkin = $this->input->post('checkin');
        $checkout = $this->input->post('checkout');
        $nights = pt_count_days($checkin, $checkout);
        $this->db->select('car_title,car_comm_fixed,car_comm_percentage,car_tax_fixed,car_tax_percentage');
        $this->db->where('car_id', $carid);
        $car = $this->db->get('pt_cars')->result();
        if ($car[0]->car_comm_fixed > 0) {
            $comtype = "fixed";
            $comval = $car[0]->car_comm_fixed;
        }
        elseif ($car[0]->car_comm_percentage > 0) {
            $comtype = "percentage";
            $comval = $car[0]->car_comm_percentage;
        }
        if ($car[0]->car_tax_fixed > 0) {
            $taxtype = "fixed";
            $taxval = $car[0]->car_tax_fixed;
        }
        elseif ($car[0]->car_tax_percentage > 0) {
            $taxtype = "percentage";
            $taxval = $car[0]->car_tax_percentage;
        }
        $mainprice = car_booking_adv_price($carid, $checkin, $checkout);
        $caramount = $mainprice * $nights;
        $result = json_encode(array('title' => $car[0]->car_title, 'comm_type' => $comtype, 'comm_val' => $comval, 'tax_type' => $taxtype, 'tax_val' => $taxval, 'id' => $carid, 'btype' => 'cars', 'car_amount' => $caramount, 'mainprice' => $mainprice, 'stay' => $nights));
        echo $result;
    }

    function tourprice() {
        $this->load->helper('check');
        $this->load->helper('tours/tours_front');
        $tourid = $this->input->post('tourid');
/*  $checkin = $this->input->post('checkin');
$checkout = $this->input->post('checkout');
$nights =  pt_count_days($checkin,$checkout); */
        $this->db->select('tour_title,tour_comm_fixed,tour_comm_percentage,tour_tax_fixed,tour_tax_percentage,tour_package_type,tour_max_infant,tour_max_adults,tour_max_child,tour_adult_price,tour_child_price,tour_infant_price,tour_basic_price,tour_group_price,tour_end_date,tour_start_date');
        $this->db->where('tour_id', $tourid);
        $tour = $this->db->get('pt_tours')->result();
        if ($tour[0]->tour_comm_fixed > 0) {
            $comtype = "fixed";
            $comval = $tour[0]->tour_comm_fixed;
        }
        elseif ($tour[0]->tour_comm_percentage > 0) {
            $comtype = "percentage";
            $comval = $tour[0]->tour_comm_percentage;
        }
        if ($tour[0]->tour_tax_fixed > 0) {
            $taxtype = "fixed";
            $taxval = $tour[0]->tour_tax_fixed;
        }
        elseif ($tour[0]->tour_tax_percentage > 0) {
            $taxtype = "percentage";
            $taxval = $tour[0]->tour_tax_percentage;
        }
        $ttype = $tour[0]->tour_package_type;
        $adultmax = $tour[0]->tour_max_adults;
        $maxchild = $tour[0]->tour_max_child;
        $maxinfant = $tour[0]->tour_max_infant;
        $adultselect = "";
        $childselect = "";
        $infantselect = "";
        if ($tour[0]->tour_package_type == "group") {
            $mainprice = $tour[0]->tour_group_price;
            for ($a = 1; $a <= $adultmax; $a++) {
                $adultselect .= "<option value=$a>$a</option>";
            }
            for ($c = 0; $c <= $maxchild; $c++) {
                $childselect .= "<option value=$c>$c</option> ";
            }
            for ($i = 0; $i <= $maxinfant; $i++) {
                $infantselect .= "<option value=$i>$i</option> ";
            }
        }
        else {
            $mainprice = 1 * $tour[0]->tour_adult_price;
            for ($a = 1; $a <= $adultmax; $a++) {
                $aprice = $a * $tour[0]->tour_adult_price;
                $adultselect .= "<option value=$a>$a = $aprice</option>";
            }
            for ($c = 0; $c <= $maxchild; $c++) {
                $cprice = $c * $tour[0]->tour_child_price;
                $childselect .= "<option value=$c>$c = $cprice</option> ";
            }
            for ($i = 0; $i <= $maxinfant; $i++) {
                $iprice = $i * $tour[0]->tour_infant_price;
                $infantselect .= "<option value=$i>$i = $iprice</option> ";
            }
        }
        if ($ttype == "group") {
            $subitem = "Adults_0_1";
            $priceadult = 0;
            $pricechild = 0;
            $priceinfant = 0;
            $startdate = $tour[0]->tour_start_date;
            $enddate = $tour[0]->tour_end_date;
        }
        else {
            $subitem = "Adults_" . $mainprice . "_1";
            $priceadult = $tour[0]->tour_adult_price;
            $pricechild = $tour[0]->tour_child_price;
            $priceinfant = $tour[0]->tour_infant_price;
            $startdate = "";
            $enddate = "";
        }
        $result = json_encode(array('title' => $tour[0]->tour_title, 'comm_type' => $comtype, 'comm_val' => $comval, 'tax_type' => $taxtype, 'tax_val' => $taxval, 'id' => $tourid, 'btype' => 'tours', 'tour_amount' => $touramount, 'adultselect' => $adultselect, 'childselect' => $childselect, 'infantselect' => $infantselect, 'maxadult' => $adultmax, 'maxchild' => $maxchild, 'maxinfant' => $maxinfant, 'ttype' => $ttype, 'mainprice' => $mainprice, 'subitem' => $subitem, 'priceadult' => $priceadult, 'pricechild' => $pricechild, 'priceinfant' => $priceinfant, 'startdate' => $startdate, 'enddate' => $enddate));
        echo $result;
    }

}