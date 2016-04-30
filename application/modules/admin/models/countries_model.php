<?php

class Countries_model extends CI_Model {

		function __construct() {
// Call the Model constructor
				parent :: __construct();
		}

// Connect all countries, states, cities
		function get_all_combined() {
				$q = array();
				$this->db->select('pt_countries.iso2,pt_countries.short_name,pt_states.country_id,pt_states.state_id,pt_states.state_name,pt_cities.city_id,pt_cities.city_name,pt_cities.city_state');
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->join('pt_countries', 'pt_states.country_id = pt_countries.iso2');
				$this->db->order_by('pt_cities.city_id', 'desc');
				$q['all'] = $this->db->get('pt_cities');
				$q['nums'] = $q['all']->num_rows();
				return $q;
		}

// Get all combined limit
		function get_all_combined_limit($perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->select('pt_countries.iso2,pt_countries.short_name,pt_states.country_id,pt_states.state_id,pt_states.state_name,pt_cities.city_id,pt_cities.city_name,pt_cities.city_state');
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->join('pt_countries', 'pt_states.country_id = pt_countries.iso2');
				$this->db->order_by('city_id', 'desc');
				$q = $this->db->get('pt_cities', $perpage, $offset)->result();
				return $q;
		}

// search all combined
		function search_all_combined($term) {
				$q = array();
				$this->db->select('pt_countries.iso2,pt_countries.short_name,pt_states.country_id,pt_states.state_id,pt_states.state_name,pt_cities.city_id,pt_cities.city_name,pt_cities.city_state');
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->join('pt_countries', 'pt_states.country_id = pt_countries.iso2');
				$this->db->like('pt_cities.city_name', $term);
				$this->db->or_like('pt_states.state_name', $term);
				$this->db->or_like('pt_countries.short_name', $term);
				$this->db->order_by('city_id', 'desc');
				$q['all'] = $this->db->get('pt_cities');
				$q['nums'] = $q['all']->num_rows();
				return $q;
		}

// search all Combined limit
		function search_all_combined_limit($term, $perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->select('pt_countries.iso2,pt_countries.short_name,pt_states.country_id,pt_states.state_id,pt_states.state_name,pt_cities.city_id,pt_cities.city_name,pt_cities.city_state');
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->join('pt_countries', 'pt_states.country_id = pt_countries.iso2');
				$this->db->like('pt_cities.city_name', $term);
				$this->db->or_like('pt_states.state_name', $term);
				$this->db->or_like('pt_countries.short_name', $term);
				$this->db->order_by('city_id', 'desc');
				$q = $this->db->get('pt_cities', $perpage, $offset)->result();
				return $q;
		}

// Add combined
		function updatecombined() {
				$country = $this->input->post('c_country');
				$state = $this->input->post('c_state');
				$city = $this->input->post('c_city');
				$data = array('country_id' => $country);
				$this->db->where('state_id', $state);
				$this->db->update('pt_states', $data);
				$data2 = array('city_state' => $state);
				$this->db->where('city_id', $city);
				$this->db->update('pt_cities', $data2);
		}

// delete city country state combination
		function delete_combined($id) {
				$data = array('city_state' => 0);
				$this->db->where('city_id', $id);
				$this->db->update('pt_cities', $data);
		}

// Add Country
		function addcountry($filename = null) {
				$data = array('iso2' => $this->input->post('countrycode'), 'short_name' => $this->input->post('countryname'), 'country_status' => $this->input->post('countrystatus'), 'flag_img' => $filename);
				$this->db->insert('pt_countries', $data);
		}

// update Country
		function updatecountry($id, $filename = null) {
				$oldpic = $this->input->post('oldphoto');
				if ($filename != null) {
						$filename = $filename;
				}
				else {
						$filename = $oldpic;
				}
				$data = array('iso2' => $this->input->post('countrycode'), 'short_name' => $this->input->post('countryname'), 'country_status' => $this->input->post('countrystatus'), 'flag_img' => $filename);
				$this->db->where('country_id', $id);
				$this->db->update('pt_countries', $data);
		}

// Add State
		function addstate() {
				$data = array('state_name' => $this->input->post('statename'), 'state_status' => $this->input->post('statestatus'),);
				$this->db->insert('pt_states', $data);
		}

// Update State
		function updatestate() {
				$data = array('state_name' => $this->input->post('statename'), 'state_status' => $this->input->post('statestatus'),);
				$this->db->where('state_id', $this->input->post('up_stateid'));
				$this->db->update('pt_states', $data);
		}

// Add City
		function addcity() {
				$data = array('city_name' => $this->input->post('cityname'), 'city_status' => $this->input->post('citystatus'),);
				$this->db->insert('pt_cities', $data);
		}

// Update city
		function updatecity() {
				$data = array('city_name' => $this->input->post('cityname'), 'city_status' => $this->input->post('citystatus'),);
				$this->db->where('city_id', $this->input->post('up_cityid'));
				$this->db->update('pt_cities', $data);
		}

// Get all countries
		function get_all_countries() {
				$this->db->where('country_status', '1');
				$this->db->order_by('short_name', 'asc');
				$q = $this->db->get('pt_countries')->result();
				return $q;
		}

// Get all countries count
		function get_all_countries_count() {
				$q = array();
				$q['all'] = $this->db->get('pt_countries');
				$q['nums'] = $q['all']->num_rows();
				return $q;
		}

// Get all countries limit
		function get_all_countries_limit($perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->order_by('short_name', 'asc');
				$q = $this->db->get('pt_countries', $perpage, $offset)->result();
				return $q;
		}

// search all cities
		function search_all_countries($term) {
				$q = array();
				$this->db->like('iso2', $term);
				$this->db->or_like('short_name', $term);
				$q['all'] = $this->db->get('pt_countries');
				$q['nums'] = $q['all']->num_rows();
				return $q;
		}

// search all countries limit
		function search_all_countries_limit($term, $perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->like('iso2', $term);
				$this->db->or_like('short_name', $term);
				$this->db->order_by('short_name', 'asc');
				$q = $this->db->get('pt_countries', $perpage, $offset)->result();
				return $q;
		}

// Get all Sates
		function get_all_states() {
				$q = array();
				$this->db->order_by('state_id', 'desc');
				$q['all'] = $this->db->get('pt_states');
				$q['nums'] = $q['all']->num_rows();
				return $q;
		}

// Get all Sates limit
		function get_all_states_limit($perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->order_by('state_id', 'desc');
				$q = $this->db->get('pt_states', $perpage, $offset)->result();
				return $q;
		}

// search all Sates
		function search_all_states($term) {
				$q = array();
				$this->db->like('state_id', $term);
				$this->db->or_like('state_name', $term);
				$this->db->order_by('state_id', 'desc');
				$q['all'] = $this->db->get('pt_states');
				$q['nums'] = $q['all']->num_rows();
				return $q;
		}

// search all Sates limit
		function search_all_states_limit($term, $perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->like('state_id', $term);
				$this->db->or_like('state_name', $term);
				$this->db->order_by('state_id', 'desc');
				$q = $this->db->get('pt_states', $perpage, $offset)->result();
				return $q;
		}

// Get all Cities
		function get_all_cities() {
				$q = array();
				$this->db->order_by('city_id', 'desc');
				$query = $this->db->get('pt_cities');
				$q['all'] = $query->result();
				$q['nums'] = $query->num_rows();
				return $q;
		}

// Get all Cities limit
		function get_all_cities_limit($perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->order_by('city_id', 'desc');
				$q = $this->db->get('pt_cities', $perpage, $offset)->result();
				return $q;
		}

// search all cities
		function search_all_cities($term) {
				$q = array();
				$this->db->like('city_id', $term);
				$this->db->or_like('city_name', $term);
				$this->db->order_by('city_id', 'desc');
				$q['all'] = $this->db->get('pt_cities');
				$q['nums'] = $q['all']->num_rows();
				return $q;
		}

// search all Cities limit
		function search_all_cities_limit($term, $perpage = null, $offset = null, $orderby = null) {
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->like('city_id', $term);
				$this->db->or_like('city_name', $term);
				$this->db->order_by('city_id', 'desc');
				$q = $this->db->get('pt_cities', $perpage, $offset)->result();
				return $q;
		}

// Get states of the country
		function get_country_state($countryid) {
				$this->db->where('country_id', $countryid);
				$q = $this->db->get('pt_states')->result();
				return $q;
		}

// Get Cities of the state
		function get_state_city($stateid) {
				$this->db->where('city_state', $stateid);
				$q = $this->db->get('pt_cities')->result();
				return $q;
		}

