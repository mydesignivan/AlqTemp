<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Micuenta extends Controller{
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/');
        
        $this->load->model('users_model');
        $this->load->library('encpss');
        $this->load->library("simplelogin");
    }

    public function index(){
        $query = $this->users_model->get_user($this->session->userdata('user_id'));
        $data = $query->row_array();
        $this->load->view("paneluser_myaccount_view", array('dataUser'=>$data));
    }

    public function edit(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $data = array(
                'name'     => $_POST["txtName"],
                'email'    => $_POST["txtEmail"],
                'phone'    => $_POST["txtPhone"],
                'username' => $_POST["txtUser"],
                'password' => $this->encpss->encode($_POST["txtPass"])
            );

            $status = $this->users_model->update($data, $_POST["user_id"]);

            if( $status ){
                $this->simplelogin->logout();
                redirect('/');
            }else{
                show_error(ERR_USER_EDIT);
            }

        }
    }

    public function delete(){
        if( $this->uri->segment(3)!="" ){

            if( $this->users_model->delete($this->uri->segment(3)) ){
                $this->simplelogin->logout();
                redirect('/');
            }else{
                show_error(ERR_USER_DELETE);
            }

        }
    }

}

?>