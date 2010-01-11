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

    public function form(){
        $data = false;
        $id = $this->uri->segment(3);
        if( $id ){
            $data = array();
            $data = $this->prop_model->get_prop($id);
            $service_id = array();
            foreach( $this->prop_model->get_service_associate($id) as $row ){
                $service_id[] = $row['service_id'];
            }
            $data['service_id'] = $service_id;
        }
        $services = $this->prop_model->get_services();
        $this->load->view('propform_view', array('services' => $services->result_array(), 'data'=>$data));
    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){

            $data = $this->request_fields();
            $status = $this->prop_model->create($data);

            if( $status=="ok" ){
                redirect('/prop/');

            }else{
                show_error(ERR_102);
            }

        }
    }

    public function edit(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $data = $this->request_fields();
            $status = $this->prop_model->update($data, $this->uri->segment(3));

            if( $status=="ok" ){
                redirect('/prop/');
            }else{
                show_error(ERR_101);
            }

        }
    }

    public function delete(){
        if( $this->uri->segment(3)!="" ){

            $this->prop_model->delete($this->uri->segment(3));
            redirect('/prop/');
            
        }
    }

    
    /*
     * FUNCTIONS PRIVATE
     */
    private function request_fields(){
        $data = array(
            'address'     => $_POST["txtAddress"],
            'category'    => $_POST["cboCategory"],
            'description' => $_POST["txtDesc"],
            'country_id'  => $_POST["cboCountry"],
            'state_id'    => $_POST["cboStates"],
            'city'        => $_POST["txtCity"],
            'phone'       => $_POST["txtPhone"],
            'website'     => $_POST["txtWebsite"],
            'price'       => $_POST["txtPrice"],
            'services'    => $_POST["services"]
        );
        return $data;
    }
}

?>