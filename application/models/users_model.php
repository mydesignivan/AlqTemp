<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends Model {

    private $user_table;

    function  __construct() {
        parent::Model();
        $this->user_table = "users";
        $this->load->library('encpss');
    }

    public function create($data = array()) {

        //Insert account into the database
        if( !$this->db->insert($this->user_table, $data) ) {
            //There was a problem!
            return false;
        }

        return $this->db->insert_id();
    }

    public function update($data = array(), $user_id=null) {

        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }
        
        if( empty($data["password"]) ) unset($data["password"]);

        //Update account into the database
        $this->db->where('user_id', $user_id);

        if( !$this->db->update($this->user_table, $data) ) {
            //There was a problem!
            return false;
        }
        return "ok";
    }

    public function delete($user_id) {

        if( !is_numeric($user_id) ) return false;

        if( $this->db->delete($this->user_table, array('user_id' => $user_id)) ) {
            //Database call was successful, user is deleted
            return true;
        } else {
            //There was a problem
            return false;
        }
    }

    public function exists($username, $user_id=''){
        if( $user_id=="" ){
            $where = array('username'=>$username);
        }else{
            $where = array('user_id <>'=>$user_id, 'username'=>$username);
        }
        $result = $this->db->get_where($this->user_table, $where);
        return $result->num_rows==0 ? false : true;
    }

    public function get_user($user_id) {
        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }
        return $this->db->get_where($this->user_table, array('user_id'=>$user_id, 'active'=>1));
    }

    public function rememberpass($email){
        $result = $this->db->get_where($this->user_table, array('email'=>$email, 'active'=>1));
        if( $result->num_rows > 0 ){
            $data = $result->row_array();
            return $this->encpss->decode($data["password"]);
        }
        return false;
    }

}
?>
