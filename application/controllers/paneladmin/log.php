<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Log extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');
        $this->load->model('lists_model');
        $this->load->model('log_model');
        $this->load->helper('form');
        $this->load->library('pagination');

        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneladmin/log_view.php',
            'tlp_title_section' =>  'Listado de Errores',
            'tlp_script'        =>  'log'
        ));
        $this->_data = $this->dataview->get_data();

        $this->_count_per_page=10;
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;
    private $_count_per_page;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->display();
    }

    public function display(){
        $total_segment = $this->uri->total_segments();
        $lastseg = $this->uri->segment($total_segment);
        $date = !is_date($lastseg) ? date('Y-m-d') : $lastseg;
        if( is_numeric($lastseg) ){
            $offset = $lastseg;
            $uri_segment = $total_segment;
        }else{
            $offset = 0;
            $uri_segment = $total_segment+1;
        }

        $listDate = $this->lists_model->logs_dates();
        //$listDate = array();
        $result = $this->log_model->get_list($date, $offset, $this->_count_per_page);
        $listLog = $result['result'];

        $config['base_url'] = site_url('/paneladmin/log/display/'.$date);
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $this->_count_per_page;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);

        $this->_data = $this->dataview->set_data(array(
            'listDate'  =>  $listDate,
            'listLog'   =>  $listLog
        ));
        $this->load->view("template_paneladmin_view", $this->_data);
    }

    public function delete(){
        if( $this->uri->segment(4) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,4);

            if( $this->log_model->delete($this->uri->segment(4), $id) ){
                redirect('/paneladmin/log/');
            }else{
                show_error(ERR_LOG_DELETE);
            }
        }
    }
    public function delete_date(){
        $segment = $this->uri->segment(4);
        if( $segment ){
            if( $this->log_model->delete_date($segment) ){
                redirect('/paneladmin/log/');
            }else{
                show_error(sprintf(ERR_LOG_DELETE_LOG, $segment));
            }

        }
    }

}
?>