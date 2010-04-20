<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');

        $this->load->model('banner_model');
        $this->load->library('pagination');
        $this->load->library('dataview');
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
    public function form(){
        $banner_id = $this->uri->segment(4);

        if( !is_numeric($banner_id) ){
            $info = false;
            $title = "Nuevo Banner";
        }else{
            $info = $this->banner_model->get_banner($banner_id);
            $title = "Modificar Banner";
        }

        $this->_data = $this->dataview->set_data(array(
            'tlp_section'       =>  'paneladmin/banner_form_view.php',
            'tlp_title_section' =>  $title,
            'tlp_script'        =>  array('validator', 'popup', 'banner_form'),
            'info'              =>  $info
        ));

        $this->load->view("template_paneladmin_view", $this->_data);

    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $data = $this->_request_fields();
            $status = $this->banner_model->create($data);

            if( $status ){
                redirect('/paneladmin/banner/');
            }else{
                show_error(ERR_BANNER_CREATE);
            }
        }
    }

    public function edit(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $data = $this->_request_fields();
            $status = $this->banner_model->edit($data, $_POST['banner_id']);

            if( $status ){
                redirect('/paneladmin/banner/');
            }else{
                show_error(ERR_BANNER_EDIT);
            }
        }
    }

    public function delete(){
        if( $this->uri->segment(4) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,3);

            if( $this->banner_model->delete($id) ){
                redirect('/paneladmin/banner/');
            }else{
                show_error(ERR_BANNER_DELETE);
            }
        }
    }


    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_check(){
        if( $this->banner_model->exists($_POST['name'], $_POST['id']) ){
            die("exists");
        }else{
            die("notexists");
        }
    }

    public function ajax_change_visible(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $this->banner_model->change_visible() ) die("ok");
        }
    }

    public function ajax_change_order(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $this->banner_model->change_order() ) die("ok");
        }
    }

    public function ajax_view_banner(){
        if( $this->uri->segment(4) ){
            $result = $this->banner_model->get_banner($this->uri->segment(4));
            $this->load->view("paneladmin/banner_preview_view", array('code'=>$result['code']));
        }
    }





    /* PRIVATE FUNCTIONS
     **************************************************************************/
    private function _display(){
        $uri = $this->uri->uri_to_assoc(4);

        $offset = !isset($uri['page']) ? 0 : $uri['page'];
        $listBanner = $this->banner_model->get_list($this->_count_per_page, $offset, $uri);

        if( $this->uri->segment(3)=='' || $this->uri->segment(3)=="index" ) $base_url = site_url('/paneladmin/banner/index/page/');
        else $base_url = site_url('/paneladmin/banner/search/'.key($uri).'/'.current($uri).'/page/');

        $config['base_url'] = $base_url;
        $config['total_rows'] = $listBanner['count_rows'];
        $config['per_page'] = $this->_count_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);

        $this->_data = $this->dataview->set_data(array(
            'tlp_section'       =>  'paneladmin/banner_list_view.php',
            'tlp_title_section' =>  'Banners',
            'tlp_script'        =>  array('popup', 'banner_list'),
            'listBanner'        =>  $listBanner['result']
        ));

        $this->load->view("template_paneladmin_view", $this->_data);
    }

    private function _request_fields(){
        return array(
            'name'      => $_POST["txtName"],
            'position'  => $_POST["cboPosition"],
            'visible'   => $_POST["optVisible"],
            'code'      => $_POST["txtCode"]
        );
    }

}
?>