<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Search_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function list_disting($limit, $offset) {
        $sql = TBL_PROPERTIES.".prop_id,";
        $sql.= TBL_PROPERTIES.".address,";
        $sql.= TBL_PROPERTIES.".description,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
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
    public function search($limit, $offset, $category_id=0){
        $sql = "prop_id,";
        $sql.= "address,";
        $sql.= "description,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
        $sql.= "city,";
        $sql.= "price,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."', name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_PROPERTIES .".prop_id=". TBL_IMAGES .".prop_id LIMIT 1) as image_thumb";

        $where = array();
        $like = array();
        $or_like = array();

        if( !empty($_POST['txtSearch']) ) {
            $like = array('address'=>$_POST["txtSearch"]);
            $or_like = array('description'=>$_POST["txtSearch"]);
        }

        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $_POST['cboCountry']!=0 )  $where = array("country_id"=>$_POST["cboCountry"]);
            if( $_POST['cboStates']!=0 )   $where = array("state_id"=>$_POST["cboStates"]);
            if( $_POST['cboCity']!=0 )     $like = array("city"=>$_POST['cboCity']);
            if( $_POST['cboCategory']!=0 ) $where = array("category_id"=>$_POST["cboCategory"]);
        }else{
            $where = array("category_id"=>$category_id);
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
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            if( $_POST['cboCity']!=0 ){
                $query = $this->db->query('SELECT hits,id FROM '.TBL_LOGSEARCHES." WHERE search_term='".$_POST['cboCity']."'");
                if( $query->num_rows==0 ){
                    if( !$this->db->insert(TBL_LOGSEARCHES, array('search_term'=>$_POST['cboCity'], 'hits'=>1)) ){
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

    public function last_properties($limit){
        $sql = "prop_id,";
        $sql.= "address,";
        $sql.= "description,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
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
