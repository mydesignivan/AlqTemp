<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Controller {

    function __construct(){
        parent::Controller();
    }

    public function index(){
        $this->load->view('index');
    }
}

?>