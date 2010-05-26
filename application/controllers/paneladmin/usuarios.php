<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==0 ) redirect('/index/');

        $this->load->model('users_model');
        $this->load->library('pagination');
        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneladmin/users_list_view.php',
            'tlp_title_section' =>  'Usuarios',
            'tlp_script'        =>  array('popup', 'users')
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

    public function delete(){
        if( $this->uri->segment(4) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,3);
            
            if( $this->users_model->delete($id) ){
                redirect('/paneladmin/usuarios/');
            }else{
                show_error(ERR_USER_DELETE);
            }
        }
    }


    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_change_statu(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $this->users_model->change_statu() ) die("ok");
        }
    }
    public function ajax_popup_userdetail(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $this->load->library('encpss');
            $info = $this->users_model->get_user(array('user_id'=>$_POST['user_id']));
            $info['password'] = $this->encpss->decode($info['password']);

            $this->load->view("paneladmin/popup/users_detalle_view", array('info'=>$info));
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
        
        // Devuelve el listado de usuarios
        $listUsers = $this->users_model->get_list_users($this->_count_per_page, $offset, $arr_url);

        $config['base_url'] = $this->orderby->get_baseurl();
        $config['total_rows'] = $listUsers['count_rows'];
        $config['per_page'] = $this->_count_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);

        $this->_data = $this->dataview->set_data(array(
            'listUsers'    =>  $listUsers['result'],
            'orderby'      => array(
                'username'      => array('url'=>$this->orderby->get_url_orderby("username"), 'order'=>$this->orderby->get_order('username')),
                'online'        => array('url'=>$this->orderby->get_url_orderby("online"), 'order'=>$this->orderby->get_order('online')),
                'status'        => array('url'=>$this->orderby->get_url_orderby("active"), 'order'=>$this->orderby->get_order('active')),
                'date_added'    => array('url'=>$this->orderby->get_url_orderby("date_added"), 'order'=>$this->orderby->get_order('date_added')),
                'last_modified' => array('url'=>$this->orderby->get_url_orderby("last_modified"), 'order'=>$this->orderby->get_order('last_modified'))
            )
        ));

        $this->load->view("template_paneladmin_view", $this->_data);
    }

}
?>