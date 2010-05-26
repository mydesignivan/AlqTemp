<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Destacar extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();

        $this->load->model('disting_model');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneluser/destacar_view.php',
            'tlp_title'         =>  setup('TITLE_DESTACAR'),
            'tlp_title_section' =>  'Destacar Propiedades',
            'tlp_script'        =>  array('json', 'popup', 'disting')
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->_data = $this->dataview->set_data(array(
            'listDisting'   => $this->disting_model->get_list(1),
            'listUndisting' => $this->disting_model->get_list(0)
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function disting(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = json_decode($_POST['data_post']);

            $this->disting_model->disting($data->id, $data->type);
            redirect('/paneluser/destacar/');
        }
    }
    public function undisting(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $data = json_decode($_POST['data_post']);

            $this->disting_model->undisting($data);
            redirect('/paneluser/destacar/');
        }
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_check_saldo_distingprop(){
        $totalprop = $this->disting_model->get_list(0)->num_rows;
        $saldo = (int)$this->session->userdata('fondo');
        $new_saldo = $saldo - (setup('CFG_COSTO_PROPDISTING')*$totalprop);
        if( $new_saldo<=0 ){
            die("error");
        }else{
            die("ok");
        }
    }

    public function ajax_popup_typedisting(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $this->load->view('paneluser/popup/propdist_tipos_view.php');
        }
    }

}

?>