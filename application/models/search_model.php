<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Search_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function list_disting($type, $type_val) {
        $count_prop_disting = setup('COUNT_PROP_DISTING');

        $sql = TBL_PROPERTIES.".prop_id,";
        $sql.= TBL_PROPERTIES.".reference,";
        $sql.= TBL_PROPERTIES.".description,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
        $sql.= TBL_PROPERTIES.".city,";
        $sql.= TBL_PROPERTIES.".price,";
        $sql.= TBL_PROPERTIES.".priceby,";
        $sql.= TBL_PROPERTIES.".pricemoney,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_PROPERTIES .".prop_id=". TBL_IMAGES .".prop_id LIMIT 1) as image_thumb";

        $this->db->select($sql, false);
        $this->db->join(TBL_PROPERTIES_DISTING, TBL_PROPERTIES.".prop_id=".TBL_PROPERTIES_DISTING.".prop_id");
        $this->db->where("now() <=", TBL_PROPERTIES_DISTING.'.date_end');
        $this->db->where(TBL_PROPERTIES_DISTING.".type", $type);
        if( !is_null($type_val) ) {
            if( $type=="category" ) $this->db->where(TBL_PROPERTIES_DISTING.".category_id", $type_val);
            else if( $type=="city" ) $this->db->where(TBL_PROPERTIES_DISTING.".city", $type_val);
        }
        $this->db->order_by('prop_id', 'desc');
        $result = $this->db->get(TBL_PROPERTIES, $count_prop_disting);
        
        return $result;
    }

    public function last_properties($limit, $offset){
        $sql = TBL_PROPERTIES.".prop_id,";
        $sql.= TBL_PROPERTIES.".reference,";
        $sql.= TBL_PROPERTIES.".description,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
        $sql.= TBL_PROPERTIES.".city,";
        $sql.= TBL_PROPERTIES.".price,";
        $sql.= TBL_PROPERTIES.".priceby,";
        $sql.= TBL_PROPERTIES.".pricemoney,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ".TBL_IMAGES." WHERE ".TBL_PROPERTIES.".prop_id=".TBL_IMAGES.".prop_id LIMIT 1) as image_thumb";

        $this->db->select($sql, false);
        $this->db->from(TBL_PROPERTIES);
        $this->db->where(TBL_PROPERTIES.'.prop_id not in(SELECT prop_id FROM '.TBL_PROPERTIES_DISTING.')');
        $count_rows = $this->db->count_all_results();

        $this->db->select($sql, false);
        $this->db->where(TBL_PROPERTIES.'.prop_id not in(SELECT prop_id FROM '.TBL_PROPERTIES_DISTING.')');
        $this->db->order_by('prop_id', 'desc');
        $result = $this->db->get(TBL_PROPERTIES, $limit, $offset);

        return array('result'=>$result, 'count_rows'=>$count_rows);
    }

    public function search($limit, $offset, $searcher){
        $sql = "prop_id,";
        $sql.= "reference,";
        $sql.= "description,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
        $sql.= "city,";
        $sql.= "price,";
        $sql.= "priceby,";
        $sql.= "pricemoney,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_PROPERTIES .".prop_id=". TBL_IMAGES .".prop_id LIMIT 1) as image_thumb";

        $where = array();
        $like = array();
        $or_like = array();

        if( !empty($searcher['search']) ){
            $like['address'] = $searcher['search'];
            $or_like['description'] = $searcher['search'];
        }
        if( isset($searcher['country']) && !empty($searcher['country']) ) $where['country_id'] = $searcher['country'];
        if( isset($searcher['state']) && !empty($searcher['state']) ) $where['state_id'] = $searcher['state'];
        if( isset($searcher['city']) && !empty($searcher['city']) ) $like['city'] = $searcher['city'];
        if( !empty($searcher['category']) ) $where['category_id'] = $searcher['category'];

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
        if( !empty($searcher['city']) ){
            if( $this->db->get_where(TBL_PROPERTIES, array('city'=>$searcher['city']))->num_rows>0 ){
                $query = $this->db->query('SELECT hits,id FROM '.TBL_LOGSEARCHES." WHERE search_term='".$searcher['city']."'");
                if( $query->num_rows==0 ){
                    if( !$this->db->insert(TBL_LOGSEARCHES, array('search_term'=>$searcher['city'], 'hits'=>1)) ){
                        display_error(__FILE__, "search", ERR_DB_INSERT, array(TBL_LOGSEARCHES));
                    }

                }else{
                    $row = $query->row_array();
                    $hits = (int)$row['hits']+1;
                    $this->db->where('id', $row['id']);
                    if( !$this->db->update(TBL_LOGSEARCHES, array('hits'=>$hits)) ){
                        display_error(__FILE__, "search", ERR_DB_UPDATE, array(TBL_LOGSEARCHES));
                    }
                }
            }
        }

        return array('result'=>$result, 'count_rows'=>$count_rows);
    }

    public function get_searches(){
        $this->db->order_by('hits', 'desc');
        return $this->db->get(TBL_LOGSEARCHES, 12);
    }

    public function prop_similares($prop_id){
        $data = $this->db->get_where(TBL_PROPERTIES, array('prop_id'=>$prop_id))->row_array();

        $sql = "prop_id,";
        $sql.= "reference,";
        $sql.= "description,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
        $sql.= "city,";
        $sql.= "price,";
        $sql.= "priceby,";
        $sql.= "pricemoney,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ".TBL_IMAGES." WHERE ".TBL_PROPERTIES.".prop_id=".TBL_IMAGES.".prop_id LIMIT 1) as image_thumb";

        $this->db->select($sql, false);
        $this->db->where("city", $data['city']);
        $this->db->where("category_id", $data['category_id']);
        $this->db->order_by('prop_id', 'desc');
        return $this->db->get(TBL_PROPERTIES, setup('gral_count_propsimilares '));
    }

}
?>
