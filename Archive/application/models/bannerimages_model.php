<?php
class Bannerimages_Model extends CI_Model
{
    /**
     * Responsable for auto load the database
     * @return void
     */
    public $table_name = 'bannerimages';
    public $selects = [
                        'id, title, link, imagename'
                      , 'id, title_fr, link, imagename'
                      , 'id, title_cn, link, imagename'
                      , 'id, title, title_fr, title_cn, link, imagename'
                      ];
    public $lang_f = ['title'];
    public function __construct()
    {
        $this->load->database();
    }

    public function getBannerImages($lang) {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);
        
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
    public function getBannerImageById($lang, $id) {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);

            $this->db->where('id', $id);
            
            $this->db->group_by('id');
            $this->db->order_by('id', "Asc");

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0){
                $bannerimage = $res[0];
                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $bannerimage[$this->lang_f[$j]] = $bannerimage[$this->lang_f[$j].$suffix];
                    }
                }
                return $bannerimage;
            }
            else
                return "";
        } else {
            return "";
        }
    }
    public function updateBannerImage($lang, $data) {
        $olddata = $this->getBannerImageById(3, $data['id']);
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

    public function addBannerImage($lang, $data) {
        if ($lang == 0) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_fr"] = "";
                $data[$this->lang_f[$j]."_cn"] = "";
            }
        } else if ($lang == 1) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_fr"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]] = "";                
                $data[$this->lang_f[$j]."_cn"] = "";
            }
        } else if ($lang == 2) {
            for ($j=0; $j < count($this->lang_f); $j++) {
                $data[$this->lang_f[$j]."_cn"] = $data[$this->lang_f[$j]];
                $data[$this->lang_f[$j]] = "";
                $data[$this->lang_f[$j]."_fr"] = "";
            }
        }
        return $this->db->insert( $this->table_name, $data );
    }
    
    public function deleteBannerImage($lang, $id) {
        $this->db->select('imagename');
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        $res = $query->result_array();
        if (count($res) > 0)
            $filename = $res[0]['imagename'];
        else
            $filename = null;

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        return $filename;
    }
}
?>