<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Creditbuy extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');
    }

    public function index(){
        $this->load->view('comprarcreditos_view');
    }
}

?>