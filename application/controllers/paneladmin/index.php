<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Controller{

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');
        $this->load->model('info_model');

        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneladmin/info_view.php',
            'tlp_title_section' =>  "Informaci&oacute;n",
            'tlp_script'        =>  array('popup', 'info')
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->_data = $this->dataview->set_data(array(
            "info"  =>  array(
                'user'   =>   $this->info_model->getinfo_user(),
                'prop'   =>   $this->info_model->getinfo_prop(),
                'otros'  =>   $this->info_model->getinfo_otros()
             )
        ));
        $this->load->view("template_paneladmin_view", $this->_data);
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_popup_users(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $data = array(
                'listUsers' => $this->info_model->get_list_users()
            );
            $this->load->view("paneladmin/popup/users_baja_view", $data);
        }
    }

    public function ajax_info_user(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            echo json_encode($this->info_model->get_user($_POST['id']));
        }
    }

}
?>