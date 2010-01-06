<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_options_country(){
    $CI =& get_instance();

    $query = $CI->db->get('list_country');

    foreach( $query->result_array() as $row ){
        echo '<option value="'. $row['country_id'] .'">'. $row['name'] .'</option>';
    }
}

function get_options_state(){
    $CI =& get_instance();

    $query = $CI->db->get('list_states');

    foreach( $query->result_array() as $row ){
        echo '<option value="'. $row['state_id'] .'">'. $row['name'] .'</option>';
    }
}

function get_options_city(){
    $CI =& get_instance();

    $query = $CI->db->get('list_city');

    foreach( $query->result_array() as $row ){
        echo '<option value="'. $row['city_id'] .'">'. $row['name'] .'</option>';
    }
}

?>
