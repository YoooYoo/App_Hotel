<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {

private $data = array();

function __construct(){

parent::__construct();

modules::load('admin');

$chkadmin = modules::run('admin/validadmin');

if(!$chkadmin){

redirect('admin');

}

$this->data['app_settings'] = $this->settings_model->get_settings_data();

$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');


}

public function index()

{

//strtotime(date('Y-m-01'))." ".date('Y-m-t');

$this->data['modules'] = $this->modules_model->get_module_names();

$this->data['chklib'] =  $this->ptmodules;

$filter = $this->input->post('filtermod');

$this->data['selmodule'] = $this->input->post('module');

$module =  $this->data['selmodule'];

if(!empty($filter) && !empty($module)){

$this->$module();

}else{

$this->data['monthly'] = $this->monthly_report();

$this->data['thismonth'] = $this->this_month_report();

$this->data['thisyear'] = $this->this_year_report();

$this->data['thisday'] = $this->this_day_report();

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

}

public function hotels()

{

$this->data['monthly'] = $this->monthly_report('hotels');

$this->data['thismonth'] = $this->this_month_report('hotels');

$this->data['thisyear'] = $this->this_year_report('hotels');

$this->data['thisday'] = $this->this_day_report('hotels');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

public function cruises()

{

$this->data['monthly'] = $this->monthly_report('cruises');

$this->data['thismonth'] = $this->this_month_report('cruises');

$this->data['thisyear'] = $this->this_year_report('cruises');

$this->data['thisday'] = $this->this_day_report('cruises');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

public function tours()

{

$this->data['monthly'] = $this->monthly_report('tours');

$this->data['thismonth'] = $this->this_month_report('tours');

$this->data['thisyear'] = $this->this_year_report('tours');

$this->data['thisday'] = $this->this_day_report('tours');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

public function cars()

{

$this->data['monthly'] = $this->monthly_report('cars');

$this->data['thismonth'] = $this->this_month_report('cars');

$this->data['thisyear'] = $this->this_year_report('cars');

$this->data['thisday'] = $this->this_day_report('cars');

$this->data['main_content'] = 'modules/reports/reports';

$this->data['page_title'] = 'Reports';

$this->load->view('template',$this->data);

}

function this_day_report($type = null){

$first = time() - 86400;

$last  = time();

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$first);

$this->db->where('booking_payment_date <=',$last);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

return round($res[0]->booking_amount_paid,2);

}

function this_month_report($type = null){

$from = strtotime(date('Y-m-01'));

$to = strtotime(date('Y-m-t'));

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$from);

$this->db->where('booking_payment_date <=',$to);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

return round($res[0]->booking_amount_paid,2);

}

function this_year_report($type = null){

$year = date("Y");

$first = strtotime($year."-01-01");

$last  = strtotime($year."-12-31");

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$first);

$this->db->where('booking_payment_date <=',$last);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

return round($res[0]->booking_amount_paid,2);

}

//  from and to date report

function from_to_report(){

$from = str_replace("/","-",$this->input->post('from'));

$to = str_replace("/","-",$this->input->post('to'));

$type = $this->input->post('type');

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',strtotime($from));

$this->db->where('booking_payment_date <=',strtotime($to));

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

$html = "

<h1><strong>". $this->data['app_settings'][0]->currency_sign.round($res[0]->booking_amount_paid,2)."</strong></h1>

";

$html .= "

<h5>From ".$this->input->post('from')." <br> to ".$this->input->post('to')."</h5>

";

echo $html;

}

function monthly_report($type = null){

$datearray = array();

$resultarray = array();

$year = date("Y");

for($m =1;$m < 13;$m++){

$datearray[strtotime($year."-".$m."-1")] = strtotime($year."-".$m."-31");

}

foreach($datearray as $start => $end){

$this->db->select_sum('booking_amount_paid');

if(!empty($type)){

$this->db->where('booking_type',$type);

}

$this->db->where('booking_payment_date >=',$start);

$this->db->where('booking_payment_date <=',$end);

$this->db->where('booking_status','paid');

$res = $this->db->get('pt_bookings')->result();

$resultarray[] = round($res[0]->booking_amount_paid,2);

}

return $resultarray;

}

}