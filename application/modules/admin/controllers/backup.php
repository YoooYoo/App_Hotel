<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Backup extends MX_Controller {
   private $data = array();
   public $role;
//private $userid = 1; //$this->session->userdata('userid');
   function __construct(){
      parent::__construct();
      modules::load('admin');
      $chkadmin = modules::run('admin/validadmin');
      if(!$chkadmin){
         redirect('admin');
      }
      $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
      $this->load->helper('directory');
      $this->load->helper('file');
      $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
      $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
      $this->role = $this->session->userdata('pt_role');
      $this->data['role'] = $this->role;
        
   }
   public function index()
   {

    $upload = $this->input->post('upload');
    if(!empty($upload)){
     $this->load->model('uploads_model');
     if(isset($_FILES['datasqlfile']) && !empty($_FILES['datasqlfile']['name'])){
       $result = $this->uploads_model->__uploadsql();

       if($result['done']){
          $this->session->set_flashdata('successmsg', $result['msg']);
       }else{
          $this->session->set_flashdata('errormsg', $result['msg']);
       }
    }else{
     $this->session->set_flashdata('errormsg', "Please Select file");

  }

  redirect('admin/backup');

}
$this->data['main_content'] = 'admin/backup/backup';
$this->data['page_title'] = 'Back Up';
$this->load->view('template',$this->data);
}
public function get_backup(){
   $this->load->dbutil();
   $prefs = array(
      'format'      => 'txt',
      'filename'    => 'my_db_backup.sql'
      );
   $backup =& $this->dbutil->backup($prefs);
   $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.sql';
   $save = 'backups/'.$db_name;
   $this->load->helper('file');
   write_file($save, $backup);
   $this->session->set_flashdata('flashmsgs', 'Backup Created Successfully');
}
function remove_backup(){
   $bkid = $this->input->post('bkid');
   unlink("backups/".$bkid);
   $this->session->set_flashdata('flashmsgs', 'Backup Deleted Successfully');
}
function restore_backup(){
   $sqlfile = $this->input->post('sqlfile');
   $sql=file_get_contents('backups/'.$sqlfile);
   foreach (explode(";\n", $sql) as $sql)
   {
      $sql = trim($sql);
      if($sql)
      {
         $this->db->query($sql);
      }
   }
   $this->session->set_flashdata('flashmsgs', 'Database Restored Successfully');
}
function download(){
   $file = $this->input->get('backup');
   $sql = file_get_contents('backups/'.$file);
   $this->load->helper('download');
   force_download($file, $sql);
}
function reset_database(){
   $code = $this->input->post('code');
   $tables = $this->db->list_tables();
   $notReset = array('pt_app_settings','pt_cms','pt_cms_content','pt_accounts','pt_menus','pt_menus_translation','pt_front_settings');
   $resetTables = array_diff($tables,$notReset);
   if($code == 11){
//print_r($resetTables);
      foreach($resetTables as $t){
         $this->db->truncate($t);

      }
      echo "1";
   }else{
      echo "1jhg";
   }
}
   function redirectBackup(){
      redirect('admin/backup','refresh');
   }

}