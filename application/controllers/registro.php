<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Registro extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
        $this->load->helper('combobox');
        $this->load->library('encpss');
        $this->load->library('email');
    }

    public function index(){
        $this->load->view('front_formregistro_view');
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

            $link = site_url('/registro/confirm_email/'.base64_encode($user_id));
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
            $seg = base64_decode($this->uri->segment(3));
            $res = $this->users_model->activate($seg);
            if( !$res ){
                redirect('/');
            }else{
                $user = $res->row_array();
                $message = sprintf(EMAIL_REGACTIVE_MESSAGE,
                    $user['name'],
                    $user['username'],
                    $this->encpss->decode($user['password'])
                );

                $this->email->from(EMAIL_REGACTIVE_FROM, EMAIL_REGACTIVE_NAME);
                $this->email->to($user['email']);
                $this->email->subject(EMAIL_REGACTIVE_SUBJECT);
                $this->email->message($message);
                if( $this->email->send() ){
                    $this->load->view('front_useractivation_view', array('username'=>$user['username']));
                }else {
                    $err = $this->email->print_debugger();
                    log_message("error", $err);
                    die($err);
                }

            }
        }else redirect('/');
    }

    public function check(){
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