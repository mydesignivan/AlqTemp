<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Destacarme extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');
        $this->load->model('disting_model');
    }

    public function index(){
        $data1 = $this->disting_model->get_list(0);
        $data2 = $this->disting_model->get_list(1);
        $this->load->view('destacarme_view', array('propDisting'=>$data1, 'propUndisting'=>$data2));
    }

    public function disting(){
        if( $this->uri->segment(3) ){
            $id = $this->uri->segment_array();
            $disting = $id[count($id)];
            array_splice($id, 0, 2);
            array_splice($id, -1);

            if( $disting==1 ){
                $this->disting_model->disting($id);
            }else{
                $this->disting_model->undisting($id);
            }
            redirect('/destacarme/');
        }
    }

}

?>