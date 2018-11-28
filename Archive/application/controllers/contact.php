<?php

class Contact extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('shoppingmalls_model');
    }

    function index($lang=0) {
        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        $data['main_content'] = 'contact';
        $data['activatedMenu'] = 'contactmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
