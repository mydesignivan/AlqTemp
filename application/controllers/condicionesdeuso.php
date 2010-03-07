<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Condicionesdeuso extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('form');
        $this->load->model('lists_model');
    }

    public function index(){
        $comboCountry = $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses"));
        $comboStates = $this->lists_model->get_states_search(array("0"=>"Estados / Provincias"));
        $comboCity = $this->lists_model->get_city_search(array("0"=>"Ciudades"));
        $comboCategory = $this->lists_model->get_category(array("0"=>"Categor&iacute;as"));

        $data = array(
            'comboCountry'    =>  $comboCountry,
            'comboCategory'   =>  $comboCategory,
            'comboStates'     =>  $comboStates,
            'comboCity'       =>  $comboCity
        );
        $this->load->view('front_condiciones_view', $data);
    }

}

?>