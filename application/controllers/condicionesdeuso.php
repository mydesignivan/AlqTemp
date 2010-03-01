<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Condicionesdeuso extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
    }

    public function index(){
        $this->load->view('front_condiciones_view');
    }

}

?>