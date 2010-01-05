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

    public function logout(){
        $this->simplelogin->logout();
        redirect('/');
    }

    public function create(){
        $data = array(
            'name'     => $_POST["txtName"],
            'email'    => $_POST["txtEmail"],
            'phone'    => $_POST["txtPhone"],
            'username' => $_POST["txtUser"],
            'password' => $_POST["txtPass"]
        );

        $user_id = $this->simplelogin->create($data);
        if( $user_id ){

            /*$this->load->library('email');
            $this->email->from('ivan@mydesign.com.ar', 'Ivan');
            $this->email->to('ivan@mydesign.com.ar');
            $this->email->subject('www.alquilerestemporarios.org');
            $this->email->message('Activiacion de usuario');
            $this->email->send();
            echo $this->email->print_debugger();*/

            
            $this->session->set_flashdata('statusrecord', true);
            redirect('/myaccount/');
        }

    }

    public function delete(){

    }

}

?>
