<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Checkout_success extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');

        $this->load->helper('form');
        $this->load->model('lists_model');
        $this->load->model('orders_model');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'frontpage/checkout_succes_view.php',
            'tlp_title'         =>  setup('TITLE_INDEX'),
            'tlp_title_section' =>  "Resultado Compra",
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
        if( !$this->orders_model->check() ) redirect('/index/');
        $this->load->view('template_frontpage_view', $this->_data);
    }

}
?>