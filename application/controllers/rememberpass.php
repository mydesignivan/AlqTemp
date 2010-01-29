<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Rememberpass extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
        $this->load->model('users_model');
        $this->load->library('email');
    }

    public function index(){
        $this->load->view('rememberpass_view', array('status'=>false));
    }

    public function send(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $result = $this->users_model->rememberpass(trim($_POST["txtEmail"]));

            //$this->session->set_flashdata('status', $result['status']);
            
            if( $result['status']=="ok" ){
                $this->email->from(EMAIL_RP_FROM, EMAIL_RP_NAME);
                $this->email->to($_POST["txtEmail"]);
                $this->email->subject(EMAIL_RP_SUBJECT);
                $this->email->message(sprintf(EMAIL_RP_MESSAGE, "<b>". $result['password'] ."</b>"));
                if( !$this->email->send() ){
                    show_error(ERR_103);
                }
            }
            $this->load->view('rememberpass_view', array('status'=>$result['status']));
        }
    }
}

?>