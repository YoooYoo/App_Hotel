<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Extras extends MX_Controller {
		private $data = array();
		public  $role;
		private $langdef;

		function __construct() {
				modules::load('admin');
				$this->load->model('admin/extras_model');
				$this->data['adminsegment'] = "admin";
	        	$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
	        	$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
   				$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
   				$this->role = $this->session->userdata('pt_role');
				$this->data['role'] = $this->role;
    
   	 			$this->data['modModel'] = $this->modules_model;
		}

		function listings($module,$items = null){
		  if(!empty($items)){
              $this->data['itemslist'] = $items;
		  }

		        $this->data['languages'] = pt_get_languages();

                $updateextra = $this->input->post('updateextra');
                $updateassign = $this->input->post('updateassign');
				$id = $this->input->post('extrasid');

				if (!empty ($updateextra)) {

                    $this->extras_model->update_translation($this->input->post('translated'),$id);
				}

                if (!empty ($updateassign)) {
                    $this->extras_model->update_extras($id);
				}

                $this->load->helper('xcrud');
				$xcrud = xcrud_get_instance();
				$xcrud->table('pt_extras');
				$xcrud->where('extras_module',$module);
				$xcrud->column_class('extras_image', 'zoom_img');
				$xcrud->order_by('pt_extras.extras_id', 'desc');
				$xcrud->columns('extras_image,extras_title,extras_status,extras_basic_price,extras_for,extras_module');
				$xcrud->search_columns('extras_title,extras_status,extras_basic_price');
				$xcrud->fields('extras_image,extras_title,extras_status,extras_basic_price');
				$xcrud->label('extras_image', 'Thumb')->label('extras_title', 'Name')->label('extras_added_on', 'Date')->label('extras_status', 'Status')->label('extras_basic_price', 'Price')->label('extras_desc', 'Description')->label('extras_module','Translate')->label('extras_for','Assign');
				$xcrud->change_type('extras_image', 'image', false, array('width' => 200, 'path' => '../../'.PT_EXTRAS_IMAGES_UPLOAD, 'thumbs' => array(array('crop' => true, 'marker' => ''))));
				$xcrud->column_callback('extras_module','translateExtras');
				$xcrud->column_callback('extras_for','assignExtras');
				$this->data['content'] = $xcrud->render();
				$this->data['extras'] = $this->extras_model->get_all_extras();
				$this->data['page_title'] = 'Extras Management';
				$this->data['main_content'] = 'extras_view';
				$this->data['header_title'] = 'Extras Management';
				$this->load->view('template', $this->data);
        }

		function translate($id, $lang = null) {
		  	$this->data['languages'] = pt_get_languages();
				if (empty ($lang)) {
						$lang = $this->langdef;
				}
				else {
						$lang = $lang;
				}
				$this->data['lang'] = $lang;
				$this->data['suppid'] = $id;
				$add = $this->input->post('add');
				$update = $this->input->post('update');
				if (!empty ($add)) {
						$language = $this->input->post('langname');
						$this->extras_model->add_translation($id, $lang);
						redirect("admin/extras/translate/" . $id);
				}
				if (!empty ($update)) {
						$this->extras_model->update_translation($id, $lang);
						redirect("admin/extras/translate/" . $id . "/" . $lang);
				}
				if ($lang == $this->langdef) {
						$suppdata = $this->extras_model->extras_short_data($id);
						$this->data['suppdata'] = $suppdata;
						$this->data['transdesc'] = $suppdata[0]->extras_desc;
						$this->data['transtitle'] = $suppdata[0]->extras_title;
				}
				else {
						$suppdata = $this->extras_model->extras_translated_data($lang, $id);
						$this->data['suppdata'] = $suppdata;
						$this->data['transid'] = $suppdata[0]->trans_id;
						$this->data['transdesc'] = $suppdata[0]->trans_desc;
						$this->data['transtitle'] = $suppdata[0]->trans_title;
				}
				$this->data['language_list'] = pt_get_languages();
				$this->data['main_content'] = 'modules/extras/translate';
				$this->data['page_title'] = 'Translate Supplement';
				$this->load->view('admin/template', $this->data);
		}

}