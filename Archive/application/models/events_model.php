<?php
class Events_model extends CI_Model
{
    public $table_name = 'events';
    public $selects = [
                        'id, title, subtitle, type, description, contact, link, imagename, start_date, end_date'
                      , 'id, title_fr, subtitle_fr, type_fr, description_fr, contact, link, imagename, start_date, end_date'
                      , 'id, title_cn, subtitle_cn, type_cn, description_cn, contact, link, imagename, start_date, end_date'
                      , 'id, title, title_fr, title_cn, subtitle, subtitle_fr, subtitle_cn, type, type_fr, type_cn, description, description_fr, description_cn, contact, link, imagename, start_date, end_date'
                      ];
    public $lang_f = ['title', 'subtitle', 'type', 'description'];
    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct()
    {
        $this->load->database();
    }
    
    public function getEvents($lang, $includeExpires = false)
    {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);
        if ($includeExpires == false) {
            $this->db->where('start_date <= ', date("Y-m-d H:m:s"));
            $this->db->where('end_date >= ', date("Y-m-d H:m:s"));
        }

        $this->db->group_by('id');
        $this->db->order_by('id', "Asc");

        $query = $this->db->get();

        $events = $query->result_array();
        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }

        if ($lang > 0) {
            for ($i=0; $i < count($events); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $events[$i][$this->lang_f[$j]] = $events[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $events;
    }
    public function getEventById($lang, $id) {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);

            $this->db->where('id', $id);
            
            $this->db->group_by('id');
            $this->db->order_by('id', "Asc");

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0){
                $event = $res[0];

                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $event[$this->lang_f[$j]] = $event[$this->lang_f[$j].$suffix];
                    }
                }
                return $event;
            }
            else
                return "";
        } else {
            return "";
        }
    }
    public function updateEvent($lang, $data) {
        $olddata = $this->getEventById(3, $data['id']);
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

    public function addEvent($lang, $data) {
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

    public function deleteEvent($lang, $id) {
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