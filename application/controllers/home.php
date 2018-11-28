<?php

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('bannerimages_model');
//        $this->load->model('shoppingmalls_model');
//        $this->load->model('stores_model');
//        $this->load->model('events_model');
//        $this->load->model('promotions_model');
//		$this->load->model('metros_model');
    }

    function index($lang=0) {
        $data['data']['bannerimages'] = $this->bannerimages_model->getBannerimages($lang);
//        $data['data']['stores'] = $this->stores_model->getStoresByCategory($lang);
//        $data['data']['events'] = $this->events_model->getEvents($lang);
//        $data['data']['promotions'] = $this->promotions_model->getPromotions($lang);
//        $data['data']['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
//		$data['metros'] = $this->metros_model->getMetros($lang);
//        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        $data['main_content'] = 'home';
        $data['activatedMenu'] = 'homemenu';
        $data['data']['language'] = $lang;
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