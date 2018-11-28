<?php

class metro_details extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

		$this->load->model('metros_model');
		
    }

    /**
     * This is the controller method that drives the application.
     * After a user logs in, show_main() is called and the main
     * application screen is set up.
     */
    function index($lang, $country, $city,  $metroid) {
        
        $metro = $this->metros_model->getMetroById($lang, $country, $city , $metroid);
		$data['data']['country'] = $country;
		$data['country'] = $country;
		$data['data']['city'] = $city;
		$data['city'] = $city;
		$data['metros'] = $this->metros_model->getMetros($lang , $country , $city);
		$data['title'] = $metro['name'];
        $data['data']['metro'] = $metro;
        $data['main_content'] = 'metro_details';
        $data['activatedMenu'] = 'metrosmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
