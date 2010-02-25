<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cuentaplus extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');
        $this->load->model('cuentaplus_model');
        $this->load->library('email');
    }

    public function index(){
        $this->load->view('cuentaplus_view');
    }

    public function shipping(){

        $fondo = $this->session->userdata('fondo');
        $newfondo = (int)$fondo-CFG_VALUE_CUENTAPLUS;
        if( $newfondo<=0 ){
            $this->session->set_flashdata('cp_status', 'insufficient_amount');

        }else{

            $this->cuentaplus_model->debit();

            $message = EMAIL_CUENTAPLUS_MESSAGE;

            $this->email->from(EMAIL_CUENTAPLUS_FROM, EMAIL_CUENTAPLUS_NAME);
            $this->email->to($this->session->userdata('email'));
            $this->email->subject(EMAIL_CUENTAPLUS_SUBJECT);
            $this->email->message($message);
            if( !$this->email->send() ){
                $err = $this->email->print_debugger();
                log_message("error", $err);
                die($err);
            }else{
                $this->session->set_flashdata('cp_status', 'ok');
            }
        }
        redirect('/cuentaplus_view/');
    }

}

?>