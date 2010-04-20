<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
        $this->load->library('encpss');
        $this->load->model('prop_model');
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function create($data = array()) {

        //Insert account into the database
        if( !$this->db->insert(TBL_USERS, $data) ) {
            display_error(__FILE__, "create", ERR_DB_INSERT, array(TBL_USERS));
        }

        return $this->db->insert_id();
    }

    public function edit($data = array(), $user_id=null) {
        
        //Update account into the database
        $this->db->where('user_id', $user_id);

        if( !$this->db->update(TBL_USERS, $data) ) {
            display_error(__FILE__, "update", ERR_DB_UPDATE, array(TBL_USERS));
        }
        return true;
    }

    public function delete($user_id) {
       
        $this->db->trans_begin(); // INICIO TRANSACCION

        if( $this->db->query('DELETE FROM '.TBL_USERS.' WHERE user_id in('. implode(",", $user_id) .')') ) {

            // Elimina todas las cuentas plus que tenga asociada
            if( !$this->db->query('DELETE FROM '.TBL_CUENTAPLUS.' WHERE user_id in('. implode(",", $user_id) .')') ) {
                $this->db->trans_rollback();
                display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_USERS));
            }

            // Elimina todas los pedidos que tenga asociada
            if( !$this->db->query('DELETE FROM '.TBL_ORDERS.' WHERE user_id in('. implode(",", $user_id) .')') ) {
                $this->db->trans_rollback();
                display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_USERS));
            }

            // Elimina de la tabla users_online
            if( !$this->db->query('DELETE FROM '.TBL_USERSONLINE.' WHERE user_id in('. implode(",", $user_id) .')') ) {
                $this->db->trans_rollback();
                display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_USERS));
            }

            // Elimina las propiedades asociadas
            $this->db->select('prop_id');
            $this->db->where_in("user_id", $user_id);
            $query = $this->db->get(TBL_PROPERTIES);
            $prop_id = array();
            foreach( $query->result_array() as $row ) $prop_id[] = $row['prop_id'];
            if( count($prop_id)>0 ) {
                if( !$this->prop_model->delete($prop_id) ){
                    $this->db->trans_rollback();
                    return false;
                }
            }
            
        }else{
            $this->db->trans_rollback();
            display_error(__FILE__, "delete", ERR_DB_DELETE, array(TBL_USERS));
        }
        $this->db->trans_commit(); // COMPLETO LA TRANSACCION

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

    public function get_user($where) {
        $data = $this->db->get_where(TBL_USERS, $where)->row_array();
        return $data;
    }

    public function get_list_users($limit, $offset, $searcher){
        $return = array();

        $sql = "user_id,";
        $sql.= "username,";
        $sql.= "active,";
        $sql.= "fondo,";
        $sql.= "date_format(date_added, '%d-%m-%Y %H:%i:%s') as date_added,";
        $sql.= "date_format(last_modified, '%d-%m-%Y %H:%i:%s') as last_modified";

        $like = array();
        $where = array('level'=>0);

        if( count($searcher)>0 ){
            if( isset($searcher['username']) ) $like['username'] = $searcher['username'];
            if( isset($searcher['fondo']) ) $where['fondo'] = $searcher['fondo'];
            if( isset($searcher['active']) ) $where['active'] = $searcher['active'];
            if( isset($searcher['date_added']) ) $like = array("date_format(date_added, '%d-%m-%Y %H:%i:%s')" => $searcher['date_added']);
            if( isset($searcher['last_modified']) ) $like = array("date_format(last_modified, '%d-%m-%Y %H:%i:%s')" => $searcher['last_modified']);
        }

        $this->db->from(TBL_USERS);
        $this->db->like($like);
        $this->db->where($where);

        $return['count_rows'] = $this->db->count_all_results();
        
        $this->db->select($sql, false);
        $this->db->like($like);
        $this->db->where($where);
        $this->db->order_by('username', 'asc');
        $this->db->order_by('user_id', 'desc');        

        $return['result'] = $this->db->get(TBL_USERS, $limit, $offset);

        return $return;
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

    public function change_pass2($pass_current, $pass_new){
        $user_id = $this->session->userdata('user_id');
        $query = $this->db->get_where(TBL_USERS, array('user_id'=>$user_id));
        foreach( $query->result_array() as $row ){
            if( $this->encpss->decode($row['password'])==$pass_current ){
                $this->db->where('user_id', $user_id);
                if( !$this->db->update(TBL_USERS, array('password'=>$this->encpss->encode($pass_new))) ){
                    display_error(__FILE__, "change_pass2", ERR_DB_UPDATE, array(TBL_USERS));
                }
                return "ok";
            }
        }
        return "notexists";
    }

    public function change_statu(){
        $this->db->where('user_id', $_POST['user_id']);
        if( !$this->db->update(TBL_USERS, array('active'=>$_POST['statu'])) ){
            display_error(__FILE__, "change_statu", ERR_DB_UPDATE, array(TBL_USERS));
        }
        return true;
    }

}
?>