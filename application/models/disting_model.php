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
        $date_end = substr(add_date(date('d-m-Y'), 0, setup('CFG_TIME_DISTPROP')), 0, 10);

        $this->fondos_model->extract(setup('CFG_COSTO_PROPDISTING'));


        $data = array(
            'prop_id'    => 0,
            'type'       => $type,
            'date_start' => 'now()',
            'date_end'   => $date_end
        );

        $key = $type=="category" ? "category_id" : $type;

        $this->db->trans_start(); // INICIO TRANSACCION
        foreach ( $prop_id as $id ){

            if( $type!="index" ) {
                $val = $this->_get_data($id, $key);
                if( !$val ) continue;
                else $data[$key] = $val;
            }

            $data['prop_id'] = $id;

            if( !$this->db->insert(TBL_PROPERTIES_DISTING, $data) ){
                display_error(__FILE__, "disting", ERR_DB_INSERT, array(TBL_PROPERTIES_DISTING));
            }
        }
        $this->db->trans_complete(); // COMPLETO LA TRANSACCION

        return true;
    }

    public function undisting($prop_id){
        $this->db->where_in("prop_id", $prop_id);
        if( !$this->db->delete(TBL_PROPERTIES_DISTING) ){
            display_error(__FILE__, "undisting", ERR_DB_INSERT, array(TBL_PROPERTIES_DISTING));
        }
        return true;
    }


    /* PRIVATE FUNCTIONS
     **************************************************************************/
     private function _get_data($id, $field){
         $this->db->select($field);
         $query = $this->db->get_where(TBL_PROPERTIES, array('prop_id'=>$id));
         if( $query->num_rows==0 ) return false;
         else {
             $row = $query->row_array();
             return $row[$field];
         }
     }
}
?>
