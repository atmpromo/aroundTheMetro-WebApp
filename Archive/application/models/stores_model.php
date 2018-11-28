<?php
class Stores_model extends CI_Model
{
    /**
     * Responsable for auto load the database
     * @return void
     */
    public $table_name = 'stores';
    public $selects = [
                        'id, name, type, mallid, metroid, aboutus, contact, facebook, link, featured, imagename, coverphoto_filename'
                      , 'id, name_fr, type_fr, mallid, metroid, aboutus_fr, contact, facebook, link, featured, imagename, coverphoto_filename'
                      , 'id, name_cn, type_cn, mallid, metroid, aboutus_cn, contact, facebook, link, featured, imagename, coverphoto_filename'
                      , 'id, name, name_fr, name_cn, type, type_fr, type_cn, mallid, metroid, aboutus, aboutus_fr, aboutus_cn, contact, facebook, link, featured, imagename, coverphoto_filename'
                      ];
    public $lang_f = ['name', 'type', 'aboutus'];

    public function __construct()
    {
        $this->load->database();
    }

    public function getStores($lang, $type=null, $mallid=null, $metroid=null, $limit = 0)
    {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);

        if ($limit > 0)
            $this->db->limit( $limit );
        
        if ($type != null) {
            if ($lang == 0) 
                $this->db->where('type', $type);
            else if ($lang == 1) 
                $this->db->where('type_fr', $type);
            else if ($lang == 2) 
                $this->db->where('type_cn', $type);
        }
        if ($mallid != null) $this->db->where('mallid', $mallid);
        if ($metroid != null) $this->db->where('metroid', $metroid);

        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();
        $stores = $query->result_array();

        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        if ($lang > 0) {
            for ($i=0; $i < count($stores); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $stores[$i][$this->lang_f[$j]] = $stores[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $stores;
    }

    public function getStoresByCategory($lang) {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);
        
        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();
        $stores = $query->result_array();

        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }

        $restaurants = array();
        $boutiques = array();
        $beautyhealths = array();
        $attractions = array();

        if ($lang > 0) {
            for ($i=0; $i < count($stores); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $stores[$i][$this->lang_f[$j]] = $stores[$i][$this->lang_f[$j].$suffix];
                }
            }
        }

        for($i=0; $i < count($stores); $i++) {
            if (strcasecmp($stores[$i]['type'], getTypenamefromType($lang, 'restaurants')) == 0) {
                array_push($restaurants, $i);
            } else if (strcasecmp($stores[$i]['type'], getTypenamefromType($lang, 'boutiques')) == 0) {
                array_push($boutiques, $i);
            } else if (strcasecmp($stores[$i]['type'], getTypenamefromType($lang, 'beautyhealths')) == 0) {
                array_push($beautyhealths, $i);
            } else if (strcasecmp($stores[$i]['type'], getTypenamefromType($lang, 'attractions')) == 0) {
                array_push($attractions, $i);
            }
        }

        $res = array();
        $res['stores'] = $stores;
        $res['restaurants'] = $restaurants;
        $res['boutiques'] = $boutiques;
        $res['beautyhealths'] = $beautyhealths;
        $res['attractions'] = $attractions;

        return $res;
    }

    public function getStorenamelist($lang)
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

        $stores = $query->result_array();
        
        $res = array();
        for ($i=0; $i<count($stores); $i++) {
            if ($lang == 0)
                $res[$i] = $stores[$i]['name'];
            else if ($lang == 1)
                $res[$i] = $stores[$i]['name_fr'];
            else if ($lang == 2)
                $res[$i] = $stores[$i]['name_cn'];
        }
        return $res;
    }

    public function getIdByname($lang, $name=null)
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

    public function getStoreById($lang, $id) {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);

            $this->db->where('id', $id);
            
            $this->db->group_by('id');
            $this->db->order_by('id', "Asc");

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0) {
                $store = $res[0];
                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $store[$this->lang_f[$j]] = $store[$this->lang_f[$j].$suffix];
                    }
                }
                return $store;
            }
            else
                return "";
        } else {
            return "";
        }
    }

    public function updateStore($lang, $data) {
        $olddata = $this->getStoreById(3, $data['id']);
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

    public function addStore($lang, $data) {
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
        $this->db->insert( $this->table_name, $data);
        return $this->db->insert_id();
    }

    public function deleteStore($lang, $id) {
        $this->db->select('imagename');
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        $res = $query->result_array();
        if (count($res) > 0) {
            $filename = $res[0]['imagename'];
        }
        else
            $filename = null;

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        return $filename;
    }
}
?>
