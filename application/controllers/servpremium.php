<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Servpremium extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/');
    }

    public function index(){
        $this->load->view('servpremium_view');
    }
}

?>