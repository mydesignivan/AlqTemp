<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Propiedades extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');

        $this->load->model('prop_model');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        $data = $this->prop_model->get_list2_prop();
        $this->load->view('paneladmin_proplist_view', array('listProp'=>$data));
    }

    public function delete(){
        if( $this->uri->segment(3) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,2);

            if( $this->prop_model->delete($id) ){
                redirect('/paneladmin/propiedades/');
            }else{
                show_error(ERR_PROP_DELETE);
            }
        }
    }


}
?>