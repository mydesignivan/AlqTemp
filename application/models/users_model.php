<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends Model {

    private $user_table;

    function  __construct() {
        parent::Model();
        $this->user_table = "users";
    }

    public function index(){

    }


    public function get_user($user_id) {
        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }
        return $this->db->get_where($this->user_table, array('user_id'=>$user_id, 'active'=>1));
    }

    /*
     * @return int/boolean	(Id del usuario)
     */
    public function create($data = array()) {

        $result = $this->db->get_where($this->user_table, array('username'=>$data['username']));

        if( $result->num_rows==0 ){
            //Insert account into the database
            if( !$this->db->insert($this->user_table, $data) ) {
                //There was a problem!
                return false;
            }
        }else{
            return "userexists";
        }

        return $this->db->insert_id();
    }

    /*
     * @return	boolean
     */
    public function update($data = array(), $user_id=null) {

        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }

        $result = $this->db->get_where($this->user_table, array('user_id <>'=>$user_id, 'username'=>$data['username']));
        
        if( $result->num_rows==0 ){
            if( empty($data["password"]) ) unset($data["password"]);

            //Update account into the database
            $this->db->where('user_id', $user_id);

            if( !$this->db->update($this->user_table, $data) ) {
                //There was a problem!
                return false;
            }
        }else{
            return "userexists";
        }
        return "ok";
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
