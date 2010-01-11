<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_options_country($country_id){
    $CI =& get_instance();

    $query = $CI->db->get('list_country');

    foreach( $query->result_array() as $row ){
        $selected = $country_id == $row["country_id"] ? 'selected="selected"' : "";
        echo '<option value="'. $row['country_id'] .'" '.$selected.'>'. $row['name'] .'</option>';
    }
}

function get_options_state($param = array('country_id'=>0, 'selected'=>null)){
    $CI =& get_instance();

    $where = "";
    if( isset($param['country_id']) && $param['country_id']>0 ){
        $where = "WHERE country_id=".$param['country_id'];
    }

    $query = $CI->db->query("SELECT state_id, name FROM list_states ".$where." ORDER BY name");

    if( isset($param['country_id']) && $param['country_id']>0 && !isset($param['selected']) ){
        echo json_encode($query->result_array());
    }else{
        echo '<option value="0">Seleccione una Provincia</option>';
        foreach( $query->result_array() as $row ){
            $selected = $param['selected'] == $row["state_id"] ? 'selected="selected"' : "";
            echo '<option value="'. $row['state_id'] .'" '.$selected.'>'. $row['name'] .'</option>';
        }
    }
}

function get_options_city($state_id){
    if( !is_numeric($state_id) ) return false;
    $CI =& get_instance();

    $query = $CI->db->query("SELECT city_id, name FROM list_city WHERE state_id=".$state_id." ORDER BY name");

    echo json_encode($query->result_array());
}

?>
