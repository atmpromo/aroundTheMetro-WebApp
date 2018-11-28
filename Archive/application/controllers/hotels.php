<?php

class Hotels extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('shoppingmalls_model');
    }

    /**
     * This is the controller method that drives the application.
     * After a user logs in, show_main() is called and the main
     * application screen is set up.
     */
    function index($lang) {
        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        $data['main_content'] = 'hotels';
        $data['activatedMenu'] = 'hotelsmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
