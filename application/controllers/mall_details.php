<?php

class Mall_Details extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('shoppingmalls_model');
		$this->load->model('metros_model');
    }

    /**
     * This is the controller method that drives the application.
     * After a user logs in, show_main() is called and the main
     * application screen is set up.
     */
    function index($lang, $mallid) {
        
        $mall = $this->shoppingmalls_model->getShoppingmallById($lang, $mallid);

        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
		$data['metros'] = $this->metros_model->getMetros($lang);
		$data['title'] = $mall['name'];
        $data['data']['mall'] = $mall;
        $data['main_content'] = 'mall_details';
        $data['activatedMenu'] = 'mallsmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
