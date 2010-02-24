<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');

        $this->load->helper('combobox');
        $this->load->model('prop_model');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        $data = $this->prop_model->get_list_prop();
        $this->load->view('proplist_view', array('listProp'=>$data));
    }

    public function message(){
        $data = $this->prop_model->get_list_prop();
        $this->load->view('proplist_view', array('listProp'=>'showmessage'));
    }

    public function form(){
        $data = $this->uri->segment(3) ? $this->prop_model->get_prop($this->uri->segment(3)) : false;
        $services = $this->prop_model->get_services();
        $total_prop = !$this->uri->segment(3) ? $this->prop_model->get_total_prop() : 0;

        $this->load->view('propform_view', array('services' => $services->result_array(), 'data'=>$data, 'total_prop'=>$total_prop));
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
}

?>