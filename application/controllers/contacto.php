<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Contacto extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
    }

    public function index(){
        $this->load->view('contact_view');
    }

    public function send(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $this->load->library('email');

            $message = sprintf(EMAIL_CONTACT_MESSAGE, $_POST['txtName'], $_POST['txtPhone'], nl2br($_POST['txtConsult']));

            $this->email->from($_POST['txtEmail'], $_POST['txtName']);
            $this->email->to(EMAIL_CONTACT_TO);
            $this->email->subject(EMAIL_CONTACT_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                $this->session->set_flashdata('statusmail', 'ok');
            }else {
                $this->session->set_flashdata('statusmail', 'error');
            }
            redirect('/contacto/');
        }
    }
}

?>