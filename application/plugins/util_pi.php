<?php

function getval($var, $val){
    if( $var ){
        return isset($var[$val]) ? $var[$val] : "";
    }
}

?>
