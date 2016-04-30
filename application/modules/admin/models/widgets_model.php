<?php
class Widgets_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_widget_content($id){
    $this->db->where('widget_id',$id);
    $this->db->where('widget_status',1);
    $content = $this->db->get('pt_widgets')->result();
    if(!empty($content)){

    return $content[0]->widget_content;

    }else{

      return '';
    }

    }


 }