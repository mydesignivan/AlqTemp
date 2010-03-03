<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function set_useronline(){
    $CI =& get_instance();

    $ip = $CI->input->ip_address();
    $user_id = $CI->session->userdata('user_id');

    $query = $CI->db->get_where(TBL_USERSONLINE, array('ip'=>$ip, 'user_id'=>$user_id));

    if( $query->num_rows==0 ){
        $data = array(
            'ip'=>$ip,
            'time'=>time(),
            'user_id'=>$user_id
        );
        $CI->db->insert(TBL_USERSONLINE, $data);
    }else{
        $CI->db->update(TBL_USERSONLINE, array('time'=>time()));
    }
    
}
?>