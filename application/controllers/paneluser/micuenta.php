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
            'tlp_title'   =>  setup('TITLE_MICUENTA')
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
            'tlp_section'       =>  'paneluser/myaccount_view.php',
            'tlp_title_section' =>  "Mi Cuenta",
            'tlp_script'        =>  array('validator', 'popup', 'account'),
            'info'              =>  $this->users_model->get_user(array('user_id'=>$this->session->userdata('user_id'), 'active'=>1))
        ));
        $this->load->view('template_paneluser_view', $this->_data);
    }

    public function baja(){
        $this->_data = $this->dataview->set_data(array(
            'tlp_section'       =>  'paneluser/myaccount_baja_view.php',
            'tlp_title_section' =>  "Darme de baja",
            'tlp_script'        =>  array('validator', 'popup', 'account')
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

    public function delete(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $this->users_model->save_delete_motive() ){
                if( $this->users_model->delete($this->session->userdata('user_id')) ){
                    $this->load->library("simplelogin");
                    $this->simplelogin->logout();
                    redirect('/message/');

                }else{
                    show_error(ERR_USER_DELETE);
                }
            }
        }
    }


    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_popup_editpass(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $this->load->view('paneluser/popup/account_editpass_view');
        }
    }

    public function ajax_save_pass(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            echo $this->users_model->change_pass2($_POST['pss_current'], $_POST['pss_new']);
        }
    }

    public function ajax_checkuser(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            echo $_POST['user']==$this->session->userdata('username') ? "ok" : "error";
        }
    }

}
?>