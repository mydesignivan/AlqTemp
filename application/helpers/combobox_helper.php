<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_options_country(){
    $CI =& get_instance();

    $query = $CI->db->get('list_country');

    foreach( $query->result_array() as $row ){
        echo '<option value="'. $row['country_id'] .'">'. $row['name'] .'</option>';
    }
}

function get_options_state($country_id){
    if( !is_numeric($country_id) ) return false;
    $CI =& get_instance();

    $query = $CI->db->query("SELECT state_id, name FROM list_states WHERE country_id=".$country_id." ORDER BY name");

    echo json_encode($query->result_array());
}

function get_options_city($state_id){
    if( !is_numeric($state_id) ) return false;
    $CI =& get_instance();

    $query = $CI->db->query("SELECT city_id, name FROM list_city WHERE state_id=".$state_id." ORDER BY name");

    echo json_encode($query->result_array());
}

?>
