<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_account extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
    }

    public function index(){
        
    }

    public function valid(){
        if( $this->users_model->exists($this->uri->segment(3), $this->uri->segment(4)) ){
            echo "exists";
        }
    }

}

?>