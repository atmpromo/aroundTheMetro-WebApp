<?php

class Api extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
		ini_set ('memory_limit' , '256M');
				ini_set('display_errors',1);

error_reporting(E_ALL);

		
    }

    function index($lang=0) {
		
        echo "Invalid Access!";

	}
	
	function getCountry($lang = 0){
		
		$this->load->model('country_model');
		
		$result['CountryList'] = $this->country_model->getcountry();
        $result['result'] = 'success';
		echo json_encode($result);
	}
	
	function getCities($lang = 0) {
		
		$this->load->model('city_model');
		$country = isset($_GET['country']) ? $_GET['country'] : null ;
		
		
		if ($country != null)
		{
			$result['CitiesList'] = $this->city_model->getcitiesbycontry($country);
		}else{
			$result['CitiesList'] = $this->city_model->getcities();
		}

		//$result['CitiesList'] = $this->city_model->getcities();
		$result['result'] = 'success';
//		echo $country;
//		echo "<pre>";
//		
//		print_r($result['CitiesList']);
//		echo "</pre>";
		echo json_encode($result);
			
	}
	
	function getPlaces($lang = 0){
		
		$this->load->model('places_model');
		
		if (isset($_GET['country']) && isset($_GET['city'])){
			
			$country = $_GET['country'] ;
			$city = $_GET['city'];
			$type = isset($_GET['type']) ? $_GET['type'] : null;
			
			$places = $this->places_model->getcityplaces($lang, $country , $city , $type);
			
//					echo "<pre>";
//					
//					print_r($places);
//					echo "</pre>";

			foreach ($places as $place)
			{
				foreach ($place as $item)
				{
					$item = utf8_encode($item);
				}
				
			}
	
			$result['places'] = $places;
			$result['download_prefix_store'] = $this->config->item('download_prefix_store');
        	$result['download_prefix_store_coverphoto'] = $this->config->item('download_prefix_store_coverphoto');	
    		$result['result'] = 'success';
			
			try {
				
		    echo json_encode($result);
			} catch (Exception $e)
			{
				echo $e;
				}


		}
		else 
		{
			$result['result'] = 'failure';
			echo json_encode($result);
		}
			
	}
	
	function getplacesbyid($lang = 0){
		
		$this->load->model('places_model');
		if (isset($_GET['country']) && isset($_GET['city'])){
			
			$country = $_GET['country'] ;
			$city = $_GET['city'];
			$id = isset($_GET['id']) ? $_GET['id'] : "";
			
			$places = $this->places_model->getplacebykey($lang, $country , $city , $id);
			
					echo "<pre>";
					
					var_dump($places);
					echo "</pre>";

			//$result['places'] = $places;
			$result['download_prefix_store'] = $this->config->item('download_prefix_store');
        	$result['download_prefix_store_coverphoto'] = $this->config->item('download_prefix_store_coverphoto');	
    		$result['result'] = 'success';
		    echo json_encode($result);
		}
		else 
		{
			$result['result'] = 'failure';
			echo json_encode($result);
		}
		
	}
	

}