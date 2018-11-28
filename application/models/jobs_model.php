<?php
class Jobs_model extends CI_Model
{
    public $table_name = 'jobs';
    
    public $selects = [
                        'id, title, company, type, description, contact, link'
                      , 'id, title_fr, company, type_fr, description_fr, contact, link'
                      , 'id, title_cn, company, type_cn, description_cn, contact, link'
                      , 'id, title, title_fr, title_cn, company, type, type_fr, type_cn, description, description_fr, description_cn, contact, link'
                      ];
    public $lang_f = ['title', 'type', 'description'];

    public function __construct()
    {
        $this->load->database();
    }

    public function getJobs($lang)
    {
        $this->db->select($this->selects[$lang]);
        $this->db->from($this->table_name);

        $this->db->group_by('id');
        $this->db->order_by('id', "asc");

        $query = $this->db->get();
        $jobs = $query->result_array();

        $suffix = "";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
        if ($lang > 0) {
            for ($i=0; $i < count($jobs); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $jobs[$i][$this->lang_f[$j]] = $jobs[$i][$this->lang_f[$j].$suffix];
                }
            }
        }
        return $jobs;
    }

    public function getJobById($lang, $id) {
        if (strcmp($id, "new") != 0) {
            $this->db->select($this->selects[$lang]);
            $this->db->from($this->table_name);

            $this->db->where('id', $id);
            
            $this->db->group_by('id');
            $this->db->order_by('id', "Asc");

            $query = $this->db->get();

            $res = $query->result_array();
            if (count($res) > 0) {
                $job = $res[0];
                $suffix = "";
                if ($lang == 1) {
                    $suffix = "_fr";
                } else if ($lang == 2) {
                    $suffix = "_cn";
                }
                if ($lang > 0) {
                    for ($j=0; $j < count($this->lang_f); $j++) {
                        $job[$this->lang_f[$j]] = $job[$this->lang_f[$j].$suffix];
                    }
                }
                return $job;
            }
            else
                return "";
        } else {
            return "";
        }
    }
    public function updateJob($lang, $data) {
        $olddata = $this->getJobById(3, $data['id']);
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

    public function addJob($lang, $data) {
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

    public function deleteJob($lang, $id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }
}
?>