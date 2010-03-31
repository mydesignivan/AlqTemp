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
            'tlp_title'         =>  TITLE_DESTACAR,
            'tlp_title_section' =>  'Destacar Propiedades',
            'tlp_script'        =>  'disting'
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
            'listDisting'   => $this->disting_model->get_list(0),
            'listUndisting' => $this->disting_model->get_list(1)
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function disting(){
        if( $this->uri->segment(4) ){
            $id = $this->uri->segment_array();
            $disting = $id[count($id)];
            array_splice($id, 0,3);
            
            if( $disting==1 ){
                $this->disting_model->disting($id);
            }else{
                $this->disting_model->undisting($id);
            }
            redirect('/paneluser/destacar/');
        }
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_check_saldo_distingprop(){
        $totalprop = $this->disting_model->get_list(0)->num_rows;
        $saldo = (int)$this->session->userdata('fondo');
        $new_saldo = $saldo - (CFG_COSTO_PROPDISTING*$totalprop);
        if( $new_saldo<=0 ){
            die("error");
        }else{
            die("ok");
        }
    }

}

?>