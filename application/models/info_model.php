<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class info_model extends Model {

    function  __construct() {
        parent::Model();
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function getinfo_user(){
        $data = array();

        // Cant. usuarios registrados en el dia actual
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_USERS." WHERE DATE_FORMAT(date_added, '%d-%m-%Y')='".date('d-m-Y')."' AND level=0")->row_array();
        $data['count_user_day'] = $count['total'];

        // Total de usuarios registrados
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_USERS." WHERE level=0")->row_array();
        $data['total_users'] = $count['total'];

        // Total de usuarios registrados
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_USERSONLINE)->row_array();
        $data['total_users_online'] = $count['total'];

        // Cant. usuarios con cuenta plus
        $count = $this->db->query("SELECT count(*) as total FROM ".TBL_CUENTAPLUS." WHERE DATE_FORMAT(date_start, '%d-%m-%Y')='".date('d-m-Y')."'")->row_array();
        $data['count_cuentaplus'] = $count['total'];
        

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

        return $data;
    }



}
?>