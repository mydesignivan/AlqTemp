<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') ) redirect('/');

        $this->load->helper('combobox');
        $this->load->model('prop_model');
    }

    public function index(){
        $this->load->view('proplist_view');
    }

    public function form(){
        $services = $this->prop_model->get_services();

        $data = array(
            'address'     => '',
            'description' => '',
            'country_id'  => '',
            'state_id'    => '',
            'city'        => '',
            'phone'       => '',
            'website'     => '',
            'price'       => '',
            'services'    => ''
        );

        $this->load->view('propform_view', array('services' => $services->result_array(), 'data'=>$data ));
    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = array(
                'address'     => $_POST["txtAddress"],
                'description' => $_POST["txtDesc"],
                'country_id'  => $_POST["cboCountry"],
                'state_id'    => $_POST["cboStates"],
                'city'        => $_POST["txtCity"],
                'phone'       => $_POST["txtPhone"],
                'website'     => $_POST["txtWebsite"],
                'price'       => $_POST["txtPrice"],
                'services'    => $_POST["services"]
            );

            $status = $this->prop_model->create($data);

            if( $status=="ok" ){
                $this->session->set_flashdata('statusrecord', 'saveok');
                redirect('/prop/');

            }else{
                show_error(ERR_102);
            }

        }
    }

    public function edit(){

    }

    public function delete(){
        
    }
}

?>