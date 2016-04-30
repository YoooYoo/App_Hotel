<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Bookings extends MX_Controller {
    private $data = array();
    private $myitems = array();
    public $role;

    function __construct() {
        modules :: load('supplier');
        $chksupplier = modules :: run('supplier/validsupplier');
        $this->myitems = modules :: run('supplier/myitems');

        if (!$chksupplier) {
            redirect('supplier');
        }
        $this->load->model('admin/bookings_model');
        $this->data['issupplier'] = $this->session->userdata('pt_logged_supplier');
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;
        $this->data['adminsegment'] = $this->uri->segment(1);
        $this->data['myitems'] = $this->myitems;
    }

    function index() {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('pt_bookings');
        $xcrud->where('pt_bookings.booking_item',$this->myitems);
        $xcrud->join('booking_user', 'pt_accounts', 'accounts_id');
        $xcrud->order_by('booking_id', 'desc');
        $xcrud->columns('booking_id,booking_ref_no,pt_accounts.ai_first_name,booking_type,booking_date,booking_total,booking_amount_paid,booking_remaining,booking_status');
        $xcrud->label('booking_id', 'ID')->label('booking_ref_no', 'Ref No.')->label('pt_accounts.ai_first_name', 'Customer')->label('booking_type', 'Module')->label('booking_date', 'Date')->label('booking_total', 'Total')->label('booking_amount_paid', 'Paid')->label('booking_remaining', 'Remaining')->label('booking_status', 'Status');
        $xcrud->column_callback('booking_date', 'fmtDate');
        $xcrud->search_columns('booking_id,booking_ref_no,pt_accounts.ai_first_name,booking_type,booking_status');
        $xcrud->button(base_url() . 'invoice/?id={booking_id}&sessid={booking_ref_no}', 'View Invoice', 'fa fa-search-plus', 'btn btn-primary', array('target' => '_blank'));
        $xcrud->button(base_url() . $this->data['adminsegment'] . '/bookings/edit/{booking_type}/{booking_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
        
        $delurl = base_url() . 'admin/bookings/delBooking';
        $xcrud->button("javascript: delfunc('{booking_id}','$delurl')",'DELETE','fa fa-times', 'btn-danger',array('target'=>'_self'));
       

        $this->data['add_link'] = base_url() . $this->data['adminsegment'] . '/quickbooking';
        $xcrud->unset_add();
        $xcrud->unset_view();
        $xcrud->unset_remove();
        $xcrud->unset_edit();
        $this->data['content'] = $xcrud->render();
        $this->data['page_title'] = 'Booking Management';
        $this->data['main_content'] = 'xview';
        $this->data['header_title'] = 'Booking Management';
        $this->load->view('admin/template', $this->data);

    }

    


//resend invoice
    function resendinvoice() {
        $invoiceid = $this->input->post('id');
        $refno = $this->input->post('refno');
        $this->load->helper('invoice');
        $invoicedetails = invoiceDetails($invoiceid, $refno);
        $this->load->model('admin/emails_model');
        $this->emails_model->resend_invoice($invoicedetails);
    }

    function edit($module, $id) {

        $this->load->helper('invoice');
        $this->load->model('admin/payments_model');
        $this->data['paygateways'] = $this->payments_model->getAllPaymentsBack();
        $this->data['supptotal'] = 0;
        $updatebooking = $this->input->post('updatebooking');
        if (!empty ($updatebooking)) {
            $this->bookings_model->update_booking($id);
            redirect(base_url() . "supplier/bookings");
        }
        if (!empty ($module) && !empty ($id)) {
            $this->data['chklib'] = $this->ptmodules;
            $refNo = $this->bookings_model->getBookingRefNo($id);
            $this->data['bdetails'] = invoiceDetails($id, $refNo);
            $this->data['service'] = $this->data['bdetails']->module;
            $this->data['applytax'] = "yes";
            foreach ($this->data['bdetails']->bookingExtras as $extras) {
                $bookedextras[] = $extras->id;
                $extrasprices[] = $extras->price;
            }
            $this->data['bookedsups'] = $bookedextras;
            $this->data['supptotal'] = array_sum($extrasprices);
//hotels module
            if ($module == "hotels") {
                $this->load->library('hotels/hotels_lib');
                $this->hotels_lib->set_id($this->data['bdetails']->itemid);
                $this->hotels_lib->hotel_short_details();
                $this->data['tax_type'] = $this->hotels_lib->tax_type;
                $this->data['tax_val'] = $this->hotels_lib->tax_value;
                $this->data['commtype'] = $this->hotels_lib->comm_type;
                $this->data['commvalue'] = $this->hotels_lib->comm_value;
                $this->data['selectedroom'] = $this->data['bdetails']->subItem->id;
                $this->data['subitemprice'] = $this->data['bdetails']->subItem->price;
                $this->data['rquantity'] = $this->data['bdetails']->subItem->quantity;
                $this->data['rtotal'] = $this->data['bdetails']->subItem->price * $this->data['bdetails']->subItem->quantity * $this->data['bdetails']->nights;
                $this->data['hrooms'] = $this->hotels_lib->rooms_id_title_only();
                $this->data['sups'] = $this->hotels_lib->hotelExtras();
                $this->data['totalrooms'] = $this->hotels_lib->room_total_quantity($this->data['bdetails']->subItem->id);
                $this->data['checkinlabel'] = "Check-In";
                $this->data['checkoutlabel'] = "Check-Out";
            }
            elseif ($module == "cars") {
                $this->load->helper('cars/cars_front');
                $this->data['taxdetails'] = pt_tax_details('cars', $this->data['bdetails'][0]->booking_item);
                $this->data['carprice'] = $subitem[0];
                $this->data['itemprice'] = $subitem[0];
                $this->data['totalcarprice'] = $subitem[0] * $this->data['bdetails'][0]->booking_nights;
                $comm = pt_car_commission($this->data['bdetails'][0]->booking_item);
                $this->data['commtype'] = '';
                $this->data['commvalue'] = '';
                if ($comm['fixed_com'] > 0) {
                    $this->data['commtype'] = 'fixed';
                    $this->data['commvalue'] = $comm['fixed_com'];
                }
                $this->data['checkinlabel'] = "Pick Up";
                $this->data['checkoutlabel'] = "Drop Off";
                $this->load->model('cars/cars_model');
                $this->data['cars'] = $this->cars_model->all_cars_names($userid);
            }
            $this->data['main_content'] = 'modules/bookings/edit';
            $this->data['page_title'] = 'Edit Booking';
            $this->load->view('admin/template', $this->data);
        }
        else {
            redirect('supplier/bookings');
        }
    }

    function split_subitem($string) {
        return explode("_", $string);
    }



}