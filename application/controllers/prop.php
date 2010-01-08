<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');

        $this->load->helper('combobox');
    }

    public function index(){
        $this->load->view('proplist_view');
    }

    public function form(){
        $this->load->view('propform_view');
    }

    public function create(){
        
    }

    public function edit(){

    }

    public function delete(){
        
    }
}

?>