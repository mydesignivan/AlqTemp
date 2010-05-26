<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function setup($var){
    $CI =& get_instance();
    $CI->load->model('setup_model');

    switch($var){
        // CONFIG GENERAL
        case "CFG_TIME_DISTPROP": return (int)$CI->setup_model->item('gral_time_propdisting');
        case "CFG_TIME_CUENTAPLUS": return (int)$CI->setup_model->item('gral_time_cp');
        case "CFG_COSTO_PROPDISTING": return (double)$CI->setup_model->item('gral_costo_disting');
        case "CFG_COSTO_CUENTAPLUS": return (double)$CI->setup_model->item('gral_costo_cp');
        case "CFG_FREE_TOTAL_PROP": return (int)$CI->setup_model->item('gral_count_freeprop');
        case "CFG_FREE_TOTAL_IMAGES": return (int)$CI->setup_model->item('gral_count_freeimages');
        case "CFG_CUENTAPLUS_TOTAL_PROP": return (int)$CI->setup_model->item('gral_count_propcp');
        case "CFG_CUENTAPLUS_TOTAL_IMAGES": return (int)$CI->setup_model->item('gral_count_imagescp');
        case "COUNT_PROP_DISTING": return (int)$CI->setup_model->item('gral_count_propdisting');
        case "CFG_MOVIE_OBJECT": return $CI->setup_model->item('gral_otros_scriptmovie');

        // METADATA - TITLES
        case "TITLE_GLOBAL": return $CI->setup_model->item('meta_titles_general');
        case "TITLE_INDEX": return $CI->setup_model->item('meta_titles_index');
        case "TITLE_MASINFO": return $CI->setup_model->item('meta_titles_moreinfo');
        case "TITLE_CONTACTO": return $CI->setup_model->item('meta_titles_contact');
        case "TITLE_REGISTRO": return $CI->setup_model->item('meta_titles_formreg');
        case "TITLE_MICUENTA": return $CI->setup_model->item('meta_titles_myaccount');
        case "TITLE_PROPIEDADES": return $CI->setup_model->item('meta_titles_prop');
        case "TITLE_DESTACAR": return $CI->setup_model->item('meta_titles_disting');
        case "TITLE_CUENTAPLUS": return $CI->setup_model->item('meta_titles_cp');
        case "TITLE_AGREGAR_FONDOS": return $CI->setup_model->item('meta_titles_addfondo');
        case "TITLE_CONDICIONES": return $CI->setup_model->item('meta_titles_conditions');
        case "TITLE_RECORDARCONTRA": return $CI->setup_model->item('meta_titles_rememberpss');

        // METADATA - KEYWORDS
        case "META_KEYWORDS_GLOBALS": return $CI->setup_model->item('meta_keywords_general');
        case "META_KEYWORDS_INDEX": return $CI->setup_model->item('meta_keywords_index');
        case "META_KEYWORDS_MASINFO": return $CI->setup_model->item('meta_keywords_moreinfo');
        case "META_KEYWORDS_CONTACTO": return $CI->setup_model->item('meta_keywords_contact');
        case "META_KEYWORDS_REGISTRO": return $CI->setup_model->item('meta_keywords_formreg');
        case "META_KEYWORDS_RECORDARCONTRA": return $CI->setup_model->item('meta_keywords_rememberpss');

        // METADATA - DESCRIPTIONS
        case "META_DESCRIPTION_GLOBALS": return $CI->setup_model->item('meta_desc_general');
        case "META_DESCRIPTION_INDEX": return $CI->setup_model->item('meta_desc_index');
        case "META_DESCRIPTION_MASINFO": return $CI->setup_model->item('meta_desc_moreinfo');
        case "META_DESCRIPTION_CONTACTO": return $CI->setup_model->item('meta_desc_contact');
        case "META_DESCRIPTION_REGISTRO": return $CI->setup_model->item('meta_desc_formreg');
        case "META_DESCRIPTION_RECORDARCONTRA": return $CI->setup_model->item('meta_desc_rememberpss');

    }
    return false;
}
?>
