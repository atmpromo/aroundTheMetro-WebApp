<?php
class Customers_model extends CI_Model {
	
	public $table_name = 'customers';
	
	    public function __construct()
    {
        $this->load->database();
    }

	public function loginUser($data) {
		
		$this->db->where("userid", $data['userid']);
		$query = $this->db->get("customers");
		$result = $query->result_array();
		if (count($result) ==1)
		{
			return $result[0];
		}
		else
		{
			$this->db->insert("customers", $data	);
			$data['undercoin'] = "0";
			return $data;
		}
	}
	function getUserData($userid) 
	{
		$this->db->select('*');
		$this->db->where('userid', $userid);
		$query = $this->db->get('customers');
		$res = $query->result_array();
		if(count($res) == 1)
		{
			return $res[0];
		} else {
			return "";
		}
	}
	
	function updateData($data) {
		$this->db->where('userid', $data['userid']);
		$this->db->update($this->table_name, $data);
	}
	
}
?>