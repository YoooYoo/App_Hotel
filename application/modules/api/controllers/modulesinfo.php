<?php
header('Access-Control-Allow-Origin: *');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/api/libraries/REST_Controller.php';

class Modulesinfo extends REST_Controller {

		function __construct() {
// Construct our parent class
				parent :: __construct();
// Configure limits on our controller methods. Ensure
// you have created the 'limits' table and enabled 'limits'
// within application/config/rest.php
				$this->methods['list_get']['limit'] = 500; //500 requests per hour per user/key
				$this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
				$this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
               $this->load->library('ptmodules');
    }

		function list_get() {
				$list = $this->ptmodules->list_all_modules();
				if (!empty ($list)) {
						$this->response($list, 200); // 200 being the HTTP response code
				}
				else {
						$this->response(array('response' => array('error' => 'Modules could not be found')), 400);
				}
		}

}