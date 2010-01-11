<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_prop extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('prop_model');
    }

    public function index(){
        
    }

    public function valid(){
        if( $this->prop_model->exists($this->uri->segment(3), $this->uri->segment(4)) ){
            echo "exists";
        }
    }

}

?>