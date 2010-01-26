<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Search_model extends Model {

    function  __construct() {
        parent::Model();
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function list_disting() {
        $sql = "prop_id,";
        $sql.= "address,";
        $sql.= "description,";
        $sql.= "CASE category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category,";
        $sql.= "city,";
        $sql.= "price,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM images WHERE properties.prop_id=images.prop_id LIMIT 1) as image_thumb";
        $this->db->where("disting", 1);
        $this->db->select($sql, false);
        $this->db->order_by('prop_id', 'desc');
        return $this->db->get('properties');
    }
    public function search($data, $limit, $offset){
        $sql = "prop_id,";
        $sql.= "address,";
        $sql.= "description,";
        $sql.= "CASE category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category,";
        $sql.= "city,";
        $sql.= "price,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM images WHERE properties.prop_id=images.prop_id LIMIT 1) as image_thumb";

        $where = array();
        $like = array();
        $or_like = array();

        if( is_array($data) ){
            $where = array();
            if( isset($data['search'] ) && $data['search']!="empty" ) {
                $like = array('address'=>$data["search"]);
                $or_like = array('description'=>$data["search"]);
            }
            if( isset($data['country']) && $data['country']!=0 ) $where = array("country"=>$data["country"]);
            if( isset($data['states']) && $data['states']!=0 )   $where = array("states"=>$data["states"]);
            if( isset($data['city']) && !empty($data['city']) )  $like = array("city"=>$data['city']);
            if( $data['category']!=0 )                           $where = array("category"=>$data["category"]);
            //if( count($where)>0 ) $this->db->where(implode(" AND ", $where), false);
        }

        $this->db->like($like);
        $this->db->or_like($or_like);
        $this->db->where($where);
        $this->db->select($sql, false);
        $this->db->order_by('prop_id', 'desc');
        $this->db->from('properties');

        $count_rows = $this->db->count_all_results();

        $this->db->like($like);
        $this->db->or_like($or_like);
        $this->db->where($where);
        $this->db->select($sql, false);
        $this->db->order_by('prop_id', 'desc');
        $result = $this->db->get('properties', $limit, $offset);

        return array('result'=>$result, 'count_rows'=>$count_rows);
    }


}
?>
