<?php

class Map extends CI_Controller{

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
    function index($lang) {
        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
		$data['metros'] = $this->metros_model->getMetros($lang);
		$data['title'] = getLocalizedString($lang, "Map");
        $data['main_content'] = 'map';
        $data['activatedMenu'] = 'mapmenu';
        $data['language'] = $lang;
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }

    function content($lang) {
        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
		$data['metros'] = $this->metros_model->getMetros($lang);
		$data['title'] = getLocalizedString($lang, "Map");
        $data['main_content'] = 'map';
        $data['activatedMenu'] = 'mapmenu';
        $data['language'] = $lang;
        $data['data']['language'] = $lang;

        $detect = new Mobile_Detect();
        if ($detect->isMobile()) {
            //echo "mobile";
            $this->load->view('map-webview-mobile', $data);
        }
        else {
            //echo "window";
            $this->load->view('map-webview', $data);  
        }
    }
}
