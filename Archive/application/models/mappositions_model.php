<?php
class Mappositions_model extends CI_Model
{
    public $table_name = 'mappositions';
    public function __construct()
    {
        $this->load->database();
    }
    public function getMappositions()
    {
        $this->db->select("*");
        $this->db->from($this->table_name);

        $this->db->group_by('id');
        $this->db->order_by('id', "asc");
        
        $query = $this->db->get();

        $mappositions = $query->result_array();
        $ret = array();
        for ($i=0; $i < count($mappositions); $i++) {
            array_push($ret, $mappositions[$i]['mapposition']);
        }

        return $ret;
    }
}