<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class disting_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
        $this->load->model('fondos_model');
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function get_list($disting){
        $param = $disting==1 ? "right" : "left";

        $sql = TBL_PROPERTIES.".prop_id, ".TBL_PROPERTIES.".address,";
        $sql.= "(SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".TBL_PROPERTIES.".category_id) as category,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."',name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_IMAGES .".prop_id=". TBL_PROPERTIES .".prop_id LIMIT 1) as image";
        if( $disting==1 ) $sql.= ",CASE ".TBL_PROPERTIES_DISTING.".type WHEN 'index' THEN 'Index' WHEN 'category' THEN 'Categor&iacute;a' WHEN 'city' THEN 'Ciudad' END as type";
        $this->db->select($sql, false);
        $this->db->from(TBL_PROPERTIES);

        if( $disting==1 )
            $this->db->join(TBL_PROPERTIES_DISTING, TBL_PROPERTIES.".prop_id=".TBL_PROPERTIES_DISTING.".prop_id");
        else
            $this->db->where(TBL_PROPERTIES.'.prop_id not in(SELECT prop_id FROM '.TBL_PROPERTIES_DISTING.')');

        $this->db->where("user_id", $this->session->userdata('user_id'));
        $this->db->order_by(TBL_PROPERTIES.'.prop_id', 'desc');
        $this->db->order_by(TBL_PROPERTIES.'.address', 'asc');
        return $this->db->get();
    }

    public function disting($prop_id, $type){
        $date_end = substr(add_date(date('d-m-Y'), 0, CFG_TIME_DISTPROP), 0, 10);

        $this->fondos_model->extract(CFG_COSTO_PROPDISTING);

        $sql = "INSERT INTO ".TBL_PROPERTIES_DISTING."(prop_id, `type`, date_start, date_end) VALUES";
        foreach ( $prop_id as $id ){
            $sql.= "(";
            $sql.= $id.",";
            $sql.= "'".$type."',";
            $sql.= "now(),";
            $sql.= "'".$date_end."'";
            $sql.= "),";
        }
        $sql = substr($sql, 0, -1);
        
        if( !$this->db->query($sql) ){
            display_error(__FILE__, "disting", ERR_DB_INSERT, array(TBL_PROPERTIES_DISTING));
        }

        return true;
    }

    public function undisting($prop_id){
        $this->db->where_in("prop_id", $prop_id);
        if( !$this->db->delete(TBL_PROPERTIES_DISTING) ){
            display_error(__FILE__, "undisting", ERR_DB_INSERT, array(TBL_PROPERTIES_DISTING));
        }
        return true;
    }



}
?>
