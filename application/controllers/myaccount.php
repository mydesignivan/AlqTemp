<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Myaccount extends Controller{
    function __construct(){
        parent::Controller();
        $this->load->model('users');
        $this->load->library('encpss');
    }

    public function index(){
        $query = $this->users->get_user($this->session->userdata('user_id'));

        if( !$query || $query->num_rows==0 ){
            show_error(ERR_100);
        }else {
            $data = $query->row_array();
            $this->load->view("mi_cuenta", array('dataUser'=>$data));
        }
    }

    public function update(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = array(
                'name'     => $_POST["txtName"],
                'email'    => $_POST["txtEmail"],
                'phone'    => $_POST["txtPhone"],
                'username' => $_POST["txtUser"],
                'password' => $this->encpss->encode($_POST["txtPass"])
            );

            if( $this->users->update($data, $_POST["user_id"]) ){

                $this->session->userdata('name') = $_POST["txtName"];
                $this->session->userdata('email') = $_POST["txtEmail"];
                $this->session->userdata('phone') = $_POST["txtPhone"];
                $this->session->userdata('username') = $_POST["txtUser"];
                $this->session->userdata('password') = $_POST["txtPass"];
                
                redirect('/myaccount/');
            }else{
                show_error(ERR_101);
            }
        }
    }

    public function delete(){

    }

}

?>
