<?php
class Promotions_model extends CI_Model
{
    public $table_name = 'promotions';
    public $selects = [
                        'id, mallid, storeid, amount, period, latitude, longitude, description, contact, link, imagename'
                      , 'id, mallid, storeid, amount_fr, period_fr, latitude, longitude, description_fr, contact, link, imagename'
                      , 'id, mallid, storeid, amount_cn, period_cn, latitude, longitude, description_cn, contact, link, imagename'
                      , 'id, mallid, storeid, amount, amount_fr, amount_cn, period, period_fr, period_cn, latitude, longitude, description, description_fr, description_cn, contact, link, imagename'
                      ];
    public $lang_f = ['amount', 'period', 'description'];
    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct()
    {
        $this->load->database();
    }

    public function getPromotions($lang)
    {
        $this->load->model("stores_model");

        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);

        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();
        $promotions = $query->result_array();

        for ($i=0; $i < count($promotions); $i++) {
            $store = $this->stores_model->getStoreById($lang, $promotions[$i]['storeid']);
            $promotions[$i]['storetype'] = $store['type'];
            $promotions[$i]['storename'] = $store['name'];

            $suffix = "";
            if ($lang == 1) {
                $suffix = "_fr";
            } else if ($lang == 2) {
                $suffix = "_cn";
            }
            if ($lang > 0) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $promotions[$i][$this->lang_f[$j]] = $promotions[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $promotions;
    }
    public function getPromotionsByMallId($lang, $mallid) {
        $this->db->select($this->selects[$lang]);
        $this->db->where('mallid', $mallid);
        $this->db->from($this->table_name);

        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();
        $promotions = $query->result_array();

        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        if ($lang > 0) {
            for ($i=0; $i < count($promotions); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $promotions[$i][$this->lang_f[$j]] = $promotions[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $promotions;
    }

    public function getPromotionById($lang, $id) {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);

            $this->db->where('id', $id);
            
            $this->db->group_by('id');
            $this->db->order_by('id', "Asc");

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0){
                $promotion = $res[0];
                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $promotion[$this->lang_f[$j]] = $promotion[$this->lang_f[$j].$suffix];
                    }
                }
                return $promotion;
            }
            else
                return "";
        } else {
            return "";
        }
    }
    public function updatePromotion($lang, $data) {
        $olddata = $this->getPromotionById(3, $data['id']);
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

    public function addPromotion($lang, $data) {
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

    public function deletePromotion($lang, $id) {
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