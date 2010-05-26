<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Orders_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function save(){
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

    public function check(){
        $where = array(
            'user_id' => $this->session->userdata('user_id'),
            'token'   => $this->uri->segment(2)
        );
        $result = $this->db->get_where(TBL_ORDERS, $where);
        return $result->num_rows!=0;
    }

    public function get_list($limit, $offset, $arr_url){
        $return = array();

        $sql = TBL_ORDERS.".order_id,";
        $sql.= TBL_ORDERS.".importe,";
        $sql.= TBL_USERS.".user_id,";
        $sql.= TBL_USERS.".username,";
        $sql.= "date_format(".TBL_ORDERS.".`date`, '%d-%m-%Y %H:%i:%s') as `date`,";
        $sql.= "CASE WHEN ".TBL_ORDERS.".status=1 THEN 'Pendiente' ELSE 'Confirmado' END as status";

        $like = array();
        $where = array();

        if( count($arr_url)>0 ){
            if( isset($arr_url['username']) ) $like['username'] = $arr_url['username'];
            if( isset($arr_url['importe']) ) $where['importe'] = $arr_url['importe'];
            if( isset($arr_url['status']) ) $where['status'] = $arr_url['status'];
            if( isset($arr_url['date']) ) {
                $d = explode("-", $arr_url['date']);
                if( $d[0]!="any" ) $where["date_format(date, '%d')="] = $d[0];
                if( $d[1]!="any" ) $where["date_format(date, '%m')="] = $d[1];
                if( $d[2]!="any" ) $where["date_format(date, '%Y')="] = $d[2];
            }
        }

        $this->db->from(TBL_ORDERS);
        $this->db->join(TBL_USERS, TBL_ORDERS.'.user_id = '.TBL_USERS.".user_id");
        $this->db->like($like);
        $this->db->where($where);

        $return['count_rows'] = $this->db->count_all_results();

        $this->db->select($sql, false);
        $this->db->join(TBL_USERS, TBL_ORDERS.'.user_id = '.TBL_USERS.".user_id");
        $this->db->like($like);
        $this->db->where($where);
        if( !isset($arr_url['orderby']) ){
            $this->db->order_by('order_id', 'desc');
        }else{
            if( $arr_url['orderby']=="date" ) $arr_url['orderby'] = "date_format(".TBL_ORDERS.".`date`, '%d-%m-%Y %H:%i:%s')";
            $this->db->order_by($arr_url['orderby'], $arr_url['order']);
        }

        $return['result'] = $this->db->get(TBL_ORDERS, $limit, $offset);

        return $return;
    }

    public function orders_confirm($id){
        $this->db->where_in("order_id", $id);
        if( !$this->db->update(TBL_ORDERS, array('status'=>2, 'token'=>'')) ){
            display_error(__FILE__, "orders_confirm", ERR_DB_UPDATE, array(TBL_ORDERS));
        }
        return true;
    }

}
?>