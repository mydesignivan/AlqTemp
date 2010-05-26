<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Setup_model extends Model {

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct() {
        parent::Model();
        $this->load->helper('file');
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function get_data(){
        $query = $this->db->get(TBL_SETUP);
        $row = $query->row_array();
        $row['htaccess'] = read_file('./.htaccess');
        return $row;
    }

    public function update(){
        $post = $_POST;

        write_file('./.htaccess', $post['txtHtaccess']);
        unset($post['txtHtaccess']);

        if( !$this->db->update(TBL_SETUP, $post) ){
            display_error(__FILE__, "update", ERR_DB_UPDATE, array(TBL_SETUP));
        }
        return true;
    }

    public function item($item){
        $this->db->select($item);
        $row = $this->db->get(TBL_SETUP)->row_array();
        return $row[$item];
    }


}
?>