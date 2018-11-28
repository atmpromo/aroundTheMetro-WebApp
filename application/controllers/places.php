<?php

class Places extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('bannerimages_model');
		$this->load->model('country_model');
		$this->load->model('city_model');
		$this->load->model('places_model');
		$this->load->model('metros_model');
//        $this->load->model('shoppingmalls_model');
//        $this->load->model('stores_model');
//        $this->load->model('events_model');
//        $this->load->model('promotions_model');
//		  $this->load->model('metros_model');
    }

    function index($lang=0 , $country , $city , $type) {
        $data['data']['bannerimages'] = $this->bannerimages_model->getBannerimages($lang);
		$places = $this->places_model->getcityplaces($lang, $country , $city , getTypenamefromType($lang , $type));
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
		$data['data']['title'] = getTypenamefromType($lang, $type);
        $this->load->view('includes/template', $data);
		
    }

    // function search($lang=0) {
    //     $data['data']['stores'] = $this->stores_model->getStoresByCategory($lang);
    //     $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
    //     $data['main_content'] = 'search_result_home';
    //     $data['activatedMenu'] = 'homemenu';
    //     $data['data']['language'] = $lang;
    //     $this->load->view('includes/template', $data);
    // }
}