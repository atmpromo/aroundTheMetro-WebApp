<?php
class Metros_model extends CI_Model
{
    /**
     * Responsable for auto load the database
     * @return void
     */
    // public $table_name = 'Metro_list';
    public $selects = [
                        'id, metro_name_en, metro_ID '//, ;coverphoto_filename'
                      , 'id, metro_name_fr,metro_ID '//, coverphoto_filename'
                      , 'id, metro_name_en,metro_name_fr, metro_ID'//, coverphoto_filename'
                      ];
    public $lang_f = ['metro_name'];
    public function __construct()
    {
        $this->load->database();
    }

    public function getMetros($lang=0, $country, $city ) {
		
		$table_name = "_".$country."_".$city."_metro";
		
        $this->db->select($this->selects[$lang]);
        $this->db->from($table_name);
		        
        // $this->db->order_by('id', "Asc");

        $query = $this->db->get();

        $metros = $query->result_array();

        $suffix = "_en";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        for ($i=0; $i < count($metros); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $metros[$i][$this->lang_f[$j]] = $metros[$i][$this->lang_f[$j].$suffix];
                }
            }
        return $metros;
    }

    public function getMetronamelist($lang=0)
    {
		
        if ($lang == 0)
            $this->db->select('name_en');
        else if ($lang == 1)
            $this->db->select('name_fr');
        else if ($lang == 2)
            $this->db->select('name_cn');
        
        $this->db->from($this->table_name);

        $this->db->group_by('key');
        $this->db->order_by('key', "asc");
        
        $query = $this->db->get();

        $metros = $query->result_array();
        
        $res = array();
        for ($i=0; $i<count($metros); $i++) {
            if ($lang == 0)
                $res[$i] = $metros[$i]['name_en'];
            else if ($lang == 1)
                $res[$i] = $metros[$i]['name_fr'];
            else if ($lang == 2)
                $res[$i] = $metros[$i]['name_cn'];
        }
        return $res;
    }

    public function getMetroById($lang=0,$country, $city, $id) {
		
		$table_name = "_".$country."_".$city."_metro";

        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($table_name);

            $this->db->where('metro_ID', $id);
            

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0){
                $metro = $res[0];

                $suffix = "_en";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $metro[$this->lang_f[$j]] = $metro[$this->lang_f[$j].$suffix];
                    }
                return $metro;
            }
            else
                return "";
        } else {
            return "";
        }
    }
    
    public function getIdByname($lang=0, $name=null)
    {
        if ($name == null)
            return -1;
        $this->db->select('key');
        $this->db->from($this->table_name);
        if ($lang == 0)
            $this->db->where('name_en', $name);
        else if ($lang == 1)
            $this->db->where('name_fr', $name);
        else if ($lang == 2)
            $this->db->where('name_cn', $name);

        $query = $this->db->get();
        $stores = $query->result_array();
        if (count($stores) == 0)
            return -1;
        return $stores[0]['id'];
    }

    public function updateMetro($lang=0, $data) {
        $olddata = $this->getMetroById(3, $data['id']);
        if ($lang == 0) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_fr"] = $olddata[$this->lang_f[$j]."_fr"];
                $data[$this->lang_f[$j]."_cn"] = $olddata[$this->lang_f[$j]."_cn"];
            }
        } else if ($lang == 1) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_fr"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]] = $olddata[$this->lang_f[$j]];                
                $data[$this->lang_f[$j]."_cn"] = $olddata[$this->lang_f[$j]."_cn"];
            }
        } else if ($lang == 2) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_cn"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]] = $olddata[$this->lang_f[$j]];
                $data[$this->lang_f[$j]."_fr"] = $olddata[$this->lang_f[$j]."_fr"];
            }
        }

        $this->db->where('id', $data['id']);
        $this->db->update($this->table_name, $data);
    }

    public function addMetro($lang=0, $data) {
        if ($lang == 0) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_fr"] = "";
                $data[$this->lang_f[$j]."_cn"] = "";
            }
        } else if ($lang == 1) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]] = "";
                $data[$this->lang_f[$j]."_fr"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]."_cn"] = "";
            }
        } else if ($lang == 2) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]] = "";
                $data[$this->lang_f[$j]."_fr"] = "";
                $data[$this->lang_f[$j]."_cn"] = $data[$this->lang_f[$j]];
            }
        }
        return $this->db->insert( $this->table_name, $data );
    }

    public function deleteMetro($lang=0, $id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }
}
?>