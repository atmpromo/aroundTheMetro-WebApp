<?php
class places_model extends CI_Model {
	
		public $selects = [
								'key, name_en, metro_en, type_en, placeID, address_en, phone, website, photo,metro_ID,  opening_hour, distance_metro, featured, imagename, coverphoto_filename, claimed, aboutus_en,lon,lat, (lon+lat) as location' 
							  , 'key, name_en, metro_fr, type_fr, placeID, address_fr, phone, website, photo,metro_ID, opening_hour, distance_metro, featured, imagename, coverphoto_filename, claimed, aboutus_fr,lon,lat, (lon+lat) as location'
							  , 'key, name_en, name-fr, metro_en, metro-fr, type_en, type-fr,metro_ID, placeID, address_en, address-fr, phone, website, photo, opening_hour, distance_metro, featured, imagename, coverphoto_filename, claimed, aboutus_en, aboutus_fr,lon,lat, (lon+lat) as location'
							  ];	
		public $lang_f = ['name' , 'metro', 'type', 'address' , 'aboutus'];

	    public function __construct()
    {
        $this->load->database();
    }

	public function getcityplaces($lang=0 , $country , $city , $placetype = null) {
		
		
		$this->db->select($this->selects[$lang]);
		
		$table_name = "_".$country."_".$city."_places";
		
		$this->db->from($table_name);
		
		if ($placetype != null)
		{
			 if ($lang == 0) 
                $this->db->where('type_en', $placetype);
        else if ($lang == 1) 
                $this->db->where('type_fr', $placetype);
        else if ($lang == 2) 
                $this->db->where('type_cn', $placetype);
		}
		$this->db->order_by('featured', "Desc");
		$query = $this->db->get();
		
		$places = $query->result_array();
		
		
		
		$suffix = "_en";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
		
        for ($i=0; $i < count($places); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $places[$i][$this->lang_f[$j]] = $places[$i][$this->lang_f[$j].$suffix];
                }
         }
		
