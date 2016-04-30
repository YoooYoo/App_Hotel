<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews extends MX_Controller {
private $data = array();
public $role;
function __construct(){
modules::load('admin');
$chkadmin = modules::run('admin/validadmin');
if(!$chkadmin){
redirect('admin');
}
$chk = modules::run('home/is_module_enabled','reviews');
if(!$chk){
redirect('admin');
}
$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
$this->role = $this->session->userdata('pt_role');
$this->data['role'] = $this->role;

if(!pt_permissions('reviews',$this->data['userloggedin'])){
redirect('admin');
}
$this->load->model('reviews_model');
$this->data['modModel'] = $this->modules_model;
}
function index(){

        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('pt_reviews');
        $xcrud->where('review_module','hotels');
        $xcrud->join('review_itemid','pt_hotels','hotel_id');
        $xcrud->order_by('pt_reviews.review_id','desc');
        $xcrud->columns('review_name,review_email,pt_hotels.hotel_title,review_date,review_overall,review_status');
        $xcrud->label('review_name','Name')->label('review_email','Email')->label('pt_hotels.hotel_title','Hotel')->label('review_date','Date')->label('review_overall','Overall')->label('review_status','Status')->label('review_comment','Comments');
        $xcrud->fields('review_name,review_email,review_comment,review_status', false, 'Traveller');
        $xcrud->fields('review_clean,review_comfort,review_location,review_facilities,review_staff,review_overall', false, 'Overall');
        $xcrud->set_attr('review_overall',array('id'=>'overall'));
        $xcrud->set_attr('review_clean',array('onchange' =>'getReviewScore(this.value)'));
        $xcrud->set_attr('review_comfort',array('onchange' =>'getReviewScore(this.value)'));
        $xcrud->set_attr('review_location',array('onchange' =>'getReviewScore(this.value)'));
        $xcrud->set_attr('review_facilities',array('onchange' =>'getReviewScore(this.value)'));
        $xcrud->set_attr('review_staff',array('onchange' =>'getReviewScore(this.value)'));
        $xcrud->readonly('review_overall');

        $xcrud->column_callback('review_date', 'fmtDate');
        $xcrud->unset_add();
        $xcrud->unset_view();
        $xcrud->unset_remove();
        $delurl = base_url().'admin/ajaxcalls/delReview';
        $xcrud->button("javascript: delfunc('{review_id}','$delurl')",'DELETE','fa fa-times', 'btn-danger',array('target'=>'_self'));
                
        $this->data['content'] = $xcrud->render();
        $this->data['page_title'] = 'Reviews Management';
        $this->data['main_content'] = 'temp_view';
        $this->data['header_title'] = 'Reviews Management';
        $this->load->view('template', $this->data);

}

}