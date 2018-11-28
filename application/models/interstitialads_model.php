<?php
class InterstitialAds_Model extends CI_Model
{
    public $table_name = 'interstitialads';
    public $selects = [
                        'id, screenname, value'
                      , 'id, screenname, value'
                      , 'id, screenname, value'
                      , 'id, screenname, value'
                      ];
    public $lang_f = [];
    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct()
    {
        $this->load->database();
    }
    
    public function getInterstitialAds($lang)
    {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);

        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();

        $events = $query->result_array();
        return $events;
    }
    public function updateInterstitialAds($lang, $data) {
		$this->db->where('id', $data['id']);
    	$this->db->update($this->table_name, $data);
    }
    public function addInterstitialAds($lang, $data) {
    	return $this->db->insert( $this->table_name, $data );
    }
    public function deleteInterstitialAds($lang, $id) {
    	$this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }
}
?>