<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Activacion extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
        $this->load->model('search_model');
        $this->load->model('users_model');
    }

    public function index(){
        if( $this->uri->segment(3) ){

            if( !$this->users_model->activate($this->uri->segment(3)) ){
                redirect('/');
            }
            
            $this->load->view('activacion_view');
        }        
    }

}

?>