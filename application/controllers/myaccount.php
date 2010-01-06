<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Myaccount extends Controller{
    function __construct(){
        parent::Controller();
        $this->load->model('users');
    }

    public function index(){
        $query = $this->users->get_user($this->session->userdata('id'));
        if( $query->num_rows>0 ){
            $data = $query->row_array();
            
            $this->load->view("mi_cuenta", array('dataUser'=>$data));
        }else {
            show_error(ERR_100);
        }
    }
}

?>
