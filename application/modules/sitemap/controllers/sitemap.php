<?php if ( ! defined('BASEPATH')) {
   exit( 'No direct script access allowed' );
}

class Sitemap extends MX_Controller
{

   private $data = [ ];


   function __construct()
   {


   }


   public function index()
   {
      $this->data['cms']    = $this->__cms();
      $this->data['hotels'] = $this->__hotels();
      $this->data['tours']  = $this->__tours();
      $this->data['cars']   = $this->__cars();

      $this->load->view('sitemap', $this->data);

   }


   function __cms()
   {
      $this->db->select('page_slug');
      $this->db->where('page_status', 'Yes');
      $result = $this->db->get('pt_cms');

      return $result->result();


   }


   function __hotels()
   {
      $this->db->select('hotel_slug,hotel_meta_desc');
      $this->db->where('hotel_status', 'Yes');
      $result = $this->db->get('pt_hotels');

      return $result->result();


   }


   function __cars()
   {

      $this->db->select('car_slug,car_meta_desc');
      $this->db->where('car_status', '1');
      $result = $this->db->get('pt_cars');

      return $result->result();


   }


   function __tours()
   {

      $this->db->select('tour_slug,tour_meta_desc');
      $this->db->where('tour_status', '1');
      $result = $this->db->get('pt_tours');

      return $result->result();


   }

}
