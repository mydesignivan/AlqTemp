<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Simplelogin Class
 **/
class Simplelogin{
    private $CI;
    private $user_table;

    function __construct($table = 'users'){
            // get_instance does not work well in PHP 4
            // you end up with two instances
            // of the CI object and missing data
            // when you call get_instance in the constructor
            //$this->CI =& get_instance();
        $this->user_table = $table;
    }

    /**
     * Create a user account
     *
     * @access	public
     * @param	string
     * @param	string
     * @param	bool
     * @return	bool
     */
    public function create($data = array()) {
        //Put here for PHP 4 users
        $this->CI =& get_instance();        

        //Encrypt password
        $password = md5($data['password']);

        //Insert account into the database
        $this->CI->db->set($data);
        if(!$this->CI->db->insert($this->user_table)) {
            //There was a problem!
            return false;
        }

        return $this->CI->db->insert_id();
    }

    /**
     * Delete user
     *
     * @access	public
     * @param integer
     * @return	bool
     */
    public function delete($user_id) {
        //Put here for PHP 4 users
        $this->CI =& get_instance();

        if(!is_numeric($user_id)) {
            //There was a problem
            return false;
        }

        if($this->CI->db->delete($this->user_table, array('id' => $user_id))) {
            //Database call was successful, user is deleted
            return true;
        } else {
            //There was a problem
            return false;
        }
    }


    /**
     * Login and sets session variables
     *
     * @access	public
     * @param	string
     * @param	string
     * @return	bool
     */
    public function login($user = '', $password = '') {
        //Put here for PHP 4 users
        $this->CI =& get_instance();

        //Make sure login info was sent
        if($user == '' OR $password == '') {
            return false;
        }

        //Check if already logged in
        if($this->CI->session->userdata('username') == $user) {
            //User is already logged in.
            return false;
        }


        //Check against user table
        $this->CI->db->where('username', $user);
        $query = $this->CI->db->getwhere($this->user_table);

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            //Check against password
            if(md5($password) != $row['password']) {
                    return false;
            }

            //Destroy old session
            $this->CI->session->sess_destroy();

            //Create a fresh, brand new session
            $this->CI->session->sess_create();

            //Remove the password field
            unset($row['password']);

            //Set session data
            $this->CI->session->set_userdata($row);

            //Set logged_in to true
            $this->CI->session->set_userdata(array('logged_in' => true));

            //Login was successful
            return true;
        } else {
            //No database result found
            return false;
        }
    }

    /**
     * Logout user
     *
     * @access	public
     * @return	void
     */
    public function logout() {
        //Put here for PHP 4 users
        $this->CI =& get_instance();

        //Destroy session
        $this->CI->session->sess_destroy();
    }
}
?>