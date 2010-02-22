<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Search_model extends Model {

    function  __construct() {
        parent::Model();
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function list_disting($limit, $offset) {
        $sql = TBL_PROPERTIES.".prop_id,";
        $sql.= TBL_PROPERTIES.".address,";
        $sql.= TBL_PROPERTIES.".description,";
        $sql.= "CASE ".TBL_PROPERTIES.".category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category,";
        $sql.= TBL_PROPERTIES.".city,";
        $sql.= TBL_PROPERTIES.".price,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_PROPERTIES .".prop_id=". TBL_IMAGES .".prop_id LIMIT 1) as image_thumb";

        $this->db->select($sql, false);
        $this->db->from(TBL_PROPERTIES);
        $this->db->join(TBL_PROPERTIES_DISTING, TBL_PROPERTIES.".prop_id=".TBL_PROPERTIES_DISTING.".prop_id");
        $this->db->where("now() <=", TBL_PROPERTIES_DISTING.'.date_end');
        $count_rows = $this->db->count_all_results();

        $this->db->select($sql, false);
        $this->db->join(TBL_PROPERTIES_DISTING, TBL_PROPERTIES.".prop_id=".TBL_PROPERTIES_DISTING.".prop_id");
        $this->db->where("now() <=", TBL_PROPERTIES_DISTING.'.date_end');
        $this->db->order_by('prop_id', 'desc');
        $result = $this->db->get(TBL_PROPERTIES, $limit, $offset);
        
        return array('result'=>$result, 'count_rows'=>$count_rows);
    }
    public function search($data, $limit, $offset){
        $sql = "prop_id,";
        $sql.= "address,";
        $sql.= "description,";
        $sql.= "CASE category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category,";
        $sql.= "city,";
        $sql.= "price,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_PROPERTIES .".prop_id=". TBL_IMAGES .".prop_id LIMIT 1) as image_thumb";

        $where = array();
        $like = array();
        $or_like = array();

        if( is_array($data) ){
            $where = array();
            if( isset($data['search'] ) && $data['search']!="empty" ) {
                $like = array('address'=>utf8_encode($data["search"]));
                $or_like = array('description'=>utf8_encode($data["search"]));
            }
            if( isset($data['country']) && $data['country']!=0 ) $where = array("country"=>$data["country"]);
            if( isset($data['states']) && $data['states']!=0 )   $where = array("states"=>$data["states"]);
            if( isset($data['city']) && !empty($data['city']) )  $like = array("city"=>utf8_encode($data['city']));
            if( isset($data['category']) && $data['category']!=0 ) $where = array("category"=>$data["category"]);
            //if( count($where)>0 ) $this->db->where(implode(" AND ", $where), false);
        }

        $this->db->like($like);
        $this->db->or_like($or_like);
        $this->db->where($where);
        $this->db->select($sql, false);
        $this->db->from(TBL_PROPERTIES);

        $count_rows = $this->db->count_all_results();

        $this->db->like($like);
        $this->db->or_like($or_like);
        $this->db->where($where);
        $this->db->select($sql, false);
        $this->db->order_by('prop_id', 'desc');
        $result = $this->db->get(TBL_PROPERTIES, $limit, $offset);

        // GUARDO LA PALABRA
        if( isset($data['city']) && !empty($data['city']) ){
            $query = $this->db->query('SELECT hits,id FROM '.TBL_LOGSEARCHES." WHERE search_term='".$data['city']."'");
            if( $query->num_rows==0 ){
                if( !$this->db->insert(TBL_LOGSEARCHES, array('search_term'=>$data['city'], 'hits'=>1)) ){
                    display_error(__FILE__, "search", ERR_DB_INSERT, array(TBL_LOGSEARCHES));
                }

            }else{
                $row = $query->row_array();
                $hits = $row['hits']+1;
                $this->db->where('id', $row['id']);
                if( !$this->db->update(TBL_LOGSEARCHES, array('hits'=>$hits)) ){
                    display_error(__FILE__, "search", ERR_DB_UPDATE, array(TBL_LOGSEARCHES));
                }
            }

        }

        return array('result'=>$result, 'count_rows'=>$count_rows);
    }

    public function last_properties($limit){
        $sql = "prop_id,";
        $sql.= "address,";
        $sql.= "description,";
        $sql.= "CASE category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category,";
        $sql.= "city,";
        $sql.= "price,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ".TBL_IMAGES." WHERE ".TBL_PROPERTIES.".prop_id=".TBL_IMAGES.".prop_id LIMIT 1) as image_thumb";

        $this->db->select($sql, false);
        $this->db->order_by('prop_id', 'desc');
        $result = $this->db->get(TBL_PROPERTIES, $limit);

        return array('result'=>$result, 'count_rows'=>3);
    }

    public function get_searches(){
        $this->db->order_by('hits', 'desc');
        return $this->db->get(TBL_LOGSEARCHES);
    }

}
?>
