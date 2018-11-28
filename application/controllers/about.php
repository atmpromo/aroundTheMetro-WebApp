<?php

class About extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('shoppingmalls_model');
		$this->load->model('metros_model');

    }

    function index($lang=0) {
        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
		$data['metros'] = $this->metros_model->getMetros($lang);
		$data['title'] = getLocalizedString($lang, "About");
        $data['main_content'] = 'about';
        $data['activatedMenu'] = 'aboutmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