		return $places;
		
	}
	
		public function getmetroplaces($lang=0 , $country , $city , $placetype, $metro_ID) {
		
		
		$this->db->select($this->selects[$lang]);
		
		$table_name = "_".$country."_".$city."_places";
		
		$this->db->from($table_name);
		
		if ($lang == 0) 
                $this->db->where('type_en', $placetype);
        else if ($lang == 1) 
                $this->db->where('type_fr', $placetype);
        else if ($lang == 2) 
                $this->db->where('type_cn', $placetype);
		
		$this->db->where('metro_ID' , $metro_ID);
		$this->db->order_by('featured', "Desc");
		
		$query = $this->db->get();
		
		$places = $query->result_array();
		
		
		
		$suffix = "_en";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
		
        for ($i=0; $i < count($places); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $places[$i][$this->lang_f[$j]] = $places[$i][$this->lang_f[$j].$suffix];
                }
         }
		
		return $places;
		
	}
	
	public function getcityplacesbycategory($lang=0 , $country , $city )
	
	{
		
		$this->db->select($this->selects[$lang]);
		$table_name = "_" . $country."_".$city."_places";
		
		$this->db->from($table_name); 
		       
        $this->db->group_by('key');
        $this->db->order_by('key', "Asc");

        $query = $this->db->get();
        $places = $query->result_array();
		
		$suffix = "_en";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }

        $restaurants = array();
        $boutiques = array();
        $beautyhealths = array();
        $attractions = array();

        for ($i=0; $i < count($places); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $places[$i][$this->lang_f[$j]] = $places[$i][$this->lang_f[$j].$suffix];
                }
        }
		
		for($i=0; $i < count($places); $i++) {
            if (strcasecmp($places[$i]['type'], getTypenamefromType($lang, 'restaurants')) == 0) {
                array_push($restaurants, $i);
            } else if (strcasecmp($places[$i]['type'], getTypenamefromType($lang, 'boutiques')) == 0) {
                array_push($boutiques, $i);
            } else if (strcasecmp($places[$i]['type'], getTypenamefromType($lang, 'beautyhealths')) == 0) {
                array_push($beautyhealths, $i);
            } else if (strcasecmp($places[$i]['type'], getTypenamefromType($lang, 'attractions')) == 0) {
                array_push($attractions, $i);
            }
        }

        $res = array();
        $res['stores'] = $places;
        $res['restaurants'] = $restaurants;
        $res['boutiques'] = $boutiques;
        $res['beautyhealths'] = $beautyhealths;
        $res['attractions'] = $attractions;

        return $res;
			
	}
	
	function getplacebykey ($lang=0 , $country , $city , $placekey) {
		
		$this->db->select($this->selects[$lang]);
		
		$table_name = "_".$country."_".$city."_places";
		
		$this->db->from($table_name);
		
		$this->db->where('key', $placekey);
		
		$query = $this->db->get();
		
		$place = $query->result_array();
		
		$suffix = "_en";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
		
        for ($i=0; $i < count($place); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $place[$i][$this->lang_f[$j]] = $place[$i][$this->lang_f[$j].$suffix];
                }
         }
		 
		 return $place ; 
		
		
	}
	public function getcityplacesapi($lang=0 , $country , $city , $placetype = null) {
		
		$test = [
								'key, name_en, metro_en as metroname, type_en, metro_ID, featured, imagename, coverphoto_filename, claimed,phone as contact , website'
							  , 'key, name_fr, metro_fr as metroname, type_fr, metro_ID, featured, imagename, coverphoto_filename, claimed,phone as contact , website'
							  , 'key, name_en , name-fr, metro_en, metro-fr, type_en, type-fr,metro_ID, featured, imagename, coverphoto_filename, claimed,phone as contact , website'
							  ];	
							  
		$this->db->select($test[$lang]);
		
		$table_name = "_".$country."_".$city."_places";
		
		$this->db->from($table_name);
		
		if ($placetype != null)
		{
			 if ($lang == 0) 
                $this->db->where('type_en', $placetype);
        else if ($lang == 1) 
                $this->db->where('type_fr', $placetype);
        else if ($lang == 2) 
                $this->db->where('type_cn', $placetype);
		}
		$this->db->limit(1900);
		$this->db->order_by('featured', "Desc");
		$this->db->order_by('key', "RANDOM");
		$query = $this->db->get();
		
		$places = $query->result_array();
		
		
		
		$suffix = "_en";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
		
        for ($i=0; $i < count($places); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $places[$i][$this->lang_f[$j]] = $places[$i][$this->lang_f[$j].$suffix];
                }
         }
		
		return $places;
		
	}
	
	function getimage($lang=0 , $country , $city , $placetype = null)
	{
		$this->db->select('image_name');
		$this->db->from('PlacesImages');
		$this->db->where('Countrycode', $country);
		$this->db->where('Citycode',$city);
		if ($placetype != null) $this->db->where('type', $placetype);
		else $this->db->where('type','Restaurant');
		
		
		$query = $this->db->get();
		//$this->db->query("SELECT image_name FROM MetroImages WHERE Countrycode = ? AND  Citycode = ? AND type = ? " , array($country , $city , $placetype));
		
		$img  = $query->row();
		
		return $query;
	}
		
	public function getplacesforar($lang=0 , $country , $city , $lon , $lat , $placetype) {
		
		
/*		$this->db->select('key, name_en, metro_en, type_en, placeID, address_en, phone, website, photo,metro_ID,  opening_hour, distance_metro, featured, imagename, coverphoto_filename, claimed, aboutus_en , lon , lat ');*/
		$data['çountry'] = $country;
		$data['city'] = $city;
		$data['lonbe'] = $lon;
		$data['latbe'] = $lat;
		$data['type'] = $placetype;
				
		//$this->db->select($this->selects[$lang]);
		$this->db->select('key as storeid, lon as longitude , lat  as latitude ,aboutus_en as description , phone as contact , website as link ,imagename , type_en as storetype , name_en as storename, (lon+lat) as location');
		$table_name = "_".$country."_".$city."_places";
		
		$this->db->from($table_name);
		
		if ($placetype != null)
		{
			 if ($lang == 0) 
                $this->db->where('type_en', $placetype);
        else if ($lang == 1) 
                $this->db->where('type_fr', $placetype);
        else if ($lang == 2) 
                $this->db->where('type_cn', $placetype);
		}
		
		if ($lon == null || $lat == null )
		{
			$diff = 0;
		}
		else {
			$diff = $lon + $lat;
			$this->db->order_by('ABS(location - '.$diff . ')');
			$data['lon'] = $lon;
			$data['lat'] = $lat;
			$data['location'] = $diff;
		}
		
		//if($lon !=null && $lat != null) 
		
		$this->db->limit(1000);
		
		$query = $this->db->get();
		
		$places = $query->result_array();
		
		$suffix = "_en";
        if ($lang == 1) {
            $suffix = "_fr";
        } else if ($lang == 2) {
            $suffix = "_cn";
        }
		
		
/*        for ($i=0; $i < count($places); $i++) {
                for ($j=0; $j < count($this->lang_f); $j++) {
                    $places[$i][$this->lang_f[$j]] = $places[$i][$this->lang_f[$j].$suffix];
                }
         }
		 for ($e=0; $e <count($places);$e++)
		 {
			 $places[$e]['test'] = $places[$e]['lon']  + $places[$e]['lat'];
		 }*/
		 $data['places'] = $places;
		
		return $data;
		
	}
	
}
?>