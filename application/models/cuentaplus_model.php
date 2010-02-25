<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class cuentaplus_model extends Model {

    function  __construct() {
        parent::Model();
        $this->load->model('fondos_model');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function debit(){
        $this->fondos_model->extract(CFG_VALUE_CUENTAPLUS);
        $user_id = $this->session->userdata('user_id');
        $data = array(
            'user_id'=>$user_id,
            'date_start'=>'now()',
            'date_end'=>add_date(date('d-m-Y'), 0,0,1)
        );
        if( !$this->db->simple_query('SELECT * FROM '.TBL_CUENTAPLUS." WHERE user_id=".$user_id) ){
            if( !$this->db->insert(TBL_CUENTAPLUS, $data) ){
                display_error(__FILE__, "debit", ERR_DB_INSERT, array(TBL_CUENTAPLUS));
            }
        }else{
            unset($data['user_id']);
            if( !$this->db->update(TBL_CUENTAPLUS, $data) ){
                display_error(__FILE__, "debit", ERR_DB_UPDATE, array(TBL_CUENTAPLUS));
            }
        }
        return true;
    }


}
?>