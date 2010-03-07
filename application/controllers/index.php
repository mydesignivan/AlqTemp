<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Controller {

    private $count_per_page;
    private $offset;

    function __construct(){
        parent::Controller();
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->model('search_model');
        $this->load->model('lists_model');
        $this->load->library('pagination');
        $this->count_per_page=3;
        $this->offset = !is_numeric($this->uri->segment(3)) ? 0 : $this->uri->segment(3);
    }

    public function index(){
        $this->display();
    }

    public function display($param=null){
        if( $param==null ){
            $param = array(
                'base_url'    => '/index/display/',
                'title'       => 'Alquileres Destacados',
                'listProp'    => $this->search_model->last_properties($this->count_per_page)
                //'listProp'    => $this->search_model->list_disting($this->count_per_page, $this->offset)
            );
        }

        $listSearches = $this->search_model->get_searches();

        $comboCountry = $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses"));
        $comboStates = $this->lists_model->get_states_search(array("0"=>"Estados / Provincias"));
        $comboCity = $this->lists_model->get_city_search(array("0"=>"Ciudades"));
        $comboCategory = $this->lists_model->get_category(array("0"=>"Categor&iacute;as"));

        $config['base_url'] = site_url($param['base_url']);
        $config['total_rows'] = $param['listProp']['count_rows'];
        $config['per_page'] = $this->count_per_page;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);

        $data = array(
            'listProp'        =>  $param['listProp']['result'],
            'listSearches'    =>  $listSearches,
            'comboCountry'    =>  $comboCountry,
            'comboCategory'   =>  $comboCategory,
            'comboStates'     =>  $comboStates,
            'comboCity'       =>  $comboCity,
            'section_title'   =>  $param['title']
        );
        $this->load->view('front_index_view', $data);
    }

    // Muestra los resultados de la busqueda
    public function result(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $listProp = $this->search_model->search($this->count_per_page, $this->offset);
            $this->display(array(
                'base_url'    => '/index/result/',
                'title'       => 'Resultado de B&uacute;queda',
                'listProp'    => $listProp
            ));
        }else redirect('/index/');
    }

    public function casas(){
        $listProp = $this->search_model->search($this->count_per_page, $this->offset, "1");
        $this->display(array(
            'base_url'    => '/index/casas/',
            'title'       => 'Casas',
            'listProp'    => $listProp
        ));
    }
    public function departamentos(){
        $listProp = $this->search_model->search($this->count_per_page, $this->offset, "3");
        $this->display(array(
            'base_url'    => '/index/departamentos/',
            'title'       => 'Departamentos',
            'listProp'    => $listProp
        ));
    }
    public function cabanias(){
        $listProp = $this->search_model->search($this->count_per_page, $this->offset, "2");
        $this->display(array(
            'base_url'    => '/index/cabanias/',
            'title'       => 'Caba&ntilde;as',
            'listProp'    => $listProp
        ));
    }
    public function otros(){
        $listProp = $this->search_model->search($this->count_per_page, $this->offset, "4");
        $this->display(array(
            'base_url'    => '/index/otros/',
            'title'       => 'Otros',
            'listProp'    => $listProp
        ));
    }

}

?>