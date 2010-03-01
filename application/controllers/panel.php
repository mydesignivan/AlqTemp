<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Panel extends Controller{
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/');
    }

    public function index(){
        $this->load->view("micuenta_view", array('dataUser'=>$data));
    }


}
?>