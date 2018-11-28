<?php

class Api extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

    function index($lang=0) {
		
        echo "Invalid Access!";

	}
	function testapi($lang = 0 , $Country, $City , $Fun ){
		
		//echo $Country ." 1" . $City ." 2" . $Fun ." 3" . $type ." 4" . $lang." 5" ;
		
		$type = isset($_GET['type']) ? $_GET['type'] : null;
		
		switch ($Fun)
		{
			case "getPlaces" :
			
				//echo "get places";
				$this->getplaces($Country , $City , $type , $lang);
				break;
			case "getplacesbyid" :
			//echo "get places by id";
				$this->getplacesbyid($Country, $City , $type , $lang);
				break;
			case "getmetros" : 
			//echo "get metros";
				$this->getmetros($Country , $City , $lang);
				break;
			case "getmetrosbyid":
			//echo "get metros by id"; 
				$this->getmetrosbyid($Country , $City , $type , $lang);
				break;
			case 'getbannerimages':
				$this->getbannerimages($lang , $Country , $City);
				break;
			case 'getplacesforar':
				$this->getplacesforar($lang , $Country , $City);
				break;
			case 'getMetroListForStore':
				$this->getMetroListForStore($lang , $Country , $City);
				break;
			default :
				$this->index();
				break;
		}
		
		
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
		$result['result'] = 'success';
		echo json_encode($result);
			
	}
	
	function getPlaces($country, $city ,$type, $lang = 0){
		
		$this->load->model('places_model');
		   
			$places = $this->places_model->getcityplacesapi($lang, $country , $city, getTypenamefromType($lang, $type) );
			$result['places'] = $places;
			$result['download_prefix_store'] = $this->config->item('download_prefix_store');
        	$result['download_prefix_store_coverphoto'] = $this->config->item('download_prefix_store_coverphoto');	
    		$result['result'] = 'success';
			
			
		    echo json_encode($result);
			//echo $country , $city , getTypenamefromType($lang, $type), $lang;
			
	}
	
	function getplacesbyid($country, $city ,$id , $lang = 0){
		
		$this->load->model('places_model');
			
			$places = $this->places_model->getplacebykey($lang, $country , $city , $id);
			
		

			$result['places'] = $places;
			$result['download_prefix_store'] = $this->config->item('download_prefix_store');
        	$result['download_prefix_store_coverphoto'] = $this->config->item('download_prefix_store_coverphoto');	
    		$result['result'] = 'success';
		    echo json_encode($result);

		
	}
	
	function getmetros($country, $city , $lang = 0){
		
		$this->load->model('metros_model');
		
		$metros = $this->metros_model->getMetros($lang , $country , $city);
	
			$results['metros'] = $metros;
			$results['download_prefix_store'] = $this->config->item('download_prefix_store');
        	$results['download_prefix_store_coverphoto'] = $this->config->item('download_prefix_store_coverphoto');	
    		$results['result'] = 'success';	
			
			echo json_encode($results);	
		
	}
	
	function getmetrosbyid($country, $city ,$id , $lang = 0){
		
		$this->load->model('metros_model');
		
		$metros = $this->metros_model->getMetroById($lang , $country , $city , $id);
		
		$results['metros'] = $metros;
		
			$result['download_prefix_store'] = $this->config->item('download_prefix_store');
        	$result['download_prefix_store_coverphoto'] = $this->config->item('download_prefix_store_coverphoto');	
    		$result['result'] = 'success';	
			
			echo json_encode($results);	
		
	}
	
	function test($country, $city ,$type, $lang = 0){
		
		$this->load->model('places_model');
		
			$places = $this->places_model->getimage($lang, $country , $city, getTypenamefromType($lang, $type) );
			$result['places'] = $places->result();
			//$result['download_prefix_store'] = $this->config->item('download_prefix_store');
        	//$result['download_prefix_store_coverphoto'] = $this->config->item('download_prefix_store_coverphoto');	
    		//$result['result'] = 'success';
			
			echo "<pre>";
		    print_r($result['places'][0]->image_name);
			echo "</pre>";
		
			
	}
	
	function getbannerimages($lang = 0 , $Country , $city)
	{
		$this->load->model('bannerimages_model');
		
		$bannerimages = $this->bannerimages_model->getBannerImages($lang , $Country , $city);
		$results['bannerimages'] = $bannerimages;
		$results['download_prefix_bannerimage'] = $this->config->item('download_prefix_bannerimage');
    	$results['result'] = 'success';	

		    echo json_encode($results);
	}
	
	
	function registerUser($lang = 0)
	{
		$this->load->model('Customers_model');
		
		$data = array();
	    $data['name'] = $_POST['name'];
        $data['userid'] = $_POST['userid'];
        $data['token'] = $_POST['token'];
        $data['pictureUrl'] = $_POST['pictureUrl'];
        $data['isfb'] = $_POST['isfb'];
		
		$res = $this->Customers_model->loginUser($data);
		if ($res){
			$result['name'] = $res['name'];
            $result['userid'] = $res['userid'];
            $result['pictureUrl'] = $res['pictureUrl'];
            $result['undercoin'] = $res['undercoin'];
            $result['result'] = 'success';
		}else{
            $result['result'] = 'failure';
		}
		
		echo json_encode($result);
	}
	
	function getplacesforar($lang = 0 , $Country , $city)
	{
		$lon = isset($_POST['longtitude']) ? $_POST['longtitude'] : null;
		$lat = isset($_POST['latitude']) ? $_POST['latitude'] : null;
		$type = isset($_POST['type']) ? $_POST['type'] : null;
		
		$this->load->model('places_model');
		
		$data = $this->places_model->getplacesforar($lang , $Country , $city , $lon , $lat , getTypenamefromType($lang, $type) );
		
		echo json_encode($data);
		
	}
	function getMetroListForStore($lang = 0 , $Country , $city)
	{
		$this->load->model('metros_model');
		$result['metros'] = $this->metros_model->getMetros($lang , $Country , $city);
        $result['result'] = 'success';
        echo json_encode($result);
	}
	

}