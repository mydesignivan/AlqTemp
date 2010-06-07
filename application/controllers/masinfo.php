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
            $check_cp = $this->cuentaplus_model->check($info['user_id']);
            //$check_cp['result'] = true;

            $tlp_script = array('validator', 'fancybox', 'popup', 'moreinfo');
            if( $info['gmap_visible']==1 ) $tlp_script = array_merge($tlp_script, array('googlemap'));

            $this->_data = $this->dataview->set_data(array(
                'tlp_script'      =>  $tlp_script,
                "info"            =>  $info,
                'cuentaplus'      =>  $check_cp['result'],
                'listSimSearches' =>  $this->search_model->prop_similares($prop_id),
                'gmap_apikey'     =>  is_localhost() ? 'ABQIAAAA6jDZq_43l3KJx0o7hAmjcxSn3a9KdZC-g3pRNBAj-9Whm4ZFhhSyGJZ-okGC5PKIJIGxiD_EzN8xRQ' : 'ABQIAAAA7nM4SLXcwUrC-K6tMmT7ZBQ90brwZ5G-NYVuq3eJE07GrHhKUxQWvCc8DfgiMECygttmW5L_OY4a9A'
            ));
            $this->load->view('template_frontpage_view', $this->_data);
        }else redirect($this->config->item('base_url'));
    }

    public function gmap(){
        $arr_seg = $this->uri->uri_to_assoc(3);
        $data = array(
            'gmap'         => $arr_seg,
            'gmap_apikey'  => is_localhost() ? 'ABQIAAAA6jDZq_43l3KJx0o7hAmjcxSn3a9KdZC-g3pRNBAj-9Whm4ZFhhSyGJZ-okGC5PKIJIGxiD_EzN8xRQ' : 'ABQIAAAA7nM4SLXcwUrC-K6tMmT7ZBTwHqY6DGHnlcUpqG5ujKR4ILoX9xRlDi8p9NLkzcgra5N9wNqdCa0njQ'
        );
        $this->load->view('frontpage/popup/gmapzoom_view', $data);
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_sendconsult(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $this->load->model('users_model');
            $this->load->library('email');

            $message = EmailMessageConstructor(array(
                'propname' => $_POST['reference'],
                'name'     => $_POST['txtName'],
                'phone'    => ($_POST['txtPhone']=="Número de Contacto") ? "" : $_POST['txtPhone'],
                'llegada'  => $_POST['txtResLlegada'],
                'salida'   => $_POST['txtResSalida'],
                'adultos'  => $_POST['cboResAdultos'],
                'ninios'   => $_POST['cboResNinios'],
                'consult'  => nl2br($_POST['txtConsult'])
                
            ), unserialize(EMAIL_CONSULTPROP_MESSAGE));

            $data = $this->users_model->get_user(array('user_id'=>$_POST['user_id']));

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