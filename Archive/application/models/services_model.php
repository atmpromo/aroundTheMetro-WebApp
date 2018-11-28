<?php
class Services_model extends CI_Model
{
    public $table_name = 'services';
    public $selects = [
                        'id, name, type, contact, link'
                      , 'id, name_fr, type_fr, contact, link'
                      , 'id, name_cn, type_cn, contact, link'
                      , 'id, name, name_fr, name_cn, type, type_fr, type_cn, contact, link'
                      ];
    public $lang_f = ['name', 'type'];

    public function __construct()
    {
        $this->load->database();
    }
    
    public function getServices($lang, $type=null)
    {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);

        if($type) {
            if ($lang == 0) 
                $this->db->where('type', $type);
            else if ($lang == 1) 
                $this->db->where('type_fr', $type);
            else if ($lang == 2) 
                $this->db->where('type_cn', $type);
        }

        $this->db->group_by('id');
        $this->db->order_by('id', "asc");

        $query = $this->db->get();
        $services = $query->result_array();

        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        if ($lang > 0) {
            for ($i=0; $i < count($services); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $services[$i][$this->lang_f[$j]] = $services[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $services;
    }

    public function getServiceById($lang, $id) {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);

            $this->db->where('id', $id);
            
            $this->db->group_by('id');
            $this->db->order_by('id', "Asc");

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0) {
                $service = $res[0];

                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $service[$this->lang_f[$j]] = $service[$this->lang_f[$j].$suffix];
                    }
                }
                return $service;
            }
            else
                return "";
        } else {
            return "";
        }
    }
    public function updateService($lang, $data) {
        $olddata = $this->getServiceById(3, $data['id']);
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

    public function addService($lang, $data) {
        if ($lang == 0) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                if (strcasecmp($this->lang_f[$j], 'type') != 0 ) {
                    $data[$this->lang_f[$j]."_fr"] = "";
                    $data[$this->lang_f[$j]."_cn"] = "";
                }
            }
        } else if ($lang == 1) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                if (strcasecmp($this->lang_f[$j], 'type') != 0 ) {
                    $data[$this->lang_f[$j]."_fr"] = $data[$this->lang_f[$j]];
                    $data[$this->lang_f[$j]] = "";                
                    $data[$this->lang_f[$j]."_cn"] = "";
                }
            }
        } else if ($lang == 2) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                if (strcasecmp($this->lang_f[$j], 'type') != 0 ) {
                    $data[$this->lang_f[$j]."_cn"] = $data[$this->lang_f[$j]];
                    $data[$this->lang_f[$j]] = "";
                    $data[$this->lang_f[$j]."_fr"] = "";
                }
            }
        }
        return $this->db->insert( $this->table_name, $data );
    }

    public function deleteService($lang, $id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }
}
?>