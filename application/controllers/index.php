<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->model('search_model');
        $this->load->model('lists_model');
        $this->load->library('pagination');

        $this->load->library('dataview', array(
            'tlp_section'          =>  'frontpage/index_view.php',
            'tlp_title'            =>  setup('TITLE_INDEX'),
            'tlp_form_hitssearch'  =>  true,
            'tlp_meta_description' => setup('META_DESCRIPTION_INDEX'),
            'tlp_meta_keywords'    => setup('META_KEYWORDS_INDEX'),
            'comboCountry'    =>  $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses")),
            'comboCategory'   =>  $this->lists_model->get_category_search(array("0"=>"Categor&iacute;as")),
            'comboStates'     =>  $this->lists_model->get_states_search(array("0"=>"Estados / Provincias")),
            'comboCity'       =>  $this->lists_model->get_city_search(array("0"=>"Ciudades"))
        ));
        $this->_data = $this->dataview->get_data();

        $this->_count_per_page=10;
        $uri = $this->uri->uri_to_assoc(2);
        $this->_offset = !isset($uri['page']) ? 0 : $uri['page'];
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;
    private $_count_per_page;
    private $_offset;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->display();
    }

    public function display($param=null){
        $uri = strtolower($this->uri->segment(1));
        if( empty($uri) || $uri=="display" || $uri=="index" ){
            $param = array(
                'base_url'         => str_replace('.html', '', site_url('/display/page/')),
                'title'            => setup('TITLE_INDEX'),
                'title_section'   => 'Alquileres Destacados',
                //'title_section'    => 'Ultimos Alquileres',
                'searcher'         =>  false,
                'listProp'         => $this->search_model->last_properties($this->_count_per_page, $this->_offset),
                'disting_type'     => 'index',
                'disting_type_val' => null
            );
        }

        $listSearches = $this->search_model->get_searches();

        $config['base_url'] = $param['base_url'];
        $config['total_rows'] = $param['listProp']['count_rows'];
        $config['per_page'] = $this->_count_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);

        $this->_data = $this->dataview->set_data(array(
            'listProp'           =>  $param['listProp']['result'],
            //'listPropDisting'    =>  $this->search_model->list_disting($param['disting_type'], $param['disting_type_val']),
            'listSearches'       =>  $listSearches,
            'tlp_title_section'  =>  $param['title_section'],
            'tlp_title'          =>  $param['title'],
            'searcher'           =>  $param['searcher']
        ));


        $this->load->view('template_frontpage_view', $this->_data);
    }

    public function searcher(){
        $searcher = $this->uri->uri_to_assoc(2, array('search', 'country', 'state', 'city', 'category', 'page'));
        
        if( !empty($searcher['page']) ){
            $seg = "searcher/";
            foreach( $searcher as $key=>$val ){
                if( $key!='page' && !empty($val) ){
                    $seg.=$key."/".$val."/";
                }
            }
            $seg.="page/";
        }else{
            $seg = $this->uri->uri_string();
        }

        $base_url = str_replace(".html", "", site_url($seg));
        $listProp = $this->search_model->search($this->_count_per_page, $this->_offset, $searcher);

        $this->display(array(
            'base_url'         => $base_url,
            'title'            => setup('TITLE_INDEX'),
            'title_section'    => 'Resultado de B&uacute;queda',
            'listProp'         => $listProp,
            'searcher'         => $searcher,
            'disting_type'     => 'index',
            'disting_type_val' => isset($searcher['city']) ? $searcher['city'] : null
        ));
    }

    public function casas(){
        $listProp = $this->search_model->search($this->_count_per_page, $this->_offset, array('category'=>1));
        $this->display(array(
            'base_url'          => str_replace(".html", "", site_url('/casas/page/')),
            'title'             => ' - Casas',
            'title_section'     => 'Casas',
            'listProp'          => $listProp,
            'searcher'          => false,
            'disting_type'      => 'category',
            'disting_type_val'  => 1
        ));
    }
    public function departamentos(){
        $listProp = $this->search_model->search($this->_count_per_page, $this->_offset, array('category'=>3));
        $this->display(array(
            'base_url'          => str_replace(".html", "", site_url('/departamentos/page/')),
            'title'             => ' - Departamentos',
            'title_section'     => 'Departamentos',
            'listProp'          => $listProp,
            'searcher'          => false,
            'disting_type'      => 'category',
            'disting_type_val'  => 3
        ));
    }
    public function cabanias(){
        $listProp = $this->search_model->search($this->_count_per_page, $this->_offset, array('category'=>2));
        $this->display(array(
            'base_url'          => str_replace(".html", "", site_url('/cabanias/page/')),
            'title'             => ' - Caba&ntilde;as',
            'title_section'     => 'Caba&ntilde;as',
            'listProp'          => $listProp,
            'searcher'          => false,
            'disting_type'      => 'category',
            'disting_type_val'  => 2
        ));
    }
    public function otros(){
        $listProp = $this->search_model->search($this->_count_per_page, $this->_offset, array('category'=>4));
        $this->display(array(
            'base_url'          => str_replace(".html", "", site_url('/otros/page/')),
            'title'             => ' - Otros',
            'title_section'     => 'Otros',
            'listProp'          => $listProp,
            'searcher'          => false,
            'disting_type'      => 'category',
            'disting_type_val'  => 4
        ));
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_show_combo(){
        $code = $this->uri->segment(3);
        $name = $this->uri->segment(4);
        $notsearch = $this->uri->segment(5);

        $state = array();
        $city = array();
        $category = array();
        $country_id=0;

        switch( $name ){
            case 'country':
                $whereState = array(TBL_STATES.'.country_id' => $code);
                $whereCity = array(TBL_PROPERTIES.'.country_id' => $code);
                $whereCategory = array(TBL_PROPERTIES.'.country_id' => $code);
            break;
            case 'state':
                $whereCity = array(TBL_PROPERTIES.'.state_id' => $code);
                $whereCategory = array(TBL_PROPERTIES.'.state_id' => $code);
                $res = $this->lists_model->get_data_country($code);
                $country_id = $res['country_id'];
            break;
            case 'city':
                if( $notsearch!='state' ) $whereState = array(TBL_PROPERTIES.'.city' => $code);
                if( $notsearch!='category' ) $whereCategory = array(TBL_PROPERTIES.'.city' => $code);
            break;
            case 'category':
                if( $notsearch!='state' ) $whereState = array(TBL_PROPERTIES.'.category_id' => $code);
                if( $notsearch!='city' ) $whereCity = array(TBL_PROPERTIES.'.category_id' => $code);
            break;
        }

        if( $notsearch!='state' && ($name=='country' || $name=='city' || $name=='category') ) {
            $state = $this->lists_model->get_states_search(array("0"=>"Estados / Provincias"), $whereState);
        }
        if( $notsearch!='city' && ($name=='country' || $name=='state' || $name=='category') ) {
            $city = $this->lists_model->get_city_search(array("0"=>"Ciudades"), $whereCity);
        }
        if( $notsearch!='category' && ($name=='country' || $name=='state' || $name=='city') ) {
            $category = $this->lists_model->get_category_search(array("0"=>"Categor&iacute;as"), $whereCategory);
        }

        echo json_encode(array(
            'state'      => $state,
            'city'       => $city,
            'category'   => $category,
            'country_id' => $country_id
        ));

        die();
    }

}

?>