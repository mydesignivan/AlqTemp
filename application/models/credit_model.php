<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Credit_model extends Model {

    function  __construct() {
        parent::Model();
    }

    public function extract($credit){
        $new_credit = (int)$this->session->userdata('credit')-$credit;
        $this->session->set_userdata('credit', $new_credit);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        if( !$this->db->update(TBL_USERS, array('credit'=>$new_credit)) ){
            display_error(__FILE__, "extract", ERR_DB_UPDATE, array(TBL_USERS));
        }
    }

    public function acredit(){

    }

}
?>