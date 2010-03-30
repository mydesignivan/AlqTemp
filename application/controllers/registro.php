<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Registro extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
        $this->load->model('lists_model');
        $this->load->helper('form');
        $this->load->library('encpss');
        $this->load->library('email');

        $this->load->library('dataview', array(
            'tlp_title'       =>  TITLE_REGISTRO,
            'comboCountry'    =>  $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses")),
            'comboCategory'   =>  $this->lists_model->get_category(array("0"=>"Categor&iacute;as")),
            'comboStates'     =>  $this->lists_model->get_states_search(array("0"=>"Estados / Provincias")),
            'comboCity'       =>  $this->lists_model->get_city_search(array("0"=>"Ciudades"))
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
            'tlp_section'         =>  'frontpage/registro_view.php',
            'tlp_title_section'   =>  'Registrarme',
            'tlp_script'          =>  array('validator', 'account'),
        ));
        $this->load->view('template_frontpage_view', $this->_data);
    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $data = array(
                'name'       => $_POST["txtName"],
                'email'      => $_POST["txtEmail"],
                'phone'      => $_POST["txtPhone"],
                'username'   => $_POST["txtUser"],
                'password'   => $this->encpss->encode($_POST["txtPass"]),
                'date_added' => date('Y-m-d H:i:s')
            );

            $user_id = $this->users_model->create($data);

            $link = site_url('/registro/confirm_email/'.$this->encpss->urlsafe_base64_encode($user_id));
            $message = sprintf(EMAIL_REG_MESSAGE,
                $_POST["txtUser"],
                $link,
                $link
            );

            $this->email->from(EMAIL_REG_FROM, EMAIL_REG_NAME);
            $this->email->to($_POST["txtEmail"]);
            $this->email->subject(EMAIL_REG_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                $this->session->set_flashdata('statusrecord', 'saveok');
                $this->session->set_flashdata('username', $_POST["txtUser"]);
                $this->session->set_flashdata('email', $_POST["txtEmail"]);
                redirect('/registro/');
            }else {
                $err = $this->email->print_debugger();
                log_message("error", $err);
                die($err);
            }

        }
    }

    public function confirm_email(){
        if( $this->uri->segment(3) ){
            $seg = $this->encpss->urlsafe_base64_decode($this->uri->segment(3));
            $res = $this->users_model->activate($seg);
            if( !$res ){
                redirect('/index/');
            }else{
                $user = $res->row_array();
                $message = sprintf(EMAIL_REGACTIVE_MESSAGE,
                    $user['username'],
                    $user['username'],
                    $this->encpss->decode($user['password'])
                );

                $this->email->from(EMAIL_REGACTIVE_FROM, EMAIL_REGACTIVE_NAME);
                $this->email->to($user['email']);
                $this->email->subject(EMAIL_REGACTIVE_SUBJECT);
                $this->email->message($message);
                if( $this->email->send() ){

                    $this->_data = $this->dataview->set_data(array(
                        'tlp_section'       => 'frontpage/useractivation_view.php',
                        'tlp_title_section' => 'Cuenta Activada',
                        'username'          => $user['username']
                    ));
                    $this->load->view('template_frontpage_view', $this->_data);

                }else {
                    $err = $this->email->print_debugger();
                    log_message("error", $err);
                    die($err);
                }

            }
        }else redirect('/index/');
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_check(){
        $this->load->library('captcha/securimage');

        $status = $this->users_model->exists($_POST['username'], $_POST['email'], $_POST['userid']);

        if( $status!="ok" ){
            die($status);
        }
        if( !empty($_POST['captcha']) ){
            if( !$this->securimage->check($_POST['captcha']) ){
                die("captcha_error");
            }
        }

        die("ok");
    }

}
?>