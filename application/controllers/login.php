<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller{

    function __construct(){
        parent::Controller();
        $this->load->library("simplelogin");
    }

    public function index(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $statusLogin = $this->simplelogin->login($_POST["txtLoginUser"], $_POST["txtLoginPass"]);
            
            $this->session->set_flashdata('statusLogin', $statusLogin);
            
            redirect('/');
        }
    }

    public function logout(){
        $this->simplelogin->logout();
        redirect('/');
    }

}

?>
