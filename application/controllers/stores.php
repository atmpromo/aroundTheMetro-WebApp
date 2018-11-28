<?php

class Stores extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('stores_model');
        $this->load->model('shoppingmalls_model');
        $this->load->model('metros_model');
    }

    function index($lang, $storetype) {        
        $stores = $this->stores_model->getStores($lang, getTypenamefromType($lang, $storetype));
        for ($i=0; $i<count($stores); $i++) {
            $stores[$i]['mallname'] = $this->shoppingmalls_model->getShoppingmallById($lang, $stores[$i]['mallid'])['name'];
            $stores[$i]['metroname'] = $this->metros_model->getMetroById($lang, $stores[$i]['metroid'])['name'];
        }

        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
		$data['metros'] = $this->metros_model->getMetros($lang);
        $data['data']['malls'] = $this->shoppingmalls_model->getMallnamelist($lang);
        $data['data']['metros'] = $this->metros_model->getMetronamelist($lang);
		$data['title'] = $storetype;
        $data['data']['stores'] = $stores;
        $data['main_content'] = 'stores';
        $data['activatedMenu'] = 'storesmenu';
        $data['data']['title'] = getTypenamefromType($lang, $storetype)."s";
        $data['data']['language'] = $lang;        
        $this->load->view('includes/template', $data);
    }
}
