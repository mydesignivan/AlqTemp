<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Micuenta extends Controller{

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/index/');
        set_useronline();
        
        $this->load->model('users_model');
        $this->load->library('encpss');
        $this->load->library("simplelogin");

        $this->load->library('dataview', array(
            'tlp_section'       =>  'paneluser/myaccount_view.php',
            'tlp_title'         =>  TITLE_MICUENTA,
            'tlp_title_section' =>  "Mi Cuenta",
            'tlp_script'        =>  array('validator', 'popup', 'account')
        ));
        $this->_data = $this->dataview->get_data();
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        $this->_data = $this->dataview->set_data(array(
            'info'  =>  $this->users_model->get_user($this->session->userdata('user_id'))
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function edit(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $data = array(
                'firstname'     => $_POST["txtFirstName"],
                'lastname'      => $_POST["txtLastName"],
                'email'         => $_POST["txtEmail"],
                'phone'         => $_POST["txtPhone"],
                'phone_area'    => $_POST["txtPhoneArea"],
                'username'      => $_POST["txtUser"],
                'password'      => $this->encpss->encode($_POST["txtPass"]),
                'last_modified' => date('Y-m-d H:i:s')
            );

            $status = $this->users_model->edit($data, $_POST["user_id"]);

            if( $status ){
                $this->simplelogin->logout();
                redirect('/index/');
            }else{
                show_error(ERR_USER_EDIT);
            }

        }
    }

}
?>