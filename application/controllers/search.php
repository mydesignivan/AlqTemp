<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Search extends Controller {

    private $count_per_page;

    function __construct(){
        parent::Controller();
        $this->load->helper('combobox');
        $this->load->helper('text');
        $this->load->model('search_model');
        $this->load->library('pagination');
        $this->count_per_page=3;
    }

    public function index($dataURL=array()){
        if( count($dataURL)>0 ){
            switch($dataURL['category']){
                case 1: $title = "Casas"; break;
                case 2: $title = "Departamentos"; break;
                case 3: $title = "Caba&ntilde;as"; break;
                case 4: $title = "Otros"; break;
            }
        }else{
            $dataURL = $this->uri->uri_to_assoc(3);
            $title = "Resultado de B&uacute;queda";
        }


        $data = $this->search_model->search($dataURL, $this->count_per_page, $dataURL['page']);

        $url = $this->uri->uri_string();
        $url = substr($url, 0, strrpos($url, "/"));
        $url = site_url($url);

        $config['base_url'] = $url;
        $config['total_rows'] = $data['count_rows'];
        $config['per_page'] = $this->count_per_page;
        $config['uri_segment'] = 14;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['next_link'] = 'Siguiente';
        $config['prev_link'] = 'Atrás';
        $this->pagination->initialize($config);

        $result_searches = $this->search_model->get_searches();

        $this->load->view('index_view', array("listProp"=>$data['result'], "section_title"=>$title, "listSearches"=>$result_searches));
    }

    public function casas(){
        $this->index(array('category'=>1, 'page'=>0));
    }
    public function departamentos(){
        $this->index(array('category'=>2, 'page'=>0));
    }
    public function cabanias(){
        $this->index(array('category'=>3, 'page'=>0));
    }
    public function otros(){
        $this->index(array('category'=>4, 'page'=>0));
    }

}

?>