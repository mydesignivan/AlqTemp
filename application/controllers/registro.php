<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Registro extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
        $this->load->model('lists_model');
        $this->load->helper('form');
        $this->load->library('encpss');
        $this->load->library('email');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        $data = $this->get_data();
        $this->load->view('front_formregistro_view', $data);
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

                    $data = $this->get_data();
                    $data['username'] = $user['username'];

                    $this->load->view('front_useractivation_view', $data);

                }else {
                    $err = $this->email->print_debugger();
                    log_message("error", $err);
                    die($err);
                }

            }
        }else redirect('/index/');
    }

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

    /*
     * FUNCTIONS PRIVATE
     */
    private function get_data(){
        $comboCountry = $this->lists_model->get_country_search(array("0"=>"Pa&iacute;ses"));
        $comboStates = $this->lists_model->get_states_search(array("0"=>"Estados / Provincias"));
        $comboCity = $this->lists_model->get_city_search(array("0"=>"Ciudades"));
        $comboCategory = $this->lists_model->get_category(array("0"=>"Categor&iacute;as"));

        return array(
            'comboCountry'    =>  $comboCountry,
            'comboCategory'   =>  $comboCategory,
            'comboStates'     =>  $comboStates,
            'comboCity'       =>  $comboCity
        );
    }

}

?>