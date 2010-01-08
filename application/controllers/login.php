<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller{

    function __construct(){
        parent::Controller();
        $this->load->library("simplelogin");
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

    public function logout(){
        $this->simplelogin->logout();
        redirect('/');
    }

}

?>
