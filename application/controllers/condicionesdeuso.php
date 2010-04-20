<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Condicionesdeuso extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->helper('form');
        $this->load->model('lists_model');

        $this->load->library('dataview', array(
            'tlp_section'       =>  'frontpage/condiciones_view.php',
            'tlp_title'         =>  TITLE_CONDICIONES,
            'tlp_title_section' =>  "Condiciones de Uso",
            'comboCountry'    =>  $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses")),
            'comboCategory'   =>  $this->lists_model->get_category(array("0"=>"Categor&iacute;as")),
            'comboStates'     =>  $this->lists_model->get_states_search(array("0"=>"Estados / Provincias")),
            'comboCity'       =>  $this->lists_model->get_city_search(array("0"=>"Ciudades"))
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->load->view('template_frontpage_view', $this->_data);
    }

}

?>