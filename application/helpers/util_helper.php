<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function print_array($arr, $die=FALSE){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if( $die ) die();
}

function is_localhost(){
    $hostname = $_SERVER['SERVER_NAME'];
    return $hostname=="localhost" || preg_match("/192.168/", $hostname);
}

function file_search_special($dir, $filename_search){
    if( substr($dir,-1)=="/" ) $dir = substr($dir, 0, strlen($dir)-1);
    if( is_dir($dir) ){
        $d=opendir($dir);
        while( $file = readdir($d) ){
            if( $file!="." AND $file!=".." ){
                if( is_file($dir.'/'.$file) ){
                    // Es Archivo
                    if( strpos($file, $filename_search) ){
                        return ($dir.'/'.$file);
                    }
                }

                if( is_dir($dir.'/'.$file) ){
                     // Es Directorio
                     // Volvemos a llamar
                     $r = file_search($dir.'/'.$file, $filename_search);
                     if( basename($r) == $filename_search ){
                        return $r;
                     }
                }
            }
        }
    }
    return false;
}

 function part_filename($name){
    return array(
        'ext'=>substr($name, (strripos($name, ".")-strlen($name))+1),
        'basename'=>substr($name, 0, strripos($name, "."))
    );
 }

function delete_images_temp(){
    $d = opendir(UPLOAD_DIR_TMP);
    $CI =& get_instance();
    while( $file = readdir($d) ){
        if( $file!="." AND $file!=".." ){
            if( preg_match("/^".$CI->session->userdata('user_id')."\_.*$/", $file) ){
                @unlink(UPLOAD_DIR_TMP.$file);
            }
        }
    }
}

function order_dates($str_date, $order='asc', $format='d-m-Y'){
    if( !is_array($str_date) ) (array)$str_date;

    $str_date_new = array();
    foreach( $str_date as $key=>$val ){
        $str_date_new[$key] = strtotime($val);
    }

    if( $order=="asc" || ($order!='asc'&&$order!='desc') ) arsort($str_date_new);
    elseif( $order=="desc" ) asort($str_date_new);

    $str_date = array();
    foreach( $str_date_new as $key=>$val ){
        $d = date($format, $val);
        $str_date[$key] = $d;
    }
    return $str_date;
}

function display_error($file, $function, $err, $param=array()){
    if( count($param)>0 ) {
        $err = vsprintf($err, $param);
    }
    log_message("error", $file." | ".$function." | ".$err);
    show_error($err);
}

function add_date($givendate, $day=0, $mth=0, $yr=0) {
    $cd = strtotime($givendate);
    $newdate = date('d-m-Y h:i:s', mktime(date('h',$cd),
    date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
    date('d',$cd)+$day, date('Y',$cd)+$yr));
    return $newdate;
}

function is_date($strdate){
    $timestamp = strtotime($strdate);
    if( $timestamp === false ) return false;

    $time = strtotime($strdate);
    return checkdate(date('m', $time), date('d', $time), date('Y', $time));
}

/*
 * @example : arr_search($myarray, 'keyname==4)
 */
function arr_search ( $array, $expression ) {
    $result = array();
    $expression = preg_replace ( "/([^\s]+?)(=|<|>|!)/", "\$a['$1']$2", $expression );
    foreach ( $array as $a ) if ( eval ( "return $expression;" ) ) $result[] = $a;
    return $result;
}

function construct_bloq($config){
    // ===== [config] =====
    // result            : array
    // tag_open          : string
    // tag_close         : string
    // tag_open_special  : string
    // tag_link          : boolean
    // field             : string
    // total_row         : integer

    $col=$n=0;
    foreach( $config['result'] as $row ){
        $n++;
        if( $n==1 ){
            $col++;
            if( $col==1 ) echo $config['tag_open'];
            else echo $config['tag_open_special'];
        }

        if( $n<=$config['total_row'] ){
            $name = $row[$config['field']];
            $tag = isset($config['tag_link']) ? '<a href="'. site_url('index/searcher/city/'.$name) .'" class="link1">'.$name.'</a>' : $name;
            echo '<li>'. $tag .'</li>';
        }

        if( $n==$config['total_row'] || $n==count($config['result']) ){
            echo $config['tag_close'];
            $n=0;
        }
    }
}

function array_implode($parent, $arr){
    $ret="";
    foreach( $arr as $key=>$val ){
        if( !empty($val) ) $ret.= $key . $parent . $val . $parent;
        else $ret.= $key . $parent;
    }
    return $ret;
}

function EmailMessageConstructor($data, $arr){
    $ret = array();
    foreach( $arr as $key=>$val ){
        if( isset($data[$key]) ){
            if( is_array($data[$key]) ){
                foreach( $data[$key] as $v ) $val = sprintf($val, $v);
                $ret[] = $val;
            }else{
                if( !empty($data[$key]) && $data[$key]!='null' )
                    $ret[] = sprintf($val, $data[$key]);
            }
        }
    }
    return implode("", $ret);
}
?>
