<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_account extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
        $this->load->model('captcha_model');
        session_start();
    }

    public function index(){
        
    }

    public function valid(){
        $status = $this->users_model->exists($_POST['username'], $_POST['email'], $_POST['userid']);

        if( $status!="ok" ){
            die($status);
        }
        if( !empty($_POST['captcha']) ){
            if( strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) != 0 ){
                die("captcha_error");
            }
        }

        die("ok");
    }

    public function generatecaptcha(){
        $captcha = $this->captcha_model->generateCaptcha();
        $_SESSION['captchaWord'] = $captcha['word'];
        echo $captcha['image'];
    }

}

?>