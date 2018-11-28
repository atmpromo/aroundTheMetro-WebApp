<?php

class Store_Details extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('shoppingmalls_model');
        $this->load->model('stores_model');
    }

    /**
     * This is the controller method that drives the application.
     * After a user logs in, show_main() is called and the main
     * application screen is set up.
     */
    function index($lang, $storeid) {
        $this->load->model('shoppingmalls_model');
        $this->load->model('metros_model');
        
        $store = $this->stores_model->getStoreById($lang, $storeid);
        $store['mallname'] = $this->shoppingmalls_model->getShoppingmallById($lang, $store['mallid'])['name'];
        $store['metroname'] = $this->metros_model->getMetroById($lang, $store['metroid'])['name'];

        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        $data['data']['store'] = $store;
        $data['main_content'] = 'store_details';
        $data['activatedMenu'] = 'storesmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
