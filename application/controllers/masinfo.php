<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Masinfo extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->model('prop_model');
        $this->load->helper('form');
        $this->load->model('lists_model');

        $this->load->library('dataview', array(
            'tlp_section'       =>  'frontpage/moreinfo_view.php',
            'tlp_title'         =>  TITLE_MASINFO,
            'tlp_title_section' =>  "Detalle Propiedad",
            'tlp_script'        =>  array('validator', 'fancybox', 'moreinfo'),
            'comboCountry'      =>  $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses")),
            'comboCategory'     =>  $this->lists_model->get_category(array("0"=>"Categor&iacute;as")),
            'comboStates'       =>  $this->lists_model->get_states_search(array("0"=>"Estados / Provincias")),
            'comboCity'         =>  $this->lists_model->get_city_search(array("0"=>"Ciudades"))
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        if( $this->uri->segment(3) ){

            $this->_data = $this->dataview->set_data(array(
                "info"  =>  $this->prop_model->get_prop($this->uri->segment(3)),
            ));
            $this->load->view('template_frontpage_view', $this->_data);
        }
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_sendconsult(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $this->load->library('email');

            $data = $this->prop_model->get_info_prop($_POST['id']);

            $message = sprintf(EMAIL_CONSULTPROP_MESSAGE, $data['address'], $_POST['txtName'], $_POST['txtPhone'], nl2br($_POST['txtConsult']));

            $this->email->from($_POST['txtEmail'], $_POST['txtName']);
            $this->email->to($data['email']);
            $this->email->subject(EMAIL_CONSULTPROP_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                die("ok");
            }else {
                die("error");
            }

        }
    }

}

?>