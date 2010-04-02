<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Controller{

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');
        $this->load->model('info_model');

        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneladmin/index_view.php',
            'tlp_title_section' =>  "Informaci&oacute;n"
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->_data = $this->dataview->set_data(array(
            "info"  =>  array(
                'user'  =>   $this->info_model->getinfo_user(),
                'prop'  =>   $this->info_model->getinfo_prop()
             )
        ));
        $this->load->view("template_paneladmin_view", $this->_data);
    }

}
?>