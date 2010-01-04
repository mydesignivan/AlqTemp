<?php

class Index extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->library('session');
    }

    public function index(){
        $this->load->helper('url');
        $data = array(
            'logged_in' => $this->session->userdata('logged_in')
        );

        $this->load->view('index', $data);
    }
}

?>