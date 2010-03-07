<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Micuenta extends Controller{
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();
        
        $this->load->model('users_model');
        $this->load->library('encpss');
        $this->load->library("simplelogin");
    }

    public function index(){
        $data = $this->users_model->get_user($this->session->userdata('user_id'));
        $this->load->view("paneluser_myaccount_view", array('data'=>$data));
    }

    public function edit(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $data = array(
                'name'          => $_POST["txtName"],
                'email'         => $_POST["txtEmail"],
                'phone'         => $_POST["txtPhone"],
                'username'      => $_POST["txtUser"],
                'password'      => $this->encpss->encode($_POST["txtPass"]),
                'last_modified' => date('Y-m-d H:i:s')
            );

            $status = $this->users_model->update($data, $_POST["user_id"]);

            if( $status ){
                $this->simplelogin->logout();
                redirect('/index/');
            }else{
                show_error(ERR_USER_EDIT);
            }

        }
    }

    public function delete(){
        if( $this->uri->segment(4)!="" ){

            if( $this->users_model->delete($this->uri->segment(4)) ){
                $this->simplelogin->logout();
                redirect('/index/');
            }else{
                show_error(ERR_USER_DELETE);
            }

        }
    }

}

?>