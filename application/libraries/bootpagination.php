<?php

class Bootpagination {
/**
* Protected variables
*/
		protected $CI;

		function __construct() {
//get the CI instance
				$this->CI = & get_instance();
				$this->CI->load->library('pagination');
		}

		function dopagination($info) {

                $base = $info['base'];
                $totalrows = $info['totalrows'];
                $perpage = $info['perpage'];
				$config['base_url'] = site_url($base);
				if (count($_GET) > 0)
						$config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
				$config['total_rows'] = $totalrows;
				$config['per_page'] = $perpage;
				$config['num_links'] = 20;
				$config['use_page_numbers'] = TRUE;
				$config['full_tag_open'] = '<ul class="pagination right paddingbtm20">'; // I added class name 'page_test' to used later for jQuery
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = '&raquo'; // &raquo; &laquo; First
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_link'] = '&laquo;';

				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';

				$config['next_link'] = '&raquo;';


				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';

				$config['prev_link'] = '&laquo;';

				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				$config['cur_tag_open'] = '<li class="active"><a href="">';
				$config['cur_tag_close'] = '</a></li>';


				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';

				$this->CI->pagination->initialize($config);
				$html = $this->CI->pagination->create_links();
				return $html;
		}

		function dopagination2($base, $totalrows, $perpage) {
				$config['base_url'] = site_url($base);
				if (count($_GET) > 0)
						$config['suffix'] = '?' . http_build_query($_GET, '', "&");
				$config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
				$config['total_rows'] = $totalrows;
				$config['per_page'] = $perpage;
				$config['num_links'] = 20;
				$config['use_page_numbers'] = TRUE;
//  $config['full_tag_open'] = '<ul class="pagination pull-right">'; // I added class name 'page_test' to used later for jQuery
				$config['full_tag_open'] = '<div class="pager">'; // I added class name 'page_test' to used later for jQuery
				$config['full_tag_close'] = '</div>';
				$config['first_link'] = ''; // &raquo; &laquo; First
//  $config['first_tag_open'] = '<li class="prev page">';
				$config['first_tag_open'] = '<span>';
				$config['first_tag_close'] = '</span>';
//&laquo; Last &raquo
				$config['last_link'] = '&laquo;';
//  $config['last_tag_open'] = '<li class="next page">';
				$config['last_tag_open'] = '<span>';
				$config['last_tag_close'] = '</span>';
//$config['next_link'] = 'Next &rarr;';
				$config['next_link'] = '&gt;';
//  $config['next_tag_open'] = '<li class="next page">';
				$config['next_tag_open'] = '<span>';
				$config['next_tag_close'] = '</span>';
// $config['prev_link'] = '&larr; Previous';
				$config['prev_link'] = '&lt;';
// $config['prev_tag_open'] = '<li class="prev page">';
				$config['prev_tag_open'] = '<span>';
				$config['prev_tag_close'] = '</span>';
				$config['cur_tag_open'] = '<span class="current">';
				$config['cur_tag_close'] = '</span>';
//$config['num_tag_open'] = '<li class="page">';
				$config['num_tag_open'] = '<span>';
				$config['num_tag_close'] = '</span>';
				$this->CI->pagination->initialize($config);
				$html = $this->CI->pagination->create_links();
				return $html;
		}

}