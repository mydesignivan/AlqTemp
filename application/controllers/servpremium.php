<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Servpremium extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');
    }

    public function index(){
        $this->load->view('servicios_premium');
    }
}

?>