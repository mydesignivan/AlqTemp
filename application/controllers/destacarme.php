<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Destacarme extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');
        $this->load->model('prop_model');
    }

    public function index(){
        $data1 = $this->prop_model->get_list_prop(array('disting'=>0));
        $data2 = $this->prop_model->get_list_prop(array('disting'=>1));
        $this->load->view('destacarme_view', array('listProp'=>$data1, 'listPropDisting'=>$data2));
    }

    public function disting(){
        if( $this->uri->segment(3) ){
            $id = $this->uri->segment_array();
            $dist = $id[count($id)];
            array_splice($id, 0, 2);
            array_splice($id, -1);

            if( $this->prop_model->disting($id, $dist) ){
                redirect('/destacarme/');
            }
        }
    }

}

?>