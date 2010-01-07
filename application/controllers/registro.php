<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Registro extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->model('users');
        $this->load->helper('combobox');
        $this->load->library('encpss');
        $this->load->library('email');
    }

    public function index(){
        $this->load->view('registrarme');
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

            $status = $this->users->create($data);

            if( is_numeric($status) ){

                /*$this->email->from('tu_direccion@tu_sitio.com', 'Tu nombre');
                $this->email->to('alguien@ejemplo.com');
                $this->email->subject('Correo de Prueba');
                $this->email->message('Probando la clase email');
                $this->email->send();
                echo $this->email->print_debugger();*/

                $this->session->set_flashdata('statusrecord', 'saveok');
                redirect('/registro/');

            }elseif( $status=="userexists" ){
                $this->session->set_flashdata('statusrecord', 'userexists');
                redirect('/registro/');
                
            }else{
                show_error(ERR_102);
            }

        }
    }
}

?>