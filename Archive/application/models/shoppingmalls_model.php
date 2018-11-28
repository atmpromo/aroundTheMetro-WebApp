<?php
class Shoppingmalls_model extends CI_Model
{
    public $table_name = 'shoppingmalls';
    public $selects = [
                        'id, name, logophoto_filename, coverphoto_filename, info, workinghours, contact, aboutus, link, mapposition, latitude, longitude'
                      , 'id, name_fr, logophoto_filename, coverphoto_filename, info_fr, workinghours_fr, contact, aboutus_fr, link, mapposition, latitude, longitude'
                      , 'id, name_cn, logophoto_filename, coverphoto_filename, info_cn, workinghours_cn, contact, aboutus_cn, link, mapposition, latitude, longitude'
                      , 'id, name, name_fr, name_cn, logophoto_filename, coverphoto_filename, info, info_fr, info_cn, workinghours, workinghours_fr, workinghours_cn, contact, aboutus, aboutus_fr, aboutus_cn, link, mapposition, latitude, longitude'
                      ];
    public $lang_f = ['name', 'info', 'workinghours', 'aboutus'];

    public function __construct()
    {
        $this->load->database();
    }
    public function getShoppingmalls($lang)
    {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);

        $this->db->group_by('id');
        $this->db->order_by('id', "asc");
        
        $query = $this->db->get();

        $malls = $query->result_array();
        
        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        if ($lang > 0) {
            for ($i=0; $i < count($malls); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $malls[$i][$this->lang_f[$j]] = $malls[$i][$this->lang_f[$j].$suffix];
                }
            }
        }

        return $malls;
    }

    public function getMallnamelist($lang)
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

        $malls = $query->result_array();
        
        $res = array();
        for ($i=0; $i<count($malls); $i++) {
            if ($lang == 0)
                $res[$i] = $malls[$i]['name'];
            else if ($lang == 1)
                $res[$i] = $malls[$i]['name_fr'];
            else if ($lang == 2)
                $res[$i] = $malls[$i]['name_cn'];
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
        $malls = $query->result_array();
        if (count($malls) == 0)
            return -1;
        return $malls[0]['id'];
    }

    /**
     * Get Shopping Mall with Id
     * @param int $id
     */
    public function getShoppingmallById($lang, $id) 
    {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);
            $this->db->where('id', $id);

            $query = $this->db->get();
            $res = $query->result_array();
            if ( count($res) > 0 ) {
                $shoppingmall = $res[0];
                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $shoppingmall[$this->lang_f[$j]] = $shoppingmall[$this->lang_f[$j].$suffix];
                    }
                }
                return $shoppingmall;
            }
            else 
                return "";
        } else {
            return "";
        }
    }

    public function updateShoppingmall($lang, $data) {
        $olddata = $this->getShoppingmallById(3, $data['id']);
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

    public function addShoppingmall($lang, $data) {
        if ($lang == 0) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_fr"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]."_cn"] = $data[$this->lang_f[$j]];
            }
        } else if ($lang == 1) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_fr"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]."_cn"] = $data[$this->lang_f[$j]];
            }
        } else if ($lang == 2) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_cn"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]."_fr"] = $data[$this->lang_f[$j]];
            }
        }
        return $this->db->insert( $this->table_name, $data );
    }

    public function deleteShoppingmall($lang, $id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        $res = $query->result_array();
        if (count($res) > 0) {
            $names['coverphoto_filename'] = $res[0]['coverphoto_filename'];
            $names['logophoto_filename'] = $res[0]['logophoto_filename'];
        }
        else
            $names = null;

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        return $names;
    }
}
?>