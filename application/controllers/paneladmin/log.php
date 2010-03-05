<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Log extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');

    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        $this->load->view('paneladmin_log_view');
    }



}
?>