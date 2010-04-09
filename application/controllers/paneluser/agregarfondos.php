<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Agregarfondos extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();

        $this->load->model('fondos_model');
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

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_order(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $token = $this->fondos_model->order_save();
            echo "token".$token;
        }
    }
}
?>