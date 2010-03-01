<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function mdate($datestr = '', $time = ''){
    if ($datestr == '')
            return '';

    if ($time == '')
            $time = now();

    $datestr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));

    $result = date($datestr, $time);

    $result = str_replace("January", "Enero", $result);
    $result = str_replace("February", "Febrero", $result);
    $result = str_replace("March", "Marzo", $result);
    $result = str_replace("April", "Abril", $result);
    $result = str_replace("May", "Mayo", $result);
    $result = str_replace("June", "Junio", $result);
    $result = str_replace("July", "Julio", $result);
    $result = str_replace("August", "Agosto", $result);
    $result = str_replace("September", "Septiembre", $result);
    $result = str_replace("October", "Octubre", $result);
    $result = str_replace("November", "Noviembre", $result);
    $result = str_replace("December", "Diciembre", $result);

    return $result;
}
?>