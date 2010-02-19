<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class disting_model extends Model {

    function  __construct() {
        parent::Model();
        $this->load->model('credit_model');
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function get_list($disting){
        $param = $disting==1 ? "right" : "left";

        $sql = TBL_PROPERTIES.".prop_id, ".TBL_PROPERTIES.".address,";
        $sql.= "CASE ".TBL_PROPERTIES.".category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category,";
        $sql.= "(SELECT CONCAT('".substr(UPLOAD_DIR,2)."',name_thumb) FROM ". TBL_IMAGES ." WHERE ". TBL_IMAGES .".prop_id=". TBL_PROPERTIES .".prop_id LIMIT 1) as image";
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

    public function disting($prop_id){
        $date_end = $this->add_date(date('d-m-Y'), 0, DISTPROP_MONTH);
        $d = substr($date_end, 0,2);
        $m = substr($date_end, 3,2);
        $y = substr($date_end, 6,4);
        $h = substr($date_end, 11,2);
        $i = substr($date_end, 14,2);
        $s = substr($date_end, 17,2);
        $date_end = gmmktime($h, $i, $s, $m, $d, $y);

        $this->credit_model->extract(DISTPROP_CREDIT);

        $sql = "INSERT INTO ".TBL_PROPERTIES_DISTING."(prop_id, date_start, date_end) VALUES";
        foreach ( $prop_id as $id ){
            $sql.= "(";
            $sql.= $id.",";
            $sql.= "now(),";
            $sql.= $date_end;
            $sql.= "),";
        }
        $sql = substr($sql, 0, -1);
        
        return $this->db->query($sql);
    }

    public function undisting($prop_id){
        $this->db->where_in("prop_id", $prop_id);
        return $this->db->delete(TBL_PROPERTIES_DISTING);
    }


    /*
     * FUNCTION PRIVATE
     */
    function add_date($givendate, $day=0, $mth=0, $yr=0) {
        $cd = strtotime($givendate);
        $newdate = date('d-m-Y h:i:s', mktime(date('h',$cd),
        date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
        date('d',$cd)+$day, date('Y',$cd)+$yr));
        return $newdate;
    }


}
?>
