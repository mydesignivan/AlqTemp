<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// FUNCIONES PARA LOS COMBOS DE LA PROPIEDAD
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


// FUNCIONES PARA LOS COMBOS DEL BUSCADOR
function get_options_search_country($id){
    $CI =& get_instance();
    $CI->db->select('DISTINCT list_country.name, list_country.country_id', false);
    $CI->db->from('list_country');
    $CI->db->join('properties', 'list_country.country_id = properties.country_id');
    $CI->db->order_by('name', 'asc');
    $query = $CI->db->get();
    foreach( $query->result_array() as $row ){
        $selected = $id==$row["country_id"] ? 'selected="selected"' : "";
        echo '<option value="'. $row['country_id'] .'" '.$selected.'>'. $row['name'] .'</option>';
    }
}

function get_options_search_states($id){
    $CI =& get_instance();
    $CI->db->select('DISTINCT list_states.name, list_states.state_id', false);
    $CI->db->from('list_states');
    $CI->db->join('properties', 'list_states.state_id = properties.state_id');
    $CI->db->order_by('name', 'asc');
    $query = $CI->db->get();
    foreach( $query->result_array() as $row ){
        $selected = $id==$row["state_id"] ? 'selected="selected"' : "";
        echo '<option value="'. $row['state_id'] .'" '.$selected.'>'. $row['name'] .'</option>';
    }
}

function get_options_search_city($city){
    $CI =& get_instance();
    $CI->db->select('DISTINCT city', false);
    $CI->db->from('properties');
    $CI->db->order_by('city', 'asc');
    $query = $CI->db->get();
    foreach( $query->result_array() as $row ){
        $selected = $city==$row["city"] ? 'selected="selected"' : "";
        echo '<option value="'. $row['city'] .'" '.$selected.'>'. $row['city'] .'</option>';
    }
}

?>
