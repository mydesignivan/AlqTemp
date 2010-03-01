<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/');

        $this->load->helper('combobox');
        $this->load->model('prop_model');
        $this->load->model('cuentaplus_model');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        $data = $this->prop_model->get_list_prop();
        $this->load->view('paneluser_proplist_view', array('listProp'=>$data));
    }

    public function form(){
        if( !$this->uri->segment(3) ){
            $check = $this->check_total_propfree();

            if( $check['result'] ){
                $arr = array(
                    'action'=>'show',
                    'data'=>false,
                    'services'=>$this->prop_model->get_services()->result_array()
                );
            }else{
                $arr = array(
                    'action'=>$check['error'],
                    'data'=>false
                );
            }
        }else{
            $arr = array(
                'action'=>'show',
                'data'=>$this->prop_model->get_prop($this->uri->segment(3)),
                'services'=>$this->prop_model->get_services()->result_array()
            );
        }
        $this->load->view('paneluser_propform_view', $arr);

    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = $this->request_fields();
            $data['images_new'] = $_POST['images_new'];
            $status = $this->prop_model->create($data);

            if( $status ){
                redirect('/prop/');
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

            $status = $this->prop_model->update($data, $this->uri->segment(3));

            if( $status=="ok" ){
                redirect('/prop/');
            }else{
                show_error(ERR_PROP_EDIT);
            }

        }
    }

    public function delete(){
        if( $this->uri->segment(3) ){
            $id = $this->uri->segment_array();
            array_splice($id, 0,2);
            
            if( $this->prop_model->delete($id) ){
                redirect('/prop/');
            }else{
                show_error(ERR_PROP_DELETE);
            }
        }
    }

    public function cancel(){
        delete_images_temp();
        redirect('/prop/');
    }

    public function check(){
        if( $this->prop_model->exists($this->uri->segment(3), $this->uri->segment(4)) ){
            echo "exists";
        }
    }

    public function check_total_images(){
        if( is_numeric($this->uri->segment(3)) ){
            $check_cp = $this->cuentaplus_model->check();
            $total_images = $this->uri->segment(3);

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

    /*
     * FUNCTIONS PRIVATE
     */
    private function request_fields(){
        $data = array(
            'user_id'         => $this->session->userdata('user_id'),
            'address'         => $_POST["txtAddress"],
            'category'        => $_POST["cboCategory"],
            'description'     => $_POST["txtDesc"],
            'country_id'      => $_POST["cboCountry"],
            'state_id'        => $_POST["cboStates"],
            'city'            => $_POST["txtCity"],
            'phone'           => $_POST["txtPhone"],
            'website'         => (strtolower($_POST["txtWebsite"])!="http://") ? $_POST["txtWebsite"] : "",
            'price'           => $_POST["txtPrice"],
            'services'        => $_POST["services"]
        );
        return $data;
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