<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Propiedades extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();

        $this->load->model('prop_model');
        $this->load->model('cuentaplus_model');
        $this->load->model('lists_model');
        $this->load->helper('form');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        $listProp = $this->prop_model->get_list_prop();
        $this->load->view('paneluser_proplist_view', array('listProp'=>$listProp));
    }

    public function form(){
        if( !$this->uri->segment(4) ){
            $check = $this->check_total_propfree();

            if( $check['result'] ){
                $data = array(
                    'action'=>'show',
                    'data'=>false
                );
            }else{
                $data = array(
                    'action'=>$check['error'],
                    'data'=>false
                );
            }
        }else{
            $data = array(
                'action'=>'show',
                'data'=>$this->prop_model->get_prop($this->uri->segment(4))
            );
        }

        $comboCategory = $this->lists_model->get_category(array("0"=>"Seleccione una Categor&iacute;a"));
        $comboCountry = $this->lists_model->get_country(array("0"=>"Seleccione un Pa&iacute;s"));
        $comboServices = $this->lists_model->get_services();
        if( !$this->uri->segment(4) ){
            $comboStates = array('0'=>'Seleccione un Pa&iacute;s');
        }else{
            $comboStates = $this->lists_model->get_states($data['data']['country_id'], array("0"=>"Seleccione una Provincia"));
        }

        $data['comboCategory'] = $comboCategory;
        $data['comboServices'] = $comboServices;
        $data['comboCountry'] = $comboCountry;
        $data['comboStates'] = $comboStates;

        $this->load->view('paneluser_propform_view', $data);

    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = $this->request_fields();
            $data['images_new'] = $_POST['images_new'];
            $data['date_added'] = date('Y-m-d H:i:s');

            $status = $this->prop_model->create($data);

            if( $status ){
                redirect('/panel/propiedades/');
            }else{
                show_error(ERR_PROP_CREATE);
            }

        }
    }

    public function edit(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = $this->request_fields();
            $data['images_new'] = $_POST['images_new'];
            $data['images_deletes'] = $_POST['images_deletes'];
            $data['images_modified_id'] = $_POST['images_modified_id'];
            $data['images_modified_name'] = $_POST['images_modified_name'];
            $data['last_modified'] = date('Y-m-d H:i:s');

            $status = $this->prop_model->update($data, $this->uri->segment(4));

            if( $status=="ok" ){
                redirect('/panel/propiedades/');
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
                redirect('/panel/propiedades/');
            }else{
                show_error(ERR_PROP_DELETE);
            }
        }
    }

    public function cancel(){
        delete_images_temp();
        redirect('/panel/propiedades/');
    }

    public function ajax_check(){
        if( $this->prop_model->exists($this->uri->segment(4), $this->uri->segment(5)) ){
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
                if( $total_images>=CFG_CUENTAPLUS_TOTAL_IMAGES ) {
                    die('limitexceeded');
                }
            }else{
                if( $total_images>=CFG_FREE_TOTAL_IMAGES ) {
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


    /*
     * FUNCTIONS PRIVATE
     */
    private function request_fields(){
        return array(
            'user_id'         => $this->session->userdata('user_id'),
            'address'         => $_POST["txtAddress"],
            'category_id'     => $_POST["cboCategory"],
            'description'     => $_POST["txtDesc"],
            'country_id'      => $_POST["cboCountry"],
            'state_id'        => $_POST["cboStates"],
            'city'            => $_POST["txtCity"],
            'phone'           => $_POST["txtPhone"],
            'website'         => (strtolower($_POST["txtWebsite"])!="http://") ? $_POST["txtWebsite"] : "",
            'price'           => $_POST["txtPrice"],
            'services'        => $_POST["services"]
        );
    }

    private function check_total_propfree(){
        $check_cp = $this->cuentaplus_model->check();
        $total_prop = $this->prop_model->get_total_prop();

        if( $check_cp['result'] ){ //Hay cuenta plus
            if( $total_prop>=CFG_CUENTAPLUS_TOTAL_PROP ) {
                return array(
                    'result'=>false,
                    'error'=>'limitexceeded'
                );
            }
        }else{
            if( $total_prop>=CFG_FREE_TOTAL_PROP ) {
                return array(
                    'result'=>false,
                    'error'=>'accesdenied'
                );
            }
        }
        return array('result'=>true);
    }

}

?>