<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Destacar extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();

        $this->load->model('disting_model');
    }

    public function index(){
        $data = array(
            'listDisting'   => $this->disting_model->get_list(0),
            'listUndisting' => $this->disting_model->get_list(1)
        );
        $this->load->view('paneluser_propdisting_view', $data);
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
            redirect('/panel/destacar/');
        }
    }

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