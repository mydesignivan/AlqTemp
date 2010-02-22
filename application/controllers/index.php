<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Controller {

    private $count_per_page;

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
        $this->load->helper('text');
        $this->load->model('search_model');
        $this->load->library('pagination');
        $this->count_per_page=3;
    }

    public function index(){
        $this->display();
    }

    public function display(){
        $offset = $this->uri->segment(3);
        if( !is_numeric($offset) ) $offset=0;

        //$data = $this->search_model->list_disting($this->count_per_page, $offset);
        $data = $this->search_model->last_properties($this->count_per_page);

        $config['base_url'] = site_url('/index/display/');
        $config['total_rows'] = $data['count_rows'];
        $config['per_page'] = $this->count_per_page;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['next_link'] = 'Siguiente';
        $config['prev_link'] = 'Atrás';
        $this->pagination->initialize($config);

        $result_searches = $this->search_model->get_searches();

        $this->load->view('index_view', array('listProp'=>$data['result'], 'section_title'=>'Alquileres Destacados', "listSearches"=>$result_searches));
    }

}

?>