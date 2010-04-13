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

    public function get_list($limit, $offset, $searcher){
        $return = array();

        $sql = TBL_ORDERS.".order_id,";
        $sql.= TBL_ORDERS.".importe,";
        $sql.= TBL_USERS.".username,";
        $sql.= "date_format(".TBL_ORDERS.".`date`, '%d-%m-%Y %H:%i:%s') as `date`,";
        $sql.= "CASE WHEN ".TBL_ORDERS.".status=1 THEN 'Pendiente' ELSE 'Confirmado' END as status";

        $like = array();
        $where = array();

        if( count($searcher)>0 ){
            if( isset($searcher['username']) ) $like['username'] = $searcher['username'];
            if( isset($searcher['importe']) ) $where['importe'] = $searcher['importe'];
            if( isset($searcher['status']) ) $where['status'] = $searcher['status'];
            if( isset($searcher['date']) ) $like = array("date_format(date, '%d-%m-%Y %H:%i:%s')" => $searcher['date']);
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
        $this->db->order_by(TBL_ORDERS.'.order_id', 'desc');

        $return['result'] = $this->db->get(TBL_ORDERS, $limit, $offset);

        return $return;
    }

}
?>