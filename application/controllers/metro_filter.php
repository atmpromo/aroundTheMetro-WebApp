<?php

class metro_filter extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('bannerimages_model');
		$this->load->model('country_model');
		$this->load->model('city_model');
		$this->load->model('places_model');
		$this->load->model('metros_model');
    }

    function index($lang=0 , $country , $city , $type , $metroid) {
		
        $data['data']['bannerimages'] = $this->bannerimages_model->getBannerimages($lang);
		$places = $this->places_model->getmetroplaces($lang, $country , $city , getTypenamefromType($lang , $type), $metroid);
//        $data['data']['stores'] = $this->stores_model->getStoresByCategory($lang);
//        $data['data']['events'] = $this->events_model->getEvents($lang);
//        $data['data']['promotions'] = $this->promotions_model->getPromotions($lang);
//        $data['data']['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
//		$data['metros'] = $this->metros_model->getMetros($lang);
//        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
		$headerimg = $this->places_model->getimage($lang, $country , $city, getTypenamefromType($lang, $type) );
		$data['data']['headerimg'] = $headerimg->result();
		$data['metros'] = $this->metros_model->getMetros($lang , $country , $city);
		$data['data']['places'] = $places;
		$data['data']['country'] = $country;
		$data['country'] = $country;
		$data['data']['city'] = $city;
		$data['city'] = $city;
        $data['main_content'] = 'places';
        $data['activatedMenu'] = 'placesmenu';
        $data['data']['language'] = $lang;
		$data['data']['title'] = getTypenamefromType($lang, $type)."s";
        $this->load->view('includes/template', $data);
		
    }
}
