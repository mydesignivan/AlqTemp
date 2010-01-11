<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prop_model extends Model {

    private $user_table;

    function  __construct() {
        parent::Model();
        $this->user_table = "properties";
    }

    /*
     * FUNCTIONS PUBLIC
     */
    public function create($data = array()) {

        $services = explode(",", $data['services']);
        unset($data['services']);

        if( !$this->db->insert($this->user_table, $data) ) {
            return false;
        }

        if( !$this->create_servprop($services, $this->db->insert_id()) ) {
            return false;
        }
        return "ok";
    }

    public function update($data = array(), $prop_id=null) {

        if( !is_numeric($prop_id) ) return false;

        $services = explode(",", $data['services']);
        unset($data['services']);

        $this->db->where('prop_id', $prop_id);

        if( !$this->db->update($this->user_table, $data) ) {
            return false;
        }

        $this->db->delete("properties_to_services", array('prop_id'=>$prop_id));
        if( !$this->create_servprop($services, $prop_id) ) {
            return false;
        }

        return "ok";
    }

    public function delete($prop_id) {

        if( !is_numeric($prop_id) ) return false;

        $this->db->where('prop_id in ('.$prop_id.')');
        $delete1 = $this->db->delete($this->user_table);
        $delete2 = $this->db->delete("properties_to_services", array('prop_id' => $prop_id));

        if( !$delete1 || !$delete2 ) return false;

        return true;
    }

    public function exists($address, $prop_id=''){
        if( $prop_id=="" ){
            $where = array('address'=>$address);
        }else{
            $where = array('prop_id <>'=>$prop_id, 'address'=>$address);
        }
        $result = $this->db->get_where($this->user_table, $where);
        return $result->num_rows==0 ? false : true;
    }

    public function get_services(){
        return $this->db->get("list_services");
    }

    public function get_service_associate($prop_id){
        if( !is_numeric($prop_id) ) {
            //There was a problem
            return false;
        }
        $this->db->select('service_id');
        $query = $this->db->get_where("properties_to_services", array('prop_id'=>$prop_id));
        return $query->result_array();
    }

    public function get_list_prop(){
        $this->db->select("prop_id, address, CASE category WHEN 1 THEN 'Casas' WHEN 2 THEN 'Departamentos' WHEN 3 THEN 'Cabañas' WHEN 4 THEN 'Otros' END as category", false);
        $this->db->where("user_id", $this->session->userdata('user_id'));
        $this->db->order_by('prop_id', 'desc');
        $this->db->order_by('address', 'asc');
        $query = $this->db->get($this->user_table);
        return $query->result_array();
    }

    public function get_prop($prop_id){
        if( !is_numeric($prop_id) ) {
            //There was a problem
            return false;
        }
        $query = $this->db->get_where($this->user_table, array('prop_id'=>$prop_id));
        return $query->row_array();
    }


    /*
     * FUNCTIONS PRIVATE
     */
     private function create_servprop($services, $prop_id){
        $sql = "INSERT INTO properties_to_services(prop_id,service_id) VALUES ";
        foreach ( $services as $service ){
            $sql.="(";
            $sql.= $prop_id.",".$service."),";
        }
        $sql = substr($sql,0,-1);
        if( !$this->db->query($sql) ){
            return false;
        }
        return true;
     }
}

?>
