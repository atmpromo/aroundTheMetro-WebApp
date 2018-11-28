<?php

class Jobs extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('jobs_model');
        $this->load->model('shoppingmalls_model');
    }

    /**
     * This is the controller method that drives the application.
     * After a user logs in, show_main() is called and the main
     * application screen is set up.
     */
    function index($lang) {
        
        $jobs = $this->jobs_model->getJobs($lang);

        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        $data['data']['jobs'] = $jobs;
        $data['main_content'] = 'jobs';
        $data['activatedMenu'] = 'jobsmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
