<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Fondos_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function extract($fondo){
        $new_fondo = (int)$this->session->userdata('fondo')-$fondo;
        $this->session->set_userdata('fondo', $new_fondo);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        if( !$this->db->update(TBL_USERS, array('fondo'=>$new_fondo)) ){
            display_error(__FILE__, "extract", ERR_DB_UPDATE, array(TBL_USERS));
        }
    }

    public function order_save(){
        $token = uniqid(time());
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'importe' => $_POST['importe'],
            'token'   => $token
        );
        if( !$this->db->INSERT(TBL_ORDERS, $data) ){
            display_error(__FILE__, "order_save", ERR_DB_INSERT, array(TBL_ORDERS));
        }
        return $token;
    }

    public function order_check(){
        $where = array(
            'user_id' => $this->session->userdata('user_id'),
            'token'   => $this->uri->segment(2)
        );
        $result = $this->db->get_where(TBL_ORDERS, $where);
        return $result->num_rows!=0;
    }

}
?>