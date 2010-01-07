<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');
    }

    public function index(){
        $this->load->view('editar_propiedad');
    }

    public function form(){
        $this->load->view('nueva_propiedad');
    }
}

?>