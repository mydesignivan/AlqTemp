<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encpss{

    private $CI;
    function  __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('encrypt');
        $this->CI->encrypt->set_cipher(MCRYPT_BLOWFISH);
        $this->CI->encrypt->set_mode(MCRYPT_MODE_CFB);
    }

    public function encode($pss){
        if( empty($pss) ) return '';

        return $this->CI->encrypt->encode($pss);
    }

    public function decode($pss){
        return $this->CI->encrypt->decode($pss);
    }

    function urlsafe_base64_encode($string) {
        return str_replace(array('+','/','='),array('-','_',''), base64_encode($string));
    }

    function urlsafe_base64_decode($string) {

        $data = str_replace(array('-','_'),array('+','/'), $string);
        $mod4 = strlen($data) % 4;

        if ($mod4) {
            $data .= substr('====', $mod4);
        }

        return base64_decode($data);
    }

}
?>
