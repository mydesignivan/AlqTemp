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
        $this->load->view('formregistro_view');
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

            $status = $this->users_model->create($data);

            if( is_numeric($status) ){

                /*$this->email->from(EMAIL_REG_FROM, EMAIL_REG_NAME);
                $this->email->to($_POST["txtEmail"]);
                $this->email->subject(EMAIL_REG_SUBJECT);
                $this->email->message(EMAIL_REG_MESSAGE);
                if( $this->email->send() ){*/
                    $this->session->set_flashdata('statusrecord', 'saveok');
                    redirect('/registro/');
                /*}else {
                    show_error(ERR_103);
                }*/


            }elseif( $status=="userexists" ){
                $this->session->set_flashdata('statusrecord', 'userexists');
                $this->session->set_flashdata('data', $data);
                redirect('/registro/');
                
            }else{
                show_error(ERR_102);
            }

        }
    }
}

?>