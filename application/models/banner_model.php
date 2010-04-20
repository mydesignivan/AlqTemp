<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function create($data){
        $query = $this->db->query('SELECT CASE WHEN ISNULL(COUNT(*)) THEN 1 ELSE COUNT(*)+1 END AS `order` FROM '.TBL_BANNER)->row_array();
        $data['order'] = $query['order'];
//            print_array($data, true);

        if( !$this->db->insert(TBL_BANNER, $data) ){
            display_error(__FILE__, "create", ERR_DB_INSERT, array(TBL_BANNER));
        }

        return true;
    }

    public function edit($data, $id){
        $this->db->where('banner_id', $id);
        if( !$this->db->update(TBL_BANNER, $data) ){
            display_error(__FILE__, "edit", ERR_DB_UPDATE, array(TBL_BANNER));
        }

        return true;
    }

    public function delete($id){
        if( !$this->db->query('DELETE FROM '.TBL_BANNER.' WHERE banner_id in('. implode(",", $id) .')') ){
            display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_BANNER));
        }
        return true;
    }

    public function get_list($limit, $offset, $searcher){
        $return = array();

        $sql = "banner_id,";
        $sql.= "`order`,";
        $sql.= "name,";
        $sql.= "CASE position ";
        $sql.= "WHEN 'left' THEN 'Izquierda' ";
        $sql.= "WHEN 'right' THEN 'Derecha' ";
        $sql.= "WHEN 'top' THEN 'Arriba' ";
        $sql.= "WHEN 'bottom' THEN 'Abajo' ";
        $sql.= "END AS position,";
        $sql.= "CASE WHEN visible=1 THEN 'Visible' ELSE 'Oculto' END as visible";

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
        $this->db->order_by('`order`', 'desc');

        $return['result'] = $this->db->get(TBL_BANNER, $limit, $offset);

        return $return;
    }

    public function get_banner($id){
        $query = $this->db->get_where(TBL_BANNER, array('banner_id'=>$id));
        return $query->row_array();
    }

    public function orders_confirm($id){
        $this->db->where_in("order_id", $id);
        if( !$this->db->update(TBL_ORDERS, array('status'=>2, 'token'=>'')) ){
            display_error(__FILE__, "orders_confirm", ERR_DB_UPDATE, array(TBL_ORDERS));
        }
        return true;
    }

    public function exists($name, $id=''){
        if( $id=="" ){
            $where = array('name'=>$name);
        }else{
            $where = array('banner_id <>'=>$id, 'name'=>$name);
        }
        $result = $this->db->get_where(TBL_BANNER, $where);
        return $result->num_rows==0 ? false : true;
    }

    public function change_visible(){
        $this->db->where('banner_id', $_POST['id']);
        if( !$this->db->update(TBL_BANNER, array('visible'=>$_POST['statu'])) ){
            display_error(__FILE__, "change_visible", ERR_DB_UPDATE, array(TBL_BANNER));
        }
        return true;
    }

    public function change_order(){
        $order1 = $this->db->get_where(TBL_BANNER, array('banner_id'=>$_POST['id2']))->row_array();
        $order2 = $this->db->get_where(TBL_BANNER, array('banner_id'=>$_POST['id1']))->row_array();

        /*echo 'UPDATE '.TBL_BANNER.' SET `order`='.$order1['order'].' WHERE banner_id='.$_POST['id1']."<br>";
        echo 'UPDATE '.TBL_BANNER.' SET `order`='.$order2['order'].' WHERE banner_id='.$_POST['id2'];*/
        //die();
        if( !$this->db->query('UPDATE '.TBL_BANNER.' SET `order`='.$order1['order'].' WHERE banner_id='.$_POST['id1']) ){
            display_error(__FILE__, "change_order", ERR_DB_UPDATE, array(TBL_BANNER));
        }
        if( !$this->db->query('UPDATE '.TBL_BANNER.' SET `order`='.$order2['order'].' WHERE banner_id='.$_POST['id2']) ){
            display_error(__FILE__, "change_order", ERR_DB_UPDATE, array(TBL_BANNER));
        }

        return true;
    }
    
}
?>