<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Informacion extends Controller{
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');
        $this->load->model('info_model');
    }

    public function index(){
        $info = array();
        $info['user'] = $this->info_model->getinfo_user();
        $info['prop'] = $this->info_model->getinfo_prop();

        $this->load->view("paneladmin_info_view", array('info'=>$info));
    }


}
?>