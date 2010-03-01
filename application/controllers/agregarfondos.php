<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Agregarfondos extends Controller {

    function __construct(){
        parent::Controller();
        if( !$this->session->userdata('logged_in') || $this->session->userdata('level')==1 ) redirect('/');
        $this->load->library('email');
    }

    public function index(){
        $this->load->view('paneluser_addfondo_view');
    }

    public function send(){
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $user_email = $this->session->userdata('email');
            $user_name = $this->session->userdata('name');
            $user_phone = $this->session->userdata('phone');

            $message = sprintf(EMAIL_BUYCREDIT_MESSAGE, 
                    $user_name,
                    $user_phone,
                    $user_email,
                    $_POST['cboFormaPago'],
                    $_POST['cboImport'],
                    $_POST['credit']
            );

            $this->email->from(EMAIL_BUYCREDIT_FROM, "");
            $this->email->to(EMAIL_BUYCREDIT_TO);
            $this->email->subject(EMAIL_BUYCREDIT_SUBJECT);
            $this->email->message($message);
            if( $this->email->send() ){
                $this->session->set_flashdata('status', 'ok');
                redirect('/agregarfondos/');
            }else {
                //show_error(ERR_103);
            }
        }
    }

    public function success(){
        $this->load->view('paneluser_addfondo_view', array('result_buy'=>'success'));
    }
    public function cancel(){
        $this->load->view('paneluser_addfondo_view', array('result_buy'=>'cancel'));
    }


}

?>