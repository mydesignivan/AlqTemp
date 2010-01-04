<?php
class Myaccount extends Controller{
    function __construct(){
        parent::Controller();
    }

    public function index(){
        $this->load->view("mi_cuenta");
    }
}

?>
