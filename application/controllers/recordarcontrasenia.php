<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Recordarcontrasenia extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
        $this->load->model('lists_model');
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->library('dataview', array(
            'tlp_title'       =>  TITLE_RECORDARCONTRA,
            'tlp_script'      =>  array('validator', 'rememberpass'),
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
            'tlp_section'       => 'frontpage/rememberpass_view.php',
            'tlp_title_section' => "Recordar Contrase&ntilde;a",
        ));
        $this->load->view('template_frontpage_view', $this->_data);
    }

    public function password_reset(){
        $param1 = $this->uri->segment(3);
        $param2 = $this->uri->segment(4);

        if( $param1 && $param2 ){
            if( $this->users_model->check_token($param1, $param2) ){

                $this->_data = $this->dataview->set_data(array(
                    'tlp_section'       => 'frontpage/passwordreset_view.php',
                    'tlp_title_section' => "Recordar Contrase&ntilde;a",
                    'username'          => $param1,
                    'token'             => $param2
                ));
                $this->load->view('template_frontpage_view', $this->_data);

            }else redirect('/index/');
        }else redirect('/index/');
    }

    public function send(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $result = $this->users_model->rememberpass(trim($_POST["txtField"]));
            if( $result['status']=="ok" ){
                $data = $result['data'];
                $link = site_url('/recordarcontrasenia/password_reset/'.urlencode($data['username']).'/'.$data['token']);
                $message = sprintf(EMAIL_RP_MESSAGE,
                    $link,
                    $link
                );

                $this->email->from(EMAIL_RP_FROM, EMAIL_RP_NAME);
                $this->email->to($data['email']);
                $this->email->subject(EMAIL_RP_SUBJECT);
                $this->email->message($message);
                if( !$this->email->send() ){
                    $err = $this->email->print_debugger();
                    log_message("error", $err);
                    die($err);
                }
            }
            $this->_data = $this->dataview->set_data(array(
                'tlp_section'       => 'frontpage/rememberpass_view.php',
                'tlp_title_section' => "Recordar Contrase&ntilde;a",
                'status'            => $result['status'],
                'field'             => $_POST['txtField']
            ));
            $this->load->view('template_frontpage_view', $this->_data);
        }
    }

    public function send_newpass(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $this->users_model->change_pass($_POST) ){
                $this->load->library('encpss');
                $this->_data = $this->dataview->set_data(array(
                    'tlp_section'       => 'frontpage/passwordreset_view.php',
                    'tlp_title_section' => "Recordar Contrase&ntilde;a",
                    'status'            => 'ok',
                    'info' => array(
                        'username'=>$this->encpss->encode($_POST['usr']),
                        'password'=>$this->encpss->encode($_POST['txtPass'])
                     )
                ));
                $this->load->view('template_frontpage_view', $this->_data);
            }else redirect('/index/');
        }
    }

    /* AJAX FUNCTIONS
     **************************************************************************/
    public function ajax_check_captcha(){
        if( !empty($_POST['captcha']) ){
            $this->load->library('captcha/securimage');
            echo !$this->securimage->check($_POST['captcha']) ? "error" : "ok";
            die();
        }
    }
    
}
?>