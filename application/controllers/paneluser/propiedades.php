<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Propiedades extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();

        $this->load->model('prop_model');
        $this->load->model('cuentaplus_model');
        $this->load->model('lists_model');
        $this->load->helper('form');

        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneluser/prop_list_view.php',
            'tlp_title'         =>  setup('TITLE_PROPIEDADES')
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
        $this->load->library('pagination');

        $listProp = $this->prop_model->get_list_prop($this->_count_per_page, $this->_offset);

        $config['base_url'] = site_url('/paneluser/propiedades/page/');
        $config['total_rows'] = $listProp['count_rows'];
        $config['per_page'] = $this->_count_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);

        $this->_data = $this->dataview->set_data(array(
            'tlp_title_section' =>  "Propiedades",
            'tlp_script'        =>  'prop_list',
            'listProp'          =>  $listProp['result']
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function form(){
        if( !$this->uri->segment(4) ){ //Si es nueva propiedad
            //$check = $this->_check_total_propfree();

            $info   = false;
            /*if( $this->session->userdata('username')=='basaezj' ){
                $action = "show";
            }else{
                if( $check['result'] ){
                    $action = 'show';
                }else{
                    $action = $check['error'];
                }
            }*/

            $action = 'show';
        }else{
            $action = 'show';
            $info   = $this->prop_model->get_prop($this->uri->segment(4));
        }

        if( !$this->uri->segment(4) ){
            $comboStates = array('0'=>'Seleccione un Pa&iacute;s');
        }else{
            $comboStates = $this->lists_model->get_states($info['country_id'], array("0"=>"Seleccione una Provincia"));
        }
        
        //$check_cp = $this->cuentaplus_model->check();
        $check_cp['result'] = true;

        $tlp_script = array('validator', 'fancybox', 'popup', 'json', 'formatnumber', 'prop_form');
        if( $check_cp['result'] ) $tlp_script = array_merge($tlp_script, array('googlemap'));
        

        $this->_data = $this->dataview->set_data(array(
            'tlp_section'       =>  'paneluser/prop_form_view.php',
            'tlp_title_section' =>  (!$info) ? "Nueva Propiedad" : "Modificar Propiedad",
            'tlp_script'        =>  $tlp_script,
            'comboCategory'     =>  $this->lists_model->get_category(array("0"=>"Seleccione una Categor&iacute;a")),
            'comboCountry'      =>  $this->lists_model->get_country(array("0"=>"Seleccione un Pa&iacute;s")),
            'comboStates'       =>  $comboStates,
            'listServices'      =>  $this->lists_model->get_services(),
            'action'            =>  $action,
            'info'              =>  $info,
            'cuenta_plus'       =>  $check_cp['result']
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = $this->_request_fields();
            $data['date_added'] = date('Y-m-d H:i:s');

            $status = $this->prop_model->create($data);

            if( $status ){
                redirect('/paneluser/propiedades/');
            }else{
                show_error(ERR_PROP_CREATE);
            }

        }
    }

    public function edit(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = $this->_request_fields();

            //print_array($data['extra_post'], true);

            $data['last_modified'] = date('Y-m-d H:i:s');

            $status = $this->prop_model->edit($data, $this->uri->segment(4));
            if( $status=="ok" ){
                redirect('/paneluser/propiedades/');
            }else{
                show_error(ERR_PROP_EDIT);
            }

        }
    }

    public function delete(){
        if( $this->uri->segment(4) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,3);
            
            if( $this->prop_model->delete($id) ){
                redirect('/paneluser/propiedades/');
            }else{
                show_error(ERR_PROP_DELETE);
            }
        }
    }

    public function cancel(){
        delete_images_temp();
        redirect('/paneluser/propiedades/');
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_check(){
        if( $this->prop_model->exists($_POST['reference'], $_POST['propid']) ){
            die("exists");
        }else{
            die("notexists");
        }
    }

    public function ajax_check_total_images(){
        if( is_numeric($this->uri->segment(4)) ){
            $check_cp = $this->cuentaplus_model->check();
            $total_images = $this->uri->segment(4);

            if( $check_cp['result'] ){ //Hay cuenta plus
                if( $total_images >= setup('CFG_CUENTAPLUS_TOTAL_IMAGES') ) {
                    die('limitexceeded');
                }
            }else{
                if( $total_images >= setup('CFG_FREE_TOTAL_IMAGES') ) {
                    die('accesdenied');
                }
            }
            die("ok");
        }
    }

    public function ajax_show_states(){
        $listStates = $this->lists_model->get_states($this->uri->segment(4));
        echo '<option value="0">Seleccione una Provincia</option>';
        foreach( $listStates as $row ){
            echo '<option value="'.$row['state_id'].'">'.$row['name'].'</option>\n';
        }
        die();
    }


    /* PRIVATE FUNCTIONS
     **************************************************************************/
    private function _request_fields(){
        $return = array(
            'user_id'         => $this->session->userdata('user_id'),
            'reference'       => $_POST["txtReference"],
            'address'         => $_POST["txtAddress"],
            'category_id'     => $_POST["cboCategory"],
            'description'     => $_POST["txtDesc"],
            'country_id'      => $_POST["cboCountry"],
            'state_id'        => $_POST["cboStates"],
            'city'            => $_POST["txtCity"],
            'phone'           => $_POST["txtPhone"],
            'phone_area'      => $_POST["txtPhoneArea"],
            'website'         => (strtolower($_POST["txtWebsite"])!="http://") ? $_POST["txtWebsite"] : "",
            'price'           => $_POST["txtPrice"],
            'priceby'         => $_POST["cboPriceBy"],
            'pricemoney'      => $_POST["cboMoneySymbol"],
            'gmap_visible'    => isset($_POST["optGmap"]) ? $_POST["optGmap"] : 0,
            'capacity'        => $_POST["cboCapacity"],
            'extra_post'      => json_decode($_POST['extra_post'])
        );
        
        if( isset($_POST["optMovie"]) ) {
            $url = $_POST['txtUrlMovie'];
            if( $_POST['optMovie']==0 ) $url="";

            $return['movie_visible'] = $_POST['optMovie'];
            $return['movie_url']  = $url;
        }

        return $return;
    }

    /*private function _check_total_propfree(){
        $check_cp = $this->cuentaplus_model->check();
        $total_prop = $this->prop_model->get_total_prop();

        if( $check_cp['result'] ){ //Hay cuenta plus
            if( $total_prop >= setup('CFG_CUENTAPLUS_TOTAL_PROP') ) {
                return array(
                    'result'=>false,
                    'error'=>'limitexceeded'
                );
            }
        }else{
            if( $total_prop >= setup('CFG_FREE_TOTAL_PROP') ) {
                return array(
                    'result'=>false,
                    'error'=>'accesdenied'
                );
            }
        }
        return array('result'=>true);
    }*/

}

?>