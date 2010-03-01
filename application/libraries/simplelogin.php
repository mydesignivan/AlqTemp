<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Simplelogin Class
 **/
class Simplelogin{
    private $CI;
    private $user_table;

    function __construct(){
        $this->user_table = TBL_USERS;
        $this->CI =& get_instance();
        $this->CI->load->library('encpss');
    }

    /**
     * @return	boolean
     */
    public function login($user = '', $password = '') {
        //Make sure login info was sent
        if( $user == '' OR $password == '' ) {
            return 'loginfaild';
        }

        //Check if already logged in
        if( $this->CI->session->userdata('username') == $user ) {
            //User is already logged in.
            return 'loginfaild';
        }


        //Check against user table
        $query = $this->CI->db->get_where($this->user_table, array('username'=>$user));

        if ($query->num_rows > 0) {
            $row = $query->row_array();
            //Check against password

            if( $password != $this->CI->encpss->decode($row['password']) ) {
                return 'loginfaild';
            }

            if( $row['level']==0 && $row['active']==0 ){
                return 'userinactive';
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
            return 'loginfaild';
        }
    }

    /**
     * @return	void
     */
    public function logout() {
        //Destroy session
        $this->CI->session->sess_destroy();
    }
}
?>