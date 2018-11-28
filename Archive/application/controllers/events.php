<?php

class Events extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('events_model');
        $this->load->model('shoppingmalls_model');
    }

    function makedatestring($d) {
        return $d['month']."/".$d['day']."/".$d['year']." ".$d['hour'].":".$d['minute'];
    }

    function index($lang=0) {
        $events = $this->events_model->getEvents($lang, true);
        
        for ($i = 0; $i < count($events); $i++) {
            $start_date = $events[$i]['start_date'];
            $d1 = date_parse($start_date);
            $date1 = mktime($d1['hour'], $d1['minute'], $d1['second'], $d1['month'], $d1['day'], $d1['year']);

            $end_date = $events[$i]['end_date'];
            $d2 = date_parse($end_date);
            $date2 = mktime($d2['hour'], $d2['minute'], $d2['second'], $d2['month'], $d2['day'], $d2['year']);

            $events[$i]['expiredate'] = $this->makedatestring($d1)." - ".$this->makedatestring($d2);
            
            if (time()>=$date1 && time()<=$date2) {
                $events[$i]['expired'] = false;
            } else {
                $events[$i]['expired'] = true;
            }
        }

        $data['malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        $data['data']['events'] = $events;
        $data['main_content'] = 'events';
        $data['activatedMenu'] = 'eventsmenu';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }
}
