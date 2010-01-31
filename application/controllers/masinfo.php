<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Masinfo extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
        $this->load->model('prop_model');
    }

    public function index(){
        if( $this->uri->segment(3) ){
            $data = $this->prop_model->get_prop($this->uri->segment(3));
            $this->load->view('propdetalle_view', array("data"=>$data));
        }
    }

    public function sendconsult(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $this->load->library('email');

            $data = $this->prop_model->get_info_prop($_POST['id']);

            $message = sprintf(EMAIL_CONSULTPROP_MESSAGE, $data['address'], $_POST['txtName'], $_POST['txtPhone'], nl2br($_POST['txtConsult']));

            $this->email->from($_POST['txtEmail'], $_POST['txtName']);
            $this->email->to($data['email']);
            $this->email->subject(EMAIL_CONSULTPROP_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                echo "ok";
            }else {
                show_error(ERR_103);
            }

        }
    }

}

?>