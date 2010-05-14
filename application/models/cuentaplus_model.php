<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class cuentaplus_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
        $this->load->model('fondos_model');
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function debit(){
        $this->fondos_model->extract(CFG_COSTO_CUENTAPLUS);
        $user_id = $this->session->userdata('user_id');
        $date_end = add_date(date('d-m-Y'), 0,0,CFG_TIME_CUENTAPLUS);

        $query = $this->db->get_where(TBL_CUENTAPLUS, array('user_id'=>$user_id));
        if( $query->num_rows==0 ){

            $sql = "INSERT INTO ".TBL_CUENTAPLUS."(user_id, date_start, date_end) VALUES(";
            $sql.= $user_id.",";
            $sql.= "now(),";
            $sql.= "'".$date_end."'";
            $sql.= ")";

            if( !$this->db->query($sql) ){
                display_error(__FILE__, "debit", ERR_DB_INSERT, array(TBL_CUENTAPLUS));
            }
        }else{
            $sql = "UPDATE ".TBL_CUENTAPLUS." SET ";
            $sql.= "date_start = now(),";
            $sql.= "date_end = '".$date_end."' ";
            $sql.= "WHERE user_id=".$user_id;

            if( !$this->db->query($sql) ){
                display_error(__FILE__, "debit", ERR_DB_UPDATE, array(TBL_CUENTAPLUS));
            }
        }
        return true;
    }

    public function check($user_id=null){
        if( $user_id==null ) $user_id = $this->session->userdata('user_id');

        $data = array(
            'user_id'  => $user_id,
            'now() <=' => 'date_end'
        );

        $query = $this->db->get_where(TBL_CUENTAPLUS, $data);

        if( $query->num_rows>0 ){
            $this->load->helper('date');

            $data = $query->row_array();
            $date = mdate("%d de %F de %Y", strtotime($data['date_end']));

            return array('result'=>true, 'date'=>$date);
        }

        return array('result'=>false);
    }


}
?>