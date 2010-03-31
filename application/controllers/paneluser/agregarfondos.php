<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Agregarfondos extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();
        $this->load->library('email');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneluser/addfondo_view.php',
            'tlp_title'         =>  TITLE_AGREGAR_FONDOS,
            'tlp_script'        =>  'addfondo',
            'tlp_title_section' =>  'Agregar Fondos'
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

    public function send(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $user_email = $this->session->userdata('email');
            $user_name = $this->session->userdata('name');
            $user_phone = $this->session->userdata('phone');

            $message = sprintf(EMAIL_BUYCREDIT_MESSAGE, 
                    $user_name,
                    $user_phone,
                    $user_email,
                    $_POST['cboFormaPago'],
                    $_POST['cboImport'],
                    $_POST['credit']
            );

            $this->email->from(EMAIL_BUYCREDIT_FROM, "");
            $this->email->to(EMAIL_BUYCREDIT_TO);
            $this->email->subject(EMAIL_BUYCREDIT_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                $this->session->set_flashdata('status', 'ok');
                redirect('/paneluser/agregarfondos/');
            }else {
                $err = $this->email->print_debugger();
                log_message("error", $err);
                die($err);
            }
        }
    }

    public function success(){
        $this->_data = $this->dataview->set_data(array(
            'result_buy' => 'success'
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }
    public function cancel(){
        $this->_data = $this->dataview->set_data(array(
            'result_buy' => 'cancel'
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

}
?>