<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends Model {

    private $user_table;

    function  __construct() {
        parent::Model();
        $this->user_table = "users";
    }

    public function index(){

    }


    public function get_all_user() {
        return $this->db->get_where($this->user_table, array('active'=>'1'));
    }

    public function get_user($user_id) {
        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }
        return $this->db->get_where($this->user_table, array('id_user'=>$user_id, 'active'=>1));
    }

    /*
     * @return int/boolean	(Id del usuario)
     */
    public function create($data = array()) {

        //Insert account into the database
        if( !$this->db->insert($this->user_table, $data) ) {
            //There was a problem!
            return false;
        }

        return $this->CI->db->insert_id();
    }

    /*
     * @return	boolean
     */
    public function update($data = array(), $user_id) {

        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }

        //Update account into the database
        if( !$this->db->update_string($this->user_table, $data, "id_user = ".$user_id) ) {
            //There was a problem!
            return false;
        }

        return true;
    }

    /*
     * @return boolean
     */
    public function delete($user_id) {

        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }

        if( $this->db->delete($this->user_table, array('id' => $user_id)) ) {
            //Database call was successful, user is deleted
            return true;
        } else {
            //There was a problem
            return false;
        }
    }

}

?>
