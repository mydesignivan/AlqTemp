<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Setup extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');

        $this->load->model('setup_model');
        $this->load->library('dataview');
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->_data = $this->dataview->set_data(array(
            'tlp_section'       =>  'paneladmin/setup_view.php',
            'tlp_title_section' =>  'Panel Configuraci&oacute;n',
            'tlp_script'        =>  'tabs',
            'info'              =>  $this->setup_model->get_data()
        ));
        $this->load->view("template_paneladmin_view", $this->_data);
    }

    public function save(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $this->setup_model->update() ){
                redirect('/paneladmin/setup/');
            }
        }
    }

    /* AJAX FUNCTIONS
     **************************************************************************/


    /* PRIVATE FUNCTIONS
     **************************************************************************/

}
?>