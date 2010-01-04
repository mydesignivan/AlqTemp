<?php
class Login extends Controller{

    function __construct(){
        parent::Controller();
        $this->load->library("Simplelogin");
    }

    public function index(){

        $this->simplelogin->logout();
        $statusLogin = $this->simplelogin->login($_POST["txtLoginUser"], $_POST["txtLoginPass"]);
        
        if( $statusLogin ){
            redirect('/myaccount/');
        }else{
            $this->session->set_flashdata('logout', true);
            redirect('/');
        }

    }
}

?>
