<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_search extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
    }

    public function index(){
        
    }

    public function list_states(){
        get_options_state($this->uri->segment(3));
    }
    public function list_city(){
        get_options_city($this->uri->segment(3));
    }

}

?>