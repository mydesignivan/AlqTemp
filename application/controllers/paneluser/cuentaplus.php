<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cuentaplus extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();

        $this->load->model('cuentaplus_model');
        $this->load->library('email');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneluser/cuentaplus_view.php',
            'tlp_title'         =>  TITLE_CUENTAPLUS,
            'tlp_title_section' =>  'Cuenta Plus'
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function confirm(){
        $check_cuentaplus = $this->cuentaplus_model->check();
        $this->_data = $this->dataview->set_data(array(
            'action'            => 'confirm_buy',
            'check_cuentaplus'  =>  $check_cuentaplus
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function shipping(){

        $fondo = $this->session->userdata('fondo');
        $newfondo = (int)$fondo-CFG_COSTO_CUENTAPLUS;
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
        redirect('/paneluser/cuentaplus/');
    }

    public function cancel(){
        $this->_data = $this->dataview->set_data(array(
            'action'            => 'cancel'
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

}
?>