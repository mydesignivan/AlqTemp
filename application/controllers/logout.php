<?php
class Logout extends Controller{

    function __construct(){
        parent::Controller();
        $this->load->library("Simplelogin");
    }

    public function index(){
        $this->simplelogin->logout();
        redirect('/');
    }
}

?>
