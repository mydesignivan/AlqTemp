<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Myaccount extends Controller{
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');
        
        $this->load->model('users_model');
        $this->load->library('encpss');
    }

    public function index(){
        $query = $this->users_model->get_user($this->session->userdata('user_id'));

        if( !$query || $query->num_rows==0 ){
            show_error(ERR_100);
        }else {
            $data = $query->row_array();
            $this->load->view("micuenta_view", array('dataUser'=>$data));
        }
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

            $statusUpdate = $this->users_model->update($data, $_POST["user_id"]);

            if( $statusUpdate=="ok" ){
                $this->session->set_userdata($data);
                $this->session->set_flashdata('statusrecord', 'saveok');
                redirect('/myaccount/');

            }else{
                show_error(ERR_101);
            }

        }
    }

    public function delete(){
        if( $this->uri->segment(3)!="" ){

            $this->prop_model->delete($this->uri->segment(3));
            redirect('/prop/');

        }
    }

}

?>
