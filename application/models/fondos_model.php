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

}
?>