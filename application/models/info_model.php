<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class info_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function getinfo_user(){
        $data = array();

        // Cant. usuarios registrados en el dia actual
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_USERS." WHERE DATE_FORMAT(date_added, '%d-%m-%Y')='".date('d-m-Y')."' AND level=0")->row_array();
        $data['count_user_day'] = $count['total'];

        // Total de usuarios registrados
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_USERS." WHERE level=0")->row_array();
        $data['total_users'] = $count['total'];

        // Total de usuarios online
        if( !$this->db->delete(TBL_USERSONLINE, array('TIME <'=>(time()-(5*60)))) ){
            display_error(__FILE__, "getinfo_user", ERR_DB_DELETE, array(TBL_USERSONLINE));
        }
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_USERSONLINE)->row_array();
        $data['total_online'] = $count['total'];

        // Total usuarios dado de baja
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_USERSDEL)->row_array();
        $data['total_baja'] = $count['total'];


        return $data;
    }

    public function getinfo_prop(){
        $data = array();

        // Cant. propiedades registrados en el dia actual
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_PROPERTIES." WHERE DATE_FORMAT(date_added, '%d-%m-%Y')='".date('d-m-Y')."'")->row_array();
        $data['count_prop_day'] = $count['total'];

        // Total de propiedades
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_PROPERTIES)->row_array();
        $data['total_prop'] = $count['total'];

        // Total de propiedades destacadas
        $this->db->from(TBL_PROPERTIES);
        $this->db->join(TBL_PROPERTIES_DISTING, TBL_PROPERTIES.'.prop_id='.TBL_PROPERTIES_DISTING.".prop_id");
        $data['prop_disting'] = $this->db->count_all_results();

        return $data;
    }

    public function getinfo_otros(){
        $data = array();

        // Cant. usuarios con cuenta plus
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_CUENTAPLUS." WHERE DATE_FORMAT(date_start, '%d-%m-%Y')='".date('d-m-Y')."'")->row_array();
        $data['count_cuentaplus'] = $count['total'];

        // Total de Ganancias
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_ORDERS." WHERE status=1")->row_array();
        $data['total_ganancias'] = $count['total'];

        return $data;
    }

    public function get_list_users(){
        $this->db->select('id, name');
        $this->db->order_by('name', 'asc');
        return $this->db->get(TBL_USERSDEL);
    }

    public function get_user($id){
        $query = $this->db->get_where(TBL_USERSDEL, array('id'=>$id));
        return $query->row_array();
    }
}
?>