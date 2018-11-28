<?php
class Country_model extends CI_Model {
	
	public $table_name = 'Country_list';
    public $selects = 'id, full_name, short_name, shortcut';
	
	    public function __construct()
    {
        $this->load->database();
    }

	public function getcountry() {
		
		$this->db->select($this->selects);
		$this->db->from($this->table_name);
		
		$query = $this->db->get();
		
		$contries = $query->result_array();
		
		return $contries;
		
	}
}
?>