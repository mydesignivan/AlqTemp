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
            display_error(__FILE__, "create", ERR_DB_INSERT, array(TBL_USERS));
        }

        return $this->db->insert_id();
    }

    public function update($data = array(), $user_id=null) {
        
        if( empty($data["password"]) ) unset($data["password"]);

        //Update account into the database
        $this->db->where('user_id', $user_id);

        if( !$this->db->update(TBL_USERS, $data) ) {
            display_error(__FILE__, "update", ERR_DB_UPDATE, array(TBL_USERS));
        }
        return true;
    }

    public function delete($user_id) {
        if( !is_numeric($user_id) ) return false;

        if( $this->db->delete(TBL_USERS, array('user_id' => $user_id)) ){
            $this->db->select('prop_id');
            $this->db->where("user_id", $user_id);
            $query = $this->db->get(TBL_PROPERTIES);
            $prop_id = array();
            foreach( $query->result_array() as $row ){
                $prop_id[] = $row['prop_id'];
            }

            $this->prop_model->delete($prop_id);
        }else{
            display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_USERS));
        }
        return true;
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
        $data = $this->db->get_where(TBL_USERS, array('user_id'=>$user_id, 'active'=>1))->row_array();
        return $data;
    }

    public function rememberpass($field){
        $result = $this->db->get_where(TBL_USERS, "(email = '".$field."' or username='".$field."') and active=0");
        if( $result->num_rows >0 ) return array("status"=>"userinactive");

        $result = $this->db->get_where(TBL_USERS, "(email = '".$field."' or username='".$field."') and active=1");
        if( $result->num_rows==0 ) return array("status"=>"notexists");

        $data = $result->row_array();
        $data['token'] = uniqid(time());

        $this->db->where('user_id', $data['user_id']);
        if( !$this->db->update(TBL_USERS, array('token'=>$data['token'])) ){
            display_error(__FILE__, "rememberpass", ERR_DB_UPDATE, array(TBL_USERS));
        }

        return array("status"=>"ok", "data"=>$data);
    }

    public function activate($user_id){
        $result = $this->db->get_where(TBL_USERS, array('user_id'=>$user_id));
        if( $result->num_rows>0 ) {
            $row = $result->row_array();

            if( $row['active']==1 ) return false;

            $this->db->where('user_id', $user_id);
            if( !$this->db->update(TBL_USERS, array('active'=>1)) ){
                display_error(__FILE__, "activate", ERR_DB_UPDATE, array(TBL_USERS));
            }
            return $result;
            
        }else return false;

    }

    public function check_token($username, $token){
        $result = $this->db->get_where(TBL_USERS, array('username'=>$username, 'token'=>$token));
        return $result->num_rows>0;
    }
    public function change_pass($post){
        if( $this->check_token($post['usr'], $post['token']) ){
            $newpass = $this->encpss->encode($post['txtPass']);

            $this->db->where('username', $post['usr']);
            if( !$this->db->update(TBL_USERS, array('password'=>$newpass, 'token'=>'')) ){
                display_error(__FILE__, "change_pass", ERR_DB_UPDATE, array(TBL_USERS));
            }
        }else return false;

        return true;
    }

}
?>