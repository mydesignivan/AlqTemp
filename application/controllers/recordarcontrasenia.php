<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Recordarcontrasenia extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('users_model');
        $this->load->model('lists_model');
        $this->load->library('email');
        $this->load->helper('form');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        $this->load->view('front_rememberpass_view', $this->get_data());
    }

    public function password_reset(){
        $param1 = $this->uri->segment(3);
        $param2 = $this->uri->segment(4);

        if( $param1 && $param2 ){
            if( $this->users_model->check_token($param1, $param2) ){

                $data = $this->get_data();
                $data['username'] = $param1;
                $data['token'] = $param2;

                $this->load->view('front_passwordreset_view', $data);

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
            $this->load->view('front_rememberpass_view', array('status'=>$result['status'], 'field'=>$_POST['txtField']));
        }
    }

    public function send_newpass(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $this->users_model->change_pass($_POST) ){
                $this->load->library('encpss');
                $data = array(
                    'status'=>'ok',
                    'data'=>array(
                        'username'=>$this->encpss->encode($_POST['usr']),
                        'password'=>$this->encpss->encode($_POST['txtPass'])
                     )
                );
                $this->load->view('front_passwordreset_view', $data);
            }else redirect('/index/');
        }
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