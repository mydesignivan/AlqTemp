<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller{

    function __construct(){
        parent::Controller();
        $this->load->library("Simplelogin");
        $this->load->model('users');
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

    public function update(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            print_r($_POST);

            /*$data = array(
                'name'     => $_POST["txtName"],
                'email'    => $_POST["txtEmail"],
                'phone'    => $_POST["txtPhone"],
                'username' => $_POST["txtUser"],
                'password' => $_POST["txtPass"]
            );*/
            $data = array(
                'name'     => $_POST["txtName"],
                'email'    => $_POST["txtEmail"],
                'phone'    => $_POST["txtPhone"]
            );
            
            if( $this->users->update($data, $_POST["user_id"]) ){
                redirect('/myaccount/');
            }
        }
    }

    public function delete(){

    }

}

?>
