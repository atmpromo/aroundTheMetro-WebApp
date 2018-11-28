<?php
class Stores_model extends CI_Model
{
    /**
     * Responsable for auto load the database
     * @return void
     */
    public $table_name = 'stores';
    public $selects = [
                        'id, name, price, link, imagename'
                      , 'id, name_fr, price, link, imagename'
                      , 'id, name_cn, price, link, imagename'
                      , 'id, name, name_fr, name_cn, price, link, imagename'
                      ];
    public $lang_f = ['name'];

    public function __construct()
    {
        $this->load->database();
    }
}
?>