		function get_user_country($id) {
				$this->db->select('pt_accounts.ai_city,pt_countries.*,pt_states.*,pt_cities.*');
				$this->db->where('pt_accounts.accounts_id', $id);
				$this->db->join('pt_cities', 'pt_accounts.ai_city = pt_cities.city_id');
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->join('pt_countries', 'pt_states.country_id = pt_countries.iso2');
				$q = $this->db->get('pt_accounts')->result();
				return $q;
		}

// delete country
		function delete_country($id) {
				$this->db->where('iso2', $id);
				$this->db->delete('pt_countries');
				$this->db->select('state_id');
				$this->db->where('country_id', $id);
				$state = $this->db->get('pt_states')->result();
				$this->db->where('city_state', $state[0]->state_id);
				$this->db->delete('pt_cities');
				$this->db->where('country_id', $id);
				$this->db->delete('pt_states');
		}

// Disable country
		function disable_country($id) {
				$data = array('country_status' => 0);
				$this->db->where('iso2', $id);
				$this->db->update('pt_countries', $data);
				$data2 = array('state_status' => 0);
				$this->db->where('country_id', $id);
				$this->db->update('pt_states', $data2);
				$this->db->where('country_id', $id);
				$res = $this->db->get('pt_states')->result();
				foreach ($res as $r) {
						$data3 = array('city_status' => 0);
						$this->db->where('city_state', $r->state_id);
						$this->db->update('pt_cities', $data3);
				}
		}

// Enable country
		function enable_country($id) {
				$data = array('country_status' => 1);
				$this->db->where('iso2', $id);
				$this->db->update('pt_countries', $data);
				$data2 = array('state_status' => 1);
				$this->db->where('country_id', $id);
				$this->db->update('pt_states', $data2);
				$this->db->where('country_id', $id);
				$res = $this->db->get('pt_states')->result();
				foreach ($res as $r) {
						$data3 = array('city_status' => 1);
						$this->db->where('city_state', $r->state_id);
						$this->db->update('pt_cities', $data3);
				}
		}

// Disable State
		function disable_state($id) {
				$data = array('state_status' => 0);
				$this->db->where('state_id', $id);
				$this->db->update('pt_states', $data);
				$data2 = array('city_status' => 0);
				$this->db->where('city_state', $id);
				$this->db->update('pt_cities', $data2);
		}

// Enable State
		function enable_state($id) {
				$data = array('state_status' => 1);
				$this->db->where('state_id', $id);
				$this->db->update('pt_states', $data);
				$data2 = array('city_status' => 1);
				$this->db->where('city_state', $id);
				$this->db->update('pt_cities', $data2);
		}

// delete State
		function delete_state($id) {
				$this->db->where('city_state', $id);
				$this->db->delete('pt_cities');
				$this->db->where('state_id', $id);
				$this->db->delete('pt_states');
		}

// delete City
		function delete_city($id) {
				$this->db->where('city_id', $id);
				$this->db->delete('pt_cities');
		}

// Disable State
		function disable_city($id) {
				$data = array('city_status' => 0);
				$this->db->where('city_id', $id);
				$this->db->update('pt_cities', $data);
		}

// Enable City
		function enable_city($id) {
				$data = array('city_status' => 1);
				$this->db->where('city_id', $id);
				$this->db->update('pt_cities', $data);
		}

// returns the state and country of the given city
		function get_city_data($id) {
				$this->db->where('city_id', $id);
				$state = $this->db->get('pt_cities')->result();
				$data['state'] = $state[0]->city_state;
				$this->db->where('state_id', $state[0]->city_state);
				$country = $this->db->get('pt_states')->result();
				$data['country'] = $country[0]->country_id;
				return $data;
		}

// returns the names of country, state and city of given city
		function get_city_name($id) {
				$this->db->select('pt_countries.*,pt_states.*,pt_cities.*');
				$this->db->where('pt_cities.city_id', $id);
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->join('pt_countries', 'pt_states.country_id = pt_countries.iso2');
				$q = $this->db->get('pt_cities')->result();
				return $q;
		}

// get cities of a country
		function get_cities_by_country($id) {
				$this->db->select('pt_cities.*,pt_states.*,pt_countries.*');
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->join('pt_countries', 'pt_states.country_id = pt_countries.iso2');
				$this->db->where('pt_countries.iso2', $id);
				return $this->db->get('pt_cities')->result();
		}

// get cities of a state
		function get_cities_by_state($id) {
				$this->db->select('pt_cities.*,pt_states.*');
				$this->db->join('pt_states', 'pt_cities.city_state = pt_states.state_id');
				$this->db->where('pt_states.state_id', $id);
				return $this->db->get('pt_cities')->result();
		}

		function city_name($id) {
				$this->db->select('city_name');
				$this->db->where('city_id', $id);
				$q = $this->db->get('pt_cities')->result();
				if (!empty ($q)) {
						return $q[0]->city_name;
				}
				else {
						return "";
				}
		}

        // Get all countries
		function Api_all_countries() {
				$this->db->select('short_name as name,iso2 as code');
				$this->db->where('country_status', '1');
				$this->db->order_by('short_name', 'asc');
				$q = $this->db->get('pt_countries')->result();
				return $q;
		}

}