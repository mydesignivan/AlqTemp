<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getval($var, $val){
    if( $var ){
        return isset($var[$val]) ? $var[$val] : "";
    }
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

function construct_bloq($config){
    // ===== [config] =====
    // result            : array
    // tag_open          : string
    // tag_close         : string
    // tag_open_special  : string
    // field             : string
    // total_row         : integer
    
    $n=0;
    $col=0;
    foreach( $config['result'] as $row ){
        $n++;
        if( $n==1 ){
            if( $col<2 ) echo $config['tag_open'].'<ul>';
            elseif( $col==2 && !empty($config['tag_open_special']) ){
                echo $config['tag_open_special'].'<ul>';
                $col=0;
            }
        }

        if( $n<=$config['total_row'] ){
            $name = $row[$config['field']];
            $tag = isset($config['tag_link']) ? '<a href="'.site_url('/search/index/city/'.$name.'/page/0').'" class="link1">'.$name.'</a>' : $name;
            echo '<li>'. $tag .'</li>';
        }

        if( $n==$config['total_row'] || $n==count($config['result']) ){
            echo '</ul>'.$config['tag_close'];
            $n=0;
            $col++;
        }
    }
}
?>
