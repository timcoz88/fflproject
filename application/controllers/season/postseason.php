<?php

class Postseason extends MY_Controller{


    function __construct()
    {
        parent::__construct();
        $this->load->model('content_model');
    }


    public function index()
    {
        $data = array();
        $data['content'] = $this->content_model->get_content('playoffs');
        $this->user_view('user/season/postseason',$data);
    }
}

?>