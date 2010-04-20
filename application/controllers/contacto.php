<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Contacto extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->helper('form');
        $this->load->model('lists_model');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'frontpage/contacto_view.php',
            'tlp_title'         =>  TITLE_CONTACTO,
            'tlp_title_section' => "Contacto",
            'tlp_script'        => array('validator', 'contact'),
            'comboCountry'    =>  $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses")),
            'comboCategory'   =>  $this->lists_model->get_category(array("0"=>"Categor&iacute;as")),
            'comboStates'     =>  $this->lists_model->get_states_search(array("0"=>"Estados / Provincias")),
            'comboCity'       =>  $this->lists_model->get_city_search(array("0"=>"Ciudades"))
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->load->view('template_frontpage_view', $this->_data);
    }

    public function send(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $this->load->library('email');

            $message = sprintf(EMAIL_CONTACT_MESSAGE, 
                    $_POST['txtName'],
                    $_POST['txtPhone'],
                    nl2br($_POST['txtConsult'])
            );

            $this->email->from($_POST['txtEmail'], $_POST['txtName']);
            $this->email->to($_POST['cboArea']);
            $this->email->subject(EMAIL_CONTACT_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                $this->session->set_flashdata('statusmail', 'ok');
            }else {
                $err = $this->email->print_debugger();
                log_message("error", $err);
                die($err);
            }
            redirect('/contacto/');
        }
    }
}

?>