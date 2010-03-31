<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class lists_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function get_country($elementDefault){
        $this->db->select('name, country_id');
        $this->db->order_by('name', 'asc');
        $data = $this->db->get(TBL_COUNTRY)->result_array();
        return array_merge($elementDefault, $data);
    }

    public function get_states($country_id, $elementDefault=null){
        $this->db->select('name, state_id');
        $this->db->where('country_id', $country_id);
        $this->db->order_by('name', 'asc');
        $data = $this->db->get(TBL_STATES)->result_array();
        if( $elementDefault!=null ){
            return array_merge($elementDefault, $data);
        }else{
            return $data;
        }
    }

    public function get_country_search($elementDefault){
        $this->db->select('DISTINCT '.TBL_COUNTRY.'.name, '.TBL_COUNTRY.'.country_id', false);
        $this->db->from(TBL_COUNTRY);
        $this->db->join(TBL_PROPERTIES, TBL_COUNTRY.'.country_id = '.TBL_PROPERTIES.'.country_id');
        $this->db->order_by('name', 'asc');
        $data = $this->db->get()->result_array();
        return array_merge($elementDefault, $data);
    }

    public function get_states_search($elementDefault){
        $this->db->select('DISTINCT '.TBL_STATES.'.name, '.TBL_STATES.'.state_id', false);
        $this->db->from(TBL_STATES);
        $this->db->join(TBL_PROPERTIES, TBL_STATES.'.state_id = '.TBL_PROPERTIES.'.state_id');
        $this->db->order_by('name', 'asc');
        $data = $this->db->get()->result_array();
        return array_merge($elementDefault, $data);
    }

    public function get_city_search($elementDefault){
        $this->db->select('DISTINCT city', false);
        $this->db->from(TBL_PROPERTIES);
        $this->db->order_by('city', 'asc');
        $data = $this->db->get()->result_array();
        return array_merge($elementDefault, $data);
    }

    public function get_category($elementDefault){
        $this->db->select('name, category_id');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get(TBL_CATEGORY);
        $data = $query->result_array();
        return array_merge($elementDefault, $data);
    }

    public function get_services(){
        $this->db->select('name, service_id');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get(TBL_SERVICES);
        return $query->result_array();
    }

    public function logs_dates($order='asc'){
        $d=opendir('application/logs/');
        $ret = array();
        while( $file = readdir($d) ){
            if( $file!="." AND $file!=".." ){
                $filename = basename($file, '.php');
                $ext = str_replace($filename, "", $file);

                if( $ext==".php" ){
                    $filename = substr($filename, 4);
                    $str = explode("-", $filename);
                    $ret[$filename] = $str[2]."-".$str[1]."-".$str[0];
                }
            }
        }
        $ret = order_dates($ret, $order);
        return $ret;
    }
}
?>