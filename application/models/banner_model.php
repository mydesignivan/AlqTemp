<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function get_list($limit, $offset, $searcher){
        $return = array();

        $sql = "banner_id,";
        $sql.= "name,";
        $sql.= "CASE position ";
        $sql.= "WHEN 'left' THEN 'Izquierda' ";
        $sql.= "WHEN 'right' THEN 'Derecha' ";
        $sql.= "WHEN 'top' THEN 'Arriba' ";
        $sql.= "WHEN 'bottom' THEN 'Abajo' ";
        $sql.= "END,";
        $sql.= "CASE WHEN visible=1 THEN 'Si' ELSE 'No' END as visible";

        $like = array();
        $where = array();

        if( count($searcher)>0 ){
            if( isset($searcher['name']) ) $like['name'] = $searcher['name'];
            if( isset($searcher['position']) ) $where['position'] = $searcher['position'];
            if( isset($searcher['visible']) ) $where['visible'] = $searcher['visible'];
        }

        $this->db->from(TBL_BANNER);
        $this->db->like($like);
        $this->db->where($where);

        $return['count_rows'] = $this->db->count_all_results();

        $this->db->select($sql, false);
        $this->db->like($like);
        $this->db->where($where);
        $this->db->order_by('banner_id', 'desc');

        $return['result'] = $this->db->get(TBL_BANNER, $limit, $offset);

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