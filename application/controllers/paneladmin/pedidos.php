<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pedidos extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');

        $this->load->model('orders_model');
        $this->load->library('pagination');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneladmin/orders_list_view.php',
            'tlp_title_section' =>  'Pedidos',
            'tlp_script'        =>  'orders'
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
        $this->_display();
    }

    public function confirm(){
        if( $this->uri->segment(4) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,3);
            
            if( $this->orders_model->orders_confirm($id) ){
                redirect('/paneladmin/pedidos/');
            }else{
                show_error(ERR_ORDER_CONFIRM);
            }
        }
    }

    /* AJAX FUNCTIONS
     **************************************************************************/


    /* PRIVATE FUNCTIONS
     **************************************************************************/
    private function _display(){
        $uri = $this->uri->uri_to_assoc(4);

        $offset = !isset($uri['page']) ? 0 : $uri['page'];
        $listOrders = $this->orders_model->get_list($this->_count_per_page, $offset, $uri);

        if( $this->uri->segment(3)=='' || $this->uri->segment(3)=="index" ) $base_url = site_url('/paneladmin/pedidos/index/page/');
        else $base_url = site_url('/paneladmin/pedidos/search/'.key($uri).'/'.current($uri).'/page/');

        $config['base_url'] = $base_url;
        $config['total_rows'] = $listOrders['count_rows'];
        $config['per_page'] = $this->_count_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);

        $this->_data = $this->dataview->set_data(array(
            'listOrders'  =>  $listOrders['result']
        ));

        $this->load->view("template_paneladmin_view", $this->_data);
    }

}
?>