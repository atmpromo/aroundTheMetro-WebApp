<?php
class Devicetoken_model extends CI_Model
{
  /**
   * Responsable for auto load the database
   * @return void
   */
  public $table_name = 'devicetokens';

  public function __construct()
  {
      $this->load->database();
  }

  public function getDeviceTokens($lang) 
  {
    $this->db->select("*");
    $this->db->from($this->table_name);    
    $query = $this->db->get();

    $res = $query->result_array();
    return $res;
  }

  public function getDeviceTokensCount($lang) 
  {
    $this->db->select("*");
    $this->db->from($this->table_name);    
    $query = $this->db->get();

    $res = $query->result_array();
    return count($res);
  }

  public function isExists($lang=0, $devicetoken, $devicetype) {
    $this->db->select('*');
    $this->db->from($this->table_name);

    $this->db->where('devicetoken', $devicetoken);
    $this->db->where('devicetype', $devicetype);
    $query = $this->db->get();
    $res = $query->result_array();
    if (count($res) > 0)
      return true;
    else 
      return false;
  }

  public function addDeviceToken($lang=0, $devicetoken, $devicetype) {
    if ( !$this->isExists($lang, $devicetoken, $devicetype) ) {
      $data['devicetoken'] = $devicetoken;
      $data['devicetype'] = $devicetype;
      return $this->db->insert( $this->table_name, $data );
    }
  }
}