<?php
class City_model extends CI_Model {
	
	public $table_name = 'City_list';
    public $selects = 'id, full_name, name_data, country , active';
	
	    public function __construct()
    {
        $this->load->database();
    }

	public function getcities() {
		
		$this->db->select($this->selects);
		$this->db->from($this->table_name);
		
		$query = $this->db->get();
		
		$cities = $query->result_array();
		
		return $cities;
		
	}
	
	public function getcitiesbycontry($country) {
		
		$this->db->select($this->selects);
		$this->db->from($this->table_name);
		
		$this->db->where('country', $country);
		
		$query = $this->db->get();
		
		$cities = $query->result_array();
		
		
		return $cities;
			
	}
}
?>