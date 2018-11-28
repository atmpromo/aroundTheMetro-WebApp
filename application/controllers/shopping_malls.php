<?php

class Shopping_Malls extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('shoppingmalls_model');

        if( !$this->session->userdata('is_logged_in') ) {
            redirect('admin/login');
        }
    }

    /**
     * This is the controller method that drives the application.
     * After a user logs in, show_main() is called and the main
     * application screen is set up.
     */
    public function index($lang=0) {
        $data['data']['shopping_malls'] = $this->shoppingmalls_model->getShoppingmalls($lang);
        //$data['shopping_malls'] = ;
        $data['main_content'] = 'admin/shopping_malls/list';
        $data['activatedMenu'] = 'shopping_malls';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }

    public function updateShoppingMall($lang=0) {
        $id = $this->uri->segment(3);

        $this->load->model("shoppingmalls_model");
        $this->load->model('mappositions_model');

        $data['data']['shopping_mall'] = $this->shoppingmalls_model->getShoppingmallById($lang, $id);
        if (strcmp($id, 'new') == 0)
            $data['data']['shopping_mall']['id'] = -1;

        $data['data']['mappositions'] = $this->mappositions_model->getMappositions();
        $data['data']['malls'] = $this->shoppingmalls_model->getMallnamelist($lang);
        $data['main_content'] = 'admin/shopping_malls/edit';
        $data['activatedMenu'] = 'shopping_malls';
        $data['data']['language'] = $lang;
        $this->load->view('includes/template', $data);
    }

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

    public function shoppingmalldatasubmit($lang=0) {
        $id = $_POST['id'];
        $this->load->library('upload');

//upload cover photo
        if ($id >= 0 && strlen(str_replace(" ", "", $_POST['coverphoto_imagename'])) != 0) 
            $coverphoto_imagename = $_POST['coverphoto_imagename'];
        else
            $coverphoto_imagename = $this->random_string(30);
        $config['upload_path'] = './assets/uploaded/shoppingmalls/coverphoto/';
        $config['file_name'] = $coverphoto_imagename;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = true;
        $config['max_size']     = '10000';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        
        $this->upload->initialize($config);

        $error1 = null;
        if ( ! $this->upload->do_upload('coverphoto_imagename')) {
            $error1 = array('error' => $this->upload->display_errors());
        } else {
            $data['coverphoto_filename'] = $this->upload->data()['file_name'];
        }

//upload logo
        if ($id >= 0 && strlen(str_replace(" ", "", $_POST['logophoto_imagename'])) != 0) 
            $logophoto_imagename = $_POST['logophoto_imagename'];
        else
            $logophoto_imagename = $this->random_string(31);

        $config['upload_path'] = './assets/uploaded/shoppingmalls/logo/';
        $config['file_name'] = $logophoto_imagename;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = true;
        $config['max_size']     = '10000';
        $config['max_width'] = '10240';
        $config['max_height'] = '7680';
        
        $this->upload->initialize($config);

        $error2 = null;
        if ( ! $this->upload->do_upload('logophoto_imagename')) {
            $error2 = array('error' => $this->upload->display_errors());
        } else {
            $data['logophoto_filename'] = $this->upload->data()['file_name'];
        }
//upload datas
        $data['name'] = $_POST['name'];
        $data['workinghours'] = $_POST['workinghours'];
        $data['contact'] = $_POST['contact'];
        $data['link'] = $_POST['link'];
        $data['aboutus'] = $_POST['aboutus'];
        $data['mapposition'] = $_POST['mapposition'];
        $data['latitude'] = $_POST['latitude'];
        $data['longitude'] = $_POST['longitude'];

        $count = $_POST['infocount'];
        $info = "{";
        for ($i=0; $i<$count; $i++) {
            $key = $_POST['key'.$i];
            $val = $_POST['val'.$i];
            $info = $info.'"'.$key.'":"'.$val.'"';
            if ($i < $count-1)
                $info = $info.',';
        }
        $data['info'] = $info.'}';

        echo $data['name'];
        if ($id >= 0) {
            $data['id'] = $id;
            $this->shoppingmalls_model->updateShoppingMall($lang, $data);
        } else {
            $this->shoppingmalls_model->addShoppingmall($lang, $data);
        }

        if ($lang == 0)
            redirect(base_url().'admin/shopping_malls');
        else if ($lang == 1)
            redirect(base_url().'admin_fr/shopping_malls');
        else if ($lang == 2)
            redirect(base_url().'admin_cn/shopping_malls');
    }

    function deleteShoppingmall($lang=0) {
        $id = $this->uri->segment(4);
        $names = $this->shoppingmalls_model->deleteShoppingmall($lang, $id);
        if ($names != null) {
            unlink('./assets/uploaded/shoppingmalls/coverphoto/'.$names['coverphoto_filename']);
            unlink('./assets/uploaded/shoppingmalls/logo/'.$names['logophoto_filename']);
        }
        if ($lang == 0)
            redirect(base_url().'admin/shopping_malls');
        else if ($lang == 1)
            redirect(base_url().'admin_fr/shopping_malls');
        else if ($lang == 2)
            redirect(base_url().'admin_cn/shopping_malls');
    }
}
