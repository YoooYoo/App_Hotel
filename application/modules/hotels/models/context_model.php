<?php

class Context_model extends CI_Model
{
    public $langdef;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->langdef = DEFLANG;
    }

    function getContext()
    {
        $data = array();

        $this->db->select('pt_context.id, pt_context.name, pt_context.level');
        $this->db->where('pt_context.level !=', 1);
        $this->db->order_by('pt_context.order', 'desc');

        $query = $this->db->get('pt_context');

        $data['all'] = $query->result();

        $data['nums'] = $query->num_rows();

        return $data;
    }

}