<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Rememberpass extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
        $this->load->model('users_model');
    }

    public function index(){
        $this->load->view('rememberpass_view');
    }

    public function send(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $pss = $this->users_model->rememberpass(trim($_POST["txtEmail"]));
            if( !$pss ){
                $this->session->set_flashdata('status', 'emailnotexists');
                redirect('/rememberpass/');
            }

            /*$this->email->from(EMAIL_RP_FROM, EMAIL_RP_NAME);
            $this->email->to($_POST["txtEmail"]);
            $this->email->subject(EMAIL_RP_SUBJECT);
            $this->email->message(sprintf(EMAIL_RP_MESSAGE, "<b>".$pss."</b>"));
            if( $this->email->send() ){*/
                /*$this->session->set_flashdata('status', 'ok');
                redirect('/rememberpass/');*/
            /*}else {
                show_error(ERR_103);
            }*/
        }
    }
}

?>