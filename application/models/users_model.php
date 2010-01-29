<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends Model {

    function  __construct() {
        parent::Model();
        $this->load->library('encpss');
        $this->load->model('prop_model');
    }

    public function create($data = array()) {

        //Insert account into the database
        if( !$this->db->insert(TBL_USERS, $data) ) {
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

        if( !$this->db->update(TBL_USERS, $data) ) {
            //There was a problem!
            return false;
        }
        return "ok";
    }

    public function delete($user_id) {
        if( !is_numeric($user_id) ) return false;

        if( $this->db->delete(TBL_USERS, array('user_id' => $user_id)) ){
            return $this->prop_model->delete();
        }else{
            return false;
        }

    }

    public function exists($username, $email, $user_id=''){
        if( $user_id=="" ){
            $where = array('username'=>$username);
            $where2 = array('email'=>$email);
        }else{
            $where = array('user_id <>'=>$user_id, 'username'=>$username);
            $where2 = array('user_id <>'=>$user_id, 'email'=>$email);
        }
        $result = $this->db->get_where(TBL_USERS, $where);
        if( $result->num_rows>0 ) return "existsuser";

        $result = $this->db->get_where(TBL_USERS, $where2);
        if( $result->num_rows>0 ) return "existsmail";

        return "ok";
    }

    public function get_user($user_id) {
        if( !is_numeric($user_id) ) {
            //There was a problem
            return false;
        }
        return $this->db->get_where(TBL_USERS, array('user_id'=>$user_id, 'active'=>1));
    }

    public function rememberpass($email){
        $result = $this->db->get_where(TBL_USERS, array('email'=>$email, 'active'=>0));
        if( $result->num_rows >0 ) return array("status"=>"userinactive");

        $result = $this->db->get_where(TBL_USERS, array('email'=>$email, 'active'=>1));
        if( $result->num_rows==0 ) return array("status"=>"emailnotexists");

        $data = $result->row_array();
        return array("status"=>"ok", "password"=>$this->encpss->decode($data["password"]));
    }

    public function activate($user_id){
        $result = $this->db->get_where(TBL_USERS, array('user_id'=>$user_id));
        if( $result->num_rows>0 ) {
            $row = $result->row_array();

            if( $row['active']==1 ) return false;

            $this->db->where('user_id', $user_id);
            return $this->db->update(TBL_USERS, array('active'=>1));
            
        }else return false;

    }

}
?>