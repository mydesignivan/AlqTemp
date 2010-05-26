<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Propiedades extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');

        $this->load->model('prop_model');
        $this->load->library('pagination');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneladmin/prop_list_view.php',
            'tlp_title_section' =>  'Propiedades',
            'tlp_script'        =>  'prop_list'
        ));
        $this->_data = $this->dataview->get_data();
        $this->_count_per_page=14;
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;
    private $_count_per_page;


    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->_display();
    }

    public function search(){
        $this->_display($this->uri->uri_to_assoc(4));
    }

    public function delete(){
        if( $this->uri->segment(4) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,3);

            if( $this->prop_model->delete($id) ){
                redirect('/paneladmin/propiedades/');
            }else{
                show_error(ERR_PROP_DELETE);
            }
        }
    }

    /* PRIVATE FUNCTIONS
     **************************************************************************/
    private function _display(){
        // Esto es para el Order by
        $arr_url = $this->uri->uri_to_assoc(2);
        $this->load->library('orderby', array(
            'controller'      => 'paneladmin',
            'icon_order_asc'  => 'icon_arrow_down.png',
            'icon_order_desc' => 'icon_arrow_up.png',
            'arr_url'         => $arr_url
        ));

        // Esto es para el paginador
        $offset = !isset($arr_url['page']) || !is_numeric($arr_url['page']) ? 0 : $arr_url['page'];

        // Devuelve el listado de propiedades
        $listProp = $this->prop_model->get_list2_prop($this->_count_per_page, $offset, $arr_url);

        $config['base_url'] = $this->orderby->get_baseurl();
        $config['total_rows'] = $listProp['count_rows'];
        $config['per_page'] = $this->_count_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);

        $this->_data = $this->dataview->set_data(array(
            'listProp'  =>  $listProp['result'],
            'orderby'   => array(
                'address'       => array('url'=>$this->orderby->get_url_orderby("address"), 'order'=>$this->orderby->get_order('address')),
                'username'      => array('url'=>$this->orderby->get_url_orderby("username"), 'order'=>$this->orderby->get_order('username')),
                'date_added'    => array('url'=>$this->orderby->get_url_orderby("date_added"), 'order'=>$this->orderby->get_order('date_added')),
                'last_modified' => array('url'=>$this->orderby->get_url_orderby("last_modified"), 'order'=>$this->orderby->get_order('last_modified'))
            )
        ));
        $this->load->view("template_paneladmin_view", $this->_data);
    }


}
?>