<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// FUNCIONES PARA LOS COMBOS DE LA PROPIEDAD
function get_options_country($country_id){
    $CI =& get_instance();

    $query = $CI->db->get(TBL_COUNTRY);

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

    $query = $CI->db->query("SELECT state_id, name FROM ".TBL_STATES." ".$where." ORDER BY name");

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
    $CI->db->select('DISTINCT '.TBL_COUNTRY.'.name, '.TBL_COUNTRY.'.country_id', false);
    $CI->db->from(TBL_COUNTRY);
    $CI->db->join(TBL_PROPERTIES, TBL_COUNTRY.'.country_id = '.TBL_PROPERTIES.'.country_id');
    $CI->db->order_by('name', 'asc');
    $query = $CI->db->get();
    foreach( $query->result_array() as $row ){
        $selected = $id==$row["country_id"] ? 'selected="selected"' : "";
        echo '<option value="'. $row['country_id'] .'" '.$selected.'>'. $row['name'] .'</option>';
    }
}

function get_options_search_states($id){
    $CI =& get_instance();
    $CI->db->select('DISTINCT '.TBL_STATES.'.name, '.TBL_STATES.'.state_id', false);
    $CI->db->from(TBL_STATES);
    $CI->db->join(TBL_PROPERTIES, TBL_STATES.'.state_id = '.TBL_PROPERTIES.'.state_id');
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
    $CI->db->from(TBL_PROPERTIES);
    $CI->db->order_by('city', 'asc');
    $query = $CI->db->get();
    foreach( $query->result_array() as $row ){
        $selected = $city==$row["city"] ? 'selected="selected"' : "";
        echo '<option value="'. $row['city'] .'" '.$selected.'>'. $row['city'] .'</option>';
    }
}

?>
