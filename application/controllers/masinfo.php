<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Masinfo extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->model('prop_model');
        $this->load->model('lists_model');
        $this->load->model('search_model');
        $this->load->helper('form');
        $this->load->helper('text');

        $this->load->library('dataview', array(
            'tlp_section'              =>  'frontpage/moreinfo_view.php',
            'tlp_title'                =>  setup('TITLE_MASINFO'),
            'tlp_title_section'        =>  "Detalle Propiedad",
            'tlp_meta_description'     =>  setup('META_DESCRIPTION_MASINFO'),
            'tlp_meta_keywords'        =>  setup('META_KEYWORDS_MASINFO'),
            'tlp_form_similarsearcher' => true,
            'comboCountry'      =>  $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses")),
            'comboCategory'     =>  $this->lists_model->get_category(array("0"=>"Categor&iacute;as")),
            'comboStates'       =>  $this->lists_model->get_states_search(array("0"=>"Estados / Provincias")),
            'comboCity'         =>  $this->lists_model->get_city_search(array("0"=>"Ciudades"))
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $prop_id = $this->uri->segment(3);

        if( is_numeric($prop_id) ){
            $info = $this->prop_model->get_prop($prop_id);
            if( !$info ) redirect($this->config->item('base_url'));

            $this->load->model('cuentaplus_model');
            //$check_cp = $this->cuentaplus_model->check($info['user_id']);
            $check_cp['result'] = true;

            $tlp_script = array('validator', 'fancybox', 'popup', 'moreinfo');
            if( $check_cp['result'] ) $tlp_script = array_merge($tlp_script, array('googlemap'));            

            $this->_data = $this->dataview->set_data(array(
                'tlp_script'      =>  $tlp_script,
                "info"            =>  $info,
                'cuentaplus'      =>  $check_cp['result'],
                'listSimSearches' =>  $this->search_model->prop_similares($prop_id)
            ));
            $this->load->view('template_frontpage_view', $this->_data);
        }else redirect($this->config->item('base_url'));
    }

    public function gmap(){
        $this->load->view('includes/gmapzoom_view');
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_sendconsult(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $this->load->library('email');

            $message = EmailMessageConstructor(array(
                'propname' => $_POST['address'],
                'name'     => $_POST['txtName'],
                'phone'    => ($_POST['txtPhone']=="Número de Contacto") ? "" : $_POST['txtPhone'],
                'llegada'  => $_POST['txtResLlegada'],
                'salida'   => $_POST['txtResSalida'],
                'adultos'  => $_POST['cboResAdultos'],
                'ninios'   => $_POST['cboResNinios'],
                'consult'  => nl2br($_POST['txtConsult'])
                
            ), unserialize(EMAIL_CONSULTPROP_MESSAGE));

            $this->email->from($_POST['txtEmail'], $_POST['txtName']);
            $this->email->to($data['email']);
            $this->email->subject(EMAIL_CONSULTPROP_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                die("ok");
            }else {
                die("error");
            }

        }
    }


    /* PRIVATE FUNCTIONS
     **************************************************************************/
}

?>