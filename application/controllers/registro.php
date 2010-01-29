<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Registro extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
        $this->load->helper('combobox');
        $this->load->library('encpss');
        $this->load->library('email');
        $this->load->model('captcha_model');
        $this->load->model('search_model');
        session_start();
    }

    public function index(){
        $captcha = $this->captcha_model->generateCaptcha();
        $_SESSION['captchaWord'] = $captcha['word'];
        $data['captcha'] = $captcha;

        $this->load->view('formregistro_view', $data);
    }

    public function create(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            
            $data = array(
                'name'     => $_POST["txtName"],
                'email'    => $_POST["txtEmail"],
                'phone'    => $_POST["txtPhone"],
                'username' => $_POST["txtUser"],
                'password' => $this->encpss->encode($_POST["txtPass"])
            );

            $user_id = $this->users_model->create($data);

            if( is_numeric($user_id) ){

                $message = sprintf(EMAIL_REG_MESSAGE, site_url('/registro/activacion/'.$user_id));

                $this->email->from(EMAIL_REG_FROM, EMAIL_REG_NAME);
                $this->email->to($_POST["txtEmail"]);
                $this->email->subject(EMAIL_REG_SUBJECT);
                $this->email->message($message);
                if( $this->email->send() ){
                    $this->session->set_flashdata('statusrecord', 'saveok');
                    redirect('/registro/');
                }else {
                    show_error(ERR_103);
                }
                
            }else{
                show_error(ERR_102);
            }

        }
    }

    public function activacion(){
        if( $this->uri->segment(3) ){

            if( !$this->users_model->activate($this->uri->segment(3)) ){
                redirect('/');
            }

            $this->load->view('activacion_view');
        }
    }

}

?>