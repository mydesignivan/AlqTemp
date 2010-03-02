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

            if( $this->session->userdata('level')==0 ){
                redirect('/');
            }else{
                redirect('/inicio/');
            }
        }
    }

    public function logout(){
        $this->simplelogin->logout();
        redirect('/');
    }

    public function account_access(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $this->load->library('encpss');
            if( $this->simplelogin->login($this->encpss->decode($_POST["p1"]), $this->encpss->decode($_POST["p2"])) ){
                redirect('/micuenta/');
            }
        }
    }

}

?>
