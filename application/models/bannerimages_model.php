<?php
class Bannerimages_Model extends CI_Model
{
    /**
     * Responsable for auto load the database
     * @return void
     */
    public $table_name = 'bannerimages';
    public $selects = [
                        'id, title, link, imagename, Country , City'
                      , 'id, title_fr, link, imagename,Country , City'
                      , 'id, title_cn, link, imagename,Country , City'
                      , 'id, title, title_fr, title_cn, link, imagename,Country , City'
                      ];
    public $lang_f = ['title'];
    public function __construct()
    {
        $this->load->database();
    }

    public function getBannerImages($lang , $country , $city) {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);
        $this->db->where('Country' , $country);
		$this->db->where('City' , $city);
        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();

        $bannerimages = $query->result_array();
        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        if ($lang > 0) {
            for ($i=0; $i < count($bannerimages); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $bannerimages[$i][$this->lang_f[$j]] = $bannerimages[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $bannerimages;
    }
}
?>