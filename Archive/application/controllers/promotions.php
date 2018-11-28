<?php

class Promotions extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('promotions_model');
        $this->load->model('shoppingmalls_model');
    }
    
    function index($lang=0) {
        $promotions = $this->promotions_model->getPromotions($lang);
        for ($i=0; $i<count($promotions); $i++) {
            $promotions[$i]['mallname'] = $this->shoppingmalls_model->getShoppingmallById($lang, $promotions[$i]['mallid'])['name'];
            $promotions[$i]['storename'] = $this->stores_model->getStoreById($lang, $promotions[$i]['storeid'])['name'];
        }

        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        $data['data']['promotions'] = $promotions;
        $data['main_content'] = 'promotions';
        $data['activatedMenu'] = 'promotionsmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
