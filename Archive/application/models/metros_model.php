<?php
class Metros_model extends CI_Model
{
    /**
     * Responsable for auto load the database
     * @return void
     */
    public $table_name = 'metros';
    public $selects = [
                        'id, name'
                      , 'id, name_fr'
                      , 'id, name_cn'
                      , 'id, name, name_fr, name_cn'
                      ];
    public $lang_f = ['name'];
    public function __construct()
    {
        $this->load->database();
    }

    public function getMetros($lang=0) {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);
        
        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();

        $metros = $query->result_array();

        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        if ($lang > 0) {
            for ($i=0; $i < count($metros); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $metros[$i][$this->lang_f[$j]] = $metros[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $metros;
    }

    public function getMetronamelist($lang=0)
    {
        if ($lang == 0)
            $this->db->select('name');
        else if ($lang == 1)
            $this->db->select('name_fr');
        else if ($lang == 2)
            $this->db->select('name_cn');
        
        $this->db->from($this->table_name);

        $this->db->group_by('id');
        $this->db->order_by('id', "asc");
        
        $query = $this->db->get();

        $metros = $query->result_array();
        
        $res = array();
        for ($i=0; $i<count($metros); $i++) {
            if ($lang == 0)
                $res[$i] = $metros[$i]['name'];
            else if ($lang == 1)
                $res[$i] = $metros[$i]['name_fr'];
            else if ($lang == 2)
                $res[$i] = $metros[$i]['name_cn'];
        }
        return $res;
    }

    public function getMetroById($lang=0, $id) {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);

            $this->db->where('id', $id);
            
            $this->db->group_by('id');
            $this->db->order_by('id', "Asc");

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0){
                $metro = $res[0];

                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $metro[$this->lang_f[$j]] = $metro[$this->lang_f[$j].$suffix];
                    }
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
        $this->db->select('id');
        $this->db->from($this->table_name);
        if ($lang == 0)
            $this->db->where('name', $name);
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